import React, {useMemo} from 'react';
import GpxGraph from "./GpxGraph";
import GpxStat from "./GpxStat";

const Speed = (props) => {

    const axisNames = ["dist", "speed"];

    const data = useMemo(() => {
        let speedData = props.renderedGpx.gpx._info.speed._points;
        let result = [];

        Object.values(speedData).forEach((point) => {
            let data = {
                dist: Math.round(point[0]) / 1000,
                speed: point[1]
            };

            result.push(data);
        });
        return result;
    }, [props.renderedGpx]);

    const maxSpeed = props.renderedGpx.summary.maxSpeed;
    const minSpeed = props.renderedGpx.summary.minSpeed;

    const stat = [`max speed = ${maxSpeed}`, `min speed = ${minSpeed}`]

    return (
        <div>
            <GpxGraph data={data} axisNames={axisNames}/>
            <GpxStat stat={stat}/>
        </div>
    );
};

export default Speed;