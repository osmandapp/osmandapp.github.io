import React, { useEffect, useState, useContext } from 'react';
import { Toolbar, Typography, ListItemText, Switch, Collapse } from "@mui/material";
import {
    IconButton, Divider, MenuItem, ListItemIcon, MenuList,
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
    const handleWeather = () => {
        setWeatherOpen(!weatherOpen);
    };
    useEffect(() => {
        if (weatherOpen) {
            setAppText(formatWeatherDate(ctx.weatherDate));
        } else {
            setAppText(null);
        }
    });
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
                    {ctx.userEmail ? 
                    <Typography color="inherit">{ctx.userEmail}</Typography>
                    :
                    <Typography variant="h6" color="inherit">Login</Typography>
                    }
                </MenuItem>

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
                {ctx.weatherLayers.map((item, index) => (
                    <MenuItem key={item.key}>
                        <ListItemIcon>
                            {item.iconComponent ?
                                item.iconComponent :
                                <Thermostat fontSize="small" />
                            }
                        </ListItemIcon>
                        <ListItemText>{item.name}</ListItemText>
                        <Switch
                            checked={item.checked}
                            onChange={(e) => {
                                let newlayers = [...ctx.weatherLayers];
                                newlayers[index].checked = e.target.checked;
                                ctx.updateWeatherLayers(newlayers);
                            }} />
                    </MenuItem>
                ))}
                <MenuItem disableRipple={true}>
                    <IconButton onClick={addWeatherHours(ctx.weatherDate, ctx.setWeatherDate, -1)}>
                        <NavigateBefore />
                    </IconButton>
                    <Typography>{ctx.weatherDate.toLocaleDateString() + " " + ctx.weatherDate.getHours() + ":00"}</Typography>
                    <IconButton onClick={addWeatherHours(ctx.weatherDate, ctx.setWeatherDate, 1)} >
                        <NavigateNext />
                    </IconButton>
                </MenuItem>

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
    </>
    );
}