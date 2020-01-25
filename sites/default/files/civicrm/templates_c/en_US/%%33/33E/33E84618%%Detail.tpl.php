<?php /* Smarty version 2.6.31, created on 2020-01-07 12:24:28
         compiled from CRM/Report/Form/Contact/Detail.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Report/Form/Contact/Detail.tpl', 1, false),array('modifier', 'count', 'CRM/Report/Form/Contact/Detail.tpl', 45, false),array('modifier', 'cat', 'CRM/Report/Form/Contact/Detail.tpl', 96, false),array('modifier', 'escape', 'CRM/Report/Form/Contact/Detail.tpl', 99, false),array('modifier', 'crmDate', 'CRM/Report/Form/Contact/Detail.tpl', 105, false),array('modifier', 'truncate', 'CRM/Report/Form/Contact/Detail.tpl', 109, false),array('modifier', 'crmMoney', 'CRM/Report/Form/Contact/Detail.tpl', 112, false),array('modifier', 'replace', 'CRM/Report/Form/Contact/Detail.tpl', 129, false),array('modifier', 'upper', 'CRM/Report/Form/Contact/Detail.tpl', 129, false),array('function', 'counter', 'CRM/Report/Form/Contact/Detail.tpl', 49, false),array('function', 'eval', 'CRM/Report/Form/Contact/Detail.tpl', 75, false),array('function', 'cycle', 'CRM/Report/Form/Contact/Detail.tpl', 139, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>    <?php if (! $this->_tpl_vars['section']): ?>
    <div class="crm-block crm-form-block crm-report-field-form-block">
        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Report/Form/Fields.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>
    <?php endif; ?>

<div class="crm-block crm-content-block crm-report-form-block">
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Report/Form/Actions.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php if (! $this->_tpl_vars['section']): ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Report/Form/Statistics.tpl", 'smarty_include_vars' => array('top' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>
    <?php if ($this->_tpl_vars['rows']): ?>
        <div class="report-pager">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/common/pager.tpl", 'smarty_include_vars' => array('location' => 'top')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        </div>

                <?php ob_start(); ?>
            <?php $this->assign('columnCount', count($this->_tpl_vars['columnHeaders'])); ?>
            <?php $this->assign('l', '{'); ?>
            <?php $this->assign('r', '}'); ?>
            <?php $_from = $this->_tpl_vars['sections']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['sections'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['sections']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['column'] => $this->_tpl_vars['section']):
        $this->_foreach['sections']['iteration']++;
?>
                <?php echo smarty_function_counter(array('assign' => 'h'), $this);?>

                <?php echo $this->_tpl_vars['l']; ?>
isValueChange value=$row.<?php echo $this->_tpl_vars['column']; ?>
 key="<?php echo $this->_tpl_vars['column']; ?>
" assign=isValueChanged<?php echo $this->_tpl_vars['r']; ?>

                <?php echo $this->_tpl_vars['l']; ?>
if $isValueChanged<?php echo $this->_tpl_vars['r']; ?>


                    <?php echo $this->_tpl_vars['l']; ?>
if $sections.<?php echo $this->_tpl_vars['column']; ?>
.type & 4<?php echo $this->_tpl_vars['r']; ?>

                        <?php echo $this->_tpl_vars['l']; ?>
assign var=printValue value=$row.<?php echo $this->_tpl_vars['column']; ?>
|crmDate<?php echo $this->_tpl_vars['r']; ?>

                    <?php echo $this->_tpl_vars['l']; ?>
elseif $sections.<?php echo $this->_tpl_vars['column']; ?>
.type eq 1024<?php echo $this->_tpl_vars['r']; ?>

                        <?php echo $this->_tpl_vars['l']; ?>
assign var=printValue value=$row.<?php echo $this->_tpl_vars['column']; ?>
|crmMoney<?php echo $this->_tpl_vars['r']; ?>

                    <?php echo $this->_tpl_vars['l']; ?>
else<?php echo $this->_tpl_vars['r']; ?>

                        <?php echo $this->_tpl_vars['l']; ?>
assign var=printValue value=$row.<?php echo $this->_tpl_vars['column']; ?>
<?php echo $this->_tpl_vars['r']; ?>

                    <?php echo $this->_tpl_vars['l']; ?>
/if<?php echo $this->_tpl_vars['r']; ?>


                    <tr><th colspan="<?php echo $this->_tpl_vars['columnCount']; ?>
">
                        <h<?php echo $this->_tpl_vars['h']; ?>
><?php echo $this->_tpl_vars['section']['title']; ?>
: <?php echo $this->_tpl_vars['l']; ?>
$printValue|default:"<em>none</em>"<?php echo $this->_tpl_vars['r']; ?>

                            (<?php echo $this->_tpl_vars['l']; ?>
sectionTotal key=$row.<?php echo $this->_tpl_vars['column']; ?>
 depth=<?php echo ($this->_foreach['sections']['iteration']-1); ?>
<?php echo $this->_tpl_vars['r']; ?>
)
                        </h<?php echo $this->_tpl_vars['h']; ?>
>
                    </th></tr>
                    <?php if (($this->_foreach['sections']['iteration'] == $this->_foreach['sections']['total'])): ?>
                        <tr><?php echo $this->_tpl_vars['l']; ?>
$tableHeader<?php echo $this->_tpl_vars['r']; ?>
</tr>
                    <?php endif; ?>
                <?php echo $this->_tpl_vars['l']; ?>
/if<?php echo $this->_tpl_vars['r']; ?>

            <?php endforeach; endif; unset($_from); ?>
        <?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('sectionHeaderTemplate', ob_get_contents());ob_end_clean(); ?>

        <?php $_from = $this->_tpl_vars['rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
                  <table class="report-layout crm-report_contact_civireport">
                        <?php echo smarty_function_eval(array('var' => $this->_tpl_vars['sectionHeaderTemplate']), $this);?>

                            <tr>
                                <?php $_from = $this->_tpl_vars['columnHeaders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['header']):
?>
                                    <?php if (! $this->_tpl_vars['skip']): ?>
                                        <?php if ($this->_tpl_vars['header']['colspan']): ?>
                                            <th colspan=<?php echo $this->_tpl_vars['header']['colspan']; ?>
><?php echo $this->_tpl_vars['header']['title']; ?>
</th>
                                            <?php $this->assign('skip', true); ?>
                                            <?php $this->assign('skipCount', ($this->_tpl_vars['header']['colspan'])); ?>
                                            <?php $this->assign('skipMade', 1); ?>
                                        <?php else: ?>
                                            <th><?php echo $this->_tpl_vars['header']['title']; ?>
</th>
                                            <?php $this->assign('skip', false); ?>
                                        <?php endif; ?>
                                    <?php else: ?>                                         <?php $this->assign('skipMade', ($this->_tpl_vars['skipMade']+1)); ?>
                                        <?php if ($this->_tpl_vars['skipMade'] >= $this->_tpl_vars['skipCount']): ?><?php $this->assign('skip', false); ?><?php endif; ?>
                                    <?php endif; ?>
                                <?php endforeach; endif; unset($_from); ?>
                            </tr>
                            <tr class="group-row crm-report">
                                <?php $_from = $this->_tpl_vars['columnHeaders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['header']):
?>
                                    <?php $this->assign('fieldLink', ((is_array($_tmp=$this->_tpl_vars['field'])) ? $this->_run_mod_handler('cat', true, $_tmp, '_link') : smarty_modifier_cat($_tmp, '_link'))); ?>
                                    <?php $this->assign('fieldHover', ((is_array($_tmp=$this->_tpl_vars['field'])) ? $this->_run_mod_handler('cat', true, $_tmp, '_hover') : smarty_modifier_cat($_tmp, '_hover'))); ?>
                                    <td  class="report-contents crm-report_<?php echo $this->_tpl_vars['field']; ?>
">
                                        <?php if ($this->_tpl_vars['row'][$this->_tpl_vars['fieldLink']]): ?><a title="<?php echo ((is_array($_tmp=$this->_tpl_vars['row'][$this->_tpl_vars['fieldHover']])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" href="<?php echo $this->_tpl_vars['row'][$this->_tpl_vars['fieldLink']]; ?>
"><?php endif; ?>

                                        <?php if ($this->_tpl_vars['row'][$this->_tpl_vars['field']] == 'Subtotal'): ?>
                                            <?php echo $this->_tpl_vars['row'][$this->_tpl_vars['field']]; ?>

                                        <?php elseif ($this->_tpl_vars['header']['type'] == 12 || $this->_tpl_vars['header']['type'] == 4): ?>
                                            <?php if ($this->_tpl_vars['header']['group_by'] == 'MONTH' || $this->_tpl_vars['header']['group_by'] == 'QUARTER'): ?>
                                                <?php echo ((is_array($_tmp=$this->_tpl_vars['row'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('crmDate', true, $_tmp, $this->_tpl_vars['config']->dateformatPartial) : smarty_modifier_crmDate($_tmp, $this->_tpl_vars['config']->dateformatPartial)); ?>

                                            <?php elseif ($this->_tpl_vars['header']['group_by'] == 'YEAR'): ?>
                                                <?php echo ((is_array($_tmp=$this->_tpl_vars['row'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('crmDate', true, $_tmp, $this->_tpl_vars['config']->dateformatYear) : smarty_modifier_crmDate($_tmp, $this->_tpl_vars['config']->dateformatYear)); ?>

                                            <?php else: ?>
                                                <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['row'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('truncate', true, $_tmp, 10, '') : smarty_modifier_truncate($_tmp, 10, '')))) ? $this->_run_mod_handler('crmDate', true, $_tmp) : smarty_modifier_crmDate($_tmp)); ?>

                                            <?php endif; ?>
                                        <?php elseif ($this->_tpl_vars['header']['type'] == 1024): ?>
                                            <?php echo ((is_array($_tmp=$this->_tpl_vars['row'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('crmMoney', true, $_tmp) : smarty_modifier_crmMoney($_tmp)); ?>

                                        <?php else: ?>
                                            <?php echo $this->_tpl_vars['row'][$this->_tpl_vars['field']]; ?>

                                        <?php endif; ?>

                                        <?php if ($this->_tpl_vars['row']['contactID']): ?> <?php endif; ?>

                                        <?php if ($this->_tpl_vars['row'][$this->_tpl_vars['fieldLink']]): ?></a><?php endif; ?>
                                    </td>
                                <?php endforeach; endif; unset($_from); ?>
                            </tr>
                        </table>

                        <?php if ($this->_tpl_vars['columnHeadersComponent']): ?>
                            <?php $this->assign('componentContactId', $this->_tpl_vars['row']['contactID']); ?>
                            <?php $_from = $this->_tpl_vars['columnHeadersComponent']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['component'] => $this->_tpl_vars['pheader']):
?>
                                <?php if ($this->_tpl_vars['componentRows'][$this->_tpl_vars['componentContactId']][$this->_tpl_vars['component']]): ?>
                                    <h3><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['component'])) ? $this->_run_mod_handler('replace', true, $_tmp, '_civireport', '') : smarty_modifier_replace($_tmp, '_civireport', '')))) ? $this->_run_mod_handler('upper', true, $_tmp) : smarty_modifier_upper($_tmp)); ?>
</h3>
                          <table class="report-layout crm-report_<?php echo $this->_tpl_vars['component']; ?>
">
                                                          <tr>
                                <?php $_from = $this->_tpl_vars['pheader']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['header']):
?>
                              <th><?php echo $this->_tpl_vars['header']['title']; ?>
</th>
                                <?php endforeach; endif; unset($_from); ?>
                            </tr>

                              <?php $_from = $this->_tpl_vars['componentRows'][$this->_tpl_vars['componentContactId']][$this->_tpl_vars['component']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['rowid'] => $this->_tpl_vars['row']):
?>
                            <tr class="<?php echo smarty_function_cycle(array('values' => "odd-row,even-row"), $this);?>
 crm-report" id="crm-report_<?php echo $this->_tpl_vars['rowid']; ?>
">
                                <?php $_from = $this->_tpl_vars['columnHeadersComponent'][$this->_tpl_vars['component']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['header']):
?>
                              <?php $this->assign('fieldLink', ((is_array($_tmp=$this->_tpl_vars['field'])) ? $this->_run_mod_handler('cat', true, $_tmp, '_link') : smarty_modifier_cat($_tmp, '_link'))); ?>
                                                <?php $this->assign('fieldHover', ((is_array($_tmp=$this->_tpl_vars['field'])) ? $this->_run_mod_handler('cat', true, $_tmp, '_hover') : smarty_modifier_cat($_tmp, '_hover'))); ?>
                              <td class="report-contents crm-report_<?php echo $this->_tpl_vars['field']; ?>
">
                                  <?php if ($this->_tpl_vars['row'][$this->_tpl_vars['fieldLink']]): ?>
                                <a title="<?php echo ((is_array($_tmp=$this->_tpl_vars['row'][$this->_tpl_vars['fieldHover']])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
" href="<?php echo $this->_tpl_vars['row'][$this->_tpl_vars['fieldLink']]; ?>
">
                                  <?php endif; ?>

                                  <?php if ($this->_tpl_vars['row'][$this->_tpl_vars['field']] == 'Sub Total'): ?>
                                <?php echo $this->_tpl_vars['row'][$this->_tpl_vars['field']]; ?>

                                  <?php elseif ($this->_tpl_vars['header']['type'] & 4): ?>
                                      <?php if ($this->_tpl_vars['header']['group_by'] == 'MONTH' || $this->_tpl_vars['header']['group_by'] == 'QUARTER'): ?>
                                    <?php echo ((is_array($_tmp=$this->_tpl_vars['row'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('crmDate', true, $_tmp, $this->_tpl_vars['config']->dateformatPartial) : smarty_modifier_crmDate($_tmp, $this->_tpl_vars['config']->dateformatPartial)); ?>

                                <?php elseif ($this->_tpl_vars['header']['group_by'] == 'YEAR'): ?>
                                    <?php echo ((is_array($_tmp=$this->_tpl_vars['row'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('crmDate', true, $_tmp, $this->_tpl_vars['config']->dateformatYear) : smarty_modifier_crmDate($_tmp, $this->_tpl_vars['config']->dateformatYear)); ?>

                                <?php else: ?>
                                    <?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['row'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('truncate', true, $_tmp, 10, '') : smarty_modifier_truncate($_tmp, 10, '')))) ? $this->_run_mod_handler('crmDate', true, $_tmp) : smarty_modifier_crmDate($_tmp)); ?>

                                <?php endif; ?>
                                  <?php elseif ($this->_tpl_vars['header']['type'] == 1024): ?>
                                <?php echo ((is_array($_tmp=$this->_tpl_vars['row'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('crmMoney', true, $_tmp) : smarty_modifier_crmMoney($_tmp)); ?>

                                  <?php else: ?>
                                <?php echo $this->_tpl_vars['row'][$this->_tpl_vars['field']]; ?>

                                  <?php endif; ?>

                                  <?php if ($this->_tpl_vars['row'][$this->_tpl_vars['fieldLink']]): ?></a><?php endif; ?>
                              </td>
                                <?php endforeach; endif; unset($_from); ?>
                            </tr>
                              <?php endforeach; endif; unset($_from); ?>
                          </table>
                            <?php endif; ?>
                            <?php endforeach; endif; unset($_from); ?>
                        <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>

  <div class="report-pager">
            <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/common/pager.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        </div>
        <br />
        <?php if ($this->_tpl_vars['grandStat']): ?>
            <table class="report-layout">
                <tr>
                    <?php $_from = $this->_tpl_vars['columnHeaders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['header']):
?>
                        <td>
                            <strong>
                                <?php if ($this->_tpl_vars['header']['type'] == 1024): ?>
                                    <?php echo ((is_array($_tmp=$this->_tpl_vars['grandStat'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('crmMoney', true, $_tmp) : smarty_modifier_crmMoney($_tmp)); ?>

                                <?php else: ?>
                                    <?php echo $this->_tpl_vars['grandStat'][$this->_tpl_vars['field']]; ?>

                                <?php endif; ?>
                            </strong>
                        </td>
                    <?php endforeach; endif; unset($_from); ?>
                </tr>
            </table>
        <?php endif; ?>

        <?php if (! $this->_tpl_vars['section']): ?>
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Report/Form/Statistics.tpl", 'smarty_include_vars' => array('bottom' => true)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        <?php endif; ?>
    <?php endif; ?>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Report/Form/ErrorMessage.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>


<?php if ($this->_tpl_vars['outputMode'] == 'print'): ?>
  <script type="text/javascript">
    window.print();
  </script>
<?php endif; ?><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>