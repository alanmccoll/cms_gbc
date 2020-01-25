<?php

class CRM_Reportplus_Form_Case_Matrix extends CRM_Reportplus_Form_Contact_Matrix {
  
  /**
   * Class constructor.
   */
  public function __construct() {

    parent::__construct();

    // Extends Contact Matrix with Case entity
    array_push($this->_customGroupExtends, 'Case');

    $this->_columns['civicrm_case'] = [
      'group_title' => ts('Case'),
      'dao' => 'CRM_Case_DAO_Case',
      'fields' => [],
      'grouping' => 'case-fields',
      'group-title' => 'Case',
      'group_bys' => [
        'subject' => [
          'title' => ts('Case Subject'),
        ],
        'status_id' => [
          'title' => ts('Case Status'),
        ],
      ],
      'filters' => [
        'subject' => [
          'title' => ts('Case Subject'),
          'type' => CRM_Utils_Type::T_STRING,
          'operatorType' => CRM_Report_Form::OP_STRING,
        ],
        'status_id' => [
          'title' => ts('Case Status'),
          'type' => CRM_Utils_Type::T_INT,
          'operatorType' => CRM_Report_Form::OP_MULTISELECT,
          'options' => CRM_Case_BAO_Case::buildOptions('status_id', 'search'),
        ],
        'case_type_id' => [
          'title' => ts('Case Type'),
          'type' => CRM_Utils_Type::T_INT,
          'operatorType' => CRM_Report_Form::OP_MULTISELECT,
          'options' => CRM_Case_PseudoConstant::caseType(),
        ],
      ],
    ];

    $this->_columns['civicrm_case_type'] = [
      'group_title' => ts('Case'),
      'dao' => 'CRM_Case_DAO_CaseType',
      'fields' => [],
      'grouping' => 'case-fields',
      'group_bys' => [
        'title' => ['title' => ts('Case Type')],
      ],
    ];

  }

  public function from($entity = NULL) {
    parent::from($entity);

    $case = $this->_aliases['civicrm_case'];
    $type = $this->_aliases['civicrm_case_type'];
    $contact = $this->_aliases['civicrm_contact'];

    $extendedCaseQuery = "
          INNER JOIN civicrm_case_contact civireport_case_contact on civireport_case_contact.contact_id = {$contact}.id
          INNER JOIN civicrm_case $case ON {$case}.id = civireport_case_contact.case_id
          INNER JOIN civicrm_case_type {$type} ON {$case}.case_type_id = {$type}.id";

    $this->_from = $this->_from . $extendedCaseQuery;
  }

}
