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


function updateTextInfo(gpxFiles, setAppText) {
    // Local GPX files: undefined tracks, NaN km, undefined wpts
    let dist = 0;
    let tracks = 0;
    let wpts = 0;
    Object.values(gpxFiles).forEach((item) => {
        if (item.local === true && item.summary) {
            if (item.summary.totalTracks) {
                tracks += item.summary.totalTracks;
            }
            if (item.summary.wptPoints) {
                wpts += item.summary.wptPoints;
            }
            if (item.summary.totalDistance) {
                dist += item.summary.totalDistance;
            }
        }
    });
    setAppText(`Local GPX files: ${tracks} tracks, ${(dist / 1000.0).toFixed(1)} km, ${wpts} wpts`)
}

async function loadInitialState(gpxFiles, setGpxFiles) {
    const response = await fetch(`/gpx/get-gpx-info`, {});
    if (response.ok) {
        let data = await response.json();
        data.all.forEach((item) => {
            let gpxLayer = {};
            gpxLayer.name = 'local:' + item.name;
            gpxLayer.localContent = '/gpx/get-gpx-file?name=' + encodeURIComponent(item.name);
            gpxLayer.local = true;
            let newinfo = Object.assign({}, gpxFiles);
            gpxLayer.summary = item;
            newinfo[gpxLayer.name] = gpxLayer;
            gpxFiles[gpxLayer.name] = gpxLayer;
            setGpxFiles(newinfo);
        });
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
        gpxLayer.summary = data.info;
        newinfo[gpxLayer.name] = gpxLayer;
        gpxFiles[gpxLayer.name] = gpxLayer;
        setGpxFiles(newinfo);
        updateTextInfo(gpxFiles, setAppText);
    } else {
        alert("File Upload has failed");
    }
}


const clearLocalGpx = (gpxFiles, setGpxFiles, setAppText) => async (e) => {
    const response = await fetch(`/gpx/clear`, { method: 'POST' });
    if (response.ok) {
        await response.json();
        let newinfo = Object.assign({}, gpxFiles);
        Object.values(gpxFiles).forEach((item) => {
            if (item.local) {
                // clear up but not delete
                newinfo[item.name].local = false;
                newinfo[item.name].url = null;
                newinfo[item.name].localContent = null;
                // delete newinfo[item.name];
            }
        });
        setAppText('');
        setGpxFiles(newinfo);
    }
}


const fileSelected = (gpxFiles, setGpxFiles, ctx) => async (e) => {
    //    let file = e.target.files[0];

    Array.from(e.target.files).forEach((file) => {
        const reader = new FileReader();
        reader.addEventListener('load', (event) => {
            let src = event.target.result;
            let gpxLayer = {};
            gpxLayer.name = 'local:' + file.name;
            gpxLayer.localContent = src;
            gpxLayer.local = true;
            uploadFile(gpxFiles, setGpxFiles, ctx, gpxLayer, file);
        });
        reader.readAsText(file);
    });
}

export default function LocalGpx() {
    const ctx = useContext(AppContext);
    const [localGpxOpen, setLocalGpxOpen] = useState(false);

    useEffect(() => {
        loadInitialState(ctx.gpxFiles, ctx.setGpxFiles);
    // eslint-disable-next-line
    }, []);

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
                        checked={item.url ? true : false}
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
                        onChange={fileSelected(ctx.gpxFiles, ctx.setGpxFiles, ctx.setAppText)} />
                    <Button variant="contained" component="span" sx={{ ml: 3 }}>
                        Upload
                    </Button>
                </label>
            </MenuItem>
            { localGpxFiles.length === 0 ? <></> :
                <MenuItem disableRipple={true}>
                    <Button variant="contained" component="span" sx={{ ml: 3 }}
                        onClick={clearLocalGpx(ctx.gpxFiles, ctx.setGpxFiles, ctx.setAppText)}>
                        Clear
                    </Button>
                    <Button variant="contained" component="span" sx={{ ml: 2 }}
                            onClick={() => window.open("/gpx/download-obf")}>
                        Get OBF
                    </Button>
                </MenuItem>
            }

        </Collapse>
    </>;
}