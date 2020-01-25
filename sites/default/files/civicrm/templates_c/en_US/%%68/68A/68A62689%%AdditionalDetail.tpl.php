<?php /* Smarty version 2.6.31, created on 2020-01-03 14:02:03
         compiled from CRM/Contribute/Form/AdditionalInfo/AdditionalDetail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Contribute/Form/AdditionalInfo/AdditionalDetail.tpl', 1, false),array('block', 'ts', 'CRM/Contribute/Form/AdditionalInfo/AdditionalDetail.tpl', 33, false),array('modifier', 'crmAddClass', 'CRM/Contribute/Form/AdditionalInfo/AdditionalDetail.tpl', 30, false),array('modifier', 'crmMoney', 'CRM/Contribute/Form/AdditionalInfo/AdditionalDetail.tpl', 32, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['isOnline']): ?><?php $this->assign('valueStyle', " class='view-value'"); ?><?php else: ?><?php $this->assign('valueStyle', ""); ?><?php endif; ?>
<div id="id-additionalDetail" class="section-shown">
    <table class="form-layout-compressed">
        <tr  class="crm-contribution-form-block-contribution_page"><td class="label"><?php echo $this->_tpl_vars['form']['contribution_page_id']['label']; ?>
</td><td<?php echo $this->_tpl_vars['valueStyle']; ?>
><?php echo ((is_array($_tmp=$this->_tpl_vars['form']['contribution_page_id']['html'])) ? $this->_run_mod_handler('crmAddClass', true, $_tmp, 'twenty') : smarty_modifier_crmAddClass($_tmp, 'twenty')); ?>
</td></tr>
        <tr class="crm-contribution-form-block-note"><td class="label" style="vertical-align:top;"><?php echo $this->_tpl_vars['form']['note']['label']; ?>
</td><td><?php echo $this->_tpl_vars['form']['note']['html']; ?>
</td></tr>
        <tr class="crm-contribution-form-block-non_deductible_amount"><td class="label"><?php echo $this->_tpl_vars['form']['non_deductible_amount']['label']; ?>
</td><td<?php echo $this->_tpl_vars['valueStyle']; ?>
><?php echo ((is_array($_tmp=$this->_tpl_vars['form']['non_deductible_amount']['html'])) ? $this->_run_mod_handler('crmMoney', true, $_tmp, $this->_tpl_vars['currency'], '', 1) : smarty_modifier_crmMoney($_tmp, $this->_tpl_vars['currency'], '', 1)); ?>
<br />
            <span class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Non-deductible portion of this contribution.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></td></tr>
        <tr class="crm-contribution-form-block-fee_amount"><td class="label"><?php echo $this->_tpl_vars['form']['fee_amount']['label']; ?>
</td><td<?php echo $this->_tpl_vars['valueStyle']; ?>
><?php echo ((is_array($_tmp=$this->_tpl_vars['form']['fee_amount']['html'])) ? $this->_run_mod_handler('crmMoney', true, $_tmp, $this->_tpl_vars['currency'], 'XXX', 'YYY') : smarty_modifier_crmMoney($_tmp, $this->_tpl_vars['currency'], 'XXX', 'YYY')); ?>
<br />
            <span class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Processing fee for this transaction (if applicable).<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></td></tr>
            <span class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Net value of the contribution (Total Amount minus Fee).<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></td></tr>
        <tr class="crm-contribution-form-block-invoice_id"><td class="label"><?php echo $this->_tpl_vars['form']['invoice_id']['label']; ?>
</td><td<?php echo $this->_tpl_vars['valueStyle']; ?>
><?php echo $this->_tpl_vars['form']['invoice_id']['html']; ?>
<br />
            <span class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Unique internal reference ID for this contribution.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></td></tr>
        <tr class="crm-contribution-form-block-creditnote_id"><td class="label"><?php echo $this->_tpl_vars['form']['creditnote_id']['label']; ?>
</td><td<?php echo $this->_tpl_vars['valueStyle']; ?>
><?php echo $this->_tpl_vars['form']['creditnote_id']['html']; ?>
<br />
            <span class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Unique internal Credit Note ID for this contribution.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></td></tr>
        <tr class="crm-contribution-form-block-thankyou_date"><td class="label"><?php echo $this->_tpl_vars['form']['thankyou_date']['label']; ?>
</td><td><?php echo $this->_tpl_vars['form']['thankyou_date']['html']; ?>
<br />
            <span class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Date that a thank-you message was sent to the contributor.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span></td></tr>
    </table>
</div>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>