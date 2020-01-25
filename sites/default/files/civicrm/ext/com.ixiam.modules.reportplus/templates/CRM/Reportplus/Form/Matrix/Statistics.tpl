{if $top}
  {if $printOnly}
    <h1>{$reportTitle}</h1>
    <div id="report-date">{$reportDate}</div>
  {/if}
  {if $statistics and $outputMode}
    <table class="report-layout statistics-table">
      {foreach from=$statistics.fields item=row}
        <tr>
          <th class="statistics" scope="row">{$row.title}</th>
          <td>{$row.value}</td>
        </tr>
      {/foreach}
      {foreach from=$statistics.groups item=row}
        <tr>
          <th class="statistics" scope="row">{$row.title}</th>
          <td>{$row.value}</td>
        </tr>
      {/foreach}
      {foreach from=$statistics.filters item=row}
        <tr>
          <th class="statistics" scope="row">{$row.title}</th>
          <td>{$row.value}</td>
        </tr>
      {/foreach}
    </table>
  {/if}
{/if}

{if $bottom and $rows and $statistics}
  <table class="report-layout">
    {foreach from=$statistics.counts item=row}
      <tr>
        <th class="statistics" scope="row">{$row.title}</th>
        <td>
          {if $row.type eq 1024}
            {$row.value|crmMoney}
          {elseif $row.type eq 2}
            {$row.value}
          {else}
            {$row.value|crmNumberFormat}
          {/if}

        </td>
      </tr>
    {/foreach}
  </table>
{/if}
