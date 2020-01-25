<?php

class CRM_Reportplus_Form_Member_Matrix extends CRM_Reportplus_Form_Matrix {

  /**
   * Class constructor.
   */
  public function __construct() {
    $this->_customGroupExtends = ['Membership', 'Contact', 'Individual', 'Household', 'Organization'];
    $this->_customGroupGroupBy = TRUE;
    $this->_addressField = FALSE;

    $this->_columns = [
      'civicrm_statistics' => [
        'dao' => 'CRM_Contribute_DAO_Contribution',
        'fields' => [
          'count' => [
            'title' => ts('Count'),
            'default' => TRUE,
            'dbAlias' => '*',
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
          'is_deceased' => [
            'title' => ts('Contact is Deceased'),
          ],
          'deceased_date' => [
            'title' => ts('Deceased Date'),
          ],
        ],
      ],
      'civicrm_membership' => [
        'dao' => 'CRM_Member_DAO_MembershipType',
        'grouping' => 'member-fields',
        'fields' => [],
        'filters' => [
          'join_date' => [
            'title' => ts('Member Since'),
            'type' => CRM_Utils_Type::T_DATE,
            'operatorType' => CRM_Report_Form::OP_DATE,
          ],
          'membership_start_date' => [
            'name' => 'start_date',
            'title' => ts('Membership Start Date'),
            'type' => CRM_Utils_Type::T_DATE,
            'operatorType' => CRM_Report_Form::OP_DATE,
          ],
          'membership_end_date' => [
            'name' => 'end_date',
            'title' => ts('Membership End Date'),
            'type' => CRM_Utils_Type::T_DATE,
            'operatorType' => CRM_Report_Form::OP_DATE,
          ],
          'owner_membership_id' => [
            'title' => ts('Membership Owner ID'),
            'type' => CRM_Utils_Type::T_INT,
            'operatorType' => CRM_Report_Form::OP_INT,
          ],
          'membership_type_id' => [
            'title' => ts('Membership Type'),
            'operatorType' => CRM_Report_Form::OP_MULTISELECT,
            'options' => CRM_Member_PseudoConstant::membershipType(),
            'type' => CRM_Utils_Type::T_INT,
          ],
          'status_id' => [
            'title' => ts('Membership Status'),
            'operatorType' => CRM_Report_Form::OP_MULTISELECT,
            'options' => CRM_Member_PseudoConstant::membershipStatus(NULL, NULL, 'label'),
            'type' => CRM_Utils_Type::T_INT,
          ],
        ],
        'group_bys' => [
          'join_date' => [
            'title' => ts('Member Since'),
            'default' => FALSE,
            'frequency' => TRUE,
            'type' => 12,
          ],
          'membership_start_date' => [
            'title' => ts('Membership Start Date'),
            'default' => FALSE,
            'frequency' => TRUE,
            'type' => 12,
          ],
          'membership_end_date' => [
            'name' => 'end_date',
            'title' => ts('Membership End Date'),
            'default' => FALSE,
            'frequency' => TRUE,
            'type' => 12,
          ],
          'membership_type_id' => [
            'title' => 'Membership Type',
            'default' => FALSE,
          ],
          'status_id' => [
            'title' => ts('Membership Status'),
            'default' => FALSE,
          ],
        ],
      ],
    ] + $this->addAddressFields(TRUE, FALSE, TRUE, [], FALSE);

    parent::__construct();
    $this->addCampaignFields('civicrm_membership', TRUE, FALSE, TRUE, FALSE);
  }

  public function from($entity = NULL) {
    parent::from($entity);

    $this->_from .= "
             INNER JOIN civicrm_membership   {$this->_aliases['civicrm_membership']}
                     ON {$this->_aliases['civicrm_contact']}.id = {$this->_aliases['civicrm_membership']}.contact_id
                     ";
  }

}
