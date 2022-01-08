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
                "Speed": point[1].toFixed(1)
            };
            result.push(data);
        });
        return result;
    }, [renderedGpx]);

    return (
        <GpxGraph data={data} xAxis={"Distance"} yAxis={"Speed"} width={width}/>
    );
};