import React, { useState } from 'react';
import { makeStyles } from "@material-ui/core/styles";
import { MapContainer, TileLayer, ZoomControl, LayersControl } from "react-leaflet";


const useStyles = makeStyles((theme) => ({
  root: {
    width: "100%",
    height: "100%"
  },
}));
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

// var now_date = new Date();
// // "20211222_0600"
// const urlParams = new URLSearchParams(window.location.search);
// var weatherDateObj = new Date();
// if (urlParams.get('date')) {
//   var weather_date = urlParams.get('date');
//   weatherDateObj.setUTCFullYear(parseInt(weather_date.slice(0, 4)));
//   weatherDateObj.setUTCMonth(parseInt(weather_date.slice(4, 6)) - 1);
//   weatherDateObj.setUTCDate(parseInt(weather_date.slice(6, 8)));
//   weatherDateObj.setUTCHours(parseInt(weather_date.slice(9, 11)));
// }
// weatherDateObj.setUTCMinutes(0);
// weatherDateObj.setUTCSeconds(0);
// var originalDateObj = new Date(weatherDateObj);

const updateLayerFunc = (layers, updateLayers, enable) => (event) => {
  const ind = layers.findIndex(l => l.name === event.name);
  if (ind >= 0 && layers[ind].checked !== enable) {
    let newlayers = [...layers];
    newlayers[ind].checked = enable;
    updateLayers(newlayers);
  }  
}

const OsmAndMap = ({ tileURL, layers, updateLayers }) => {

  const classes = useStyles();


  const whenReadyHandler = event => {
    const { target } = event;
    target.on('overlayadd', updateLayerFunc(layers, updateLayers, true));
    target.on('overlayremove', updateLayerFunc(layers, updateLayers, false));
  }

  const weatherDate = new Date();
  // <TileLayer
  //   key="layer_white"
  //   url="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAQAAAAEAAQMAAABmvDolAAAAA1BMVEX///+nxBvIAAAAH0lEQVQYGe3BAQ0AAADCIPunfg43YAAAAAAAAAAA5wIhAAAB9aK9BAAAAABJRU5ErkJggg=="
  //   minZoom={1}
  //   maxZoom={18}
  // />
  return (
    <MapContainer center={position} zoom={5} className={classes.root} minZoom={1} maxZoom={21} 
        zoomControl={false} whenReady={whenReadyHandler}>
      <TileLayer
        attribution='&amp;copy <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
        minZoom={1}
        maxZoom={18}
        url={tileURL}
      />
        
      <LayersControl position="topright" collapsed={false}>
        {layers.map((item) => (
          <LayersControl.Overlay name={item.name} checked={item.checked} key={'overlay_' + item.key}>
            <TileLayer
              url={item.url}
              time={getWeatherTime(weatherDate)}
              tms={true}
              minZoom={1}
              opacity={item.opacity}
              maxNativeZoom={item.maxNativeZoom}
              maxZoom={item.maxZoom}
            />
          </LayersControl.Overlay>
          ))}
        
      </LayersControl>
      <ZoomControl position="bottomleft"/>
    </MapContainer>
  );
};
export default OsmAndMap;
