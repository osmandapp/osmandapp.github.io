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
                    <InputLabel id="rendering-style-selector-label">Route profile</InputLabel>
                    <Select
                        labelId="rendering-style-selector-label"
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
                    <InputLabel id="rendering-style-selector-label">Start point</InputLabel>
                    <Input
                        labelId="rendering-style-selector-label"
                        label="Start"
                        value={formatLatLon(ctx.startPoint)} >
                    </Input>
                </FormControl>
            </MenuItem>
            <MenuItem sx={{ ml: 2, mr: 2, mt: 1 }} disableRipple={true}>
                <FormControl fullWidth>
                    <InputLabel id="rendering-style-selector-label">End point</InputLabel>
                    <Input
                        labelId="rendering-style-selector-label"
                        label="End"
                        value={formatLatLon(ctx.endPoint)} >
                    </Input>
                </FormControl>
            </MenuItem>
        </Collapse>
    </>;

}
