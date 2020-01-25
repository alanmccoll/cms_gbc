<?php

class CRM_Reportplus_Form_Contact_Matrix extends CRM_Reportplus_Form_Matrix {
  /**
   * Class constructor.
   */
  public function __construct() {
    $this->_customGroupExtends = ['Contact', 'Individual', 'Organization'];
    $this->_customGroupGroupBy = TRUE;
    $this->_addressField = TRUE;

    $this->_columns = [
      'civicrm_statistics' => [
        'dao' => 'CRM_Contact_DAO_Contact',
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
            'title' => ts('Is Deceased'),
          ],
          'deceased_date' => [
            'title' => ts('Deceased Date'),
          ],
        ],
      ],
    ] + $this->addAddressFields(TRUE, FALSE, TRUE, [], FALSE);

    parent::__construct();
  }

  public function from($entity = NULL) {
    parent::from($entity);
  }

}
