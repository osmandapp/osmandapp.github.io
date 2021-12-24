import React from "react";
import { makeStyles } from "@material-ui/core/styles";
import AppBar from "@material-ui/core/AppBar";
import Toolbar from "@material-ui/core/Toolbar";
import Typography from "@material-ui/core/Typography";
import Box from "@material-ui/core/Box";
import Container from "@material-ui/core/Container";

// components
import OsmAndMap from "./components/OsmAndMap";

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
        <Toolbar variant="dense">
          <Typography variant="h6" color="inherit">
            Welcome, OsmAnd developer 
          </Typography>
        </Toolbar>
      </AppBar>
      <OsmAndMap>
      </OsmAndMap>
      
    </Box>
  );
};

export default App;