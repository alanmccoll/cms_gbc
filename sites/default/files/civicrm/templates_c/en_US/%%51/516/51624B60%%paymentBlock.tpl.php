<?php /* Smarty version 2.6.31, created on 2020-01-03 13:34:11
         compiled from CRM/common/paymentBlock.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/common/paymentBlock.tpl', 1, false),array('modifier', 'json_encode', 'CRM/common/paymentBlock.tpl', 67, false),array('function', 'crmURL', 'CRM/common/paymentBlock.tpl', 114, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo '
<script type="text/javascript">
  /**
   * Show or hide payment options.
   *
   * @param bool $isHide
   *   Should the block be hidden.
   */
  function showHidePayment(isHide) {
    var payment_options = cj(".payment_options-group");
    var payment_processor = cj("div.payment_processor-section");
    var payment_information = cj("div#payment_information");
    // I\'ve added a hide for billing block. But, actually the issue
    // might be that the unselecting of the processor should cause it
    // to be hidden (or removed) in which case it can go from this function.
    var billing_block = cj("div#billing-payment-block");
    if (isHide) {
      payment_options.hide();
      payment_processor.hide();
      payment_information.hide();
      billing_block.hide();
      // also unset selected payment methods
      cj(\'input[name="payment_processor_id"]\').removeProp(\'checked\');
    }
    else {
      payment_options.show();
      payment_processor.show();
      payment_information.show();
      billing_block.show();
      // also set selected payment methods
      cj(\'input[name="payment_processor_id"][checked=checked]\').prop(\'checked\', true);
    }
  }

  /**
   * Hides or shows billing and payment options block depending on whether payment is required.
   *
   * In general incomplete orders or $0 orders do not require a payment block.
   */
  function skipPaymentMethod() {
    var isHide = false;
    var isMultiple = '; ?>
<?php echo json_encode($this->_tpl_vars['event']['is_multiple_registrations']); ?>
<?php echo ';
    var alwaysShowFlag = (isMultiple && cj("#additional_participants").val());
    var alwaysHideFlag = (cj("#bypass_payment").val() == 1);
    var total_amount_tmp =  cj(\'#pricevalue\').data(\'raw-total\');
    // Hide billing questions if this is free
    if (!alwaysShowFlag && total_amount_tmp == 0){
      isHide = true;
    }
    else {
      isHide = false;
    }
    if (alwaysHideFlag) {
      isHide = true;
    }
    showHidePayment(isHide);
  }
  skipPaymentMethod();

  CRM.$(function($) {
    function buildPaymentBlock(type) {
      var $form = $(\'#billing-payment-block\').closest(\'form\');
      '; ?>

      <?php if ($this->_tpl_vars['contributionPageID']): ?>
        <?php ob_start(); ?>id=<?php echo $this->_tpl_vars['contributionPageID']; ?>
&<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('contributionPageID', ob_get_contents());ob_end_clean(); ?>
      <?php else: ?>
        <?php ob_start(); ?><?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('pageID', ob_get_contents());ob_end_clean(); ?>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['custom_pre_id']): ?>
        <?php ob_start(); ?>pre_profile_id=<?php echo $this->_tpl_vars['custom_pre_id']; ?>
&<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('preProfileID', ob_get_contents());ob_end_clean(); ?>
      <?php else: ?>
        <?php ob_start(); ?><?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('preProfileID', ob_get_contents());ob_end_clean(); ?>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['urlPathVar']): ?>
        <?php ob_start(); ?><?php echo $this->_tpl_vars['urlPathVar']; ?>
&<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('urlPathVar', ob_get_contents());ob_end_clean(); ?>
      <?php else: ?>
        <?php ob_start(); ?><?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('urlPathVar', ob_get_contents());ob_end_clean(); ?>
      <?php endif; ?>
      <?php if ($this->_tpl_vars['billing_profile_id']): ?>
        <?php ob_start(); ?>billing_profile_id=<?php echo $this->_tpl_vars['billing_profile_id']; ?>
&<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('profilePathVar', ob_get_contents());ob_end_clean(); ?>
      <?php else: ?>
        <?php ob_start(); ?><?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('profilePathVar', ob_get_contents());ob_end_clean(); ?>
      <?php endif; ?>

      <?php ob_start(); ?>&is_back_office=<?php echo $this->_tpl_vars['isBackOffice']; ?>
&<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('isBackOfficePathVar', ob_get_contents());ob_end_clean(); ?>

      var payment_instrument_id = $('#payment_instrument_id').val();

      var dataUrl = "<?php echo CRM_Utils_System::crmURL(array('p' => 'civicrm/payment/form','h' => 0,'q' => "formName=".($this->_tpl_vars['form']['formName'])."&currency=".($this->_tpl_vars['currency'])."&".($this->_tpl_vars['urlPathVar']).($this->_tpl_vars['isBackOfficePathVar']).($this->_tpl_vars['profilePathVar']).($this->_tpl_vars['contributionPageID']).($this->_tpl_vars['preProfileID'])."processor_id="), $this);?>
" + type;
      <?php echo '
      if (typeof(CRM.vars) != "undefined") {
        if (typeof(CRM.vars.coreForm) != "undefined") {
          if (typeof(CRM.vars.coreForm.contact_id) != "undefined") {
            dataUrl = dataUrl + "&cid=" + CRM.vars.coreForm.contact_id;
          }

          if (typeof(CRM.vars.coreForm.checksum) != "undefined" ) {
            dataUrl = dataUrl + "&cs=" + CRM.vars.coreForm.checksum;
          }
        }
      }
      dataUrl =  dataUrl + "&payment_instrument_id=" + payment_instrument_id;

      // Processors like pp-express will hide the form submit buttons, so re-show them when switching
      $(\'.crm-submit-buttons\', $form).show().find(\'input\').prop(\'disabled\', true);
      CRM.loadPage(dataUrl, {target: \'#billing-payment-block\'});
    }

    $(\'[name=payment_processor_id]\').on(\'change.paymentBlock\', function() {
        buildPaymentBlock($(this).val());
    });

    $(\'#payment_instrument_id\').on(\'change.paymentBlock\', function() {
      buildPaymentBlock(0);
    });

    $(\'#billing-payment-block\').on(\'crmLoad\', function() {
      $(\'.crm-submit-buttons input\').prop(\'disabled\', false);
    })
  });

</script>
'; ?>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>