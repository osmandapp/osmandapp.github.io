import React, {useMemo} from 'react';
import GpxGraph from "./GpxGraph";
import { Typography, Box } from "@mui/material";

export default function Speed({ renderedGpx, width}) {
    const data = useMemo(() => {
        let speedData = renderedGpx.gpx._info.speed._points;
        let result = [];

        Object.values(speedData).forEach((point) => {
            let data = {
                "Distance" : Math.round(point[0]) / 1000,
                "Speed": point[1]
            };
            result.push(data);
        });
        return result;
    }, [renderedGpx]);

    const maxSpeed = renderedGpx.summary.maxSpeed;
    const minSpeed = renderedGpx.summary.minSpeed;

    return (
        <>
            <GpxGraph data={data} xAxis={"Distance"} yAxis={"Speed"} width={width}/>
            <Box >
                <Typography variant="subtitle1" color="inherit" >
                    Min - max speed: {minSpeed.toFixed(0)} - {maxSpeed.toFixed(0)} m/s.
                </Typography>
            </Box>
            
        </>
    );
};