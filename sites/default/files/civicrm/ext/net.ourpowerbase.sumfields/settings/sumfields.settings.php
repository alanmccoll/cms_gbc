<?php

/**
 * Settings used by sumfields.
 */

return array(
  'active_fields' => array(
    'group_name' => 'Summary Fields',
    'group' => 'sumfields',
    'name' => 'active_fields',
    'type' => 'Array',
    'default' => array(),
    'add' => '4.6',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Fields actively maintaining summaries values',
    'help_text' => 'Indicate which fields should be active',
	),
  'custom_field_parameters' => array(
    'group_name' => 'Summary Fields',
    'group' => 'sumfields',
    'name' => 'custom_field_parameters',
    'type' => 'Array',
    'default' => array(),
    'add' => '4.6',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'A list of all custom fields this extension has created.',
    'help_text' => '',
	),
  'custom_table_parameters' => array(
    'group_name' => 'Summary Fields',
    'group' => 'summaryfields',
    'name' => 'custom_table_parameters',
    'type' => 'Array',
    'default' => array(),
    'add' => '4.6',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Custom tables created by this extension',
    'help_text' => '',
	),
  'event_type_ids' => array(
    'group_name' => 'Summary Fields',
    'group' => 'summaryfields',
    'name' => 'event_type_ids',
    'type' => 'Array',
    'default' => array(),
    'add' => '4.6',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Event types to include when calculating summary fields',
    'help_text' => 'Indicate which event types should be included',
	),
  'financial_type_ids' => array(
    'group_name' => 'Summary Fields',
    'group' => 'summaryfields',
    'name' => 'financial_type_ids',
    'type' => 'Array',
    'default' => array(),
    'add' => '4.6',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Financial types to include when calculating contribution summary fields.',
    'help_text' => 'Indicate which financial types should be included',
	),
  'membership_financial_type_ids' => array(
    'group_name' => 'Summary Fields',
    'group' => 'summaryfields',
    'name' => 'membership_financial_type_ids',
    'type' => 'Array',
    'default' => array(),
    'add' => '4.6',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Financial types to include when calculating membership summary fields.',
    'help_text' => 'Indicate which financial types should be included',
	),
  'participant_noshow_status_ids' => array(
    'group_name' => 'Summary Fields',
    'group' => 'summaryfields',
    'name' => 'participant_noshow_status_ids',
    'type' => 'Array',
    'default' => array(),
    'add' => '4.6',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Participant status ids that indicate a no show.',
    'help_text' => 'Indicate which status ids should trigger a no show',
	),
  'participant_status_ids' => array(
    'group_name' => 'Summary Fields',
    'group' => 'summaryfields',
    'name' => 'participant_status_ids',
    'type' => 'Array',
    'default' => array(),
    'add' => '4.6',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Participant status ids that indicate attendance.',
    'help_text' => 'Indicate which status ids should trigger attendance',
	),
  'generate_schema_and_data' => array(
    'group_name' => 'Summary Fields',
    'group' => 'summaryfields',
    'name' => 'generate_schema_and_data',
    'type' => 'String',
    'default' => FALSE,
    'add' => '4.6',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Fields actively maintaining summaries values',
    'help_text' => 'Indicate which fields should be active',
	),
  'new_active_fields' => array(
    'group_name' => 'Summary Fields',
    'group' => 'summaryfields',
    'name' => 'new_active_fields',
    'type' => 'Array',
    'default' => array(),
    'add' => '4.6',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'List of active fields that will be active when the cron job making the change completes.',
    'help_text' => '',
	),
  'data_update_method' => array(
    'group_name' => 'Summary Fields',
    'group' => 'summaryfields',
    'name' => 'data_update_method',
    'type' => 'String',
    'default' => 'via_triggers',
    'add' => '4.6',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Determines what process to use to calculate summary fields. Trigger-based (default) or only cron job based.',
    'help_text' => '',
	),
  'when_to_apply_change' => array(
    'group_name' => 'Summary Fields',
    'group' => 'summaryfields',
    'name' => 'when_to_apply_change',
    'type' => 'String',
    'default' => 'via_cron',
    'add' => '4.6',
    'is_domain' => 1,
    'is_contact' => 0,
    'description' => 'Determines when the calculation should take place.On next cron or on submit',
    'help_text' => '',
	),
);
