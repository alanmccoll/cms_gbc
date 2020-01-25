<?php /* Smarty version 2.6.31, created on 2020-01-04 08:23:07
         compiled from CRM/Contact/Page/Inline/Basic.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Contact/Page/Inline/Basic.tpl', 1, false),array('block', 'ts', 'CRM/Contact/Page/Inline/Basic.tpl', 5, false),array('function', 'crmURL', 'CRM/Contact/Page/Inline/Basic.tpl', 4, false),array('modifier', 'colorContrast', 'CRM/Contact/Page/Inline/Basic.tpl', 9, false),array('modifier', 'escape', 'CRM/Contact/Page/Inline/Basic.tpl', 9, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><div class="crm-clear crm-inline-block-content">
  <div class="crm-summary-row">
    <div class="crm-label" id="tagLink">
      <a href="<?php echo CRM_Utils_System::crmURL(array('p' => 'civicrm/contact/view','q' => "reset=1&cid=".($this->_tpl_vars['contactId'])."&selectedChild=tag"), $this);?>
"
         title="<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit Tags<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tags<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
    </div>
    <div class="crm-content" id="tags">
      <?php $_from = $this->_tpl_vars['contactTag']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tagId'] => $this->_tpl_vars['tagName']):
?>
        <span class="crm-tag-item" <?php if (! empty ( $this->_tpl_vars['allTags'][$this->_tpl_vars['tagId']]['color'] )): ?>style="background-color: <?php echo $this->_tpl_vars['allTags'][$this->_tpl_vars['tagId']]['color']; ?>
; color: <?php echo ((is_array($_tmp=$this->_tpl_vars['allTags'][$this->_tpl_vars['tagId']]['color'])) ? $this->_run_mod_handler('colorContrast', true, $_tmp) : smarty_modifier_colorContrast($_tmp)); ?>
;"<?php endif; ?> title="<?php echo ((is_array($_tmp=$this->_tpl_vars['allTags'][$this->_tpl_vars['tagId']]['description'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">
          <?php echo $this->_tpl_vars['tagName']; ?>

        </span>
      <?php endforeach; endif; unset($_from); ?>
    </div>
  </div>
  <div class="crm-summary-row">
    <div class="crm-label"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Contact Type<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
    <div class="crm-content crm-contact_type_label">
      <?php if (isset ( $this->_tpl_vars['contact_type_label'] )): ?><?php echo $this->_tpl_vars['contact_type_label']; ?>
<?php endif; ?>
    </div>
  </div>
  <div class="crm-summary-row">
    <div class="crm-label">
      <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Contact ID<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php if (! empty ( $this->_tpl_vars['userRecordUrl'] )): ?> / <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>User ID<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?>
    </div>
    <div class="crm-content">
      <span class="crm-contact-contact_id"><?php echo $this->_tpl_vars['contactId']; ?>
</span>
      <?php if (! empty ( $this->_tpl_vars['userRecordUrl'] )): ?>
        <span class="crm-contact-user_record_id">
          &nbsp;/&nbsp;<a title="View user record" class="user-record-link"
                          href="<?php echo $this->_tpl_vars['userRecordUrl']; ?>
"><?php echo $this->_tpl_vars['userRecordId']; ?>
</a>
        </span>
      <?php endif; ?>
    </div>
  </div>
  <div class="crm-summary-row">
    <div class="crm-label"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>External ID<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
    <div class="crm-content crm-contact_external_identifier_label">
      <?php if (isset ( $this->_tpl_vars['external_identifier'] )): ?><?php echo $this->_tpl_vars['external_identifier']; ?>
<?php endif; ?>
    </div>
  </div>
</div>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>