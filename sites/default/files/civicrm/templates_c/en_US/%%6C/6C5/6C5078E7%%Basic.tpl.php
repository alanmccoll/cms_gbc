<?php /* Smarty version 2.6.31, created on 2020-01-09 13:33:11
         compiled from CRM/Contact/Form/Search/Criteria/Basic.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Contact/Form/Search/Criteria/Basic.tpl', 1, false),array('modifier', 'escape', 'CRM/Contact/Form/Search/Criteria/Basic.tpl', 30, false),array('function', 'help', 'CRM/Contact/Form/Search/Criteria/Basic.tpl', 38, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><div class="advanced-search-fields basic-fields form-layout">
  <?php $_from = $this->_tpl_vars['basicSearchFields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fieldSpec']):
?>
    <?php $this->assign('field', $this->_tpl_vars['form'][$this->_tpl_vars['fieldSpec']['name']]); ?>
    <?php if ($this->_tpl_vars['field']): ?>
      <div class="search-field <?php echo ((is_array($_tmp=$this->_tpl_vars['fieldSpec']['class'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">
        <?php if ($this->_tpl_vars['fieldSpec']['template']): ?>
          <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['fieldSpec']['template'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php else: ?>
          <?php echo $this->_tpl_vars['field']['label']; ?>

          <?php if ($this->_tpl_vars['fieldSpec']['help']): ?>
            <?php $this->assign('help', $this->_tpl_vars['fieldSpec']['help']); ?>
            <?php ob_start(); ?><?php if ($this->_tpl_vars['fieldSpec']['help']): ?><?php echo $this->_tpl_vars['fieldSpec']['help']; ?>
<?php else: ?>''<?php endif; ?><?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('helpFile', ob_get_contents());ob_end_clean(); ?>
            <?php echo smarty_function_help(array('id' => $this->_tpl_vars['help']['id'],'file' => $this->_tpl_vars['help']['file']), $this);?>

          <?php endif; ?>
          <br />
          <?php echo $this->_tpl_vars['field']['html']; ?>

          <?php if ($this->_tpl_vars['fieldSpec']['description']): ?>
            <div class="description font-italic">
              <?php echo $this->_tpl_vars['fieldSpec']['description']; ?>

            </div>
          <?php endif; ?>
        <?php endif; ?>
      </div>
    <?php elseif ($this->_tpl_vars['fieldSpec']['is_custom']): ?>
      <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['fieldSpec']['template'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php endif; ?>
  <?php endforeach; endif; unset($_from); ?>
</div>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>