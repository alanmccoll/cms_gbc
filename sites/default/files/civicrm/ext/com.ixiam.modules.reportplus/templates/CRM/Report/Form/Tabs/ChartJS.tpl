<div id="report-tab-chart-js" class="civireport-criteria">
  <table class="report-layout">
    <tr class="crm-report crm-report-criteria-aggregate">
      <td>
        <div id='crm-chartjs_enabled'>
          <label>{$form.chartjs_enabled.label}</label>&nbsp;&nbsp;{$form.chartjs_enabled.html}
        </div>
      </td>
    </tr>
    <tr class="crm-report crm-report-criteria-aggregate">
      <td>
        <div id='crm-chartjs_type'>
          <label>{$form.chartjs_type.label}</label>&nbsp;&nbsp;{$form.chartjs_type.html}
        </div>
      </td>
    </tr>
    <tr class="crm-report crm-report-criteria-aggregate">
      <td>
        <h2>Line Chart options</h2>
        <div id='crm-chartjs_line'>
          <label>{$form.chartjs_line_fill.label}</label>&nbsp;&nbsp;{$form.chartjs_line_fill.html} <br />
          <label>{$form.chartjs_line_smooth.label}</label>&nbsp;&nbsp;{$form.chartjs_line_smooth.html} <br />
        </div>
      </td>
    </tr>
  </table>
</div>

{literal}
<script type="text/javascript">
CRM.$(function($) {

});
</script>
{/literal}
