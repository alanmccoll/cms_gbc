<?php /* Smarty version 2.6.31, created on 2020-01-02 18:11:57
         compiled from CRM/Admin/Page/Extensions/Main.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Admin/Page/Extensions/Main.tpl', 1, false),array('block', 'ts', 'CRM/Admin/Page/Extensions/Main.tpl', 13, false),array('function', 'crmURL', 'CRM/Admin/Page/Extensions/Main.tpl', 26, false),array('modifier', 'capitalize', 'CRM/Admin/Page/Extensions/Main.tpl', 32, false),array('modifier', 'replace', 'CRM/Admin/Page/Extensions/Main.tpl', 33, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['localExtensionRows']): ?>
  <div id="extensions">
    <?php echo ''; ?><?php echo '<table id="extensions" class="display"><thead><tr><th>'; ?><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo 'Extension name (key)'; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '</th><th>'; ?><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo 'Status'; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '</th><th>'; ?><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo 'Version'; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '</th><th>'; ?><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo 'Type'; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '</th><th></th></tr></thead><tbody>'; ?><?php $_from = $this->_tpl_vars['localExtensionRows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['extKey'] => $this->_tpl_vars['row']):
?><?php echo '<tr id="extension-'; ?><?php echo $this->_tpl_vars['row']['file']; ?><?php echo '" class="crm-entity crm-extension-'; ?><?php echo $this->_tpl_vars['row']['file']; ?><?php echo ''; ?><?php if ($this->_tpl_vars['row']['status'] == 'disabled'): ?><?php echo ' disabled'; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['row']['status'] == 'installed-missing' || $this->_tpl_vars['row']['status'] == 'disabled-missing'): ?><?php echo ' extension-missing'; ?><?php endif; ?><?php echo ''; ?><?php if ($this->_tpl_vars['row']['upgradable']): ?><?php echo ' extension-upgradable'; ?><?php elseif ($this->_tpl_vars['row']['status'] == 'installed'): ?><?php echo ' extension-installed'; ?><?php endif; ?><?php echo '"><td class="crm-extensions-label"><a class="collapsed" href="#"></a>&nbsp;<strong>'; ?><?php echo $this->_tpl_vars['row']['label']; ?><?php echo '</strong><br/>('; ?><?php echo $this->_tpl_vars['row']['key']; ?><?php echo ')'; ?><?php if ($this->_tpl_vars['extAddNewEnabled'] && $this->_tpl_vars['remoteExtensionRows'][$this->_tpl_vars['extKey']] && $this->_tpl_vars['remoteExtensionRows'][$this->_tpl_vars['extKey']]['is_upgradeable']): ?><?php echo ''; ?><?php ob_start(); ?><?php echo ''; ?><?php echo CRM_Utils_System::crmURL(array('p' => 'civicrm/admin/extensions','q' => "action=update&id=".($this->_tpl_vars['extKey'])."&key=".($this->_tpl_vars['extKey'])), $this);?><?php echo ''; ?><?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('upgradeURL', ob_get_contents());ob_end_clean(); ?><?php echo '<div class="crm-extensions-upgrade">'; ?><?php $this->_tag_stack[] = array('ts', array('1' => $this->_tpl_vars['upgradeURL'])); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo 'Version '; ?><?php echo $this->_tpl_vars['remoteExtensionRows'][$this->_tpl_vars['extKey']]['version']; ?><?php echo ' is available. <a href="%1">Upgrade</a>'; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '</div>'; ?><?php endif; ?><?php echo '</td><td class="crm-extensions-label">'; ?><?php echo $this->_tpl_vars['row']['statusLabel']; ?><?php echo ' '; ?><?php if ($this->_tpl_vars['row']['upgradable']): ?><?php echo '<br/>('; ?><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo 'Outdated'; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo ')'; ?><?php endif; ?><?php echo '</td><td class="crm-extensions-label">'; ?><?php echo $this->_tpl_vars['row']['version']; ?><?php echo ' '; ?><?php if ($this->_tpl_vars['row']['upgradable']): ?><?php echo '<br/>('; ?><?php echo $this->_tpl_vars['row']['upgradeVersion']; ?><?php echo ')'; ?><?php endif; ?><?php echo '</td><td class="crm-extensions-description">'; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['row']['type'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?><?php echo '</td><td>'; ?><?php echo ((is_array($_tmp=$this->_tpl_vars['row']['action'])) ? $this->_run_mod_handler('replace', true, $_tmp, 'xx', $this->_tpl_vars['row']['id']) : smarty_modifier_replace($_tmp, 'xx', $this->_tpl_vars['row']['id'])); ?><?php echo '</td></tr><tr class="hiddenElement" id="crm-extensions-details-'; ?><?php echo $this->_tpl_vars['row']['file']; ?><?php echo '"><td>'; ?><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Admin/Page/ExtensionDetails.tpl", 'smarty_include_vars' => array('extension' => $this->_tpl_vars['row'],'localExtensionRows' => $this->_tpl_vars['localExtensionRows'],'remoteExtensionRows' => $this->_tpl_vars['remoteExtensionRows'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?><?php echo '</td><td></td><td></td><td></td><td></td></tr>'; ?><?php endforeach; endif; unset($_from); ?><?php echo '</tbody></table>'; ?>

  </div>
<?php else: ?>
  <div class="messages status no-popup">
       <div class="icon inform-icon"></div>
      <?php $this->_tag_stack[] = array('ts', array('1' => "https://civicrm.org/extensions")); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>There are no extensions to display. Click the "Add New" tab to browse and install extensions posted on the <a href="%1">public CiviCRM Extensions Directory</a>. If you have downloaded extensions manually and don't see them here, try clicking the "Refresh" button.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  </div>
<?php endif; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>