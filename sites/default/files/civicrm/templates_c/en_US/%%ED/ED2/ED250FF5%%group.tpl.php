<?php /* Smarty version 2.6.31, created on 2020-01-09 13:33:11
         compiled from CRM/Contact/Form/Search/Criteria/Fields/group.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Contact/Form/Search/Criteria/Fields/group.tpl', 1, false),array('block', 'ts', 'CRM/Contact/Form/Search/Criteria/Fields/group.tpl', 2, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><div id='groupselect'>
  <label><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Group(s)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <span class="description">
      (<a href="#" id='searchbygrouptype'><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>search by group type<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>)
    </span>
  </label>
  <br/>
  <?php echo $this->_tpl_vars['form']['group']['html']; ?>

</div>
<div id='grouptypeselect'>
  <label>
    <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Group Type(s)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
    <span class="description">
      (<a href="#" id='searchbygroup'><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>search by group<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>)
    </span>
  </label>
  <br/>
  <?php echo $this->_tpl_vars['form']['group_type']['html']; ?>

  <?php echo '
    <script type="text/javascript">
      CRM.$(function ($) {
        function showGroupSearch() {
          $(\'#grouptypeselect\').hide();
          $(\'#groupselect\').show();
          $(\'#group_type\').select2(\'val\', \'\');
          return false;
        }

        function showGroupTypeSearch() {
          $(\'#groupselect\').hide();
          $(\'#grouptypeselect\').show();
          $(\'#group\').select2(\'val\', \'\');
          return false;
        }

        $(\'#searchbygrouptype\').click(showGroupTypeSearch);
        $(\'#searchbygroup\').click(showGroupSearch);

        if ($(\'#group_type\').val()) {
          showGroupTypeSearch();
        }
        else {
          showGroupSearch();
        }

      });
    </script>
  '; ?>

</div>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>