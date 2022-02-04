import React, { useState, useContext } from 'react';
import {
    ListItemText, Collapse,
    MenuItem, ListItemIcon,
    FormControl, InputLabel, Input, Select
} from "@mui/material";
import {
    ExpandLess, ExpandMore, Directions
} from '@mui/icons-material';
import AppContext from "../../context/AppContext"
// import Utils from "../../util/Utils";


function formatLatLon(pnt) {
    if (!pnt) {
        return '';
    }
    return pnt.lat.toFixed(5) + ", " + pnt.lng.toFixed(5);
}
export default function MapStyle() {
    const ctx = useContext(AppContext);
    const [open, setOpen] = useState(true);

    if (!ctx.startPoint && !ctx.endPoint) {
        return <></>;
    }
    return <>
        <MenuItem sx={{ mb: 1 }} onClick={(e) => setOpen(!open)}>
            <ListItemIcon>
                <Directions fontSize="small" />
            </ListItemIcon>
            <ListItemText>Route</ListItemText>
            {open ? <ExpandLess /> : <ExpandMore />}
        </MenuItem>

        <Collapse in={open} timeout="auto" unmountOnExit>        
            <MenuItem sx={{ ml: 2, mr: 2 }} disableRipple={true}>
                <FormControl fullWidth>
                    <InputLabel id="route-mode-label">Route profile</InputLabel>
                    <Select
                        labelid="route-mode-label"
                        label="Route profile"
                        value={ctx.routeMode.mode}
                        onChange={(e) => ctx.setRouteMode({'mode': e.target.value})}
                    >
                        <MenuItem value='car'>Auto</MenuItem>
                        <MenuItem value='bicycle'>Bicycle</MenuItem>
                        <MenuItem value='pedestrian'>Pedestrian</MenuItem>
                        <MenuItem value='boat'>Boat</MenuItem>
                        <MenuItem value='ski'>Ski</MenuItem>
                        <MenuItem value='horsebackriding'>Horse</MenuItem>
                    </Select>
                </FormControl>
            </MenuItem>
            <MenuItem sx={{ ml: 2, mr: 2, mt: 1 }} disableRipple={true}>
                <FormControl fullWidth>
                    <InputLabel id="start-point-label">Start point</InputLabel>
                    <Input
                        labelid="start-point-label"
                        label="Start"
                        value={formatLatLon(ctx.startPoint)} >
                    </Input>
                </FormControl>
            </MenuItem>
            {ctx.interPoints.map((item, ind) => (
                <MenuItem key={"inter"+(ind+1)} sx={{ ml: 2, mr: 2, mt: 1 }} disableRipple={true}>
                    <FormControl fullWidth>
                        <InputLabel id="end-point-label">Intermediate {ind+1}</InputLabel>
                        <Input
                            labelid="end-point-label"
                            label="End"
                            value={formatLatLon(item)} >
                        </Input>
                    </FormControl>
                </MenuItem>
            ))}
            <MenuItem sx={{ ml: 2, mr: 2, mt: 1 }} disableRipple={true}>
                <FormControl fullWidth>
                    <InputLabel id="end-point-label">End point</InputLabel>
                    <Input
                        labelid="end-point-label"
                        label="End"
                        value={formatLatLon(ctx.endPoint)} >
                    </Input>
                </FormControl>
            </MenuItem>
        </Collapse>
    </>;

}
