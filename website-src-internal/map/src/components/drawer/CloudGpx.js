import React, { useState, useContext } from 'react';
import {
    Typography, ListItemText, Switch, Collapse,
    IconButton, MenuItem, ListItemIcon, Tooltip, LinearProgress
} from "@mui/material";
import { FixedSizeList } from 'react-window';
import {
    DirectionsWalk, ExpandLess, ExpandMore, Sort, SortByAlpha
} from '@mui/icons-material';
import AppContext, { getGpxTime, toHHMMSS} from "../../context/AppContext"


function updateTextInfo(gpxFiles, ctx) {
    // Local GPX files: undefined tracks, NaN km, undefined wpts
    let dist = 0;
    let tracks = 0;
    let wpts = 0;
    let time = 0;
    let diffUp = 0;
    let diffDown = 0;
    Object.values(gpxFiles).forEach((item) => {
        if (item.local !== true && item.summary && item.url) {
            if (item.summary.totalTracks) {
                tracks += item.summary.totalTracks;
            }
            if (item.summary.wptPoints) {
                wpts += item.summary.wptPoints;
            }
            if (item.summary.totalDistance) {
                dist += item.summary.totalDistance;
            }
            if (item.summary.timeMoving) {
                time += item.summary.timeMoving;
            }
            if (item.summary.diffElevationUp) {
                diffUp += item.summary.diffElevationUp;
            }
            if (item.summary.diffElevationDown) {
                diffDown += item.summary.diffElevationDown;
            }
        }
    });
    ctx.setAppText(`Selected GPX files: ${tracks} tracks, ${(dist / 1000.0).toFixed(1)} km, ${wpts} wpts. 
            Time moving: ${toHHMMSS(time)}. 
            Uphill / Downhill: ${(diffUp).toFixed(0)} / ${(diffDown).toFixed(0)} m.`)
}

async function loadSrtmGpxInfo(item, ctx, layer, setProgressVisible) {
    let srtmGpxInfoUrl = `/map/api/get-srtm-gpx-info?type=${encodeURIComponent(item.type)}&name=${encodeURIComponent(item.name)}`;
    setProgressVisible(true);
    const response = await fetch(srtmGpxInfoUrl, {});
    if (response.redirected) {
        setProgressVisible(false);
        console.log(response.url);
        window.location.href = response.url;
    } else if (response.ok) {
        let data = await response.json();
        const newGpxFiles = Object.assign({}, ctx.gpxFiles);
        layer.srtmSummary = data.info;
        newGpxFiles[item.name] = layer;
        ctx.setGpxFiles(newGpxFiles);
        updateTextInfo(newGpxFiles, ctx);
        setProgressVisible(false);
    }
}


async function loadGpxInfo(item, ctx, layer, setProgressVisible) {
    let gpxInfoUrl = `/map/api/get-gpx-info?type=${encodeURIComponent(item.type)}&name=${encodeURIComponent(item.name)}`;
    setProgressVisible(true);
    const response = await fetch(gpxInfoUrl, {});
    if (response.redirected) {
        setProgressVisible(false);
        console.log(response.url);
        window.location.href = response.url;
    } else if (response.ok) {
        let data = await response.json();
        const newGpxFiles = Object.assign({}, ctx.gpxFiles);
        layer.summary = data.info;
        // newGpxFiles[item.name] = layer;
        ctx.setGpxFiles(newGpxFiles);
        updateTextInfo(newGpxFiles, ctx);
        setProgressVisible(false);
    } 
}

function enableLayer(item, ctx,  setProgressVisible, visible) {
    let url = `/map/api/download-file?type=${encodeURIComponent(item.type)}&name=${encodeURIComponent(item.name)}`;
    const newGpxFiles = Object.assign({}, ctx.gpxFiles);
    if (!visible) {
        // delete newGpxFiles[item.name];
        newGpxFiles[item.name].url = null;
        ctx.setGpxFiles(newGpxFiles);
        ctx.setSelectedGpxFile(null);
        updateTextInfo(newGpxFiles, ctx);
    } else {
        newGpxFiles[item.name] = { 'url': url, 'clienttimems': item.clienttimems };
        ctx.setGpxFiles(newGpxFiles);
        if (item.details?.analysis) {
            newGpxFiles[item.name].summary = item.details.analysis;
            updateTextInfo(newGpxFiles, ctx);
        }
        loadSrtmGpxInfo(item, ctx, newGpxFiles[item.name], setProgressVisible);
        loadGpxInfo(item, ctx, newGpxFiles[item.name], setProgressVisible);
        ctx.setSelectedGpxFile(newGpxFiles[item.name]);
    }
}

const GpxItemRow = (gpxFiles, ctx) => ({index, style}) => {
    const item = gpxFiles[index];
    let localLayer = ctx.gpxFiles[item.name];
    let timeRange = '';
    let clienttime = '';
    let distance = '';
    let timeMoving = '';
    let updownhill = '';
    let speed = '';
    let summary = item.details?.analysis ?
        item.details?.analysis : localLayer?.summary;
    if (item.clienttimems) {
        clienttime = "Upload time: " + new Date(item.clienttimems).toDateString() +
            + " " + new Date(item.clienttimems).toLocaleTimeString();
    }
    if (summary?.startTime &&
        summary?.startTime !== summary?.endTime) {
        let stdate = new Date(summary.startTime).toDateString();
        let edate = new Date(summary.endTime).toDateString();
        timeRange = new Date(summary.startTime).toDateString() + " " +
            new Date(summary.startTime).toLocaleTimeString() + " - " +
            (edate !== stdate ? edate : '') +
            new Date(summary.endTime).toLocaleTimeString();
    }
    if (summary?.totalDistance) {
        distance = "Distance: " + (summary?.totalDistance / 1000).toFixed(1) + " km";
    }
    if (summary?.timeMoving) {
        timeMoving = "Time moving: " + toHHMMSS(summary?.timeMoving);
    }
    if (summary?.diffElevationDown) {
        updownhill = "Uphill/downhill: " + summary.diffElevationUp.toFixed(0)
            + "/" + summary?.diffElevationDown.toFixed(0) + " m";
    }
    if (summary?.maxSpeed && summary?.maxSpeed > 0) {
        speed = "Speed (min/avg/max): " +
            (summary.minSpeed * 3.6).toFixed(0) + " / " +
            (summary.avgSpeed * 3.6).toFixed(0) + " / " +
            (summary.maxSpeed * 3.6).toFixed(0) + " km/h"
    }

    return (
        <MenuItem style={style} key={item.name} onClick={() => ctx.setSelectedGpxFile(localLayer)}>
            <Tooltip title={<div>
                {item.name}
                {timeRange ? <><br /><br />Time: </> : <></>}  {timeRange}
                {distance ? <br /> : <></>} {distance}
                {timeMoving ? <br /> : <></>} {timeMoving}
                {updownhill ? <br /> : <></>} {updownhill}
                {speed ? <br /> : <></>} {speed}
                {clienttime ? <br /> : <></>} {clienttime}
            </div>}>
                <ListItemText inset>
                    <Typography variant="inherit" noWrap>
                        {item.name.slice(0, -4).replace('_', ' ')}
                    </Typography>
                </ListItemText>
            </Tooltip>
            <Switch
                checked={!!localLayer?.url}
                onChange={(e) => {
                    enableLayer(item, ctx, ctx.setGpxLoading, e.target.checked);
                }} />
        </MenuItem>)
}

export default function CloudGpx() {
    const ctx = useContext(AppContext);
    const [gpxOpen, setGpxOpen] = useState(false);
    let gpxFiles = (!ctx.listFiles || !ctx.listFiles.uniqueFiles ? [] :
        ctx.listFiles.uniqueFiles).filter((item) => {
            return (item.type === 'gpx' || item.type === 'GPX')
                && (item.name.slice(-4) === '.gpx' || item.name.slice(-4) === '.GPX');
        });
    const [alphaUp, setAlphaUp] = useState(false);
    const [timeUp, setTimeUp] = useState(true);

    const MAX_SIZE_GPX_BLOCK = 500;
    const MAX_SIZE_GPX_ITEM = 40;

    const blockSize = () => {
        if (gpxFiles) {
            let itemBlockSize = gpxFiles.length * MAX_SIZE_GPX_ITEM
            if (itemBlockSize > MAX_SIZE_GPX_BLOCK) {
                return MAX_SIZE_GPX_BLOCK;
            } else
                return itemBlockSize;
        }
        return 0;
    }

    return <>
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
        { ctx.gpxLoading ? <LinearProgress /> : <></> }
        <Collapse in={gpxOpen} timeout="auto" unmountOnExit>            
            <MenuItem disableRipple={true}>
                <IconButton sx={{ ml: 4 }} onClick={() => {
                    let lf = Object.assign({}, ctx.listFiles);
                    lf.uniqueFiles = lf.uniqueFiles.sort((f, s) => {
                        let ftime = getGpxTime(f);
                        let stime = getGpxTime(s);
                        if (ftime === stime) {
                            return f.name > s.name ? 1 : -1;
                        }
                        if (timeUp) {
                            return ftime > stime ? 1 : -1;
                        } else {
                            return ftime < stime ? 1 : -1;
                        }
                    });
                    setTimeUp(!timeUp);
                    ctx.setListFiles(lf);
                }} >
                    <Sort fontSize="small" />
                </IconButton>
                <IconButton sx={{ ml: 2 }} onClick={() => {
                    let lf = Object.assign({}, ctx.listFiles);
                    lf.uniqueFiles = lf.uniqueFiles.sort((f, s) => {
                        if (alphaUp) {
                            return f.name > s.name ? 1 : -1;
                        } else {
                            return f.name < s.name ? 1 : -1;
                        }
                    });
                    setAlphaUp(!alphaUp);
                    ctx.setListFiles(lf);
                }} >
                    <SortByAlpha fontSize="small" />
                </IconButton>
            </MenuItem>
            <FixedSizeList 
                height={blockSize()}
                itemCount={gpxFiles.length}
                itemSize={MAX_SIZE_GPX_ITEM}>
            {GpxItemRow(gpxFiles, ctx)}
            </FixedSizeList>
        </Collapse>
    </>;

}