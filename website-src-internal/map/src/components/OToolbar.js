import React, { useRef, useState } from 'react';
import { Drawer, Toolbar, Typography, Box, ListItemText } from "@material-ui/core";
import { IconButton, Divider, MenuItem, ListItemIcon, MenuList } from "@material-ui/core";
import {
    Menu, ContentCopy, ContentPaste, ContentCut, ArrowBack, Air, DirectionsWalk
 } from '@mui/icons-material';


const OToolbar = () => {
    const [drawerOpen, setDrawerOpen] = useState(false);
    const toggleDrawer = () => {
        setDrawerOpen(!drawerOpen);
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
                        <MenuItem>
                            <ListItemIcon>
                                <Air fontSize="small" />
                            </ListItemIcon>
                            <ListItemText>Weather</ListItemText>
                            <Typography variant="body2" color="textSecondary">
                                Map
                            </Typography>
                        </MenuItem>
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