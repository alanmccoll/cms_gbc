<?php

/**
 * @file
 * views_civicrm_contact_page_plugin_display_page.inc
 *
 * The plugin that handles CiviCRM Contact Page displays.
 */
class views_civicrm_contact_page_plugin_display_page extends views_plugin_display_page {

  /**
   * Define options and set default options.
   */
  function option_definition() {
    $options = parent::option_definition();
    $options['is_active'] = array('default' => '');
    $options['is_region'] = array('default' => '');
    $options['weight'] = array('default' => '');
    $options['id'] = array('default' => '');

    return $options;
  }

  /**
   * This plugin does not use breadcrumbs.
   */
  function uses_breadcrumb() {
    return FALSE;
  }

  /**
   * Provide the summary for page options in the views UI.
   *
   * This output is returned as an array.
   */
  function options_summary(&$categories, &$options) {
    // It is very important to call the parent function here:
    parent::options_summary($categories, $options);

    $is_active = $this->get_option('is_active');
    $is_region = $this->get_option('is_region');
    $weight = $this->get_option('weight');

    $categories['civi_contact_page_view'] = array(
      'title' => t('CiviCRM Contact Page settings'),
      'column' => 'second',
      'build' => array(
        '#weight' => -11,
      ),
    );

    $options['is_active'] = array(
      'category' => 'civi_contact_page_view',
      'title' => t('Is this contact page active?'),
      'value' => empty($is_active) ? t('None') : $is_active,
    );

    $options['is_region'] = array(
      'category' => 'civi_contact_page_view',
      'title' => t('Region'),
      'value' => empty($is_region) ? t('None') : (($is_region == 'No') ? t('Summary Tab') : t('Additional Tab')),
    );

    $options['weight'] = array(
      'category' => 'civi_contact_page_view',
      'title' => t('Contact Page weight'),
      'value' => empty($weight) ? t('None') : $weight,
    );
  }

  /**
   * Provide the default form for setting options.
   */
  function options_form(&$form, &$form_state) {
    // It is very important to call the parent function here:
    parent::options_form($form, $form_state);
    switch ($form_state['section']) {
      case 'is_active':
        $form['#title'] .= t('Is active?');
        $form['is_active'] = array(
          '#type' => 'radios',
          '#title' => t("Is this contact page active?"),
          '#required' => TRUE,
          '#options' => array('Yes' => t('Yes'), 'No' => t('No')),
          '#default_value' => $this->get_option('is_active'),
        );
        break;

      case 'is_region':
        $form['#title'] .= t('Which region?');
        $form['is_region'] = array(
          '#type' => 'radios',
          '#title' => t("Region"),
          '#required' => TRUE,
          '#options' => array('Yes' => t('Additional Tab'), 'No' => t('Summary Tab Region')),
          '#default_value' => $this->get_option('is_region'),
        );
        break;

      case 'weight':
        $form['#title'] .= t('Contact Page weight');
        $form['weight'] = array(
          '#type' => 'textfield',
          '#title' => t('What is the weight of this contact page?'),
          '#required' => TRUE,
          '#description' => t('Do NOT set a weight used by another contact page.'),
          '#default_value' => $this->get_option('weight'),
        );
        break;
    }
  }

  /**
   * Set the option values to the values of form_state.
   */
  function options_submit(&$form, &$form_state) {
    // It is very important to call the parent function here:
    parent::options_submit($form, $form_state);

    $section = $form_state['section'];

    switch ($section) {
      case 'is_active':
      case 'is_region':
      case 'weight':
        $this->set_option($section, $form_state['values'][$section]);
        break;
    }
  }

  /**
   * Provide a preview.
   */
  function preview() {
    return $this->view->render();
  }

  /**
   * Add this display's path information to Drupal's menu system.
   */
  function execute_hook_menu($callbacks) {
    $items = array();
    // Replace % with the link to our standard views argument loader
    // views_arg_load -- which lives in views.module
    $bits = explode('/', $this->get_option('path'));
    $page_arguments = array($this->view->name, $this->display->id);
    $this->view->init_handlers();
    $view_arguments = $this->view->argument;

    // Replace % with %views_arg for menu autoloading and add to the
    // page arguments so the argument actually comes through.
    foreach ($bits as $pos => $bit) {
      if ($bit == '%') {
        $argument = array_shift($view_arguments);
        if (!empty($argument->options['specify_validation']) && $argument->options['validate']['type'] != 'none') {
          $bits[$pos] = '%views_arg';
        }
        $page_arguments[] = $pos;
      }
    }

    $path = implode('/', $bits);

    $access_plugin = $this->get_plugin('access');
    if (!isset($access_plugin)) {
      $access_plugin = views_get_plugin('access', 'none');
    }

    // Get access callback might return an array of the callback + the dynamic
    // arguments.
    $access_plugin_callback = $access_plugin->get_access_callback();

    if (is_array($access_plugin_callback)) {
      $access_arguments = array();

      // Find the plugin arguments.
      $access_plugin_method = array_shift($access_plugin_callback);
      $access_plugin_arguments = array_shift($access_plugin_callback);
      if (!is_array($access_plugin_arguments)) {
        $access_plugin_arguments = array();
      }

      $access_arguments[0] = array($access_plugin_method, &$access_plugin_arguments);

      // Move the plugin arguments to the access arguments array.
      $i = 1;
      foreach ($access_plugin_arguments as $key => $value) {
        if (is_int($value)) {
          $access_arguments[$i] = $value;
          $access_plugin_arguments[$key] = $i;
          $i++;
        }
      }
    }
    else {
      $access_arguments = array($access_plugin_callback);
    }

    if ($path) {
      $items[$path] = array(
        // Default views page entry.
        'page callback' => '_views_civicrm_contact_page_menu_callback',
        'page arguments' => $page_arguments,
        // Default access check (per display).
        'access callback' => 'views_access',
        'access arguments' => $access_arguments,
        // Identify URL embedded arguments and correlate them to a handler.
        'load arguments' => array(
          $this->view->name,
          $this->display->id,
          0,
          '%index',
        ),
        'delivery callback' => '_views_civicrm_contact_page_menu_delivery_callback',
      );

      $menu = $this->get_option('menu');
      if (empty($menu)) {
        $menu = array('type' => 'none');
      }
      // Set the title and description if we have one.
      if ($menu['type'] != 'none') {
        $items[$path]['title'] = $menu['title'];
        $items[$path]['description'] = $menu['description'];
      }

      if (isset($menu['weight'])) {
        $items[$path]['weight'] = intval($menu['weight']);
      }

      switch ($menu['type']) {
        case 'none':
        default:
          $items[$path]['type'] = MENU_CALLBACK;
          break;

        case 'normal':
          $items[$path]['type'] = MENU_NORMAL_ITEM;
          // Insert item into the proper menu.
          $items[$path]['menu_name'] = $menu['name'];
          break;

        case 'tab':
          $items[$path]['type'] = MENU_LOCAL_TASK;
          break;

        case 'default tab':
          $items[$path]['type'] = MENU_DEFAULT_LOCAL_TASK;
          break;
      }

      // Add context for contextual links.
      // @see menu_contextual_links()
      if (!empty($menu['context'])) {
        $items[$path]['context'] = !empty($menu['context_only_inline']) ? MENU_CONTEXT_INLINE : (MENU_CONTEXT_PAGE | MENU_CONTEXT_INLINE);
      }

      // If this is a 'default' tab, check to see if we have to create the
      // parent menu item.
      if ($menu['type'] == 'default tab') {
        $tab_options = $this->get_option('tab_options');
        if (!empty($tab_options['type']) && $tab_options['type'] != 'none') {
          $bits = explode('/', $path);
          // Remove the last piece.
          $bit = array_pop($bits);

          // We can't do this if they tried to make the last path bit variable.
          // @todo: We can validate this.
          if ($bit != '%views_arg' && !empty($bits)) {
            $default_path = implode('/', $bits);
            $items[$default_path] = array(
              // Default views page entry.
              'page callback' => '_views_civicrm_contact_page_menu_callback',
              'page arguments' => $page_arguments,
              // Default access check (per display).
              'access callback' => 'views_access',
              'access arguments' => $access_arguments,
              // Identify URL embedded arguments and correlate them to a
              // handler.
              'load arguments' => array(
                $this->view->name,
                $this->display->id,
                0,
                '%index',
              ),
              'title' => $tab_options['title'],
              'description' => $tab_options['description'],
              'menu_name' => $tab_options['name'],
              'delivery callback' => '_views_civicrm_contact_page_menu_delivery_callback',
            );
            switch ($tab_options['type']) {
              default:
              case 'normal':
                $items[$default_path]['type'] = MENU_NORMAL_ITEM;
                break;

              case 'tab':
                $items[$default_path]['type'] = MENU_LOCAL_TASK;
                break;
            }
            if (isset($tab_options['weight'])) {
              $items[$default_path]['weight'] = intval($tab_options['weight']);
            }
          }
        }
      }
    }

    return $items;
  }
}

