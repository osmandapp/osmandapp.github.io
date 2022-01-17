import React, {useEffect, useRef, useContext, useState} from 'react';
import { makeStyles } from "@material-ui/core/styles";
import {MapContainer, TileLayer, ZoomControl, LayersControl, Marker} from "react-leaflet";
import AppContext from "../context/AppContext";
import MapContextMenu from "./MapContextMenu"
import L from 'leaflet';
import 'leaflet-gpx';
import 'leaflet-hash';
import 'leaflet.awesome-markers';
import 'leaflet.awesome-markers/dist/leaflet.awesome-markers.css';
import 'ionicons/css/ionicons.min.css'

const useStyles = makeStyles((theme) => ({
  root: {
    width: "100%",
    height: "100%"
  },
}));
// initial location on map
const position = [50, 5];

let points = [];

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

function getPoints(e) {
  let trackPoints = Object.values(e.layers._layers)[0]._latlngs;
  let result = []

  trackPoints.map((point, index) => {
    let pointObj = {
      lat: point.lat,
      lng: point.lng
      // if need distFromStart:e.target._info.elevation._points[index][0]
    }
    result.push(pointObj);
  })
  return result;
}

function addTrackToMap(file, map, setPoints) {
  // let ico = L.icon({
  //   iconUrl: 'graphic/tank.png',
  //   iconSize: [18, 9], //size of the icon in pixels
  //   iconAnchor: [9, 9], //point of the icon which will correspond to marker's location(the center)
  //   popupAnchor: [0, 0] //point from which the popup should open relative tothe iconAnchor
  // });


  let startMarker = L.AwesomeMarkers.icon({
    icon: 'home',
    prefix: 'ion',
    markerColor: 'blue',
    iconColor: 'white'
  });

  let endMarker = L.AwesomeMarkers.icon({
    icon: 'checkmark',
    prefix: 'ion',
    markerColor: 'blue',
    iconColor: 'white'
  });

  let wptMarker = new L.AwesomeMarkers.icon({
    icon: 'checkmark',
    prefix: 'ion',
    markerColor: 'blue',
    iconColor: 'white'
  });

  //file.gpx = new L.GPX(file.url, {

  return new L.GPX(file.url, {
    async: true,
    marker_options: {
      startIcon: startMarker,
      endIcon: endMarker,
      wptIcons: {
        '': wptMarker,
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

const OsmAndMap = () => {

  const classes = useStyles();
  const mapRef = useRef(null);
  const tileLayer = useRef(null);

  const ctx = useContext(AppContext);

  const whenReadyHandler = event => {
    const { target: map } = event;
    map.on('overlayadd', updateLayerFunc(ctx.weatherLayers, ctx.updateWeatherLayers, true));
    map.on('overlayremove', updateLayerFunc(ctx.weatherLayers, ctx.updateWeatherLayers, false));
    map.attributionControl.setPrefix('');
    var hash = new L.Hash(map);
    // console.log(hash);
    // L.marker([], {
    //   icon: ico
    // })
    // L.marker([50.5, 5.5], { icon2: icon }).addTo(target);
    mapRef.current = map;
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
  }, [ctx.gpxFiles]);
  // <TileLayer
  //   key="layer_white"
  //   url="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAQAAAAEAAQMAAABmvDolAAAAA1BMVEX///+nxBvIAAAAH0lEQVQYGe3BAQ0AAADCIPunfg43YAAAAAAAAAAA5wIhAAAB9aK9BAAAAABJRU5ErkJggg=="
  //   minZoom={1}
  //   maxZoom={18}
  // />
  useEffect(() => {
    if (tileLayer.current) {
      tileLayer.current.setUrl(ctx.tileURL.url);
    }
  }, [ctx.tileURL]);
  return (
    <MapContainer center={position} zoom={5} className={classes.root} minZoom={1} maxZoom={20}
      zoomControl={false} whenReady={whenReadyHandler}
      >
      <TileLayer
        ref={tileLayer}
        attribution='&amp;copy <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
        minZoom={1}
        maxZoom={20}
        maxNativeZoom={18}
        url={ctx.tileURL.url}
      />
      {ctx.selectedPoint && ctx.selectedGpxFile && ctx.selectedPoint.lat !== undefined && ctx.selectedPoint.lng !== undefined
      && <Marker position={[ctx.selectedPoint.lat, ctx.selectedPoint.lng]}/>}
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
