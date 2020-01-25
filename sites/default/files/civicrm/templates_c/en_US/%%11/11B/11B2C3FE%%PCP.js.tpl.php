<?php /* Smarty version 2.6.31, created on 2020-01-02 18:24:27
         compiled from CRM/Contribute/Form/PCP.js.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Contribute/Form/PCP.js.tpl', 1, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php echo '
<script type="text/javascript">
  CRM.$(function($) {
    var $form = $("form.'; ?>
<?php echo $this->_tpl_vars['form']['formClass']; ?>
<?php echo '");

    // FIXME: This could be much simpler as an entityRef field but pcp doesn\'t have a searchable api :(
    var pcpURL = CRM.url(\'civicrm/ajax/rest\', \'className=CRM_Contact_Page_AJAX&fnName=getPCPList&json=1&context=contact&reset=1\');
    $(\'input[name=pcp_made_through_id]\', $form).crmSelect2({
      minimumInputLength: 1,
      ajax: {
        url: pcpURL,
        data: function(term, page) {
          return {term: term, page_num: page};
        },
        results: function(response) {
          return response;
        }
      },
      initSelection: function(el, callback) {
        callback({id: $(el).val(), text: $(\'[name=pcp_made_through]\', $form).val()});
      }
    })
      // This is just a cheap trick to store the name when the form reloads
      .on(\'change\', function() {
        var fieldNameVal = $(this).select2(\'data\');
        if (!fieldNameVal) {
          fieldNameVal = \'\';
        }
        $(\'[name=pcp_made_through]\', $form).val(fieldNameVal.text);
      });
  });
</script>
'; ?>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>