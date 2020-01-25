<?php /* Smarty version 2.6.31, created on 2020-01-02 18:24:39
         compiled from CRM/Contribute/Form/Task/PDFLetter.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Contribute/Form/Task/PDFLetter.tpl', 1, false),array('block', 'ts', 'CRM/Contribute/Form/Task/PDFLetter.tpl', 27, false),array('function', 'help', 'CRM/Contribute/Form/Task/PDFLetter.tpl', 41, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><div class="crm-form-block crm-block crm-contact-task-pdf-form-block">
<h3><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Thank-you Letter for Contributions (PDF)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h3>
<?php if ($this->_tpl_vars['single'] == false): ?>
    <div class="messages status no-popup"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Contribute/Form/Task.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
<?php endif; ?>

<div class="crm-accordion-wrapper crm-html_email-accordion ">
  <div class="crm-accordion-header">
    <?php echo $this->_tpl_vars['form']['more_options_header']['html']; ?>

  </div><!-- /.crm-accordion-header -->
  <div class="crm-accordion-body">
    <table class="form-layout-compressed">
      <tr><td class="label-left"><?php echo $this->_tpl_vars['form']['thankyou_update']['html']; ?>
 <?php echo $this->_tpl_vars['form']['thankyou_update']['label']; ?>
</td><td></td></tr>
      <tr><td class="label-left"><?php echo $this->_tpl_vars['form']['receipt_update']['html']; ?>
 <?php echo $this->_tpl_vars['form']['receipt_update']['label']; ?>
</td><td></td></tr>
      <tr>
        <td class="label-left"><?php echo $this->_tpl_vars['form']['group_by']['label']; ?>
 <?php echo smarty_function_help(array('id' => "id-contribution-grouping"), $this);?>
</td>
        <td><?php echo $this->_tpl_vars['form']['group_by']['html']; ?>
</td>
      </tr>
      <tr>
        <td class="label-left"><?php echo $this->_tpl_vars['form']['group_by_separator']['label']; ?>
</td>
        <td><?php echo $this->_tpl_vars['form']['group_by_separator']['html']; ?>
</td>
      </tr>
      <tr>
        <td class="label-left"><?php echo $this->_tpl_vars['form']['email_options']['label']; ?>
 <?php echo smarty_function_help(array('id' => "id-contribution-email-print"), $this);?>
</td>
        <td><?php echo $this->_tpl_vars['form']['email_options']['html']; ?>
</td>
      </tr>
      <tr>
        <td class="label-left"><?php echo $this->_tpl_vars['form']['from_email_address']['label']; ?>
 <?php echo smarty_function_help(array('id' => "id-from_email",'file' => "CRM/Contact/Form/Task/Email.hlp",'isAdmin' => $this->_tpl_vars['isAdmin']), $this);?>
</td>
        <td><?php echo $this->_tpl_vars['form']['from_email_address']['html']; ?>
</td>
      </tr>
    </table>
  </div><!-- /.crm-accordion-body -->
</div><!-- /.crm-accordion-wrapper -->

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Contact/Form/Task/PDFLetterCommon.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="crm-submit-buttons"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/common/formButtons.tpl", 'smarty_include_vars' => array('location' => 'bottom')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
</div>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>