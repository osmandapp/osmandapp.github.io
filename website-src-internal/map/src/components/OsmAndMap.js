import React, { useState } from 'react';
import { makeStyles } from "@material-ui/core/styles";
import { MapContainer, TileLayer, Marker, Popup, ZoomControl, LayersControl } from "react-leaflet";


const useStyles = makeStyles((theme) => ({
  root: {
    width: "100%",
    height: "100%"
  },
}));
// initial location on map
const position = [50, 5];
// sample locations
const locations = [
  {
    title: "Kiyv",
    description: "Ksenia + Dima",
    coordinates: [50.4434, 30.5119],
  },
  {
    title: "Vinnitsya",
    description: "Ivan",
    coordinates: [49.2378, 28.4709],
  },
  {
    title: "Amsterdam",
    description: "Victor",
    coordinates: [52.3590, 4.8952],
  }
];



// function getTime() {
//   let h = weatherDateObj.getUTCHours();
//   if (h < 10) {
//     h = '0' + h;
//   }
//   let m = weatherDateObj.getUTCMonth() + 1;
//   if (m < 10) {
//     m = '0' + m;
//   }
//   let d = weatherDateObj.getUTCDate();
//   if (d < 10) {
//     d = '0' + d;
//   }
//   const layer_date = weatherDateObj.getUTCFullYear() + '' + m + '' + d + "_" + h + "00";
//   return layer_date;
// }

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
// //var prefix = '.';
// var prefix = 'https://test.osmand.net/weather/gfs';
// const nativeMaxZoom = 3;
// const maxScaleZoom = 11;
// function getUrl(layer) {
//   return prefix + '/tiles/' + layer + '/{time}/{z}/{x}/{y}.png';
// }
// var temperature = L.tileLayer(getUrl('temperature'), { time: getTime(), tms: true, opacity: 0.5, attribution: "", minZoom: 1, maxNativeZoom: nativeMaxZoom, maxZoom: maxScaleZoom });
// var pressure = L.tileLayer(getUrl('pressure'), { time: getTime(), tms: true, opacity: 0.6, attribution: "", minZoom: 1, maxNativeZoom: nativeMaxZoom, maxZoom: maxScaleZoom });
// var wind = L.tileLayer(getUrl('wind'), { time: getTime(), tms: true, opacity: 0.6, attribution: "", minZoom: 1, maxNativeZoom: nativeMaxZoom, maxZoom: maxScaleZoom });
// var cloud = L.tileLayer(getUrl('cloud'), { time: getTime(), tms: true, opacity: 0.5, attribution: "", minZoom: 1, maxNativeZoom: nativeMaxZoom, maxZoom: maxScaleZoom });
// var precip = L.tileLayer(getUrl('precip'), { time: getTime(), tms: true, opacity: 0.7, attribution: "", minZoom: 1, maxNativeZoom: nativeMaxZoom, maxZoom: maxScaleZoom });
// var overlaymaps = { "Temperature": temperature, "Pressure": pressure, "Wind": wind, "Cloud": cloud, "Precipitation": precip }
const OsmAndMap = ({ tileURL }) => {

  const [count, setCount] = useState(0);
  const classes = useStyles();
  // return (<div>
  //   <p>You clicked {count} times</p>
  //   <button onClick={() => setCount(count + 1)}>
  //     Click me
  //   </button>
  // </div>);
  return (
    <MapContainer center={position} zoom={5} className={classes.root} minZoom={1} maxZoom={21} zoomControl={false}>
      <LayersControl position="topright" collapsed={false}>
        <LayersControl.BaseLayer checked name="OpenStreetMap">
          <TileLayer
            key="layer_osm"
            attribution='&amp;copy <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
            minZoom={1}
            maxZoom={18}
            url={tileURL}
          />
        </LayersControl.BaseLayer>
        <LayersControl.BaseLayer name="Without background">
          <TileLayer
            key="layer_white"
            url="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAQAAAAEAAQMAAABmvDolAAAAA1BMVEX///+nxBvIAAAAH0lEQVQYGe3BAQ0AAADCIPunfg43YAAAAAAAAAAA5wIhAAAB9aK9BAAAAABJRU5ErkJggg=="
            minZoom={1}
            maxZoom={18}
          />
        </LayersControl.BaseLayer>
      </LayersControl>
      <ZoomControl position="bottomleft" />
      {locations.map((item) => (
        <Marker key={item.title} position={item.coordinates}>
          <Popup>
            <h1>{item.title}</h1>
            <p>{item.description}</p>
          </Popup>
        </Marker>
      ))}
    </MapContainer>
  );
};
export default OsmAndMap;
