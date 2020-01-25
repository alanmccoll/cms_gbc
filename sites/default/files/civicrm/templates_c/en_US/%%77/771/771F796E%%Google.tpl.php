<?php /* Smarty version 2.6.31, created on 2020-01-04 08:33:51
         compiled from CRM/Contact/Form/Task/Map/Google.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'crmScope', 'CRM/Contact/Form/Task/Map/Google.tpl', 1, false),array('block', 'ts', 'CRM/Contact/Form/Task/Map/Google.tpl', 51, false),array('function', 'crmURL', 'CRM/Contact/Form/Task/Map/Google.tpl', 53, false),)), $this); ?>
<?php $this->_tag_stack[] = array('crmScope', array('extensionKey' => "")); $_block_repeat=true;smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php if ($this->_tpl_vars['showDirectly']): ?>
  <?php $this->assign('height', '350px'); ?>
  <?php $this->assign('width', '425px'); ?>
<?php else: ?>
  <?php $this->assign('height', '600px'); ?>
  <?php $this->assign('width', "100%"); ?>
<?php endif; ?>
<?php $this->assign('defaultZoom', 16); ?>
<?php echo '
<script src="//maps.googleapis.com/maps/api/js?'; ?>
<?php if ($this->_tpl_vars['mapKey']): ?>key=<?php echo $this->_tpl_vars['mapKey']; ?>
<?php endif; ?><?php echo '&sensor=false&callback=initMap" type="text/javascript" defer="defer"></script>
<script type="text/javascript">
    function initMap() {
        var latlng = new google.maps.LatLng('; ?>
<?php echo $this->_tpl_vars['center']['lat']; ?>
,<?php echo $this->_tpl_vars['center']['lng']; ?>
<?php echo ');
        var map = new google.maps.Map(document.getElementById("google_map"));
        map.setCenter(latlng);
        map.setMapTypeId(google.maps.MapTypeId.ROADMAP);
        setMapOptions(map);
    }

    function setMapOptions(map) {
        bounds = new google.maps.LatLngBounds( );
  '; ?>

  <?php $_from = $this->_tpl_vars['locations']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['location']):
?>
      <?php if ($this->_tpl_vars['location']['url'] && ! $this->_tpl_vars['profileGID']): ?>
    <?php echo '
      var data = "'; ?>
<a href='<?php echo $this->_tpl_vars['location']['url']; ?>
'><?php echo $this->_tpl_vars['location']['displayName']; ?>
</a><br /><?php if (! $this->_tpl_vars['skipLocationType']): ?><?php echo $this->_tpl_vars['location']['location_type']; ?>
<br /><?php endif; ?><?php echo $this->_tpl_vars['location']['address']; ?>
<br /><br /><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Get Directions FROM:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>&nbsp;<input type=hidden id=to value='<?php echo $this->_tpl_vars['location']['displayAddress']; ?>
'><input type=text id=from size=20>&nbsp;<a href=\"#\" onclick=\"gpopUp(); return false;\">&raquo; Go</a>";
      <?php else: ?>
    <?php ob_start(); ?><?php echo CRM_Utils_System::crmURL(array('p' => 'civicrm/profile/view','q' => "reset=1&id=".($this->_tpl_vars['location']['contactID'])."&gid=".($this->_tpl_vars['profileGID'])), $this);?>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('profileURL', ob_get_contents());ob_end_clean(); ?>
    <?php echo '
      var data = "'; ?>
<a href='<?php echo $this->_tpl_vars['profileURL']; ?>
'><?php echo $this->_tpl_vars['location']['displayName']; ?>
</a><br /><?php if (! $this->_tpl_vars['skipLocationType']): ?><?php echo $this->_tpl_vars['location']['location_type']; ?>
<br /><?php endif; ?><?php echo $this->_tpl_vars['location']['address']; ?>
<br /><br /><?php $this->_tag_stack[] = array('ts', array()); $_block_repeat=true;smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Get Directions FROM:<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_ts($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>&nbsp;<input type=hidden id=to value='<?php echo $this->_tpl_vars['location']['displayAddress']; ?>
'><input type=text id=from size=20>&nbsp;<a href=\"#\" onclick=\"gpopUp(); return false;\">&raquo; Go</a>";
      <?php endif; ?>
      <?php echo '
      var address = "'; ?>
<?php echo $this->_tpl_vars['location']['address']; ?>
<?php echo '";
      '; ?>

      <?php if ($this->_tpl_vars['location']['lat']): ?>
    var point  = new google.maps.LatLng(<?php echo $this->_tpl_vars['location']['lat']; ?>
,<?php echo $this->_tpl_vars['location']['lng']; ?>
);
    var image  = null;
    <?php if ($this->_tpl_vars['location']['image'] && ( $this->_tpl_vars['location']['marker_class'] != 'Event' )): ?>
       image = '<?php echo $this->_tpl_vars['location']['image']; ?>
';
    <?php else: ?>
                 <?php if ($this->_tpl_vars['location']['marker_class'] == 'Individual'): ?>
           image = "<?php echo $this->_tpl_vars['config']->resourceBase; ?>
i/contact_ind.gif";
       <?php endif; ?>
       <?php if ($this->_tpl_vars['location']['marker_class'] == 'Household'): ?>
           image = "<?php echo $this->_tpl_vars['config']->resourceBase; ?>
i/contact_house.png";
       <?php endif; ?>
       <?php if ($this->_tpl_vars['location']['marker_class'] == 'Organization'): ?>
            image = "<?php echo $this->_tpl_vars['config']->resourceBase; ?>
i/contact_org.gif";
       <?php endif; ?>
                <?php endif; ?>
           <?php echo '
                createMarker(map, point, data, image);
                bounds.extend(point);
                '; ?>

      <?php endif; ?>
  <?php endforeach; endif; unset($_from); ?>
        map.setCenter(bounds.getCenter());
        <?php if (count ( $this->_tpl_vars['locations'] ) > 1): ?>
            map.fitBounds(bounds);
            map.setMapTypeId(google.maps.MapTypeId.TERRAIN);
        <?php elseif ($this->_tpl_vars['location']['marker_class'] == 'Event' || $this->_tpl_vars['location']['marker_class'] == 'Individual' || $this->_tpl_vars['location']['marker_class'] == 'Household' || $this->_tpl_vars['location']['marker_class'] == 'Organization'): ?>
            map.setZoom(<?php echo $this->_tpl_vars['defaultZoom']; ?>
);
        <?php else: ?>
            map.setZoom(<?php echo $this->_tpl_vars['defaultZoom']; ?>
);
        <?php endif; ?>
  <?php echo '
    }

    function createMarker(map, point, data, image) {
        var marker = new google.maps.Marker({ position: point,
                                              map: map,
                                              icon: image
                                            });
        var infowindow = new google.maps.InfoWindow();
        google.maps.event.addListener(marker, \'click\', function() { infowindow.setContent(data);
                                                                    infowindow.open(map,marker);
                                                                   });
    }

    function gpopUp() {
  var from   = document.getElementById(\'from\').value;
  var to     = document.getElementById(\'to\').value;
  var URL    = "http://maps.google.com/maps?saddr=" + from + "&daddr=" + to;
  day = new Date();
  id  = day.getTime();
  eval("page" + id + " = window.open(URL, \'" + id + "\', \'toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=780,height=640,left = 202,top = 100\');");
    }
</script>
'; ?>

<div id="google_map" style="width: <?php echo $this->_tpl_vars['width']; ?>
; height: <?php echo $this->_tpl_vars['height']; ?>
"></div>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo smarty_block_crmScope($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>