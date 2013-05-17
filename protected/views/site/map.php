<div class="row">
	<div class="span10">
		<div id="map" style="height: 400px"></div>
	</div>
</div>
<?php 
Yii::app()->clientScript->registerScriptFile('https://maps.googleapis.com/maps/api/js?key=AIzaSyBoNyuwR7A61dy1QIZ4WB8to6BPIV9HC7Q&sensor=false&language=id');
Yii::app()->clientScript->registerScript('all-map', "
var map;
var marker;
var geocoder;

function initialize() {
	geocoder = new google.maps.Geocoder();
	
	var latLang = new google.maps.LatLng(-6.80343, 107.823225);
	var latLang1 = new google.maps.LatLng(-6.603403, 106.11440);
	var latLang2 = new google.maps.LatLng(-6.803403, 106.5513225);
	var latLang3 = new google.maps.LatLng(-6.806603, 106.20925);
  var mapOptions = {
    zoom: 11,
    center: latLang,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById('map'),mapOptions);

	marker = new google.maps.Marker({
      position: latLang,
      map:map,
  });
	marker = new google.maps.Marker({
      position: latLang1,
      map:map,
  });
	marker = new google.maps.Marker({
      position: latLang2,
      map:map,
  });
	marker = new google.maps.Marker({
      position: latLang3,
      map:map,
  });
}

google.maps.event.addDomListener(window, 'load', initialize);
");
?>