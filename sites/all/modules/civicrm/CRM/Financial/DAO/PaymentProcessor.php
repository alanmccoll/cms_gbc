<?php

/**
 * @package CRM
 * @copyright CiviCRM LLC (c) 2004-2019
 *
 * Generated from xml/schema/CRM/Financial/PaymentProcessor.xml
 * DO NOT EDIT.  Generated by CRM_Core_CodeGen
 * (GenCodeChecksum:55a55af34cd25ec8d69f4145d3fa2870)
 */

/**
 * Database access object for the PaymentProcessor entity.
 */
class CRM_Financial_DAO_PaymentProcessor extends CRM_Core_DAO {

  /**
   * Static instance to hold the table name.
   *
   * @var string
   */
  public static $_tableName = 'civicrm_payment_processor';

  /**
   * Should CiviCRM log any modifications to this table in the civicrm_log table.
   *
   * @var bool
   */
  public static $_log = FALSE;

  /**
   * Payment Processor ID
   *
   * @var int
   */
  public $id;

  /**
   * Which Domain is this match entry for
   *
   * @var int
   */
  public $domain_id;

  /**
   * Payment Processor Name.
   *
   * @var string
   */
  public $name;

  /**
   * Payment Processor Descriptive Name.
   *
   * @var string
   */
  public $title;

  /**
   * Payment Processor Description.
   *
   * @var string
   */
  public $description;

  /**
   * @var int
   */
  public $payment_processor_type_id;

  /**
   * Is this processor active?
   *
   * @var bool
   */
  public $is_active;

  /**
   * Is this processor the default?
   *
   * @var bool
   */
  public $is_default;

  /**
   * Is this processor for a test site?
   *
   * @var bool
   */
  public $is_test;

  /**
   * @var string
   */
  public $user_name;

  /**
   * @var string
   */
  public $password;

  /**
   * @var text
   */
  public $signature;

  /**
   * @var string
   */
  public $url_site;

  /**
   * @var string
   */
  public $url_api;

  /**
   * @var string
   */
  public $url_recur;

  /**
   * @var string
   */
  public $url_button;

  /**
   * @var string
   */
  public $subject;

  /**
   * @var string
   */
  public $class_name;

  /**
   * Billing Mode (deprecated)
   *
   * @var int
   */
  public $billing_mode;

  /**
   * Can process recurring contributions
   *
   * @var bool
   */
  public $is_recur;

  /**
   * Payment Type: Credit or Debit (deprecated)
   *
   * @var int
   */
  public $payment_type;

  /**
   * Payment Instrument ID
   *
   * @var int
   */
  public $payment_instrument_id;

  /**
   * array of accepted credit card types
   *
   * @var text
   */
  public $accepted_credit_cards;

  /**
   * Class constructor.
   */
  public function __construct() {
    $this->__table = 'civicrm_payment_processor';
    parent::__construct();
  }

  /**
   * Returns foreign keys and entity references.
   *
   * @return array
   *   [CRM_Core_Reference_Interface]
   */
  public static function getReferenceColumns() {
    if (!isset(Civi::$statics[__CLASS__]['links'])) {
      Civi::$statics[__CLASS__]['links'] = static::createReferenceColumns(__CLASS__);
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName(), 'domain_id', 'civicrm_domain', 'id');
      Civi::$statics[__CLASS__]['links'][] = new CRM_Core_Reference_Basic(self::getTableName(), 'payment_processor_type_id', 'civicrm_payment_processor_type', 'id');
      CRM_Core_DAO_AllCoreTables::invoke(__CLASS__, 'links_callback', Civi::$statics[__CLASS__]['links']);
    }
    return Civi::$statics[__CLASS__]['links'];
  }

  /**
   * Returns all the column names of this table
   *
   * @return array
   */
  public static function &fields() {
    if (!isset(Civi::$statics[__CLASS__]['fields'])) {
      Civi::$statics[__CLASS__]['fields'] = [
        'id' => [
          'name' => 'id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Payment Processor ID'),
          'description' => ts('Payment Processor ID'),
          'required' => TRUE,
          'where' => 'civicrm_payment_processor.id',
          'table_name' => 'civicrm_payment_processor',
          'entity' => 'PaymentProcessor',
          'bao' => 'CRM_Financial_BAO_PaymentProcessor',
          'localizable' => 0,
        ],
        'domain_id' => [
          'name' => 'domain_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Payment Processor Domain'),
          'description' => ts('Which Domain is this match entry for'),
          'required' => TRUE,
          'where' => 'civicrm_payment_processor.domain_id',
          'table_name' => 'civicrm_payment_processor',
          'entity' => 'PaymentProcessor',
          'bao' => 'CRM_Financial_BAO_PaymentProcessor',
          'localizable' => 0,
          'FKClassName' => 'CRM_Core_DAO_Domain',
          'pseudoconstant' => [
            'table' => 'civicrm_domain',
            'keyColumn' => 'id',
            'labelColumn' => 'name',
          ],
        ],
        'name' => [
          'name' => 'name',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Payment Processor'),
          'description' => ts('Payment Processor Name.'),
          'maxlength' => 64,
          'size' => CRM_Utils_Type::BIG,
          'where' => 'civicrm_payment_processor.name',
          'table_name' => 'civicrm_payment_processor',
          'entity' => 'PaymentProcessor',
          'bao' => 'CRM_Financial_BAO_PaymentProcessor',
          'localizable' => 0,
          'html' => [
            'type' => 'Text',
          ],
        ],
        'title' => [
          'name' => 'title',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Payment Processor Title'),
          'description' => ts('Payment Processor Descriptive Name.'),
          'maxlength' => 127,
          'size' => CRM_Utils_Type::HUGE,
          'where' => 'civicrm_payment_processor.title',
          'table_name' => 'civicrm_payment_processor',
          'entity' => 'PaymentProcessor',
          'bao' => 'CRM_Financial_BAO_PaymentProcessor',
          'localizable' => 1,
          'html' => [
            'type' => 'Text',
          ],
        ],
        'description' => [
          'name' => 'description',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Processor Description'),
          'description' => ts('Payment Processor Description.'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'where' => 'civicrm_payment_processor.description',
          'table_name' => 'civicrm_payment_processor',
          'entity' => 'PaymentProcessor',
          'bao' => 'CRM_Financial_BAO_PaymentProcessor',
          'localizable' => 0,
          'html' => [
            'type' => 'Text',
          ],
        ],
        'payment_processor_type_id' => [
          'name' => 'payment_processor_type_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Payment Processor Type ID'),
          'required' => TRUE,
          'where' => 'civicrm_payment_processor.payment_processor_type_id',
          'table_name' => 'civicrm_payment_processor',
          'entity' => 'PaymentProcessor',
          'bao' => 'CRM_Financial_BAO_PaymentProcessor',
          'localizable' => 0,
          'FKClassName' => 'CRM_Financial_DAO_PaymentProcessorType',
          'pseudoconstant' => [
            'table' => 'civicrm_payment_processor_type',
            'keyColumn' => 'id',
            'labelColumn' => 'title',
          ],
        ],
        'is_active' => [
          'name' => 'is_active',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Processor is Active?'),
          'description' => ts('Is this processor active?'),
          'where' => 'civicrm_payment_processor.is_active',
          'default' => '1',
          'table_name' => 'civicrm_payment_processor',
          'entity' => 'PaymentProcessor',
          'bao' => 'CRM_Financial_BAO_PaymentProcessor',
          'localizable' => 0,
        ],
        'is_default' => [
          'name' => 'is_default',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Processor Is Default?'),
          'description' => ts('Is this processor the default?'),
          'where' => 'civicrm_payment_processor.is_default',
          'default' => '0',
          'table_name' => 'civicrm_payment_processor',
          'entity' => 'PaymentProcessor',
          'bao' => 'CRM_Financial_BAO_PaymentProcessor',
          'localizable' => 0,
        ],
        'is_test' => [
          'name' => 'is_test',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Is Test Processor?'),
          'description' => ts('Is this processor for a test site?'),
          'where' => 'civicrm_payment_processor.is_test',
          'default' => '0',
          'table_name' => 'civicrm_payment_processor',
          'entity' => 'PaymentProcessor',
          'bao' => 'CRM_Financial_BAO_PaymentProcessor',
          'localizable' => 0,
        ],
        'user_name' => [
          'name' => 'user_name',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('User Name'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'where' => 'civicrm_payment_processor.user_name',
          'table_name' => 'civicrm_payment_processor',
          'entity' => 'PaymentProcessor',
          'bao' => 'CRM_Financial_BAO_PaymentProcessor',
          'localizable' => 0,
          'html' => [
            'type' => 'Text',
          ],
        ],
        'password' => [
          'name' => 'password',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Password'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'where' => 'civicrm_payment_processor.password',
          'table_name' => 'civicrm_payment_processor',
          'entity' => 'PaymentProcessor',
          'bao' => 'CRM_Financial_BAO_PaymentProcessor',
          'localizable' => 0,
          'html' => [
            'type' => 'Password',
          ],
        ],
        'signature' => [
          'name' => 'signature',
          'type' => CRM_Utils_Type::T_TEXT,
          'title' => ts('Signature'),
          'rows' => 4,
          'cols' => 40,
          'where' => 'civicrm_payment_processor.signature',
          'table_name' => 'civicrm_payment_processor',
          'entity' => 'PaymentProcessor',
          'bao' => 'CRM_Financial_BAO_PaymentProcessor',
          'localizable' => 0,
          'html' => [
            'type' => 'TextArea',
          ],
        ],
        'url_site' => [
          'name' => 'url_site',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Site URL'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'where' => 'civicrm_payment_processor.url_site',
          'table_name' => 'civicrm_payment_processor',
          'entity' => 'PaymentProcessor',
          'bao' => 'CRM_Financial_BAO_PaymentProcessor',
          'localizable' => 0,
          'html' => [
            'type' => 'Text',
          ],
        ],
        'url_api' => [
          'name' => 'url_api',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('API URL'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'where' => 'civicrm_payment_processor.url_api',
          'table_name' => 'civicrm_payment_processor',
          'entity' => 'PaymentProcessor',
          'bao' => 'CRM_Financial_BAO_PaymentProcessor',
          'localizable' => 0,
          'html' => [
            'type' => 'Text',
          ],
        ],
        'url_recur' => [
          'name' => 'url_recur',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Recurring Payments URL'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'where' => 'civicrm_payment_processor.url_recur',
          'table_name' => 'civicrm_payment_processor',
          'entity' => 'PaymentProcessor',
          'bao' => 'CRM_Financial_BAO_PaymentProcessor',
          'localizable' => 0,
          'html' => [
            'type' => 'Text',
          ],
        ],
        'url_button' => [
          'name' => 'url_button',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Button URL'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'where' => 'civicrm_payment_processor.url_button',
          'table_name' => 'civicrm_payment_processor',
          'entity' => 'PaymentProcessor',
          'bao' => 'CRM_Financial_BAO_PaymentProcessor',
          'localizable' => 0,
          'html' => [
            'type' => 'Text',
          ],
        ],
        'subject' => [
          'name' => 'subject',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Subject'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'where' => 'civicrm_payment_processor.subject',
          'table_name' => 'civicrm_payment_processor',
          'entity' => 'PaymentProcessor',
          'bao' => 'CRM_Financial_BAO_PaymentProcessor',
          'localizable' => 0,
          'html' => [
            'type' => 'Text',
          ],
        ],
        'class_name' => [
          'name' => 'class_name',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => ts('Suffix for PHP class name implementation'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'where' => 'civicrm_payment_processor.class_name',
          'table_name' => 'civicrm_payment_processor',
          'entity' => 'PaymentProcessor',
          'bao' => 'CRM_Financial_BAO_PaymentProcessor',
          'localizable' => 0,
        ],
        'billing_mode' => [
          'name' => 'billing_mode',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Processor Billing Mode'),
          'description' => ts('Billing Mode (deprecated)'),
          'required' => TRUE,
          'where' => 'civicrm_payment_processor.billing_mode',
          'table_name' => 'civicrm_payment_processor',
          'entity' => 'PaymentProcessor',
          'bao' => 'CRM_Financial_BAO_PaymentProcessor',
          'localizable' => 0,
        ],
        'is_recur' => [
          'name' => 'is_recur',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => ts('Processor Supports Recurring?'),
          'description' => ts('Can process recurring contributions'),
          'where' => 'civicrm_payment_processor.is_recur',
          'table_name' => 'civicrm_payment_processor',
          'entity' => 'PaymentProcessor',
          'bao' => 'CRM_Financial_BAO_PaymentProcessor',
          'localizable' => 0,
        ],
        'payment_type' => [
          'name' => 'payment_type',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Payment Type'),
          'description' => ts('Payment Type: Credit or Debit (deprecated)'),
          'where' => 'civicrm_payment_processor.payment_type',
          'default' => '1',
          'table_name' => 'civicrm_payment_processor',
          'entity' => 'PaymentProcessor',
          'bao' => 'CRM_Financial_BAO_PaymentProcessor',
          'localizable' => 0,
        ],
        'payment_instrument_id' => [
          'name' => 'payment_instrument_id',
          'type' => CRM_Utils_Type::T_INT,
          'title' => ts('Payment Method'),
          'description' => ts('Payment Instrument ID'),
          'where' => 'civicrm_payment_processor.payment_instrument_id',
          'default' => '1',
          'table_name' => 'civicrm_payment_processor',
          'entity' => 'PaymentProcessor',
          'bao' => 'CRM_Financial_BAO_PaymentProcessor',
          'localizable' => 0,
          'pseudoconstant' => [
            'optionGroupName' => 'payment_instrument',
            'optionEditPath' => 'civicrm/admin/options/payment_instrument',
          ],
        ],
        'accepted_credit_cards' => [
          'name' => 'accepted_credit_cards',
          'type' => CRM_Utils_Type::T_TEXT,
          'title' => ts('Accepted Credit Cards'),
          'description' => ts('array of accepted credit card types'),
          'where' => 'civicrm_payment_processor.accepted_credit_cards',
          'default' => 'NULL',
          'table_name' => 'civicrm_payment_processor',
          'entity' => 'PaymentProcessor',
          'bao' => 'CRM_Financial_BAO_PaymentProcessor',
          'localizable' => 0,
          'serialize' => self::SERIALIZE_JSON,
        ],
      ];
      CRM_Core_DAO_AllCoreTables::invoke(__CLASS__, 'fields_callback', Civi::$statics[__CLASS__]['fields']);
    }
    return Civi::$statics[__CLASS__]['fields'];
  }

  /**
   * Return a mapping from field-name to the corresponding key (as used in fields()).
   *
   * @return array
   *   Array(string $name => string $uniqueName).
   */
  public static function &fieldKeys() {
    if (!isset(Civi::$statics[__CLASS__]['fieldKeys'])) {
      Civi::$statics[__CLASS__]['fieldKeys'] = array_flip(CRM_Utils_Array::collect('name', self::fields()));
    }
    return Civi::$statics[__CLASS__]['fieldKeys'];
  }

  /**
   * Returns the names of this table
   *
   * @return string
   */
  public static function getTableName() {
    return CRM_Core_DAO::getLocaleTableName(self::$_tableName);
  }

  /**
   * Returns if this table needs to be logged
   *
   * @return bool
   */
  public function getLog() {
    return self::$_log;
  }

  /**
   * Returns the list of fields that can be imported
   *
   * @param bool $prefix
   *
   * @return array
   */
  public static function &import($prefix = FALSE) {
    $r = CRM_Core_DAO_AllCoreTables::getImports(__CLASS__, 'payment_processor', $prefix, []);
    return $r;
  }

  /**
   * Returns the list of fields that can be exported
   *
   * @param bool $prefix
   *
   * @return array
   */
  public static function &export($prefix = FALSE) {
    $r = CRM_Core_DAO_AllCoreTables::getExports(__CLASS__, 'payment_processor', $prefix, []);
    return $r;
  }

  /**
   * Returns the list of indices
   *
   * @param bool $localize
   *
   * @return array
   */
  public static function indices($localize = TRUE) {
    $indices = [
      'UI_name_test_domain_id' => [
        'name' => 'UI_name_test_domain_id',
        'field' => [
          0 => 'name',
          1 => 'is_test',
          2 => 'domain_id',
        ],
        'localizable' => FALSE,
        'unique' => TRUE,
        'sig' => 'civicrm_payment_processor::1::name::is_test::domain_id',
      ],
    ];
    return ($localize && !empty($indices)) ? CRM_Core_DAO_AllCoreTables::multilingualize(__CLASS__, $indices) : $indices;
  }

}
