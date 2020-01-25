<?php /* Smarty version 2.6.31, created on 2020-01-02 18:24:27
         compiled from CRM/Contribute/Form/Search/ContributionRecur.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Contribute/Form/Search/ContributionRecur.tpl', 1, false),array('block', 'ts', 'CRM/Contribute/Form/Search/ContributionRecur.tpl', 30, false),array('modifier', 'crmAddClass', 'CRM/Contribute/Form/Search/ContributionRecur.tpl', 65, false),array('function', 'help', 'CRM/Contribute/Form/Search/ContributionRecur.tpl', 76, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<div class="crm-accordion-wrapper crm-contactDetails-accordion
   <?php if (empty ( $this->_tpl_vars['contribution_recur_pane_open'] )): ?> collapsed<?php endif; ?>" id="contribution_recur">
  <div class="crm-accordion-header">
    <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Recurring Contributions<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  </div>
  <div class="crm-accordion-body">
    <table class="form-layout-compressed">
      <tr>
        <td colspan="4"><?php echo $this->_tpl_vars['form']['contribution_recur_payment_made']['html']; ?>
</td>
      </tr>
      <tr>
        <td><label for="contribution_recur_start_date_relative"><?php echo $this->_tpl_vars['form']['contribution_recur_start_date_relative']['label']; ?>
</label></td>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Core/DatePickerRangeWrapper.tpl", 'smarty_include_vars' => array('fieldName' => 'contribution_recur_start_date','colspan' => '2','hideRelativeLabel' => 1)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
      </tr>
      <tr>
        <td><label for="contribution_recur_end_date_relative"><?php echo $this->_tpl_vars['form']['contribution_recur_end_date_relative']['label']; ?>
</label></td>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Core/DatePickerRangeWrapper.tpl", 'smarty_include_vars' => array('fieldName' => 'contribution_recur_end_date','colspan' => '2','hideRelativeLabel' => 1)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
      </tr>
      <tr>
        <td><label for="contribution_recur_modified_date_relative"><?php echo $this->_tpl_vars['form']['contribution_recur_modified_date_relative']['label']; ?>
</label></td>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Core/DatePickerRangeWrapper.tpl", 'smarty_include_vars' => array('fieldName' => 'contribution_recur_modified_date','colspan' => '2','hideRelativeLabel' => 1)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
      </tr>
      <tr>
        <td><label for="contribution_recur_next_sched_contribution_date_relative"><?php echo $this->_tpl_vars['form']['contribution_recur_next_sched_contribution_date_relative']['label']; ?>
</label></td>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Core/DatePickerRangeWrapper.tpl", 'smarty_include_vars' => array('fieldName' => 'contribution_recur_next_sched_contribution_date','colspan' => '2','hideRelativeLabel' => 1)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
      </tr>
      <tr>
        <td><label for="contribution_recur_failure_rety_date_relative"><?php echo $this->_tpl_vars['form']['contribution_recur_failure_retry_date_relative']['label']; ?>
</label></td>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Core/DatePickerRangeWrapper.tpl", 'smarty_include_vars' => array('fieldName' => 'contribution_recur_failure_retry_date','colspan' => '2','hideRelativeLabel' => 1)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
      </tr>
      <tr>
        <td><label for="contribution_recur_cancel_date_relative"><?php echo $this->_tpl_vars['form']['contribution_recur_cancel_date_relative']['label']; ?>
</label></td>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Core/DatePickerRangeWrapper.tpl", 'smarty_include_vars' => array('fieldName' => 'contribution_recur_cancel_date','colspan' => '2','hideRelativeLabel' => 1)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
      </tr>
      <tr>
        <td><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Status<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
        <td></td>
        <td col='span2'>
          <?php echo ((is_array($_tmp=$this->_tpl_vars['form']['contribution_recur_contribution_status_id']['html'])) ? $this->_run_mod_handler('crmAddClass', true, $_tmp, 'twenty') : smarty_modifier_crmAddClass($_tmp, 'twenty')); ?>

        </td>
      </tr>
      <tr>
        <td><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Payment Processor<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
        <td></td>
        <td col='span2'>
          <?php echo $this->_tpl_vars['form']['contribution_recur_payment_processor_id']['html']; ?>

        </td>
      </tr>
      <tr>
        <td><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Processor ID<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php echo smarty_function_help(array('id' => "processor-id",'file' => "CRM/Contact/Form/Search/Advanced"), $this);?>
</td>
        <td></td>
        <td col='span2'>
          <?php echo $this->_tpl_vars['form']['contribution_recur_processor_id']['html']; ?>

        </td>
      </tr>
      <tr>
        <td><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Transaction ID<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php echo smarty_function_help(array('id' => "transaction-id",'file' => "CRM/Contact/Form/Search/Advanced"), $this);?>
</td>
        <td></td>
        <td col='span2'>
          <?php echo $this->_tpl_vars['form']['contribution_recur_trxn_id']['html']; ?>

        </td>
      </tr>
      <?php if ($this->_tpl_vars['contributionRecurGroupTree']): ?>
        <tr>
          <td colspan="4">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Custom/Form/Search.tpl", 'smarty_include_vars' => array('groupTree' => $this->_tpl_vars['contributionRecurGroupTree'],'showHideLinks' => false)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
          </td>
        </tr>
      <?php endif; ?>
    </table>
  </div>
<!-- /.crm-accordion-body -->
</div><!-- /.crm-accordion-wrapper -->


<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>