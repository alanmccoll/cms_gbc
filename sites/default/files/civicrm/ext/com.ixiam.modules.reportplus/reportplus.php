<?php

require_once 'reportplus.civix.php';
use CRM_Reportplus_ExtensionUtil as E;

/**
 * Implementation of hook_civicrm_permission().
 *
 * Create ad-hoc ReportPlus permission
 */
function reportplus_civicrm_permission(array &$permissions) {
  $prefix = ts('ReportPlus') . ': ';
  $permissions['access ReportPlus'] = [
    $prefix . 'acccess ReportPlus',
    E::ts('access templates and instances from ReportPlus Extension'),
  ];
  $permissions['administer ReportPlus'] = [
    $prefix . 'administer ReportPlus',
    E::ts('administer templates from ReportPlus Extension'),
  ];
}

/**
 * Implementation of hook_civicrm_pageRun().
 *
 * Used to display ReportPlus templates and instances based on permissions
 */
function reportplus_civicrm_pageRun(&$page) {
  $pageName = $page->getVar('_name');

  if (CRM_Core_Permission::check([['access ReportPlus', 'administer ReportPlus']])) {
    // Add Reportplus templates to the list (if permissions)
    if ($pageName == 'CRM_Report_Page_TemplateList') {

      $sql = "
        SELECT  v.id, v.value, v.label, v.description, v.component_id, comp.name as component_name, v.grouping, inst.id as instance_id
        FROM    civicrm_option_value v
        INNER JOIN civicrm_option_group g
                ON (v.option_group_id = g.id AND g.name = 'report_template')
        LEFT  JOIN civicrm_report_instance inst
                ON v.value = inst.report_id
        LEFT  JOIN civicrm_component comp
                ON v.component_id = comp.id
        ";
      $sql .= " WHERE v.is_active = 1 AND comp.name = 'ReportPlus' ";
      $sql .= " ORDER BY  v.label ";

      $dao = CRM_Core_DAO::executeQuery($sql);
      $rows = array();
      $config = CRM_Core_Config::singleton();
      while ($dao->fetch()) {
        $rows[$dao->component_name][$dao->value]['title'] = ts($dao->label);
        $rows[$dao->component_name][$dao->value]['description'] = ts($dao->description);
        $rows[$dao->component_name][$dao->value]['url'] = CRM_Utils_System::url('civicrm/report/' . trim($dao->value, '/'), 'reset=1');
        if ($dao->instance_id) {
          $rows[$dao->component_name][$dao->value]['instanceUrl'] = CRM_Utils_System::url('civicrm/report/list',
            "reset=1&ovid={$dao->id}"
          );
        }
      }

      $oldRows = CRM_Core_Smarty::singleton()->_tpl_vars['list'];
      $newRows = $oldRows + $rows;
      $page->assign('list', $newRows);
    }
    // Add Reportplus instances to the list
    elseif ($pageName == 'CRM_Report_Page_InstanceList') {
      $report = '';

      $sql = "
          SELECT inst.id, inst.title, inst.report_id, inst.description, v.label, v.grouping, comp.name as compName
            FROM civicrm_option_group g
            LEFT JOIN civicrm_option_value v
                   ON v.option_group_id = g.id AND
                      g.name  = 'report_template'
            LEFT JOIN civicrm_report_instance inst
                   ON v.value = inst.report_id
            LEFT JOIN civicrm_component comp
                   ON v.component_id = comp.id

            WHERE v.is_active = 1
                  AND inst.domain_id = %1
                  AND comp.name = 'ReportPlus'
            ORDER BY  v.weight";

      $dao = CRM_Core_DAO::executeQuery($sql, array(
        1 => array(CRM_Core_Config::domainID(), 'Integer'),
      ));

      $config = CRM_Core_Config::singleton();
      $rows = array();
      $url = 'civicrm/report/instance';
      while ($dao->fetch()) {
        $enabled = TRUE;
        //filter report listings by permissions
        if (!($enabled && CRM_Report_Utils_Report::isInstancePermissioned($dao->id))) {
          continue;
        }
        //filter report listing by group/role
        if (!($enabled && CRM_Report_Utils_Report::isInstanceGroupRoleAllowed($dao->id))) {
          continue;
        }

        if (trim($dao->title)) {
          if ($form->ovID) {
            $form->title = ts("Report(s) created from the template: %1", array(1 => $dao->label));
          }
          $rows[$dao->compName][$dao->id]['title'] = $dao->title;
          $rows[$dao->compName][$dao->id]['label'] = $dao->label;
          $rows[$dao->compName][$dao->id]['description'] = $dao->description;
          $rows[$dao->compName][$dao->id]['url'] = CRM_Utils_System::url("{$url}/{$dao->id}", "reset=1");
          $rows[$dao->compName][$dao->id]['deleteUrl'] = CRM_Utils_System::url("{$url}/{$dao->id}", 'action=delete&reset=1');
        }
      }

      $oldRows = CRM_Core_Smarty::singleton()->_tpl_vars['list'];
      $newRows = $oldRows + $rows;
      $page->assign('list', $newRows);
    }
  }
}

/**
 * Implementation of hook_civicrm_buildForm().
 *
 * Used to add a 'Export to Excel' button in the Report forms.
 */
function reportplus_civicrm_buildForm($formName, &$form) {
  if (is_subclass_of($form, 'CRM_Reportplus_Form')) {
    // Fix pdf page break issue
    $buttonName = $form->controller->getButtonName();
    $output = CRM_Utils_Request::retrieve('output', 'String', CRM_Core_DAO::$_nullObject);
    if ($form->getVar('_pdfButtonName') == $buttonName || $output == 'pdf') {
      CRM_Core_Region::instance('export-document-header')->add(array(
        'style' => "tr {page-break-inside: avoid;}"
      ));
    }
  }
}

/**
 * Implementation of hook_civicrm_navigationMenu.
 *
 * Adds Automation navigation items just before the Administer menu.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_navigationMenu
 */
function reportplus_civicrm_navigationMenu(&$menu) {
  _reportplus_civix_insert_navigation_menu($menu, 'Manage ReportPlus templates', array(
    'label' => E::ts('ReportPlus Extension'),
    'url' => NULL,
    'name' => 'reportplus',
    'permission' => 'access CiviCRM',
    'operator' => NULL,
    'separator' => 0,
  ));

  _reportplus_civix_navigationMenu($menu);
}

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function reportplus_civicrm_config(&$config) {
  _reportplus_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function reportplus_civicrm_xmlMenu(&$files) {
  _reportplus_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function reportplus_civicrm_install() {
  _reportplus_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function reportplus_civicrm_postInstall() {
  _reportplus_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function reportplus_civicrm_uninstall() {
  _reportplus_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function reportplus_civicrm_enable() {
  _reportplus_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function reportplus_civicrm_disable() {
  _reportplus_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function reportplus_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _reportplus_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function reportplus_civicrm_managed(&$entities) {
  _reportplus_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function reportplus_civicrm_caseTypes(&$caseTypes) {
  _reportplus_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function reportplus_civicrm_angularModules(&$angularModules) {
  _reportplus_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function reportplus_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _reportplus_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_entityTypes
 */
function reportplus_civicrm_entityTypes(&$entityTypes) {
  _reportplus_civix_civicrm_entityTypes($entityTypes);
}
