{if $chartJSEnabled}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.min.js"></script>
<div id="canvas-holder" style="margin: auto;width:75%;padding-bottom: 50px;">
  <canvas id="chartJS"></canvas>
</div>

{literal}
<script>
  var ctx = document.getElementById("chartJS").getContext('2d');
  var myChart = new Chart(ctx, {
    type: {/literal}'{$chartJSType}'{literal},
    data: loadData(),
    options: loadOptions()
  });

  function loadData() {
    var chartJSData = {/literal}{$chartJSData}{literal};
    //return JSON.stringify(chartJSData[].object);
    return chartJSData;
  }

  function loadOptions() {
    var chartJSOptions = {/literal}{$chartJSOptions}{literal};
    //return JSON.stringify(chartJSOptions[].object);
    return chartJSOptions;
  }

</script>
{/literal}
{/if}
