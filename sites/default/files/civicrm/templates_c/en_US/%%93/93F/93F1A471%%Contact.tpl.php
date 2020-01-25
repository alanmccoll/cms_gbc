<?php /* Smarty version 2.6.31, created on 2020-01-06 16:35:47
         compiled from CRM/Contact/Form/Contact.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Contact/Form/Contact.tpl', 1, false),array('block', 'ts', 'CRM/Contact/Form/Contact.tpl', 35, false),array('function', 'crmURL', 'CRM/Contact/Form/Contact.tpl', 35, false),array('function', 'help', 'CRM/Contact/Form/Contact.tpl', 58, false),array('modifier', 'crmAddClass', 'CRM/Contact/Form/Contact.tpl', 59, false),array('modifier', 'intval', 'CRM/Contact/Form/Contact.tpl', 115, false),array('modifier', 'json_encode', 'CRM/Contact/Form/Contact.tpl', 266, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['addBlock']): ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Contact/Form/Edit/".($this->_tpl_vars['blockName']).".tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>
  <?php if ($this->_tpl_vars['contactId']): ?>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Contact/Form/Edit/Lock.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <?php endif; ?>
  <div class="crm-form-block crm-search-form-block">
    <?php if (call_user_func ( array ( 'CRM_Core_Permission' , 'check' ) , 'administer CiviCRM' )): ?>
      <a href='<?php echo CRM_Utils_System::crmURL(array('p' => "civicrm/admin/setting/preferences/display",'q' => "reset=1"), $this);?>
' title="<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Click here to configure the panes.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><i class="crm-i fa-wrench"></i></a>
    <?php endif; ?>
    <span style="float:right;"><a href="#expand" id="expand"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Expand all tabs<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></span>
    <div class="crm-submit-buttons">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/common/formButtons.tpl", 'smarty_include_vars' => array('location' => 'top')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>

    <div class="crm-accordion-wrapper crm-contactDetails-accordion">
      <div class="crm-accordion-header">
        <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Contact Details<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      </div><!-- /.crm-accordion-header -->
      <div class="crm-accordion-body" id="contactDetails">
        <div id="contactDetails">
          <div class="crm-section contact_basic_information-section">
          <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Contact/Form/Edit/".($this->_tpl_vars['contactType']).".tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </div>
          <table class="crm-section contact_information-section form-layout-compressed">
            <?php $_from = $this->_tpl_vars['blocks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['block'] => $this->_tpl_vars['label']):
?>
              <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Contact/Form/Edit/".($this->_tpl_vars['block']).".tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
            <?php endforeach; endif; unset($_from); ?>
          </table>
          <table class="crm-section contact_source-section form-layout-compressed">
            <tr class="last-row">
              <td><?php echo $this->_tpl_vars['form']['contact_source']['label']; ?>
 <?php echo smarty_function_help(array('id' => "id-source"), $this);?>
<br />
                <?php echo ((is_array($_tmp=$this->_tpl_vars['form']['contact_source']['html'])) ? $this->_run_mod_handler('crmAddClass', true, $_tmp, 'twenty') : smarty_modifier_crmAddClass($_tmp, 'twenty')); ?>

              </td>
              <td><?php echo $this->_tpl_vars['form']['external_identifier']['label']; ?>
&nbsp;<?php echo smarty_function_help(array('id' => "id-external-id"), $this);?>
<br />
                <?php echo $this->_tpl_vars['form']['external_identifier']['html']; ?>

              </td>
              <?php if ($this->_tpl_vars['contactId']): ?>
                <td>
                  <label for="internal_identifier_display"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Contact ID<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php echo smarty_function_help(array('id' => "id-contact-id"), $this);?>
</label><br />
                  <input id="internal_identifier_display" type="text" class="crm-form-text six" size="6" readonly="readonly" value="<?php echo $this->_tpl_vars['contactId']; ?>
">
                </td>
              <?php endif; ?>
            </tr>
          </table>
          <table class="image_URL-section form-layout-compressed">
            <tr>
              <td>
                <?php echo $this->_tpl_vars['form']['image_URL']['label']; ?>
&nbsp;&nbsp;<?php echo smarty_function_help(array('id' => "id-upload-image",'file' => "CRM/Contact/Form/Contact.hlp"), $this);?>
<br />
                <?php echo ((is_array($_tmp=$this->_tpl_vars['form']['image_URL']['html'])) ? $this->_run_mod_handler('crmAddClass', true, $_tmp, 'twenty') : smarty_modifier_crmAddClass($_tmp, 'twenty')); ?>

                <?php if (! empty ( $this->_tpl_vars['imageURL'] )): ?>
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Contact/Page/ContactImage.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                <?php endif; ?>
              </td>
            </tr>
          </table>

                    <span class="crm-button crm-button_qf_Contact_refresh_dedupe">
            <?php echo $this->_tpl_vars['form']['_qf_Contact_refresh_dedupe']['html']; ?>

          </span>
          <?php if ($this->_tpl_vars['isDuplicate']): ?>
            &nbsp;&nbsp;
              <span class="crm-button crm-button_qf_Contact_upload_duplicate">
                <?php echo $this->_tpl_vars['form']['_qf_Contact_upload_duplicate']['html']; ?>

              </span>
          <?php endif; ?>
          <div class="spacer"></div>
        </div>
      </div><!-- /.crm-accordion-body -->
    </div><!-- /.crm-accordion-wrapper -->

    <?php $_from = $this->_tpl_vars['editOptions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['name'] => $this->_tpl_vars['title']):
?>
      <?php if ($this->_tpl_vars['name'] == 'CustomData'): ?>
        <div id='customData'><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Contact/Form/Edit/CustomData.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
      <?php else: ?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Contact/Form/Edit/".($this->_tpl_vars['name']).".tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
      <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
    <div class="crm-submit-buttons">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/common/formButtons.tpl", 'smarty_include_vars' => array('location' => 'bottom')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>
  </div>
  <?php echo '

  <script type="text/javascript" >
  CRM.$(function($) {
    var $form = $("form.'; ?>
<?php echo $this->_tpl_vars['form']['formClass']; ?>
<?php echo '"),
      action = '; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['action'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
<?php echo ',
      cid = '; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['contactId'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
<?php echo ',
      _ = CRM._;

    $(\'.crm-accordion-body\').each( function() {
      //remove tab which doesn\'t have any element
      if ( ! $.trim( $(this).text() ) ) {
        ele     = $(this);
        prevEle = $(this).prev();
        $(ele).remove();
        $(prevEle).remove();
      }
      //open tab if form rule throws error
      if ( $(this).children().find(\'span.crm-error\').text().length > 0 ) {
        $(this).parents(\'.collapsed\').crmAccordionToggle();
      }
    });
    if (action === 2) {
      $(\'.crm-accordion-wrapper\').not(\'.crm-accordion-wrapper .crm-accordion-wrapper\').each(function() {
        highlightTabs(this);
      });
      $(\'#crm-container\').on(\'change click\', \'.crm-accordion-body :input, .crm-accordion-body a\', function() {
        highlightTabs($(this).parents(\'.crm-accordion-wrapper\'));
      });
    }
    function highlightTabs(tab) {
      //highlight the tab having data inside.
      $(\'.crm-accordion-body :input\', tab).each( function() {
        var active = false;
          switch($(this).prop(\'type\')) {
            case \'checkbox\':
            case \'radio\':
              if($(this).is(\':checked\') && !$(this).is(\'[id$=IsPrimary],[id$=IsBilling]\')) {
                $(\'.crm-accordion-header:first\', tab).addClass(\'active\');
                return false;
              }
              break;

            case \'text\':
            case \'textarea\':
              if($(this).val()) {
                $(\'.crm-accordion-header:first\', tab).addClass(\'active\');
                return false;
              }
              break;

            case \'select-one\':
            case \'select-multiple\':
              if($(this).val() && $(\'option[value=""]\', this).length > 0) {
                $(\'.crm-accordion-header:first\', tab).addClass(\'active\');
                return false;
              }
              break;

            case \'file\':
              if($(this).next().html()) {
                $(\'.crm-accordion-header:first\', tab).addClass(\'active\');
                return false;
              }
              break;
          }
          $(\'.crm-accordion-header:first\', tab).removeClass(\'active\');
      });
    }

    $(\'a#expand\').click( function() {
      if( $(this).attr(\'href\') == \'#expand\') {
        var message = '; ?>
"<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Collapse all tabs<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"<?php echo ';
        $(this).attr(\'href\', \'#collapse\');
        $(\'.crm-accordion-wrapper.collapsed\').crmAccordionToggle();
      }
      else {
        var message = '; ?>
"<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Expand all tabs<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"<?php echo ';
        $(\'.crm-accordion-wrapper:not(.collapsed)\').crmAccordionToggle();
        $(this).attr(\'href\', \'#expand\');
      }
      $(this).html(message);
      return false;
    });

    $(\'.customDataPresent\').change(function() {
      var values = $("#contact_sub_type").val();
      CRM.buildCustomData('; ?>
"<?php echo $this->_tpl_vars['contactType']; ?>
"<?php echo ', values).one(\'crmLoad\', function() {
        highlightTabs(this);
        loadMultiRecordFields(values);
      });
    });

    function loadMultiRecordFields(subTypeValues) {
      if (subTypeValues === false) {
        subTypeValues = null;
      }
      else if (!subTypeValues) {
        subTypeValues = '; ?>
"<?php echo $this->_tpl_vars['paramSubType']; ?>
"<?php echo ';
      }
      function loadNextRecord(i, groupValue, groupCount) {
        if (i < groupCount) {
          CRM.buildCustomData('; ?>
"<?php echo $this->_tpl_vars['contactType']; ?>
"<?php echo ', subTypeValues, null, i, groupValue, true).one(\'crmLoad\', function() {
            highlightTabs(this);
            loadNextRecord(i+1, groupValue, groupCount);
          });
        }
      }
      '; ?>

      <?php $_from = $this->_tpl_vars['customValueCount']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['groupValue'] => $this->_tpl_vars['groupCount']):
?>
      <?php if ($this->_tpl_vars['groupValue']): ?><?php echo '
        loadNextRecord(1, '; ?>
<?php echo $this->_tpl_vars['groupValue']; ?>
<?php echo ', '; ?>
<?php echo $this->_tpl_vars['groupCount']; ?>
<?php echo ');
      '; ?>

      <?php endif; ?>
      <?php endforeach; endif; unset($_from); ?>
      <?php echo '
    }

    loadMultiRecordFields();

    '; ?>
<?php if ($this->_tpl_vars['oldSubtypes']): ?><?php echo '
    $(\'input[name=_qf_Contact_upload_view], input[name=_qf_Contact_upload_new]\').click(function() {
      var submittedSubtypes = $(\'#contact_sub_type\').val();
      var oldSubtypes = '; ?>
<?php echo $this->_tpl_vars['oldSubtypes']; ?>
<?php echo ';

      var warning = false;
      $.each(oldSubtypes, function(index, subtype) {
        if ( $.inArray(subtype, submittedSubtypes) < 0 ) {
          warning = true;
        }
      });
      if ( warning ) {
        return confirm('; ?>
'<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>One or more contact subtypes have been de-selected from the list for this contact. Any custom data associated with de-selected subtype will be removed as long as the contact does not have a contact subtype still selected. Click OK to proceed, or Cancel to review your changes before saving.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>'<?php echo ');
      }
      return true;
    });
    '; ?>
<?php endif; ?><?php echo '

    // Handle delete of multi-record custom data
    $form.on(\'click\', \'.crm-custom-value-del\', function(e) {
      e.preventDefault();
      var $el = $(this),
        msg = \''; ?>
<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>The record will be deleted immediately. This action cannot be undone.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\';
      CRM.confirm({title: $el.attr(\'title\'), message: msg})
        .on(\'crmConfirm:yes\', function() {
          var url = CRM.url(\'civicrm/ajax/customvalue\');
          var request = $.post(url, $el.data(\'post\'));
          CRM.status({success: \''; ?>
<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Record Deleted<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\'}, request);
          var addClass = \'.add-more-link-\' + $el.data(\'post\').groupID;
          $el.closest(\'div.crm-custom-accordion\').remove();
          $(\'div\' + addClass).last().show();
        });
    });

    '; ?>
    <?php if ($this->_tpl_vars['checkSimilar'] == 1): ?>
    var contactType = <?php echo json_encode($this->_tpl_vars['contactType']); ?>
,
      rules = <?php echo '[
        \'first_name\',
        \'last_name\',
        \'nick_name\',
        \'household_name\',
        \'organization_name\',
        \'email\'
      ],
      ruleFields = {},
      $ruleElements = $(),
      matchMessage,
      dupeTpl = _.template($(\'#duplicates-msg-tpl\').html()),
      runningCheck = 0;
    $.each(rules, function(i, field) {
      // Match regular fields
      var $el = $(\'#\' + field + \', #\' + field + \'_1_\' + field, $form).filter(\':input\');
      // Match custom fields
      if (!$el.length && field.lastIndexOf(\'_\') > 0) {
        var pieces = field.split(\'_\');
        field = \'custom_\' + pieces[pieces.length-1];
        $el = $(\'#\' + field + \', [name=\' + field + \'_-1]\', $form).filter(\':input\');
      }
      if ($el.length) {
        ruleFields[field] = $el;
        $ruleElements = $ruleElements.add($el);
      }
    });
    // Check for matches on input when action == ADD
    if (action === 1) {
      $ruleElements.on(\'change\', function () {
        if ($(this).is(\'input[type=text]\') && $(this).val().length < 3) {
          return;
        }
        checkMatches().done(function (data) {
          var params = {
            title: data.count == 1 ? '; ?>
"<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Similar Contact Found<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" : "<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Similar Contacts Found<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"<?php echo ',
            info: "'; ?>
<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>If the contact you were trying to add is listed below, click their name to view or edit their record<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo ':",
            contacts: data.values,
            cid: cid
          };
          if (data.count) {
            openDupeAlert(params);
          }
        });
      });
    }

    // Call the api to check for matching contacts
    function checkMatches(rule) {
      var match = {contact_type: contactType},
        response = $.Deferred(),
        checkNum = ++runningCheck,
        params = {
          options: {sort: \'sort_name\'},
          return: [\'display_name\', \'email\']
        };
      $.each(ruleFields, function(fieldName, ruleField) {
        if (ruleField.length > 1) {
          match[fieldName] = ruleField.filter(\':checked\').val();
        } else if (ruleField.is(\'input[type=text]\')) {
          if (ruleField.val().length > 2) {
            match[fieldName] = ruleField.val() + (rule ? \'\' : \'%\');
          }
        } else {
          match[fieldName] = ruleField.val();
        }
      });
      // CRM-20565 - Need a good default matching rule before using the dedupe engine for checking on-the-fly.
      // Defaulting to contact.get.
      var action = rule ? \'duplicatecheck\' : \'get\';
      if (rule) {
        params.rule_type = rule;
        params.match = match;
        params.exclude = cid ? [cid] : [];
      } else {
        _.extend(params, match);
      }
      CRM.api3(\'contact\', action, params).done(function(data) {
        // If a new request has started running, cancel this one.
        if (checkNum < runningCheck) {
          response.reject();
        } else {
          response.resolve(data);
        }
      });
      return response;
    }

    // Open an alert about possible duplicate contacts
    function openDupeAlert(data, iconType) {
      // Close msg if it exists
      matchMessage && matchMessage.close && matchMessage.close();
      matchMessage = CRM.alert(dupeTpl(data), _.escape(data.title), iconType, {expires: false});
      $(\'.matching-contacts-actions\', \'#crm-notification-container\').on(\'click\', \'a\', function() {
        // No confirmation dialog on click
        $(\'[data-warn-changes=true]\').attr(\'data-warn-changes\', \'false\');
      });
    }

    // Update the duplicate alert after getting results
    function updateDupeAlert(data, iconType) {
      var $alert = $(\'.matching-contacts-actions\', \'#crm-notification-container\')
        .closest(\'.ui-notify-message\');
      $alert
        .removeClass(\'crm-msg-loading success info alert error\')
        .addClass(iconType)
        .find(\'h1\').text(data.title);
      $alert
        .find(\'.notify-content\')
        .html(dupeTpl(data));
    }

    // Ajaxify the "Check for Matching Contact(s)" button
    $(\'#_qf_Contact_refresh_dedupe\').click(function(e) {
      var placeholder = {'; ?>

        title: "<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Fetching Matches<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>",
        info: "<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Checking for similar contacts...<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>",
        contacts: []
      <?php echo '};
      openDupeAlert(placeholder, \'crm-msg-loading\');
      checkMatches(\'Supervised\').done(function(data) {
        var params = {
          title: data.count ? '; ?>
"<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Similar Contact Found<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" : "<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>None Found<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"<?php echo ',
          info: data.count ?
            "'; ?>
<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>If the contact you were trying to add is listed below, click their name to view or edit their record<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo ':" :
            "'; ?>
<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>No matches found using the default Supervised deduping rule.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '",
          contacts: data.values,
          cid: cid
        };
        updateDupeAlert(params, data.count ? \'alert\' : \'success\');
      });
      e.preventDefault();
    });
    '; ?>
<?php endif; ?><?php echo '
  });
</script>

<script type="text/template" id="duplicates-msg-tpl">
  <em><%- info %></em>
  <ul class="matching-contacts-actions">
    <% _.forEach(contacts, function(contact) { %>
      <li>
        <a href="<%= CRM.url(\'civicrm/contact/view\', {reset: 1, cid: contact.id}) %>">
          <%- contact.display_name %>
        </a>
        <%- contact.email %>
        <% if (cid) { %>
          <% var params = {reset: 1, action: \'update\', oid: contact.id > cid ? contact.id : cid, cid: contact.id > cid ? cid : contact.id }; %>
          (<a href="<%= CRM.url(\'civicrm/contact/merge\', params) %>">'; ?>
<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Merge<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '</a>)
        <% } %>
      </li>
    <% }); %>
  </ul>
</script>
'; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Form/validate.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/common/additionalBlocks.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php endif; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>