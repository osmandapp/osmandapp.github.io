import React, { useEffect, useState, useContext } from 'react';
import { Toolbar, Typography, ListItemText, Switch, Collapse } from "@mui/material";
import {
    IconButton, Divider, MenuItem, ListItemIcon, MenuList, Tooltip, 
} from "@mui/material";
import {
    ArrowBack, Air, DirectionsWalk, ExpandLess, ExpandMore,
    Thermostat, NavigateNext, NavigateBefore, Person
} from '@mui/icons-material';
import AppContext from "../context/AppContext"

const addWeatherHours = (weatherDate, setWeatherDate, hours) => (event) => {
    let dt = new Date(weatherDate.getTime() + (hours * 60 * 60 * 1000));
    setWeatherDate(dt);
}

const switchLayer = (ctx, index) => (e) => {
    let newlayers = [...ctx.weatherLayers];
    newlayers[index].checked = e.target.checked;
    ctx.updateWeatherLayers(newlayers);
}
function formatWeatherDate(weatherDateObj) {
    let hours = (-(new Date().getTime() - weatherDateObj.getTime()) / 3600000).toFixed(0);
    if (hours === 0) {
        hours = "now";
    } else {
        if (hours > 0) {
            hours = "+" + hours;
        }
        hours += " hours";
    }
    let text = weatherDateObj.toDateString() + "  " + weatherDateObj.getHours() + ":00 [" + hours + "]";
    return text;
}

export default function OsmAndDrawer({ mobile, toggleDrawer,
    appText, setAppText, setLoginDialog }) {
    const ctx = useContext(AppContext);
    const [weatherOpen, setWeatherOpen] = useState(false);
    const [gpxOpen, setGpxOpen] = useState(false);
    useEffect(() => {
        if (weatherOpen) {
            setAppText(formatWeatherDate(ctx.weatherDate));
        } else {
            setAppText(null);
        }
    });
    let gpxFiles = (!ctx.listFiles || !ctx.listFiles.uniqueFiles ? [] : 
        ctx.listFiles.uniqueFiles).filter((item) => { 
            return (item.type == 'gpx' || item.type == 'GPX') 
                && (item.name.slice(-4) == '.gpx' || item.name.slice(-4) == '.GPX'); });

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
            <MenuItem onClick={() => setWeatherOpen(!weatherOpen)}>
                <ListItemIcon>
                    <Air fontSize="small" />
                </ListItemIcon>
                <ListItemText>Weather</ListItemText>
                {weatherOpen ? <ExpandLess /> : <ExpandMore />}
            </MenuItem>

            <Collapse in={weatherOpen} timeout="auto" unmountOnExit>
                {ctx.weatherLayers.map((item, index) => (
                    <MenuItem key={item.key} >
                        <ListItemIcon sx={{ ml: 2 }}>
                            {item.iconComponent ?
                                item.iconComponent :
                                <Thermostat fontSize="small" />
                            }
                        </ListItemIcon>
                        <ListItemText>{item.name}</ListItemText>
                        <Switch
                            checked={item.checked}
                            onChange={switchLayer(ctx, index)} />
                    </MenuItem>
                ))}
                <MenuItem disableRipple={true}>
                    <IconButton sx={{ml:1}} onClick={addWeatherHours(ctx.weatherDate, ctx.setWeatherDate, -1)}>
                        <NavigateBefore />
                    </IconButton>
                    <Typography>{ctx.weatherDate.toLocaleDateString() + " " + ctx.weatherDate.getHours() + ":00"}</Typography>
                    <IconButton onClick={addWeatherHours(ctx.weatherDate, ctx.setWeatherDate, 1)} >
                        <NavigateNext />
                    </IconButton>
                </MenuItem>

                <Divider />
            </Collapse>
            <MenuItem onClick={(e) => setGpxOpen(!gpxOpen)}>
                <ListItemIcon>
                    <DirectionsWalk fontSize="small" />
                </ListItemIcon>
                <ListItemText>Tracks {gpxFiles.length > 0 ? `(${gpxFiles.length})`:''} </ListItemText>
                <Typography variant="body2" color="textSecondary">
                    GPX
                </Typography>
                {
                    gpxFiles.length == 0 ? <></> :
                    gpxOpen ? <ExpandLess /> : <ExpandMore />
                }
            </MenuItem>

            <Collapse in={gpxOpen} timeout="auto" unmountOnExit>
                {gpxFiles.map((item, index) => (
                    <MenuItem key={item.name}>
                        <Tooltip title={item.name}>
                        <ListItemText inset>
                            <Typography variant="inherit" noWrap>
                                {item.name.slice(0, -4).replace('_', ' ')}
                            </Typography>
                        </ListItemText>
                        </Tooltip>
                        <Switch
                            checked={ctx.gpxFiles[item.name]?.url ? true : false}
                            onChange={(e) => {
                                let url = `/map/api/download-file?type=${encodeURIComponent(item.type)}&name=${encodeURIComponent(item.name)}`;
                                const newGpxFiles = Object.assign({}, ctx.gpxFiles);
                                if (!e.target.checked) {
                                    // delete newGpxFiles[item.name];
                                    newGpxFiles[item.name].url = null;
                                } else {
                                    newGpxFiles[item.name] = {
                                        'url': url
                                    }
                                }
                                ctx.setGpxFiles(newGpxFiles);
                                
                            }} />
                    </MenuItem>
                ))}
            </Collapse>

        </MenuList>
    </>
    );
}