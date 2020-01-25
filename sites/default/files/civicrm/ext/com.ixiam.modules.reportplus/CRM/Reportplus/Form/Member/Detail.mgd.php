<?php
use CRM_Reportplus_ExtensionUtil as E;

// This file declares a managed database record of type "ReportTemplate".
// The record will be automatically inserted, updated, or deleted from the
// database as appropriate. For more details, see "hook_civicrm_managed" at:
// http://wiki.civicrm.org/confluence/display/CRMDOC42/Hook+Reference
return [
  0 =>
  [
    'name' => 'CRM_Reportplus_Form_Member_Detail',
    'entity' => 'ReportTemplate',
    'params' =>
    [
      'version' => 3,
      'label' => E::ts('Member Detail Plus'),
      'description' => E::ts('Member Detail Plus'),
      'class_name' => 'CRM_Reportplus_Form_Member_Detail',
      'report_url' => 'member/detail/plus',
      'component' => 'ReportPlus',
    ],
  ],
];
