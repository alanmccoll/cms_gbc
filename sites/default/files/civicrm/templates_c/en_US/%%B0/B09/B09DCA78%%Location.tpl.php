<?php /* Smarty version 2.6.31, created on 2020-01-09 13:33:31
         compiled from CRM/Contact/Form/Search/Criteria/Location.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Contact/Form/Search/Criteria/Location.tpl', 1, false),array('block', 'ts', 'CRM/Contact/Form/Search/Criteria/Location.tpl', 35, false),array('modifier', 'crmAddClass', 'CRM/Contact/Form/Search/Criteria/Location.tpl', 32, false),array('function', 'help', 'CRM/Contact/Form/Search/Criteria/Location.tpl', 88, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><div id="location" class="form-item">
  <table class="form-layout">
    <tr>
      <td>
        <div id="streetAddress" class="crm-field-wrapper">
          <?php echo $this->_tpl_vars['form']['street_address']['label']; ?>
<br />
          <?php echo ((is_array($_tmp=$this->_tpl_vars['form']['street_address']['html'])) ? $this->_run_mod_handler('crmAddClass', true, $_tmp, 'big') : smarty_modifier_crmAddClass($_tmp, 'big')); ?>

          <?php if ($this->_tpl_vars['parseStreetAddress']): ?>
            <div>
              <a href="#" title="<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Use Address Elements<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" rel="addressElements" class="address-elements-toggle"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Use Address Elements<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>
            </div>
          <?php endif; ?>
        </div>
        <?php if ($this->_tpl_vars['parseStreetAddress']): ?>
        <div id="addressElements" class="crm-field-wrapper" style="display: none;">
          <table class="crm-block crm-form-block advanced-search-address-elements">
            <tr><td><?php echo $this->_tpl_vars['form']['street_number']['label']; ?>
<br /><?php echo $this->_tpl_vars['form']['street_number']['html']; ?>
<br /><span class="description nowrap"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>or ODD / EVEN<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></td>
              <td><?php echo $this->_tpl_vars['form']['street_name']['label']; ?>
<br /><?php echo $this->_tpl_vars['form']['street_name']['html']; ?>
</td>
              <td><?php echo $this->_tpl_vars['form']['street_unit']['label']; ?>
<br /><?php echo ((is_array($_tmp=$this->_tpl_vars['form']['street_unit']['html'])) ? $this->_run_mod_handler('crmAddClass', true, $_tmp, 'four') : smarty_modifier_crmAddClass($_tmp, 'four')); ?>
</td>
            </tr>
            <tr>
              <td colspan="3"><a href="#" title="<?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Use Complete Address<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>" rel="streetAddress" class="address-elements-toggle"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Use Street Address<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a></td>
            </tr>
          </table>
        </div>
        <?php endif; ?>
        <div class="crm-field-wrapper">
          <?php echo $this->_tpl_vars['form']['supplemental_address_1']['label']; ?>
<br />
          <?php echo $this->_tpl_vars['form']['supplemental_address_1']['html']; ?>

        </div>
        <div class="crm-field-wrapper">
          <?php echo $this->_tpl_vars['form']['supplemental_address_2']['label']; ?>
<br />
          <?php echo $this->_tpl_vars['form']['supplemental_address_2']['html']; ?>

        </div>
        <div class="crm-field-wrapper">
          <?php echo $this->_tpl_vars['form']['supplemental_address_3']['label']; ?>
<br />
          <?php echo $this->_tpl_vars['form']['supplemental_address_3']['html']; ?>

        </div>
        <div class="crm-field-wrapper">
          <?php echo $this->_tpl_vars['form']['city']['label']; ?>
<br />
          <?php echo $this->_tpl_vars['form']['city']['html']; ?>

        </div>
        <div class="crm-field-wrapper">
          <?php echo $this->_tpl_vars['form']['country']['label']; ?>
<br />
          <?php echo $this->_tpl_vars['form']['country']['html']; ?>

        </div>
        <div class="crm-field-wrapper">
          <?php echo $this->_tpl_vars['form']['state_province']['label']; ?>
<br />
          <?php echo $this->_tpl_vars['form']['state_province']['html']; ?>

        </div>
        <div class="crm-field-wrapper">
          <?php echo $this->_tpl_vars['form']['county']['label']; ?>
<br />
          <?php echo $this->_tpl_vars['form']['county']['html']; ?>

        </div>
        <div class="crm-field-wrapper">
          <?php echo $this->_tpl_vars['form']['world_region']['label']; ?>
<br />
          <?php echo $this->_tpl_vars['form']['world_region']['html']; ?>

        </div>
      </td>

      <td>
        <div class="crm-field-wrapper">
          <div><?php echo $this->_tpl_vars['form']['location_type']['label']; ?>
 <?php echo smarty_function_help(array('id' => 'location_type','title' => $this->_tpl_vars['form']['location_type']['label']), $this);?>
</div>
          <?php echo $this->_tpl_vars['form']['location_type']['html']; ?>

        </div>
        <?php if ($this->_tpl_vars['form']['address_name']['html']): ?>
          <div class="crm-field-wrapper">
            <?php echo $this->_tpl_vars['form']['address_name']['label']; ?>
<br />
            <?php echo $this->_tpl_vars['form']['address_name']['html']; ?>

          </div>
        <?php endif; ?>
        <?php if ($this->_tpl_vars['form']['postal_code']['html']): ?>
          <div class="crm-field-wrapper">
            <?php echo $this->_tpl_vars['form']['postal_code']['label']; ?>

            <input type="checkbox" id="postal-code-range-toggle" value="1"/>
            <label for="postal-code-range-toggle"><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Range<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></label><br />
            <div class="postal_code-wrapper">
              <?php echo $this->_tpl_vars['form']['postal_code']['html']; ?>

            </div>
            <div class="postal_code_range-wrapper" style="display: none;">
              <?php echo $this->_tpl_vars['form']['postal_code_low']['html']; ?>
&nbsp;-&nbsp;<?php echo $this->_tpl_vars['form']['postal_code_high']['html']; ?>

            </div>
          </div>
          <script type="text/javascript">
            <?php echo '
            CRM.$(function($) {
              $(\'#postal-code-range-toggle\').change(function() {
                if ($(this).is(\':checked\')) {
                  $(\'.postal_code_range-wrapper\').show();
                  $(\'.postal_code-wrapper\').hide().find(\'input\').val(\'\');
                } else {
                  $(\'.postal_code-wrapper\').show();
                  $(\'.postal_code_range-wrapper\').hide().find(\'input\').val(\'\');
                }
              });
              if ($(\'#postal_code_low\').val() || $(\'#postal_code_high\').val()) {
                $(\'#postal-code-range-toggle\').prop(\'checked\', true).change();
              }
            });
            '; ?>

          </script>
        <?php endif; ?>
        <?php if ($this->_tpl_vars['form']['prox_distance']['html']): ?>
          <div class="crm-field-wrapper">
            <?php echo $this->_tpl_vars['form']['prox_distance']['label']; ?>
<br />
            <?php echo $this->_tpl_vars['form']['prox_distance']['html']; ?>
&nbsp;<?php echo $this->_tpl_vars['form']['prox_distance_unit']['html']; ?>

          </div>
        <?php endif; ?>
      </td>
    </tr>

    <?php if ($this->_tpl_vars['addressGroupTree']): ?>
      <tr>
        <td colspan="2">
          <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "CRM/Custom/Form/Search.tpl", 'smarty_include_vars' => array('groupTree' => $this->_tpl_vars['addressGroupTree'],'showHideLinks' => false)));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        </td>
      </tr>
    <?php endif; ?>
  </table>
</div>

<?php if ($this->_tpl_vars['parseStreetAddress']): ?>
  <?php echo '
    <script type="text/javascript">
      CRM.$(function($) {
        function processAddressFields(name) {
          $(\'#\' + name).show();
          if (name == \'addressElements\') {
            $(\'#streetAddress\').hide().find(\'input\').val(\'\');
          } else {
            $(\'#addressElements\').hide().find(\'input\').val(\'\');
          }

        }
        $("a.address-elements-toggle").click(function(e) {
          e.preventDefault();
          processAddressFields(this.rel);
        });
        if ($(\'#street_name\').val() || $(\'#street_unit\').val() || $(\'#street_number\').val()) {
          processAddressFields(\'addressElements\');
        }
      }
    );

    </script>
  '; ?>

<?php endif; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>