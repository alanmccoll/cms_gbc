<?php
use CRM_Reportplus_ExtensionUtil as E;

class CRM_Reportplus_Form_Contribute_Matrix extends CRM_Reportplus_Form_Matrix {
  /**
   * Class constructor.
   */
  public function __construct() {
    $this->_customGroupExtends = ['Contribution', 'Contact', 'Individual'];
    $this->_customGroupGroupBy = TRUE;
    $this->_addressField = FALSE;

    $this->_columns = [
      'civicrm_statistics' => [
        'dao' => 'CRM_Contribute_DAO_Contribution',
        'fields' => [
          'count' => [
            'title' => E::ts('Contribution Count'),
            'default' => FALSE,
            'dbAlias' => 'total_amount',
          ],
          'sum' => [
            'title' => E::ts('Contribution Total'),
            'default' => TRUE,
            'dbAlias' => 'total_amount',
          ],
          'avg' => [
            'title' => E::ts('Contribution Avg'),
            'default' => FALSE,
            'dbAlias' => 'total_amount',
          ],
          'max' => [
            'title' => E::ts('Contribution Max'),
            'default' => FALSE,
            'dbAlias' => 'total_amount',
          ],
          'min' => [
            'title' => E::ts('Contribution Min'),
            'default' => FALSE,
            'dbAlias' => 'total_amount',
          ],
          'count_distinct' => [
            'title' => E::ts('Unique Contacts'),
            'default' => FALSE,
            'alias' => 'civicrm_contribution',
            'dbAlias' => 'contact_id',
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
          'display_name' => [
            'title' => ts('Display Name'),
          ],
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
          'is_deceased' => [
            'title' => ts('Contact is Deceased'),
          ],
          'deceased_date' => [
            'title' => ts('Deceased Date'),
          ],
        ],
      ],
      'civicrm_financial_type' => [
        'dao' => 'CRM_Financial_DAO_FinancialType',
        'fields' => [],
        'grouping' => 'contri-fields',
        'group_bys' => [
          'financial_type' => ['title' => ts('Financial Type')],
        ],
      ],
      'civicrm_contribution' => [
        'dao' => 'CRM_Contribute_DAO_Contribution',
        //'bao'           => 'CRM_Contribute_BAO_Contribution',
        'fields' => [],
        'grouping' => 'contri-fields',
        'filters' => [
          'receive_date' => ['operatorType' => CRM_Report_Form::OP_DATE],
          'contribution_status_id' => [
            'title' => ts('Contribution Status'),
            'operatorType' => CRM_Report_Form::OP_MULTISELECT,
            'options' => CRM_Contribute_PseudoConstant::contributionStatus(),
            'default' => [1],
            'type' => CRM_Utils_Type::T_INT,
          ],
          'currency' => [
            'title' => ts('Currency'),
            'operatorType' => CRM_Report_Form::OP_MULTISELECT,
            'options' => CRM_Core_OptionGroup::values('currencies_enabled'),
            'default' => NULL,
            'type' => CRM_Utils_Type::T_STRING,
          ],
          'financial_type_id' => [
            'title' => ts('Financial Type'),
            'operatorType' => CRM_Report_Form::OP_MULTISELECT,
            'options' => CRM_Contribute_PseudoConstant::financialType(),
            'type' => CRM_Utils_Type::T_INT,
          ],
          'payment_instrument_id' => [
            'title' => ts('Payment Type'),
            'operatorType' => CRM_Report_Form::OP_MULTISELECT,
            'options' => CRM_Contribute_PseudoConstant::paymentInstrument(),
            'type' => CRM_Utils_Type::T_INT,
          ],
          'contribution_page_id' => [
            'title' => ts('Contribution Page'),
            'operatorType' => CRM_Report_Form::OP_MULTISELECT,
            'options' => CRM_Contribute_PseudoConstant::contributionPage(),
            'type' => CRM_Utils_Type::T_INT,
          ],
          'total_amount' => [
            'title' => ts('Contribution Amount'),
          ],
          'total_sum' => [
            'title' => ts('Contribution Aggregate'),
            'type' => CRM_Report_Form::OP_INT,
            'dbAlias' => 'civicrm_contribution_total_amount_sum',
            'having' => TRUE,
          ],
          'total_count' => [
            'title' => ts('Contribution Count'),
            'type' => CRM_Report_Form::OP_INT,
            'dbAlias' => 'civicrm_contribution_total_amount_count',
            'having' => TRUE,
          ],
          'total_avg' => [
            'title' => ts('Contribution Avg'),
            'type' => CRM_Report_Form::OP_INT,
            'dbAlias' => 'civicrm_contribution_total_amount_avg',
            'having' => TRUE,
          ],
          'cancel_date' => [
            'title' => ts('Cancel Date'),
            'operatorType' => CRM_Report_Form::OP_DATE,
            'type' => CRM_Utils_Type::T_DATE,
          ],
          'cancel_reason' => [
            'title' => ts('Cancel Reason'),
            'operator' => 'like',
          ],
          'source' => [
            'title' => ts('Source'),
            'operator' => 'like',
            'default' => NULL,
            'type' => CRM_Utils_Type::T_STRING,
          ],
          'contribution_recur_id' => [
            'title' => ts('Contribution is Recurring?'),
            'operatorType' => CRM_Report_Form::OP_SELECT,
            'type' => CRM_Utils_Type::T_BOOLEAN,
            'options' => [
              '' => ts('Any'),
              '0' => ts('Yes'),
              '1' => ts('No'),
            ],
            'dbAlias' => 'ISNULL(contribution_civireport.contribution_recur_id)',
          ],
        ],
        'group_bys' => [
          'receive_date' => [
            'frequency' => TRUE,
            'default' => FALSE,
          ],
          'contribution_source' => NULL,
          'contribution_status_id' => [
            'title' => ts('Contribution Status'),
            'operatorType' => CRM_Report_Form::OP_MULTISELECT,
            'options' => CRM_Contribute_PseudoConstant::contributionStatus(),
            'type' => CRM_Utils_Type::T_INT,
            'default' => FALSE,
          ],
          'currency' => [
            'title' => ts('Currency'),
            'default' => FALSE,
          ],
          'payment_instrument_id' => [
            'title' => ts('Payment Type'),
            'operatorType' => CRM_Report_Form::OP_MULTISELECT,
            'options' => CRM_Contribute_PseudoConstant::paymentInstrument(),
            'type' => CRM_Utils_Type::T_INT,
          ],
          'source' => [
            'title' => ts('Source'),
            'default' => FALSE,
          ],
        ],
      ],
    ] + $this->addAddressFields(TRUE, FALSE, TRUE, [], FALSE);

    parent::__construct();

    $this->addCampaignFields('civicrm_contribution', TRUE, FALSE, TRUE, FALSE);
  }

  public function from($entity = NULL) {
    parent::from($entity);

    $this->_from .= "
             INNER JOIN civicrm_contribution   {$this->_aliases['civicrm_contribution']}
                     ON {$this->_aliases['civicrm_contact']}.id = {$this->_aliases['civicrm_contribution']}.contact_id AND
                        {$this->_aliases['civicrm_contribution']}.is_test = 0
             LEFT  JOIN civicrm_financial_type  {$this->_aliases['civicrm_financial_type']}
                     ON {$this->_aliases['civicrm_contribution']}.financial_type_id ={$this->_aliases['civicrm_financial_type']}.id
                     ";
  }

}
