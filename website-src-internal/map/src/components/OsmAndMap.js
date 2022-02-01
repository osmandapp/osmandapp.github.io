import React, {useEffect, useRef, useContext, useState, useMemo, useCallback} from 'react';
import { makeStyles } from "@material-ui/core/styles";
import { MapContainer, TileLayer, ZoomControl, LayersControl, CircleMarker, Marker, GeoJSON} from "react-leaflet";
import AppContext from "../context/AppContext";
import MapContextMenu from "./MapContextMenu"
import RouteLayer from "./layers/RouteLayer"
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

 
  return (
    <MapContainer center={position} zoom={5} className={classes.root} minZoom={1} maxZoom={20}
      zoomControl={false} whenReady={whenReadyHandler}
      contextmenu={true}
      contextmenuItems={[
      ]}
      >
      <RouteLayer />
      {hoverPoint // && <CircleMarker ref={hoverPointRef} center={hoverPoint} radius={5} pathOptions={{ color: 'blue' }} opacity={1} />
              && <Marker ref={hoverPointRef} position={hoverPoint} icon={MarkerIcon({ bg: 'yellow' })} /> }
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
