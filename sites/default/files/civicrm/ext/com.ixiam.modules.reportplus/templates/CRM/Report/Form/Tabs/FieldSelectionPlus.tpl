{literal}
<style type="text/css">
  /* The placeholder that indicates where a dragged widget will land if dropped now. */
  #crm-reportplus-container .placeholder {
    margin: 5px;
    border: 3px dashed pink;
  }

  /* Spacing between widgets. */
  #crm-reportplus-container li.widget, #crm-reportplus-container li.empty-placeholder { margin: 6px 3px; }
  #crm-reportplus-container li.widget {
    padding: 0px;
  }

  /* Spacing inside widgets. */
  #crm-reportplus-container .widget-wrapper {
    padding: 0px;
    overflow-x:auto;
    margin-right: .25em
  }

  /* wodget header / title */
  #crm-reportplus-container .widget-header {
    background:#CDE8FE none repeat scroll 0 0;
    color:#000;
    cursor:move;
    display:inline;
    font-size:1.4em;
    margin:0;
  }

  /* widget content / body*/
  #crm-reportplus-container .widget-content {
    background-color: #ffffff;
    padding:0.5em;
  }

  /* Standards-browsers do this anyway because all inner block elements are floated.  IE doesn't because it's crap. */
  #crm-reportplus-container .widget-controls {
    background-color:#CDE8FE;
    display:block;
    padding:5px 0px;
  }

  #crm-reportplus-container .widget-icon, #crm-reportplus-container .full-screen-close-icon img {
    display: block;
    float: right;
    margin-left: 2px;
    margin-top: 2px;
    cursor: move;
  }

  #full-screen-header {
    display: block;
    padding: .2em .4em;
    background: #F0F0E8;
    /* Although this is an <a> link, it doesn't have an href="" attribute. */
    cursor: pointer;
  }

  /* Make the throbber in-yer-face. */
  #crm-reportplus-container .throbber {
    text-align: right;
    background:url("images/throbber.gif") no-repeat scroll 0 0 transparent;
    height:20px;
    width:20px;
  }

  #crm-reportplus-container p.loadtext {
    margin:1.6em 0 0 26px;
  }

  /* CSS for Dashlets */

  #crm-reportplus-container #column-selected {
    float: left;
    width: 40%;
  }

  #crm-reportplus-container .dash-column {
    border: 2px solid #696969;
    min-height: 300px;
    background-color: #EEEEEE
  }

  #crm-reportplus-container .dashlets-header {
    font-weight: bold;
  }

  #crm-reportplus-container #dashlets-column-selected {
    margin-left: 3%;
    float: left;
    width: 30%;
  }

  #crm-reportplus-container .portlet {
    margin: .5em;
    width: 95%;
    display: inline-block;
    font-size:0.9em;
  }

  #crm-reportplus-container .portlet-header {
    margin: 0.2em;
    padding: 0.4em;
    cursor: move;
  }


  #crm-reportplus-container .portlet-header .ui-icon {
    float: right;
  }

  #crm-reportplus-container .portlet-content {
    padding: 0.4em;
  }

  #crm-reportplus-container .ui-sortable-placeholder {
    border: 1px dotted black;
    visibility: visible !important;
    height: 50px !important;
  }

  #crm-reportplus-container .ui-sortable-placeholder * {
    visibility: hidden;
  }

  #crm-reportplus-container .delete-dashlet {
    display: block;
    float: right;
    cursor: move;
  }

  .sortable-number {
    width: 25px;
    float: right;
    line-height: 1em;
    text-align: center;
    font-weight: bold;
  }

  #columns-available {
    vertical-align: top;
  }
  #crm-reportplus-container #columns-available {
    background-color: #cccccc;
    margin-right: 1%;
  }
  #columns-selected, body #crm-reportplus-container #columns-available {
    display: inline-block;
    width: 46%;
    padding: 1.5%;
  }

  #columns-selected .portlet-header, #columns-available .portlet-header{
    background:transparent;
    border:0;
    padding:4px 5px;
    margin:0;
    font-weight: 400;
    font-size: 12px;
  }

  #columns-selected .ui-sortable-handle, #columns-available .ui-sortable-handle {
    border-radius: 0;

  }

   #crm-reportplus-container #columns-selected .portlet, #crm-reportplus-container #columns-available  .portlet {
    margin: .3em auto 0;
    border-color:#cccccc;
  }

  #crm-reportplus-container #columns-selected.dash-column, #crm-reportplus-container #columns-available.dash-column {
    border:0;
  }

  #columns-selected .dashlets-header-columns-selected,  #columns-available #dashlets-header-columns-available {
    padding-bottom:10px;
    font-weight: 600;
  }

  #columns-selected .portlet-header.block-fix {
    font-style: italic;
  }

  #crm-reportplus-container #columns-available .portlet {
    margin-left: .7em;
  }

</style>
{/literal}
{crmScope extensionKey='com.ixiam.modules.reportplus'}
<div id="report-tab-col-groups" class="civireport-criteria">
  <div id="crm-reportplus-container" class="crm-container">
    <div class="crm-container-snippet" bgColor="white">
      <div class="clear"></div>

      <br/>
      <div id="help" style="padding: 1em;">
        {ts}To add a column to resultset, click on and drag the field to <b>Selected Columns</b> box{/ts}.<br/>
        {ts}Columns marked with an [X] are required and cannot be disposed{/ts}.<br/>
      </div>

      <div id="columns-available" class="dash-column">
      <div id="dashlets-header-columns-available" class="dashlets-header">{ts}Available Columns{/ts}</div>
        {foreach from=$colGroups item=grpFields key=dnc}
          <div class="crm-accordion-wrapper crm-accordion collapsed">
            <div class="crm-accordion-header">{$grpFields.group_title}</div>
            <div class="crm-accordion-body">
              {foreach from=$grpFields.fields item=title key=field}
                {if $form.fields.$field.value != 1}
                <div class="portlet">
                  <div class="portlet-header" id="{$field}">
                    {$grpFields.group_title}::{$title}
                    <div class="ui-state-default sortable-number"></div>
                  </div>
                </div>
                {/if}
              {/foreach}
            </div>
          </div>
        {/foreach}
      </div>

      <div id="columns-selected" class="dash-column">
      <div class="dashlets-header-columns-selected">{ts}Selected Columns{/ts}</div>
        {foreach from=$colGroups item=grpFields key=dnc}
          {foreach from=$grpFields.fields item=title key=field}
            {if $form.fields.$field.value == 1}
              <div class="portlet" id="portlet_{$field}">
                <div class="portlet-header {if $form.fields.$field.frozen == '1'}block-fix{/if}" id="{$field}" frozen="{$form.fields.$field.frozen}">
                  {if $form.fields.$field.frozen == '1'}[X]{/if}
                  {$grpFields.group_title}::{$title}
                  <div class="ui-state-default sortable-number"></div>
                </div>
              </div>
            {/if}
          {/foreach}
        {/foreach}
      </div>

      <div class="clear"></div>

      <div id="columns-form">
        {foreach from=$colGroups item=grpFields key=dnc}
          {foreach from=$grpFields.fields item=title key=field}
            {$form.position.$field.html}{$form.fields.$field.html}<br/>
          {/foreach}
        {/foreach}
      </div>

    </div>
  </div>

  <div class="modal"><!-- Place at bottom of page --></div>

</div>
{/crmScope}
{literal}
<script type="text/javascript">
  CRM.$(function($) {

    CRM.$('#columns-form').hide();

    var currentReSortEvent;
    CRM.$(".dash-column").sortable({
      items: "div.portlet:not(.ui-state-disabled)",
      connectWith: '.dash-column',
      update: saveSorting,
      receive: saveSorting
    });

    CRM.$(".portlet").addClass("ui-widget ui-widget-content ui-helper-clearfix ui-corner-all")
      .find(".portlet-header")
        .addClass("ui-widget-header ui-corner-all")
        .end()
      .find(".portlet-content");

    CRM.$(".dash-column").disableSelection();

    initSorting();
    updateNumbering();

    function saveSorting(e, ui) {
      // workaround to not execute update when is not same column (will do by receive event)
      if(e.type == "sortupdate"){
        var same_column = (this === ui.item.parent()[0]);
          if(!same_column)
            return;
      }

      // this is to prevent double post call
      if (!currentReSortEvent || e.originalEvent != currentReSortEvent) {
        currentReSortEvent = e.originalEvent;

        {/literal}
        errTitle = "{ts}Error{/ts}"
        errMessage = "{ts}You cannot drop a required columns{/ts}"
        {literal}

        section       = CRM.$(this).attr("id");
        field         = CRM.$(ui.item).children('.portlet-header').attr('id');
        checkbox_name = "fields[" + field + "]";
        if(field == '')
            return;

        // Unselect Column
        if(section == 'columns-available'){
          if(CRM.$(ui.item).children('.portlet-header').attr("frozen") == '1'){
            CRM.$(ui.sender).sortable('cancel');
            e.stopImmediatePropagation();
            CRM.alert(errMessage, errTitle, 'error');
            return
          }

          CRM.$('input[name="' + checkbox_name + '"]').prop( "checked", false);
          CRM.$('input#position_' + field).val('');
        }
        else if(section == 'columns-selected'){
          CRM.$('input[name="' + checkbox_name + '"]').prop( "checked", true);
        }
      }

      updateNumbering();
    }

    function updateNumbering(){
      CRM.$('div[id^=columns-selected]').each( function( i ) {
        var num = 1;
        CRM.$(this).find('.portlet-header').each( function( k ) {
          CRM.$('input#position_' + CRM.$(this).attr("id")).val(num);
          CRM.$(this).children('.sortable-number').each( function( j ) {
            CRM.$(this).html(num);
            num++;
          });
        });
      });
    }

    function initSorting(){
      {/literal}

      first_item = CRM.$("#columns-selected div.portlet:first-child");
      {if isset($colPositions)}
      {foreach from=$colPositions|@array_reverse item=position key=field}

      if(first_item != CRM.$("#portlet_{$field}")){ldelim}
        CRM.$("#portlet_{$field}").insertBefore(first_item);
        first_item = CRM.$("#portlet_{$field}");
      {rdelim}

      {/foreach}
      {/if}
      {literal}
    }

  });
</script>
{/literal}


