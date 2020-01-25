<?php /* Smarty version 2.6.31, created on 2020-01-02 18:24:39
         compiled from CRM/Mailing/Form/InsertTokens.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Mailing/Form/InsertTokens.tpl', 1, false),array('block', 'ts', 'CRM/Mailing/Form/InsertTokens.tpl', 277, false),array('modifier', 'json_encode', 'CRM/Mailing/Form/InsertTokens.tpl', 27, false),array('function', 'crmURL', 'CRM/Mailing/Form/InsertTokens.tpl', 140, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><script type="text/javascript">
cj('form.<?php echo $this->_tpl_vars['form']['formClass']; ?>
').data('tokens', <?php echo json_encode($this->_tpl_vars['tokens']); ?>
);
var text_message = null;
var html_message = null;
var prefix = '';
var isPDF        = false;
var isMailing    = false;

<?php if ($this->_tpl_vars['form']['formName'] == 'MessageTemplates'): ?>
  <?php echo '
  text_message = "msg_text";
  html_message = "msg_html";
  '; ?>

  <?php elseif ($this->_tpl_vars['form']['formName'] == 'Address'): ?>
  <?php echo '
  text_message = "mailing_format";
  isMailing = false;
  '; ?>

  <?php elseif ($this->_tpl_vars['form']['formClass'] == 'CRM_SMS_Form_Upload' || $this->_tpl_vars['form']['formClass'] == 'CRM_Contact_Form_Task_SMS'): ?>
  <?php echo '
  prefix = "SMS";
  text_message = "sms_text_message";
  isMailing = true;
  '; ?>

  <?php else: ?>
  <?php echo '
  text_message = "text_message";
  html_message = (cj("#edit-html-message-value").length > 0) ? "edit-html-message-value" : "html_message";
  isMailing    = true;
  '; ?>

<?php endif; ?>

<?php if ($this->_tpl_vars['form']['formName'] == 'PDF'): ?>
  <?php echo '
  isPDF = true;
  '; ?>

<?php endif; ?>

<?php if ($this->_tpl_vars['templateSelected']): ?>
  <?php echo '
  if ( document.getElementsByName(prefix + "saveTemplate")[0].checked ) {
    document.getElementById(prefix + "template").selectedIndex = '; ?>
<?php echo $this->_tpl_vars['templateSelected']; ?>
<?php echo ';
  }
'; ?>

<?php endif; ?>
<?php echo '

function showSaveUpdateChkBox(prefix) {
  prefix = prefix || \'\';
  if (document.getElementById(prefix + "template") == null) {
    if (document.getElementsByName(prefix + "saveTemplate")[0].checked){
      document.getElementById(prefix + "saveDetails").style.display = "block";
      document.getElementById(prefix + "editMessageDetails").style.display = "block";
    }
    else {
      document.getElementById(prefix + "saveDetails").style.display = "none";
      document.getElementById(prefix + "updateDetails").style.display = "none";
    }
    return;
  }

  if (document.getElementsByName(prefix + "saveTemplate")[0].checked &&
    document.getElementsByName(prefix + "updateTemplate")[0].checked == false) {
    document.getElementById(prefix + "updateDetails").style.display = "none";
  }
  else if ( document.getElementsByName(prefix + "saveTemplate")[0].checked &&
    document.getElementsByName(prefix + "updateTemplate")[0].checked ){
    document.getElementById(prefix + "editMessageDetails").style.display = "block";
    document.getElementById(pefix + "saveDetails").style.display = "block";
  }
  else if ( document.getElementsByName(prefix + "saveTemplate")[0].checked == false &&
      document.getElementsByName(prefix + "updateTemplate")[0].checked ) {
    document.getElementById(prefix + "saveDetails").style.display = "none";
    document.getElementById(prefix + "editMessageDetails").style.display = "block";
  }
  else {
    document.getElementById(prefix + "saveDetails").style.display = "none";
    document.getElementById(prefix + "updateDetails").style.display = "none";
  }
}

function selectValue( val, prefix) {
  document.getElementsByName(prefix + "saveTemplate")[0].checked = false;
  document.getElementsByName(prefix + "updateTemplate")[0].checked = false;
  showSaveUpdateChkBox(prefix);
  if ( !val ) {
    if (document.getElementById("subject").length) {
      document.getElementById("subject").value ="";
    }
    if (document.getElementById("subject").length) {
      document.getElementById("subject").value ="";
    }
    if ( !isPDF ) {
      if (prefix == \'SMS\') {
        document.getElementById("sms_text_message").value ="";
        return;
      }
      else {
        document.getElementById("text_message").value ="";
      }
    }
    else {
      cj(\'.crm-html_email-accordion\').show();
      cj(\'.crm-document-accordion\').hide();
      cj(\'#document_type\').closest(\'tr\').show();
    }

    CRM.wysiwyg.setVal(\'#\' + html_message, \'\');
    if ( isPDF ) {
      showBindFormatChkBox();
    }
    return;
  }

  var dataUrl = '; ?>
"<?php echo CRM_Utils_System::crmURL(array('p' => 'civicrm/ajax/template','h' => 0), $this);?>
"<?php echo ';

  cj.post( dataUrl, {tid: val}, function( data ) {
    var hide = (data.document_body && isPDF) ? false : true;
    cj(\'.crm-html_email-accordion, .crm-pdf-format-accordion\').toggle(hide);
    cj(\'.crm-document-accordion\').toggle(!hide);

    cj(\'#document_type\').closest(\'tr\').toggle(hide);

    // Unset any uploaded document when any template is chosen
    if (cj(\'#document.file\').length) {
      cj(\'#document_file\').val(\'\');
    }

    if (!hide) {
      cj("#subject").val( data.subject );
      cj("#document-preview").html(data.document_body).parent().css({\'background\': \'white\'});
      return;
    }

    if ( !isPDF ) {
      if (prefix == "SMS") {
          text_message = "sms_text_message";
      }
      if ( data.msg_text ) {
        cj("#"+text_message).val( data.msg_text );
        cj("div.text").show();
        cj(".head").find(\'span\').removeClass().addClass(\'ui-icon ui-icon-triangle-1-s\');
        cj("#helptext").show();
      }
      else {
        cj("#"+text_message).val("");
      }
    }

    if (prefix == "SMS") {
      return;
    }
    else {
      cj("#subject").val( data.subject );
    }

    CRM.wysiwyg.setVal(\'#\' + html_message, data.msg_html || \'\');

    if (isPDF) {
      var bind = data.pdf_format_id ? true : false ;
      selectFormat( data.pdf_format_id, bind );
      if (!bind) {
        document.getElementById("bindFormat").style.display = "none";
      }
    }
  }, \'json\');
}

if ( isMailing ) {
  document.getElementById(prefix + "editMessageDetails").style.display = "block";

  function verify(select, prefix) {
    prefix = prefix || \'\';
    if (document.getElementsByName(prefix + "saveTemplate")[0].checked  == false) {
      document.getElementById(prefix + "saveDetails").style.display = "none";
    }
    document.getElementById(prefix + "editMessageDetails").style.display = "block";

    var templateExists = true;
    if (document.getElementById(prefix + "template") == null) {
      templateExists = false;
    }

    if (templateExists && document.getElementById(prefix + "template").value) {
      document.getElementById(prefix + "updateDetails").style.display = \'\';
    }
    else {
      document.getElementById(prefix + "updateDetails").style.display = \'none\';
    }

    document.getElementById(prefix + "saveTemplateName").disabled = false;
  }

  function showSaveDetails(chkbox, prefix) {
    prefix = prefix || \'\';
    if (chkbox.checked) {
      document.getElementById(prefix + "saveDetails").style.display = "block";
      document.getElementById(prefix + "saveTemplateName").disabled = false;
    }
    else {
      document.getElementById(prefix + "saveDetails").style.display = "none";
      document.getElementById(prefix + "saveTemplateName").disabled = true;
    }
  }

  if (cj("#sms_text_message").length) {
    showSaveUpdateChkBox(\'SMS\');
  }
  if (cj("#text_message").length) {
    showSaveUpdateChkBox();
  }

  cj(\'#\' + html_message).on(\'focus change\', verify);
}

CRM.$(function($) {
  function insertToken() {
    var
      token = $(this).val(),
      field = $(this).data(\'field\');
    if (field.indexOf(\'html\') < 0) {
      field = textMsgID($(this));
    }
    CRM.wysiwyg.insert(\'#\' + field, token);
    $(this).select2(\'val\', \'\');
    if (isMailing) {
      verify();
    }
  }

  function textMsgID(obj) {
    if (obj.parents().is("#sms")) {
      field = \'sms #\' + obj.data(\'field\');
    }
    else if(obj.parents().is("#email")) {
      field = \'email #\' + obj.data(\'field\');
    }
    else {
      field = obj.data(\'field\');
    }

    return field;
  }

  // Initialize token selector widgets
  var form = $(\'form.'; ?>
<?php echo $this->_tpl_vars['form']['formClass']; ?>
<?php echo '\');
  $(\'input.crm-token-selector\', form)
    .addClass(\'crm-action-menu fa-code\')
    .change(insertToken)
    .crmSelect2({
      data: form.data(\'tokens\'),
      placeholder: \''; ?>
<?php $this->_tag_stack[] = array('ts', array('escape' => 'js')); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tokens<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php echo '\'
    });

  $(\'.accordion .head\').addClass( "ui-accordion-header ui-helper-reset ui-state-default ui-corner-all ")
    .hover( function() { $(this).addClass( "ui-state-hover");
  }, function() { $(this).removeClass( "ui-state-hover");
  }).bind(\'click\', function() {
    var checkClass = $(this).find(\'span\').attr( \'class\' );
    var len        = checkClass.length;
    if ( checkClass.substring( len - 1, len ) == \'s\' ) {
      $(this).find(\'span\').removeClass().addClass(\'ui-icon ui-icon-triangle-1-e\');
      $("span#help"+$(this).find(\'span\').attr(\'id\')).hide();
    }
    else {
      $(this).find(\'span\').removeClass().addClass(\'ui-icon ui-icon-triangle-1-s\');
      $("span#help"+$(this).find(\'span\').attr(\'id\')).show();
    }
    $(this).next().toggle(); return false;
  }).next().hide();
  $(\'span#html\').removeClass().addClass(\'ui-icon ui-icon-triangle-1-s\');
  $("div.html").show();

  if ( !isMailing ) {
    $("div.text").show();
  }

  function setSignature() {
    var emailID = $("#fromEmailAddress").val( );
    if ( !isNaN( emailID ) ) {
      var dataUrl = '; ?>
"<?php echo CRM_Utils_System::crmURL(array('p' => 'civicrm/ajax/signature','h' => 0), $this);?>
"<?php echo ';
      $.post( dataUrl, {emailID: emailID}, function( data ) {

        if (data.signature_text) {
          var textMessage =  $("#"+ text_message).val( ) + \'\\n\\n--\\n\' + data.signature_text;
          $("#"+ text_message).val( textMessage );
        }

        if (data.signature_html) {
          var htmlMessage = CRM.wysiwyg.getVal("#" + html_message) + \'<br/><br/>--<br/>\' + data.signature_html;
          CRM.wysiwyg.setVal("#" + html_message, htmlMessage);
        }
      }, \'json\');
    }
  }
  $("#fromEmailAddress", form).change(setSignature);
});

</script>
'; ?>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>