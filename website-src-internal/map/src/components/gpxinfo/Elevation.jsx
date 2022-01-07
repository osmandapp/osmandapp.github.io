import React, {useMemo} from 'react';
import GpxGraph from "./GpxGraph";
import { Typography, Box } from "@mui/material";

const Elevation = ({ renderedGpx }) => {
    const data = useMemo(() => {
        let elevationData = renderedGpx.gpx._info.elevation._points;
        let result = [];
        Object.values(elevationData).forEach((point) => {
            let data = {
                "Distance": Math.round(point[0]) / 1000,
                "Elevation": point[1]
            };

            result.push(data);
        });

        return result;
    }, [renderedGpx]);
    const maxEl = renderedGpx.summary.maxElevation;
    const minEl = renderedGpx.summary.minElevation;
    return (
        <>
            <GpxGraph data={data} xAxis={"Distance"} yAxis={"Elevation"} />
            <Box >
                <Typography variant="subtitle1" color="inherit" >
                    Max elevation: {maxEl}, min elevation: {minEl}
                </Typography>
            </Box>
        </>
    );
};

export default Elevation;