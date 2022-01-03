import React, { useEffect, useState, useContext } from 'react';
import { styled } from '@mui/material/styles';
import {
    Typography, ListItemText, Switch, Collapse,
} from "@mui/material";
import {
    IconButton, Divider, MenuItem, ListItemIcon, MenuList, Tooltip,
} from "@mui/material";
import {
    Air, ExpandLess, ExpandMore, Thermostat, NavigateNext, NavigateBefore,
} from '@mui/icons-material';
import AppContext from "../../context/AppContext"


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

function updateTextLayer(ctx, setAppText) {
    setAppText(formatWeatherDate(ctx.weatherDate));
}

const addWeatherHours = (ctx, setAppText, hours) => () => {
    let dt = new Date(ctx.weatherDate.getTime() + (hours * 60 * 60 * 1000));
    ctx.setWeatherDate(dt);
    updateTextLayer(ctx, setAppText);
}

const switchLayer = (ctx, index, setAppText) => (e) => {
    let newlayers = [...ctx.weatherLayers];
    newlayers[index].checked = e.target.checked;
    ctx.updateWeatherLayers(newlayers);
    updateTextLayer(ctx, setAppText);
}

export default function Weather({ setAppText }) {
    const ctx = useContext(AppContext);
    const [weatherOpen, setWeatherOpen] = useState(false);
    return <>
        <MenuItem onClick={() => {
                setWeatherOpen(!weatherOpen);
                if (!weatherOpen) {
                    updateTextLayer(ctx, setAppText);
                } 
            }}>
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
                        onChange={switchLayer(ctx, index, setAppText)} />
                </MenuItem>
            ))}
            <MenuItem disableRipple={true}>
                <IconButton sx={{ ml: 1 }} onClick={addWeatherHours(ctx, setAppText, -1)}>
                    <NavigateBefore />
                </IconButton>
                <Typography>{ctx.weatherDate.toLocaleDateString() + " " + ctx.weatherDate.getHours() + ":00"}</Typography>
                <IconButton onClick={addWeatherHours(ctx, setAppText, 1)} >
                    <NavigateNext />
                </IconButton>
            </MenuItem>

            <Divider />
        </Collapse>
    </>
};