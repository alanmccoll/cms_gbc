<?php /* Smarty version 2.6.31, created on 2020-01-02 18:24:39
         compiled from CRM/Contact/Form/Task/PDFLetterCommon.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Contact/Form/Task/PDFLetterCommon.tpl', 1, false),array('block', 'ts', 'CRM/Contact/Form/Task/PDFLetterCommon.tpl', 35, false),array('function', 'help', 'CRM/Contact/Form/Task/PDFLetterCommon.tpl', 32, false),array('function', 'crmURL', 'CRM/Contact/Form/Task/PDFLetterCommon.tpl', 252, false),array('modifier', 'crmAddClass', 'CRM/Contact/Form/Task/PDFLetterCommon.tpl', 129, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['form']['template']['html']): ?>
<table class="form-layout-compressed">
    <tr>
      <td class="label-left">
        <?php echo $this->_tpl_vars['form']['template']['label']; ?>

        <?php echo smarty_function_help(array('id' => 'template','title' => $this->_tpl_vars['form']['template']['label'],'file' => "CRM/Contact/Form/Task/PDFLetterCommon.hlp"), $this);?>

      </td>
      <td>
        <?php echo $this->_tpl_vars['form']['template']['html']; ?>
 <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>OR<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php echo $this->_tpl_vars['form']['document_file']['html']; ?>

      </td>
    </tr>
    <tr>
      <td class="label-left"><?php echo $this->_tpl_vars['form']['subject']['label']; ?>
</td>
      <td><?php echo $this->_tpl_vars['form']['subject']['html']; ?>
</td>
    </tr>
    <?php if ($this->_tpl_vars['form']['campaign_id']): ?>
    <tr>
      <td class="label-left"><?php echo $this->_tpl_vars['form']['campaign_id']['label']; ?>
</td>
      <td><?php echo $this->_tpl_vars['form']['campaign_id']['html']; ?>
</td>
    </tr>
    <?php endif; ?>
</table>
<?php endif; ?>

<div class="crm-accordion-wrapper collapsed crm-pdf-format-accordion">
    <div class="crm-accordion-header">
        <?php echo $this->_tpl_vars['form']['pdf_format_header']['html']; ?>

    </div>
    <div class="crm-accordion-body">
      <div class="crm-block crm-form-block">
    <table class="form-layout-compressed">
      <tr>
        <td class="label-left"><?php echo $this->_tpl_vars['form']['format_id']['label']; ?>
 <?php echo smarty_function_help(array('id' => "id-pdf-format",'file' => "CRM/Contact/Form/Task/PDFLetterCommon.hlp"), $this);?>
</td>
        <td><?php echo $this->_tpl_vars['form']['format_id']['html']; ?>
</td>
      </tr>
      <tr>
        <td class="label-left"><?php echo $this->_tpl_vars['form']['paper_size']['label']; ?>
</td><td><?php echo $this->_tpl_vars['form']['paper_size']['html']; ?>
</td>
        <td class="label-left"><?php echo $this->_tpl_vars['form']['orientation']['label']; ?>
</td><td><?php echo $this->_tpl_vars['form']['orientation']['html']; ?>
</td>
      </tr>
      <tr>
        <td class="label-left"><?php echo $this->_tpl_vars['form']['metric']['label']; ?>
</td><td><?php echo $this->_tpl_vars['form']['metric']['html']; ?>
</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td><?php echo $this->_tpl_vars['form']['paper_dimensions']['html']; ?>
</td><td id="paper_dimensions">&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td class="label-left"><?php echo $this->_tpl_vars['form']['margin_top']['label']; ?>
</td><td><?php echo $this->_tpl_vars['form']['margin_top']['html']; ?>
</td>
        <td class="label-left"><?php echo $this->_tpl_vars['form']['margin_bottom']['label']; ?>
</td><td><?php echo $this->_tpl_vars['form']['margin_bottom']['html']; ?>
</td>
      </tr>
      <tr>
        <td class="label-left"><?php echo $this->_tpl_vars['form']['margin_left']['label']; ?>
</td><td><?php echo $this->_tpl_vars['form']['margin_left']['html']; ?>
</td>
        <td class="label-left"><?php echo $this->_tpl_vars['form']['margin_right']['label']; ?>
</td><td><?php echo $this->_tpl_vars['form']['margin_right']['html']; ?>
</td>
      </tr>
          </table>
        <div id="bindFormat"><?php echo $this->_tpl_vars['form']['bind_format']['html']; ?>
&nbsp;<?php echo $this->_tpl_vars['form']['bind_format']['label']; ?>
</div>
        <div id="updateFormat" style="display: none"><?php echo $this->_tpl_vars['form']['update_format']['html']; ?>
&nbsp;<?php echo $this->_tpl_vars['form']['update_format']['label']; ?>
</div>
      </div>
  </div>
</div>

<div class="crm-accordion-wrapper crm-document-accordion ">
  <div class="crm-accordion-header">
    <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Preview Document<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
  </div><!-- /.crm-accordion-header -->
  <div class="crm-accordion-body">
    <div id='document-preview'></div>
  </div><!-- /.crm-accordion-body -->
</div><!-- /.crm-accordion-wrapper -->

<div class="crm-accordion-wrapper crm-html_email-accordion ">
<div class="crm-accordion-header">
    <?php echo $this->_tpl_vars['form']['html_message']['label']; ?>

</div><!-- /.crm-accordion-header -->
 <div class="crm-accordion-body">
   <div class="helpIcon" id="helphtml">
     <input class="crm-token-selector big" data-field="html_message" />
     <?php echo smarty_function_help(array('id' => "id-token-html",'tplFile' => $this->_tpl_vars['tplFile'],'isAdmin' => $this->_tpl_vars['isAdmin'],'file' => "CRM/Contact/Form/Task/Email.hlp"), $this);?>

   </div>
    <div class="clear"></div>
    <div class='html'>
  <?php echo $this->_tpl_vars['form']['html_message']['html']; ?>
<br />
    </div>

<div id="editMessageDetails">
    <div id="updateDetails" >
        <?php echo $this->_tpl_vars['form']['updateTemplate']['html']; ?>
&nbsp;<?php echo $this->_tpl_vars['form']['updateTemplate']['label']; ?>

    </div>
    <div>
        <?php echo $this->_tpl_vars['form']['saveTemplate']['html']; ?>
&nbsp;<?php echo $this->_tpl_vars['form']['saveTemplate']['label']; ?>

    </div>
</div>

<div id="saveDetails" class="section">
    <div class="label"><?php echo $this->_tpl_vars['form']['saveTemplateName']['label']; ?>
</div>
    <div class="content"><?php echo ((is_array($_tmp=$this->_tpl_vars['form']['saveTemplateName']['html'])) ? $this->_run_mod_handler('crmAddClass', true, $_tmp, 'huge') : smarty_modifier_crmAddClass($_tmp, 'huge')); ?>
</div>
</div>

  </div><!-- /.crm-accordion-body -->
</div><!-- /.crm-accordion-wrapper -->

<table class="form-layout-compressed">
  <tr>
    <td class="label-left"><?php echo $this->_tpl_vars['form']['document_type']['label']; ?>
</td>
    <td><?php echo $this->_tpl_vars['form']['document_type']['html']; ?>
</td>
  </tr>
</table>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Mailing/Form/InsertTokens.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo '
<script type="text/javascript">
CRM.$(function($) {
  var $form = $(\'form.'; ?>
<?php echo $this->_tpl_vars['form']['formClass']; ?>
<?php echo '\');

  '; ?>
<?php if ($this->_tpl_vars['form']['formName'] == 'PDF'): ?><?php echo '
    $(\'.crm-document-accordion\').hide();
    $(\'#document_file\').on(\'change\', function() {
      if (this.value) {
        $(\'.crm-html_email-accordion, .crm-document-accordion, .crm-pdf-format-accordion\').hide();
        cj(\'#document_type\').closest(\'tr\').hide();
        $(\'#template\').val(\'\');
      }
    });
  '; ?>
<?php endif; ?><?php echo '


  $(\'#format_id\', $form).on(\'change\', function() {
    selectFormat($(this).val());
  });
  // After the pdf downloads, the user has to manually close the dialog (which would be nice to fix)
  // But at least we can trigger the underlying list of activities to refresh
  $(\'[name=_qf_PDF_submit]\', $form).click(function() {
    var $dialog = $(this).closest(\'.ui-dialog-content.crm-ajax-container\');
    if ($dialog.length) {
      $dialog.on(\'dialogbeforeclose\', function () {
        $(this).trigger(\'crmFormSuccess\');
      });
      $dialog.dialog(\'option\', \'buttons\', [{
        text: '; ?>
"<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Done<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"<?php echo ',
        icons: {primary: \'fa-times\'},
        click: function() {$(this).dialog(\'close\');}
      }]);
    }
  });
  $(\'[name^=_qf_PDF_submit]\', $form).click(function() {
    CRM.status('; ?>
"<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Downloading...<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"<?php echo ');
  });
  showSaveDetails($(\'input[name=saveTemplate]\', $form)[0]);

  function showSaveTemplate() {
    $(\'#updateDetails\').toggle(!!$(this).val());
  }
  $(\'[name=template]\', $form).each(showSaveTemplate).change(showSaveTemplate);
});

var currentWidth;
var currentHeight;
var currentMetric = document.getElementById(\'metric\').value;
showBindFormatChkBox();
selectPaper( document.getElementById(\'paper_size\').value );

function showBindFormatChkBox()
{
    var templateExists = true;
    if ( document.getElementById(\'template\') == null || document.getElementById(\'template\').value == \'\' ) {
        templateExists = false;
    }
    var formatExists = !!cj(\'#format_id\').val();
    if ( templateExists && formatExists ) {
        document.getElementById("bindFormat").style.display = "block";
    } else if ( formatExists && document.getElementById("saveTemplate") != null && document.getElementById("saveTemplate").checked ) {
        document.getElementById("bindFormat").style.display = "block";
        var yes = confirm( \''; ?>
<?php echo $this->_tpl_vars['useThisPageFormat']; ?>
<?php echo '\' );
        if ( yes ) {
            document.getElementById("bind_format").checked = true;
        }
    } else {
        document.getElementById("bindFormat").style.display = "none";
        document.getElementById("bind_format").checked = false;
    }
}

function showUpdateFormatChkBox()
{
    if (cj(\'#format_id\').val()) {
      cj("#updateFormat").show();
    }
}

function updateFormatLabel() {
  cj(\'.pdf-format-header-label\').html(cj(\'#format_id option:selected\').text() || cj(\'#format_id\').attr(\'placeholder\'));
}

updateFormatLabel();

function fillFormatInfo( data, bind ) {
  cj("#format_id").val( data.id );
  cj("#paper_size").val( data.paper_size );
  cj("#orientation").val( data.orientation );
  cj("#metric").val( data.metric );
  cj("#margin_top").val( data.margin_top );
  cj("#margin_bottom").val( data.margin_bottom );
  cj("#margin_left").val( data.margin_left );
  cj("#margin_right").val( data.margin_right );
  selectPaper( data.paper_size );
  cj("#update_format").prop({checked: false}).parent().hide();
  document.getElementById(\'bind_format\').checked = bind;
  showBindFormatChkBox();
}

function selectFormat( val, bind ) {
  updateFormatLabel();
  if (!val) {
    val = 0;
    bind = false;
  }

  var dataUrl = '; ?>
"<?php echo CRM_Utils_System::crmURL(array('p' => 'civicrm/ajax/pdfFormat','h' => 0), $this);?>
"<?php echo ';
  cj.post( dataUrl, {formatId: val}, function( data ) {
    fillFormatInfo(data, bind);
  }, \'json\');
}

function selectPaper( val )
{
    dataUrl = '; ?>
"<?php echo CRM_Utils_System::crmURL(array('p' => 'civicrm/ajax/paperSize','h' => 0), $this);?>
"<?php echo ';
    cj.post( dataUrl, {paperSizeName: val}, function( data ) {
        cj("#paper_size").val( data.name );
        metric = document.getElementById(\'metric\').value;
        currentWidth = convertMetric( data.width, data.metric, metric );
        currentHeight = convertMetric( data.height, data.metric, metric );
        updatePaperDimensions( );
    }, \'json\');
}

function selectMetric( metric )
{
    convertField( \'margin_top\', currentMetric, metric );
    convertField( \'margin_bottom\', currentMetric, metric );
    convertField( \'margin_left\', currentMetric, metric );
    convertField( \'margin_right\', currentMetric, metric );
    currentWidth = convertMetric( currentWidth, currentMetric, metric );
    currentHeight = convertMetric( currentHeight, currentMetric, metric );
    updatePaperDimensions( );
}

function updatePaperDimensions( )
{
    metric = document.getElementById(\'metric\').value;
    width = new String( currentWidth.toFixed( 2 ) );
    height = new String( currentHeight.toFixed( 2 ) );
    if ( document.getElementById(\'orientation\').value == \'landscape\' ) {
        width = new String( currentHeight.toFixed( 2 ) );
        height = new String( currentWidth.toFixed( 2 ) );
    }
    document.getElementById(\'paper_dimensions\').innerHTML = parseFloat( width ) + \' \' + metric + \' x \' + parseFloat( height ) + \' \' + metric;
    currentMetric = metric;
}

function convertField( id, from, to )
{
    val = document.getElementById( id ).value;
    if ( val == \'\' || isNaN( val ) ) return;
    val = convertMetric( val, from, to );
    val = new String( val.toFixed( 3 ) );
    document.getElementById( id ).value = parseFloat( val );
}

function convertMetric( value, from, to ) {
    switch( from + to ) {
        case \'incm\': return value * 2.54;
        case \'inmm\': return value * 25.4;
        case \'inpt\': return value * 72;
        case \'cmin\': return value / 2.54;
        case \'cmmm\': return value * 10;
        case \'cmpt\': return value * 72 / 2.54;
        case \'mmin\': return value / 25.4;
        case \'mmcm\': return value / 10;
        case \'mmpt\': return value * 72 / 25.4;
        case \'ptin\': return value / 72;
        case \'ptcm\': return value * 2.54 / 72;
        case \'ptmm\': return value * 25.4 / 72;
    }
    return value;
}

function showSaveDetails(chkbox)  {
    var formatSelected = ( document.getElementById(\'format_id\').value > 0 );
    var templateSelected = ( document.getElementById(\'template\') != null && document.getElementById(\'template\').value > 0 );
    if (chkbox.checked) {
        document.getElementById("saveDetails").style.display = "block";
        document.getElementById("saveTemplateName").disabled = false;
        if ( formatSelected && ! templateSelected ) {
            document.getElementById("bindFormat").style.display = "block";
            var yes = confirm( \''; ?>
<?php echo $this->_tpl_vars['useSelectedPageFormat']; ?>
<?php echo '\' );
            if ( yes ) {
                document.getElementById("bind_format").checked = true;
            }
        }
    } else {
        document.getElementById("saveDetails").style.display = "none";
        document.getElementById("saveTemplateName").disabled = true;
        if ( ! templateSelected ) {
            document.getElementById("bindFormat").style.display = "none";
            document.getElementById("bind_format").checked = false;
        }
    }
}

</script>
'; ?>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>