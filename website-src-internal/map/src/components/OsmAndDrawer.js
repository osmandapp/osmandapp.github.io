import React, { useEffect, useState, useContext } from 'react';
import { Toolbar, Typography, ListItemText, } from "@mui/material";
import {
    IconButton, Divider, MenuItem, ListItemIcon, MenuList, Tooltip, 
} from "@mui/material";
import {
    ArrowBack, DirectionsWalk, ExpandLess, ExpandMore, Person, Sort, SortByAlpha
} from '@mui/icons-material';
import AppContext from "../context/AppContext"
import Weather from "./drawer/Weather"
import CloudGpx from "./drawer/CloudGpx"
import LocalGpx from "./drawer/LocalGpx"


export default function OsmAndDrawer({ mobile, toggleDrawer,
    appText, setAppText, setLoginDialog }) {
    const ctx = useContext(AppContext);
    
    // setAppText(ctx.gpxFiles.localInfoSummary);
    return (<>
        <Toolbar variant="dense">
            {mobile ?
                <MenuItem onClick={toggleDrawer}>
                    <ListItemIcon>
                        <ArrowBack fontSize="small" />
                    </ListItemIcon>
                    <ListItemText>OsmAnd Mobile</ListItemText>
                </MenuItem>
                :

                <MenuItem onClick={() => setLoginDialog(true)}>
                    <ListItemIcon>
                        <Person fontSize="small" />
                    </ListItemIcon>
                    {ctx.loginUser ? 
                        <Typography color="inherit">{ctx.loginUser}</Typography>
                    :
                    <Typography variant="h6" color="inherit">Login</Typography>
                    }
                </MenuItem>

            }
        </Toolbar>
        <Divider />
        <MenuList>
            <Weather setAppText={setAppText} />
            <CloudGpx setAppText={setAppText} />
            <LocalGpx setAppText={setAppText} />
        </MenuList>
    </>
    );
}