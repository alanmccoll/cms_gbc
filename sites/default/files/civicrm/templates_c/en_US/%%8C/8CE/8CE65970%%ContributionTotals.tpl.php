<?php /* Smarty version 2.6.31, created on 2020-01-02 18:24:32
         compiled from CRM/Contribute/Page/ContributionTotals.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Contribute/Page/ContributionTotals.tpl', 1, false),array('block', 'ts', 'CRM/Contribute/Page/ContributionTotals.tpl', 32, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['annual']['count'] || $this->_tpl_vars['contributionSummary']['total']['count'] || $this->_tpl_vars['contributionSummary']['cancel']['count'] || $this->_tpl_vars['contributionSummary']['soft_credit']['count']): ?>
    <table class="form-layout-compressed">

    <?php if ($this->_tpl_vars['annual']['count']): ?>
        <tr>
            <th class="contriTotalLeft right"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Current Year-to-Date<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> &ndash; <?php echo $this->_tpl_vars['annual']['amount']; ?>
</th>
            <th class="right"> &nbsp; <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?># Completed Contributions<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> &ndash; <?php echo $this->_tpl_vars['annual']['count']; ?>
</th>
            <th class="right contriTotalRight"> &nbsp; <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Avg Amount<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> &ndash; <?php echo $this->_tpl_vars['annual']['avg']; ?>
</th>
            <?php if ($this->_tpl_vars['contributionSummary']['cancel']['amount']): ?>
                <td>&nbsp;</td>
            <?php endif; ?>
        </tr>
    <?php endif; ?>

    <?php if ($this->_tpl_vars['contributionSummary']): ?>
      <tr>
          <?php if ($this->_tpl_vars['contributionSummary']['total']['amount']): ?>
            <th class="contriTotalLeft right"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Total<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> &ndash; <?php echo $this->_tpl_vars['contributionSummary']['total']['amount']; ?>
</th>
            <th class="right"> &nbsp; <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?># Completed<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> &ndash; <?php echo $this->_tpl_vars['contributionSummary']['total']['count']; ?>
</th>
            <th class="right contriTotalRight"> &nbsp; <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Avg<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> &ndash; <?php echo $this->_tpl_vars['contributionSummary']['total']['avg']; ?>
</th>
          <?php endif; ?>
          <?php if ($this->_tpl_vars['contributionSummary']['cancel']['amount']): ?>
            <th class="disabled right contriTotalRight"> &nbsp; <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Cancelled/Refunded<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> &ndash; <?php echo $this->_tpl_vars['contributionSummary']['cancel']['amount']; ?>
</th>
          <?php endif; ?>
      </tr>
      <?php if ($this->_tpl_vars['contributionSummary']['soft_credit']['count']): ?>
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Contribute/Page/ContributionSoftTotals.tpl", 'smarty_include_vars' => array('softCreditTotals' => $this->_tpl_vars['contributionSummary']['soft_credit'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
      <?php endif; ?>
    <?php endif; ?>

    </table>
<?php endif; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>