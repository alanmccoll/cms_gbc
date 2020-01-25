<?php /* Smarty version 2.6.31, created on 2020-01-04 08:25:41
         compiled from CRM/Contact/Form/Task/Batch.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Contact/Form/Task/Batch.tpl', 1, false),array('block', 'ts', 'CRM/Contact/Form/Task/Batch.tpl', 28, false),array('function', 'cycle', 'CRM/Contact/Form/Task/Batch.tpl', 43, false),array('modifier', 'substr', 'CRM/Contact/Form/Task/Batch.tpl', 76, false),array('modifier', 'replace', 'CRM/Contact/Form/Task/Batch.tpl', 78, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><div class="batch-update crm-form-block crm-contact-task-batch-form-block">
  <div class="help">
  <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Update field values for each contact as needed. Click <strong>Update Contacts</strong> below to save all your changes. To set a field to the same value for ALL rows, enter that value for the first contact and then click the <strong>Copy icon</strong> (next to the column title).<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  </div>
  <table class="crm-copy-fields">
    <thead class="sticky">
    <tr class="columnheader">
      <td><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Name<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
    <?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fieldName'] => $this->_tpl_vars['field']):
?>
      <?php if ($this->_tpl_vars['field']['skipDisplay']): ?>
        <?php continue; ?>
      <?php endif; ?>
      <td><img  src="<?php echo $this->_tpl_vars['config']->resourceBase; ?>
i/copy.png" alt="<?php $this->_tag_stack[] = array('ts', array('1' => $this->_tpl_vars['field']['title'])); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Click to copy %1 from row one to all rows.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" fname="<?php echo $this->_tpl_vars['field']['name']; ?>
" class="action-icon" title="<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Click here to copy the value in row one to ALL rows.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" /><?php echo $this->_tpl_vars['field']['title']; ?>
</td>
    <?php endforeach; endif; unset($_from); ?>
    </tr>
    </thead>
  <?php $_from = $this->_tpl_vars['componentIds']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['cid']):
?>
  <tr class="<?php echo smarty_function_cycle(array('values' => "odd-row,even-row"), $this);?>
" entity_id="<?php echo $this->_tpl_vars['cid']; ?>
">
    <td><?php echo $this->_tpl_vars['sortName'][$this->_tpl_vars['cid']]; ?>
</td>
    <?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['fieldName'] => $this->_tpl_vars['field']):
?>
      <?php if ($this->_tpl_vars['field']['skipDisplay']): ?>
        <?php continue; ?>
      <?php endif; ?>
      <?php $this->assign('n', $this->_tpl_vars['field']['name']); ?>
      <?php if ($this->_tpl_vars['field']['options_per_line']): ?>
        <td class="compressed">
          <?php $this->assign('count', '1'); ?>
          <?php echo '<table class="form-layout-compressed"><tr>'; ?><?php echo ''; ?><?php $this->assign('index', '1'); ?><?php echo ''; ?><?php $_from = $this->_tpl_vars['form']['field'][$this->_tpl_vars['cid']][$this->_tpl_vars['n']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['optionOuter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['optionOuter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['optionKey'] => $this->_tpl_vars['optionItem']):
        $this->_foreach['optionOuter']['iteration']++;
?><?php echo ''; ?><?php if ($this->_tpl_vars['index'] < 10): ?><?php echo ''; ?><?php $this->assign('index', ($this->_tpl_vars['index']+1)); ?><?php echo ''; ?><?php else: ?><?php echo '<td class="labels font-light">'; ?><?php echo $this->_tpl_vars['form']['field'][$this->_tpl_vars['cid']][$this->_tpl_vars['n']][$this->_tpl_vars['optionKey']]['html']; ?><?php echo '</td>'; ?><?php if ($this->_tpl_vars['count'] == $this->_tpl_vars['field']['options_per_line']): ?><?php echo '</tr><tr>'; ?><?php $this->assign('count', '1'); ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php $this->assign('count', ($this->_tpl_vars['count']+1)); ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endforeach; endif; unset($_from); ?><?php echo '</tr></table>'; ?>

        </td>
      <?php elseif (((is_array($_tmp=$this->_tpl_vars['n'])) ? $this->_run_mod_handler('substr', true, $_tmp, 0, 5) : substr($_tmp, 0, 5)) == 'phone'): ?>
        <td class="compressed">
          <?php $this->assign('phone_ext_field', ((is_array($_tmp=$this->_tpl_vars['n'])) ? $this->_run_mod_handler('replace', true, $_tmp, 'phone', 'phone_ext') : smarty_modifier_replace($_tmp, 'phone', 'phone_ext'))); ?>
          <?php echo $this->_tpl_vars['form']['field'][$this->_tpl_vars['cid']][$this->_tpl_vars['n']]['html']; ?>

          <?php if ($this->_tpl_vars['form']['field'][$this->_tpl_vars['cid']][$this->_tpl_vars['phone_ext_field']]['html']): ?>
            &nbsp;<?php echo $this->_tpl_vars['form']['field'][$this->_tpl_vars['cid']][$this->_tpl_vars['phone_ext_field']]['html']; ?>

          <?php endif; ?>
        </td>
      <?php else: ?>
        <td class="compressed"><?php echo $this->_tpl_vars['form']['field'][$this->_tpl_vars['cid']][$this->_tpl_vars['n']]['html']; ?>
</td>
      <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
  <?php endforeach; endif; unset($_from); ?>
  </tr>
  </table>
<?php if ($this->_tpl_vars['fields']): ?><?php echo $this->_tpl_vars['form']['_qf_BatchUpdateProfile_refresh']['html']; ?>
<?php endif; ?> &nbsp;<div class="crm-submit-buttons"><?php echo $this->_tpl_vars['form']['buttons']['html']; ?>
</div>

</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/common/batchCopy.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>