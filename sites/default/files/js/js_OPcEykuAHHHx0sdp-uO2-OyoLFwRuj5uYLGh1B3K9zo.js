(function($, _, Backbone) {
  if (!CRM.Backbone) CRM.Backbone = {};

  /**
   * Backbone.sync provider which uses CRM.api() for I/O.
   * To support CRUD operations, model classes must be defined with a "crmEntityName" property.
   * To load collections using API queries, set the "crmCriteria" property or override the
   * method "toCrmCriteria".
   *
   * @param method Accepts normal Backbone.sync methods; also accepts "crm-replace"
   * @param model
   * @param options
   * @see tests/qunit/crm-backbone
   */
  CRM.Backbone.sync = function(method, model, options) {
    var isCollection = _.isArray(model.models);

    var apiOptions, params;
    if (isCollection) {
      apiOptions = {
        success: function(data) {
          // unwrap data
          options.success(_.toArray(data.values));
        },
        error: function(data) {
          // CRM.api displays errors by default, but Backbone.sync
          // protocol requires us to override "error". This restores
          // the default behavior.
          $().crmError(data.error_message, ts('Error'));
          options.error(data);
        }
      };
      switch (method) {
        case 'read':
          CRM.api(model.crmEntityName, model.toCrmAction('get'), model.toCrmCriteria(), apiOptions);
          break;
        // replace all entities matching "x.crmCriteria" with new entities in "x.models"
        case 'crm-replace':
          params = this.toCrmCriteria();
          params.version = 3;
          params.values = this.toJSON();
          CRM.api(model.crmEntityName, model.toCrmAction('replace'), params, apiOptions);
          break;
        default:
          apiOptions.error({is_error: 1, error_message: "CRM.Backbone.sync(" + method + ") not implemented for collections"});
          break;
      }
    } else {
      // callback options to pass to CRM.api
      apiOptions = {
        success: function(data) {
          // unwrap data
          var values = _.toArray(data.values);
          if (data.count == 1) {
            options.success(values[0]);
          } else {
            data.is_error = 1;
            data.error_message = ts("Expected exactly one response");
            apiOptions.error(data);
          }
        },
        error: function(data) {
          // CRM.api displays errors by default, but Backbone.sync
          // protocol requires us to override "error". This restores
          // the default behavior.
          $().crmError(data.error_message, ts('Error'));
          options.error(data);
        }
      };
      switch (method) {
        case 'create': // pass-through
        case 'update':
          params = model.toJSON();
          if (!params.options) params.options = {};
          params.options.reload = 1;
          if (!model._isDuplicate) {
            CRM.api(model.crmEntityName, model.toCrmAction('create'), params, apiOptions);
          } else {
            CRM.api(model.crmEntityName, model.toCrmAction('duplicate'), params, apiOptions);
          }
          break;
        case 'read':
        case 'delete':
          var apiAction = (method == 'delete') ? 'delete' : 'get';
          params = model.toCrmCriteria();
          if (!params.id) {
            apiOptions.error({is_error: 1, error_message: 'Missing ID for ' + model.crmEntityName});
            return;
          }
          CRM.api(model.crmEntityName, model.toCrmAction(apiAction), params, apiOptions);
          break;
        default:
          apiOptions.error({is_error: 1, error_message: "CRM.Backbone.sync(" + method + ") not implemented for models"});
      }
    }
  };

  /**
   * Connect a "model" class to CiviCRM's APIv3
   *
   * @code
   * // Setup class
   * var ContactModel = Backbone.Model.extend({});
   * CRM.Backbone.extendModel(ContactModel, "Contact");
   *
   * // Use class
   * c = new ContactModel({id: 3});
   * c.fetch();
   * @endcode
   *
   * @param Class ModelClass
   * @param string crmEntityName APIv3 entity name, such as "Contact" or "CustomField"
   * @see tests/qunit/crm-backbone
   */
  CRM.Backbone.extendModel = function(ModelClass, crmEntityName) {
    // Defaults - if specified in ModelClass, preserve
    _.defaults(ModelClass.prototype, {
      crmEntityName: crmEntityName,
      crmActions: {}, // map: string backboneActionName => string serverSideActionName
      crmReturn: null, // array: list of fields to return
      toCrmAction: function(action) {
        return this.crmActions[action] ? this.crmActions[action] : action;
      },
      toCrmCriteria: function() {
        var result = (this.get('id')) ? {id: this.get('id')} : {};
        if (!_.isEmpty(this.crmReturn)) {
          result.return = this.crmReturn;
        }
        return result;
      },
      duplicate: function() {
        var newModel = new ModelClass(this.toJSON());
        newModel._isDuplicate = true;
        if (newModel.setModified) newModel.setModified();
        newModel.listenTo(newModel, 'sync', function(){
          // may get called on subsequent resaves -- don't care!
          delete newModel._isDuplicate;
        });
        return newModel;
      }
    });
    // Overrides - if specified in ModelClass, replace
    _.extend(ModelClass.prototype, {
      sync: CRM.Backbone.sync
    });
  };

  /**
   * Configure a model class to track whether a model has unsaved changes.
   *
   * Methods:
   *  - setModified() - flag the model as modified/dirty
   *  - isSaved() - return true if there have been no changes to the data since the last fetch or save
   * Events:
   *  - saved(object model, bool is_saved) - triggered whenever isSaved() value would change
   *
   *  Note: You should not directly call isSaved() within the context of the success/error/sync callback;
   *  I haven't found a way to make isSaved() behave correctly within these callbacks without patching
   *  Backbone. Instead, attach an event listener to the 'saved' event.
   *
   * @param ModelClass
   */
  CRM.Backbone.trackSaved = function(ModelClass) {
    // Retain references to some of the original class's functions
    var Parent = _.pick(ModelClass.prototype, 'initialize', 'save', 'fetch');

    // Private callback
    var onSyncSuccess = function() {
      this._modified = false;
      if (this._oldModified.length > 0) {
        this._oldModified.pop();
      }
      this.trigger('saved', this, this.isSaved());
    };
    var onSaveError = function() {
      if (this._oldModified.length > 0) {
        this._modified = this._oldModified.pop();
        this.trigger('saved', this, this.isSaved());
      }
    };

    // Defaults - if specified in ModelClass, preserve
    _.defaults(ModelClass.prototype, {
      isSaved: function() {
        var result = !this.isNew() && !this.isModified();
        return result;
      },
      isModified: function() {
        return this._modified;
      },
      _saved_onchange: function(model, options) {
        if (options.parse) return;
        // console.log('change', model.changedAttributes(), model.previousAttributes());
        this.setModified();
      },
      setModified: function() {
        var oldModified = this._modified;
        this._modified = true;
        if (!oldModified) {
          this.trigger('saved', this, this.isSaved());
        }
      }
    });

    // Overrides - if specified in ModelClass, replace
    _.extend(ModelClass.prototype, {
      initialize: function(options) {
        this._modified = false;
        this._oldModified = [];
        this.listenTo(this, 'change', this._saved_onchange);
        this.listenTo(this, 'error', onSaveError);
        this.listenTo(this, 'sync', onSyncSuccess);
        if (Parent.initialize) {
          return Parent.initialize.apply(this, arguments);
        }
      },
      save: function() {
        // we'll assume success
        this._oldModified.push(this._modified);
        return Parent.save.apply(this, arguments);
      },
      fetch: function() {
        this._oldModified.push(this._modified);
        return Parent.fetch.apply(this, arguments);
      }
    });
  };

  /**
   * Configure a model class to support client-side soft deletion.
   * One can call "model.setDeleted(BOOLEAN)" to flag an entity for
   * deletion (or not) -- however, deletion will be deferred until save()
   * is called.
   *
   * Methods:
   *   setSoftDeleted(boolean) - flag the model as deleted (or not-deleted)
   *   isSoftDeleted() - determine whether model has been soft-deleted
   * Events:
   *   softDelete(model, is_deleted) -- change value of is_deleted
   *
   * @param ModelClass
   */
  CRM.Backbone.trackSoftDelete = function(ModelClass) {
    // Retain references to some of the original class's functions
    var Parent = _.pick(ModelClass.prototype, 'save');

    // Defaults - if specified in ModelClass, preserve
    _.defaults(ModelClass.prototype, {
      is_soft_deleted: false,
      setSoftDeleted: function(is_deleted) {
        if (this.is_soft_deleted != is_deleted) {
          this.is_soft_deleted = is_deleted;
          this.trigger('softDelete', this, is_deleted);
          if (this.setModified) this.setModified(); // FIXME: ugly interaction, trackSoftDelete-trackSaved
        }
      },
      isSoftDeleted: function() {
        return this.is_soft_deleted;
      }
    });

    // Overrides - if specified in ModelClass, replace
    _.extend(ModelClass.prototype, {
      save: function(attributes, options) {
        if (this.isSoftDeleted()) {
          return this.destroy(options);
        } else {
          return Parent.save.apply(this, arguments);
        }
      }
    });
  };

    /**
   * Connect a "collection" class to CiviCRM's APIv3
   *
   * Note: the collection supports a special property, crmCriteria, which is an array of
   * query options to send to the API.
   *
   * @code
   * // Setup class
   * var ContactModel = Backbone.Model.extend({});
   * CRM.Backbone.extendModel(ContactModel, "Contact");
   * var ContactCollection = Backbone.Collection.extend({
   *   model: ContactModel
   * });
   * CRM.Backbone.extendCollection(ContactCollection);
   *
   * // Use class (with passive criteria)
   * var c = new ContactCollection([], {
   *   crmCriteria: {contact_type: 'Organization'}
   * });
   * c.fetch();
   * c.get(123).set('property', 'value');
   * c.get(456).setDeleted(true);
   * c.save();
   *
   * // Use class (with active criteria)
   * var criteriaModel = new SomeModel({
   *     contact_type: 'Organization'
   * });
   * var c = new ContactCollection([], {
   *   crmCriteriaModel: criteriaModel
   * });
   * c.fetch();
   * c.get(123).set('property', 'value');
   * c.get(456).setDeleted(true);
   * c.save();
   * @endcode
   *
   *
   * @param Class CollectionClass
   * @see tests/qunit/crm-backbone
   */
  CRM.Backbone.extendCollection = function(CollectionClass) {
    var origInit = CollectionClass.prototype.initialize;
    // Defaults - if specified in CollectionClass, preserve
    _.defaults(CollectionClass.prototype, {
      crmEntityName: CollectionClass.prototype.model.prototype.crmEntityName,
      crmActions: {}, // map: string backboneActionName => string serverSideActionName
      toCrmAction: function(action) {
        return this.crmActions[action] ? this.crmActions[action] : action;
      },
      toCrmCriteria: function() {
        var result = (this.crmCriteria) ? _.extend({}, this.crmCriteria) : {};
        if (!_.isEmpty(this.crmReturn)) {
          result.return = this.crmReturn;
        } else if (this.model && !_.isEmpty(this.model.prototype.crmReturn)) {
          result.return = this.model.prototype.crmReturn;
        }
        return result;
      },

      /**
       * Get an object which represents this collection's criteria
       * as a live model. Any changes to the model will be applied
       * to the collection, and the collection will be refreshed.
       *
       * @param criteriaModelClass
       */
      setCriteriaModel: function(criteriaModel) {
        var collection = this;
        this.crmCriteria = criteriaModel.toJSON();
        this.listenTo(criteriaModel, 'change', function() {
          collection.crmCriteria = criteriaModel.toJSON();
          collection.debouncedFetch();
        });
      },

      debouncedFetch: _.debounce(function() {
        this.fetch({reset: true});
      }, 100),

      /**
       * Reconcile the server's collection with the client's collection.
       * New/modified items from the client will be saved/updated on the
       * server. Deleted items from the client will be deleted on the
       * server.
       *
       * @param Object options - accepts "success" and "error" callbacks
       */
      save: function(options) {
        if (!options) options = {};
        var collection = this;
        var success = options.success;
        options.success = function(resp) {
          // Ensure attributes are restored during synchronous saves.
          collection.reset(resp, options);
          if (success) success(collection, resp, options);
          // collection.trigger('sync', collection, resp, options);
        };
        wrapError(collection, options);

        return this.sync('crm-replace', this, options);
      }
    });
    // Overrides - if specified in CollectionClass, replace
    _.extend(CollectionClass.prototype, {
      sync: CRM.Backbone.sync,
      initialize: function(models, options) {
        if (!options) options = {};
        if (options.crmCriteriaModel) {
          this.setCriteriaModel(options.crmCriteriaModel);
        } else if (options.crmCriteria) {
          this.crmCriteria = options.crmCriteria;
        }
        if (options.crmActions) {
          this.crmActions = _.extend(this.crmActions, options.crmActions);
        }
        if (origInit) {
          return origInit.apply(this, arguments);
        }
      },
      toJSON: function() {
        var result = [];
        // filter models list, excluding any soft-deleted items
        this.each(function(model) {
          // if model doesn't track soft-deletes
          // or if model tracks soft-deletes and wasn't soft-deleted
          if (!model.isSoftDeleted || !model.isSoftDeleted()) {
            result.push(model.toJSON());
          }
        });
        return result;
      }
    });
  };

  /**
   * Find a single record, or create a new record.
   *
   * @param Object options:
   *   - CollectionClass: class
   *   - crmCriteria: Object values to search/default on
   *   - defaults: Object values to put on newly created model (if needed)
   *   - success: function(model)
   *   - error: function(collection, error)
   */
   CRM.Backbone.findCreate = function(options) {
     if (!options) options = {};
     var collection = new options.CollectionClass([], {
       crmCriteria: options.crmCriteria
     });
     collection.fetch({
      success: function(collection) {
        if (collection.length === 0) {
          var attrs = _.extend({}, collection.crmCriteria, options.defaults || {});
          var model = collection._prepareModel(attrs, options);
          options.success(model);
        } else if (collection.length == 1) {
          options.success(collection.first());
        } else {
          options.error(collection, {
            is_error: 1,
            error_message: 'Too many matches'
          });
        }
      },
      error: function(collection, errorData) {
        if (options.error) {
          options.error(collection, errorData);
        }
      }
    });
  };


  CRM.Backbone.Model = Backbone.Model.extend({
    /**
     * Return JSON version of model -- but only include fields that are
     * listed in the 'schema'.
     *
     * @return {*}
     */
    toStrictJSON: function() {
      var schema = this.schema;
      var result = this.toJSON();
      _.each(result, function(value, key) {
        if (!schema[key]) {
          delete result[key];
        }
      });
      return result;
    },
    setRel: function(key, value, options) {
      this.rels = this.rels || {};
      if (this.rels[key] != value) {
        this.rels[key] = value;
        this.trigger("rel:" + key, value);
      }
    },
    getRel: function(key) {
      return this.rels ? this.rels[key] : null;
    }
  });

  CRM.Backbone.Collection = Backbone.Collection.extend({
    /**
     * Store 'key' on this.rel and automatically copy it to
     * any children.
     *
     * @param key
     * @param value
     * @param initialModels
     */
    initializeCopyToChildrenRelation: function(key, value, initialModels) {
      this.setRel(key, value, {silent: true});
      this.on('reset', this._copyToChildren, this);
      this.on('add', this._copyToChild, this);
    },
    _copyToChildren: function() {
      var collection = this;
      collection.each(function(model) {
        collection._copyToChild(model);
      });
    },
    _copyToChild: function(model) {
      _.each(this.rels, function(relValue, relKey) {
        model.setRel(relKey, relValue, {silent: true});
      });
    },
    setRel: function(key, value, options) {
      this.rels = this.rels || {};
      if (this.rels[key] != value) {
        this.rels[key] = value;
        this.trigger("rel:" + key, value);
      }
    },
    getRel: function(key) {
      return this.rels ? this.rels[key] : null;
    }
  });

  /*
  CRM.Backbone.Form = Backbone.Form.extend({
    validate: function() {
      // Add support for form-level validators
      var errors = Backbone.Form.prototype.validate.apply(this, []) || {};
      var self = this;
      if (this.validators) {
        _.each(this.validators, function(validator) {
          var modelErrors = validator(this.getValue());

          // The following if() has been copied-pasted from the parent's
          // handling of model-validators. They are similar in that the errors are
          // probably keyed by field names... but not necessarily, so we use _others
          // as a fallback.
          if (modelErrors) {
            var isDictionary = _.isObject(modelErrors) && !_.isArray(modelErrors);

            //If errors are not in object form then just store on the error object
            if (!isDictionary) {
              errors._others = errors._others || [];
              errors._others.push(modelErrors);
            }

            //Merge programmatic errors (requires model.validate() to return an object e.g. { fieldKey: 'error' })
            if (isDictionary) {
              _.each(modelErrors, function(val, key) {
                //Set error on field if there isn't one already
                if (self.fields[key] && !errors[key]) {
                  self.fields[key].setError(val);
                  errors[key] = val;
                }

                else {
                  //Otherwise add to '_others' key
                  errors._others = errors._others || [];
                  var tmpErr = {};
                  tmpErr[key] = val;
                  errors._others.push(tmpErr);
                }
              });
            }
          }

        });
      }
      return _.isEmpty(errors) ? null : errors;
    }
  });
  */

  // Wrap an optional error callback with a fallback error event.
  var wrapError = function (model, options) {
    var error = options.error;
    options.error = function(resp) {
      if (error) error(model, resp, optio);
      model.trigger('error', model, resp, options);
    };
  };
})(CRM.$, CRM._, CRM.BB);
;
(function($, _) {
  if (!CRM.Designer) CRM.Designer = {};

  // TODO Optimize this class
  CRM.Designer.PaletteFieldModel = CRM.Backbone.Model.extend({
    defaults: {
      /**
       * @var {string} required; a form-specific binding to an entity instance (eg 'student', 'mother')
       */
      entityName: null,

      /**
       * @var {string}
       */
      fieldName: null
    },
    initialize: function() {
    },
    getFieldSchema: function() {
      return this.getRel('ufGroupModel').getFieldSchema(this.get('entityName'), this.get('fieldName'));
    },
    getLabel: function() {
      // Note: if fieldSchema were a bit tighter, then we need to get a label from PaletteFieldModel at all
      return this.getFieldSchema().title || this.get('fieldName');
    },
    getSectionName: function() {
      // Note: if fieldSchema were a bit tighter, then we need to get a section from PaletteFieldModel at all
      return this.getFieldSchema().section || 'default';
    },
    getSection: function() {
      return this.getRel('ufGroupModel').getModelClass(this.get('entityName')).prototype.sections[this.getSectionName()];
    },
    /**
     * Add a new UFField model to a UFFieldCollection (if doing so is legal).
     * If it fails, display an alert.
     *
     * @param {int} ufGroupId
     * @param {CRM.UF.UFFieldCollection} ufFieldCollection
     * @param {Object} addOptions
     * @return {CRM.UF.UFFieldModel} or null (if the field is not addable)
     */
    addToUFCollection: function(ufFieldCollection, addOptions) {
      var name, paletteFieldModel = this;
      var ufFieldModel = paletteFieldModel.createUFFieldModel(ufFieldCollection.getRel('ufGroupModel'));
      ufFieldModel.set('uf_group_id', ufFieldCollection.uf_group_id);
      if (!ufFieldCollection.isAddable(ufFieldModel)) {
        CRM.alert(
          ts('The field "%1" is already included.', {
            1: paletteFieldModel.getLabel()
          }),
          ts('Duplicate'),
          'alert'
        );
        return null;
      }
      ufFieldCollection.add(ufFieldModel, addOptions);
      // Load metadata and set defaults
      // TODO: currently only works for custom fields
      name = this.get('fieldName').split('_');
      if (name[0] === 'custom') {
        CRM.api('custom_field', 'getsingle', {id: name[1]}, {success: function(field) {
          ufFieldModel.set(_.pick(field, 'help_pre', 'help_post', 'is_required'));
        }});
      }
      return ufFieldModel;
    },
    createUFFieldModel: function(ufGroupModel) {
      var model = new CRM.UF.UFFieldModel({
        is_active: 1,
        label: this.getLabel(),
        entity_name: this.get('entityName'),
        field_type: this.getFieldSchema().civiFieldType,
        field_name: this.get('fieldName')
      });
      return model;
    }
  });

  /**
   *
   * options:
   *  - ufGroupModel: UFGroupModel
   */
  CRM.Designer.PaletteFieldCollection = CRM.Backbone.Collection.extend({
    model: CRM.Designer.PaletteFieldModel,
    initialize: function(models, options) {
      this.initializeCopyToChildrenRelation('ufGroupModel', options.ufGroupModel, models);
    },

    /**
     * Look up a palette-field
     *
     * @param entityName
     * @param fieldName
     * @return {CRM.Designer.PaletteFieldModel}
     */
    getFieldByName: function(entityName, fieldName) {
      if (fieldName.indexOf('formatting') === 0) {
        fieldName = 'formatting';
      }
      return this.find(function(paletteFieldModel) {
        return ((!entityName || paletteFieldModel.get('entityName') == entityName) && paletteFieldModel.get('fieldName') == fieldName);
      });
    },

    /**
     * Get a list of all fields, grouped into sections by "entityName+sectionName".
     *
     * @return {Object} keys are sections ("entityName+sectionName"); values are CRM.Designer.PaletteFieldModel
     */
    getFieldsByEntitySection: function() {
      // TODO cache
      var fieldsByEntitySection = this.groupBy(function(paletteFieldModel) {
        return paletteFieldModel.get('entityName') + '-' + paletteFieldModel.getSectionName();
      });
      return fieldsByEntitySection;
    }
  });
})(CRM.$, CRM._);
;
(function($, _) {
  if (!CRM.ProfileSelector) CRM.ProfileSelector = {};

  CRM.ProfileSelector.DummyModel = CRM.Backbone.Model.extend({
    defaults: {
      profile_id: null
    }
  });
})(CRM.$, CRM._);
;
/**
 * Dynamically-generated alternative to civi.core.js
 */
(function($, _) {
  if (!CRM.Schema) CRM.Schema = {};

  /**
   * Data models used by the Civi form designer require more attributes than basic Backbone models:
   *  - sections: array of field-groupings
   *  - schema: array of fields, keyed by field name, per backbone-forms; extra attributes:
   *     + section: string, index to the 'sections' array
   *     + civiFieldType: string
   *
   * @see https://github.com/powmedia/backbone-forms
   */

  CRM.Schema.BaseModel = CRM.Backbone.Model.extend({
    initialize: function() {
    }
  });

  CRM.Schema.loadModels = function(civiSchema) {
    _.each(civiSchema, function(value, key, list) {
      CRM.Schema[key] = CRM.Schema.BaseModel.extend(value);
    });
  };

  CRM.Schema.reloadModels = function(options) {
    return $
      .ajax({
        url: CRM.url("civicrm/profile-editor/schema"),
        data: {
          'entityTypes': _.keys(CRM.civiSchema).join(',')
        },
        type: 'POST',
        dataType: 'json',
        success: function(data) {
          if (data) {
            CRM.civiSchema = data;
            CRM.Schema.loadModels(CRM.civiSchema);
          }
        }
      });
  };

  CRM.Schema.loadModels(CRM.civiSchema);
})(CRM.$, CRM._);
;
(function($, _) {
  if (!CRM.UF) CRM.UF = {};

  var YESNO = [
    {val: 0, label: ts('No')},
    {val: 1, label: ts('Yes')}
  ];

  var VISIBILITY = [
    {val: 'User and User Admin Only', label: ts('User and User Admin Only'), isInSelectorAllowed: false},
    {val: 'Public Pages', label: ts('Expose Publicly'), isInSelectorAllowed: true},
    {val: 'Public Pages and Listings', label: ts('Expose Publicly and for Listings'), isInSelectorAllowed: true}
  ];

  var LOCATION_TYPES = _.map(CRM.PseudoConstant.locationType, function(value, key) {
    return {val: key, label: value};
  });
  LOCATION_TYPES.unshift({val: '', label: ts('Primary')});
  var DEFAULT_LOCATION_TYPE_ID = '';

  var PHONE_TYPES = _.map(CRM.PseudoConstant.phoneType, function(value, key) {
    return {val: key, label: value};
  });

  var WEBSITE_TYPES = _.map(CRM.PseudoConstant.websiteType, function(value, key) {
    return {val: key, label: value};
  });
  var DEFAULT_PHONE_TYPE_ID = PHONE_TYPES[0].val;
  var DEFAULT_WEBSITE_TYPE_ID = WEBSITE_TYPES[0].val;

  /**
   * Add a help link to a form label
   */
  function addHelp(title, options) {
    return title + ' <a href="#" onclick=\'CRM.help("' + title + '", ' + JSON.stringify(options) + '); return false;\' title="' + ts('%1 Help', {1: title}) + '" aria-label="' + ts('%1 Help', {1: title}) + '" class="helpicon"></a>';
  }

  function watchChanges() {
    CRM.designerApp.vent.trigger('ufUnsaved', true);
  }

  /**
   * Parse a "group_type" expression
   *
   * @param string groupTypeExpr example: "Individual,Activity\0ActivityType:2:28"
   *   Note: I've seen problems where HTML "&#00;" != JS '\0', so we support ';;' as an equivalent delimiter
   * @return Object example: {coreTypes: {"Individual":true,"Activity":true}, subTypes: {"ActivityType":{2: true, 28:true}]}}
   */
  CRM.UF.parseTypeList = function(groupTypeExpr) {
    var typeList = {coreTypes: {}, subTypes:{}};
    // The API may have automatically converted a string with '\0' to an array
    var parts = _.isArray(groupTypeExpr) ? groupTypeExpr : groupTypeExpr.replace(';;','\0').split('\0');
    var coreTypesExpr = parts[0];
    var subTypesExpr = parts[1];

    if (!_.isEmpty(coreTypesExpr)) {
      _.each(coreTypesExpr.split(','), function(coreType){
        typeList.coreTypes[coreType] = true;
      });
    }

    //CRM-15427 Allow Multiple subtype filtering
    if (!_.isEmpty(subTypesExpr)) {
      if (subTypesExpr.indexOf(';;') !== -1) {
        var subTypeparts = subTypesExpr.replace(/;;/g,'\0').split('\0');
        _.each(subTypeparts, function(subTypepart) {
          var subTypes = subTypepart.split(':');
          var subTypeKey = subTypes.shift();
          typeList.subTypes[subTypeKey] = {};
          _.each(subTypes, function(subTypeId) {
            typeList.subTypes[subTypeKey][subTypeId] = true;
          });
        });
      }
      else {
        var subTypes = subTypesExpr.split(':');
        var subTypeKey = subTypes.shift();
        typeList.subTypes[subTypeKey] = {};
        _.each(subTypes, function(subTypeId) {
          typeList.subTypes[subTypeKey][subTypeId] = true;
        });
      }
    }
    return typeList;
  };

  /**
   * This function is a hack for generating simulated values of "entity_name"
   * in the form-field model.
   *
   * @param {string} field_type
   * @return {string}
   */
  CRM.UF.guessEntityName = function(field_type) {
    switch (field_type) {
      case 'Contact':
      case 'Individual':
      case 'Organization':
      case 'Household':
      case 'Formatting':
        return 'contact_1';
      case 'Activity':
        return 'activity_1';
      case 'Contribution':
        return 'contribution_1';
      case 'Membership':
        return 'membership_1';
      case 'Participant':
        return 'participant_1';
      case 'Case':
        return 'case_1';
      default:
        if (CRM.contactSubTypes.length && ($.inArray(field_type,CRM.contactSubTypes) > -1)) {
          return 'contact_1';
        }
        else {
          throw "Cannot guess entity name for field_type=" + field_type;
        }
    }
  };

  /**
   * Represents a field in a customizable form.
   */
  CRM.UF.UFFieldModel = CRM.Backbone.Model.extend({
    /**
     * Backbone.Form description of the field to which this refers
     */
    defaults: {
      help_pre: '',
      help_post: '',
      /**
       * @var bool, non-persistent indication of whether this field is unique or duplicate
       * within its UFFieldCollection
       */
      is_duplicate: false
    },
    schema: {
      'id': {
        type: 'Number'
      },
      'uf_group_id': {
        type: 'Number'
      },
      'entity_name': {
        // pseudo-field
        type: 'Text'
      },
      'field_name': {
        type: 'Text'
      },
      'field_type': {
        type: 'Select',
        options: ['Contact', 'Individual', 'Organization', 'Contribution', 'Membership', 'Participant', 'Activity']
      },
      'help_post': {
        title: addHelp(ts('Field Post Help'), {id: "help", file:"CRM/UF/Form/Field"}),
        type: 'TextArea'
      },
      'help_pre': {
        title: addHelp(ts('Field Pre Help'), {id: "help", file:"CRM/UF/Form/Field"}),
        type: 'TextArea'
      },
      'in_selector': {
        title: addHelp(ts('Results Columns?'), {id: "in_selector", file:"CRM/UF/Form/Field"}),
        type: 'Select',
        options: YESNO
      },
      'is_active': {
        title: addHelp(ts('Active?'), {id: "is_active", file:"CRM/UF/Form/Field"}),
        type: 'Select',
        options: YESNO
      },
      'is_multi_summary': {
        title: ts("Include in multi-record listing?"),
        type: 'Select',
        options: YESNO
      },
      'is_required': {
        title: addHelp(ts('Required?'), {id: "is_required", file:"CRM/UF/Form/Field"}),
        type: 'Select',
        options: YESNO
      },
      'is_reserved': {
        type: 'Select',
        options: YESNO
      },
      'is_searchable': {
        title: addHelp(ts("Searchable"), {id: "is_searchable", file:"CRM/UF/Form/Field"}),
        type: 'Select',
        options: YESNO
      },
      'is_view': {
        title: addHelp(ts('View Only?'), {id: "is_view", file:"CRM/UF/Form/Field"}),
        type: 'Select',
        options: YESNO
      },
      'label': {
        title: ts('Field Label'),
        type: 'Text',
        editorAttrs: {maxlength: 255}
      },
      'location_type_id': {
        title: ts('Location Type'),
        type: 'Select',
        options: LOCATION_TYPES
      },
      'website_type_id': {
        title: ts('Website Type'),
        type: 'Select',
        options: WEBSITE_TYPES
      },
      'phone_type_id': {
        title: ts('Phone Type'),
        type: 'Select',
        options: PHONE_TYPES
      },
      'visibility': {
        title: addHelp(ts('Visibility'), {id: "visibility", file:"CRM/UF/Form/Field"}),
        type: 'Select',
        options: VISIBILITY
      },
      'weight': {
        type: 'Number'
      }
    },
    initialize: function() {
      if (this.get('field_name').indexOf('formatting') === 0) {
        this.schema.help_pre.title = ts('Markup');
      }
      this.set('entity_name', CRM.UF.guessEntityName(this.get('field_type')));
      this.on("rel:ufGroupModel", this.applyDefaults, this);
      this.on('change', watchChanges);
    },
    applyDefaults: function() {
      var fieldSchema = this.getFieldSchema();
      if (fieldSchema && fieldSchema.civiIsLocation && !this.get('location_type_id')) {
        this.set('location_type_id', DEFAULT_LOCATION_TYPE_ID);
      }
      if (fieldSchema && fieldSchema.civiIsWebsite && !this.get('website_type_id')) {
        this.set('website_type_id', DEFAULT_WEBSITE_TYPE_ID);
      }
      if (fieldSchema && fieldSchema.civiIsPhone && !this.get('phone_type_id')) {
        this.set('phone_type_id', DEFAULT_PHONE_TYPE_ID);
      }
    },
    isInSelectorAllowed: function() {
      var visibility = _.first(_.where(VISIBILITY, {val: this.get('visibility')}));
      if (visibility) {
        return visibility.isInSelectorAllowed;
      }
      else {
        return false;
      }
    },
    getFieldSchema: function() {
      return this.getRel('ufGroupModel').getFieldSchema(this.get('entity_name'), this.get('field_name'));
    },
    /**
     * Create a uniqueness signature. Ideally, each UFField in a UFGroup should
     * have a unique signature.
     *
     * @return {String}
     */
    getSignature: function() {
      return this.get("entity_name") +
        '::' + this.get("field_name") +
        '::' + (this.get("location_type_id") ? this.get("location_type_id") : this.get("website_type_id") ? this.get("website_type_id") : '') +
        '::' + (this.get("phone_type_id") ? this.get("phone_type_id") : '');
    },

    /**
     * This is like destroy(), but it only destroys the item on the client-side;
     * it does not trigger REST or Backbone.sync() operations.
     *
     * @return {Boolean}
     */
    destroyLocal: function() {
      this.trigger('destroy', this, this.collection, {});
      return false;
    }
  });

  /**
   * Represents a list of fields in a customizable form
   *
   * options:
   *  - uf_group_id: int
   */
  CRM.UF.UFFieldCollection = CRM.Backbone.Collection.extend({
    model: CRM.UF.UFFieldModel,
    uf_group_id: null, // int
    initialize: function(models, options) {
      options = options || {};
      this.uf_group_id = options.uf_group_id;
      this.initializeCopyToChildrenRelation('ufGroupModel', options.ufGroupModel, models);
      this.on('add', this.watchDuplicates, this);
      this.on('remove', this.unwatchDuplicates, this);
      this.on('change', watchChanges);
      this.on('add', watchChanges);
      this.on('remove', watchChanges);
    },
    getFieldsByName: function(entityName, fieldName) {
      return this.filter(function(ufFieldModel) {
        return (ufFieldModel.get('entity_name') == entityName && ufFieldModel.get('field_name') == fieldName);
      });
    },
    toSortedJSON: function() {
      var fields = this.map(function(ufFieldModel){
        return ufFieldModel.toStrictJSON();
      });
      return _.sortBy(fields, function(ufFieldJSON){
        return parseInt(ufFieldJSON.weight);
      });
    },
    isAddable: function(ufFieldModel) {
      var entity_name = ufFieldModel.get('entity_name'),
        field_name = ufFieldModel.get('field_name'),
        fieldSchema = this.getRel('ufGroupModel').getFieldSchema(ufFieldModel.get('entity_name'), ufFieldModel.get('field_name'));
      if (field_name.indexOf('formatting') === 0) {
        return true;
      }
      if (! fieldSchema) {
        return false;
      }
      var fields = this.getFieldsByName(entity_name, field_name);
      var limit = 1;
      if (fieldSchema.civiIsLocation) {
        limit *= LOCATION_TYPES.length;
      }
      if (fieldSchema.civiIsWebsite) {
        limit *= WEBSITE_TYPES.length;
      }
      if (fieldSchema.civiIsPhone) {
        limit *= PHONE_TYPES.length;
      }
      return fields.length < limit;
    },
    watchDuplicates: function(model, collection, options) {
      model.on('change:location_type_id', this.markDuplicates, this);
      model.on('change:website_type_id', this.markDuplicates, this);
      model.on('change:phone_type_id', this.markDuplicates, this);
      this.markDuplicates();
    },
    unwatchDuplicates: function(model, collection, options) {
      model.off('change:location_type_id', this.markDuplicates, this);
      model.off('change:website_type_id', this.markDuplicates, this);
      model.off('change:phone_type_id', this.markDuplicates, this);
      this.markDuplicates();
    },
    hasDuplicates: function() {
      var firstDupe = this.find(function(ufFieldModel){
        return ufFieldModel.get('is_duplicate');
      });
      return firstDupe ? true : false;
    },
    /**
     *
     */
    markDuplicates: function() {
      var ufFieldModelsByKey = this.groupBy(function(ufFieldModel) {
        return ufFieldModel.getSignature();
      });
      this.each(function(ufFieldModel){
        var is_duplicate = ufFieldModelsByKey[ufFieldModel.getSignature()].length > 1;
        if (is_duplicate != ufFieldModel.get('is_duplicate')) {
          ufFieldModel.set('is_duplicate', is_duplicate);
        }
      });
    }
  });

  /**
   * Represents an entity in a customizable form
   */
  CRM.UF.UFEntityModel = CRM.Backbone.Model.extend({
    schema: {
      'id': {
        // title: ts(''),
        type: 'Number'
      },
      'entity_name': {
        title: ts('Entity Name'),
        help: ts('Symbolic name which referenced in the fields'),
        type: 'Text'
      },
      'entity_type': {
        title: ts('Entity Type'),
        type: 'Select',
        options: ['IndividualModel', 'ActivityModel']
      },
      'entity_sub_type': {
        // Use '*' to match all subtypes; use an int to match a specific type id; use empty-string to match none
        title: ts('Sub Type'),
        type: 'Text'
      }
    },
    defaults: {
      entity_sub_type: '*'
    },
    initialize: function() {
    },
    /**
     * Get a list of all fields that can be used with this entity.
     *
     * @return {Object} keys are field names; values are fieldSchemas
     */
    getFieldSchemas: function() {
      var ufEntityModel = this;
      var modelClass= this.getModelClass();

      if (this.get('entity_sub_type') == '*') {
        return _.clone(modelClass.prototype.schema);
      }

      var result = {};
      _.each(modelClass.prototype.schema, function(fieldSchema, fieldName){
        var section = modelClass.prototype.sections[fieldSchema.section];
        if (ufEntityModel.isSectionEnabled(section)) {
          result[fieldName] = fieldSchema;
        }
      });
      return result;
    },
    isSectionEnabled: function(section) {
      //CRM-15427
      return (!section || !section.extends_entity_column_value || _.contains(section.extends_entity_column_value, this.get('entity_sub_type')) || this.get('entity_sub_type') == '*');
    },
    getSections: function() {
      var ufEntityModel = this;
      var result = {};
      _.each(ufEntityModel.getModelClass().prototype.sections, function(section, sectionKey){
        if (ufEntityModel.isSectionEnabled(section)) {
          result[sectionKey] = section;
        }
      });
      return result;
    },
    getModelClass: function() {
      return CRM.Schema[this.get('entity_type')];
    }
});

  /**
   * Represents a list of entities in a customizable form
   *
   * options:
   *  - ufGroupModel: UFGroupModel
   */
  CRM.UF.UFEntityCollection = CRM.Backbone.Collection.extend({
    model: CRM.UF.UFEntityModel,
    byName: {},
    initialize: function(models, options) {
      options = options || {};
      this.initializeCopyToChildrenRelation('ufGroupModel', options.ufGroupModel, models);
    },
    /**
     *
     * @param name
     * @return {UFEntityModel} if found; otherwise, null
     */
    getByName: function(name) {
      // TODO consider indexing
      return this.find(function(ufEntityModel){
        return ufEntityModel.get('entity_name') == name;
      });
    }
  });

  /**
   * Represents a customizable form
   */
  CRM.UF.UFGroupModel = CRM.Backbone.Model.extend({
    defaults: {
      title: ts('Unnamed Profile'),
      is_active: 1
    },
    schema: {
      'id': {
        // title: ts(''),
        type: 'Number'
      },
      'name': {
        // title: ts(''),
        type: 'Text'
      },
      'title': {
        title: ts('Profile Name'),
        help: ts(''),
        type: 'Text',
        editorAttrs: {maxlength: 64},
        validators: ['required']
      },
      'frontend_title': {
        title: ts('Public Title'),
        help: ts(''),
        type: 'Text',
        editorAttrs: {maxlength: 64},
        validators: []
      },
      'group_type': {
        // For a description of group_type, see CRM_Core_BAO_UFGroup::updateGroupTypes
        // title: ts(''),
        type: 'Text'
      },
      'add_captcha': {
        title: ts('Include reCAPTCHA?'),
        help: ts('FIXME'),
        type: 'Select',
        options: YESNO
      },
      'add_to_group_id': {
        title: ts('Add new contacts to a Group?'),
        help: ts('Select a group if you are using this profile for adding new contacts, AND you want the new contacts to be automatically assigned to a group.'),
        type: 'Number'
      },
      'cancel_URL': {
        title: ts('Cancel Redirect URL'),
        help: ts('If you are using this profile as a contact signup or edit form, and want to redirect the user to a static URL if they click the Cancel button - enter the complete URL here. If this field is left blank, the built-in Profile form will be redisplayed.'),
        type: 'Text'
      },
      'cancel_button_text': {
        title: ts('Cancel Button Text'),
        help: ts('Text to display on the cancel button when used in create or edit mode'),
        type: 'Text'
      },
      'submit_button_text': {
        title: ts('Submit Button Text'),
        help: ts('Text to display on the submit button when used in create or edit mode'),
        type: 'Text'
      },
      'created_date': {
        //title: ts(''),
        type: 'Text'// FIXME
      },
      'created_id': {
        //title: ts(''),
        type: 'Number'
      },
      'help_post': {
        title: ts('Post-form Help'),
        help: ts('Explanatory text displayed at the end of the form.') +
        ts('Note that this help text is displayed on profile create/edit screens only.'),
        type: 'TextArea'
      },
      'help_pre': {
        title: ts('Pre-form Help'),
        help: ts('Explanatory text displayed at the beginning of the form.') +
        ts('Note that this help text is displayed on profile create/edit screens only.'),
        type: 'TextArea'
      },
      'is_active': {
        title: ts('Is this CiviCRM Profile active?'),
        type: 'Select',
        options: YESNO
      },
      'is_cms_user': {
        title: ts('Drupal user account registration option?'),// FIXME
        help: ts('FIXME'),
        type: 'Select',
        options: YESNO // FIXME
      },
      'is_edit_link': {
        title: ts('Include profile edit links in search results?'),
        help: ts('Check this box if you want to include a link in the listings to Edit profile fields. Only users with permission to edit the contact will see this link.'),
        type: 'Select',
        options: YESNO
      },
      'is_map': {
        title: ts('Enable mapping for this profile?'),
        help: ts('If enabled, a Map link is included on the profile listings rows and detail screens for any contacts whose records include sufficient location data for your mapping provider.'),
        type: 'Select',
        options: YESNO
      },
      'is_proximity_search': {
        title: ts('Proximity Search'),
        help: ts('FIXME'),
        type: 'Select',
        options: YESNO // FIXME
      },
      'is_reserved': {
        // title: ts(''),
        type: 'Select',
        options: YESNO
      },
      'is_uf_link': {
        title: ts('Include Drupal user account information links in search results?'), // FIXME
        help: ts('FIXME'),
        type: 'Select',
        options: YESNO
      },
      'is_update_dupe': {
        title: ts('What to do upon duplicate match'),
        help: ts('FIXME'),
        type: 'Select',
        options: YESNO // FIXME
      },
      'limit_listings_group_id': {
        title: ts('Limit listings to a specific Group?'),
        help: ts('Select a group if you are using this profile for search and listings, AND you want to limit the listings to members of a specific group.'),
        type: 'Number'
      },
      'notify': {
        title: ts('Notify when profile form is submitted?'),
        help: ts('If you want member(s) of your organization to receive a notification email whenever this Profile form is used to enter or update contact information, enter one or more email addresses here. Multiple email addresses should be separated by a comma (e.g. jane@example.org, paula@example.org). The first email address listed will be used as the FROM address in the notifications.'),
        type: 'TextArea'
      },
      'post_URL': {
        title: ts('Redirect URL'),
        help: ts("If you are using this profile as a contact signup or edit form, and want to redirect the user to a static URL after they've submitted the form, you can also use contact tokens in URL - enter the complete URL here. If this field is left blank, the built-in Profile form will be redisplayed with a generic status message - 'Your contact information has been saved.'"),
        type: 'Text'
      },
      'weight': {
        title: ts('Order'),
        help: ts('Weight controls the order in which profiles are presented when more than one profile is included in User Registration or My Account screens. Enter a positive or negative integer - lower numbers are displayed ahead of higher numbers.'),
        type: 'Number'
        // FIXME positive int
      }
    },
    initialize: function() {
      var ufGroupModel = this;

      if (!this.getRel('ufEntityCollection')) {
        var ufEntityCollection = new CRM.UF.UFEntityCollection([], {
          ufGroupModel: this,
          silent: false
        });
        this.setRel('ufEntityCollection', ufEntityCollection);
      }

      if (!this.getRel('ufFieldCollection')) {
        var ufFieldCollection = new CRM.UF.UFFieldCollection([], {
          uf_group_id: this.id,
          ufGroupModel: this
        });
        this.setRel('ufFieldCollection', ufFieldCollection);
      }

      if (!this.getRel('paletteFieldCollection')) {
        var paletteFieldCollection = new CRM.Designer.PaletteFieldCollection([], {
          ufGroupModel: this
        });
        paletteFieldCollection.sync = function(method, model, options) {
          if (!options) options = {};
          // console.log(method, model, options);
          switch (method) {
            case 'read':
              var success = options.success;
              options.success = function(resp, status, xhr) {
                if (success) success(resp, status, xhr);
                model.trigger('sync', model, resp, options);
              };
              success(ufGroupModel.buildPaletteFields());

              break;
            case 'create':
            case 'update':
            case 'delete':
              throw 'Unsupported method: ' + method;

            default:
              throw 'Unsupported method: ' + method;
          }
        };
        this.setRel('paletteFieldCollection', paletteFieldCollection);
      }

      this.getRel('ufEntityCollection').on('reset', this.resetEntities, this);
      this.resetEntities();

      this.on('change', watchChanges);
    },
    /**
     * Generate a copy of this UFGroupModel and its fields, with all ID's removed. The result
     * is suitable for a new, identical UFGroup.
     *
     * @return {CRM.UF.UFGroupModel}
     */
    deepCopy: function() {
      var copy = new CRM.UF.UFGroupModel(_.omit(this.toStrictJSON(), ['id','created_id','created_date','is_reserved','group_type']));
      copy.getRel('ufEntityCollection').reset(
        this.getRel('ufEntityCollection').toJSON()
        // FIXME: for configurable entities, omit ['id', 'uf_group_id']
      );
      copy.getRel('ufFieldCollection').reset(
        this.getRel('ufFieldCollection').map(function(ufFieldModel) {
          return _.omit(ufFieldModel.toStrictJSON(), ['id', 'uf_group_id']);
        })
      );
      var new_id = 1;
      CRM.api3('UFGroup', 'getsingle', {
        "return": ["id"],
        "options": {"limit": 1, "sort": "id DESC"}
      }).done(function(result) {
        new_id = Number(result.id) + 1;
        var copyLabel = ' ' + ts('(Copy)');
        var nameSuffix = '_' + new_id;
        copy.set('title', copy.get('title').slice(0, 64 - copyLabel.length) + copyLabel);
        copy.set('name', copy.get('name').slice(0, 64 - nameSuffix.length) + nameSuffix);
      });
      return copy;
    },
    getModelClass: function(entity_name) {
      var ufEntity = this.getRel('ufEntityCollection').getByName(entity_name);
      if (!ufEntity) throw 'Failed to locate entity: ' + entity_name;
      return ufEntity.getModelClass();
    },
    getFieldSchema: function(entity_name, field_name) {
      if (field_name.indexOf('formatting') === 0) {
        field_name = 'formatting';
      }
      var modelClass = this.getModelClass(entity_name);
      var fieldSchema = modelClass.prototype.schema[field_name];
      if (!fieldSchema) {
        CRM.console('warn', 'Failed to locate field: ' + entity_name + "." + field_name);
        return null;
      }
      return fieldSchema;
    },
    /**
     * Check that the group_type contains *only* the types listed in validTypes
     *
     * @param string validTypesExpr
     * @param bool allowAllSubtypes
     * @return {Boolean}
     */
    //CRM-15427
    checkGroupType: function(validTypesExpr, allowAllSubtypes, usedByFilter) {
      var allMatched = true;
      allowAllSubtypes = allowAllSubtypes || false;
      usedByFilter = usedByFilter || null;
      if (_.isEmpty(this.get('group_type'))) {
        return true;
      }
      if (usedByFilter && _.isEmpty(this.get('module'))) {
        return false;
      }

      var actualTypes = CRM.UF.parseTypeList(this.get('group_type'));
      var validTypes = CRM.UF.parseTypeList(validTypesExpr);

      // Every actual.coreType is a valid.coreType
      _.each(actualTypes.coreTypes, function(ignore, actualCoreType) {
        if (! validTypes.coreTypes[actualCoreType]) {
          allMatched = false;
        }
      });

      // CRM-16915 - filter with usedBy module if specified.
      if (usedByFilter && this.get('module') != usedByFilter) {
        allMatched = false;
      }
      //CRM-15427 allow all subtypes
      if (!$.isEmptyObject(validTypes.subTypes) && !allowAllSubtypes) {
        // Every actual.subType is a valid.subType
        _.each(actualTypes.subTypes, function(actualSubTypeIds, actualSubTypeKey) {
          if (!validTypes.subTypes[actualSubTypeKey]) {
            allMatched = false;
            return;
          }
          // actualSubTypeIds is a list of all subtypes which can be used by group,
          // so it's sufficient to match any one of them
          var subTypeMatched = false;
          _.each(actualSubTypeIds, function(ignore, actualSubTypeId) {
            if (validTypes.subTypes[actualSubTypeKey][actualSubTypeId]) {
              subTypeMatched = true;
            }
          });
          allMatched = allMatched && subTypeMatched;
        });
      }
      return allMatched;
    },
    calculateContactEntityType: function() {
      var ufGroupModel = this;

      // set proper entity model based on selected profile
      var contactTypes = ['Individual', 'Household', 'Organization'];
      var profileType = ufGroupModel.get('group_type') || '';

      // check if selected profile have subtype defined eg: ["Individual,Contact,Case", "caseType:7"]
      if (_.isArray(profileType) && profileType[0]) {
        profileType = profileType[0];
      }
      profileType = profileType.split(',');

      var ufEntityModel;
      _.each(profileType, function (ptype) {
        if ($.inArray(ptype, contactTypes) > -1) {
          ufEntityModel = ptype + 'Model';
          return true;
        }
      });

      return ufEntityModel;
    },
    setUFGroupModel: function(entityType, allEntityModels) {
      var ufGroupModel = this;

      var newUfEntityModels = [];
      _.each(allEntityModels, function (values) {
        if (entityType && values.entity_name == 'contact_1') {
          values.entity_type = entityType;
        }
        newUfEntityModels.push(new CRM.UF.UFEntityModel(values));
      });

      ufGroupModel.getRel('ufEntityCollection').reset(newUfEntityModels);
    },
    resetEntities: function() {
      var ufGroupModel = this;
      var deleteFieldList = [];
      ufGroupModel.getRel('ufFieldCollection').each(function(ufFieldModel){
        if (!ufFieldModel.getFieldSchema()) {
          CRM.alert(ts('This profile no longer includes field "%1"! All references to the field have been removed.', {
            1: ufFieldModel.get('label')
          }), '', 'alert', {expires: false});
          deleteFieldList.push(ufFieldModel);
        }
      });

      _.each(deleteFieldList, function(ufFieldModel) {
        ufFieldModel.destroyLocal();
      });

      this.getRel('paletteFieldCollection').reset(this.buildPaletteFields());

      // reset to redraw the cancel after entity type is updated.
      ufGroupModel.getRel('ufFieldCollection').reset(ufGroupModel.getRel('ufFieldCollection').toJSON());
    },
    /**
     *
     * @return {Array} of PaletteFieldModel
     */
    buildPaletteFields: function() {
      // rebuild list of fields; reuse old instances of PaletteFieldModel and create new ones
      // as appropriate
      // Note: The system as a whole is ill-defined in cases where we have an existing
      // UFField that references a model field that disappears.

      var ufGroupModel = this;

      var oldPaletteFieldModelsBySig = {};
      this.getRel('paletteFieldCollection').each(function(paletteFieldModel){
        oldPaletteFieldModelsBySig[paletteFieldModel.get("entityName") + '::' + paletteFieldModel.get("fieldName")] = paletteFieldModel;
      });

      var newPaletteFieldModels = [];
      this.getRel('ufEntityCollection').each(function(ufEntityModel){
        var modelClass = ufEntityModel.getModelClass();
        _.each(ufEntityModel.getFieldSchemas(), function(value, key, list) {
          var model = oldPaletteFieldModelsBySig[ufEntityModel.get('entity_name') + '::' + key];
          if (!model) {
            model = new CRM.Designer.PaletteFieldModel({
              modelClass: modelClass,
              entityName: ufEntityModel.get('entity_name'),
              fieldName: key
            });
          }
          newPaletteFieldModels.push(model);
        });
      });

      return newPaletteFieldModels;
    }
  });

  /**
   * Represents a list of customizable form
   */
  CRM.UF.UFGroupCollection = CRM.Backbone.Collection.extend({
    model: CRM.UF.UFGroupModel
  });
})(CRM.$, CRM._);
;
(function($, _, Backbone) {
  if (!CRM.Designer) CRM.Designer = {};

  /**
   * When rendering a template with Marionette.ItemView, the list of variables is determined by
   * serializeData(). The normal behavior is to map each property of this.model to a template
   * variable.
   *
   * This function extends that practice by exporting variables "_view", "_model", "_collection",
   * and "_options". This makes it easier for the template to, e.g., access computed properties of
   * a model (by calling "_model.getComputedProperty"), or to access constructor options (by
   * calling "_options.myoption").
   *
   * @return {*}
   */
  var extendedSerializeData = function() {
    var result = Marionette.ItemView.prototype.serializeData.apply(this);
    result._view = this;
    result._model = this.model;
    result._collection = this.collection;
    result._options = this.options;
    return result;
  };

  /**
   * Display a dialog window with an editable form for a UFGroupModel
   *
   * The implementation here is very "jQuery-style" and not "Backbone-style";
   * it's been extracted
   *
   * options:
   *  - model: CRM.UF.UFGroupModel
   */
  CRM.Designer.DesignerDialog = Backbone.Marionette.Layout.extend({
    serializeData: extendedSerializeData,
    template: '#designer_dialog_template',
    className: 'crm-designer-dialog',
    regions: {
      designerRegion: '.crm-designer'
    },
    /** @var bool whether this dialog is currently open */
    isDialogOpen: false,
    /** @var bool whether any changes have been made */
    isUfUnsaved: false,
    /** @var obj handle for the CRM.alert containing undo link */
    undoAlert: null,
    /** @var bool whether this dialog is being re-opened by the undo link */
    undoState: false,

    initialize: function(options) {
      CRM.designerApp.vent.on('ufUnsaved', this.onUfChanged, this);
      CRM.designerApp.vent.on('ufSaved', this.onUfSaved, this);
    },
    onClose: function() {
      if (this.undoAlert && this.undoAlert.close) this.undoAlert.close();
      CRM.designerApp.vent.off('ufUnsaved', this.onUfChanged, this);
    },
    onUfChanged: function(isUfUnsaved) {
      this.isUfUnsaved = isUfUnsaved;
    },
    onUfSaved: function() {
      CRM.designerApp.vent.off('ufUnsaved', this.onUfChanged, this);
      this.isUfUnsaved = false;
    },
    onRender: function() {
      var designerDialog = this;
      designerDialog.$el.dialog({
        autoOpen: true, // note: affects accordion height
        title: ts('Edit Profile'),
        modal: true,
        width: '75%',
        height: parseInt($(window).height() * 0.8, 10),
        minWidth: 500,
        minHeight: 600, // to allow dropping in big whitespace, coordinate with min-height of .crm-designer-fields
        open: function() {
          // Prevent conflicts with other onbeforeunload handlers
          designerDialog.oldOnBeforeUnload = window.onbeforeunload;
          // Warn of unsaved changes when navigating away from the page
          window.onbeforeunload = function() {
            if (designerDialog.isDialogOpen && designerDialog.isUfUnsaved) {
              return ts("Your profile has not been saved.");
            }
            if (designerDialog.oldOnBeforeUnload) {
              return designerDialog.oldOnBeforeUnload.apply(arguments);
            }
          };
          if (designerDialog.undoAlert && designerDialog.undoAlert.close) designerDialog.undoAlert.close();
          designerDialog.isDialogOpen = true;
          // Initialize new dialog if we are not re-opening unsaved changes
          if (designerDialog.undoState === false) {
            if (designerDialog.designerRegion && designerDialog.designerRegion.close) designerDialog.designerRegion.close();
            designerDialog.$el.block();
            designerDialog.options.findCreateUfGroupModel({
              onLoad: function(ufGroupModel) {
                designerDialog.model = ufGroupModel;
                var designerLayout = new CRM.Designer.DesignerLayout({
                  model: ufGroupModel,
                  el: '<div class="full-height"></div>'
                });
                designerDialog.$el.unblock();
                designerDialog.designerRegion.show(designerLayout);
                CRM.designerApp.vent.trigger('resize');
                designerDialog.isUfUnsaved = false;
              }
            });
          }
          designerDialog.undoState = false;
          // CRM-12188
          CRM.designerApp.DetachedProfiles = [];
        },
        close: function() {
          window.onbeforeunload = designerDialog.oldOnBeforeUnload;
          designerDialog.isDialogOpen = false;

          if (designerDialog.undoAlert && designerDialog.undoAlert.close) designerDialog.undoAlert.close();
          if (designerDialog.isUfUnsaved) {
            designerDialog.undoAlert = CRM.alert('<p>' + ts('%1 has not been saved.', {1: designerDialog.model.get('title')}) + '</p><a href="#" class="crm-undo">' + ts('Restore') + '</a>', ts('Unsaved Changes'), 'alert', {expires: 60000});
            $('.ui-notify-message a.crm-undo').button({icons: {primary: 'fa-undo'}}).click(function(e) {
              e.preventDefault();
              designerDialog.undoState = true;
              designerDialog.$el.dialog('open');
            });
          }
          // CRM-12188
          CRM.designerApp.restorePreviewArea();
        },
        resize: function() {
          CRM.designerApp.vent.trigger('resize');
        }
      });
    }
  });

  /**
   * Display a complete form-editing UI, including canvas, palette, and
   * buttons.
   *
   * options:
   *  - model: CRM.UF.UFGroupModel
   */
  CRM.Designer.DesignerLayout = Backbone.Marionette.Layout.extend({
    serializeData: extendedSerializeData,
    template: '#designer_template',
    regions: {
      buttons: '.crm-designer-buttonset-region',
      palette: '.crm-designer-palette-region',
      form: '.crm-designer-form-region',
      fields: '.crm-designer-fields-region'
    },
    initialize: function() {
      CRM.designerApp.vent.on('resize', this.onResize, this);
    },
    onClose: function() {
      CRM.designerApp.vent.off('resize', this.onResize, this);
    },
    onRender: function() {
      this.buttons.show(new CRM.Designer.ToolbarView({
        model: this.model
      }));
      this.palette.show(new CRM.Designer.PaletteView({
        model: this.model
      }));
      this.form.show(new CRM.Designer.UFGroupView({
        model: this.model
      }));
      this.fields.show(new CRM.Designer.UFFieldCanvasView({
        model: this.model
      }));
    },
    onResize: function() {
      if (! this.hasResizedBefore) {
        this.hasResizedBefore = true;
        this.$('.crm-designer-toolbar').resizable({
          handles: 'w',
          maxWidth: 400,
          minWidth: 150,
          resize: function(event, ui) {
            $('.crm-designer-canvas').css('margin-right', (ui.size.width + 10) + 'px');
            $(this).css({left: '', height: ''});
          }
        }).css({left: '', height: ''});
      }
    }
  });

  /**
   * Display toolbar with working button
   *
   * options:
   *  - model: CRM.UF.UFGroupModel
   */
  CRM.Designer.ToolbarView = Backbone.Marionette.ItemView.extend({
    serializeData: extendedSerializeData,
    template: '#designer_buttons_template',
    previewMode: false,
    events: {
      'click .crm-designer-save': 'doSave',
      'click .crm-designer-preview': 'doPreview'
    },
    onRender: function() {
      this.$('.crm-designer-save').button({icons: {primary: 'fa-check'}}).attr({
        disabled: 'disabled',
        style: 'opacity:.5; cursor:default;'
      });
      this.$('.crm-designer-preview').button({icons: {primary: 'fa-television'}});
    },
    initialize: function(options) {
      CRM.designerApp.vent.on('ufUnsaved', this.onUfChanged, this);
    },
    onUfChanged: function(isUfUnsaved) {
      if (isUfUnsaved) {
        this.$('.crm-designer-save').removeAttr('style').prop('disabled', false);
      }
    },
    doSave: function(e) {
      e.preventDefault();
      var ufGroupModel = this.model;
      if (ufGroupModel.getRel('ufFieldCollection').hasDuplicates()) {
        CRM.alert(ts('Please correct errors before saving.'), '', 'alert');
        return;
      }
      var $dialog = this.$el.closest('.crm-designer-dialog'); // FIXME use events
      $dialog.block();
      var profile = ufGroupModel.toStrictJSON();
      profile["api.UFField.replace"] = {values: ufGroupModel.getRel('ufFieldCollection').toSortedJSON(), 'option.autoweight': 0};
      CRM.api('UFGroup', 'create', profile, {
        success: function(data) {
          $dialog.unblock();
          var error = false;
          if (data.is_error) {
            CRM.alert(data.error_message);
            error = true;
          }
          _.each(data.values, function(ufGroupResponse) {
            if (ufGroupResponse['api.UFField.replace'].is_error) {
              CRM.alert(ufGroupResponse['api.UFField.replace'].error_message);
              error = true;
            }
          });
          if (!error) {
            if (!ufGroupModel.get('id')) {
              ufGroupModel.set('id', data.id);
            }
            CRM.designerApp.vent.trigger('ufUnsaved', false);
            CRM.designerApp.vent.trigger('ufSaved');
            $dialog.dialog('close');
          }
        }
      });
    },
    doPreview: function(e) {
      e.preventDefault();
      this.previewMode = !this.previewMode;
      if (!this.previewMode) {
        $('.crm-designer-preview-canvas').html('');
        $('.crm-designer-canvas > *, .crm-designer-palette-region').show();
        $('.crm-designer-preview').button('option', {icons: {primary: 'fa-television'}}).find('span').text(ts('Preview'));
        return;
      }
      if (this.model.getRel('ufFieldCollection').hasDuplicates()) {
        CRM.alert(ts('Please correct errors before previewing.'), '', 'alert');
        return;
      }
      var $dialog = this.$el.closest('.crm-designer-dialog'); // FIXME use events
      $dialog.block();
      // CRM-12188
      CRM.designerApp.clearPreviewArea();
      $.post(CRM.url("civicrm/ajax/inline"), {
        'qfKey': CRM.profilePreviewKey,
        'class_name': 'CRM_UF_Form_Inline_Preview',
        'snippet': 1,
        'ufData': JSON.stringify({
          ufGroup: this.model.toStrictJSON(),
          ufFieldCollection: this.model.getRel('ufFieldCollection').toSortedJSON()
        })
      }).done(function(data) {
        $dialog.unblock();
        $('.crm-designer-canvas > *, .crm-designer-palette-region').hide();
        $('.crm-designer-preview-canvas').html(data).show().trigger('crmLoad').find(':input').prop('readOnly', true);
        $('.crm-designer-preview').button('option', {icons: {primary: 'fa-pencil'}}).find('span').text(ts('Edit'));
      });
    }
  });

  /**
   * Display a selection of available fields
   *
   * options:
   *  - model: CRM.UF.UFGroupModel
   */
  CRM.Designer.PaletteView = Backbone.Marionette.ItemView.extend({
    serializeData: extendedSerializeData,
    template: '#palette_template',
    el: '<div class="full-height"></div>',
    openTreeNodes: [],
    events: {
      'keyup .crm-designer-palette-search input': 'doSearch',
      'change .crm-contact-types': 'doSetPaletteEntity',
      'click .crm-designer-palette-clear-search': 'clearSearch',
      'click .crm-designer-palette-toggle': 'toggleAll',
      'click .crm-designer-palette-add button': 'doNewCustomFieldDialog',
      'click #crm-designer-add-custom-set': 'doNewCustomSetDialog',
      'dblclick .crm-designer-palette-field': 'doAddToCanvas'
    },
    initialize: function() {
      this.model.getRel('ufFieldCollection')
        .on('add', this.toggleActive, this)
        .on('remove', this.toggleActive, this);
      this.model.getRel('paletteFieldCollection')
        .on('reset', this.render, this);
      CRM.designerApp.vent.on('resize', this.onResize, this);
    },
    onClose: function() {
      this.model.getRel('ufFieldCollection')
        .off('add', this.toggleActive, this)
        .off('remove', this.toggleActive, this);
      this.model.getRel('paletteFieldCollection')
        .off('reset', this.render, this);
      CRM.designerApp.vent.off('resize', this.onResize, this);
    },
    onRender: function() {
      var paletteView = this;

      // Prepare data for jstree
      var treeData = [];
      var paletteFieldsByEntitySection = this.model.getRel('paletteFieldCollection').getFieldsByEntitySection();

      paletteView.model.getRel('ufEntityCollection').each(function(ufEntityModel){
        _.each(ufEntityModel.getSections(), function(section, sectionKey){
          var defaultValue = paletteView.selectedContactType;
          if (!defaultValue) {
            defaultValue = paletteView.model.calculateContactEntityType();
          }

          // set selected option as default, since we are rebuilding palette
          paletteView.$('.crm-contact-types').val(defaultValue).prop('selected','selected');

          var entitySection = ufEntityModel.get('entity_name') + '-' + sectionKey;
          var items = [];
          if (paletteFieldsByEntitySection[entitySection]) {
            _.each(paletteFieldsByEntitySection[entitySection], function(paletteFieldModel, k) {
              items.push({data: paletteFieldModel.getLabel(), attr: {'class': 'crm-designer-palette-field', 'data-plm-cid': paletteFieldModel.cid}});
            });
          }
          if (section.is_addable) {
            items.push({data: ts('+ Add New Field'), attr: {'class': 'crm-designer-palette-add'}});
          }
          if (items.length > 0) {
            treeData.push({
              data: section.title,
              children: items,
              state: _.contains(paletteView.openTreeNodes, sectionKey) ? 'open' : 'closed',
              attr: {
                'class': 'crm-designer-palette-section',
                'data-section': sectionKey,
                'data-entity': ufEntityModel.get('entity_name')
              }
            });
          }
        });
      });

      this.$('.crm-designer-palette-tree').jstree({
        'json_data': {data: treeData},
        'search': {
          'case_insensitive' : true,
          'show_only_matches': true
        },
        themes: {
          "theme": 'classic',
          "dots": false,
          "icons": false,
          "url": CRM.config.resourceBase + 'packages/jquery/plugins/jstree/themes/classic/style.css'
        },
        'plugins': ['themes', 'json_data', 'ui', 'search']
      }).bind('loaded.jstree', function () {
        $('.crm-designer-palette-field', this).draggable({
          appendTo: '.crm-designer',
          zIndex: $(this.$el).css("zIndex") + 5000,
          helper: 'clone',
          connectToSortable: '.crm-designer-fields' // FIXME: tight canvas/palette coupling
        });
        paletteView.model.getRel('ufFieldCollection').each(function(ufFieldModel) {
          paletteView.toggleActive(ufFieldModel, paletteView.model.getRel('ufFieldCollection'));
        });
        paletteView.$('.crm-designer-palette-add a').replaceWith('<button>' + $('.crm-designer-palette-add a').first().text() + '</<button>');
        paletteView.$('.crm-designer-palette-tree > ul').append('<li><button id="crm-designer-add-custom-set">+ ' + ts('Add Set of Custom Fields') + '</button></li>');
        paletteView.$('.crm-designer-palette-tree button').button();
      }).bind("select_node.jstree", function (e, data) {
        $(this).jstree("toggle_node", data.rslt.obj);
        $(this).jstree("deselect_node", data.rslt.obj);
      });

      // FIXME: tight canvas/palette coupling
      this.$(".crm-designer-fields").droppable({
        activeClass: "ui-state-default",
        hoverClass: "ui-state-hover",
        accept: ":not(.ui-sortable-helper)"
      });

      this.onResize();
    },
    onResize: function() {
      var pos = this.$('.crm-designer-palette-tree').position();
      var div = this.$('.crm-designer-palette-tree').closest('.crm-container').height();
      this.$('.crm-designer-palette-tree').css({height: div - pos.top});
    },
    doSearch: function(e) {
      var str = $(e.target).val();
      this.$('.crm-designer-palette-clear-search').css('visibility', str ? 'visible' : 'hidden');
      this.$('.crm-designer-palette-tree').jstree("search", str);
    },
    doSetPaletteEntity: function(event) {
      this.selectedContactType = $('.crm-contact-types :selected').val();
      // loop through entity collection and remove non-valid entity section's
      var newUfEntityModels = [];
      this.model.getRel('ufEntityCollection').each(function(oldUfEntityModel){
        var values = oldUfEntityModel.toJSON();
        if (values.entity_name == 'contact_1') {
          values.entity_type = $('.crm-contact-types :selected').val();
        }
        newUfEntityModels.push(new CRM.UF.UFEntityModel(values));
      });
      this.model.getRel('ufEntityCollection').reset(newUfEntityModels);
    },
    doAddToCanvas: function(event) {
      var paletteFieldModel = this.model.getRel('paletteFieldCollection').get($(event.currentTarget).attr('data-plm-cid'));
      paletteFieldModel.addToUFCollection(this.model.getRel('ufFieldCollection'));
      event.stopPropagation();
    },
    doNewCustomFieldDialog: function(e) {
      e.preventDefault();
      var paletteView = this;
      var entityKey = $(e.currentTarget).closest('.crm-designer-palette-section').attr('data-entity');
      var sectionKey = $(e.currentTarget).closest('.crm-designer-palette-section').attr('data-section');
      var ufEntityModel = paletteView.model.getRel('ufEntityCollection').getByName(entityKey);
      var sections = ufEntityModel.getSections();
      var url = CRM.url('civicrm/admin/custom/group/field/add', {
        reset: 1,
        action: 'add',
        gid: sections[sectionKey].custom_group_id
      });
      CRM.loadForm(url).on('crmFormSuccess', function(e, data) {
        paletteView.doRefresh('custom_' + data.id);
      });
    },
    doNewCustomSetDialog: function(e) {
      e.preventDefault();
      var paletteView = this;
      var url = CRM.url('civicrm/admin/custom/group', 'action=add&reset=1');
      // Create custom field set and automatically go to next step (create fields) after save button is clicked.
      CRM.loadForm(url, {refreshAction: ['next']})
        .on('crmFormSuccess', function(e, data) {
          // When form switches to create custom field context, modify button behavior to only continue for "save and new"
          if (data.customField) ($(this).data('civiCrmSnippet').options.crmForm.refreshAction = ['next_new']);
          paletteView.doRefresh(data.customField ? 'custom_' + data.id : null);
        });
    },
    doRefresh: function(fieldToAdd) {
      var ufGroupModel = this.model;
      this.getOpenTreeNodes();
      CRM.Schema.reloadModels()
        .done(function(data){
          ufGroupModel.resetEntities();
          if (fieldToAdd) {
            var field = ufGroupModel.getRel('paletteFieldCollection').getFieldByName(null, fieldToAdd);
            field.addToUFCollection(ufGroupModel.getRel('ufFieldCollection'));
          }
        })
        .fail(function() {
          CRM.alert(ts('Failed to retrieve schema'), ts('Error'), 'error');
        });
    },
    clearSearch: function(e) {
      e.preventDefault();
      $('.crm-designer-palette-search input').val('').keyup();
    },
    toggleActive: function(ufFieldModel, ufFieldCollection, options) {
      var paletteFieldCollection = this.model.getRel('paletteFieldCollection');
      var paletteFieldModel = paletteFieldCollection.getFieldByName(ufFieldModel.get('entity_name'), ufFieldModel.get('field_name'));
      var isAddable = ufFieldCollection.isAddable(ufFieldModel);
      if (paletteFieldModel) {
        this.$('[data-plm-cid='+paletteFieldModel.cid+']').toggleClass('disabled', !isAddable);
      }
    },
    toggleAll: function(e) {
      if (_.isEmpty($('.crm-designer-palette-search input').val())) {
        $('.crm-designer-palette-tree').jstree($(e.target).attr('rel'));
      }
      e.preventDefault();
    },
    getOpenTreeNodes: function() {
      var paletteView = this;
      this.openTreeNodes = [];
      this.$('.crm-designer-palette-section.jstree-open').each(function() {
        paletteView.openTreeNodes.push($(this).data('section'));
      });
    }
  });

  /**
   * Display all UFFieldModel objects in a UFGroupModel.
   *
   * options:
   *  - model: CRM.UF.UFGroupModel
   */
  CRM.Designer.UFFieldCanvasView = Backbone.Marionette.View.extend({
    initialize: function() {
      this.model.getRel('ufFieldCollection')
        .on('add', this.updatePlaceholder, this)
        .on('remove', this.updatePlaceholder, this)
        .on('add', this.addUFFieldView, this)
        .on('reset', this.render, this);
    },
    onClose: function() {
      this.model.getRel('ufFieldCollection')
        .off('add', this.updatePlaceholder, this)
        .off('remove', this.updatePlaceholder, this)
        .off('add', this.addUFFieldView, this)
        .off('reset', this.render, this);
    },
    render: function() {
      var ufFieldCanvasView = this;
      this.$el.html(_.template($('#field_canvas_view_template').html()));

      // BOTTOM: Setup field-level editing
      var $fields = this.$('.crm-designer-fields');
      this.updatePlaceholder();
      var ufFieldModels = this.model.getRel('ufFieldCollection').sortBy(function(ufFieldModel) {
        return parseInt(ufFieldModel.get('weight'));
      });
      _.each(ufFieldModels, function(ufFieldModel) {
        ufFieldCanvasView.addUFFieldView(ufFieldModel, ufFieldCanvasView.model.getRel('ufFieldCollection'), {skipWeights: true});
      });
      this.$(".crm-designer-fields").sortable({
        placeholder: 'crm-designer-row-placeholder',
        forcePlaceholderSize: true,
        cancel: 'input,textarea,button,select,option,a,.crm-designer-open',
        receive: function(event, ui) {
          var paletteFieldModel = ufFieldCanvasView.model.getRel('paletteFieldCollection').get(ui.item.attr('data-plm-cid'));
          var ufFieldModel = paletteFieldModel.addToUFCollection(
            ufFieldCanvasView.model.getRel('ufFieldCollection'),
            {skipWeights: true}
          );
          if (_.isEmpty(ufFieldModel)) {
            ufFieldCanvasView.$('.crm-designer-fields .ui-draggable').remove();
          } else {
            // Move from end to the 'dropped' position
            var ufFieldViewEl = ufFieldCanvasView.$('div[data-field-cid='+ufFieldModel.cid+']').parent();
            ufFieldCanvasView.$('.crm-designer-fields .ui-draggable').replaceWith(ufFieldViewEl);
          }
          // note: the sortable() update callback will call updateWeight
        },
        update: function() {
          ufFieldCanvasView.updateWeights();
        }
      });
    },
    /** Determine visual order of fields and set the model values for "weight" */
    updateWeights: function() {
      var ufFieldCanvasView = this;
      var weight = 1;
      var rows = this.$('.crm-designer-row').each(function(key, row) {
        if ($(row).hasClass('placeholder')) {
          return;
        }
        var ufFieldCid = $(row).attr('data-field-cid');
        var ufFieldModel = ufFieldCanvasView.model.getRel('ufFieldCollection').get(ufFieldCid);
        ufFieldModel.set('weight', weight);
        weight++;
      });
    },
    addUFFieldView: function(ufFieldModel, ufFieldCollection, options) {
      var paletteFieldModel = this.model.getRel('paletteFieldCollection').getFieldByName(ufFieldModel.get('entity_name'), ufFieldModel.get('field_name'));
      var ufFieldView = new CRM.Designer.UFFieldView({
        el: $("<div></div>"),
        model: ufFieldModel,
        paletteFieldModel: paletteFieldModel
      });
      ufFieldView.render();
      this.$('.crm-designer-fields').append(ufFieldView.$el);
      if (! (options && options.skipWeights)) {
        this.updateWeights();
      }
    },
    updatePlaceholder: function() {
      if (this.model.getRel('ufFieldCollection').isEmpty()) {
        this.$('.placeholder').css({display: 'block', border: '0 none', cursor: 'default'});
      } else {
        this.$('.placeholder').hide();
      }
    }
  });

  /**
   * options:
   * - model: CRM.UF.UFFieldModel
   * - paletteFieldModel: CRM.Designer.PaletteFieldModel
   */
  CRM.Designer.UFFieldView = Backbone.Marionette.Layout.extend({
    serializeData: extendedSerializeData,
    template: '#field_row_template',
    expanded: false,
    regions: {
      summary: '.crm-designer-field-summary',
      detail: '.crm-designer-field-detail'
    },
    events: {
      "click .crm-designer-action-settings": 'doToggleForm',
      "click button.crm-designer-edit-custom": 'doEditCustomField',
      "click .crm-designer-action-remove": 'doRemove'
    },
    modelEvents: {
      "destroy": 'remove',
      "change:is_duplicate": 'onChangeIsDuplicate'
    },
    onRender: function() {
      this.summary.show(new CRM.Designer.UFFieldSummaryView({
        model: this.model,
        fieldSchema: this.model.getFieldSchema(),
        paletteFieldModel: this.options.paletteFieldModel
      }));
      this.detail.show(new CRM.Designer.UFFieldDetailView({
        model: this.model,
        fieldSchema: this.model.getFieldSchema()
      }));
      this.onChangeIsDuplicate(this.model, this.model.get('is_duplicate'));
      if (!this.expanded) {
        this.detail.$el.hide();
      }
      var that = this;
      CRM.designerApp.vent.on('formOpened', function(event) {
        if (that.expanded && event != that.cid) {
          that.doToggleForm(false);
        }
      });
    },
    doToggleForm: function(event) {
      this.expanded = !this.expanded;
      if (this.expanded && event !== false) {
        CRM.designerApp.vent.trigger('formOpened', this.cid);
      }
      this.$el.toggleClass('crm-designer-open', this.expanded);
      var $detail = this.detail.$el;
      if (!this.expanded) {
        $detail.toggle('blind', 250);
        this.$('button.crm-designer-edit-custom').remove();
      }
      else {
        var $canvas = $('.crm-designer-canvas');
        var top = $canvas.offset().top;
        $detail.slideDown({
          duration: 250,
          step: function(num, effect) {
            // Scroll canvas to keep field details visible
            if (effect.prop == 'height') {
              if (effect.now + $detail.offset().top - top > $canvas.height() - 9) {
                $canvas.scrollTop($canvas.scrollTop() + effect.now + $detail.offset().top - top - $canvas.height() + 9);
              }
            }
          }
        });
        if (this.model.get('field_name').split('_')[0] == 'custom') {
          this.$('.crm-designer-field-summary > div').append('<button class="crm-designer-edit-custom">' + ts('Edit Custom Field') + '</button>');
          this.$('button.crm-designer-edit-custom').button({icons: {primary: 'fa-pencil'}}).attr('title', ts('Edit global settings for this custom field.'));
        }
      }
    },
    doEditCustomField: function(e) {
      e.preventDefault();
      var url = CRM.url('civicrm/admin/custom/group/field/update', {
        action: 'update',
        reset: 1,
        id: this.model.get('field_name').split('_')[1]
      });
      var form1 = CRM.loadForm(url)
        .on('crmFormLoad', function() {
          $(this).prepend('<div class="messages status"><i class="crm-i fa-info-circle"></i> ' + ts('Note: This will modify the field system-wide, not just in this profile form.') + '</div>');
        });
    },
    onChangeIsDuplicate: function(model, value, options) {
      this.$el.toggleClass('crm-designer-duplicate', value);
    },
    doRemove: function(event) {
      var that = this;
      this.$el.hide(250, function() {
        that.model.destroyLocal();
      });
    }
  });

  /**
   * options:
   * - model: CRM.UF.UFFieldModel
   * - fieldSchema: (Backbone.Form schema element)
   * - paletteFieldModel: CRM.Designer.PaletteFieldModel
   */
  CRM.Designer.UFFieldSummaryView = Backbone.Marionette.ItemView.extend({
    serializeData: extendedSerializeData,
    template: '#field_summary_template',
    modelEvents: {
      'change': 'render'
    },

    /**
     * Compose a printable string which describes the binding of this UFField to the data model
     * @return {String}
     */
    getBindingLabel: function() {
      var result = this.options.paletteFieldModel.getSection().title + ": " + this.options.paletteFieldModel.getLabel();
      if (this.options.fieldSchema.civiIsPhone) {
        result = result + '-' + CRM.PseudoConstant.phoneType[this.model.get('phone_type_id')];
      }
      if (this.options.fieldSchema.civiIsWebsite) {
        result = result + '-' + CRM.PseudoConstant.websiteType[this.model.get('website_type_id')];
      }
      if (this.options.fieldSchema.civiIsLocation) {
        var locType = this.model.get('location_type_id') ? CRM.PseudoConstant.locationType[this.model.get('location_type_id')] : ts('Primary');
        result = result + ' (' + locType + ')';
      }
      return result;
    },

    /**
     * Return a string marking if the field is required
     * @return {String}
     */
    getRequiredMarker: function() {
      if (this.model.get('is_required') == 1) {
        return ' <span class="crm-marker">*</span> ';
      }
      return '';
    },

    onRender: function() {
      this.$el.toggleClass('disabled', this.model.get('is_active') != 1);
      if (this.model.get("is_reserved") == 1) {
        this.$('.crm-designer-buttons').hide();
      }
    }
  });

  /**
   * options:
   * - model: CRM.UF.UFFieldModel
   * - fieldSchema: (Backbone.Form schema element)
   */
  CRM.Designer.UFFieldDetailView = Backbone.View.extend({
    initialize: function() {
      // FIXME: hide/display 'in_selector' if 'visibility' is one of the public options
      var fields = ['location_type_id', 'website_type_id', 'phone_type_id', 'label', 'is_multi_summary', 'is_required', 'is_view', 'visibility', 'in_selector', 'is_searchable', 'help_pre', 'help_post', 'is_active'];
      if (! this.options.fieldSchema.civiIsLocation) {
        fields = _.without(fields, 'location_type_id');
      }
      if (! this.options.fieldSchema.civiIsWebsite) {
        fields = _.without(fields, 'website_type_id');
      }
      if (! this.options.fieldSchema.civiIsPhone) {
        fields = _.without(fields, 'phone_type_id');
      }
      if (!this.options.fieldSchema.civiIsMultiple) {
        fields = _.without(fields, 'is_multi_summary');
      }
      if (this.options.fieldSchema.type == 'Markup') {
        fields = _.without(fields, 'is_required', 'is_view', 'visibility', 'in_selector', 'is_searchable', 'help_post');
      }

      this.form = new Backbone.Form({
        model: this.model,
        fields: fields
      });
      this.form.on('change', this.onFormChange, this);
      this.model.on('change', this.onModelChange, this);
    },
    render: function() {
      this.$el.html(this.form.render().el);
      this.onFormChange();
    },
    onModelChange: function() {
      $.each(this.form.fields, function(i, field) {
        this.form.setValue(field.key, this.model.get(field.key));
      });
    },
    onFormChange: function() {
      this.form.commit();
      this.$('.field-is_multi_summary').toggle(this.options.fieldSchema.civiIsMultiple ? true : false);
      this.$('.field-in_selector').toggle(this.model.isInSelectorAllowed());

      if (!this.model.isInSelectorAllowed() && this.model.get('in_selector') != "0") {
        this.model.set('in_selector', "0");
        if (this.form.fields.in_selector) {
          this.form.setValue('in_selector', "0");
        }
        // TODO: It might be nicer if we didn't completely discard in_selector -- e.g.
        // if the value could be restored when the user isInSelectorAllowed becomes true
        // again. However, I haven't found a simple way to do this.
      }
    }
  });

  /**
   * options:
   * - model: CRM.UF.UFGroupModel
   */
  CRM.Designer.UFGroupView = Backbone.Marionette.Layout.extend({
    serializeData: extendedSerializeData,
    template: '#form_row_template',
    expanded: false,
    regions: {
      summary: '.crm-designer-form-summary',
      detail: '.crm-designer-form-detail'
    },
    events: {
      "click .crm-designer-action-settings": 'doToggleForm'
    },
    onRender: function() {
      this.summary.show(new CRM.Designer.UFGroupSummaryView({
        model: this.model
      }));
      this.detail.show(new CRM.Designer.UFGroupDetailView({
        model: this.model
      }));
      if (!this.expanded) {
        this.detail.$el.hide();
      }
      var that = this;
      CRM.designerApp.vent.on('formOpened', function(event) {
        if (that.expanded && event !== 0) {
          that.doToggleForm(false);
        }
      });
    },
    doToggleForm: function(event) {
      this.expanded = !this.expanded;
      if (this.expanded && event !== false) {
        CRM.designerApp.vent.trigger('formOpened', 0);
      }
      this.$el.toggleClass('crm-designer-open', this.expanded);
      this.detail.$el.toggle('blind', 250);
    }
  });

  /**
   * options:
   * - model: CRM.UF.UFGroupModel
   */
  CRM.Designer.UFGroupSummaryView = Backbone.Marionette.ItemView.extend({
    serializeData: extendedSerializeData,
    template: '#form_summary_template',
    modelEvents: {
      'change': 'render'
    },
    onRender: function() {
      this.$el.toggleClass('disabled', this.model.get('is_active') != 1);
      if (this.model.get("is_reserved") == 1) {
        this.$('.crm-designer-buttons').hide();
      }
    }
  });

  /**
   * options:
   * - model: CRM.UF.UFGroupModel
   */
  CRM.Designer.UFGroupDetailView = Backbone.View.extend({
    initialize: function() {
      this.form = new Backbone.Form({
        model: this.model,
        fields: ['title', 'frontend_title', 'help_pre', 'help_post', 'is_active']
      });
      this.form.on('change', this.form.commit, this.form);
    },
    render: function() {
      this.$el.html(this.form.render().el);
    }
  });

})(CRM.$, CRM._, CRM.BB);
;
(function($, _, Backbone) {
  if (!CRM.ProfileSelector) CRM.ProfileSelector = {};

  CRM.ProfileSelector.Option = Backbone.Marionette.ItemView.extend({
    template: '#profile_selector_option_template',
    tagName: 'option',
    modelEvents: {
      'change:title': 'render'
    },
    onRender: function() {
      this.$el.attr('value', this.model.get('id'));
    }
  });

  CRM.ProfileSelector.Select = Backbone.Marionette.CollectionView.extend({
    tagName: 'select',
    itemView: CRM.ProfileSelector.Option
  });

  /**
   * Render a pane with 'Select/Preview/Edit/Copy/Create' functionality for profiles.
   *
   * Note: This view works with a ufGroupCollection, and it creates popups for a
   * ufGroupModel. These are related but not facilely. The ufGroupModels in the
   * ufGroupCollection are never passed to the popup, and the models from the
   * popup are never added to the collection. This is because the popup works
   * with temporary, local copies -- but the collection reflects the actual list
   * on the server.
   *
   * options:
   *  - ufGroupId: int, the default selection
   *  - ufGroupCollection: the profiles which can be selected
   *  - ufEntities: hard-coded entity list used with any new/existing forms
   *    (this may be removed when the form-runtime is updated to support hand-picking
   *    entities for each form)
   */
  CRM.ProfileSelector.View = Backbone.Marionette.Layout.extend({
    template: '#profile_selector_template',
    regions: {
      selectRegion: '.crm-profile-selector-select'
    },
    events: {
      'change .crm-profile-selector-select select': 'onChangeUfGroupId',
      'click .crm-profile-selector-edit': 'doEdit',
      'click .crm-profile-selector-copy': 'doCopy',
      'click .crm-profile-selector-create': 'doCreate',
      'click .crm-profile-selector-preview': 'doShowPreview',
      // prevent interaction with preview form
      'click .crm-profile-selector-preview-pane': false,
      'crmLoad .crm-profile-selector-preview-pane': 'disableForm'
    },
    /** @var Marionette.View which specifically builds on jQuery-UI's dialog */
    activeDialog: null,
    onRender: function() {
      var view = new CRM.ProfileSelector.Select({
        collection: this.options.ufGroupCollection
      });
      this.selectRegion.show(view);
      this.setUfGroupId(this.options.ufGroupId, {silent: true});
      this.toggleButtons();
      this.$('.crm-profile-selector-select select').css('width', '25em').crmSelect2();
      this.doShowPreview();
    },
    onChangeUfGroupId: function(event) {
      this.options.ufGroupId = $(event.target).val();
      this.trigger('change:ufGroupId', this);
      this.toggleButtons();
      this.doPreview();
    },
    toggleButtons: function() {
      this.$('.crm-profile-selector-edit,.crm-profile-selector-copy').prop('disabled', !this.hasUfGroupId());
    },
    hasUfGroupId: function() {
      return (this.getUfGroupId() && this.getUfGroupId() !== '') ? true : false;
    },
    setUfGroupId: function(value, options) {
      this.options.ufGroupId = value;
      this.$('.crm-profile-selector-select select').val(value);
      this.$('.crm-profile-selector-select select').select2('val', value, (!options || !options.silent));
    },
    getUfGroupId: function() {
      return this.options.ufGroupId;
    },
    doPreview: function() {
      var $pane = this.$('.crm-profile-selector-preview-pane');
      if (!this.hasUfGroupId()) {
        $pane.html($('#profile_selector_empty_preview_template').html());
      } else {
        CRM.loadPage(CRM.url("civicrm/ajax/inline", {class_name: 'CRM_UF_Form_Inline_PreviewById', id: this.getUfGroupId()}), {target: $pane});
      }
    },
    doShowPreview: function() {
      var $preview = this.$('.crm-profile-selector-preview');
      var $pane = this.$('.crm-profile-selector-preview-pane');
      if ($preview.hasClass('crm-profile-selector-preview-show')) {
        $preview.removeClass('crm-profile-selector-preview-show');
        $preview.find('.crm-i').removeClass('fa-television').addClass('fa-times');
        $pane.show();
      } else {
        $preview.addClass('crm-profile-selector-preview-show');
        $preview.find('.crm-i').removeClass('fa-times').addClass('fa-television');
        $pane.hide();
      }
    },
    disableForm: function() {
      this.$(':input', '.crm-profile-selector-preview-pane').not('.select2-input').prop('readOnly', true);
    },
    doEdit: function(e) {
      e.preventDefault();
      var profileSelectorView = this;
      var designerDialog = new CRM.Designer.DesignerDialog({
        findCreateUfGroupModel: function(options) {
          var ufId = profileSelectorView.getUfGroupId();
          // Retrieve UF group and fields from the api
          CRM.api('UFGroup', 'getsingle', {id: ufId, "api.UFField.get": 1}, {
            success: function(formData) {
              // Note: With chaining, API returns some extraneous keys that aren't part of UFGroupModel
              var ufGroupModel = new CRM.UF.UFGroupModel(_.pick(formData, _.keys(CRM.UF.UFGroupModel.prototype.schema)));
              ufGroupModel.setUFGroupModel(ufGroupModel.calculateContactEntityType(), profileSelectorView.options.ufEntities);
              ufGroupModel.getRel('ufFieldCollection').reset(_.values(formData["api.UFField.get"].values));
              options.onLoad(ufGroupModel);
            }
          });
        }
      });
      CRM.designerApp.vent.on('ufSaved', this.onSave, this);
      this.setDialog(designerDialog);
    },
    doCopy: function(e) {
      e.preventDefault();
      // This is largely the same as doEdit, but we ultimately pass in a deepCopy of the ufGroupModel.
      var profileSelectorView = this;
      var designerDialog = new CRM.Designer.DesignerDialog({
        findCreateUfGroupModel: function(options) {
          var ufId = profileSelectorView.getUfGroupId();
          // Retrieve UF group and fields from the api
          CRM.api('UFGroup', 'getsingle', {id: ufId, "api.UFField.get": 1}, {
            success: function(formData) {
              // Note: With chaining, API returns some extraneous keys that aren't part of UFGroupModel
              var ufGroupModel = new CRM.UF.UFGroupModel(_.pick(formData, _.keys(CRM.UF.UFGroupModel.prototype.schema)));
              ufGroupModel.setUFGroupModel(ufGroupModel.calculateContactEntityType(), profileSelectorView.options.ufEntities);
              ufGroupModel.getRel('ufFieldCollection').reset(_.values(formData["api.UFField.get"].values));
              options.onLoad(ufGroupModel.deepCopy());
            }
          });
        }
      });
      CRM.designerApp.vent.on('ufSaved', this.onSave, this);
      this.setDialog(designerDialog);
    },
    doCreate: function(e) {
      e.preventDefault();
      var profileSelectorView = this;
      var designerDialog = new CRM.Designer.DesignerDialog({
        findCreateUfGroupModel: function(options) {
          // Initialize new UF group
          var ufGroupModel = new CRM.UF.UFGroupModel();
          ufGroupModel.getRel('ufEntityCollection').reset(profileSelectorView.options.ufEntities);
          options.onLoad(ufGroupModel);
        }
      });
      CRM.designerApp.vent.on('ufSaved', this.onSave, this);
      this.setDialog(designerDialog);
    },
    onSave: function() {
      CRM.designerApp.vent.off('ufSaved', this.onSave, this);
      var ufGroupId = this.activeDialog.model.get('id');
      var modelFromCollection = this.options.ufGroupCollection.get(ufGroupId);
      if (modelFromCollection) {
        // copy in changes to UFGroup
        modelFromCollection.set(this.activeDialog.model.toStrictJSON());
      } else {
        // add in new UFGroup
        modelFromCollection = new CRM.UF.UFGroupModel(this.activeDialog.model.toStrictJSON());
        this.options.ufGroupCollection.add(modelFromCollection);
      }
      this.setUfGroupId(ufGroupId);
      this.doPreview();
    },
    setDialog: function(view) {
      if (this.activeDialog) {
        this.activeDialog.close();
      }
      this.activeDialog = view;
      view.render();
    }
  });
})(CRM.$, CRM._, CRM.BB);
;
(function ($, _, Backbone) {
  $(function () {
    /**
     * FIXME we depend on this being a global singleton, mainly to facilitate vents
     *
     * vents:
     * - resize: the size/position of widgets should be adjusted
     * - ufUnsaved: any part of a UFGroup was changed; args: (is_changed:bool)
     * - formOpened: a toggleable form (such as a UFFieldView or a UFGroupView) has been opened
     */
    CRM.designerApp = new Backbone.Marionette.Application();

    /**
     * FIXME: Workaround for problem that having more than one instance
     * of a profile on the page will result in duplicate DOM ids.
     * @see CRM-12188
     */
    CRM.designerApp.clearPreviewArea = function () {
      $('.crm-profile-selector-preview-pane > *').each(function () {
        var parent = $(this).parent();
        CRM.designerApp.DetachedProfiles.push({
          parent: parent,
          item: $(this).detach()
        });
      });
    };
    CRM.designerApp.restorePreviewArea = function () {
      $.each(CRM.designerApp.DetachedProfiles, function () {
        $(this.parent).append(this.item);
      });
    };
  });
})(CRM.$, CRM._, CRM.BB);
;
(function($, _) {
  var ufGroupCollection = new CRM.UF.UFGroupCollection(_.sortBy(CRM.initialProfileList.values, 'title'));
  //var ufGroupCollection = new CRM.UF.UFGroupCollection(CRM.initialProfileList.values, {
  //  comparator: 'title' // no point, this doesn't work with subcollections
  //});
  ufGroupCollection.unshift(new CRM.UF.UFGroupModel({
    id: '',
    title: ts('- select -')
  }));

  /**
   * Example:
   * <input type="text" value="{$profileId}" class="crm-profile-selector" />
   * ...
   * cj('.crm-profile-selector').crmProfileSelector({
   *   groupTypeFilter: "Contact,Individual,Activity;;ActivityType:7",
   *   entities: "contact_1:IndividualModel,activity_1:ActivityModel"
   * });
   *
   * Note: The system does not currently support dynamic entities -- it only supports
   * a couple of entities named "contact_1" and "activity_1". See also
   * CRM.UF.guessEntityName().
   */
  $.fn.crmProfileSelector = function(options) {
    return this.each(function() {
      // Hide the existing <SELECT> and instead construct a ProfileSelector view.
      // Keep them synchronized.
      var matchingUfGroups,
        $select = $(this).hide().addClass('rendered');

      var validTypesId = [];
      var usedByFilter = null;
      if (options.groupTypeFilter) {
        matchingUfGroups = ufGroupCollection.subcollection({
          filter: function(ufGroupModel) {
            //CRM-16915 - filter with module used by the profile
            if (options.usedByFilter && options.usedByFilter.length) {
              usedByFilter = options.usedByFilter;
            }
            return ufGroupModel.checkGroupType(options.groupTypeFilter, options.allowAllSubtypes, usedByFilter);
          }
        });
      } else {
        matchingUfGroups = ufGroupCollection;
      }

      //CRM-15427 check for valid subtypes raise a warning if not valid
      if (options.allowAllSubtypes && !validTypesId.length) {
        validTypes = ufGroupCollection.subcollection({
          filter: function(ufGroupModel) {
            return ufGroupModel.checkGroupType(options.groupTypeFilter);
          }
        });
        _.each(validTypes.models, function(validTypesattr) {
          validTypesId.push(validTypesattr.id);
        });
      }
      if (validTypesId.length && $.inArray($select.val(), validTypesId) == -1) {
        var civiComponent;
        if (options.groupTypeFilter.indexOf('Membership') !== -1) {
          civiComponent = 'Membership';
        }
        else if (options.groupTypeFilter.indexOf('Participant') !== -1) {
          civiComponent = 'Event';
        }
        else {
          civiComponent = 'Contribution';
        }
        CRM.alert(ts('The selected profile is using a custom field which is not assigned to the "%1" being configured.', {1: civiComponent}), ts('Warning'));
      }
      var view = new CRM.ProfileSelector.View({
        ufGroupId: $select.val(),
        ufGroupCollection: matchingUfGroups,
        ufEntities: options.entities
      });
      view.on('change:ufGroupId', function() {
        $select.val(view.getUfGroupId()).change();
      });
      view.render();
      $select.after(view.el);
      setTimeout(function() {
        view.doPreview();
      }, 100);
    });
  };

  $('#crm-container').on('crmLoad', function() {
    $('.crm-profile-selector:not(.rendered)', this).each(function() {
      $(this).crmProfileSelector({
        groupTypeFilter: $(this).data('groupType'),
        entities: $(this).data('entities'),
        //CRM-15427
        allowAllSubtypes: $(this).data('default'),
        usedByFilter: $(this).data('usedfor')
      });
    });
  });

})(CRM.$, CRM._);
;
