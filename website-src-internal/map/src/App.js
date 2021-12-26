import React, { useState } from 'react';
import { makeStyles } from "@material-ui/core/styles";
import { Box} from "@mui/material";
import {
   Air, Cloud, Compress, DirectionsWalk, Shower, Thermostat
} from '@mui/icons-material';

// components
import OsmAndMap  from "./components/OsmAndMap.js";
import OToolbar from "./components/OToolbar.js";


const useStyles = makeStyles((theme) => ({
  root: {
    //flexGrow: 1
    display: "flex",
    flexDirection: "column",
    height: "100vh"
  },
  menuButton: {
    marginRight: theme.spacing(1),
  },
}));


function getWeatherUrl(layer) {
  // const urlWeatherPefix = '.';
  const urlWeatherPefix = 'https://test.osmand.net/weather/gfs';
  return urlWeatherPefix + '/tiles/' + layer + '/{time}/{z}/{x}/{y}.png';
}
const layers = [
  { key: "temperature", name: "Temperature", opacity: 0.5, iconComponent: <Thermostat fontSize="small" />},
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
  const classes = useStyles();
  const [weatherLayers, updateWeatherLayers] = useState(layers);
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
  const [weatherDate, setWeatherDate] = useState(new Date());

  return (
    <Box className={classes.root}>
      <OToolbar weatherLayers={weatherLayers} updateWeatherLayers={updateWeatherLayers}
        weatherDate={weatherDate} setWeatherDate={setWeatherDate}/>
      <OsmAndMap tileURL="https://tile.osmand.net/hd/{z}/{x}/{y}.png" layers={weatherLayers}
        updateLayers={updateWeatherLayers} weatherDate={weatherDate}>
      </OsmAndMap>
    </Box>
  );
};

export default App;