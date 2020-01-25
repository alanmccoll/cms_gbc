<div id="report-tab-group-by-elements" class="civireport-criteria">
  <table class="report-layout">
    <tr class="crm-report crm-report-criteria-aggregate">
      <td width="40%">
        <div id='crm-custom_fields'>
          <label>{$form.group_bys_row.label}</label>&nbsp;&nbsp;{$form.group_bys_row.html} <br /><br />
          <span id='crm-report-freq-row'><label>{$form.group_bys_row_freq.label}</label>&nbsp;&nbsp;{$form.group_bys_row_freq.html}</span>
        </div>
      </td>
      <td width="15%">
        <div>
          <input crm-icon="fa-check" id='swap-group-bys' value="<- Swap ->" type="button">
        </div>
      </td>
      <td>
        <label>{$form.group_bys_column.label}</label>&nbsp;&nbsp;{$form.group_bys_column.html}<br /><br />
        <span id='crm-report-freq-column'><label>{$form.group_bys_column_freq.label}</label>&nbsp;&nbsp;{$form.group_bys_column_freq.html}</span>
      </td>
    </tr>
  </table>
</div>

{literal}
<script type="text/javascript">
CRM.$(function($) {
  var freqElements = {/literal}{$freqElements|@json_encode};{literal}

  showFreq("#crm-report-freq-row", $("#group_bys_row").val());
  showFreq("#crm-report-freq-column", $("#group_bys_column").val());

  $("#group_bys_row").change(function(changeData) {
    showFreq("#crm-report-freq-row", $("#group_bys_row").val());
  });

  $("#group_bys_column").change(function(changeData) {
    showFreq("#crm-report-freq-column", $("#group_bys_column").val());
  });

  $("#swap-group-bys").click(function() {
    var group_bys_row = $("#group_bys_row").val();
    var group_bys_column = $("#group_bys_column").val();
    $('#group_bys_row').select2('val', group_bys_column);
    $('#group_bys_column').select2('val', group_bys_row);

    showFreq("#crm-report-freq-row", $("#group_bys_row").val());
    showFreq("#crm-report-freq-column", $("#group_bys_column").val());
  });

  function showFreq(id, value){
    if(freqElements.includes(value))
      $(id).show();
    else
      $(id).hide();
  }
});
</script>
{/literal}
