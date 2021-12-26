import React, { useState } from 'react';
import { makeStyles } from "@material-ui/core/styles";
import AppBar from "@material-ui/core/AppBar";
import { Box } from "@material-ui/core";

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
  { key: "temperature", name: "Temperature", opacity: 0.5 },
  { key: "pressure", name: "Pressure", opacity: 0.6 },
  { key: "wind", name: "Wind", opacity: 0.6 },
  { key: "cloud", name: "Cloud", opacity: 0.5 },
  { key: "precip", name: "Precipitation", opacity: 0.7 },
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

  return (
    <Box className={classes.root}>
      <AppBar position="static">
        <OToolbar weatherLayers={weatherLayers} updateWeatherLayers={updateWeatherLayers}/>
      </AppBar>
      <OsmAndMap tileURL="https://tile.osmand.net/hd/{z}/{x}/{y}.png" layers={weatherLayers}
        updateLayers={updateWeatherLayers}>
      </OsmAndMap>
    </Box>
  );
};

export default App;