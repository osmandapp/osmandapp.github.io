import React, { useState } from 'react';
import {
  Air, Cloud, Compress, Shower, Thermostat
} from '@mui/icons-material';

// components
import OsmAndMapFrame from "./components/OsmAndMapFrame.js";


function getWeatherUrl(layer) {
  // const urlWeatherPefix = '.';
  const urlWeatherPefix = 'https://test.osmand.net/weather/gfs';
  return urlWeatherPefix + '/tiles/' + layer + '/{time}/{z}/{x}/{y}.png';
}
const layers = [
  { key: "temperature", name: "Temperature", opacity: 0.5, iconComponent: <Thermostat fontSize="small" /> },
  { key: "pressure", name: "Pressure", opacity: 0.6, iconComponent: <Compress fontSize="small" /> },
  { key: "wind", name: "Wind", opacity: 0.6, iconComponent: <Air fontSize="small" /> },
  { key: "cloud", name: "Cloud", opacity: 0.5, iconComponent: <Cloud fontSize="small" /> },
  { key: "precip", name: "Precipitation", opacity: 0.7, iconComponent: <Shower fontSize="small" /> },
];
layers.map((item) => {
  item.url = getWeatherUrl(item.key);
  item.maxNativeZoom = 3;
  item.maxZoom = 11;
  item.checked = false;
  return item;
});

const App = () => {
  //const classes = useStyles();
  const [weatherLayers, updateWeatherLayers] = useState(layers);
  // // "20211222_0600"
  // let [searchParams, setSearchParams] = useSearchParams();
  const searchParams = new URLSearchParams(window.location.search);
  let weatherDateObj = new Date();
  if (searchParams.get("date")) {
    let weather_date = searchParams.get("date");
    weatherDateObj.setUTCFullYear(parseInt(weather_date.slice(0, 4)));
    weatherDateObj.setUTCMonth(parseInt(weather_date.slice(4, 6)) - 1);
    weatherDateObj.setUTCDate(parseInt(weather_date.slice(6, 8)));
    weatherDateObj.setUTCHours(parseInt(weather_date.slice(9, 11)));
  }
  weatherDateObj.setUTCMinutes(0);
  weatherDateObj.setUTCSeconds(0);
  // var originalDateObj = new Date(weatherDateObj);
  const [weatherDate, setWeatherDate] = useState(weatherDateObj);

  return (
    <OsmAndMapFrame weatherLayers={weatherLayers} updateWeatherLayers={updateWeatherLayers}
        weatherDate={weatherDate} setWeatherDate={setWeatherDate} />
    
  );
};

export default App;