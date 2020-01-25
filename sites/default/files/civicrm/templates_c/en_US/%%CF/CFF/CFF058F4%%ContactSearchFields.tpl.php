<?php /* Smarty version 2.6.31, created on 2020-01-02 18:24:27
         compiled from CRM/Contact/Form/Search/ContactSearchFields.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Contact/Form/Search/ContactSearchFields.tpl', 1, false),array('modifier', 'crmAddClass', 'CRM/Contact/Form/Search/ContactSearchFields.tpl', 5, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><tr>
  <td class="font-size12pt">
    <?php echo $this->_tpl_vars['form']['sort_name']['label']; ?>

    <br>
    <?php echo ((is_array($_tmp=$this->_tpl_vars['form']['sort_name']['html'])) ? $this->_run_mod_handler('crmAddClass', true, $_tmp, 'twenty') : smarty_modifier_crmAddClass($_tmp, 'twenty')); ?>

  </td>
  <td><?php echo $this->_tpl_vars['form']['buttons']['html']; ?>
</td>
</tr>
<tr>
  <?php if ($this->_tpl_vars['form']['contact_tags']): ?>
    <td>
      <label><?php echo $this->_tpl_vars['form']['contact_tags']['label']; ?>
</label>
      <br>
      <?php echo $this->_tpl_vars['form']['contact_tags']['html']; ?>

    </td>
  <?php else: ?>
    <td>&nbsp;</td>
  <?php endif; ?>

  <?php if ($this->_tpl_vars['form']['group']): ?>
    <td>
      <label><?php echo $this->_tpl_vars['form']['group']['label']; ?>
</label>
      <br>
      <?php echo $this->_tpl_vars['form']['group']['html']; ?>

    </td>
  <?php else: ?>
    <td>&nbsp;</td>
  <?php endif; ?>
</tr>
<tr class="crm-event-search-form-block-deleted_contacts">
  <td>
    <?php echo $this->_tpl_vars['form']['contact_type']['label']; ?>

    <br>
    <?php echo $this->_tpl_vars['form']['contact_type']['html']; ?>

  </td>
  <td>
    <?php if ($this->_tpl_vars['form']['deleted_contacts']): ?>
      <?php echo $this->_tpl_vars['form']['deleted_contacts']['html']; ?>
&nbsp;&nbsp;<?php echo $this->_tpl_vars['form']['deleted_contacts']['label']; ?>

    <?php endif; ?>
  </td>
</tr>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>