<?php /* Smarty version 2.6.31, created on 2020-01-09 13:33:11
         compiled from CRM/Contact/Form/Search/Criteria/Fields/preferred_communication_method.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Contact/Form/Search/Criteria/Fields/preferred_communication_method.tpl', 1, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo $this->_tpl_vars['form']['preferred_communication_method']['label']; ?>

<br/>
<?php echo $this->_tpl_vars['form']['preferred_communication_method']['html']; ?>

<br/>

<?php if ($this->_tpl_vars['form']['email_on_hold']['type'] == 'select'): ?>
  <br/>
  <?php echo $this->_tpl_vars['form']['email_on_hold']['label']; ?>

  <br/>
  <?php echo $this->_tpl_vars['form']['email_on_hold']['html']; ?>

  <br/>
<?php elseif ($this->_tpl_vars['form']['email_on_hold']['type'] == 'checkbox'): ?>
  <div class="spacer"></div>
  <?php echo $this->_tpl_vars['form']['email_on_hold']['html']; ?>

  <?php echo $this->_tpl_vars['form']['email_on_hold']['label']; ?>

<?php endif; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>