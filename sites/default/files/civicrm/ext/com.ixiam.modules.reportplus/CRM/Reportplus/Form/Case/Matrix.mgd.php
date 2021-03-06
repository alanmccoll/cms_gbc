<?php
use CRM_Reportplus_ExtensionUtil as E;

// This file declares a managed database record of type "ReportTemplate".
// The record will be automatically inserted, updated, or deleted from the
// database as appropriate. For more details, see "hook_civicrm_managed" at:
// http://wiki.civicrm.org/confluence/display/CRMDOC42/Hook+Reference
return [
  0 =>
  [
    'name' => 'CRM_Reportplus_Form_Case_Matrix',
    'entity' => 'ReportTemplate',
    'params' =>
    [
      'version' => 3,
      'label' => E::ts('Case Matrix Plus'),
      'description' => E::ts('Case Matrix Plus'),
      'class_name' => 'CRM_Reportplus_Form_Case_Matrix',
      'report_url' => 'case/matrix',
      'component' => 'ReportPlus',
    ],
  ],
];
