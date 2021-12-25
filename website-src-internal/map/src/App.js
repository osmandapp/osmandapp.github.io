import React, { useRef, useState } from 'react';
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
    marginRight: theme.spacing(2),
  },
}));

const App = () => {
  const classes = useStyles();
  return (
    <Box className={classes.root}>
      <AppBar position="static">
        <OToolbar/>
      </AppBar>
      <OsmAndMap tileURL="https://tile.osmand.net/hd/{z}/{x}/{y}.png">
      </OsmAndMap>
    </Box>
  );
};

export default App;