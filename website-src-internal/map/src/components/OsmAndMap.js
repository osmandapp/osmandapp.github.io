import React, {useEffect, useRef, useContext, useState} from 'react';
import { makeStyles } from "@material-ui/core/styles";
import {MapContainer, TileLayer, ZoomControl, LayersControl, CircleMarker} from "react-leaflet";
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
// initial location on map
const position = [50, 5];

// TODO implement in react way?
let points = [];
// TODO implement in react way?
let hoverMarker = null;
// TODO implement in react way?
let geoJson = null;

// TODO move to constants
const startMarkerIcon = MarkerIcon({ bg: 'blue' });
const endMarkerIcon = MarkerIcon({ bg: 'red' });
const wptMarkerIcon = MarkerIcon({ bg: 'yellow' });

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

async function calcRoute(startPoint, endPoint, map) {
  // encodeURIComponent(startPoint.lat)
  const starturl = `points=${startPoint.lat.toFixed(6)},${startPoint.lng.toFixed(6)}`;
  const endurl = `points=${endPoint.lat.toFixed(6)},${endPoint.lng.toFixed(6)}`;
  const response = await fetch(`/routing/route?${starturl}&${endurl}`, {
    method: 'GET',
    headers: { 'Content-Type': 'application/json' }
  });
  if (response.ok) {
    let data = await response.json();
    if (geoJson) {
      map.removeLayer(geoJson);
    }
    geoJson = L.geoJSON(data).addTo(map);
  }
}
const setRoutePoints = (setStartPoint, setEndPoint, startPoint, endPoint, map) => (e) => {
  if (setStartPoint) {
    setStartPoint(e.latlng);
    startPoint = e.latlng;
  } else if (setEndPoint) {
    setEndPoint(e.latlng);
    endPoint = e.latlng;
  }
  if (startPoint && endPoint) {
    calcRoute(startPoint, endPoint, map)
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

function getPoints(e) {
  let trackPoints = Object.values(e.layers._layers)[0]._latlngs;
  let result = []

  trackPoints.forEach((point) => {
    let pointObj = {
      lat: point.lat,
      lng: point.lng
      // if need distFromStart:e.target._info.elevation._points[index][0]
    }
    result.push(pointObj);
  })
  return result;
}

function addTrackToMap(file, map) {
  //file.gpx = new L.GPX(file.url, {
  return new L.GPX(file.url, {
    async: true,
    marker_options: {
      startIcon: startMarkerIcon,
      endIcon: endMarkerIcon,
      wptIcons: {
        '': wptMarkerIcon,
      },
    }
  }).on('loaded', function (e) {
    points.splice(0, points.length)
    points.push(getPoints(e));
    map.current.fitBounds(e.target.getBounds());  
  }).addTo(map.current);
}

function removeTrackFromMap(file, map) {
  map.current.removeLayer(file.gpx);
  file.gpx = null;
}

const updateMarker = (map) => (lat, lng) => {
  if (lat) {
    if (hoverMarker) {
      hoverMarker.setLatLng([lat, lng]).update();
    } else {
      hoverMarker = new L.Marker({ lat, lng }, { icon: startMarkerIcon }).addTo(map);
    }
  } else if (hoverMarker) {
    map.removeLayer(hoverMarker);
  }
}

const OsmAndMap = () => {

  const classes = useStyles();
  const mapRef = useRef(null);
  const tileLayer = useRef(null);
  let hash = null;
  const ctx = useContext(AppContext);

  const [startPoint, setStartPoint] = useState(null);
  const [endPoint, setEndPoint] = useState(null);

  const whenReadyHandler = event => {
    const { target: map } = event;
    map.on('overlayadd', updateLayerFunc(ctx.weatherLayers, ctx.updateWeatherLayers, true));
    map.on('overlayremove', updateLayerFunc(ctx.weatherLayers, ctx.updateWeatherLayers, false));
    map.attributionControl.setPrefix('');
    hash = new L.Hash(map);
    mapRef.current = map;
    if (!ctx.mapMarkerListener) {
      ctx.setMapMarkerListener(() => updateMarker(map));
    }
    // map.on('contextmenu', (e) => {
    //   L.popup()
    //     .setLatLng(e.latlng)
    //     .setContent('<div>Hello ??</div>')
    //     .openOn(map);
    // });
  }
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
    // var gpx = 'https://www.openstreetmap.org/trace/4020415/data'; // URL to your GPX file or the GPX itself
    let filesMap = ctx.gpxFiles ? ctx.gpxFiles : {} ;
    Object.values(filesMap).forEach((file) => {
      if (file.url && !file.gpx) {
        file.gpx = addTrackToMap(file, mapRef);
        file.points = points;
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
        callback: setRoutePoints(setStartPoint, null, startPoint, endPoint, map) });
      map.contextmenu.addItem({
         text: 'Set as end',
        callback: setRoutePoints(null, setEndPoint, startPoint, endPoint, map)
      });
    }
  }, [startPoint, endPoint, mapRef]);
  
  return (
    <MapContainer center={position} zoom={5} className={classes.root} minZoom={1} maxZoom={20}
      zoomControl={false} whenReady={whenReadyHandler}
      contextmenu={true}
      contextmenuItems={[
      ]}
      >
      {startPoint && <CircleMarker center={startPoint} radius={5} pathOptions={{ color: 'green' }} opacity={1}/>}
      {endPoint && <CircleMarker center={endPoint} radius={5} pathOptions={{ color: 'red' }} opacity={1}/>}
      <TileLayer
        ref={tileLayer}
        attribution='&amp;copy <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
        minZoom={1}
        maxZoom={20}
        maxNativeZoom={18}
        url={ctx.tileURL.url}
      />
      {/* {ctx.selectedPoint && ctx.selectedGpxFile && ctx.selectedPoint.lat !== undefined && ctx.selectedPoint.lng !== undefined
      && <Marker position={[ctx.selectedPoint.lat, ctx.selectedPoint.lng]}/>} */}
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
