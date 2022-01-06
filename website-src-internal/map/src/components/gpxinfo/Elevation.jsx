import React, {useMemo} from 'react';
import GpxGraph from "./GpxGraph";
import GpxStat from "./GpxStat";

const Elevation = (props) => {

    const axisNames = ["dist", "elevation"];

    const data = useMemo(() => {
        let elevationData = props.renderedGpx.gpx._info.elevation._points;
        let result = [];
        Object.values(elevationData).forEach((point) => {
            let data = {
                dist: Math.round(point[0]) / 1000,
                elevation: point[1]
            };

            result.push(data);
        });

        return result;
    }, [props.renderedGpx]);

    const maxEl = props.renderedGpx.summary.maxElevation;
    const minEl = props.renderedGpx.summary.minElevation;

    const stat = [`max elevation = ${maxEl}`, `min elevation = ${minEl}`]

    return (
        <div>
            <GpxGraph data={data} axisNames={axisNames}/>
            <GpxStat stat={stat}/>
        </div>
    );
};

export default Elevation;