import React from 'react';
import {Area, Tooltip, XAxis, YAxis, AreaChart} from "recharts";
import {Typography} from "@mui/material";

const GpxGraph = ( props ) => {
    console.log(props.data)
    return (<div>
            <Typography component={'span'} type="title" color="inherit" sx={{p: 2}}>
                <AreaChart
                    width={600}
                    height={150}
                    data={props.data}
                    margin={{top: 10, right: 30, left: 0, bottom: 0}}
                >
                    <defs>
                        <linearGradient id="colorEl" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="5%" stopColor="#8ac827" stopOpacity={0.8}/>
                            <stop offset="95%" stopColor="#bddbb0" stopOpacity={0}/>
                        </linearGradient>
                    </defs>
                    <XAxis dataKey={props.axisNames[0]} type="number" tickCount={11}/>
                    <YAxis type="number" tickCount={11}/>
                    <Tooltip/>
                    <Area
                        type="monotone"
                        dataKey={props.axisNames[1]}
                        stroke="#8ac827"
                        fillOpacity={1}
                        fill="url(#colorEl)"
                    />
                </AreaChart>
            </Typography>
    </div>
    );
};

export default GpxGraph;