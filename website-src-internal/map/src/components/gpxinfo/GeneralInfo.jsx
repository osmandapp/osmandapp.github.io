import React, { useMemo } from 'react';
import { Typography, Box, Button } from "@mui/material";
import { getGpxTime, toHHMMSS } from "../../context/AppContext"

export default function GeneralInfo({ renderedGpx, width }) {
    let timeRange = '';
    let distance = '';
    let timeMoving = '';
    let updownhill = '';
    let speed = '';
    let elevation = '';
    // item.details?.analysis ?
    let summary = renderedGpx?.summary;
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
    if (summary?.hasElevationData) {
        updownhill = "Uphill/downhill: " + summary.diffElevationUp.toFixed(0)
            + "/" + summary?.diffElevationDown.toFixed(0) + " m";
        elevation = "Elevation (min/avg/max): " +
            (summary.minElevation).toFixed(1) + " / " +
            (summary.avgElevation).toFixed(1) + " / " +
            (summary.maxElevation).toFixed(1) + " m"
    }
    if (summary?.hasSpeedData) {
        speed = "Speed (min/avg/max): " +
            (summary.minSpeed * 3.6).toFixed(0) + " / " +
            (summary.avgSpeed * 3.6).toFixed(0) + " / " +
            (summary.maxSpeed * 3.6).toFixed(0) + " km/h"
    }


    return (<Box width={width}>
        <Typography variant="subtitle1" color="inherit" >
            {renderedGpx?.summary?.name} <Button onClick={
                () => window.open(renderedGpx.url)}>Download</Button>
            {timeRange ? <><br /><br />Time: </> : <></>}  {timeRange}
            {distance ? <br /> : <></>} {distance}
            {speed ? <br /> : <></>} {speed}
            {timeMoving ? <br /> : <></>} {timeMoving}
            {elevation ? <br /> : <></>} {elevation}
            {updownhill ? <br /> : <></>} {updownhill}
        </Typography>
        
    </Box>);
};