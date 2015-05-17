
function gomap(mapcontainer, pagecontainer, footer, latitudeElement, longitudeElement){
var map =null;

var getParamValue = function(paramName){
     return (location.search.split(paramName + '=')[1]||'').split('&')[0];
};
var init = function(){
   /*$('#map').height($(document).height()-233);
	var newWidth = $(document).width();	
	$('#map').width(newWidth);*/
	var lat = getParamValue('lat');
	var pointDefined = true;
	if (!lat){
		lat = 51.505;
		pointDefined = false;
	}
	var lon = getParamValue('lon');
	if (!lon){
		lon = -0.09;
		pointDefined = false;
	}
	var z = getParamValue('z');
	if (!z){
		z = 13;
		pointDefined = false;
	}
	var container = $(".gocontainer");
	
	var footer = $(".gofooter");
	footer.remove();

	map = L.map('map').setView([lat, lon], z);
	L.tileLayer('http://tile.osmand.net/hd/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors',
		maxZoom: 18
	}).addTo(map);
	
	
	container.append(footer);
	if (pointDefined == true){
		var marker = L.marker([lat, lon]).addTo(map);
		
	}
	$(".latitude").text(lat);
	$(".longitude").text(lon);
};

init();
}