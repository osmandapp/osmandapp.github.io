import React, { useEffect, useState, useContext } from 'react';
import { styled } from '@mui/material/styles';
import { Toolbar, Typography, ListItemText, Switch, 
    Collapse, Button, } from "@mui/material";
import {
    IconButton, Divider, MenuItem, ListItemIcon, MenuList, Tooltip, 
} from "@mui/material";
import {
    ArrowBack, Air, DirectionsWalk, ExpandLess, ExpandMore,
    Thermostat, NavigateNext, NavigateBefore, Person,
    Sort, SortByAlpha, UploadFile
} from '@mui/icons-material';
import AppContext from "../context/AppContext"

const StyledInput = styled('input')({
    display: 'none',
});

const addWeatherHours = (weatherDate, setWeatherDate, hours) => (event) => {
    let dt = new Date(weatherDate.getTime() + (hours * 60 * 60 * 1000));
    setWeatherDate(dt);
}

function formatGpxData(newinfo, data) {
    if (data.files === 0) {
        delete newinfo.localInfoSummary;
    } else {
        newinfo.localInfoSummary = "Local GPX files: " + data.files + " tracks, " +
            (data.totalDist / 1000.0).toFixed(1) + " km, " + data.waypoints + " wpts";
    }
}
async function uploadFile(gpxFiles, setGpxFiles, gpxLayer, file) {
    let formData = new FormData();
    formData.append('file', file);
    const response = await fetch(`/gpx/upload-session-gpx`, {
        method: 'POST',
        body: formData
    });
    if (response.ok) {
        let data = await response.json();
        let newinfo = Object.assign({}, gpxFiles);
        newinfo[gpxLayer.name] = gpxLayer;
        gpxFiles[gpxLayer.name] = gpxLayer;
        formatGpxData(newinfo, data);
        setGpxFiles(newinfo);
    } else {
        alert("File Upload has failed");
    }
}


const clearLocalGpx = (gpxFiles, setGpxFiles) => async (e) => {
    const response = await fetch(`/gpx/clear`, {method: 'POST'});
    if (response.ok) {
        let data = await response.json();
        let newinfo = Object.assign({}, gpxFiles);
        formatGpxData(newinfo, data);
        Object.values(gpxFiles).map((item) => {
            if (item.local) {
                // clear up but not delete
                newinfo[item.name].local = false;
                newinfo[item.name].url = null;
                newinfo[item.name].localContent = null;
                // delete newinfo[item.name];
            }
        });
        setGpxFiles(newinfo);
    }
}


const fileSelected = (gpxFiles, setGpxFiles) => async (e) => {
//    let file = e.target.files[0];

    Array.from(e.target.files).forEach((file) => {
        const reader = new FileReader();
        reader.addEventListener('load', (event) => {
            let src = event.target.result;
            let gpxLayer = {};
            gpxLayer.name = 'local:' + file.name;
            gpxLayer.localContent = src;
            gpxLayer.local = true;
            uploadFile(gpxFiles, setGpxFiles, gpxLayer, file);
        });
        reader.readAsText(file);
    });
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
    const [localGpxOpen, setLocalGpxOpen] = useState(false);

    let localGpxFiles = (!ctx.gpxFiles ? [] :
        Object.values(ctx.gpxFiles).filter((item) =>  item.local === true));
    let gpxFiles = (!ctx.listFiles || !ctx.listFiles.uniqueFiles ? [] :
        ctx.listFiles.uniqueFiles).filter((item) => {
            return (item.type === 'gpx' || item.type === 'GPX')
                && (item.name.slice(-4) === '.gpx' || item.name.slice(-4) === '.GPX');
        });

    useEffect(() => {
        if (weatherOpen) {
            setAppText(formatWeatherDate(ctx.weatherDate));
        } else if (localGpxOpen && ctx.gpxFiles) {
            setAppText(ctx.gpxFiles.localInfoSummary);
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
                <ListItemText>Tracks {gpxFiles.length > 0 ? `(${gpxFiles.length})` : ''} </ListItemText>
                <Typography variant="body2" color="textSecondary">
                    GPX
                </Typography>
                {
                    gpxFiles.length === 0 ? <></> :
                        gpxOpen ? <ExpandLess /> : <ExpandMore />
                }
            </MenuItem>

            <Collapse in={gpxOpen} timeout="auto" unmountOnExit>
                <MenuItem disableRipple={true}>
                    <IconButton sx={{ ml: 2 }}>
                        <Sort fontSize="small" />
                    </IconButton>
                    <IconButton sx={{ ml: 2 }}>
                        <SortByAlpha fontSize="small" />
                    </IconButton>
                </MenuItem>
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


            <MenuItem onClick={(e) => setLocalGpxOpen(!localGpxOpen)}>
                <ListItemIcon>
                    <DirectionsWalk fontSize="small" />
                </ListItemIcon>
                <ListItemText>Local Tracks {localGpxFiles.length > 0 ? `(${localGpxFiles.length})` : ''} </ListItemText>
                {localGpxOpen ? <ExpandLess /> : <ExpandMore />}
            </MenuItem>

            <Collapse in={localGpxOpen} timeout="auto" unmountOnExit>
                {localGpxFiles.map((item, index) => (
                    <MenuItem key={item.name}>
                        <Tooltip title={item.name}>
                            <ListItemText inset>
                                <Typography variant="inherit" noWrap>
                                    {item.name.slice(6, -4).replace('_', ' ')}
                                </Typography>
                            </ListItemText>
                        </Tooltip>

                        <Switch
                            checked={item.url? true : false}
                            onChange={(e) => {
                                const newGpxFiles = Object.assign({}, ctx.gpxFiles);
                                if (!e.target.checked) {
                                    // delete newGpxFiles[item.name];
                                    newGpxFiles[item.name].url = null;
                                } else {
                                    newGpxFiles[item.name].url = item.localContent;
                                }
                                ctx.setGpxFiles(newGpxFiles);
                            }} />
                    </MenuItem>
                ))}
                <MenuItem disableRipple={true}>
                    <label htmlFor="contained-button-file" >
                        <StyledInput accept=".gpx" id="contained-button-file" multiple type="file"
                            onChange={fileSelected(ctx.gpxFiles, ctx.setGpxFiles)} />
                        <Button variant="contained" component="span" sx={{ ml: 3 }}>
                            Upload
                        </Button>
                    </label>
                    {
                        localGpxFiles.length === 0 ? <></> :
                            <Button variant="contained" component="span" sx={{ ml: 2 }} 
                                onClick={clearLocalGpx(ctx.gpxFiles, ctx.setGpxFiles)}>
                                Clear
                            </Button>
                    }
                </MenuItem>
                
            </Collapse>

        </MenuList>
    </>
    );
}