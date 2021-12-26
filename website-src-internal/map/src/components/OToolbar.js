import React, { useState } from 'react';
import { Drawer, Toolbar, Typography, Box, ListItemText, Switch, Collapse } from "@mui/material";
import { IconButton, Divider, MenuItem, ListItemIcon, MenuList, AppBar, CssBaseline } from "@mui/material";
import {
    Menu, ArrowBack, Air, DirectionsWalk, ExpandLess, ExpandMore, Thermostat
} from '@mui/icons-material';


const OToolbar = ({ weatherLayers, updateWeatherLayers }) => {
    const [drawerOpen, setDrawerOpen] = useState(false);
    const toggleDrawer = () => {
        setDrawerOpen(!drawerOpen);
    };
    const [weatherOpen, setWeatherOpen] = React.useState(false);
    const handleWeather = () => {
        setWeatherOpen(!weatherOpen);
    };
    const drawerWidth = 320;
    const drawer = (mobile) => (
        <div>
            <Toolbar variant="dense">
                {mobile ?
                    <MenuItem onClick={toggleDrawer}>
                        <ListItemIcon>
                            <ArrowBack fontSize="small" />
                        </ListItemIcon>
                        <ListItemText>OsmAnd Mobile</ListItemText>
                    </MenuItem>
                    :
                    <Typography variant="h6" color="inherit"  >
                        OsmAnd web
                    </Typography>
                }
            </Toolbar>
            <Divider />
            <MenuList>
                <MenuItem onClick={handleWeather}>
                    <ListItemIcon>
                        <Air fontSize="small" />
                    </ListItemIcon>
                    <ListItemText>Weather</ListItemText>
                    {weatherOpen ? <ExpandLess /> : <ExpandMore />}
                </MenuItem>

                <Collapse in={weatherOpen} timeout="auto" unmountOnExit>
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
                    <Divider />
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
        </div>
    );
    const container = window !== undefined ? () => window.document.body : undefined;
    return (
        <AppBar position="static"
            sx={{
                width: { sm: `calc(100% - ${drawerWidth}px)` },
                ml: { sm: `${drawerWidth}px` }
            }}>
            <Toolbar variant="dense" >
                <IconButton onClick={toggleDrawer}
                    edge="start"
                    sx={{ mr: 2, display: { sm: "none" } }}>
                    <Menu />
                </IconButton>
                <Box sx={{ ml: 1 }}>
                    <Typography variant="h6" color="inherit"  >
                        Welcome, OsmAnd developer
                    </Typography>
                </Box>
            </Toolbar>
            {
                //<Box
                //  component="nav"
                // sx={{ width: { sm: drawerWidth }, flexShrink: { sm: 0 } }}
                //>
            }
            <Drawer
                //  container={container}
                variant="temporary"
                open={drawerOpen}
                onClose={toggleDrawer}
                ModalProps={{
                    keepMounted: true, // Better open performance on mobile.
                }}
                sx={{
                    display: { xs: 'block', sm: 'none' },
                    '& .MuiDrawer-paper': { boxSizing: 'border-box', width: drawerWidth },
                }}
            >
                {drawer(true)}
            </Drawer>
            <Drawer
                variant="permanent"
                sx={{
                    display: { xs: 'none', sm: 'block' },
                    '& .MuiDrawer-paper': { boxSizing: 'border-box', width: drawerWidth },
                }}
                open>
                {drawer(false)}
            </Drawer>
        </AppBar>

    );
};

export default OToolbar;