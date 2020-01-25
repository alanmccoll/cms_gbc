<?php
use CRM_Reportplus_ExtensionUtil as E;

class CRM_Reportplus_Form_Matrix extends CRM_Reportplus_Form {
  protected $_groupByType = [];

  protected $_rowField;
  protected $_colField;
  protected $_colOptionsWeight = [];
  protected $_rowOptionsWeight = [];
  protected $_colGroupByFreq;
  protected $_rowGroupByFreq;
  protected $_rowHeaders = [];

  protected $_showTotals = FALSE;

  /**
   * Class constructor.
   */
  public function __construct() {
    $this->_groupByDateFreq = [
      'YEAR' => ts('Year'),
      'QUARTER' => E::ts('Quarter'),
      'YEARWEEK' => ts('Week'),
      'MONTH' => ts('Month'),
      'DAY' => ts('Day'),
    ];
    $this->_groupByType = [
      '' => ' - ',
      'col' => E::ts("columns"),
      'row' => E::ts("rows"),
    ];
    $this->_addressField = FALSE;

    // If we have a campaign, build out the relevant elements
    if ($campaignEnabled && !empty($this->_activeCampaigns)) {
      $this->_columns['civicrm_contribution']['fields']['campaign_id'] = [
        'title' => 'Campaign',
        'default' => 'false',
      ];
      $this->_columns['civicrm_contribution']['filters']['campaign_id'] = [
        'title' => ts('Campaign'),
        'operatorType' => CRM_Report_Form::OP_MULTISELECT,
        'options' => $this->_activeCampaigns,
      ];
      $this->_columns['civicrm_contribution']['group_bys']['campaign_id'] = ['title' => ts('Campaign')];
    }

    $this->_tagFilter = TRUE;
    $this->_groupFilter = TRUE;
    parent::__construct();

    $this->_columns['civicrm_contact']['fields'] = [];
    $this->_columns['civicrm_contact']['filters'] = $this->getBasicContactFilters();

    $this->_options['hideEmptyHeaders'] = [
      'type' => 'checkbox',
      'title' => E::ts('Hide Empty Headers'),
    ];
    $this->_options['showTotals'] = [
      'type' => 'checkbox',
      'title' => E::ts('Show Totals'),
    ];

    // disable pager selector for matrix report
    unset($this->_options['limit']);

    $this->_chartJSEnabled = TRUE;
  }

  public function addGroupBys() {
    $groupsBys = $freqElements = [];

    foreach ($this->_columns as $tableName => $table) {
      if (array_key_exists('group_bys', $table)) {
        foreach ($table['group_bys'] as $fieldName => $field) {
          if (!empty($field)) {
            $groupsBys[$fieldName] = $table['group_title'] . " :: " . $field['title'];
            if ($field['type'] & CRM_Utils_Type::T_DATE) {
              $freqElements[] = $fieldName;
            }
          }
        }
      }
    }
    $this->addElement('select', 'group_bys_column', E::ts('Select Columns'), ['' => E::ts('-- Select --')] + $groupsBys, ['class' => 'crm-select2 huge']);
    $this->addElement('select', 'group_bys_row', E::ts('Select Rows'), ['' => E::ts('-- Select --')] + $groupsBys, ['class' => 'crm-select2 huge']);
    $this->addElement('select', "group_bys_column_freq", ts('Frequency'), $this->_groupByDateFreq);
    $this->addElement('select', "group_bys_row_freq", ts('Frequency'), $this->_groupByDateFreq);

    $this->assign('freqElements', $freqElements);

    if (!empty($groupsBys)) {
      $this->tabs['GroupBy'] = [
        'title' => ts('Grouping'),
        'tpl' => 'GroupByPlus',
        'div_label' => 'group-by-elements',
      ];
    }
  }

  /**
   * Set select clause.
   */
  public function select() {
    $select = $this->_columnHeaders = [];
    $this->_colGroupByFreq = $this->_params['group_bys_column_freq'];
    $this->_rowGroupByFreq = $this->_params['group_bys_row_freq'];

    foreach ($this->_columns as $tableName => $table) {
      if (array_key_exists('fields', $table)) {
        foreach ($table['fields'] as $fieldName => $field) {
          if (!empty($field['required']) || !empty($this->_params['fields'][$fieldName])) {
            if ($tableName == 'civicrm_address') {
              $this->_addressField = TRUE;
            }

            if ($tableName == 'civicrm_statistics') {
              switch ($fieldName) {
                case 'sum':
                  $select[] = "SUM({$field['dbAlias']}) as 'value'";
                  $this->_currencyColumn = 'civicrm_contribution_currency';
                  break;

                case 'count':
                  $select[] = "COUNT({$field['dbAlias']}) as 'value'";
                  break;

                case 'avg':
                  $select[] = "ROUND(AVG({$field['dbAlias']}),2) as 'value'";
                  $this->_currencyColumn = 'civicrm_contribution_currency';
                  break;

                case 'max':
                  $select[] = "MAX({$field['dbAlias']}) as 'value'";
                  $this->_currencyColumn = 'civicrm_contribution_currency';
                  break;

                case 'min':
                  $select[] = "MIN({$field['dbAlias']}) as 'value'";
                  $this->_currencyColumn = 'civicrm_contribution_currency';
                  break;

                case 'count_distinct':
                  $select[] = "COUNT(DISTINCT " . $this->_aliases[$field['alias']] . ".{$field['dbAlias']}) as 'value'";
                  break;
              }
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

  public function from($entity = NULL) {
    $this->_from = "
        FROM civicrm_contact  {$this->_aliases['civicrm_contact']} {$this->_aclFrom}
    ";

    if ($this->_addressField) {
      $this->_from .= "
                  LEFT JOIN civicrm_address {$this->_aliases['civicrm_address']}
                         ON {$this->_aliases['civicrm_contact']}.id =
                            {$this->_aliases['civicrm_address']}.contact_id AND
                            {$this->_aliases['civicrm_address']}.is_primary = 1\n";
    }
  }

  public function orderBy() {
    $this->_orderBy = "ORDER BY row, col";
  }

  public function groupBy() {
    $this->_groupBy = "GROUP BY col, row";

    if ($this->_params['hideEmptyHeaders']['hideEmptyHeaders'] == '1') {
      $this->_having = ' HAVING col IS NOT NULL AND row IS NOT NULL ';
    }
  }

  /**
   * Override to set limit is 10
   * @param int $rowCount
   */
  public function limit($rowCount = self::ROW_COUNT_LIMIT) {
    $rowCount = 999999;
    parent::limit($rowCount);
  }

  /**
   * Override to set pager with limit is 10
   * @param int $rowCount
   */
  public function setPager($rowCount = self::ROW_COUNT_LIMIT) {
    $rowCount = 999999;
    parent::setPager($rowCount);
  }

  public function beginPostProcessCommon() {
    $this->_showTotals = $this->_params['showTotals'];
  }

  public function statistics(&$rows) {
    $statistics = parent::statistics($rows);
    $this->fieldStat($statistics);

    return $statistics;
  }

  public function countStat(&$statistics, $count) {
    parent::countStat($statistics, $count);
    $statistics['counts']['rowCount']['title'] = ts('Total Row(s)');
    $statistics['counts']['rowsFound']['title'] = E::ts('Total Values');
  }

  public function fieldStat(&$statistics) {
    foreach ($this->_columns as $tableName => $table) {
      if (array_key_exists('fields', $table)) {
        foreach ($table['fields'] as $fieldName => $field) {
          if (!empty($field['required']) || !empty($this->_params['fields'][$fieldName])) {
            if ($tableName == 'civicrm_statistics') {
              $statistics['fields']['stats'] = [
                'title' => ts('Statistics'),
                'value' => $field['title'],
              ];
              return;
            }
          }
        }
      }
    }
  }

  public function groupByStat(&$statistics) {
    foreach ($this->_columns as $tableName => $table) {
      if (array_key_exists('group_bys', $table)) {
        foreach ($table['group_bys'] as $fieldName => $field) {
          if ($this->_params['group_bys_column'] == $fieldName) {
            $combinations[] = E::ts('Columns') . ": " . $field['title'];
          }
          elseif ($this->_params['group_bys_row'] == $fieldName) {
            $combinations[] = E::ts('Rows') . ": " . $field['title'];
          }
        }
      }
    }

    $statistics['groups'][] = [
      'title' => ts('Grouping(s)'),
      'value' => implode('<br>', $combinations),
    ];
  }

  public function buildRows($sql, &$rows) {
    $dao = CRM_Core_DAO::executeQuery($sql);
    if (!is_array($rows)) {
      $rows = [];
    }
    $values = $dao->fetchAll();

    foreach ($values as $key => $value) {
      // set columns headers
      $column_name = !empty($value['col']) ? CRM_Utils_String::munge(strtolower($value['col'])) : 'empty';
      if (!array_key_exists($column_name, $this->_columnHeaders)) {
        $this->_columnHeaders["col_" . $column_name]['title'] = !empty($value['col']) ? $value['col'] : ts('N/A');
        $this->_columnHeaders["col_" . $column_name]['value'] = $value['col'];
        if ($this->_currencyColumn) {
          // Currency type
          $this->_columnHeaders["col_" . $column_name]['type'] = 1024;
        }
        else {
          $this->_columnHeaders["col_" . $column_name]['type'] = self::OP_INT;
        }
      }

      // set row headers
      $row_name = !empty($value['row']) ? CRM_Utils_String::munge(strtolower($value['row'])) : 'empty';
      if (!array_key_exists($row_name, $this->_rowHeaders)) {
        $this->_rowHeaders["row_" . $row_name]['title'] = !empty($value['row']) ? $value['row'] : ts('N/A');
        $this->_rowHeaders["row_" . $row_name]['value'] = $value['row'];
        if ($this->_currencyColumn) {
          // Currency type
          $this->_rowHeaders["row_" . $row_name]['type'] = 1024;
        }
        else {
          $this->_rowHeaders["row_" . $row_name]['type'] = self::OP_INT;
        }
      }

      $rows["row_" . $row_name]["col_" . $column_name] = $value['value'];
    }

    // use this method to modify $this->_columnHeaders
    $this->modifyColumnHeaders();
  }

  public function buildChartJS(&$rows) {
    if (!empty($this->_params['chartjs_type'])) {
      $this->_chartJSType = $this->_params['chartjs_type'];
      CRM_Reportplus_Utils_ChartJS::chart($rows, $this->_chartJSType, $this->_columnHeaders, $this->_params);

      $this->assign('chartJSType', $this->_chartJSType);
    }
  }

  public function modifyColumnHeaders() {
    $this->_setHeaderLabels($this->_columnHeaders, $this->_colField, $this->_colOptionsWeight);
    $this->_setHeaderLabels($this->_rowHeaders, $this->_rowField, $this->_rowOptionsWeight);

    if ($this->_showTotals) {
      $lastCol = end($this->_columnHeaders);
      $this->_columnHeaders['col_total'] = [
        'title' => ts('Total'),
        'value' => $lastCol['value'] + 1,
        'type' => $lastCol['type'],
      ];

      $lastRow = end($this->_rowHeaders);
      $this->_rowHeaders['row_total'] = [
        'title' => ts('Total'),
        'value' => $lastRow['value'] + 1,
        'type' => $lastRow['type'],
      ];
    }
  }

  public function alterDisplay(&$rows) {
    $tempRows = [];

    if (in_array($this->_outputMode, ['excel2007', 'csv'])) {
      foreach ($this->_rowHeaders as $keyR => $valueR) {
        $tempRows[$valueR['title']]['rows'] = $valueR['title'];
        foreach ($this->_columnHeaders as $keyC => $valueC) {
          $tempRows[$valueR['title']][$keyC] = $rows[$keyR][$keyC];
        }
      }

      $rowsItem = [
        'rows' => [
          'value' => '',
          'title' => '',
          'type' => 2,
        ],
      ];
      $this->_columnHeaders = $rowsItem + $this->_columnHeaders;
    }
    else {
      $this->_rowsFound = 0;

      foreach ($this->_rowHeaders as $keyR => $valueR) {
        foreach ($this->_columnHeaders as $keyC => $valueC) {
          $val = empty($rows[$keyR][$keyC]) ? '0' : $rows[$keyR][$keyC];
          $tempRows[$valueR['title']][$keyC] = $val;

          $this->_rowsFound++;
        }
      }
    }

    if ($this->_showTotals) {
      $this->calculateTotals($tempRows);
    }

    $rows = $tempRows;
  }

  public static function calculateTotals(&$rows) {
    $colTotal = [];
    $tempRows = $rows;

    foreach ($rows as $keyR => $valueR) {
      $rowTotal = 0;
      foreach ($valueR as $key => $value) {
        $floatval = floatval($value);
        $tempRows['Total'][$key] += $floatval;
        $tempRows['Total']['col_total'] += $floatval;
        $tempRows[$keyR]['col_total'] += $floatval;
      }
      $tempRows[$keyR]['col_total'] = '<b>' . $tempRows[$keyR]['col_total'] . '</b>';
    }

    foreach ($tempRows['Total'] as $key => $value) {
      $tempRows['Total'][$key] = '<b>' . $value . '</b>';
    }
    $rows = $tempRows;
  }

  public static function formRule($fields, $files, $self) {
    $errors = [];

    if (count($fields['fields']) == 0) {
      $errors['fields'] = E::ts("Please select one statistic to be displayed");
    }
    elseif (count($fields['fields']) > 1) {
      $errors['fields'] = E::ts("Please select only one statistic to be displayed");
    }
    elseif (!$fields['group_bys_row']) {
      $errors['group_bys_row'] = E::ts("Please select one field to be the rows");
    }
    elseif (!$fields['group_bys_column']) {
      $errors['group_bys_column'] = E::ts("Please select one field to be the columns");
    }

    if ($fields['chartjs_enabled'] && empty($fields['chartjs_type'])) {
      $errors['chartjs_type'] = E::ts("Please select one Chart JS type");
    }

    return $errors;
  }

  public function addOrderBys() {
  }

  protected function assignTabs() {
    $order = [
      'FieldSelection',
      'GroupBy',
      'ReportOptions',
      'Filters',
    ];
    $order = array_intersect_key(array_fill_keys($order, 1), $this->tabs);
    $order = array_merge($order, $this->tabs);
    $this->assign('tabs', $order);
  }

  public function addCustomDataToColumns($addFields = TRUE, $permCustomGroupIds = []) {
    if (empty($this->_customGroupExtends)) {
      return;
    }
    if (!is_array($this->_customGroupExtends)) {
      $this->_customGroupExtends = [$this->_customGroupExtends];
    }
    $customGroupWhere = '';
    if (!empty($permCustomGroupIds)) {
      $customGroupWhere = "cg.id IN (" . implode(',', $permCustomGroupIds) .
        ") AND";
    }
    $sql = "
      SELECT cg.table_name, cg.title, cg.extends, cf.id as cf_id, cf.label,
             cf.column_name, cf.data_type, cf.html_type, cf.option_group_id, cf.time_format
      FROM   civicrm_custom_group cg
      INNER  JOIN civicrm_custom_field cf ON cg.id = cf.custom_group_id
      WHERE cg.extends IN ('" . implode("','", $this->_customGroupExtends) . "') AND
            {$customGroupWhere}
            cg.is_active = 1 AND
            cf.is_active = 1 AND
            cf.is_searchable = 1
      ORDER BY cg.weight, cf.weight";
    $customDAO = CRM_Core_DAO::executeQuery($sql);

    $curTable = NULL;
    while ($customDAO->fetch()) {
      if ($customDAO->table_name != $curTable) {
        $curTable = $customDAO->table_name;
        $curFields = $curFilters = [];

        // dummy dao object
        $this->_columns[$curTable]['dao'] = 'CRM_Contact_DAO_Contact';
        $this->_columns[$curTable]['extends'] = $customDAO->extends;
        $this->_columns[$curTable]['grouping'] = $customDAO->table_name;
        $this->_columns[$curTable]['group_title'] = $customDAO->title;

        foreach ([
          'filters',
          'group_bys',
        ] as $colKey) {
          if (!array_key_exists($colKey, $this->_columns[$curTable])) {
            $this->_columns[$curTable][$colKey] = [];
          }
        }
      }
      $fieldName = 'custom_' . $customDAO->cf_id;

      if ($addFields) {
        // this makes aliasing work in favor
        $curFields[$fieldName] = [
          'name' => $customDAO->column_name,
          'title' => $customDAO->label,
          'dataType' => $customDAO->data_type,
          'htmlType' => $customDAO->html_type,
        ];
      }
      if ($this->_customGroupFilters) {
        // this makes aliasing work in favor
        $curFilters[$fieldName] = [
          'name' => $customDAO->column_name,
          'title' => $customDAO->label,
          'dataType' => $customDAO->data_type,
          'htmlType' => $customDAO->html_type,
        ];
      }

      switch ($customDAO->data_type) {
        case 'Date':
          // filters
          $curFilters[$fieldName]['operatorType'] = CRM_Report_Form::OP_DATE;
          $curFilters[$fieldName]['type'] = CRM_Utils_Type::T_DATE;
          // CRM-6946, show time part for datetime date fields
          if ($customDAO->time_format) {
            $curFields[$fieldName]['type'] = CRM_Utils_Type::T_TIMESTAMP;
          }
          break;

        case 'Boolean':
          $curFilters[$fieldName]['operatorType'] = CRM_Report_Form::OP_SELECT;
          $curFilters[$fieldName]['options'] = [
            '' => ts('- select -'),
            1 => ts('Yes'),
            0 => ts('No'),
          ];
          $curFilters[$fieldName]['type'] = CRM_Utils_Type::T_INT;
          break;

        case 'Int':
          $curFilters[$fieldName]['operatorType'] = CRM_Report_Form::OP_INT;
          $curFilters[$fieldName]['type'] = CRM_Utils_Type::T_INT;
          break;

        case 'Money':
          $curFilters[$fieldName]['operatorType'] = CRM_Report_Form::OP_FLOAT;
          $curFilters[$fieldName]['type'] = CRM_Utils_Type::T_MONEY;
          break;

        case 'Float':
          $curFilters[$fieldName]['operatorType'] = CRM_Report_Form::OP_FLOAT;
          $curFilters[$fieldName]['type'] = CRM_Utils_Type::T_FLOAT;
          break;

        case 'String':
          $curFilters[$fieldName]['type'] = CRM_Utils_Type::T_STRING;

          if (!empty($customDAO->option_group_id)) {
            if (in_array($customDAO->html_type, [
              'Multi-Select',
              'AdvMulti-Select',
              'CheckBox',
            ])) {
              $curFilters[$fieldName]['operatorType'] = CRM_Report_Form::OP_MULTISELECT_SEPARATOR;
            }
            else {
              $curFilters[$fieldName]['operatorType'] = CRM_Report_Form::OP_MULTISELECT;
            }
            if ($this->_customGroupFilters) {
              $curFilters[$fieldName]['options'] = [];
              $ogDAO = CRM_Core_DAO::executeQuery("SELECT ov.value, ov.label FROM civicrm_option_value ov WHERE ov.option_group_id = %1 ORDER BY ov.weight", [
                1 => [
                  $customDAO->option_group_id,
                  'Integer',
                ],
              ]);
              while ($ogDAO->fetch()) {
                $curFilters[$fieldName]['options'][$ogDAO->value] = $ogDAO->label;
              }
              CRM_Utils_Hook::customFieldOptions($customDAO->cf_id, $curFilters[$fieldName]['options'], FALSE);
            }
          }
          break;

        case 'StateProvince':
          if (in_array($customDAO->html_type, [
            'Multi-Select State/Province',
          ])) {
            $curFilters[$fieldName]['operatorType'] = CRM_Report_Form::OP_MULTISELECT_SEPARATOR;
          }
          else {
            $curFilters[$fieldName]['operatorType'] = CRM_Report_Form::OP_MULTISELECT;
          }
          $curFilters[$fieldName]['options'] = CRM_Core_PseudoConstant::stateProvince();
          break;

        case 'Country':
          if (in_array($customDAO->html_type, [
            'Multi-Select Country',
          ])) {
            $curFilters[$fieldName]['operatorType'] = CRM_Report_Form::OP_MULTISELECT_SEPARATOR;
          }
          else {
            $curFilters[$fieldName]['operatorType'] = CRM_Report_Form::OP_MULTISELECT;
          }
          $curFilters[$fieldName]['options'] = CRM_Core_PseudoConstant::country();
          break;

        case 'ContactReference':
          $curFilters[$fieldName]['type'] = CRM_Utils_Type::T_STRING;
          $curFilters[$fieldName]['name'] = 'display_name';
          $curFilters[$fieldName]['alias'] = "contact_{$fieldName}_civireport";

          $curFields[$fieldName]['type'] = CRM_Utils_Type::T_STRING;
          $curFields[$fieldName]['name'] = 'display_name';
          $curFields[$fieldName]['alias'] = "contact_{$fieldName}_civireport";
          break;

        default:
          $curFields[$fieldName]['type'] = CRM_Utils_Type::T_STRING;
          $curFilters[$fieldName]['type'] = CRM_Utils_Type::T_STRING;
      }

      if (!array_key_exists('type', $curFields[$fieldName])) {
        $curFields[$fieldName]['type'] = CRM_Utils_Array::value('type', $curFilters[$fieldName], []);
      }

      if ($this->_customGroupFilters) {
        $this->_columns[$curTable]['filters'] = array_merge($this->_columns[$curTable]['filters'], $curFilters);
      }
      if ($this->_customGroupGroupBy) {
        $this->_columns[$curTable]['group_bys'] = array_merge($this->_columns[$curTable]['group_bys'], $curFields);
      }
    }
  }

  /**
   * Build custom data from clause.
   */
  public function customDataFrom($joinsForFiltersOnly = FALSE) {
    if (empty($this->_customGroupExtends)) {
      return;
    }
    $mapper = CRM_Core_BAO_CustomQuery::$extendsMap;

    foreach ($this->_columns as $table => $prop) {
      if (substr($table, 0, 13) == 'civicrm_value' ||
        substr($table, 0, 12) == 'custom_value'
      ) {
        $extendsTable = $mapper[$prop['extends']];

        // check field is in params
        // Check field is required for rendering the report.
        if ((!$this->isFieldSelected($prop)) || ($joinsForFiltersOnly && !$this->isFieldFiltered($prop))) {
          continue;
        }
        $baseJoin = CRM_Utils_Array::value($prop['extends'], $this->_customGroupExtendsJoin, "{$this->_aliases[$extendsTable]}.id");

        $customJoin = is_array($this->_customGroupJoin) ? $this->_customGroupJoin[$table] : $this->_customGroupJoin;
        $this->_from .= "
{$customJoin} {$table} {$this->_aliases[$table]} ON {$this->_aliases[$table]}.entity_id = {$baseJoin}";
        // handle for ContactReference
        if (array_key_exists('group_bys', $prop)) {
          foreach ($prop['group_bys'] as $fieldName => $field) {
            if (CRM_Utils_Array::value('dataType', $field) ==
              'ContactReference'
            ) {
              $columnName = CRM_Core_DAO::getFieldValue('CRM_Core_DAO_CustomField', CRM_Core_BAO_CustomField::getKeyID($fieldName), 'column_name');
              $this->_from .= "
LEFT JOIN civicrm_contact {$field['alias']} ON {$field['alias']}.id = {$this->_aliases[$table]}.{$columnName} ";
            }
          }
        }
      }
    }
  }

  public function isFieldSelected($prop) {
    if (empty($prop)) {
      return FALSE;
    }

    if (!empty($this->_params['fields']) && isset($prop['fields'])) {
      foreach (array_keys($prop['fields']) as $fieldAlias) {
        $customFieldId = CRM_Core_BAO_CustomField::getKeyID($fieldAlias);
        if ($customFieldId) {
          if (array_key_exists($fieldAlias, $this->_params['fields'])) {
            return TRUE;
          }

          //might be survey response field.
          if (!empty($this->_params['fields']['survey_response']) &&
            !empty($prop['fields'][$fieldAlias]['isSurveyResponseField'])
          ) {
            return TRUE;
          }
        }
      }
    }

    if ($this->_customGroupGroupBy) {
      foreach (array_keys($prop['group_bys']) as $fieldAlias) {
        if (CRM_Core_BAO_CustomField::getKeyID($fieldAlias)) {
          if (($this->_params['group_bys_column'] == $fieldAlias) ||
            ($this->_params['group_bys_row'] == $fieldAlias)) {
            return TRUE;
          }
        }
      }
    }

    if (!empty($this->_params['order_bys'])&& !empty($prop['fields'])) {
      foreach (array_keys($prop['fields']) as $fieldAlias) {
        foreach ($this->_params['order_bys'] as $orderBy) {
          if ($fieldAlias == $orderBy['column'] &&
            CRM_Core_BAO_CustomField::getKeyID($fieldAlias)
          ) {
            return TRUE;
          }
        }
      }
    }

    if (!empty($prop['filters']) && $this->_customGroupFilters) {
      foreach ($prop['filters'] as $fieldAlias => $val) {
        foreach ([
          'value',
          'min',
          'max',
          'relative',
          'from',
          'to',
        ] as $attach) {
          if (isset($this->_params[$fieldAlias . '_' . $attach]) &&
            (!empty($this->_params[$fieldAlias . '_' . $attach])
              || ($attach != 'relative' &&
                $this->_params[$fieldAlias . '_' . $attach] == '0')
            )
          ) {
            return TRUE;
          }
        }
        if (!empty($this->_params[$fieldAlias . '_op']) &&
          in_array($this->_params[$fieldAlias . '_op'], ['nll', 'nnll'])
        ) {
          return TRUE;
        }
      }
    }

    return FALSE;
  }

  private function _columnHeadersSort($a, $b) {
    return ($this->_colOptionsWeight[$a['value']] > $this->_colOptionsWeight[$b['value']]) ? +1 : -1;
  }

  private function _columnHeadersSortByDate($a, $b) {
    return ($a['value'] > $b['value']) ? +1 : -1;
  }

  private function _rowsSort($a, $b) {
    return ($this->_rowOptionsWeight[$a] > $this->_rowOptionsWeight[$b]) ? +1 : -1;
  }

  private function _getOptionValues($columnName) {
    $params = [
      'return'      => 'id, option_group_id',
      'column_name' => $columnName,
      'options'     => [
        'limit' => 0
      ],
      'api.OptionValue.get' => [
        'option_group_id' => "\$value.option_group_id",
        'return'          => 'value, label, weight',
        'options'     => [
          'limit' => 0
        ],
      ],
    ];
    $result  = civicrm_api3('CustomField', 'getsingle', $params);
    $options = $result['api.OptionValue.get']['values'];

    return $options;
  }

  private function _setColumnLabel(&$headers, $labels) {
    foreach ($headers as $key => $value) {
      if (!empty($labels[$value['value']])) {
        $headers[$key]['title'] = $labels[$value['value']];
      }
    }
  }

  private function _setHeaderLabels(&$headers, $field, &$weights) {
    switch ($field['name']) {
      case 'gender_id':
        $genders = CRM_Core_PseudoConstant::get('CRM_Contact_DAO_Contact', 'gender_id', ['localize' => TRUE]);
        $this->_setColumnLabel($headers, $genders);
        break;

      case 'country_id':
        $countries = CRM_Core_PseudoConstant::country(FALSE, FALSE);
        $this->_setColumnLabel($headers, $countries);
        break;

      case 'state_province_id':
        $states = CRM_Core_PseudoConstant::stateProvince(FALSE, FALSE);
        $this->_setColumnLabel($headers, $states);
        break;

      case 'county_id':
        $counties = CRM_Core_PseudoConstant::county(FALSE);
        $this->_setColumnLabel($headers, $counties);
        break;

      case 'membership_type_id':
        $membershipTypes = CRM_Member_PseudoConstant::membershipType(FALSE, FALSE);
        $this->_setColumnLabel($headers, $membershipTypes);
        break;

      case 'status_id':
        if ($field['table_name'] == 'civicrm_activity') {
          $status = CRM_Core_PseudoConstant::activityStatus();
        }
        elseif ($field['table_name'] == 'civicrm_case') {
          $status = CRM_Core_PseudoConstant::get('CRM_Case_DAO_Case', 'status_id', ['localize' => TRUE]);
        }
        else {
          $status = CRM_Member_PseudoConstant::membershipStatus(NULL, NULL, 'label');
        }
        $this->_setColumnLabel($headers, $status);
        break;

      case 'contribution_status_id':
        $status = CRM_Contribute_PseudoConstant::contributionStatus();
        $this->_setColumnLabel($headers, $status);
        break;

      case 'payment_instrument_id':
        $payment_instrument = CRM_Contribute_PseudoConstant::paymentInstrument();
        $this->_setColumnLabel($headers, $payment_instrument);
        break;

      case 'activity_type_id':
        $type = CRM_Core_PseudoConstant::activityType(TRUE, TRUE, FALSE, 'label', FALSE);
        $this->_setColumnLabel($headers, $type);
        break;

      case 'campaign_id':
        $campaigns = array_merge($this->_activeCampaigns, $this->_disabledCampaigns);
        $this->_setColumnLabel($headers, $campaigns);
        break;

      default:
        // Date
        if ($field['type'] == 12) {

          uasort($headers, ['CRM_Reportplus_Form_Matrix', '_columnHeadersSortByDate']);
        }
        // String
        elseif ($field['type'] == 2) {

          if (in_array($field['htmlType'], ['Select', 'Autocomplete-Select'])) {
            $options = $this->_getOptionValues($field['name']);
            $optionLabels = [];
            foreach ($options as $key => $value) {
              $weights[$value['value']] = $value['weight'];
              $optionLabels[$value['value']] = $value['label'];
            }
            uasort($headers, ['CRM_Reportplus_Form_Matrix', '_columnHeadersSort']);
            $this->_setColumnLabel($headers, $optionLabels);
          }
        }
        break;
    }
  }

}
