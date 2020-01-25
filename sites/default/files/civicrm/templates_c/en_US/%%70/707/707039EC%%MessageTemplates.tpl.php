<?php /* Smarty version 2.6.31, created on 2020-01-03 14:12:00
         compiled from CRM/Admin/Form/MessageTemplates.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Admin/Form/MessageTemplates.tpl', 1, false),array('block', 'ts', 'CRM/Admin/Form/MessageTemplates.tpl', 31, false),array('function', 'docURL', 'CRM/Admin/Form/MessageTemplates.tpl', 27, false),array('function', 'help', 'CRM/Admin/Form/MessageTemplates.tpl', 31, false),array('modifier', 'escape', 'CRM/Admin/Form/MessageTemplates.tpl', 42, false),array('modifier', 'crmAddClass', 'CRM/Admin/Form/MessageTemplates.tpl', 62, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php ob_start(); ?><?php echo smarty_function_docURL(array('page' => "user/common-workflows/tokens-and-mail-merge",'text' => 'token documentation'), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('tokenDocsRepeated', ob_get_contents());ob_end_clean(); ?>

<?php if ($this->_tpl_vars['action'] != 8): ?>
<div class="help">
    <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Use this form to add or edit re-usable message templates.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php echo smarty_function_help(array('id' => "id-intro",'file' => "CRM/Admin/Page/MessageTemplates.hlp"), $this);?>

</div>
<?php endif; ?>

<h3><?php if ($this->_tpl_vars['action'] == 1): ?><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>New Message Template<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php elseif ($this->_tpl_vars['action'] == 2): ?><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Edit Message Template<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php else: ?><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete Message Template<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?><?php endif; ?></h3>

<div class="crm-block crm-form-block">
<div class="form-item" id="message_templates">
<?php if ($this->_tpl_vars['action'] == 8): ?>
   <div class="messages status no-popup">
       <div class="icon inform-icon"></div>
       <?php $this->_tag_stack[] = array('ts', array('1' => ((is_array($_tmp=$this->_tpl_vars['msg_title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Do you want to delete the message template '%1'?<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
   </div>
<?php else: ?>
        <div class="crm-submit-buttons"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/common/formButtons.tpl", 'smarty_include_vars' => array('location' => 'top')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
        <table class="form-layout-compressed">
        <tr>
            <td class="label-left"><?php echo $this->_tpl_vars['form']['msg_title']['label']; ?>
</td>
            <td><?php echo $this->_tpl_vars['form']['msg_title']['html']; ?>

                <br /><span class="description html-adjust"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Descriptive title of message - used for template selection.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
            </td>
        </tr>
        <tr>
           <td class="label-left"><?php echo $this->_tpl_vars['form']['file_type']['label']; ?>
</td>
            <td><?php echo $this->_tpl_vars['form']['file_type']['html']; ?>

                <br /><span class="description html-adjust"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Compose a message on-screen for general use in emails or document output, or upload a pre-composed document for mail-merge.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
            </td>
        </tr>
        <tr>
            <td class="label-left"><?php echo $this->_tpl_vars['form']['msg_subject']['label']; ?>
</td>
            <td>
              <?php echo ((is_array($_tmp=$this->_tpl_vars['form']['msg_subject']['html'])) ? $this->_run_mod_handler('crmAddClass', true, $_tmp, 'huge') : smarty_modifier_crmAddClass($_tmp, 'huge')); ?>

              <input class="crm-token-selector big" data-field="msg_subject" />
              <?php echo smarty_function_help(array('id' => "id-token-subject",'tplFile' => $this->_tpl_vars['tplFile'],'isAdmin' => $this->_tpl_vars['isAdmin'],'file' => "CRM/Contact/Form/Task/Email.hlp"), $this);?>

             <br /><span class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Subject for email message.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php $this->_tag_stack[] = array('ts', array('1' => $this->_tpl_vars['tokenDocsRepeated'])); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tokens may be included (%1).<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
            </td>
        </tr>
        <tr>
            <td class="label-left"><?php echo $this->_tpl_vars['form']['file_id']['label']; ?>
</td>
            <td><?php echo $this->_tpl_vars['form']['file_id']['html']; ?>

              <?php if ($this->_tpl_vars['attachment']): ?>
                 <?php $_from = $this->_tpl_vars['attachment']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['attKey'] => $this->_tpl_vars['attVal']):
?>
                 <div class="crm-attachment-wrapper crm-entity" id="file_<?php echo $this->_tpl_vars['attVal']['fileID']; ?>
">
                   <strong><a class="crm-attachment" href="<?php echo $this->_tpl_vars['attVal']['url']; ?>
"><?php echo $this->_tpl_vars['attVal']['cleanName']; ?>
</a></strong>
                   <?php if ($this->_tpl_vars['attVal']['description']): ?>&nbsp;-&nbsp;<?php echo $this->_tpl_vars['attVal']['description']; ?>
<?php endif; ?>
                   <?php if ($this->_tpl_vars['attVal']['deleteURLArgs']): ?>
                    <a href="#" class="crm-hover-button delete-attachment" data-mimetype="<?php echo $this->_tpl_vars['attVal']['mime_type']; ?>
" data-filename="<?php echo $this->_tpl_vars['attVal']['cleanName']; ?>
" data-args="<?php echo $this->_tpl_vars['attVal']['deleteURLArgs']; ?>
" title="<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Delete File<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><span class="icon delete-icon"></span></a>
                   <?php endif; ?>
                   <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Form/attachmentjs.tpl", 'smarty_include_vars' => array('context' => 'MessageTemplate')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                 <?php endforeach; endif; unset($_from); ?>
              <?php endif; ?>
                <br /><span class="description html-adjust"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Upload the document in .docx or .odt format.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></span>
            </td>
        </tr>
        <tr>
  </table>

      <div id="msg_html_section" class="crm-accordion-wrapper crm-html_email-accordion ">
        <div class="crm-accordion-header">
            <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>HTML Format<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
            <?php echo smarty_function_help(array('id' => "id-message-text",'file' => "CRM/Contact/Form/Task/Email.hlp"), $this);?>

        </div><!-- /.crm-accordion-header -->
         <div class="crm-accordion-body">
           <div class="helpIcon" id="helphtml">
             <input class="crm-token-selector big" data-field="msg_html" />
             <?php echo smarty_function_help(array('id' => "id-token-html",'tplFile' => $this->_tpl_vars['tplFile'],'isAdmin' => $this->_tpl_vars['isAdmin'],'file' => "CRM/Contact/Form/Task/Email.hlp"), $this);?>

           </div>
                <div class="clear"></div>
                <div class='html'>
                    <?php echo ((is_array($_tmp=$this->_tpl_vars['form']['msg_html']['html'])) ? $this->_run_mod_handler('crmAddClass', true, $_tmp, 'huge') : smarty_modifier_crmAddClass($_tmp, 'huge')); ?>

                    <div class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>An HTML formatted version of this message will be sent to contacts whose Email Format preference is 'HTML' or 'Both'.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php $this->_tag_stack[] = array('ts', array('1' => $this->_tpl_vars['tokenDocsRepeated'])); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tokens may be included (%1).<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
                </div>
        </div><!-- /.crm-accordion-body -->
      </div><!-- /.crm-accordion-wrapper -->

      <div id="msg_text_section" class="crm-accordion-wrapper crm-plaint_text_email-accordion ">
        <div class="crm-accordion-header">
                <?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Plain-Text Format<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
        </div><!-- /.crm-accordion-header -->
            <div class="crm-accordion-body">
              <div class="helpIcon" id="helptext">
                <input class="crm-token-selector big" data-field="msg_text" />
                <?php echo smarty_function_help(array('id' => "id-token-text",'tplFile' => $this->_tpl_vars['tplFile'],'file' => "CRM/Contact/Form/Task/Email.hlp"), $this);?>

              </div>
              <div class="clear"></div>
                <div class='text'>
                    <?php echo ((is_array($_tmp=$this->_tpl_vars['form']['msg_text']['html'])) ? $this->_run_mod_handler('crmAddClass', true, $_tmp, 'huge') : smarty_modifier_crmAddClass($_tmp, 'huge')); ?>

                    <div class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Text formatted message.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> <?php $this->_tag_stack[] = array('ts', array('1' => $this->_tpl_vars['tokenDocsRepeated'])); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Tokens may be included (%1).<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
                </div>
            </div><!-- /.crm-accordion-body -->
      </div><!-- /.crm-accordion-wrapper -->

      <div id="pdf_format" class="crm-accordion-wrapper crm-html_email-accordion ">
        <div class="crm-accordion-header">
            <?php echo $this->_tpl_vars['form']['pdf_format_id']['label']; ?>

        </div><!-- /.crm-accordion-header -->
         <div class="crm-accordion-body">
                <div class="spacer"></div>
                <div class='html'>
                    <?php echo $this->_tpl_vars['form']['pdf_format_id']['html']; ?>

                    <?php echo smarty_function_help(array('id' => "id-msg-template",'file' => "CRM/Contact/Form/Task/PDFLetterCommon.hlp"), $this);?>

                    <div class="description"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Page format to use when creating PDF files using this template.<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></div>
                </div>
        </div><!-- /.crm-accordion-body -->
      </div><!-- /.crm-accordion-wrapper -->

    <?php if (! $this->_tpl_vars['workflow_id']): ?>
  <table class="form-layout-compressed">
          <tr>
            <td class="label-left"><?php echo $this->_tpl_vars['form']['is_active']['label']; ?>
</td>
            <td><?php echo $this->_tpl_vars['form']['is_active']['html']; ?>
</td>
          </tr>
  </table>
    <?php endif; ?>
  <?php endif; ?>
  <div class="crm-submit-buttons"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/common/formButtons.tpl", 'smarty_include_vars' => array('location' => 'bottom')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
  <br clear="all" />
</div>
</div> <!-- end of crm-form-block -->
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Mailing/Form/InsertTokens.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php echo '
  <script type=\'text/javascript\'>
    CRM.$(function($) {
      var mimeType = null;
      // if default file is selected then hide the file upload field
      if ($(\'a.delete-attachment\').length) {
        $(\'#file_id\').hide();
        mimeType = $(\'a.delete-attachment\').data(\'mimetype\');
      }

      var selector = $("input[id$=\'_file_type\']").attr(\'type\') == \'radio\' ? "input[id$=\'_file_type\']:checked" : "input[id$=\'_file_type\']";
      showHideUpload($(selector).val());
      $("input[id$=\'_file_type\']").on(\'click\', function(){
        showHideUpload(this.value);
      });
      function showHideUpload(type) {
        var show = (type == 1) ? false : true;
        $("#msg_html_section, #msg_text_section, #pdf_format").toggle(show);
        $("#file_id").parent().parent().toggle(!show);

        // auto file type validation
        if (type) {
          var validType = \'application/vnd.oasis.opendocument.text, application/vnd.openxmlformats-officedocument.wordprocessingml.document\';
          $("#file_id").attr(\'accept\', validType);
        }
      }
    });
  </script>
'; ?>

<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>