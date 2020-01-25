<?php /* Smarty version 2.6.31, created on 2020-01-09 13:33:11
         compiled from CRM/Contact/Form/Search/Criteria/Fields/privacy_toggle.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Contact/Form/Search/Criteria/Fields/privacy_toggle.tpl', 1, false),array('function', 'help', 'CRM/Contact/Form/Search/Criteria/Fields/privacy_toggle.tpl', 4, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><table class="form-layout-compressed">
  <tr>
    <td colspan="2">
      <?php echo $this->_tpl_vars['form']['privacy_toggle']['html']; ?>
 <?php echo smarty_function_help(array('id' => "id-privacy"), $this);?>

    </td>
  </tr>
  <tr>
    <td>
      <?php echo $this->_tpl_vars['form']['privacy_options']['html']; ?>

    </td>
    <td style="vertical-align:middle">
      <div id="privacy-operator-wrapper">
        <?php echo $this->_tpl_vars['form']['privacy_operator']['html']; ?>
 <?php echo smarty_function_help(array('id' => "privacy-operator"), $this);?>

      </div>
    </td>
  </tr>
</table>
<?php echo '
  <script type="text/javascript">
    cj("select#privacy_options").change(function () {
      if (cj(this).val() && cj(this).val().length > 1) {
        cj(\'#privacy-operator-wrapper\').show();
      } else {
        cj(\'#privacy-operator-wrapper\').hide();
      }
    }).change();
  </script>
'; ?>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>