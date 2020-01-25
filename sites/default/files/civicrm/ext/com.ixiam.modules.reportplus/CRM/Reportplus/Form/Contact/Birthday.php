<?php

use CRM_Reportplus_ExtensionUtil as E;

class CRM_Reportplus_Form_Contact_Birthday extends CRM_Reportplus_Form {

  protected $_summary = NULL;

  protected $_emailField = FALSE;

  protected $_phoneField = FALSE;

  protected $_customGroupExtends = [
    'Contact', 'Individual', 'Household', 'Organization'
];

  public $_drilldownReport = ['contact/detail' => 'Link to Detail Report'];

  public function __construct() {
    $this->_newColumnsTab = TRUE;

    $this->_autoIncludeIndexedFieldsAsOrderBys = 1;
    $this->_columns = [
      'civicrm_contact' =>
      [
        'dao' => 'CRM_Contact_DAO_Contact',
        'fields' =>
        [
          'sort_name' => [
            'title' => ts('Contact Name'),
            'default' => TRUE,
          ],
          'first_name' => [
            'title' => ts('First Name'),
          ],
          'last_name' => [
            'title' => ts('Last Name'),
          ],
          'birth_date' => [
            'title' => ts('Birth Date'),
            'default' => TRUE,
            'type' => CRM_Utils_Type::T_STRING,
          ],
          'age' => [
            'name' => 'age',
            'title' => ts('Age'),
            'type' => CRM_Utils_Type::T_STRING,
            'dbAlias' => "DATE_FORMAT(FROM_DAYS((TO_DAYS(NOW())+1)-TO_DAYS(contact_civireport.birth_date)), '%Y')+0",
            'default' => TRUE,
          ],
          'id' => [
            'no_display' => TRUE,
            'required' => TRUE,
          ],
          'contact_type' => [
            'title' => ts('Contact Type'),
          ],
          'contact_sub_type' => [
            'title' => ts('Contact SubType'),
          ],
          'is_deceased' => [
            'title' => ts('Contact is Deceased'),
          ],
          'deceased_date' => [
            'title' => ts('Deceased Date'),
          ],
        ],
        'filters' => [
          'sort_name' => [
            'title' => ts('Contact Name')
          ],
          'source' => [
            'title' => ts('Contact Source'),
            'type' => CRM_Utils_Type::T_STRING,
          ],
          'id' => [
            'title' => ts('Contact ID'),
            'no_display' => TRUE,
          ],
          'birth_date' => [
            'title' => ts('Birth Date'),
            'operatorType' => CRM_Report_Form::OP_DATE,
            'type' => CRM_Utils_Type::T_DATE,
            'default' => 'this.day',
          ],
          'is_deceased' => [
            'title' => ts('Is Deceased'),
            'default' => 0,
          ],
          'deceased_date' => [
            'title' => ts('Deceased Date'),
            'operatorType' => CRM_Report_Form::OP_DATE,
          ],
          'is_deleted' => [
            'title' => ts('Is deleted'),
            'type' => CRM_Utils_Type::T_BOOLEAN,
            'default' => 0,
          ],
        ],
        'grouping' => 'contact-fields',
        'order_bys' => [
          'sort_name' => [
            'title' => ts('Last Name, First Name'),
            'default' => '1',
            'default_weight' => '0',
            'default_order' => 'ASC',
          ],
          'birth_date_year' => [  
            'title' => E::ts('Birth Date (Year)'),
            'default_weight' => '1',
            'dbAlias' => 'YEAR(contact_civireport.birth_date)',
            'type' => CRM_Utils_Type::T_STRING,
            'default_order' => 'ASC',
          ],
          'birth_date_month' => [
            'title' => E::ts('Birth Date (Month)'),
            'default_weight' => '2',
            'dbAlias' => 'MONTH(contact_civireport.birth_date)',
            'type' => CRM_Utils_Type::T_STRING,
            'default_order' => 'ASC',
          ],
          'birth_date_day' => [
            'title' => E::ts('Birth Date (Day)'),
            'default_weight' => '3',
            'dbAlias' => 'DAYOFMONTH(contact_civireport.birth_date)',
            'type' => CRM_Utils_Type::T_STRING,
            'default_order' => 'ASC',
          ],
        ],
      ],
      'civicrm_email' => [
        'dao' => 'CRM_Core_DAO_Email',
        'fields' => [
          'email' => [
            'title' => ts('Email'),
            'no_repeat' => TRUE,
          ],
        ],
        'grouping' => 'contact-fields',
        'order_bys' => [
          'email' => [
            'title' => ts('Email'),
          ],
        ],
      ],
      'civicrm_address' => [
        'dao' => 'CRM_Core_DAO_Address',
        'grouping' => 'contact-fields',
        'fields' => [
          'street_address' => ['default' => TRUE],
          'city' => ['default' => TRUE],
          'postal_code' => NULL,
          'state_province_id' => [
            'title' => ts('State/Province'),
          ],
        ],
        'filters' => [
          'country_id' => [
            'title' => ts('Country'),
            'type' => CRM_Utils_Type::T_INT,
            'operatorType' => CRM_Report_Form::OP_MULTISELECT,
            'options' => CRM_Core_PseudoConstant::country(),
          ],
          'state_province_id' => [
            'title' => ts('State / Province'),
            'type' => CRM_Utils_Type::T_INT,
            'operatorType' => CRM_Report_Form::OP_MULTISELECT,
            'options' => CRM_Core_PseudoConstant::stateProvince(),
          ],
        ],
        'order_bys' => [
          'state_province_id' => ['title' => 'State/Province'],
          'city' => ['title' => 'City'],
          'postal_code' => ['title' => 'Postal Code'],
        ],
      ],
      'civicrm_country' => [
        'dao' => 'CRM_Core_DAO_Country',
        'fields' => [
          'name' => ['title' => 'Country', 'default' => TRUE],
        ],
        'order_bys' => [
          'name' => ['title' => 'Country'],
        ],
        'grouping' => 'contact-fields',
      ],
      'civicrm_phone' => [
        'dao' => 'CRM_Core_DAO_Phone',
        'fields' => [
          'phone' => NULL,
          'phone_ext' => [
            'title' => ts('Phone Extension')
          ]
        ],
        'grouping' => 'contact-fields',
      ],
      'civicrm_group' => [
        'dao' => 'CRM_Contact_DAO_Group',
        'alias' => 'cgroup',
        'filters' => [
          'gid' => [
            'name' => 'group_id',
            'title' => ts('Group'),
            'type' => CRM_Utils_Type::T_INT,
            'operatorType' => CRM_Report_Form::OP_MULTISELECT,
            'group' => TRUE,
            'options' => CRM_Core_PseudoConstant::nestedGroup(),
          ],
        ],
      ],
    ];

    $this->_tagFilter = TRUE;
    parent::__construct();
  }

  public function preProcess() {
    parent::preProcess();
  }

  public function select() {
    $select = [];
    $this->_columnHeaders = [];
    foreach ($this->_columns as $tableName => $table) {
      if (array_key_exists('fields', $table)) {
        foreach ($table['fields'] as $fieldName => $field) {
          if (CRM_Utils_Array::value('required', $field) ||
            CRM_Utils_Array::value($fieldName, $this->_params['fields'])
          ) {
            if ($tableName == 'civicrm_email') {
              $this->_emailField = TRUE;
            }
            elseif ($tableName == 'civicrm_phone') {
              $this->_phoneField = TRUE;
            }
            elseif ($tableName == 'civicrm_country') {
              $this->_countryField = TRUE;
            }

            $alias = "{$tableName}_{$fieldName}";
            if ($tableName == 'civicrm_country') {
              $country_home   = $this->_aliases['civicrm_country'] . '_home';
              $country_parent = $this->_aliases['civicrm_country'] . '_parent';
              $select[] = "COALESCE({$country_home}.{$fieldName}, {$country_parent}.{$fieldName}) as {$alias}";
            }
            elseif ($tableName == 'civicrm_address') {
              $address_home   = $this->_aliases['civicrm_address'] . '_home';
              $address_parent = $this->_aliases['civicrm_address'] . '_parent';
              $select[] = "COALESCE({$address_home}.{$fieldName}, {$address_parent}.{$fieldName}) as {$alias}";
            }
            else {
              $select[] = "{$field['dbAlias']} as {$alias}";
            }

            $this->_columnHeaders["{$tableName}_{$fieldName}"]['type'] = CRM_Utils_Array::value('type', $field);
            $this->_columnHeaders["{$tableName}_{$fieldName}"]['title'] = $field['title'];
            $this->_selectAliases[] = $alias;
          }
        }
      }
    }

    $this->_select = "SELECT " . implode(', ', $select) . " ";
  }

  public static function formRule($fields, $files, $self) {
    $errors = $grouping = [];
    return $errors;
  }

  public function from() {
    $address_home   = $this->_aliases['civicrm_address'] . '_home';
    $address_parent = $this->_aliases['civicrm_address'] . '_parent';

    $this->_from = "
        FROM civicrm_contact {$this->_aliases['civicrm_contact']} {$this->_aclFrom}
            LEFT JOIN civicrm_address {$address_home}
                   ON ({$this->_aliases['civicrm_contact']}.id = {$address_home}.contact_id AND
                      {$address_home}.location_type_id = 1 )
            LEFT JOIN civicrm_address {$address_parent}
                   ON ({$this->_aliases['civicrm_contact']}.id = {$address_parent}.contact_id AND
                      {$address_parent}.location_type_id = 6 ) ";

    if ($this->isTableSelected('civicrm_email')) {
      $this->_from .= "
            LEFT JOIN  civicrm_email {$this->_aliases['civicrm_email']}
                   ON ({$this->_aliases['civicrm_contact']}.id = {$this->_aliases['civicrm_email']}.contact_id AND
                      {$this->_aliases['civicrm_email']}.is_primary = 1) ";
    }

    if ($this->_phoneField) {
      $this->_from .= "
            LEFT JOIN civicrm_phone {$this->_aliases['civicrm_phone']}
                   ON {$this->_aliases['civicrm_contact']}.id = {$this->_aliases['civicrm_phone']}.contact_id AND
                      {$this->_aliases['civicrm_phone']}.is_primary = 1 ";
    }

    if ($this->isTableSelected('civicrm_country')) {
      $country_home   = $this->_aliases['civicrm_country'] . '_home';
      $country_parent = $this->_aliases['civicrm_country'] . '_parent';
      $this->_from .= "
            LEFT JOIN civicrm_country {$country_home}
                   ON {$address_home}.country_id = {$country_home}.id
            LEFT JOIN civicrm_country {$country_parent}
                   ON {$address_parent}.country_id = {$country_parent}.id";
    }
  }

  public function where() {
    $clauses = [];

    foreach ($this->_columns as $tableName => $table) {
      if (array_key_exists('filters', $table)) {
        foreach ($table['filters'] as $fieldName => $field) {
          $clause = NULL;
          if (CRM_Utils_Array::value('operatorType', $field) & CRM_Report_Form::OP_DATE) {
            $relative = CRM_Utils_Array::value("{$fieldName}_relative", $this->_params);
            $from     = CRM_Utils_Array::value("{$fieldName}_from", $this->_params);
            $to       = CRM_Utils_Array::value("{$fieldName}_to", $this->_params);

            $clause = $this->dateClause($field['dbAlias'], $relative, $from, $to);
          }
          else {
            $op = CRM_Utils_Array::value("{$fieldName}_op", $this->_params);
            $clause = $this->whereClause($field,
              $op,
              CRM_Utils_Array::value("{$fieldName}_value", $this->_params),
              CRM_Utils_Array::value("{$fieldName}_min", $this->_params),
              CRM_Utils_Array::value("{$fieldName}_max", $this->_params)
            );
          }
          if (!empty($clause)) {
            $clauses[] = $clause;
          }
        }
      }
    }

    // Hide all contacts with null bday
    array_push($clauses, '( contact_civireport.birth_date IS NOT NULL )');

    if ($clauses) {
      $this->_where = "WHERE " . implode(' AND ', $clauses);
    }

    if ($this->_aclWhere) {
      $this->_where .= " AND {$this->_aclWhere} ";
    }

    $this->_where .= " GROUP BY {$this->_aliases['civicrm_contact']}.id ";

    return $rows;
  }

  public function postProcess() {

    $this->beginPostProcess();

    // get the acl clauses built before we assemble the query
    $this->buildACLClause($this->_aliases['civicrm_contact']);

    $sql = $this->buildQuery(TRUE);

    $rows = $graphRows = [];
    $this->buildRows($sql, $rows);

    $this->formatDisplay($rows);
    $this->doTemplateAssignment($rows);
    $this->endPostProcess($rows);
  }

  public function alterDisplay(&$rows) {
    // custom code to alter rows
    $entryFound = FALSE;
    foreach ($rows as $rowNum => $row) {
      // make count columns point to detail report
      // convert sort name to links
      if (array_key_exists('civicrm_contact_sort_name', $row) &&
        array_key_exists('civicrm_contact_id', $row)
      ) {
        $url = CRM_Report_Utils_Report::getNextUrl('contact/detail',
          'reset=1&force=1&id_op=eq&id_value=' . $row['civicrm_contact_id'],
          $this->_absoluteUrl, $this->_id, $this->_drilldownReport
        );
        $rows[$rowNum]['civicrm_contact_sort_name_link'] = $url;
        $rows[$rowNum]['civicrm_contact_sort_name_hover'] = ts("View Constituent Detail Report for this contact.");
        $entryFound = TRUE;
      }

      if (array_key_exists('civicrm_address_state_province_id', $row)) {
        if ($value = $row['civicrm_address_state_province_id']) {
          $rows[$rowNum]['civicrm_address_state_province_id'] = CRM_Core_PseudoConstant::stateProvince($value, FALSE);
        }
        $entryFound = TRUE;
      }


      // display birthday in the configured custom format
      if (array_key_exists('civicrm_contact_birth_date', $row)) {
        $birthDate = $row['civicrm_contact_birth_date'];
        if ($birthDate) {
          $rows[$rowNum]['civicrm_contact_birth_date'] = CRM_Utils_Date::customFormat($birthDate, Civi::settings()->get('dateformatshortdate'));
        }
        $entryFound = TRUE;
      }

      // skip looking further in rows, if first row itself doesn't
      // have the column we need
      if (!$entryFound) {
        break;
      }
    }
  }

  public function dateClause($fieldName, $relative, $from, $to, $type = NULL, $fromTime = NULL, $toTime = NULL) {
    $clauses = [];
    if (in_array($relative, array_keys($this->getOperationPair(CRM_Report_Form::OP_DATE)))) {
      $sqlOP = $this->getSQLOperator($relative);
      return "( {$fieldName} {$sqlOP} )";
    }

    list($from, $to) = $this->getFromTo($relative, $from, $to, $fromTime, $toTime);

    if ($from) {
      $from = ($type == CRM_Utils_Type::T_DATE) ? substr($from, 0, 8) : $from;
      $clauses[] = "( CONVERT(DATE_FORMAT({$fieldName},'%m%d'), UNSIGNED INTEGER) >= CONVERT(DATE_FORMAT( {$from},'%m%d'), UNSIGNED INTEGER))";
    }

    if ($to) {
      $to = ($type == CRM_Utils_Type::T_DATE) ? substr($to, 0, 8) : $to;
      $clauses[] = "( CONVERT(DATE_FORMAT({$fieldName},'%m%d'), UNSIGNED INTEGER) <= CONVERT(DATE_FORMAT( {$to},'%m%d'), UNSIGNED INTEGER))";
    }

    if (!empty($clauses)) {
      return implode(' AND ', $clauses);
    }

    return NULL;
  }

  public function compileContent() {
    if ($this->_outputMode == 'pdf') {
      $templateFile = 'CRM/France/Form/Report/Contribute/Detail/Receipt_pdf.tpl';

      return $this->_formValues['report_header'] . CRM_Core_Form::$_template->fetch($templateFile);
    }
    else {
      return parent::compileContent();
    }
  }

}
