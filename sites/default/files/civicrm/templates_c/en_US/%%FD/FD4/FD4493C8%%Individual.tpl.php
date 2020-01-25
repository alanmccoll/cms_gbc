<?php /* Smarty version 2.6.31, created on 2020-01-06 16:35:47
         compiled from CRM/Contact/Form/Edit/Individual.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Contact/Form/Edit/Individual.tpl', 1, false),array('function', 'help', 'CRM/Contact/Form/Edit/Individual.tpl', 79, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><script type="text/javascript">
<?php echo '
CRM.$(function($) {
  if ($(\'#contact_sub_type *\').length == 0) {//if they aren\'t any subtype we don\'t offer the option
    $(\'#contact_sub_type\').parent().hide();
  }
});
</script>
'; ?>


<table class="form-layout-compressed">
  <tr>
    <?php if ($this->_tpl_vars['form']['prefix_id']): ?>
    <td>
      <?php echo $this->_tpl_vars['form']['prefix_id']['label']; ?>
<br/>
      <?php echo $this->_tpl_vars['form']['prefix_id']['html']; ?>

    </td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['form']['formal_title']): ?>
    <td>
      <?php echo $this->_tpl_vars['form']['formal_title']['label']; ?>
<br/>
      <?php echo $this->_tpl_vars['form']['formal_title']['html']; ?>

    </td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['form']['first_name']): ?>
    <td>
      <?php echo $this->_tpl_vars['form']['first_name']['label']; ?>
<br />
      <?php echo $this->_tpl_vars['form']['first_name']['html']; ?>

    </td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['form']['middle_name']): ?>
    <td>
      <?php echo $this->_tpl_vars['form']['middle_name']['label']; ?>
<br />
      <?php echo $this->_tpl_vars['form']['middle_name']['html']; ?>

    </td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['form']['last_name']): ?>
    <td>
      <?php echo $this->_tpl_vars['form']['last_name']['label']; ?>
<br />
      <?php echo $this->_tpl_vars['form']['last_name']['html']; ?>

    </td>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['form']['suffix_id']): ?>
    <td>
      <?php echo $this->_tpl_vars['form']['suffix_id']['label']; ?>
<br/>
      <?php echo $this->_tpl_vars['form']['suffix_id']['html']; ?>

    </td>
    <?php endif; ?>
  </tr>

  <tr>
    <td colspan="2">
      <?php echo $this->_tpl_vars['form']['employer_id']['label']; ?>
&nbsp;<?php echo smarty_function_help(array('id' => "id-current-employer",'file' => "CRM/Contact/Form/Contact.hlp"), $this);?>
<br />
      <?php echo $this->_tpl_vars['form']['employer_id']['html']; ?>

    </td>
    <td>
      <?php echo $this->_tpl_vars['form']['job_title']['label']; ?>
<br />
      <?php echo $this->_tpl_vars['form']['job_title']['html']; ?>

    </td>
    <td>
      <?php echo $this->_tpl_vars['form']['nick_name']['label']; ?>
<br />
      <?php echo $this->_tpl_vars['form']['nick_name']['html']; ?>

    </td>
    <td>
      <?php echo $this->_tpl_vars['form']['contact_sub_type']['label']; ?>
<br />
      <?php echo $this->_tpl_vars['form']['contact_sub_type']['html']; ?>

    </td>
  </tr>
</table>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>