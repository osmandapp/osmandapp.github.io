import React, { useEffect, useState } from 'react';
import { Toolbar, Typography, ListItemText, Switch, Collapse } from "@mui/material";
import {
    IconButton, Divider, MenuItem, ListItemIcon, MenuList,
} from "@mui/material";
import {
    ArrowBack, Air, DirectionsWalk, ExpandLess, ExpandMore,
    Thermostat, NavigateNext, NavigateBefore, Person
} from '@mui/icons-material';

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
    weatherLayers, updateWeatherLayers,
    appText, setAppText,
    weatherDate, setWeatherDate,
    setLoginDialog }) {
    const [weatherOpen, setWeatherOpen] = useState(false);
    const handleWeather = () => {
        setWeatherOpen(!weatherOpen);
    };
    useEffect(() => {
        if (weatherOpen) {
            setAppText(formatWeatherDate(weatherDate));
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
                    <Typography variant="h6" color="inherit"  >
                        Login
                    </Typography>
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
                {weatherLayers.map((item, index) => (
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
                                let newlayers = [...weatherLayers];
                                newlayers[index].checked = e.target.checked;
                                updateWeatherLayers(newlayers);
                            }} />
                    </MenuItem>
                ))}
                <MenuItem disableRipple={true}>
                    <IconButton onClick={addWeatherHours(weatherDate, setWeatherDate, -1)}>
                        <NavigateBefore />
                    </IconButton>
                    <Typography>{weatherDate.toLocaleDateString() + " " + weatherDate.getHours() + ":00"}</Typography>
                    <IconButton onClick={addWeatherHours(weatherDate, setWeatherDate, 1)} >
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