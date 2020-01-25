<?php
use CRM_Reportplus_ExtensionUtil as E;

/**
 * Collection of upgrade steps.
 */
class CRM_Reportplus_Upgrader extends CRM_Reportplus_Upgrader_Base {

  public function install() {
    CRM_Core_DAO::executeQuery("INSERT INTO civicrm_component (name, namespace) VALUES ('ReportPlus', 'CRM_Reportplus');");
  }

}
