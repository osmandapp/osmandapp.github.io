import React, { useEffect, useState, useContext } from 'react';
import { styled } from '@mui/material/styles';
import {
    Typography, ListItemText, Switch, Collapse,
} from "@mui/material";
import {
    Button, MenuItem, ListItemIcon, Tooltip,
} from "@mui/material";
import {
    DirectionsWalk, ExpandLess, ExpandMore,
} from '@mui/icons-material';
import AppContext from "../../context/AppContext"


const StyledInput = styled('input')({
    display: 'none',
});

function formatGpxData(newinfo, setAppText, data) {
    if (data.files === 0) {
        delete newinfo.localInfoSummary;
        setAppText('');
    } else {
        newinfo.localInfoSummary = "Local GPX files: " + data.files + " tracks, " +
            (data.totalDist / 1000.0).toFixed(1) + " km, " + data.waypoints + " wpts";
        setAppText(newinfo.localInfoSummary);
    }
}
async function uploadFile(gpxFiles, setGpxFiles, setAppText, gpxLayer, file) {
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
        formatGpxData(newinfo, setAppText, data);
        setGpxFiles(newinfo);
    } else {
        alert("File Upload has failed");
    }
}


const clearLocalGpx = (gpxFiles, setGpxFiles, setAppText) => async (e) => {
    const response = await fetch(`/gpx/clear`, { method: 'POST' });
    if (response.ok) {
        let data = await response.json();
        let newinfo = Object.assign({}, gpxFiles);
        formatGpxData(newinfo, setAppText, data);
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


const fileSelected = (gpxFiles, setGpxFiles, setAppText) => async (e) => {
    //    let file = e.target.files[0];

    Array.from(e.target.files).forEach((file) => {
        const reader = new FileReader();
        reader.addEventListener('load', (event) => {
            let src = event.target.result;
            let gpxLayer = {};
            gpxLayer.name = 'local:' + file.name;
            gpxLayer.localContent = src;
            gpxLayer.local = true;
            uploadFile(gpxFiles, setGpxFiles, setAppText, gpxLayer, file);
        });
        reader.readAsText(file);
    });
}

export default function LocalGpx({ setAppText }) {
    const ctx = useContext(AppContext);
    const [localGpxOpen, setLocalGpxOpen] = useState(false);

    let localGpxFiles = (!ctx.gpxFiles ? [] :
        Object.values(ctx.gpxFiles).filter((item) => item.local === true));

    return <>
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
                            onChange={fileSelected(ctx.gpxFiles, ctx.setGpxFiles, setAppText)} />
                        <Button variant="contained" component="span" sx={{ ml: 3 }}>
                            Upload
                        </Button>
                    </label>
                    {
                        localGpxFiles.length === 0 ? <></> :
                            <Button variant="contained" component="span" sx={{ ml: 2 }} 
                                onClick={clearLocalGpx(ctx.gpxFiles, ctx.setGpxFiles, setAppText)}>
                                Clear
                            </Button>
                    }
                </MenuItem>
                
            </Collapse>
    </>;
}