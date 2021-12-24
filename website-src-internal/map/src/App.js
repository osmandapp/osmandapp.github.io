import React, { useRef, useState } from 'react';
import { makeStyles } from "@material-ui/core/styles";
import AppBar from "@material-ui/core/AppBar";
import Toolbar from "@material-ui/core/Toolbar";

// components
import OsmAndMap from "./components/OsmAndMap";
import { Drawer, Button, Box, Typography, ListItem, ListItemText, List } from "@material-ui/core";
import { IconButton, Divider } from "@material-ui/core";
import MenuIcon from '@mui/icons-material/Menu';

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
  const [drawerOpen, setDrawerOpen] = useState(false);
  const toggleDrawer = () => {
    setDrawerOpen(!drawerOpen);
  };

  // <toggleDrawer("left", true)}
  // <Drawer anchor="left" open={state["left"]} onClose={toggleDrawer("left", false)}>left</Drawer>
  // const onButtonClick = ;
  return (
    <Box className={classes.root}>
      <AppBar position="static">
        <Toolbar variant="dense">
          <IconButton onClick={toggleDrawer}><MenuIcon /></IconButton>
          
          <Drawer anchor="left" open={drawerOpen} onClose={toggleDrawer}>
            <Toolbar
              sx={{
                display: 'flex',
                alignItems: 'center',
                justifyContent: 'flex-end',
                px: [1],
              }}>
              <IconButton onClick={toggleDrawer}><MenuIcon /></IconButton>
            </Toolbar>
            <Divider />
            <List>
              <ListItem button>
                <ListItemText primary="Weather" />
              </ListItem>
              <ListItem button>
                <ListItemText primary="GPX" />
              </ListItem>
            </List>
          </Drawer>
          <Typography variant="h6" color="inherit">
            Welcome, OsmAnd developer
          </Typography>
        </Toolbar>
      </AppBar>
      <OsmAndMap tileURL="https://tile.osmand.net/hd/{z}/{x}/{y}.png">
      </OsmAndMap>
    </Box>
  );
};

export default App;