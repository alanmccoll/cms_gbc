<?php /* Smarty version 2.6.31, created on 2020-01-03 11:49:49
         compiled from CRM/Admin/Form/Setting/Path.hlp */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Admin/Form/Setting/Path.hlp', 1, false),array('block', 'htxt', 'CRM/Admin/Form/Setting/Path.hlp', 1, false),array('block', 'ts', 'CRM/Admin/Form/Setting/Path.hlp', 2, false),array('function', 'crmResPath', 'CRM/Admin/Form/Setting/Path.hlp', 7, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $this->_tag_stack[] = array('htxt', array('id' => 'id-path_vars')); $_block_repeat=true;smarty_block_htxt($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Path Variables<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  <table>
    <tbody>
    <tr>
      <td><tt>[cms.root]</tt></td>
      <td><tt><?php echo smarty_function_crmResPath(array('ext' => 'cms.root'), $this);?>
</tt></td>
    </tr>
    <tr>
      <td><tt>[civicrm.root]</tt></td>
      <td><tt><?php echo smarty_function_crmResPath(array('ext' => 'civicrm.root'), $this);?>
</tt></td>
    </tr>
    <tr>
      <td><tt>[civicrm.files]</tt></td>
      <td><tt><?php echo smarty_function_crmResPath(array('ext' => 'civicrm.files'), $this);?>
</tt></td>
    </tr>
    </tbody>
  </table>
  <p>
    <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>These variables are computed automatically using <tt>civicrm.settings.php</tt> and its options, such as <tt>CIVICRM_TEMPLATE_COMPILEDIR</tt>.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  </p>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_htxt($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>