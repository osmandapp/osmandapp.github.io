import React, { useContext } from 'react';
import { Toolbar, Typography, ListItemText, } from "@mui/material";
import {
    Divider, MenuItem, ListItemIcon, MenuList 
} from "@mui/material";
import { ArrowBack, Person } from '@mui/icons-material';
import AppContext from "../context/AppContext"
import Weather from "./drawer/Weather"
import CloudGpx from "./drawer/CloudGpx"
import LocalGpx from "./drawer/LocalGpx"
import { useNavigate } from "react-router-dom";



export default function OsmAndDrawer({ mobile, toggleDrawer,
    appText, setAppText, setShowInfo }) {
    const ctx = useContext(AppContext);
    
    // setAppText(ctx.gpxFiles.localInfoSummary);
    const navigate = useNavigate();
    const openLogin = () => {
        navigate('/map/loginForm');
    }
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

                <MenuItem onClick={openLogin}>
                    <ListItemIcon>
                        <Person fontSize="small" />
                    </ListItemIcon>
                    {ctx.loginUser ? <Typography color="inherit">{ctx.loginUser}</Typography> :
                        <Typography variant="h6" color="inherit">Login</Typography>}
                </MenuItem>

            }
        </Toolbar>
        <Divider />
        <MenuList>
            <Weather setAppText={setAppText} />
            <CloudGpx setAppText={setAppText} />
            <LocalGpx setAppText={setAppText} setShowInfo={setShowInfo}/>
        </MenuList>
    </>
    );
}