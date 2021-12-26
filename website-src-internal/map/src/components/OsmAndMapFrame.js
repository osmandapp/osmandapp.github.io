import React, { useState } from 'react';
import { Drawer, Toolbar, Typography, Box } from "@mui/material";
import {
    IconButton, AppBar
} from "@mui/material";
import {
    Menu
} from '@mui/icons-material';
import LoginDialog from './LoginDialog';
import OsmAndMap from './OsmAndMap';
import OsmAndDrawer from './OsmAndDrawer';



const OsmAndMapFrame = ({ weatherLayers, updateWeatherLayers, weatherDate, setWeatherDate }) => {
    const [drawerOpen, setDrawerOpen] = useState(false);
    const toggleDrawer = () => {
        setDrawerOpen(!drawerOpen);
    };
    const drawerWidth = 320;
    const [loginDialog, setLoginDialog] = React.useState(false);
    const [appText, setAppText] = useState(null);
    return (
        <>
            <Box sx={{
                width: { sm: `calc(100% - ${drawerWidth}px)` },
                ml: { sm: `${drawerWidth}px` },
                height: "100vh",
                display: "flex",
                flexDirection: "column",
            }}>
                <LoginDialog open={loginDialog} setOpen={setLoginDialog} />
                <AppBar position="static">
                    <Toolbar variant="dense" >
                        <IconButton onClick={toggleDrawer}
                            edge="start"
                            sx={{ mr: 2, display: { sm: "none" } }}>
                            <Menu />
                        </IconButton>
                        <Box sx={{ ml: 1 }}>
                            <Typography variant="h6" color="inherit" >
                                {appText ? appText : 'Welcome, OsmAnd developer.'}
                            </Typography>
                        </Box>
                    </Toolbar>
                </AppBar>
                <OsmAndMap tileURL="https://tile.osmand.net/hd/{z}/{x}/{y}.png" layers={weatherLayers}
                    updateLayers={updateWeatherLayers} weatherDate={weatherDate}>
                </OsmAndMap>
            </Box>
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
                <OsmAndDrawer mobile={true} setLoginDialog={setLoginDialog}
                    toggleDrawer={toggleDrawer}
                    weatherLayers={weatherLayers} updateWeatherLayers={updateWeatherLayers}
                    weatherDate={weatherDate} setWeatherDate={setWeatherDate}  
                    appText={appText} setAppText={setAppText}/>
            </Drawer>
            <Drawer
                variant="permanent"
                sx={{
                    display: { xs: 'none', sm: 'block' },
                    '& .MuiDrawer-paper': { boxSizing: 'border-box', width: drawerWidth },
                }}
                open>
                <OsmAndDrawer mobile={false} setLoginDialog={setLoginDialog}
                    weatherLayers={weatherLayers} updateWeatherLayers={updateWeatherLayers} 
                    weatherDate={weatherDate} setWeatherDate={setWeatherDate}
                    appText={appText} setAppText={setAppText} />
            </Drawer>
        </>

    );
};

export default OsmAndMapFrame;