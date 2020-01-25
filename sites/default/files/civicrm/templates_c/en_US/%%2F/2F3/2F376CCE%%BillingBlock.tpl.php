<?php /* Smarty version 2.6.31, created on 2020-01-03 13:34:11
         compiled from CRM/Core/BillingBlock.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Core/BillingBlock.tpl', 1, false),array('block', 'crmRegion', 'CRM/Core/BillingBlock.tpl', 26, false),array('block', 'ts', 'CRM/Core/BillingBlock.tpl', 40, false),array('modifier', 'count', 'CRM/Core/BillingBlock.tpl', 28, false),array('modifier', 'crmAddClass', 'CRM/Core/BillingBlock.tpl', 76, false),array('modifier', 'json_encode', 'CRM/Core/BillingBlock.tpl', 91, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $this->_tag_stack[] = array('crmRegion', array('name' => "billing-block")); $_block_repeat=true;smarty_block_crmRegion($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<div id="payment_information">
  <?php if (count($this->_tpl_vars['paymentFields'])): ?>
    <fieldset class="billing_mode-group <?php echo $this->_tpl_vars['paymentTypeName']; ?>
_info-group">
      <legend>
        <?php echo $this->_tpl_vars['paymentTypeLabel']; ?>

      </legend>
      <?php $this->_tag_stack[] = array('crmRegion', array('name' => "billing-block-pre")); $_block_repeat=true;smarty_block_crmRegion($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
      <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmRegion($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      <div class="crm-section billing_mode-section <?php echo $this->_tpl_vars['paymentTypeName']; ?>
_info-section">
        <?php $_from = $this->_tpl_vars['paymentFields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['paymentField']):
?>
          <?php $this->assign('name', $this->_tpl_vars['form'][$this->_tpl_vars['paymentField']]['name']); ?>
          <div class="crm-section <?php echo $this->_tpl_vars['form'][$this->_tpl_vars['paymentField']]['name']; ?>
-section">
            <div class="label"><?php echo $this->_tpl_vars['form'][$this->_tpl_vars['paymentField']]['label']; ?>

              <?php if ($this->_tpl_vars['requiredPaymentFields'][$this->_tpl_vars['name']]): ?><span class="crm-marker" title="<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>This field is required.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">*</span><?php endif; ?>
            </div>
            <div class="content">
                <?php echo $this->_tpl_vars['form'][$this->_tpl_vars['paymentField']]['html']; ?>

              <?php if ($this->_tpl_vars['paymentFieldsMetadata'][$this->_tpl_vars['name']]['description']): ?>
                <div class="description"><?php echo $this->_tpl_vars['paymentFieldsMetadata'][$this->_tpl_vars['name']]['description']; ?>
</div>
              <?php elseif ($this->_tpl_vars['paymentField'] == 'cvv2'): ?>                <span class="cvv2-icon" title="<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Usually the last 3-4 digits in the signature area on the back of the card.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"> </span>
              <?php endif; ?>
              <?php if ($this->_tpl_vars['paymentField'] == 'credit_card_type'): ?>
                <div class="crm-credit_card_type-icons"></div>
              <?php endif; ?>
            </div>
            <div class="clear"></div>
          </div>
        <?php endforeach; endif; unset($_from); ?>
      </div>
    </fieldset>
  <?php endif; ?>
  <?php if (count($this->_tpl_vars['billingDetailsFields']) && $this->_tpl_vars['paymentProcessor']['payment_processor_type'] != 'PayPal_Express'): ?>
    <?php if ($this->_tpl_vars['profileAddressFields'] && ! $this->_tpl_vars['ccid']): ?>
      <input type="checkbox" id="billingcheckbox" value="0">
      <label for="billingcheckbox"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>My billing address is the same as above<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label>
    <?php endif; ?>
    <fieldset class="billing_name_address-group">
      <legend><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Billing Name and Address<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></legend>
      <div class="crm-section billing_name_address-section">
        <?php $_from = $this->_tpl_vars['billingDetailsFields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['billingField']):
?>
          <?php $this->assign('name', $this->_tpl_vars['form'][$this->_tpl_vars['billingField']]['name']); ?>
          <div class="crm-section <?php echo $this->_tpl_vars['form'][$this->_tpl_vars['billingField']]['name']; ?>
-section">
            <div class="label"><?php echo $this->_tpl_vars['form'][$this->_tpl_vars['billingField']]['label']; ?>

              <?php if ($this->_tpl_vars['requiredPaymentFields'][$this->_tpl_vars['name']]): ?><span class="crm-marker" title="<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>This field is required.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>">*</span><?php endif; ?>
            </div>
            <?php if ($this->_tpl_vars['form'][$this->_tpl_vars['billingField']]['type'] == 'text'): ?>
              <div class="content"><?php echo $this->_tpl_vars['form'][$this->_tpl_vars['billingField']]['html']; ?>
</div>
            <?php else: ?>
              <div class="content"><?php echo ((is_array($_tmp=$this->_tpl_vars['form'][$this->_tpl_vars['billingField']]['html'])) ? $this->_run_mod_handler('crmAddClass', true, $_tmp, 'big') : smarty_modifier_crmAddClass($_tmp, 'big')); ?>
</div>
            <?php endif; ?>
            <div class="clear"></div>
          </div>
        <?php endforeach; endif; unset($_from); ?>
      </div>
    </fieldset>
  <?php endif; ?>
</div>
<?php if ($this->_tpl_vars['profileAddressFields']): ?>
  <script type="text/javascript">
    <?php echo '

    CRM.$(function ($) {
      // build list of ids to track changes on
      var address_fields = '; ?>
<?php echo json_encode($this->_tpl_vars['profileAddressFields']); ?>
<?php echo ';
      var input_ids = {};
      var select_ids = {};
      var orig_id, field, field_name;

      // build input ids
      $(\'.billing_name_address-section input\').each(function (i) {
        orig_id = $(this).attr(\'id\');
        field = orig_id.split(\'-\');
        field_name = field[0].replace(\'billing_\', \'\');
        if (field[1]) {
          if (address_fields[field_name]) {
            input_ids[\'#\' + field_name + \'-\' + address_fields[field_name]] = \'#\' + orig_id;
          }
        }
      });
      if ($(\'#first_name\').length)
        input_ids[\'#first_name\'] = \'#billing_first_name\';
      if ($(\'#middle_name\').length)
        input_ids[\'#middle_name\'] = \'#billing_middle_name\';
      if ($(\'#last_name\').length)
        input_ids[\'#last_name\'] = \'#billing_last_name\';

      // build select ids
      $(\'.billing_name_address-section select\').each(function (i) {
        orig_id = $(this).attr(\'id\');
        field = orig_id.split(\'-\');
        field_name = field[0].replace(\'billing_\', \'\').replace(\'_id\', \'\');
        if (field[1]) {
          if (address_fields[field_name]) {
            select_ids[\'#\' + field_name + \'-\' + address_fields[field_name]] = \'#\' + orig_id;
          }
        }
      });

      // detect if billing checkbox should default to checked
      var checked = true;
      for (var id in input_ids) {
        orig_id = input_ids[id];
        if ($(id).val() != $(orig_id).val()) {
          checked = false;
          break;
        }
      }
      for (var id in select_ids) {
        orig_id = select_ids[id];
        if ($(id).val() != $(orig_id).val()) {
          checked = false;
          break;
        }
      }
      if (checked) {
        $(\'#billingcheckbox\').prop(\'checked\', true).data(\'crm-initial-value\', true);
        if (!CRM.billing || CRM.billing.billingProfileIsHideable) {
          $(\'.billing_name_address-group\').hide();
        }
      }

      // onchange handlers for non-billing fields
      for (var id in input_ids) {
        orig_id = input_ids[id];
        $(id).change(function () {
          var id = \'#\' + $(this).attr(\'id\');
          var orig_id = input_ids[id];

          // if billing checkbox is active, copy other field into billing field
          if ($(\'#billingcheckbox\').prop(\'checked\')) {
            $(orig_id).val($(id).val());
          }
        });
      }
      for (var id in select_ids) {
        orig_id = select_ids[id];
        $(id).change(function () {
          var id = \'#\' + $(this).attr(\'id\');
          var orig_id = select_ids[id];

          // if billing checkbox is active, copy other field into billing field
          if ($(\'#billingcheckbox\').prop(\'checked\')) {
            $(orig_id + \' option\').prop(\'selected\', false);
            $(orig_id + \' option[value="\' + $(id).val() + \'"]\').prop(\'selected\', true);
            $(orig_id).change();
          }
        });
      }


      // toggle show/hide
      $(\'#billingcheckbox\').click(function () {
        if (this.checked) {
          if (!CRM.billing || CRM.billing.billingProfileIsHideable) {
            $(\'.billing_name_address-group\').hide(200);
          }

          // copy all values
          for (var id in input_ids) {
            orig_id = input_ids[id];
            $(orig_id).val($(id).val());
          }
          for (var id in select_ids) {
            orig_id = select_ids[id];
            $(orig_id + \' option\').prop(\'selected\', false);
            $(orig_id + \' option[value="\' + $(id).val() + \'"]\').prop(\'selected\', true);
            $(orig_id).change();
          }
        } else {
          $(\'.billing_name_address-group\').show(200);
        }
      });

      // remove spaces, dashes from credit card number
      $(\'#credit_card_number\').change(function () {
        var cc = $(\'#credit_card_number\').val()
                .replace(/ /g, \'\')
                .replace(/-/g, \'\');
        $(\'#credit_card_number\').val(cc);
      });
    });

  </script>
  '; ?>

<?php endif; ?>
<?php if ($this->_tpl_vars['suppressSubmitButton']): ?>
<?php echo '
  <script type="text/javascript">
    CRM.$(function($) {
      $(\'.crm-submit-buttons\', $(\'#billing-payment-block\').closest(\'form\')).hide();
    });
  </script>
'; ?>

<?php endif; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmRegion($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $this->_tag_stack[] = array('crmRegion', array('name' => "billing-block-post")); $_block_repeat=true;smarty_block_crmRegion($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
  <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmRegion($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>