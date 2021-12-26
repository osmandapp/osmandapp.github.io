import React, { useState } from 'react';
import { Drawer, Toolbar, Typography, Box, ListItemText, Switch, Collapse } from "@material-ui/core";
import { IconButton, Divider, MenuItem, ListItemIcon, MenuList } from "@material-ui/core";
import {
    Menu, ArrowBack, Air, DirectionsWalk, ExpandLess, ExpandMore, Thermostat
 } from '@mui/icons-material';


const OToolbar = ({ weatherLayers, updateWeatherLayers}) => {
    const [drawerOpen, setDrawerOpen] = useState(false);
    const toggleDrawer = () => {
        setDrawerOpen(!drawerOpen);
    };
    const [weatherOpen, setWeatherOpen] = React.useState(false);
    const handleWeather = () => {
        setWeatherOpen(!weatherOpen);
    };
    return (
        <Toolbar variant="dense">
            <IconButton onClick={toggleDrawer}><Menu /></IconButton>
            <Drawer anchor="left" open={drawerOpen} onClose={toggleDrawer}>
                <Box
                    sx={{ width: 320, maxWidth: '100%' }}>
                    <MenuList>
                        <MenuItem onClick={toggleDrawer}>
                            <ListItemIcon>
                                <ArrowBack fontSize="small" />
                            </ListItemIcon>
                            <ListItemText>OsmAnd Web</ListItemText>
                        </MenuItem>
                        <Divider />
                        <MenuItem onClick={handleWeather}>
                            <ListItemIcon>
                                <Air fontSize="small" />
                            </ListItemIcon>
                            <ListItemText>Weather</ListItemText>
                            {weatherOpen ? <ExpandLess /> : <ExpandMore />}
                            
                        </MenuItem>
                        {weatherLayers.map((item, index) => (
                            <MenuItem key={item.key}>
                                <ListItemIcon>
                                    <Thermostat fontSize="small" />
                                </ListItemIcon>
                                <ListItemText>{item.name}</ListItemText>
                                <Switch
                                    checked={item.checked}
                                    onChange={(e) => {
                                        let newlayers = [...weatherLayers];
                                        newlayers[index].checked = e.target.checked;
                                        updateWeatherLayers(newlayers);
                                    }} />
                            </MenuItem>
                        ))}
                        <Collapse in={weatherOpen} timeout="auto" unmountOnExit>
                            
                            <Divider/>
                        </Collapse>
                        <MenuItem>
                            <ListItemIcon>
                                <DirectionsWalk fontSize="small" />
                            </ListItemIcon>
                            <ListItemText>Tracks</ListItemText>
                            <Typography variant="body2" color="textSecondary">
                                GPX
                            </Typography>
                        </MenuItem>
                    </MenuList>
                </Box>
            </Drawer>
            <Box sx={{ ml: 1 }}>
                <Typography variant="h6" color="inherit"  >
                    Welcome, OsmAnd developer
                </Typography>
            </Box>
        </Toolbar>
    );
};

export default OToolbar;