<?php /* Smarty version 2.6.31, created on 2020-01-02 18:12:37
         compiled from CRM/Sumfields/Form/SumFields.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Sumfields/Form/SumFields.tpl', 1, false),array('block', 'ts', 'CRM/Sumfields/Form/SumFields.tpl', 1, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><h3><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Extension Status<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h3>

<table class="form-layout-compressed">
  <tr>
    <td class="description">
      <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Status of current settings:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    </td>
    <td>
      <span class="crm-i <?php echo $this->_tpl_vars['status_icon']; ?>
"></span>
      <?php echo $this->_tpl_vars['display_status']; ?>

    </td>
  </tr>
  <tr>
    <td class="description">
      <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Data update method:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    </td>
    <td>
      <span class="crm-i <?php echo $this->_tpl_vars['status_icon']; ?>
"></span>
      <?php echo $this->_tpl_vars['data_update_method']; ?>

    </td>
  </tr>  
  <?php $_from = $this->_tpl_vars['trigger_table_status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['tableName'] => $this->_tpl_vars['enabled']):
?>
    <tr>
      <td class="description <?php if ($this->_tpl_vars['enabled']): ?>sumfield-status-enabled<?php else: ?>sumfield-status-disabled<?php endif; ?>">
        <?php $this->_tag_stack[] = array('ts', array('1' => $this->_tpl_vars['tableName'])); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Triggers for %1:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
      </td>
      <td>
        <span class="crm-i fa-<?php if ($this->_tpl_vars['enabled']): ?>check<?php else: ?>circle-o<?php endif; ?>"></span>
        <?php if ($this->_tpl_vars['enabled']): ?><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Enabled<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php else: ?><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Not Enabled<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?>
      </td>
    </tr>
  <?php endforeach; endif; unset($_from); ?>
</table>

<h3><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Field Settings<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></h3>

<?php $_from = $this->_tpl_vars['fieldsets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['title'] => $this->_tpl_vars['fields']):
?>
  <fieldset>
    <legend><?php echo $this->_tpl_vars['title']; ?>
</legend>
    <table class="form-layout-compressed">
      <?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['name'] => $this->_tpl_vars['description']):
?>
        <?php if ($this->_tpl_vars['name'] == 'active_fundraising_fields'): ?>
          <tr><div class="help"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Fiscal Year can be set at <a href="/civicrm-master/civicrm/admin/setting/date?action=reset=1">Administer &gt; Localization &gt; Date Formats</a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div></tr>
        <?php endif; ?>
        <tr class="crm-sumfields-form-block-sumfields_<?php echo $this->_tpl_vars['name']; ?>
">
          <td class="label"><?php echo $this->_tpl_vars['form'][$this->_tpl_vars['name']]['label']; ?>
</td>
          <td>
            <?php echo $this->_tpl_vars['form'][$this->_tpl_vars['name']]['html']; ?>

            <?php if ($this->_tpl_vars['description']): ?><div class="description"><?php echo $this->_tpl_vars['description']; ?>
</div><?php endif; ?>
          </td>
        </tr>
      <?php endforeach; endif; unset($_from); ?>
    </table>
  </fieldset>
<?php endforeach; endif; unset($_from); ?>

  <div id="performance_settings">
   <div class="label"><?php echo $this->_tpl_vars['form']['data_update_method']['label']; ?>
</div>
   <span><?php echo $this->_tpl_vars['form']['data_update_method']['html']; ?>
</span>
   <div class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>If 'Instantly' is selected, data will be more accurate but you might face some performance issues on large installations. <br/> If 'Whenever the cron job is run' is selected, Summary Fields will rely on each CiviCRM Cron job to process all calculations needed for all contacts.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>   
 </div>
 <hr/>
 <div id="when_to_apply_change">
   <div class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Applying these settings via this form may cause your web server to time out. Applying changes on next scheduled job is recommended.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
   <div class="label"><?php echo $this->_tpl_vars['form']['when_to_apply_change']['label']; ?>
</div>
   <span><?php echo $this->_tpl_vars['form']['when_to_apply_change']['html']; ?>
</span>
 </div>

 <div class="crm-submit-buttons"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/common/formButtons.tpl", 'smarty_include_vars' => array('location' => 'bottom')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>

<?php echo '
<style type="text/css">
  #crm-container fieldset {
    border: 1px solid #CFCEC3;
    border-radius: 4px;
  }
</style>
'; ?>


<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>