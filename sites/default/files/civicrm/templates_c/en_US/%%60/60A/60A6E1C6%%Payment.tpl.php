<?php /* Smarty version 2.6.31, created on 2020-01-03 13:34:11
         compiled from CRM/Contribute/Form/AdditionalInfo/Payment.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Contribute/Form/AdditionalInfo/Payment.tpl', 1, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
<?php if ($this->_tpl_vars['buildRecurBlock']): ?>
<?php echo '
  <script type="text/javascript" >

    function enablePeriod( )
    {
      var frUnit = cj( \'#frequency_unit\' );
      var frInerval = cj( \'#frequency_interval\' );
      var installments = cj( \'#installments\' );
      isDisabled = false;

      if ( cj( \'input:radio[name="is_recur"]:checked\').val() == 0 )  {
        isDisabled = true;
        frInerval.val( \'\' );
        installments.val( \'\' );
      }

      frUnit.prop( \'disabled\', isDisabled );
      frInerval.prop( \'disabled\', isDisabled );
      installments.prop( \'disabled\', isDisabled );
    }

    function buildRecurBlock( processorId ) {
      if ( !processorId ) processorId = cj( "#payment_processor_id" ).val( );
      var recurPaymentProIds = '; ?>
'<?php echo $this->_tpl_vars['recurringPaymentProcessorIds']; ?>
'<?php echo ';
      var funName = ( cj.inArray(processorId, recurPaymentProIds.split(\',\')) > -1 ) ? \'show\' : \'hide\';

      var priceSet = cj("#price_set_id");
      if ( priceSet && priceSet.val( ) ) {
        funName = \'hide\';
        //reset the values of recur block.
        if ( cj( \'input:radio[name="is_recur"]:checked\').val() ) {
          cj("#installments").val(\'\');
          cj("#frequency_interval").val(\'\');
          cj( \'input:radio[name="is_recur"]\')[0].checked = true;
        }
      }


      enablePeriod( );
      eval( \'cj( "#recurringPaymentBlock" ).\' + funName + "( )" );
    }

    CRM.$(function($) {
      buildRecurBlock( null );
      enablePeriod( );
    });

  </script>
'; ?>

<?php endif; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>