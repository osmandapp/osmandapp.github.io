var requestUtils={
	'getParamValue':function(paramName){		
			let value= (location.search.split(paramName + '=')[1]||'').split('&')[0];
			if (value && value.length > 0){
				return value;
			}
			return null;
		},
	'isIOS':function(){
		return /(iPad|iPhone|iPod)/g.test( navigator.userAgent );
	},
	'redirect':function(newUrl){
		document.location = newUrl;
	}
};

var goMap = {
	'config':{
		'containerid': 'gocontainer',		
		'defaults':{
			'lat':51.505,
			'lon':-0.09,
			'zoom':13
			}
	},
	'utils':{
		'getPointFromUrl':function(){
			let point = {};
			point.lat = requestUtils.getParamValue('lat');
			point.lon = requestUtils.getParamValue('lon');
			point.zoom = requestUtils.getParamValue('z');
			return point;
		},
		'isPointComplete':function(point){		
			if (!point.lat || !point.lon){
				return false;
			}
			return true;
		},
		'extendPoint':function(initialPoint, newPoint){
			let point={};
			point.lat=newPoint.lat;
			if (!point.lat || point.lat == null){
				point.lat = initialPoint.lat;
			}
			point.lon=newPoint.lon;
			if (!point.lon || point.lon == null){
				point.lon = initialPoint.lon;
			}
			point.zoom=newPoint.zoom;
			if (!point.zoom || point.zoom == null){
				point.zoom = initialPoint.zoom;
			}
			return point;
		}
	},
	'init': function(config){
		if (config && typeof (config) == 'object') {
            $.extend(goMap.config, config);
        }
		goMap.$container = $('#' + goMap.config.containerid);
		goMap.$footer = goMap.$container.find('.gofooter');
		goMap.$latitude = goMap.$container.find('.latitude');
		goMap.$longitude = goMap.$container.find('.longitude');
		goMap.applestorelink = goMap.$container.find('.gobadges .apple a').attr('href');		
		goMap.inapplink = 'osmandmaps://' + document.location.search;
		
		
		let inputPoint = goMap.utils.getPointFromUrl();					
		goMap.point = goMap.utils.extendPoint(goMap.config.defaults, inputPoint);
		goMap.refreshCoordinates();
		
		goMap.map =$.mapwidget();		
		goMap.map.showPoint(goMap.point);
		
		let inputComplete = goMap.utils.isPointComplete(inputPoint);
		if (inputComplete){
			goMap.map.addMarker(goMap.point);
		}
		goMap.point = goMap.utils.getPointFromUrl();	

		if (requestUtils.isIOS()){
				goMap.timer = $.timer({action:requestUtils.redirect, actionparams:goMap.applestorelink});
				goMap.timer.start();
				requestUtils.redirect(goMap.inapplink);
		}
	},	
	'refreshCoordinates':function(){
		goMap.$latitude.text(goMap.point.lat);
		goMap.$longitude.text(goMap.point.lon);
	}
};

(function($) {
	$.mapwidget = function(config) {
		var mapobj={
			config: $.extend({
				'mapid':'map',
                'maxzoom':20,
				'maxnativezoom':19,
				'sourceurl':'http://tile.osmand.net/hd/{z}/{x}/{y}.png',
				'attribution':'&copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'
            }, config),
			init:function(){
				mapobj.map = L.map(mapobj.config.mapid);
				L.tileLayer(mapobj.config.sourceurl, {
					attribution: mapobj.config.attribution,
					maxZoom: mapobj.config.maxzoom,
					maxNativeZoom: mapobj.config.maxnativezoom
				}).addTo(mapobj.map);				
			},
			showPoint:function(point){
				mapobj.map.setView([point.lat, point.lon], point.zoom);				
			},
			addMarker:function(point){
				L.marker([point.lat, point.lon]).addTo(mapobj.map);
			}
		};
		mapobj.init();
		return {            
            showPoint: mapobj.showPoint,
            addMarker: mapobj.addMarker
        };
	};
})(jQuery);

(function($) {
	$.timer=function(config){
		var timerobj={
			config: $.extend({
				'timeoutInMs':300,
                'maxActionDelayInMs':2000,
				'action':function(){},
				'actionparams':null
            }, config),
			init:function(){
				timerobj.timer = null;
				timerobj.startDate = null;
			},
			start:function(){
				timerobj.cancel();
				timerobj.startDate = new Date();
				timerobj.timer=setTimeout(timerobj.onTimer, timerobj.config.timeoutInMs);
			},
			cancel:function(){
				if (timerobj.timer != null){
					clearTimeout(timerobj.timer);
					timerobj.timer = null;
					timerobj.startDate = null;
				}
			},
			onTimer:function(){
				timerobj.timer= null;
				let now = new Date();
				if(now - timerobj.startDate < timerobj.config.maxActionDelayInMs){
					timerobj.config.action(timerobj.config.actionparams);
				}				
			}
		};
		timerobj.init();
		return {
			start:timerobj.start,
			cancel:timerobj.cancel
		};
	};
})(jQuery);

 $( document ).ready(function() {
    goMap.init();
  });
