<?php /* Smarty version 2.6.31, created on 2020-01-03 14:18:11
         compiled from CRM/Contribute/Form/Contribution.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Contribute/Form/Contribution.tpl', 1, false),array('block', 'ts', 'CRM/Contribute/Form/Contribution.tpl', 37, false),array('modifier', 'upper', 'CRM/Contribute/Form/Contribution.tpl', 37, false),array('modifier', 'crmAddClass', 'CRM/Contribute/Form/Contribution.tpl', 101, false),array('modifier', 'crmDate', 'CRM/Contribute/Form/Contribution.tpl', 189, false),array('modifier', 'json_encode', 'CRM/Contribute/Form/Contribution.tpl', 386, false),array('function', 'crmURL', 'CRM/Contribute/Form/Contribution.tpl', 65, false),array('function', 'help', 'CRM/Contribute/Form/Contribution.tpl', 89, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><p>This has been edited</p>
<?php if ($this->_tpl_vars['priceSetId']): ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Price/Form/PriceSet.tpl", 'smarty_include_vars' => array('context' => 'standalone','extends' => 'Contribution')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php elseif ($this->_tpl_vars['showAdditionalInfo'] && $this->_tpl_vars['formType']): ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Contribute/Form/AdditionalInfo/".($this->_tpl_vars['formType']).".tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Contribute/Form/AdditionalInfo/Payment.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <?php if ($this->_tpl_vars['contributionMode']): ?>
  <div class="help">
    <?php if ($this->_tpl_vars['contactId'] && $this->_tpl_vars['payNow']): ?>
      <?php $this->_tag_stack[] = array('ts', array('1' => $this->_tpl_vars['displayName'],'2' => ((is_array($_tmp=$this->_tpl_vars['contributionMode'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)))); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Use this form to edit a contribution on behalf of %1. <strong>A
      %2 transaction will be submitted</strong> using the selected payment processor.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php elseif ($this->_tpl_vars['contactId']): ?>
      <?php $this->_tag_stack[] = array('ts', array('1' => $this->_tpl_vars['displayName'],'2' => ((is_array($_tmp=$this->_tpl_vars['contributionMode'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)))); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Use this form to submit a new contribution on behalf of %1. <strong>A
      %2 transaction will be submitted</strong> using the selected payment processor.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php else: ?>
      <?php $this->_tag_stack[] = array('ts', array('1' => $this->_tpl_vars['displayName'],'2' => ((is_array($_tmp=$this->_tpl_vars['contributionMode'])) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)))); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Use this form to submit a new contribution. <strong>A %2 transaction will be submitted</strong> using the selected payment processor.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <?php endif; ?>
  </div>
  <?php endif; ?>

  <div class="crm-block crm-form-block crm-contribution-form-block">

  <?php if (! $this->_tpl_vars['email'] && $this->_tpl_vars['action'] != 8 && $this->_tpl_vars['context'] != 'standalone'): ?>
  <div class="messages status no-popup">
    <div class="icon inform-icon"></div>&nbsp;<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>You will not be able to send an automatic email receipt for this contribution because there is no email address recorded for this contact. If you want a receipt to be sent when this contribution is recorded, click Cancel and then click Edit from the Summary tab to add an email address before recording the contribution.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  </div>
  <?php endif; ?>

  <?php if ($this->_tpl_vars['action'] == 8): ?>
  <div class="messages status no-popup">
    <div class="icon inform-icon"></div>
    <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>WARNING: Deleting this contribution will result in the loss of the associated financial transactions (if any).<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Do you want to continue?<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  </div>
  <?php else: ?>
    <?php if ($this->_tpl_vars['newCredit'] && $this->_tpl_vars['action'] == 1 && $this->_tpl_vars['contributionMode'] == null): ?>
    <div class="action-link css_right crm-link-credit-card-mode">
      <?php if ($this->_tpl_vars['contactId']): ?>
        <?php ob_start(); ?><?php echo CRM_Utils_System::crmURL(array('p' => 'civicrm/contact/view/contribution','q' => "reset=1&action=add&cid=".($this->_tpl_vars['contactId'])."&context=".($this->_tpl_vars['context'])."&mode=live"), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('ccModeLink', ob_get_contents());ob_end_clean(); ?>
      <?php else: ?>
        <?php ob_start(); ?><?php echo CRM_Utils_System::crmURL(array('p' => 'civicrm/contact/view/contribution','q' => "reset=1&action=add&context=standalone&mode=live"), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('ccModeLink', ob_get_contents());ob_end_clean(); ?>
      <?php endif; ?>
     <a class="open-inline-noreturn action-item crm-hover-button" href="<?php echo $this->_tpl_vars['ccModeLink']; ?>
">&raquo; <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>submit credit card contribution<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
    </div>
    <?php endif; ?>
  <div class="crm-submit-buttons">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/common/formButtons.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  </div>
  <?php if ($this->_tpl_vars['isOnline']): ?><?php $this->assign('valueStyle', " class='view-value'"); ?><?php else: ?><?php $this->assign('valueStyle', ""); ?><?php endif; ?>
  <table class="form-layout-compressed">
    <?php if ($this->_tpl_vars['context'] != 'standalone'): ?>
    <tr>
      <td class="font-size12pt label"><strong><strong><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Contributor<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong></td><td class="font-size12pt"><strong><?php echo $this->_tpl_vars['displayName']; ?>
</strong></td>
    </tr>
    <?php else: ?>
      <td class="label"><?php echo $this->_tpl_vars['form']['contact_id']['label']; ?>
</td>
      <td><?php echo $this->_tpl_vars['form']['contact_id']['html']; ?>
</td>
    <?php endif; ?>
    <tr class="crm-contribution-form-block-contribution_type_id crm-contribution-form-block-financial_type_id">
      <td class="label"><?php echo $this->_tpl_vars['form']['financial_type_id']['label']; ?>
</td><td<?php echo $this->_tpl_vars['valueStyle']; ?>
><?php echo $this->_tpl_vars['form']['financial_type_id']['html']; ?>
&nbsp;
      <?php if ($this->_tpl_vars['is_test']): ?>
        <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>(test)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      <?php endif; ?> <?php echo smarty_function_help(array('id' => "id-financial_type"), $this);?>

      </td>
    </tr>
    <?php if ($this->_tpl_vars['action'] == 2 && $this->_tpl_vars['lineItem'] && ! $this->_tpl_vars['defaultContribution']): ?>
    <tr>
      <td class="label"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Contribution Amount<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
      <td><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Price/Page/LineItem.tpl", 'smarty_include_vars' => array('context' => 'Contribution')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></td>
    </tr>
    <?php else: ?>
    <tr  class="crm-contribution-form-block-total_amount">
      <td class="label"><?php echo $this->_tpl_vars['form']['total_amount']['label']; ?>
</td>
      <td <?php echo $this->_tpl_vars['valueStyle']; ?>
>
        <span id='totalAmount'><?php echo ((is_array($_tmp=$this->_tpl_vars['form']['currency']['html'])) ? $this->_run_mod_handler('crmAddClass', true, $_tmp, 'eight') : smarty_modifier_crmAddClass($_tmp, 'eight')); ?>
&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['form']['total_amount']['html'])) ? $this->_run_mod_handler('crmAddClass', true, $_tmp, 'eight') : smarty_modifier_crmAddClass($_tmp, 'eight')); ?>
</span>
        <?php if ($this->_tpl_vars['freezeFinancialType']): ?>
          <?php echo smarty_function_help(array('id' => "id-total_amount"), $this);?>

        <?php endif; ?>
        <?php if (! $this->_tpl_vars['payNow']): ?>
          <?php if ($this->_tpl_vars['hasPriceSets']): ?>
            <span id='totalAmountORPriceSet'> <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>OR<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
            <span id='selectPriceSet'><?php echo $this->_tpl_vars['form']['price_set_id']['html']; ?>
</span>
            <div id="priceset" class="hiddenElement"></div>
          <?php endif; ?>

          <?php if ($this->_tpl_vars['ppID']): ?><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a class='action-item crm-hover-button' onclick='adjustPayment();'>adjust payment amount</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo smarty_function_help(array('id' => "adjust-payment-amount"), $this);?>
<?php endif; ?>
          <div id="totalAmountBlock">
            <?php if ($this->_tpl_vars['hasPriceSets']): ?><span class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Alternatively, you can use a price set.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span><?php endif; ?>
            <div id="totalTaxAmount" class="label"></div>
          </div>
        <?php endif; ?>
      </td>
    </tr>

      <?php if ($this->_tpl_vars['buildRecurBlock'] && ! $this->_tpl_vars['payNow']): ?>
      <tr id='recurringPaymentBlock' class='hiddenElement'>
        <td></td>
        <td>
          <strong><?php echo $this->_tpl_vars['form']['is_recur']['html']; ?>
 <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>every<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            &nbsp;<?php echo $this->_tpl_vars['form']['frequency_interval']['html']; ?>

            &nbsp;<?php echo $this->_tpl_vars['form']['frequency_unit']['html']; ?>
&nbsp;
            <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>for<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            &nbsp;<?php echo $this->_tpl_vars['form']['installments']['html']; ?>

            &nbsp;<?php echo $this->_tpl_vars['form']['installments']['label']; ?>

          </strong>
          <br />
          <span class="description">
            <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Your recurring contribution will be processed automatically for the number of installments you specify. You can leave the number of installments blank if you want to make an open-ended commitment. In either case, you can choose to cancel at any time. You will receive an email receipt for each recurring contribution. The receipts will include a link you can use if you decide to modify or cancel your future contributions.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
          </span>
        </td>
      </tr>
      <?php endif; ?>

    <tr id="adjust-option-type" class="crm-contribution-form-block-option_type">
      <td class="label"></td><td <?php echo $this->_tpl_vars['valueStyle']; ?>
><?php echo $this->_tpl_vars['form']['option_type']['html']; ?>
</td>
    </tr>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['contributionMode'] && $this->_tpl_vars['processorSupportsFutureStartDate']): ?>
    <tr id='start_date' class="crm-contribution-form-block-receive_date">
      <td class="label"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Start Date<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
      <td <?php echo $this->_tpl_vars['valueStyle']; ?>
><?php if ($this->_tpl_vars['hideCalender'] != true): ?><?php echo $this->_tpl_vars['form']['receive_date']['html']; ?>
<?php endif; ?><br />
        <span class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>You can set a start date for recurring contributions and the first payment will be on that date. For a single post-dated contribution you must select recurring and choose one installment<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
      </td>
    </tr>
    <?php endif; ?>

  <tr class="crm-contribution-form-block-source">
    <td class="label"><?php echo $this->_tpl_vars['form']['source']['label']; ?>
</td>
    <td <?php echo $this->_tpl_vars['valueStyle']; ?>
><?php echo ((is_array($_tmp=$this->_tpl_vars['form']['source']['html'])) ? $this->_run_mod_handler('crmAddClass', true, $_tmp, 'huge') : smarty_modifier_crmAddClass($_tmp, 'huge')); ?>
 <?php echo smarty_function_help(array('id' => "id-contrib_source"), $this);?>

    </td>
  </tr>

    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Campaign/Form/addCampaignToComponent.tpl", 'smarty_include_vars' => array('campaignTrClass' => "crm-contribution-form-block-campaign_id")));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

    <?php if (! $this->_tpl_vars['contributionMode'] || $this->_tpl_vars['payNow']): ?>
      <tr class="crm-contribution-form-block-contribution_status_id">
        <td class="label"><?php echo $this->_tpl_vars['form']['contribution_status_id']['label']; ?>
</td>
        <td><?php echo $this->_tpl_vars['form']['contribution_status_id']['html']; ?>

        <?php if ($this->_tpl_vars['contribution_status_id'] == 2): ?><?php if ($this->_tpl_vars['is_pay_later']): ?>: <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Pay Later<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php else: ?>: <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Incomplete Transaction<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?><?php endif; ?>
        </td>
        <td>
        <?php if (! $this->_tpl_vars['isUsePaymentBlock'] && $this->_tpl_vars['contactId'] && $this->_tpl_vars['contribID'] && $this->_tpl_vars['contributionMode'] == null && $this->_tpl_vars['contribution_status_id'] == 2): ?>
          <?php ob_start(); ?><?php echo CRM_Utils_System::crmURL(array('p' => 'civicrm/contact/view/contribution','q' => "reset=1&action=update&id=".($this->_tpl_vars['contribID'])."&cid=".($this->_tpl_vars['contactId'])."&context=".($this->_tpl_vars['context'])."&mode=live"), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('payNowLink', ob_get_contents());ob_end_clean(); ?>
          <a class="open-inline action-item crm-hover-button" href="<?php echo $this->_tpl_vars['payNowLink']; ?>
">&raquo; <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Pay with Credit Card<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
        <?php endif; ?>
      </td>
      </tr>
    <?php endif; ?>

    <?php if (! $this->_tpl_vars['contributionMode']): ?>
            <tr id="cancelInfo" class="crm-contribution-form-block-cancelInfo">
        <td>&nbsp;</td>
        <td><fieldset><legend><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Cancellation or Refund Information<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></legend>
          <table class="form-layout-compressed">
            <tr id="cancelDate" class="crm-contribution-form-block-cancel_date">
              <td class="label"><?php echo $this->_tpl_vars['form']['cancel_date']['label']; ?>
</td>
              <td>
                <?php if ($this->_tpl_vars['hideCalendar'] != true): ?>
                  <?php echo $this->_tpl_vars['form']['cancel_date']['html']; ?>

                <?php else: ?>
                  <?php echo ((is_array($_tmp=$this->_tpl_vars['form']['cancel_date']['value'])) ? $this->_run_mod_handler('crmDate', true, $_tmp) : smarty_modifier_crmDate($_tmp)); ?>

                <?php endif; ?>
              </td>
            </tr>
            <tr id="cancelDescription" class="crm-contribution-form-block-cancel_reason">
              <td class="label">&nbsp;</td>
              <td class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Enter the cancellation or refunded date, or you can skip this field and the cancellation date or refunded date will be automatically set to TODAY.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
            </tr>
            <tr id="cancelReason">
              <td class="label" style="vertical-align: top;"><?php echo $this->_tpl_vars['form']['cancel_reason']['label']; ?>
</td>
              <td><?php echo $this->_tpl_vars['form']['cancel_reason']['html']; ?>
</td>
            </tr>
            <tr id="refundTrxnID">
              <td class="label" style="vertical-align: top;"><?php echo $this->_tpl_vars['form']['refund_trxn_id']['label']; ?>
</td>
              <td><?php echo $this->_tpl_vars['form']['refund_trxn_id']['html']; ?>
</td>
            </tr>
          </table>
        </fieldset>
        </td>
      </tr>
      <tr class="crm-contribution-form-block-receive_date">
        <td class="label"><?php echo $this->_tpl_vars['form']['receive_date']['label']; ?>
</td>
        <td><?php echo $this->_tpl_vars['form']['receive_date']['html']; ?>
<br />
          <span class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>The date this contribution was received.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
        </td>
      </tr>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['form']['revenue_recognition_date'] && ! $this->_tpl_vars['payNow']): ?>
      <tr class="crm-contribution-form-block-revenue_recognition_date">
        <td class="label"><?php echo $this->_tpl_vars['form']['revenue_recognition_date']['label']; ?>
</td>
        <td><?php echo $this->_tpl_vars['form']['revenue_recognition_date']['html']; ?>
</td>
      </tr>
    <?php endif; ?>

    <?php if ($this->_tpl_vars['email'] && $this->_tpl_vars['outBound_option'] != 2): ?>
      <tr class="crm-contribution-form-block-is_email_receipt">
        <td class="label"><?php echo $this->_tpl_vars['form']['is_email_receipt']['label']; ?>
</td>
        <td><?php echo $this->_tpl_vars['form']['is_email_receipt']['html']; ?>
&nbsp;
          <span class="description"><?php $this->_tag_stack[] = array('ts', array('1' => $this->_tpl_vars['email'])); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Automatically email a receipt for this payment to %1?<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
        </td>
      </tr>
    <?php elseif ($this->_tpl_vars['context'] == 'standalone' && $this->_tpl_vars['outBound_option'] != 2): ?>
      <tr id="email-receipt" style="display:none;" class="crm-contribution-form-block-is_email_receipt">
        <td class="label"><?php echo $this->_tpl_vars['form']['is_email_receipt']['label']; ?>
</td>
        <td><?php echo $this->_tpl_vars['form']['is_email_receipt']['html']; ?>
 <span class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Automatically email a receipt for this payment to <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><span id="email-address"></span>?</span>
        </td>
      </tr>
    <?php endif; ?>
    <tr id="fromEmail" class="crm-contribution-form-block-receipt_date" style="display:none;">
      <td class="label"><?php echo $this->_tpl_vars['form']['from_email_address']['label']; ?>
</td>
      <td><?php echo $this->_tpl_vars['form']['from_email_address']['html']; ?>
 <?php echo smarty_function_help(array('id' => "id-from_email",'file' => "CRM/Contact/Form/Task/Email.hlp",'isAdmin' => $this->_tpl_vars['isAdmin']), $this);?>
</td>
    </tr>
    <tr id="receiptDate" class="crm-contribution-form-block-receipt_date">
      <td class="label"><?php echo $this->_tpl_vars['form']['receipt_date']['label']; ?>
</td>
      <td><?php echo $this->_tpl_vars['form']['receipt_date']['html']; ?>
<br />
        <span class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Date that a receipt was sent to the contributor.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
      </td>
    </tr>
    <?php if ($this->_tpl_vars['form']['payment_processor_id']): ?>
      <tr class="crm-contribution-form-block-payment_processor_id"><td class="label nowrap"><?php echo $this->_tpl_vars['form']['payment_processor_id']['label']; ?>
<span class="crm-marker"> * </span></td><td><?php echo $this->_tpl_vars['form']['payment_processor_id']['html']; ?>
</td></tr>
    <?php endif; ?>
  </table>

  <?php if (! $this->_tpl_vars['contributionMode']): ?>
    <fieldset class="payment-details_group">
      <legend>
        <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Payment Details<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      </legend>
      <?php if ($this->_tpl_vars['isUsePaymentBlock']): ?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Contribute/Form/PaymentInfoBlock.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
      <?php else: ?>
        <table class="form-layout-compressed" >
          <tr class="crm-contribution-form-block-payment_instrument_id">
            <td class="label"><?php echo $this->_tpl_vars['form']['payment_instrument_id']['label']; ?>
</td>
            <td <?php echo $this->_tpl_vars['valueStyle']; ?>
><?php echo $this->_tpl_vars['form']['payment_instrument_id']['html']; ?>
 <?php echo smarty_function_help(array('id' => 'payment_instrument_id'), $this);?>
</td>
            </td>
          </tr>
          <tr class="crm-contribution-form-block-trxn_id">
            <td class="label"><?php echo $this->_tpl_vars['form']['trxn_id']['label']; ?>
</td>
            <td <?php echo $this->_tpl_vars['valueStyle']; ?>
><?php echo $this->_tpl_vars['form']['trxn_id']['html']; ?>
 <?php echo smarty_function_help(array('id' => "id-trans_id"), $this);?>
</td>
          </tr>
        </table>
      <?php endif; ?>
      </fieldset>
  <?php endif; ?>

  <?php if (! $this->_tpl_vars['isUsePaymentBlock']): ?>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => 'CRM/Core/BillingBlockWrapper.tpl', 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <?php endif; ?>

    <!-- start of soft credit -->
    <?php if (! $this->_tpl_vars['payNow']): ?>
      <div class="crm-accordion-wrapper crm-accordion_title-accordion crm-accordion-processed <?php if ($this->_tpl_vars['noSoftCredit']): ?>collapsed<?php endif; ?>" id="softCredit">
        <div class="crm-accordion-header">
          <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Soft Credit<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>&nbsp;<?php echo smarty_function_help(array('id' => "id-soft_credit"), $this);?>

        </div>
        <div class="crm-accordion-body">
          <table class="form-layout-compressed">
            <tr class="crm-contribution-form-block-soft_credit_to">
              <td colspan="2">
                <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Contribute/Form/SoftCredit.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
              </td>
            </tr>
          </table>
        </div>
      </div>
    <?php endif; ?>
    <!-- end of soft credit -->

    <!-- start of PCP -->
    <?php if ($this->_tpl_vars['siteHasPCPs'] && ! $this->_tpl_vars['payNow']): ?>
      <div class="crm-accordion-wrapper crm-accordion_title-accordion crm-accordion-processed <?php if ($this->_tpl_vars['noPCP']): ?>collapsed<?php endif; ?>" id="softCredit">
        <div class="crm-accordion-header">
          <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Personal Campaign Page<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>&nbsp;<?php echo smarty_function_help(array('id' => "id-pcp"), $this);?>

        </div>
        <div class="crm-accordion-body">
          <table class="form-layout-compressed">
            <tr class="crm-contribution-pcp-block crm-contribution-form-block-pcp_made_through_id">
              <td class="label"><?php echo $this->_tpl_vars['form']['pcp_made_through_id']['label']; ?>
</td>
              <td>
                <?php echo $this->_tpl_vars['form']['pcp_made_through_id']['html']; ?>
 &nbsp;
                <div class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Search for the Personal Campaign Page by the fund-raiser's last name or email address.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>

                <div class="spacer"></div>
                 <div class="crm-contribution-form-block-pcp_details">
                  <table class="crm-contribution-form-table-credit_to_pcp">
                    <tr id="pcpDisplayRollID" class="crm-contribution-form-block-pcp_display_in_roll">
                      <td class="label"><?php echo $this->_tpl_vars['form']['pcp_display_in_roll']['label']; ?>
</td>
                      <td><?php echo $this->_tpl_vars['form']['pcp_display_in_roll']['html']; ?>
</td>
                    </tr>
                    <tr id="nickID" class="crm-contribution-form-block-pcp_roll_nickname">
                      <td class="label"><?php echo $this->_tpl_vars['form']['pcp_roll_nickname']['label']; ?>
</td>
                      <td><?php echo ((is_array($_tmp=$this->_tpl_vars['form']['pcp_roll_nickname']['html'])) ? $this->_run_mod_handler('crmAddClass', true, $_tmp, 'big') : smarty_modifier_crmAddClass($_tmp, 'big')); ?>
<br/>
                        <div class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Name or nickname contributor wants to be displayed in the Honor Roll. Enter "Anonymous" for anonymous contributions.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
                      </td>
                    </tr>
                    <tr id="personalNoteID" class="crm-contribution-form-block-pcp_personal_note">
                      <td class="label" style="vertical-align: top"><?php echo $this->_tpl_vars['form']['pcp_personal_note']['label']; ?>
</td>
                      <td>
                        <?php echo $this->_tpl_vars['form']['pcp_personal_note']['html']; ?>

                        <div
                          class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Personal message submitted by contributor for display in the Honor Roll.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
                      </td>
                    </tr>
                  </table>
                </div>
              </td>
            </tr>
          </table>
        </div>
      </div>
      <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Contribute/Form/PCP.js.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php endif; ?>
    <!-- end of PCP -->

  <?php if (! $this->_tpl_vars['payNow']): ?>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/common/customDataBlock.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <?php endif; ?>

  <?php echo '
  <script type="text/javascript">
    CRM.$(function($) {
    '; ?>

      <?php if ($this->_tpl_vars['buildPriceSet']): ?><?php echo 'buildAmount();'; ?>
<?php endif; ?>
    <?php echo '

    // bind first click of accordion header to load crm-accordion-body with snippet
    // everything else taken care of by cj().crm-accordions()
      cj(\'#adjust-option-type\').hide();
      cj(\'.crm-ajax-accordion .crm-accordion-header\').one(\'click\', function() {
        loadPanes(cj(this).attr(\'id\'));
      });
      cj(\'.crm-ajax-accordion:not(.collapsed) .crm-accordion-header\').each(function(index) {
        loadPanes(cj(this).attr(\'id\'));
      });
    });
    // load panes function calls for snippet based on id of crm-accordion-header
    function loadPanes( id ) {
      var url = "'; ?>
<?php echo CRM_Utils_System::crmURL(array('p' => 'civicrm/contact/view/contribution','q' => "snippet=4&id=".($this->_tpl_vars['entityID'])."&formType=",'h' => 0), $this);?>
<?php echo '" + id;
      '; ?>

      <?php if ($this->_tpl_vars['contributionMode']): ?>
        url = url + "&mode=<?php echo $this->_tpl_vars['contributionMode']; ?>
";
      <?php endif; ?>
      <?php if ($this->_tpl_vars['qfKey']): ?>
        url = url + "&qfKey=<?php echo $this->_tpl_vars['qfKey']; ?>
";
      <?php endif; ?>
      <?php echo '
      if (! cj(\'div.\'+id).html()) {
        var loading = \'<img src="'; ?>
<?php echo $this->_tpl_vars['config']->resourceBase; ?>
i/loading.gif<?php echo '" alt="'; ?>
<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>loading<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '" />&nbsp;'; ?>
<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Loading<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '...\';
        cj(\'div.\'+id).html(loading);
        cj.ajax({
          url    : url,
          success: function(data) { cj(\'div.\'+id).html(data).trigger(\'crmLoad\'); }
        });
      }
    }

  var url = '; ?>
<?php echo json_encode($this->_tpl_vars['dataUrl']); ?>
<?php echo ';

  '; ?>

    <?php if ($this->_tpl_vars['context'] == 'standalone' && $this->_tpl_vars['outBound_option'] != 2): ?>
      <?php echo '
      CRM.$(function($) {

        var $form = $("form.'; ?>
<?php echo $this->_tpl_vars['form']['formClass']; ?>
<?php echo '");
        $("#contact_id", $form).change(checkEmail);
        checkEmail( );

        function checkEmail( ) {
          var data = $("#contact_id", $form).select2(\'data\');
          if (data && data.extra && data.extra.email && data.extra.email.length) {
            $("#email-receipt", $form).show();
            $("#email-address", $form).html(data.extra.email);
          }
          else {
            $("#email-receipt", $form).hide();
          }
        }

        showHideByValue( \'is_email_receipt\', \'\', \'receiptDate\', \'table-row\', \'radio\', true);
        showHideByValue( \'is_email_receipt\', \'\', \'fromEmail\', \'table-row\', \'radio\', false );
      });

    '; ?>

    <?php endif; ?>
  </script>

  <div class="accordion ui-accordion ui-widget ui-helper-reset">
      <?php $_from = $this->_tpl_vars['allPanes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['paneName'] => $this->_tpl_vars['paneValue']):
?>

      <div class="crm-accordion-wrapper crm-ajax-accordion crm-<?php echo $this->_tpl_vars['paneValue']['id']; ?>
-accordion <?php if ($this->_tpl_vars['paneValue']['open'] != 'true'): ?>collapsed<?php endif; ?>">
        <div class="crm-accordion-header" id="<?php echo $this->_tpl_vars['paneValue']['id']; ?>
">

          <?php echo $this->_tpl_vars['paneName']; ?>

        </div><!-- /.crm-accordion-header -->
        <div class="crm-accordion-body">

          <div class="<?php echo $this->_tpl_vars['paneValue']['id']; ?>
"></div>
        </div><!-- /.crm-accordion-body -->
      </div><!-- /.crm-accordion-wrapper -->

    <?php endforeach; endif; unset($_from); ?>
  </div>

  <?php endif; ?>
<br />
<div class="crm-submit-buttons"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/common/formButtons.tpl", 'smarty_include_vars' => array('location' => 'bottom')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
</div>

  <?php echo '
  <script type="text/javascript">
  function verify( ) {
    if (cj(\'#is_email_receipt\').prop(\'checked\' )) {
      var ok = confirm( \''; ?>
<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Click OK to save this contribution record AND send a receipt to the contributor now<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '.\' );
      if (!ok) {
        return false;
      }
    }
  }
  </script>
  '; ?>


  <?php if ($this->_tpl_vars['action'] != 8): ?>
    <?php echo '
    <script type="text/javascript">
      CRM.$(function($) {
        var $form = $(\'form.'; ?>
<?php echo $this->_tpl_vars['form']['formClass']; ?>
<?php echo '\');
        checkEmailDependancies();
        $(\'#is_email_receipt\', $form).click(function() {
          checkEmailDependancies();
        });

        function checkEmailDependancies( ) {
          if ($(\'#is_email_receipt\', $form).prop(\'checked\')) {
            $(\'#fromEmail\', $form).show();
            $(\'#receiptDate\', $form).hide();
          }
          else {
            $(\'#fromEmail\', $form).hide();
            $(\'#receiptDate\', $form).show();
          }
        }
        '; ?>
<?php if (! $this->_tpl_vars['contributionMode']): ?><?php echo '
          showHideCancelInfo($(\'#contribution_status_id\', $form));

          $(\'#contribution_status_id\', $form).change(function() {
            showHideCancelInfo($(\'#contribution_status_id\', $form));
          });

          function showHideCancelInfo(obj) {
            var cancelInfo_show_ids = ['; ?>
<?php echo $this->_tpl_vars['cancelInfo_show_ids']; ?>
<?php echo '];
            if (cancelInfo_show_ids.indexOf(obj.val()) > -1) {
              $(\'#cancelInfo\', $form).show();
              $(\'#total_amount\', $form).attr(\'readonly\', true);
            }
            else {
              $("#cancel_date", $form).val(\'\');
              $("#cancel_reason", $form).val(\'\');
              $(\'#cancelInfo\', $form).hide();
              $("#total_amount", $form).removeAttr(\'readonly\');
            }
          }
        '; ?>
<?php endif; ?>
      });
    </script>
  <?php endif; ?> 
<?php endif; ?> 
<?php echo '
<script type="text/javascript">

'; ?>


// load form during form rule.
<?php if ($this->_tpl_vars['buildPriceSet']): ?><?php echo 'buildAmount( );'; ?>
<?php endif; ?>

<?php echo '

// CRM-16451: set financial type of \'Price Set\' in back office contribution
// instead of selecting manually
function buildAmount( priceSetId, financialtypeIds ) {
  if (!priceSetId) priceSetId = cj("#price_set_id").val( );
  var fname = \'#priceset\';
  if (!priceSetId) {
    // hide price set fields.
    cj(fname).hide( );

    // show/hide price set amount and total amount.
    cj("#totalAmountORPriceSet").show( );
    cj("#totalAmount").show( );
    var choose = "'; ?>
<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Choose price set<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '";
    cj("#price_set_id option[value=\'\']").html( choose );

    cj(\'label[for="total_amount"]\').text(\''; ?>
<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Total Amount<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
    cj(".crm-contribution-form-block-financial_type_id").show();
    cj("#financial_type_id option[value=\'\']").attr(\'selected\', true);

    //we might want to build recur block.
    if (cj("#is_recur")) buildRecurBlock( null );
    return;
  }

  //don\'t allow recurring w/ priceset.
  if ( cj( "#is_recur" ) && cj( \'input:radio[name="is_recur"]:checked\').val( ) ) {
    //reset the values of recur block.
    cj("#installments").val(\'\');
    cj("#frequency_interval").val(\'\');
    cj(\'input:radio[name="is_recur"]\')[0].checked = true;
    cj("#recurringPaymentBlock").hide( );
  }

  var dataUrl = '; ?>
"<?php echo CRM_Utils_System::crmURL(array('h' => 0,'q' => 'snippet=4'), $this);?>
"<?php echo ' + \'&priceSetId=\' + priceSetId;

  var response = cj.ajax({
    url: dataUrl,
    async: false
  }).responseText;

  cj( fname ).show( ).html( response ).trigger(\'crmLoad\');
  // freeze total amount text field.
  cj( "#total_amount").val(\'\');

  cj( "#totalAmountORPriceSet" ).hide( );
  cj( "#totalAmount").hide( );
  var manual = "'; ?>
<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Manual contribution amount<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '";
  cj("#price_set_id option[value=\'\']").html( manual );

  cj(\'label[for="total_amount"]\').text(\''; ?>
<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Price Sets<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\');
  if (financialtypeIds) {
    cj("#financial_type_id option[value="+financialtypeIds[priceSetId]+"]").prop(\'selected\', true);
  }
  cj(".crm-contribution-form-block-financial_type_id").css("display", "none");
}

function adjustPayment( ) {
  cj(\'#adjust-option-type\').show();
  cj("#total_amount").removeAttr("READONLY");
  cj("#total_amount").css(\'background-color\', \'#ffffff\');
}

'; ?>
<?php if ($this->_tpl_vars['processorSupportsFutureStartDate']): ?><?php echo '
cj (\'input:radio[name="is_recur"]\').click( function( ) {
  showStartDate( );
});

showStartDate( );

function showStartDate( ) {
  if (cj( \'input:radio[name="is_recur"]:checked\').val( ) == 0 ) {
    cj(\'#start_date\').hide( );
  }
  else {
    cj(\'#start_date\').show( );
  }
}

'; ?>
<?php endif; ?><?php echo '
var thousandMarker = "'; ?>
<?php echo $this->_tpl_vars['config']->monetaryThousandSeparator; ?>
<?php echo '";
var separator = "'; ?>
<?php echo $this->_tpl_vars['config']->monetaryDecimalPoint; ?>
<?php echo '";

cj("#financial_type_id").on("change",function(){
    cj(\'#total_amount\').trigger("change");
})

cj("#currency").on("change",function(){
  cj(\'#total_amount\').trigger("change");
})

'; ?>
<?php if ($this->_tpl_vars['taxRates'] && $this->_tpl_vars['invoicing']): ?><?php echo '
CRM.$(function($) {
  $(\'#total_amount\').on("change",function(event) {
    if (event.handled !== true) {
      var freezeFinancialType = \''; ?>
<?php echo $this->_tpl_vars['freezeFinancialType']; ?>
<?php echo '\';
      if (!freezeFinancialType) {
        var financialType = $(\'#financial_type_id\').val();
        var taxRates = \''; ?>
<?php echo $this->_tpl_vars['taxRates']; ?>
<?php echo '\';
        var taxTerm = \''; ?>
<?php echo $this->_tpl_vars['taxTerm']; ?>
<?php echo '\';
        taxRates = JSON.parse(taxRates);
        var currencies = \''; ?>
<?php echo $this->_tpl_vars['currencies']; ?>
<?php echo '\';
        currencies = JSON.parse(currencies);
        var currencySelect = $(\'#currency\').val();
        var currencySymbol = currencies[currencySelect];
        var re= /\\((.*?)\\)/g;
        for(m = re.exec(currencySymbol); m; m = re.exec(currencySymbol)){
          currencySymbol = m[1];
        }
        var taxRate = taxRates[financialType];
        if (!taxRate) {
          taxRate = 0;
          cj("#totalTaxAmount").hide( );
        } else {
          cj("#totalTaxAmount").show( );
        }
        var totalAmount = $(\'#total_amount\').val();
        // replace all thousandMarker and change the separator to a dot
        totalAmount = totalAmount.replace(thousandMarker,\'\').replace(separator,\'.\');

        var totalTaxAmount = \''; ?>
<?php echo $this->_tpl_vars['totalTaxAmount']; ?>
<?php echo '\';
        var taxAmount = (taxRate/100)*totalAmount;
        taxAmount = isNaN (taxAmount) ? 0:taxAmount;
        var totalTaxAmount = taxAmount + Number(totalAmount);
        totalTaxAmount = formatMoney( totalTaxAmount, 2, separator, thousandMarker );
        $("#totalTaxAmount" ).html(\''; ?>
<?php $this->_tag_stack[] = array('ts', array('1' => $this->_tpl_vars['taxTerm'])); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Amount with %1 :<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo ' <span id="currencySymbolShow">\' + currencySymbol + \'</span> \'+ totalTaxAmount);
      }
      event.handled = true;
    }
    return false;
  });

  $(\'#total_amount\').trigger("change");
});
'; ?>
<?php endif; ?><?php echo '

CRM.$(function($) {
  $(\'#price_set_id\').click(function() {
    if( $(\'#price_set_id\').val() ) {
      $(\'#totalAmountBlock\').hide();
    }
    else {
      $(\'#totalAmountBlock\').show();
    }
  });
});

function formatMoney (amount, c, d, t){
  var n = amount,
  c = isNaN(c = Math.abs(c)) ? 2 : c,
  d = d == undefined ? "," : d,
  t = t == undefined ? "." : t, s = n < 0 ? "-" : "",
  i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "",
  j = (j = i.length) > 3 ? j % 3 : 0;
return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\\d{3})(?=\\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};
</script>
'; ?>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>