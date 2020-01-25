<?php

/**
 * @file
 * views_civicrm_contact_page.views.inc
 * 
 * This file defines the CiviCRM Contact Page display plugin.
 */

/**
 * Implements hook_views_plugins().
 */
function views_civicrm_contact_page_views_plugins() {
  return array(
    'display' => array(
      'civi_contact_page_view' => array(
        'title' => t('CiviCRM Contact Page'),
        'help' => t("Create a CiviCRM Contact Page with this view."),
        'handler' => 'views_civicrm_contact_page_plugin_display_page',
        'theme' => 'views_view',
        'contextual links locations' => array('page'),
        'uses hook menu' => TRUE,
        'use ajax' => TRUE,
        'use pager' => TRUE,
        'use more' => TRUE,
        'accept attachments' => TRUE,
        'admin' => t('CiviCRM Contact Page'),
      ),
    ),
  );
}

