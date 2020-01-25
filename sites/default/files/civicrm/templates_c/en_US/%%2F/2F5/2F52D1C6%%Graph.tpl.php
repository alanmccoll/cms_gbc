<?php /* Smarty version 2.6.31, created on 2020-01-20 14:46:18
         compiled from CRM/Report/Form/Layout/Graph.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Report/Form/Layout/Graph.tpl', 1, false),array('modifier', 'replace', 'CRM/Report/Form/Layout/Graph.tpl', 26, false),array('modifier', 'cat', 'CRM/Report/Form/Layout/Graph.tpl', 31, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $this->assign('uploadURL', ((is_array($_tmp=$this->_tpl_vars['config']->imageUploadURL)) ? $this->_run_mod_handler('replace', true, $_tmp, '/persist/contribute/', '/persist/') : smarty_modifier_replace($_tmp, '/persist/contribute/', '/persist/'))); ?>
<?php if ($this->_tpl_vars['chartEnabled'] && $this->_tpl_vars['chartSupported']): ?>
  <div class='crm-chart'>
    <?php if ($this->_tpl_vars['outputMode'] == 'print' || $this->_tpl_vars['outputMode'] == 'pdf'): ?>
      <img src="<?php echo ((is_array($_tmp=$this->_tpl_vars['uploadURL'])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['chartId']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['chartId'])); ?>
.png" />
    <?php else: ?>
      <div id="chart_<?php echo $this->_tpl_vars['uniqueId']; ?>
"></div>
    <?php endif; ?>
  </div>
<?php endif; ?>

<?php if (! $this->_tpl_vars['printOnly']): ?>   <?php if (! $this->_tpl_vars['section']): ?>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/common/chart.tpl", 'smarty_include_vars' => array('divId' => "chart_".($this->_tpl_vars['uniqueId']))));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <?php endif; ?>
  <?php if ($this->_tpl_vars['chartData']): ?>
    <?php echo '
    <script type="text/javascript">
       CRM.$(function($) {
         // Build all charts.
         var allData = '; ?>
<?php echo $this->_tpl_vars['chartData']; ?>
<?php echo ';

         $.each( allData, function( chartID, chartValues ) {
           var divName = '; ?>
"chart_<?php echo $this->_tpl_vars['uniqueId']; ?>
"<?php echo ';
           createChart( chartID, divName, chartValues.size.xSize, chartValues.size.ySize, allData[chartID].object );
         });

         $("input[id$=\'submit_print\'],input[id$=\'submit_pdf\']").bind(\'click\', function(e){
           // image creator php file path and append image name
           var url = CRM.url(\'civicrm/report/chart\', \'name=\' + \''; ?>
<?php echo $this->_tpl_vars['chartId']; ?>
<?php echo '\' + \'.png\');

           //fetch object and \'POST\' image
           swfobject.getObjectById("chart_'; ?>
<?php echo $this->_tpl_vars['uniqueId']; ?>
<?php echo '").post_image(url, true, false);
         });
       });

    </script>
    '; ?>

  <?php endif; ?>
<?php endif; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>