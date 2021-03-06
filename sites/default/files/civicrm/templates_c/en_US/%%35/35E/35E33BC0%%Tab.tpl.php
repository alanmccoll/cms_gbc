<?php /* Smarty version 2.6.31, created on 2020-01-07 16:15:37
         compiled from CRM/Case/Page/Tab.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Case/Page/Tab.tpl', 1, false),array('block', 'ts', 'CRM/Case/Page/Tab.tpl', 32, false),array('function', 'crmURL', 'CRM/Case/Page/Tab.tpl', 34, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['notConfigured']): ?>     <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Case/Page/ConfigureError.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php elseif ($this->_tpl_vars['redirectToCaseAdmin']): ?>
    <div class="messages status no-popup">
      <div class="icon inform-icon"></div>&nbsp;
         <strong><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Oops, It looks like there are no active case types.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></strong>
           <?php if (call_user_func ( array ( 'CRM_Core_Permission' , 'check' ) , ' administer CiviCase' )): ?>
             <?php ob_start(); ?><?php echo CRM_Utils_System::crmURL(array('p' => 'civicrm/a/#/caseType'), $this);?>

       <?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('adminCaseTypeURL', ob_get_contents());ob_end_clean(); ?>
             <?php $this->_tag_stack[] = array('ts', array('1' => $this->_tpl_vars['adminCaseTypeURL'],'2' => $this->_tpl_vars['adminCaseStatusURL'])); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Enable <a href='%1'>case types</a>.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
           <?php endif; ?>
    </div>

<?php else: ?>

    <?php ob_start(); ?><?php echo CRM_Utils_System::crmURL(array('p' => "civicrm/case/add",'q' => "reset=1&action=add&cid=".($this->_tpl_vars['contactId'])."&context=case"), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('newCaseURL', ob_get_contents());ob_end_clean(); ?>

    <?php if ($this->_tpl_vars['action'] == 1 || $this->_tpl_vars['action'] == 2 || $this->_tpl_vars['action'] == 8 || $this->_tpl_vars['action'] == 32768): ?>         <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Case/Form/Case.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php elseif ($this->_tpl_vars['action'] == 4): ?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Case/Form/CaseView.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

    <?php else: ?>
    <div class="crm-block crm-content-block">
    <div class="view-content">
    <div class="help">
         <?php $this->_tag_stack[] = array('ts', array('1' => $this->_tpl_vars['displayName'])); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>This page lists all case records for %1.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
         <?php if ($this->_tpl_vars['permission'] == 'edit' && call_user_func ( array ( 'CRM_Core_Permission' , 'check' ) , 'access all cases and activities' ) && $this->_tpl_vars['allowToAddNewCase']): ?>
         <?php $this->_tag_stack[] = array('ts', array('1' => "href='".($this->_tpl_vars['newCaseURL'])."' class='action-item'")); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Click <a %1>Add Case</a> to add a case record for this contact.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?>
    </div>

    <?php if ($this->_tpl_vars['action'] == 16 && $this->_tpl_vars['permission'] == 'edit' && ( call_user_func ( array ( 'CRM_Core_Permission' , 'check' ) , 'access all cases and activities' ) || call_user_func ( array ( 'CRM_Core_Permission' , 'check' ) , 'add cases' ) ) && $this->_tpl_vars['allowToAddNewCase']): ?>
        <div class="action-link">
        <a accesskey="N" href="<?php echo $this->_tpl_vars['newCaseURL']; ?>
" class="button no-popup"><span><i class="crm-i fa-plus-circle"></i> <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Add Case<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></a>
        </div>
    <?php endif; ?>

    <?php if ($this->_tpl_vars['rows']): ?>
          <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Case/Form/Selector.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php else: ?>
       <div class="messages status no-popup">
          <div class="icon inform-icon"></div>
            <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no case records for this contact.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
          </div>
    <?php endif; ?>
    </div>
    </div>
    <?php endif; ?>
<?php endif; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>