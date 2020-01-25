<?php /* Smarty version 2.6.31, created on 2020-01-02 18:24:32
         compiled from CRM/Contribute/Form/Selector.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Contribute/Form/Selector.tpl', 1, false),array('block', 'ts', 'CRM/Contribute/Form/Selector.tpl', 64, false),array('function', 'counter', 'CRM/Contribute/Form/Selector.tpl', 52, false),array('function', 'cycle', 'CRM/Contribute/Form/Selector.tpl', 54, false),array('function', 'crmURL', 'CRM/Contribute/Form/Selector.tpl', 61, false),array('function', 'crmScript', 'CRM/Contribute/Form/Selector.tpl', 109, false),array('modifier', 'crmMoney', 'CRM/Contribute/Form/Selector.tpl', 65, false),array('modifier', 'crmDate', 'CRM/Contribute/Form/Selector.tpl', 79, false),array('modifier', 'replace', 'CRM/Contribute/Form/Selector.tpl', 100, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/common/pager.tpl", 'smarty_include_vars' => array('location' => 'top')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo '<div class="crm-contact-contribute-contributions"><table class="selector row-highlight"><thead class="sticky"><tr>'; ?><?php if (! $this->_tpl_vars['single'] && $this->_tpl_vars['context'] == 'Search'): ?><?php echo '<th scope="col" title="Select Rows">'; ?><?php echo $this->_tpl_vars['form']['toggleSelect']['html']; ?><?php echo '</th>'; ?><?php endif; ?><?php echo ''; ?><?php if (! $this->_tpl_vars['single']): ?><?php echo '<th scope="col"></th>'; ?><?php endif; ?><?php echo ''; ?><?php $_from = $this->_tpl_vars['columnHeaders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['header']):
?><?php echo '<th scope="col">'; ?><?php if ($this->_tpl_vars['header']['sort']): ?><?php echo ''; ?><?php $this->assign('key', $this->_tpl_vars['header']['sort']); ?><?php echo ''; ?><?php echo $this->_tpl_vars['sort']->_response[$this->_tpl_vars['key']]['link']; ?><?php echo ''; ?><?php else: ?><?php echo ''; ?><?php echo $this->_tpl_vars['header']['name']; ?><?php echo ''; ?><?php endif; ?><?php echo '</th>'; ?><?php endforeach; endif; unset($_from); ?><?php echo '</tr></thead>'; ?><?php echo smarty_function_counter(array('start' => 0,'skip' => 1,'print' => false), $this);?><?php echo ''; ?><?php $_from = $this->_tpl_vars['rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?><?php echo '<tr id="rowid'; ?><?php echo $this->_tpl_vars['row']['contribution_id']; ?><?php echo '" class="'; ?><?php echo smarty_function_cycle(array('values' => "odd-row,even-row"), $this);?><?php echo ' '; ?><?php if ($this->_tpl_vars['row']['contribution_cancel_date']): ?><?php echo ' cancelled'; ?><?php endif; ?><?php echo ' crm-contribution_'; ?><?php echo $this->_tpl_vars['row']['contribution_id']; ?><?php echo '">'; ?><?php if (! $this->_tpl_vars['single']): ?><?php echo ''; ?><?php if ($this->_tpl_vars['context'] == 'Search'): ?><?php echo ''; ?><?php $this->assign('cbName', $this->_tpl_vars['row']['checkbox']); ?><?php echo '<td>'; ?><?php echo $this->_tpl_vars['form'][$this->_tpl_vars['cbName']]['html']; ?><?php echo '</td>'; ?><?php endif; ?><?php echo '<td>'; ?><?php echo $this->_tpl_vars['row']['contact_type']; ?><?php echo '</td><td><a href="'; ?><?php echo CRM_Utils_System::crmURL(array('p' => 'civicrm/contact/view','q' => "reset=1&cid=".($this->_tpl_vars['row']['contact_id'])), $this);?><?php echo '">'; ?><?php echo $this->_tpl_vars['row']['sort_name']; ?><?php echo '</a></td>'; ?><?php endif; ?><?php echo '<td class="crm-contribution-amount"><a class="nowrap bold crm-expand-row" title="'; ?><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo 'view payments'; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '" href="'; ?><?php echo CRM_Utils_System::crmURL(array('p' => 'civicrm/payment','q' => "view=transaction&component=contribution&action=browse&cid=".($this->_tpl_vars['row']['contact_id'])."&id=".($this->_tpl_vars['row']['contribution_id'])."&selector=1"), $this);?><?php echo '">&nbsp; '; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['row']['total_amount'])) ? $this->_run_mod_handler('crmMoney', true, $_tmp, $this->_tpl_vars['row']['currency']) : smarty_modifier_crmMoney($_tmp, $this->_tpl_vars['row']['currency'])); ?><?php echo '</a>'; ?><?php if ($this->_tpl_vars['row']['amount_level']): ?><?php echo '<br/>('; ?><?php echo $this->_tpl_vars['row']['amount_level']; ?><?php echo ')'; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['row']['contribution_recur_id']): ?><?php echo '<br/>'; ?><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo '(Recurring)'; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo ''; ?><?php endif; ?><?php echo '</td>'; ?><?php $_from = $this->_tpl_vars['columnHeaders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['column']):
?><?php echo ''; ?><?php $this->assign('columnName', $this->_tpl_vars['column']['field_name']); ?><?php echo ''; ?><?php if (! $this->_tpl_vars['columnName']): ?><?php echo ''; ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['columnName'] === 'total_amount'): ?><?php echo ''; ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['column']['type'] === 'actions'): ?><?php echo ''; ?><?php echo ''; ?><?php elseif ($this->_tpl_vars['columnName'] == 'contribution_status'): ?><?php echo '<td class="crm-contribution-status">'; ?><?php echo $this->_tpl_vars['row']['contribution_status']; ?><?php echo '<br/>'; ?><?php if ($this->_tpl_vars['row']['contribution_cancel_date']): ?><?php echo ''; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['row']['contribution_cancel_date'])) ? $this->_run_mod_handler('crmDate', true, $_tmp) : smarty_modifier_crmDate($_tmp)); ?><?php echo ''; ?><?php endif; ?><?php echo '</td>'; ?><?php else: ?><?php echo ''; ?><?php if ($this->_tpl_vars['column']['type'] == 'date'): ?><?php echo '<td class="crm-contribution-'; ?><?php echo $this->_tpl_vars['columnName']; ?><?php echo '">'; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['row'][$this->_tpl_vars['columnName']])) ? $this->_run_mod_handler('crmDate', true, $_tmp) : smarty_modifier_crmDate($_tmp)); ?><?php echo '</td>'; ?><?php else: ?><?php echo '<td class="crm-'; ?><?php echo $this->_tpl_vars['columnName']; ?><?php echo ' crm-'; ?><?php echo $this->_tpl_vars['columnName']; ?><?php echo '_'; ?><?php echo $this->_tpl_vars['row']['columnName']; ?><?php echo '">'; ?><?php echo $this->_tpl_vars['row'][$this->_tpl_vars['columnName']]; ?><?php echo '</td>'; ?><?php endif; ?><?php echo ''; ?><?php endif; ?><?php echo ''; ?><?php endforeach; endif; unset($_from); ?><?php echo ''; ?><?php if ($this->_tpl_vars['softCreditColumns']): ?><?php echo '<td class="crm-contribution-soft_credit_name"><a href="'; ?><?php echo CRM_Utils_System::crmURL(array('p' => 'civicrm/contact/view','q' => "reset=1&cid=".($this->_tpl_vars['row']['contribution_soft_credit_contact_id'])), $this);?><?php echo '">'; ?><?php echo $this->_tpl_vars['row']['contribution_soft_credit_name']; ?><?php echo '</a></td><td class="crm-contribution-soft_credit_type">'; ?><?php echo $this->_tpl_vars['row']['contribution_soft_credit_type']; ?><?php echo '</td>'; ?><?php endif; ?><?php echo '<td>'; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['row']['action'])) ? $this->_run_mod_handler('replace', true, $_tmp, 'xx', $this->_tpl_vars['row']['contribution_id']) : smarty_modifier_replace($_tmp, 'xx', $this->_tpl_vars['row']['contribution_id'])); ?><?php echo '</td></tr>'; ?><?php endforeach; endif; unset($_from); ?><?php echo '</table></div>'; ?>


<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/common/pager.tpl", 'smarty_include_vars' => array('location' => 'bottom')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo smarty_function_crmScript(array('file' => 'js/crm.expandRow.js'), $this);?>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>