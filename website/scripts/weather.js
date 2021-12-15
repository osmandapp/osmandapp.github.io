var requestUtils = {
	'getParamValue': function (paramName) {
		let value = (location.search.split(paramName + '=')[1] || '').split('&')[0];
		if (value && value.length > 0) {
			return value;
		}
		return null;
	},
	'isIOS': function () {
		return /(iPad|iPhone|iPod)/g.test(navigator.userAgent);
	},
	'isAndroid': function () {
		return /Android/g.test(navigator.userAgent);
	},
	'redirect': function (newUrl) {
		document.location = newUrl;
	}
};

var goMap = {
	'config': {
		'containerid': 'gocontainer',
		'defaults': {
			'lat': 51.505,
			'lon': -0.09,
			'zoom': 5
		}
	},
	'utils': {
		'getPointFromUrl': function () {
			let point = {};
			point.lat = requestUtils.getParamValue('lat');
			point.lon = requestUtils.getParamValue('lon');
			point.zoom = requestUtils.getParamValue('z');
			return point;
		},
		'isPointComplete': function (point) {
			if (!point.lat || !point.lon) {
				return false;
			}
			return true;
		},
		'extendPoint': function (initialPoint, newPoint) {
			let point = {};
			point.lat = newPoint.lat;
			if (!point.lat || point.lat == null) {
				point.lat = initialPoint.lat;
			}
			point.lon = newPoint.lon;
			if (!point.lon || point.lon == null) {
				point.lon = initialPoint.lon;
			}
			point.zoom = newPoint.zoom;
			if (!point.zoom || point.zoom == null) {
				point.zoom = initialPoint.zoom;
			}
			return point;
		}
	},
	'init': function (config) {
		if (config && typeof (config) == 'object') {
			$.extend(goMap.config, config);
		}
		goMap.$container = $('#' + goMap.config.containerid);
		goMap.$footer = goMap.$container.find('.gofooter');
		goMap.$latitude = goMap.$container.find('.latitude');
		goMap.$longitude = goMap.$container.find('.longitude');

		let inputPoint = goMap.utils.getPointFromUrl();
		goMap.point = goMap.utils.extendPoint(goMap.config.defaults, inputPoint);
		goMap.refreshCoordinates();

		goMap.map = $.mapwidget();
		goMap.map.showPoint(goMap.point);
		goMap.map.addSlider("slider");

		let inputComplete = goMap.utils.isPointComplete(inputPoint);
		if (inputComplete) {
			goMap.map.addMarker(goMap.point);
		}
		goMap.point = goMap.utils.getPointFromUrl();
	},
	'refreshCoordinates': function () {
		goMap.$latitude.text(goMap.point.lat);
		goMap.$longitude.text(goMap.point.lon);
	}
};

(function ($) {
	$.mapwidget = function (config) {
		var loc = goMap.point.lat + '/' + goMap.point.lon;
		var lparams = '?mlat=' + goMap.point.lat + '&mlon=' + goMap.point.lon;
		let controlLayer;
		var mapobj = {
			config: $.extend({
				'mapid': 'map',
				'maxzoom': 20,
				'maxnativezoom': 19,
				'sourceurl': 'https://tile.osmand.net/hd/{z}/{x}/{y}.png',
				'attribution': '&copy; <a href="https://www.openstreetmap.org/' + lparams + '#map=15/' + loc + '">OpenStreetMap</a> contributors'
			}, config),
			init: function () {
				mapobj.map = L.map(mapobj.config.mapid);

				let bMaps = L.tileLayer(mapobj.config.sourceurl, {
					attribution: mapobj.config.attribution,
					maxZoom: mapobj.config.maxzoom,
					maxNativeZoom: mapobj.config.maxnativezoom
				});
				bMaps.addTo(mapobj.map);

			},
			showPoint: function (point) {
				mapobj.map.setView([point.lat, point.lon], point.zoom);
			},
			addMarker: function (point) {
				L.marker([point.lat, point.lon]).addTo(mapobj.map);
			},
			removeTiffLayers() {
				if (!mapobj.lcontrol || !mapobj.cloud || !mapobj.temperature /*|| !mapobj.pressure || !mapobj.wind*/)
					return;
				mapobj.lcontrol.removeLayer(mapobj.cloud);
				mapobj.lcontrol.removeLayer(mapobj.temperature);
				mapobj.map.removeLayer(mapobj.cloud);
				mapobj.map.removeLayer(mapobj.temperature);
				mapobj.lcontrol.remove();
				//		        mapobj.lcontrol.removeLayer(mapobj.pressure);
				//		        mapobj.lcontrol.removeLayer(mapobj.wind);
				mapobj.cloud = null;
				mapobj.temperature = null;
				//		        mapobj.pressure = null;
				//		        mapobj.wind = null;
			},
			requestTiffLayers(requestUrl) {
				console.log(requestUrl);
				d3.request(requestUrl).responseType('arraybuffer').get(
					function (error, tiffData) {

						console.log(error);
						mapobj.removeTiffLayers();

						// Total Cloud Cover [%]  (BAND 1)
						let c = L.ScalarField.fromGeoTIFF(tiffData.response, 0);
						mapobj.cloud = L.canvasLayer.scalarField(c, {
							color: chroma.scale(['white', 'rgba(0,0,255,0)']).domain(c.range),
							interpolate: true,
							opacity: 0.65
						}).addTo(mapobj.map);

						mapobj.cloud.on('click', function (e) {
							if (e.value !== null) {
								let v = e.value.toFixed(0);
								let html = (`<span class="popupText">Cloud Cover ${v} %</span>`);
								let popup = L.popup().setLatLng(e.latlng).setContent(html).openOn(mapobj.map);
							}
						});

						// Temperature (BAND 2)
						let t = L.ScalarField.fromGeoTIFF(tiffData.response, 1);
						mapobj.temperature = L.canvasLayer.scalarField(t, {
							color: chroma.scale('OrRd').domain(t.range),
							interpolate: true,
							opacity: 0.65
						}).addTo(mapobj.map);

						mapobj.temperature.on('click', function (e) {
							if (e.value !== null) {
								let v = e.value.toFixed(0);
								let html = (`<span class="popupText">Temperature ${v} C</span>`);
								let popup = L.popup().setLatLng(e.latlng).setContent(html).openOn(mapobj.map);
							}
						});


						mapobj.lcontrol = L.control.layers({}, {
							"Total Cloud Cover": mapobj.cloud,
							"Temperature": mapobj.temperature
						}, {
							position: 'bottomleft',
							collapsed: false
						}).addTo(mapobj.map);

						// deselect second overlay (Temperature)
						setTimeout(function() {
						    $('.leaflet-control-layers-overlays').children().each(function (i, item) { if (i == 1) item.click() });
						}, 200);
					});
			},
			addSlider: function (id) {
				$("#" + id).slider({
					range: "max",
					min: 17,
					max: 21,
					value: 1,
					slide: function (event, ui) {
						let url = "https://test.osmand.net/weather/20211213/" + ui.value + "/world.tiff"
						mapobj.requestTiffLayers(url);
						$("#time").val(ui.value);
					}
				});
			}
		};
		mapobj.init();
		return {
			showPoint: mapobj.showPoint,
			addMarker: mapobj.addMarker,
			addSlider: mapobj.addSlider
		};
	};
})(jQuery);

(function ($) {
	$.timer = function (config) {
		var timerobj = {
			config: $.extend({
				'timeoutInMs': 300,
				'maxActionDelayInMs': 2000,
				'action': function () { },
				'actionparams': null
			}, config),
			init: function () {
				timerobj.timer = null;
				timerobj.startDate = null;
			},
			start: function () {
				timerobj.cancel();
				timerobj.startDate = new Date();
				timerobj.timer = setTimeout(timerobj.onTimer, timerobj.config.timeoutInMs);
			},
			cancel: function () {
				if (timerobj.timer != null) {
					clearTimeout(timerobj.timer);
					timerobj.timer = null;
					timerobj.startDate = null;
				}
			},
			onTimer: function () {
				timerobj.timer = null;
				let now = new Date();
				if (now - timerobj.startDate < timerobj.config.maxActionDelayInMs) {
					timerobj.config.action(timerobj.config.actionparams);
				}
			}
		};
		timerobj.init();
		return {
			start: timerobj.start,
			cancel: timerobj.cancel
		};
	};
})(jQuery);


$(document).ready(function () {
	goMap.init();
});
