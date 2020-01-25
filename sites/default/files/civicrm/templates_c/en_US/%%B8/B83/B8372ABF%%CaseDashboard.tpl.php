<?php /* Smarty version 2.6.31, created on 2020-01-12 16:20:25
         compiled from CRM/Dashlet/Page/CaseDashboard.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Dashlet/Page/CaseDashboard.tpl', 1, false),array('block', 'ts', 'CRM/Dashlet/Page/CaseDashboard.tpl', 37, false),array('function', 'crmURL', 'CRM/Dashlet/Page/CaseDashboard.tpl', 29, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<div id="case_dashboard_dashlet" class="form-item">

<?php ob_start(); ?><?php echo CRM_Utils_System::crmURL(array('p' => "civicrm/case/add",'q' => "action=add&context=standalone&reset=1"), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('newCaseURL', ob_get_contents());ob_end_clean(); ?>

<div class="float-right">
  <table class="form-layout-compressed">
   <?php if ($this->_tpl_vars['newClient']): ?>
    <tr>
      <td>
        <a href="<?php echo $this->_tpl_vars['newCaseURL']; ?>
" class="button">
          <span><i class="crm-i fa-plus-circle"></i> <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>New Case<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
        </a>
      </td>
    </tr>
   <?php endif; ?>
   <?php if ($this->_tpl_vars['myCases']): ?>
    <tr>
      <td class="right">
        <a href="<?php echo CRM_Utils_System::crmURL(array('p' => "civicrm/case",'q' => "reset=1&all=1"), $this);?>
"><span>&raquo; <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Show ALL Cases with Upcoming Activities<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></a>
      </td>
    </tr>
   <?php else: ?>
    <tr>
      <td class="right">
        <a href="<?php echo CRM_Utils_System::crmURL(array('p' => "civicrm/case",'q' => "reset=1&all=0"), $this);?>
"><span>&raquo; <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Show My Cases with Upcoming Activities<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></a>
      </td>
    </tr>
   <?php endif; ?>
   <tr>
     <td class="right">
       <a href="<?php echo CRM_Utils_System::crmURL(array('p' => "civicrm/case/search",'q' => "reset=1&case_owner=1&force=1"), $this);?>
"><span>&raquo; <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Show My Cases<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></a>
     </td>
   </tr>
  </table>
</div>

<h3><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Summary of Involvement<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h3>

<table class="report">
  <tr class="columnheader">
    <th>&nbsp;</th>
    <?php $_from = $this->_tpl_vars['casesSummary']['headers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['header']):
?>
    <th scope="col" class="right" style="padding-right: 10px;"><a href="<?php echo $this->_tpl_vars['header']['url']; ?>
"><?php echo $this->_tpl_vars['header']['status']; ?>
</a></th>
    <?php endforeach; endif; unset($_from); ?>
  </tr>
  <?php $_from = $this->_tpl_vars['casesSummary']['rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['caseType'] => $this->_tpl_vars['row']):
?>
   <tr>
   <th><strong><?php echo $this->_tpl_vars['caseType']; ?>
</strong></th>
   <?php $_from = $this->_tpl_vars['casesSummary']['headers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['header']):
?>
    <?php $this->assign('caseStatus', $this->_tpl_vars['header']['status']); ?>
    <td class="label">
    <?php if ($this->_tpl_vars['row'][$this->_tpl_vars['caseStatus']]): ?>
    <a href="<?php echo $this->_tpl_vars['row'][$this->_tpl_vars['caseStatus']]['url']; ?>
"><?php echo $this->_tpl_vars['row'][$this->_tpl_vars['caseStatus']]['count']; ?>
</a>
    <?php else: ?>
     0
    <?php endif; ?>
    </td>
   <?php endforeach; endif; unset($_from); ?>
  </tr>
  <?php endforeach; endif; unset($_from); ?>
</table>

</div>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>