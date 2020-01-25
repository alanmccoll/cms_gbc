<?php /* Smarty version 2.6.31, created on 2020-01-06 16:35:47
         compiled from CRM/Custom/Form/Edit/CustomData.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Custom/Form/Edit/CustomData.tpl', 1, false),array('block', 'ts', 'CRM/Custom/Form/Edit/CustomData.tpl', 3, false),array('function', 'crmKey', 'CRM/Custom/Form/Edit/CustomData.tpl', 4, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if (! $this->_tpl_vars['isSingleRecordEdit'] && $this->_tpl_vars['cd_edit']['is_multiple'] == 1 && $this->_tpl_vars['cd_edit']['table_id'] && $this->_tpl_vars['contactId'] && ! $this->_tpl_vars['skipTitle'] && $this->_tpl_vars['cd_edit']['style'] == 'Inline'): ?>
  <?php $this->assign('tableID', $this->_tpl_vars['cd_edit']['table_id']); ?>
  <a href="#" class="crm-hover-button crm-custom-value-del" title="<?php $this->_tag_stack[] = array('ts', array('1' => $this->_tpl_vars['cd_edit']['title'])); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete %1<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"
     data-post='{"valueID": "<?php echo $this->_tpl_vars['tableID']; ?>
", "groupID": "<?php echo $this->_tpl_vars['group_id']; ?>
", "contactId": "<?php echo $this->_tpl_vars['contactId']; ?>
", "key": "<?php echo smarty_function_crmKey(array('name' => 'civicrm/ajax/customvalue'), $this);?>
"}'>
    <span class="icon delete-icon"></span> <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  </a>
<?php endif; ?>

<?php if ($this->_tpl_vars['cd_edit']['help_pre']): ?>
  <div class="messages help"><?php echo $this->_tpl_vars['cd_edit']['help_pre']; ?>
</div>
<?php endif; ?>
<table <?php if (! $this->_tpl_vars['isSingleRecordEdit']): ?>class="form-layout-compressed"<?php endif; ?>>
  <?php $_from = $this->_tpl_vars['cd_edit']['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field_id'] => $this->_tpl_vars['element']):
?>
    <?php if ($this->_tpl_vars['customDataEntity'] && $this->_tpl_vars['blockId']): ?>
            <?php $this->assign('element_name', $this->_tpl_vars['element']['element_custom_name']); ?>
      <?php $this->assign('formElement', $this->_tpl_vars['form'][$this->_tpl_vars['customDataEntity']][$this->_tpl_vars['blockId']][$this->_tpl_vars['element_name']]); ?>
    <?php else: ?>
      <?php $this->assign('element_name', $this->_tpl_vars['element']['element_name']); ?>
      <?php $this->assign('formElement', $this->_tpl_vars['form'][$this->_tpl_vars['element_name']]); ?>
    <?php endif; ?>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Custom/Form/Edit/CustomField.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <?php endforeach; endif; unset($_from); ?>
</table>
<div class="spacer"></div>
<?php if ($this->_tpl_vars['cd_edit']['help_post']): ?><div class="messages help"><?php echo $this->_tpl_vars['cd_edit']['help_post']; ?>
</div><?php endif; ?>
<?php if (! $this->_tpl_vars['isSingleRecordEdit'] && $this->_tpl_vars['cd_edit']['is_multiple'] && ( ( $this->_tpl_vars['cd_edit']['max_multiple'] == '' ) || ( $this->_tpl_vars['cd_edit']['max_multiple'] > 0 && $this->_tpl_vars['cd_edit']['max_multiple'] > $this->_tpl_vars['cgCount'] ) )): ?>
  <?php if ($this->_tpl_vars['skipTitle']): ?>
        <div class="messages help">
      <em><?php $this->_tag_stack[] = array('ts', array('1' => $this->_tpl_vars['cd_edit']['title'])); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Click "Edit Contact" to add more %1 records<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></em>
    </div>
  <?php else: ?>
    <div id="add-more-link-<?php echo $this->_tpl_vars['cgCount']; ?>
" class="add-more-link-<?php echo $this->_tpl_vars['group_id']; ?>
 add-more-link-<?php echo $this->_tpl_vars['group_id']; ?>
-<?php echo $this->_tpl_vars['cgCount']; ?>
">
      <a href="#" class="crm-hover-button" onclick="CRM.buildCustomData('<?php echo $this->_tpl_vars['cd_edit']['extends']; ?>
',<?php if ($this->_tpl_vars['cd_edit']['subtype']): ?>'<?php echo $this->_tpl_vars['cd_edit']['subtype']; ?>
'<?php else: ?>'<?php echo $this->_tpl_vars['cd_edit']['extends_entity_column_id']; ?>
'<?php endif; ?>, '', <?php echo $this->_tpl_vars['cgCount']; ?>
, <?php echo $this->_tpl_vars['group_id']; ?>
, true ); return false;">
        <i class="crm-i fa-plus-circle"></i>
        <?php $this->_tag_stack[] = array('ts', array('1' => $this->_tpl_vars['cd_edit']['title'])); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Another %1 record<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      </a>
    </div>
  <?php endif; ?>
<?php endif; ?>

<?php $this->assign('customDataEntity', ''); ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>