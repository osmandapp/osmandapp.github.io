import React, {useMemo} from 'react';
import GpxGraph from "./GpxGraph";
import { Typography, Box } from "@mui/material";

const Elevation = ({ renderedGpx, width }) => {
    const data = useMemo(() => {
        let result = [];
        let dt = Object.values(renderedGpx.gpx._info.elevation._points);
        let min = dt[0][1];
        let max = dt[0][1];
        dt.forEach((point) => {
            let val = Math.round(point[1] * 10) / 10;
            let data = {
                "Distance": Math.round(point[0]) / 1000,
                "Elevation": val
            };
            result.push(data);
            min = Math.min(val, min);
            max = Math.max(val, max);
        });
        return { res: result, min: min, max: max };
    }, [renderedGpx]);

    return (
        // min={data.min.toFixed(0)} max={data.max.toFixed(0)}
        <GpxGraph data={data.res} xAxis={"Distance"} yAxis={"Elevation"} 
            width={width} min={data.min} max={data.max} />
        
    );
};

export default Elevation;