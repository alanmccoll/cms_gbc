<?php

class CRM_Reportplus_Form_Activity_Matrix extends CRM_Reportplus_Form_Matrix {
  /**
   * Class constructor.
   */
  public function __construct() {
    $this->_customGroupExtends = ['Activity', 'Contact', 'Individual', 'Organization'];
    $this->_customGroupGroupBy = TRUE;
    $this->_addressField = TRUE;

    $this->_columns = [
      'civicrm_statistics' => [
        'dao' => 'CRM_Activity_DAO_Activity',
        'fields' => [
          'count_total' => [
            'title' => ts('Count'),
            'default' => TRUE,
            'dbAlias' => 'COUNT(id)',
          ],
          'count_target' => [
            'title' => ts('Count With Contacts'),
            'dbAlias' => 'COUNT(contact_id)',
          ],
          'count_assignee' => [
            'title' => ts('Count Assigned Contacts'),
            'dbAlias' => 'COUNT(DISTINCT contact_id)',
          ],
          'count_source' => [
            'title' => ts('Count Unique Source Contacts'),
            'dbAlias' => 'COUNT(contact_id)',
          ],
        ],
        'grouping' => 'statistics-fields',
      ],
      'civicrm_contact' => [
        'dao' => 'CRM_Contact_DAO_Contact',
        'fields' => [],
        'grouping' => 'contact-fields',
        'group-title' => ts('Contacts'),
        'group_bys' => [
          'contact_type' => [
            'title' => ts('Contact Type'),
          ],
          'contact_sub_type' => [
            'title' => ts('Contact Subtype'),
          ],
          'gender_id' => [
            'title' => ts('Gender'),
          ],
          'age' => [
            'title' => ts('Age'),
            'dbAlias' => 'TIMESTAMPDIFF(YEAR, contact_civireport.birth_date, CURDATE())',
          ],
        ],
      ],
      'civicrm_activity' => [
        'dao' => 'CRM_Activity_DAO_Activity',
        'fields' => [],
        'filters' => [
          'activity_date_time' => [
            'operatorType' => CRM_Report_Form::OP_DATE,
          ],
          'activity_subject' => ['title' => ts('Activity Subject')],
          'activity_type_id' => [
            'title' => ts('Activity Type'),
            'operatorType' => CRM_Report_Form::OP_MULTISELECT,
            'options' => CRM_Core_PseudoConstant::activityType(TRUE, TRUE, FALSE, 'label', TRUE),
          ],
          'status_id' => [
            'title' => ts('Activity Status'),
            'type' => CRM_Utils_Type::T_STRING,
            'operatorType' => CRM_Report_Form::OP_MULTISELECT,
            'options' => CRM_Core_PseudoConstant::activityStatus(),
          ],
          'location' => [
            'title' => ts('Location'),
            'type' => CRM_Utils_Type::T_TEXT,
          ],
          'details' => [
            'title' => ts('Activity Details'),
            'type' => CRM_Utils_Type::T_TEXT,
          ],
          'priority_id' => [
            'title' => ts('Activity Priority'),
            'type' => CRM_Utils_Type::T_STRING,
            'operatorType' => CRM_Report_Form::OP_MULTISELECT,
            'options' => CRM_Core_PseudoConstant::get('CRM_Activity_DAO_Activity', 'priority_id'),
          ],
          'source_record_id' => [
            'title' => ts('Source Record'),
            'type' => CRM_Utils_Type::T_STRING,
          ],
        ],
        'group_bys' => [
          'activity_date_time' => [
            'title' => ts('Activity Date'),
            'frequency' => TRUE,
          ],
          'activity_type_id' => [
            'title' => ts('Activity Type'),
          ],
          'status_id' => [
            'title' => ts('Activity Status'),
          ],
          'priority_id' => [
            'title' => ts('Activity Priority'),
          ],
        ],
        'order_bys' => [
          'activity_date_time' => [
            'title' => ts('Activity Date'),
          ],
          'activity_type_id' => [
            'title' => ts('Activity Type'),
          ],
        ],
        'grouping' => 'activity-fields',
        'alias' => 'activity',
      ],
    ] + $this->addAddressFields(TRUE, FALSE, TRUE, [], FALSE);

    parent::__construct();

    $this->addCampaignFields('civicrm_activity', TRUE, FALSE, TRUE, FALSE);
  }

  public function select() {
    $select = $this->_columnHeaders = [];
    $this->_colGroupByFreq = $this->_params['group_bys_column_freq'];
    $this->_rowGroupByFreq = $this->_params['group_bys_row_freq'];

    foreach ($this->_columns as $tableName => $table) {
      if (array_key_exists('fields', $table)) {
        foreach ($table['fields'] as $fieldName => $field) {
          if (!empty($field['required']) || !empty($this->_params['fields'][$fieldName])) {
            if ($tableName == 'civicrm_statistics') {
              $select[] = "{$field['dbAlias']} as 'value'";
            }
          }
        }
      }
      if (array_key_exists('group_bys', $table)) {
        foreach ($table['group_bys'] as $fieldName => $field) {
          $groupByFreq = NULL;
          if ($this->_params['group_bys_column'] == $fieldName) {
            $this->_colField = $field;
            $fieldType = 'col';
          }
          elseif ($this->_params['group_bys_row'] == $fieldName) {
            $this->_rowField = $field;
            $fieldType = 'row';
          }
          else {
            $fieldType = NULL;
          }

          if ($fieldType) {
            if ($tableName == 'civicrm_address') {
              $this->_addressField = TRUE;
            }

            if ($field['type'] & CRM_Utils_Type::T_DATE) {
              if ($fieldType == 'col') {
                $groupByFreq = $this->_colGroupByFreq;
              }
              if ($fieldType == 'row') {
                $groupByFreq = $this->_rowGroupByFreq;
              }
            }

            switch ($groupByFreq) {
              case 'YEARWEEK':
                $select[] = "DATE_FORMAT({$field['dbAlias']}, '%Y-%u') as '$fieldType'";
                break;

              case 'YEAR':
                $select[] = "YEAR({$field['dbAlias']}) as '$fieldType'";
                break;

              case 'MONTH':
                $select[] = "DATE_FORMAT({$field['dbAlias']}, '%Y-%m') as '$fieldType'";
                break;

              case 'QUARTER':
                $select[] = "CONCAT(YEAR({$field['dbAlias']}), '-', QUARTER({$field['dbAlias']}))  as '$fieldType'";
                break;

              case 'DAY':
                $select[] = "DATE_FORMAT({$field['dbAlias']}, '%Y-%m-%d') as '$fieldType'";
                break;

              default:
                $select[] = $field['dbAlias'] . " as '$fieldType'";
                break;
            }
          }
        }
      }
    }
    $this->_select = "SELECT " . implode(', ', $select) . " ";
  }


  /**
   * Generate from clause.
   *
   * @param object $entity
   */
  public function from($entity = NULL) {
    $activityContacts = CRM_Activity_BAO_ActivityContact::buildOptions('record_type_id', 'validate');
    $recordTypes = [
      'target' => ts('Activity Targets'),
      'source' => ts('Activity Source'),
      'assignee' => ts('Activity Assignees'),
    ];
    foreach (array_keys($recordTypes) as $type) {
      if (!empty($this->_params['fields']["count_{$type}"])) {
        $recordTypeID = CRM_Utils_Array::key($recordTypes[$type], $activityContacts);
      }
    }

    $this->_from = "
          FROM civicrm_activity {$this->_aliases['civicrm_activity']}";

    if ($recordTypeID) {
      $this->_from .= "
               LEFT JOIN civicrm_activity_contact
                      ON {$this->_aliases['civicrm_activity']}.id = civicrm_activity_contact.activity_id AND
                         civicrm_activity_contact.record_type_id = {$recordTypeID}";
    }
    $this->_from .= "{$this->_aclFrom}";
  }

}
