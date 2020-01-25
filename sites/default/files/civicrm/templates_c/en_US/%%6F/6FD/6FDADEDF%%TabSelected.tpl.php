<?php /* Smarty version 2.6.31, created on 2020-01-02 18:11:57
         compiled from CRM/common/TabSelected.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/common/TabSelected.tpl', 1, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><script type='text/javascript'>
  var selectedTab = '<?php echo $this->_tpl_vars['defaultTab']; ?>
';
  var tabContainer = '#mainTabContainer';
  <?php if ($this->_tpl_vars['tabContainer']): ?>tabContainer = '<?php echo $this->_tpl_vars['tabContainer']; ?>
';<?php endif; ?>
  <?php if ($this->_tpl_vars['selectedChild']): ?>selectedTab = '<?php echo $this->_tpl_vars['selectedChild']; ?>
';<?php endif; ?>
  <?php echo '
  CRM.$(function($) {
    var tabIndex = $(\'#tab_\' + selectedTab).prevAll().length;
    $(tabContainer).tabs( {active: tabIndex} );
  });
  '; ?>

</script>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>