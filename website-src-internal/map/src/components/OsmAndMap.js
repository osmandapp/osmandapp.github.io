import React, {useEffect, useRef, useContext, useState, useMemo, useCallback} from 'react';
import { makeStyles } from "@material-ui/core/styles";
import { MapContainer, TileLayer, ZoomControl, LayersControl, CircleMarker, Marker, GeoJSON} from "react-leaflet";
import AppContext from "../context/AppContext";
import MapContextMenu from "./MapContextMenu"
import L from 'leaflet';
import MarkerIcon from './MarkerIcon.js'
import 'leaflet-gpx';
import 'leaflet-hash';

// import 'leaflet.awesome-markers';
// import 'leaflet.awesome-markers/dist/leaflet.awesome-markers.css';
// import 'ionicons/css/ionicons.min.css'

import 'leaflet-contextmenu';
import 'leaflet-contextmenu/dist/leaflet.contextmenu.css';


const useStyles = makeStyles((theme) => ({
  root: {
    width: "100%",
    height: "100%"
  },
}));

const markerOptions = {
  startIcon: MarkerIcon({ bg: 'blue' }),
  endIcon: MarkerIcon({ bg: 'red' }),
  wptIcons: {
    '': MarkerIcon({ bg: 'yellow' }),
  }
};


// initial location on map
const position = [50, 5];

function getWeatherTime(weatherDateObj) {
  let h = weatherDateObj.getUTCHours();
  if (h < 10) {
    h = '0' + h;
  }
  let m = weatherDateObj.getUTCMonth() + 1;
  if (m < 10) {
    m = '0' + m;
  }
  let d = weatherDateObj.getUTCDate();
  if (d < 10) {
    d = '0' + d;
  }
  return weatherDateObj.getUTCFullYear() + '' + m + '' + d + "_" + h + "00";
}

async function calcRoute(startPoint, endPoint, routeMode, setRouteData) {
  // encodeURIComponent(startPoint.lat)
  setRouteData(null);
  const starturl = `points=${startPoint.lat.toFixed(6)},${startPoint.lng.toFixed(6)}`;
  const endurl = `points=${endPoint.lat.toFixed(6)},${endPoint.lng.toFixed(6)}`;
  const response = await fetch(`/routing/route?routeMode=${routeMode.mode}&${starturl}&${endurl}`, {
    method: 'GET',
    headers: { 'Content-Type': 'application/json' }
  });
  if (response.ok) {
    let data = await response.json();
    setRouteData({geojson: data, id : new Date().getTime()});
  }
}
const setRoutePoints = (setStartPoint, setEndPoint, ctx) => (e) => {
  if (setStartPoint) {
    setStartPoint(e.latlng);
    ctx.startPoint = e.latlng;
  } else if (setEndPoint) {
    setEndPoint(e.latlng);
    ctx.endPoint = e.latlng;
  }
}
const updateLayerFunc = (layers, updateLayers, enable) => (event) => {
  const ind = layers.findIndex(l => l.name === event.name);
  if (ind >= 0 && layers[ind].checked !== enable) {
    let newlayers = [...layers];
    newlayers[ind].checked = enable;
    updateLayers(newlayers);
  }
}


function addTrackToMap(file, map) { 
  file.gpx = new L.GPX(file.url, {
    async: true,
    marker_options: markerOptions
  }).on('loaded', function (e) {
    let trackPoints = Object.values(e.layers._layers)[0]._latlngs;
    trackPoints.forEach((point) => {
      let pointObj = { lat: point.lat, lng: point.lng };
      // if need distFromStart:e.target._info.elevation._points[index][0]
      file.points.push(pointObj);
    })
    //file.points.push(getPoints(e));
    map.current.fitBounds(e.target.getBounds());  
  }).addTo(map.current);
  file.points = []; 
}

function removeTrackFromMap(file, map) {
  map.current.removeLayer(file.gpx);
  file.gpx = null;
}

const updateMarker = (lat, lng, setHoverPoint, hoverPointRef) => {
  if (lat) {
    if (hoverPointRef.current) {
      hoverPointRef.current.setLatLng([lat, lng]);
    } else {
      setHoverPoint({ lat: lat, lng: lng });
    }
  } else {
    setHoverPoint(null);
  }
}

const OsmAndMap = () => {

  const classes = useStyles();
  const mapRef = useRef(null);
  const tileLayer = useRef(null);
  const hoverPointRef = useRef(null);
  const startPointRef = useRef(null);
  const endPointRef = useRef(null);
  let hash = null;
  const ctx = useContext(AppContext);

  const [hoverPoint, setHoverPoint] = useState(null);

  const whenReadyHandler = event => {
    const { target: map } = event;
    map.on('overlayadd', updateLayerFunc(ctx.weatherLayers, ctx.updateWeatherLayers, true));
    map.on('overlayremove', updateLayerFunc(ctx.weatherLayers, ctx.updateWeatherLayers, false));
    map.attributionControl.setPrefix('');
    hash = new L.Hash(map);
    mapRef.current = map;
    if (!ctx.mapMarkerListener) {
      ctx.setMapMarkerListener(() => (lat, lng) => updateMarker(lat, lng, setHoverPoint, hoverPointRef));
    }
  }
  const startEventHandlers = useCallback({
    dragend() {
      const marker = startPointRef.current;
      if (marker != null) {
        ctx.setStartPoint(marker.getLatLng());
      }
    }
  }, [ctx.setStartPoint, startPointRef]);
  const endEventHandlers = useCallback({
    dragend() {
      const marker = endPointRef.current;
      if (marker != null) {
        ctx.setEndPoint(marker.getLatLng());
      }
    }
  }, [ctx.setEndPoint, endPointRef]);
  
  useEffect(() => {
    if (mapRef.current) {
      mapRef.current.eachLayer((layer) => {
        if (layer.options.tms) {
          layer.options.time = getWeatherTime(ctx.weatherDate);
          layer.redraw();
        }
      });
    }
  }, [ctx.weatherDate]);

  useEffect(() => {
    if (ctx.startPoint && ctx.endPoint) {
      calcRoute(ctx.startPoint, ctx.endPoint, ctx.routeMode, ctx.setRouteData);
    }
  }, [ctx.routeMode, ctx.startPoint, ctx.endPoint, ctx.setRouteData])

  useEffect(() => {
    // var gpx = 'https://www.openstreetmap.org/trace/4020415/data'; // URL to your GPX file or the GPX itself
    let filesMap = ctx.gpxFiles ? ctx.gpxFiles : {} ;
    Object.values(filesMap).forEach((file) => {
      // could be done in react style ?
      if (file.url && !file.gpx) {
        addTrackToMap(file, mapRef);
        ctx.setGpxFiles(ctx.gpxFiles);
      } else if (!file.url && file.gpx) {
        removeTrackFromMap(file, mapRef);
      }
    });
  }, [ctx.gpxFiles, ctx.setGpxFiles]);

  useEffect(() => {
    if (tileLayer.current) {
      tileLayer.current.setUrl(ctx.tileURL.url);
    }
  }, [ctx.tileURL]);

  useEffect(() => {
    if (mapRef.current) {
      const map = mapRef.current;
      map.contextmenu.removeAllItems();
      map.contextmenu.addItem({ text: 'Set as start', 
        callback: setRoutePoints(ctx.setStartPoint, null, ctx.startPoint, ctx.endPoint, ctx.setRouteData) });
      map.contextmenu.addItem({ text: 'Set as end',
        callback: setRoutePoints(null, ctx.setEndPoint, ctx.startPoint, ctx.endPoint, ctx.setRouteData)
      });
    }
  }, [ctx.startPoint, ctx.endPoint, ctx.setStartPoint, ctx.setEndPoint, mapRef, ctx.setRouteData]);
  
  return (
    <MapContainer center={position} zoom={5} className={classes.root} minZoom={1} maxZoom={20}
      zoomControl={false} whenReady={whenReadyHandler}
      contextmenu={true}
      contextmenuItems={[
      ]}
      >
      {ctx.routeData && <GeoJSON key={ctx.routeData.id} data={ctx.routeData.geojson} />}
      {hoverPoint // && <CircleMarker ref={hoverPointRef} center={hoverPoint} radius={5} pathOptions={{ color: 'blue' }} opacity={1} />
              && <Marker ref={hoverPointRef} position={hoverPoint} icon={MarkerIcon({ bg: 'yellow' })} /> }
      {ctx.startPoint && //<CircleMarker center={ctx.startPoint} radius={5} pathOptions={{ color: 'green' }} opacity={1}
          <Marker position={ctx.startPoint} icon={MarkerIcon({ bg: 'blue' })}
            ref={startPointRef} draggable={true} eventHandlers={startEventHandlers} />}
      {ctx.endPoint && <Marker position={ctx.endPoint} icon={MarkerIcon({ bg: 'red' })}
        ref={endPointRef} draggable={true} eventHandlers={endEventHandlers} />}
      <TileLayer
        ref={tileLayer}
        attribution='&amp;copy <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
        minZoom={1}
        maxZoom={20}
        maxNativeZoom={18}
        url={ctx.tileURL.url}
      />
      <LayersControl position="topright" collapsed={false}>
        {ctx.weatherLayers.map((item) => (
          <LayersControl.Overlay name={item.name} checked={item.checked} key={'overlay_' + item.key}>
            <TileLayer
              url={item.url}
              time={getWeatherTime(ctx.weatherDate)}
              tms={true}
              minZoom={1}
              opacity={item.opacity}
              maxNativeZoom={item.maxNativeZoom}
              maxZoom={item.maxZoom}
            />
          </LayersControl.Overlay>
        ))}
      </LayersControl>
      <ZoomControl position="bottomleft" />
      <MapContextMenu />
    </MapContainer>
  );
};
export default OsmAndMap;
