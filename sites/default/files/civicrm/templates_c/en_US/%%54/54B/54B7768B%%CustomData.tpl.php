<?php /* Smarty version 2.6.31, created on 2020-01-06 16:35:47
         compiled from CRM/Contact/Form/Edit/Address/CustomData.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Contact/Form/Edit/Address/CustomData.tpl', 1, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php $_from = $this->_tpl_vars['address_groupTree'][$this->_tpl_vars['blockId']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['group_id'] => $this->_tpl_vars['cd_edit']):
?>
<div id="<?php echo $this->_tpl_vars['cd_edit']['name']; ?>
_<?php echo $this->_tpl_vars['group_id']; ?>
_<?php echo $this->_tpl_vars['blockId']; ?>
" class="form-item">
    <div class="crm-collapsible crm-<?php echo $this->_tpl_vars['cd_edit']['name']; ?>
_<?php echo $this->_tpl_vars['group_id']; ?>
_<?php echo $this->_tpl_vars['blockId']; ?>
-accordion <?php if ($this->_tpl_vars['cd_edit']['collapse_display']): ?>collapsed<?php endif; ?>">
        <div class="collapsible-title">
            <?php echo $this->_tpl_vars['cd_edit']['title']; ?>

        </div>
        <div>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Custom/Form/Edit/CustomData.tpl", 'smarty_include_vars' => array('customDataEntity' => 'address')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        </div>
    </div>

    <div id="custom_group_<?php echo $this->_tpl_vars['group_id']; ?>
_<?php echo $this->_tpl_vars['blockId']; ?>
"></div>
</div>
<?php endforeach; endif; unset($_from); ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>