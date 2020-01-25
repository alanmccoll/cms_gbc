<?php /* Smarty version 2.6.31, created on 2020-01-02 18:24:27
         compiled from CRM/Contribute/Form/Search/Common.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Contribute/Form/Search/Common.tpl', 1, false),array('block', 'ts', 'CRM/Contribute/Form/Search/Common.tpl', 31, false),array('modifier', 'crmAddClass', 'CRM/Contribute/Form/Search/Common.tpl', 42, false),array('function', 'help', 'CRM/Contribute/Form/Search/Common.tpl', 106, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<tr>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Core/DatePickerRangeWrapper.tpl", 'smarty_include_vars' => array('fieldName' => 'receive_date','colspan' => '2')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</tr>
<tr>
  <td><label><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Contribution Amounts<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label> <br />
  <?php echo $this->_tpl_vars['form']['contribution_amount_low']['label']; ?>

  <?php echo $this->_tpl_vars['form']['contribution_amount_low']['html']; ?>
 &nbsp;&nbsp;
  <?php echo $this->_tpl_vars['form']['contribution_amount_high']['label']; ?>

  <?php echo $this->_tpl_vars['form']['contribution_amount_high']['html']; ?>
 </td>
  <td><label><?php echo $this->_tpl_vars['form']['contribution_status_id']['label']; ?>
</label> <br />
  <?php echo $this->_tpl_vars['form']['contribution_status_id']['html']; ?>
 </td>
</tr>
<tr>
  <td>
    <label><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Currency<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label> <br />
    <?php echo ((is_array($_tmp=$this->_tpl_vars['form']['contribution_currency_type']['html'])) ? $this->_run_mod_handler('crmAddClass', true, $_tmp, 'twenty') : smarty_modifier_crmAddClass($_tmp, 'twenty')); ?>

  </td>
  <?php if ($this->_tpl_vars['form']['contribution_batch_id']['html']): ?>
    <td>
      <?php echo $this->_tpl_vars['form']['contribution_batch_id']['label']; ?>
<br />
      <?php echo $this->_tpl_vars['form']['contribution_batch_id']['html']; ?>

    </td>
  <?php endif; ?>
</tr>
<tr>
  <td>
    <div class="float-left">
      <label><?php echo $this->_tpl_vars['form']['contribution_payment_instrument_id']['label']; ?>
</label> <br />
      <?php echo ((is_array($_tmp=$this->_tpl_vars['form']['contribution_payment_instrument_id']['html'])) ? $this->_run_mod_handler('crmAddClass', true, $_tmp, 'twenty') : smarty_modifier_crmAddClass($_tmp, 'twenty')); ?>

    </div>
    <div class="float-left" id="contribution_check_number_wrapper">
      <?php echo $this->_tpl_vars['form']['contribution_check_number']['label']; ?>
 <br />
      <?php echo $this->_tpl_vars['form']['contribution_check_number']['html']; ?>

    </div>
    <div class="float-left" id="financial_trxn_card_type_id_wrapper">
      <?php echo $this->_tpl_vars['form']['financial_trxn_card_type_id']['label']; ?>
 <br />
      <?php echo $this->_tpl_vars['form']['financial_trxn_card_type_id']['html']; ?>

    </div>
    <div class="float-left" id="pan_truncation_wrapper">
      <?php echo $this->_tpl_vars['form']['financial_trxn_pan_truncation']['label']; ?>
 <br />
      <?php echo $this->_tpl_vars['form']['financial_trxn_pan_truncation']['html']; ?>

    </div>
  </td>
  <td>
    <?php echo $this->_tpl_vars['form']['contribution_trxn_id']['label']; ?>
 <br />
    <?php echo $this->_tpl_vars['form']['contribution_trxn_id']['html']; ?>

  </td>
</tr>
<tr>
  <td>
    <?php echo $this->_tpl_vars['form']['contribution_or_softcredits']['label']; ?>
 <br />
    <?php echo $this->_tpl_vars['form']['contribution_or_softcredits']['html']; ?>
<br />
    <div class="float-left" id="contribution_soft_credit_type_wrapper">
      <?php echo $this->_tpl_vars['form']['contribution_soft_credit_type_id']['label']; ?>
 <br />
      <?php echo ((is_array($_tmp=$this->_tpl_vars['form']['contribution_soft_credit_type_id']['html'])) ? $this->_run_mod_handler('crmAddClass', true, $_tmp, 'twenty') : smarty_modifier_crmAddClass($_tmp, 'twenty')); ?>

    </div>
  </td>
  <td>
    <?php echo $this->_tpl_vars['form']['invoice_number']['label']; ?>
 <br />
    <?php echo $this->_tpl_vars['form']['invoice_number']['html']; ?>

  </td>
</tr>
<tr>
  <td>
    <table style="width:auto">
      <tbody>
      <tr>
        <td><?php echo $this->_tpl_vars['form']['contribution_thankyou_date_is_not_null']['label']; ?>
</td>
        <td>
          <?php echo $this->_tpl_vars['form']['contribution_thankyou_date_is_not_null']['html']; ?>

        </td>
      </tr>
      <tr>
        <td><?php echo $this->_tpl_vars['form']['contribution_receipt_date_is_not_null']['label']; ?>
</td>
        <td>
          <?php echo $this->_tpl_vars['form']['contribution_receipt_date_is_not_null']['html']; ?>

        </td>
      </tr>
      <tr>
        <td><?php echo $this->_tpl_vars['form']['contribution_test']['label']; ?>
 <?php echo smarty_function_help(array('id' => "is-test",'file' => "CRM/Contact/Form/Search/Advanced"), $this);?>
</td>
        <td>
          <?php echo $this->_tpl_vars['form']['contribution_test']['html']; ?>

        </td>
      </tr>
      </tbody>
    </table>
  </td>
  <td>
    <table style="width:auto">
      <tbody>
      <tr>
        <td><?php echo $this->_tpl_vars['form']['contribution_pay_later']['label']; ?>
</td>
        <td>
          <?php echo $this->_tpl_vars['form']['contribution_pay_later']['html']; ?>

        </td>
      </tr>
      <tr>
        <td><?php echo $this->_tpl_vars['form']['contribution_recurring']['label']; ?>
</td>
        <td>
          <?php echo $this->_tpl_vars['form']['contribution_recurring']['html']; ?>

        </td>
      </tr>
      </tbody>
    </table>
  </td>
</tr>
<tr>
  <td>
    <label><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Financial Type<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label> <br />
    <?php echo ((is_array($_tmp=$this->_tpl_vars['form']['financial_type_id']['html'])) ? $this->_run_mod_handler('crmAddClass', true, $_tmp, 'twenty') : smarty_modifier_crmAddClass($_tmp, 'twenty')); ?>

  </td>
  <td>
    <label><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Contribution Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label> <br />
    <?php echo ((is_array($_tmp=$this->_tpl_vars['form']['contribution_page_id']['html'])) ? $this->_run_mod_handler('crmAddClass', true, $_tmp, 'twenty') : smarty_modifier_crmAddClass($_tmp, 'twenty')); ?>

  </td>
</tr>
<tr>
  <td>
    <?php echo $this->_tpl_vars['form']['contribution_source']['label']; ?>
 <br />
    <?php echo ((is_array($_tmp=$this->_tpl_vars['form']['contribution_source']['html'])) ? $this->_run_mod_handler('crmAddClass', true, $_tmp, 'twenty') : smarty_modifier_crmAddClass($_tmp, 'twenty')); ?>

  </td>
  <td>
    <?php echo $this->_tpl_vars['form']['contribution_product_id']['label']; ?>
 <br />
    <?php echo ((is_array($_tmp=$this->_tpl_vars['form']['contribution_product_id']['html'])) ? $this->_run_mod_handler('crmAddClass', true, $_tmp, 'twenty') : smarty_modifier_crmAddClass($_tmp, 'twenty')); ?>

  </td>
</tr>
<tr>
  <td>
    <?php echo $this->_tpl_vars['form']['contribution_pcp_made_through_id']['label']; ?>
 <br />
    <?php echo $this->_tpl_vars['form']['contribution_pcp_made_through_id']['html']; ?>

    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Contribute/Form/PCP.js.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  </td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>
    <?php echo $this->_tpl_vars['form']['contribution_pcp_display_in_roll']['label']; ?>

    <?php echo $this->_tpl_vars['form']['contribution_pcp_display_in_roll']['html']; ?>

  </td>
</tr>
<tr>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Core/DatePickerRangeWrapper.tpl", 'smarty_include_vars' => array('fieldName' => 'contribution_cancel_date','colspan' => '2')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</tr>
<tr>
  <td>
    <?php echo $this->_tpl_vars['form']['cancel_reason']['label']; ?>
<br />
    <?php echo $this->_tpl_vars['form']['cancel_reason']['html']; ?>

  </td>
</tr>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Campaign/Form/addCampaignToComponent.tpl", 'smarty_include_vars' => array('campaignContext' => 'componentSearch','campaignTrClass' => '','campaignTdClass' => '')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<tr>
  <td colspan="2">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Contribute/Form/Search/ContributionRecur.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  </td>
</tr>

<?php if ($this->_tpl_vars['contributionGroupTree']): ?>
<tr>
  <td colspan="2">
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Custom/Form/Search.tpl", 'smarty_include_vars' => array('groupTree' => $this->_tpl_vars['contributionGroupTree'],'showHideLinks' => false)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
</tr>
<?php endif; ?>

<?php echo '
<script type="text/javascript">
  cj(\'#contribution_payment_instrument_id\').change(function() {
    if (cj(this).val() == \'4\') {
      cj(\'#contribution_check_number_wrapper\').show();
    }
    else {
      cj(\'#contribution_check_number_wrapper\').hide();
      cj(\'#contribution_check_number\').val(\'\');
    }
  }).change();
  cj(\'#contribution_or_softcredits\').change(function() {
    if (cj(this).val() == \'only_contribs\') {
      cj(\'#contribution_soft_credit_type_wrapper\').hide();
      cj(\'#contribution_soft_credit_type_id\').val(\'\');
    }
    else {
      cj(\'#contribution_soft_credit_type_wrapper\').show();
    }
  }).change();
</script>
'; ?>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>