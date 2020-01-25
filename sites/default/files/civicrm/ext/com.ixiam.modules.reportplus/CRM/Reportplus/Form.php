<?php
use CRM_Reportplus_ExtensionUtil as E;

/**
 * Class CRM_Reportplus_Form
 */
class CRM_Reportplus_Form extends CRM_Report_Form {

  /**
   * csv export options
   */
  public $_csvEncoding      = NULL;
  public $_csvFilename      = 'Report';
  public $_csvFileExtension = 'csv';
  public $_csvShowHeaders   = TRUE;
  public $_csvSeparator     = NULL;
  public $_csvEnclose       = TRUE;

  protected $_newColumnsTab = FALSE;
  protected $_colPositions  = NULL;

  protected $_campaignEnabled = FALSE;
  protected $_activeCampaigns = NULL;
  protected $_disabledCampaigns = [];

  protected $_chartJSEnabled = FALSE;
  protected $_chartJSType;

  /**
   * Array of extra buttons
   *
   * E.g we define the tab title, the tpl and the tab-specific part of the css or  html link.
   *
   *  $this->_extraActions[report_instance.<action_name>] = array(
   *    'title' => ts('Create Report'),
   *    'data' => array(
   *       'is_confirm' => TRUE,
   *       'confirm_title' => ts('Create Report'),
   *       'confirm_refresh_fields' => json_encode(array(
   *         'title' => array('selector' => '.crm-report-instanceForm-form-block-title', 'prepend' => ''),
   *         'description' => array('selector' => '.crm-report-instanceForm-form-block-description', 'prepend' => ''),
   *       )),
   *     ),
   *  );
   *
   * @var array
   */
  protected $_extraActions = [];

  // [ML] Required for civiexportexcel
  public $supportsExportExcel = TRUE;

  public function __construct() {
    $this->_options['csvEncoding'] = [
      'type'      => 'select',
      'title'     => E::ts('CSV Encoding'),
      'options'   => [
        ""              => "-",
        "utf-8"         => "UTF-8",
        "windows-1252"  => "Windows-1252",
        "iso-8859-1"    => "iso-8859-1",
      ],
    ];
    $this->_options['limit'] = [
      'type'      => 'select',
      'title'     => ts('Limit'),
      'options'   => [
        ""    => "-",
        "5"   => "5",
        "10"  => "10",
        "25"  => "25",
        "50"  => "50",
        "100" => "100",
        "200" => "200",
      ],
    ];

    parent::__construct();

    // set collapsable group title
    $groupTitle = [
      'civicrm_membership' => ts('Membership'),
      'civicrm_membership_status' => ts('Membership Status'),
      'civicrm_contribution' => ts('Contribution'),
      'civicrm_address' => ts('Address'),
      'civicrm_contact' => ts('Contact'),
      'civicrm_tag' => ts('Tag'),
      'civicrm_group' => ts('Group'),
      'civicrm_contribution_soft' => ts('Soft Credit'),
      'civicrm_note' => ts('Notes'),
      'civicrm_contribution_ordinality' => ts('Contribution Ordinality'),
      'civicrm_email' => ts('Email'),
      'civicrm_phone' => ts('Phone'),
      'civicrm_financial_trxn' => ts('Financial Transaction'),
      'civicrm_activity' => ts('Activity'),
    ];
    foreach ($groupTitle as $key => $title) {
      if (isset($this->_columns[$key])) {
        $this->_columns[$key]['group_title'] = $title;
      }
    }

    $config = CRM_Core_Config::singleton();
    $this->_campaignEnabled = in_array("CiviCampaign", $config->enableComponents);
    if ($this->_campaignEnabled) {
      $getCampaigns = CRM_Campaign_BAO_Campaign::getPermissionedCampaigns(NULL, NULL, TRUE, FALSE, TRUE);
      $this->_activeCampaigns = $getCampaigns['campaigns'];
      asort($this->_activeCampaigns);

      $result = civicrm_api3('Campaign', 'get', ['is_active' => 0]);
      foreach ($result["values"] as $key => $value) {
        $this->_disabledCampaigns[$key] = $value["title"];
      }
      asort($this->_disabledCampaigns);
    }
  }

  /**
   * The intent is to add a tab for developers to view the sql.
   *
   * Currently using dpm.
   *
   * @param string $sql
   */
  public function addToDeveloperTab($sql) {
    $ignored_output_modes = ['pdf', 'csv', 'print', 'excel2007'];
    if (in_array($this->_outputMode, $ignored_output_modes)) {
      return;
    }
    parent::addToDeveloperTab($sql);
  }

  /**
   * Set output mode.
   */
  public function processReportMode() {
    // Save the task before the next method removes it
    $task = $this->_params['task'];
    $this->setOutputMode();

    if ($this->_outputMode == 'excel2007') {
      $this->_sendmail = CRM_Utils_Request::retrieve(
        'sendmail',
        'Boolean',
        CRM_Core_DAO::$_nullObject
      );

      $printOnly          = TRUE;
      $this->_absoluteUrl = TRUE;
      $this->addPaging    = FALSE;

      $this->assign('outputMode', $this->_outputMode);
      $this->assign('printOnly', $printOnly);

      // Get today's date to include in printed reports
      if ($printOnly) {
        $reportDate = CRM_Utils_Date::customFormat(date('Y-m-d H:i'));
        $this->assign('reportDate', $reportDate);
      }
    }
    else {
      // Restore the task before calling the following method
      $this->_params['task'] = $task;
      parent::processReportMode();
    }
  }

  /**
   * End post processing.
   *
   * @param array|null $rows
   */
  public function endPostProcess(&$rows = NULL) {
    if ($this->_outputMode == 'csv') {
      if (!empty($this->_params['csvEncoding'])) {
        $this->_csvEncoding = $this->_params['csvEncoding'];
      }
      CRM_Reportplus_Utils_Report::export2csv($this, $rows);
    }
    elseif ($this->_outputMode == 'excel2007') {
      CRM_CiviExportExcel_Utils_Report::export2excel2007($this, $rows);
    }
    else {
      parent::endPostProcess($rows);
    }
  }

  /**
   * Get the actions for this report instance.
   *
   * @param int $instanceId
   *
   * @return array
   */
  protected function getActions($instanceId) {
    $actions = parent::getActions($instanceId);
    // Add extra Actions
    $actions += $this->_extraActions;

    return $actions;
  }

  public function addColumns() {
    if (!$this->_newColumnsTab) {
      parent::addColumns();
    }
    else {
      $options = [];
      $colGroups = NULL;
      foreach ($this->_columns as $tableName => $table) {
        if (array_key_exists('fields', $table)) {
          foreach ($table['fields'] as $fieldName => $field) {
            $groupTitle = '';
            if (empty($field['no_display'])) {
              foreach (['table', 'field'] as $var) {
                if (!empty(${$var}['grouping'])) {
                  if (!is_array(${$var}['grouping'])) {
                    $tableName = ${$var}['grouping'];
                  }
                  else {
                    $tableName = array_keys(${$var}['grouping']);
                    $tableName = $tableName[0];
                    $groupTitle = array_values(${$var}['grouping']);
                    $groupTitle = $groupTitle[0];
                  }
                }
              }

              if (!$groupTitle && isset($table['group_title'])) {
                $groupTitle = $table['group_title'];
              }

              $colGroups[$tableName]['fields'][$fieldName] = CRM_Utils_Array::value('title', $field);
              if ($groupTitle && empty($colGroups[$tableName]['group_title'])) {
                $colGroups[$tableName]['group_title'] = $groupTitle;
              }
              $options[$fieldName] = CRM_Utils_Array::value('title', $field);
              $this->add('text', "position[{$fieldName}]", NULL, NULL);
            }
          }
        }
      }

      $this->addCheckBox("fields", ts('Select Columns'), $options, NULL,
        NULL, NULL, NULL, $this->_fourColumnAttribute, TRUE
      );

      if (!empty($colGroups)) {
        $this->tabs['FieldSelection'] = [
          'title' => ts('Columns'),
          'tpl' => 'FieldSelectionPlus',
          'div_label' => 'col-groups',
        ];

        // Note this assignment is only really required in buildForm. It is being 'over-called'
        // to reduce risk of being missed due to overridden functions.
        $this->assign('tabs', $this->tabs);
      }

      $this->assign('colGroups', $colGroups);
    }
  }

  public function addAddressFields($groupBy = TRUE, $orderBy = FALSE, $filters = TRUE, $defaults = ['country_id' => TRUE], $fields = TRUE) {
    $addressFields = parent::addAddressFields($groupBy, $orderBy, $filters, $defaults);
    if (!$fields) {
      $addressFields['civicrm_address']['fields'] = [];
    }
    $addressFields['civicrm_address']['grouping'] = 'location-fields';

    return $addressFields;
  }

  public function addCampaignFields($entityTable = 'civicrm_contribution', $groupBy = FALSE, $orderBy = FALSE, $filters = TRUE, $fields = TRUE) {
    parent::addCampaignFields($entityTable, $groupBy, $orderBy, $filters);
    if (!$fields) {
      unset($this->_columns[$entityTable]['fields']['campaign_id']);
    }
  }

  public function preProcessCommon() {
    parent::preProcessCommon();

    if ($this->_newColumnsTab) {
      if (!$this->_id) {
        foreach ($this->_columns as $tableName => $table) {
          if (isset($table['fields'])) {
            foreach ($table['fields'] as $key => $field) {
              if (isset($field['position']) && !empty($field['position'])) {
                $this->_colPositions[$key] = $field['position'];
              }
            }
          }
        }
      }
    }

    if (isset($this->_colPositions)) {
      uasort($this->_colPositions, ['CRM_Reportplus_Form', '_positionSort']);
    }
    $this->assign('colPositions', $this->_colPositions);

    if ($this->_chartJSEnabled) {
      $this->addChartJS();
    }
  }

  public function addChartJS() {
    $this->tabs['ChartJS'] = [
      'title' => E::ts('ChartJS'),
      'tpl' => 'ChartJS',
      'div_label' => 'chart-js',
    ];

    $chartTypes = [
      'line' => 'Line Chart',
      'bar' => 'Bar Chart',
      'horizontalBar' => 'Horizontal Bar Chart',
      //'radar' => 'Radar Chart',
      'pie' => 'Pie Chart',
      'doughnut' => 'Doughnut Chart',
      //'polarArea' => 'Polar Area Chart',
      //'bubble' => 'Bubble Chart',
      //'scatter' => 'Scatter Chart',

    ];

    $this->addElement('checkbox', 'chartjs_enabled', E::ts('Chart JS Enabled'));
    $this->addElement('select', 'chartjs_type', E::ts('Chart JS Type'), ['' => E::ts('-- Select --')] + $chartTypes, ['class' => 'crm-select2 huge']);

    $this->addElement('checkbox', 'chartjs_line_fill', E::ts('Fill Enabled'));
    $this->addElement('checkbox', 'chartjs_line_smooth', E::ts('Smooth lines'));
  }

  /**
   * Format display output.
   *
   * @param array $rows
   * @param bool $pager
   */
  public function formatDisplay(&$rows, $pager = TRUE) {
    parent::formatDisplay($rows, $pager);

    if (!empty($this->_params['chartjs_enabled']) && !empty($rows)) {
      $this->buildChartJS($rows);
      $this->assign('chartJSEnabled', TRUE);
    }
  }

  public function buildChartJS(&$rows) {
    // override this method for building Chart JS.
  }


  public function setDefaultValues($freeze = TRUE) {
    parent::setDefaultValues($freeze);

    if ($this->_newColumnsTab) {
      if (!isset($this->_defaults['position'])) {
        $this->_defaults['position'] = $this->_colPositions;
      }
      else {
        $this->_colPositions = array_merge($this->_colPositions, $this->_defaults['position']);
        uasort($this->_colPositions, ['CRM_Reportplus_Form', '_positionSort']);
        $this->assign('colPositions', $this->_colPositions);
      }
    }

    return $this->_defaults;
  }

  public function beginPostProcessCommon() {
    if ($this->_newColumnsTab) {
      $this->_colPositions = $this->_params['position'];
      uasort($this->_colPositions, ['CRM_Reportplus_Form', '_positionSort']);
      $this->assign('colPositions', $this->_colPositions);
    }
  }

  public function modifyColumnHeaders() {
    if ($this->_newColumnsTab) {
      foreach ($this->_columns as $tableName => $table) {
        if (array_key_exists('fields', $table)) {
          foreach ($table['fields'] as $fieldName => $field) {
            if (!empty($field['statistics'])) {
              foreach ($field['statistics'] as $stat => $label) {
                $alias = "{$tableName}_{$fieldName}_{$stat}";
                switch (strtolower($stat)) {
                  case 'max':
                  case 'sum':
                    $this->_columnHeaders["{$tableName}_{$fieldName}_{$stat}"]['position'] = 97;
                    break;

                  case 'count':
                    $this->_columnHeaders["{$tableName}_{$fieldName}_{$stat}"]['position'] = 98;
                    break;

                  case 'count_distinct':
                    $this->_columnHeaders["{$tableName}_{$fieldName}_{$stat}"]['position'] = 99;
                    break;

                  case 'avg':
                    $this->_columnHeaders["{$tableName}_{$fieldName}_{$stat}"]['position'] = 100;
                    break;
                }
              }
            }
            else {
              if (!empty($this->_colPositions[$fieldName])) {
                $this->_columnHeaders["{$tableName}_{$fieldName}"]['position'] = $this->_colPositions[$fieldName];
              }
            }
          }
        }
      }
    }
    uasort($this->_columnHeaders, ['CRM_Reportplus_Form', '_columnSort']);
  }

  public function whereClause(&$field, $op, $value, $min, $max) {

    $type = CRM_Utils_Type::typeToString(CRM_Utils_Array::value('type', $field));
    $clause = NULL;

    switch ($op) {
      case 'ept':
      case 'nept':
        $sqlOP = $this->getSQLOperator($op);
        $clause = "( {$field['dbAlias']} $sqlOP )";
        break;

      case 'eptnll':
      case 'neptnnll':
        $sqlOP = $this->getSQLOperator($op);
        $clause = str_replace("%field%", "{$field['dbAlias']}", $sqlOP);
        break;

      default:
        $clause = parent::whereClause($field, $op, $value, $min, $max);
        break;
    }

    return $clause;
  }

  public function getBasicContactFields() {
    $result = parent::getBasicContactFields() + [
      'contact_source' => [
        'title' => ts('Source of Contact Data') ,
      ],
      'is_deceased' => [
        'title' => ts('Contact is Deceased'),
      ],
      'deceased_date' => [
        'title' => ts('Deceased Date'),
      ],
    ];

    return $result;
  }

  public function getBasicContactFilters($defaults = []) {
    $result = parent::getBasicContactFilters($defaults) + [
      'deceased_date' => [
        'title' => ts('Deceased Date'),
        'operatorType' => CRM_Report_Form::OP_DATE,
      ],
    ];

    unset($result['is_deleted']['no_display']);

    $result['is_deleted']['title'] = ts('Deleted');

    return $result;
  }

  public function getBasicContactOrderBys() {
    return [
      'sort_name' => [
        'title' => ts('Last Name, First Name'),
        'default' => '1',
        'default_weight' => '0',
        'default_order' => 'ASC',
      ],
      'first_name' => [
        'name' => 'first_name',
        'title' => ts('First Name'),
      ],
      'gender_id' => [
        'name' => 'gender_id',
        'title' => ts('Gender'),
      ],
      'birth_date' => [
        'name' => 'birth_date',
        'title' => ts('Birth Date'),
      ],
      'contact_type' => [
        'title' => ts('Contact Type'),
      ],
      'contact_sub_type' => [
        'title' => ts('Contact Subtype'),
      ],
    ];
  }

  public function getOperationPair($type = "string", $fieldName = NULL) {
    if (empty($type) || $type == "string") {
      $result = [
        'has' => ts('Contains'),
        'sw' => ts('Starts with'),
        'ew' => ts('Ends with'),
        'nhas' => ts('Does not contain'),
        'eq' => ts('Is equal to'),
        'neq' => ts('Is not equal to'),
        'ept' => E::ts('Is empty'),
        'nept' => E::ts('Is not empty'),
        'nll' => E::ts('Is Null'),
        'nnll' => E::ts('Is not Null'),
        'eptnll' => E::ts('Is empty or Null'),
        'neptnnll' => E::ts('Is not empty and Null'),
      ];
      return $result;
    }
    else {
      return parent::getOperationPair($type, $fieldName);
    }
  }

  public function getSQLOperator($operator = "like") {
    switch ($operator) {
      case 'ept':
        return '= \'\'';

      case 'nept':
        return '!= \'\'';

      case 'eptnll':
        return ' ( %field% IS NULL OR %field% = \'\' ) ';

      case 'neptnnll':
        return ' ( %field% IS NOT NULL AND %field% != \'\' ) ';

      default:
        // type is string
        return parent::getSQLOperator($operator);
    }
  }

  /**
   * Override to set limit is 10
   * @param int $rowCount
   */
  public function limit($rowCount = self::ROW_COUNT_LIMIT) {
    if ($this->_params['limit']) {
      $rowCount = $this->_params['limit'];
    }
    parent::limit($rowCount);
  }

  /**
   * Alter display of rows.
   *
   * Iterate through the rows retrieved via SQL and make changes for display purposes,
   * such as rendering contacts as links.
   *
   * @param array $rows
   *   Rows generated by SQL, with an array for each row.
   */
  public function alterDisplay(&$rows) {
    $entryFound = FALSE;
    foreach ($rows as $rowNum => $row) {
      // If using campaigns, convert campaign_id to campaign title
      if (array_key_exists('civicrm_contribution_campaign_id', $row)) {
        if ($value = $row['civicrm_contribution_campaign_id']) {
          if (array_key_exists($value, $this->_disabledCampaigns)) {
            $rows[$rowNum]['civicrm_contribution_campaign_id'] = '<font color="#FF0000">' . $this->_disabledCampaigns[$value] . '</font>';
          }
          else {
            $rows[$rowNum]['civicrm_contribution_campaign_id'] = $this->_activeCampaigns[$value];
          }
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

  /**
   * Override to set pager with limit is 10
   * @param int $rowCount
   */
  public function setPager($rowCount = self::ROW_COUNT_LIMIT) {
    if ($this->_params['limit']) {
      $rowCount = $this->_params['limit'];
    }
    parent::setPager($rowCount);
  }

  private function _columnSort($a, $b) {
    return $this->_positionSort($a['position'], $b['position']);
  }

  private function _positionSort($a, $b) {
    if (empty($a)) {
      return 1;
    }
    if (empty($b)) {
      return -1;
    }
    if ($a == $b) {
      return 0;
    }

    return ($a > $b) ? +1 : -1;
  }

}
