<?php /* Smarty version 2.6.31, created on 2020-01-04 10:26:35
         compiled from CRM/Dashlet/Page/MyCases.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Dashlet/Page/MyCases.tpl', 1, false),array('block', 'ts', 'CRM/Dashlet/Page/MyCases.tpl', 34, false),array('function', 'crmURL', 'CRM/Dashlet/Page/MyCases.tpl', 33, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['casePresent']): ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Case/Form/CaseFilter.tpl", 'smarty_include_vars' => array('context' => ($this->_tpl_vars['context']),'list' => "my-cases",'all' => '0')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <div class="form-item">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Case/Page/DashboardSelector.tpl", 'smarty_include_vars' => array('context' => ($this->_tpl_vars['context']),'list' => "my-cases",'all' => '0')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  </div>
<?php else: ?>
    <div class="messages status no-popup">
     <?php ob_start(); ?><?php echo CRM_Utils_System::crmURL(array('p' => 'civicrm/case/search','q' => 'reset=1'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('findCasesURL', ob_get_contents());ob_end_clean(); ?>
     <?php $this->_tag_stack[] = array('ts', array('1' => $this->_tpl_vars['findCasesURL'])); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no open cases with activities scheduled in the next two weeks. Use <a href="%1">Find Cases</a> to expand your search.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    </div>
<?php endif; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>