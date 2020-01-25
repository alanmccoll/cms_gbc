<?php
use CRM_Reportplus_ExtensionUtil as E;

// This file declares a managed database record of type "ReportTemplate".
// The record will be automatically inserted, updated, or deleted from the
// database as appropriate. For more details, see "hook_civicrm_managed" at:
// http://wiki.civicrm.org/confluence/display/CRMDOC42/Hook+Reference
return [
  0 =>
  [
    'name' => 'CRM_Reportplus_Form_Member_Summary',
    'entity' => 'ReportTemplate',
    'params' =>
    [
      'version' => 3,
      'label' => E::ts('Member Summary Plus'),
      'description' => E::ts('Member Summary Plus'),
      'class_name' => 'CRM_Reportplus_Form_Member_Summary',
      'report_url' => 'member/summary/plus',
      'component' => 'ReportPlus',
    ],
  ],
];
