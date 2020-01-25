<?php /* Smarty version 2.6.31, created on 2020-01-03 13:34:11
         compiled from CRM/Contribute/Form/SoftCredit.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Contribute/Form/SoftCredit.tpl', 1, false),array('block', 'ts', 'CRM/Contribute/Form/SoftCredit.tpl', 47, false),array('modifier', 'crmAddClass', 'CRM/Contribute/Form/SoftCredit.tpl', 33, false),array('modifier', 'json_encode', 'CRM/Contribute/Form/SoftCredit.tpl', 95, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><table class="form-layout-compressed crm-soft-credit-block">
  <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['start'] = (int)1;
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['rowCount']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
if ($this->_sections['i']['start'] < 0)
    $this->_sections['i']['start'] = max($this->_sections['i']['step'] > 0 ? 0 : -1, $this->_sections['i']['loop'] + $this->_sections['i']['start']);
else
    $this->_sections['i']['start'] = min($this->_sections['i']['start'], $this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] : $this->_sections['i']['loop']-1);
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = min(ceil(($this->_sections['i']['step'] > 0 ? $this->_sections['i']['loop'] - $this->_sections['i']['start'] : $this->_sections['i']['start']+1)/abs($this->_sections['i']['step'])), $this->_sections['i']['max']);
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
    <?php $this->assign('rowNumber', $this->_sections['i']['index']); ?>
    <tr id="soft-credit-row-<?php echo $this->_tpl_vars['rowNumber']; ?>
"
        class="crm-contribution-form-block-soft_credit_to <?php if ($this->_tpl_vars['rowNumber'] >= $this->_tpl_vars['showSoftCreditRow']): ?>hiddenElement<?php endif; ?>">
      <td>
        <?php echo $this->_tpl_vars['form']['soft_credit_contact_id'][$this->_tpl_vars['rowNumber']]['label']; ?>
<br><?php echo ((is_array($_tmp=$this->_tpl_vars['form']['soft_credit_contact_id'][$this->_tpl_vars['rowNumber']]['html'])) ? $this->_run_mod_handler('crmAddClass', true, $_tmp, 'twenty') : smarty_modifier_crmAddClass($_tmp, 'twenty')); ?>

      </td>
      <td>
        <?php echo $this->_tpl_vars['form']['soft_credit_amount'][$this->_tpl_vars['rowNumber']]['label']; ?>
<br><?php echo ((is_array($_tmp=$this->_tpl_vars['form']['soft_credit_amount'][$this->_tpl_vars['rowNumber']]['html'])) ? $this->_run_mod_handler('crmAddClass', true, $_tmp, 'eight') : smarty_modifier_crmAddClass($_tmp, 'eight')); ?>

      </td>
      <td>
        <?php echo $this->_tpl_vars['form']['soft_credit_type'][$this->_tpl_vars['rowNumber']]['label']; ?>
<br>
        <?php echo $this->_tpl_vars['form']['soft_credit_type'][$this->_tpl_vars['rowNumber']]['html']; ?>

        &nbsp;<a class="crm-hover-button soft-credit-delete-link" href="#"><span class="icon delete-icon"></span></a>
      </td>
    </tr>
  <?php endfor; endif; ?>
  <tr>
    <td>
      <a href="#" class="crm-hover-button" id="addMoreSoftCredit"><i class="crm-i fa-plus-circle"></i> <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>another soft credit<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
    </td>
  </tr>
</table>

<?php echo '
<script type="text/javascript">
  CRM.$(function($) {
    var $form = $("form.'; ?>
<?php echo $this->_tpl_vars['form']['formClass']; ?>
<?php echo '");
    $(\'#showPCP, #showSoftCredit\').click(function(){
      return showHideSoftCreditAndPCP();
    });

    function showHideSoftCreditAndPCP() {
      $(\'.crm-contribution-pcp-block\').toggle();
      $(\'.crm-contribution-pcp-block-link\').toggle();
      $(\'.crm-contribution-form-block-soft_credit_to\').toggle();
      return false;
    }

    $(\'#addMoreSoftCredit\').on(\'click\', function () {
      if ($(\'tr.crm-contribution-form-block-soft_credit_to\').hasClass("hiddenElement")) {
        $(\'.crm-contribution-form-block-soft_credit_to tr.hiddenElement\').filter(\':first\').show().removeClass(\'hiddenElement\');
      }
      if ($(\'.crm-soft-credit-block tr.hiddenElement\').length < 1) {
        $(\'#addMoreSoftCredit\').hide();
      }
      return false;
    });

    $(\'.crm-soft-credit-block tr span\').each(function () {
      if ($(this).hasClass(\'crm-error\')) {
        $(this).parents(\'tr\').show();
      }
    });

    $(\'.soft-credit-delete-link\').click(function(){
      $(this).closest(\'tr\').find(\'input\').val(\'\');
      $(this).closest(\'tr\').addClass(\'hiddenElement\').removeAttr(\'style\');
      $(\'#addMoreSoftCredit\').show();
      return false;
    });

    $(\'input[name^="soft_credit_contact_"]\').on(\'change\', function(){
      var rowNum = $(this).prop(\'id\').replace(\'soft_credit_contact_id_\',\'\');
      var totalAmount = $(\'#total_amount\').val();
      //assign total amount as default soft credit amount
      $(\'#soft_credit_amount_\'+ rowNum).val(totalAmount);
      var thousandMarker = '; ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['config']->monetaryThousandSeparator)) ? $this->_run_mod_handler('json_encode', true, $_tmp) : json_encode($_tmp)); ?>
<?php echo ';
      $(\'#soft_credit_type_\'+ rowNum).select2(\'val\', $(\'#sct_default_id\').val());
      totalAmount = Number(totalAmount.replace(thousandMarker,\'\'));
      if (rowNum > 1) {
        var scAmount = Number($(\'#soft_credit_amount_\'+ (rowNum - 1)).val().replace(thousandMarker,\'\'));
        if (scAmount < totalAmount) {
          //if user enters less than the total amount and adds another soft credit row,
          //the soft credit amount default will be left empty
          $(\'#soft_credit_amount_\'+ rowNum).val(\'\');
        }
      }
    });

  });
</script>
'; ?>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>