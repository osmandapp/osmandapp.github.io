import React, { useState, useContext, useEffect, useRef } from 'react';
import { styled } from '@mui/material/styles';
import { Settings } from '@mui/icons-material';
import {
    ListItemText, Collapse, MenuItem, ListItemIcon, IconButton,
    FormControl, InputLabel, Input, Select, Button
} from "@mui/material";
import {
    ExpandLess, ExpandMore, Directions
} from '@mui/icons-material';
import AppContext from "../../context/AppContext"
import RouteSettingsDialog from './RouteSettingsDialog';
// import Utils from "../../util/Utils";

const StyledInput = styled('input')({
    display: 'none',
});


function formatLatLon(pnt) {
    if (!pnt) {
        return '';
    }
    return pnt.lat.toFixed(5) + ", " + pnt.lng.toFixed(5);
}


export default function RouteMenu() {
    const ctx = useContext(AppContext);
    const [open, setOpen] = useState(true);
    const [openSettings, setOpenSettings] = useState(false);
    const btnFile = useRef();
    useEffect(() => {
        if (!ctx.routeTrackFile) {
            if (btnFile.current) {
                btnFile.current.value = "";
            }
        }
    }, [ctx.routeTrackFile])
    if (!ctx.startPoint && !ctx.endPoint) {
        return <></>;
    }
    return <>
        {openSettings && <RouteSettingsDialog setOpenSettings={setOpenSettings}/>}
        <MenuItem sx={{ mb: 1 }} onClick={(e) => setOpen(!open)}>
            <ListItemIcon>
                <Directions fontSize="small" />
            </ListItemIcon>
            <ListItemText>Route</ListItemText>
            {open ? <ExpandLess /> : <ExpandMore />}
        </MenuItem>

        <Collapse in={open} timeout="auto" unmountOnExit>        
            <MenuItem sx={{ ml: 1, mr: 2 }} disableRipple={true}>
                <FormControl fullWidth>
                    <InputLabel id="route-mode-label">Route profile</InputLabel>
                    <Select
                        labelid="route-mode-label"
                        label="Route profile"
                        value={ctx.routeMode.mode}
                        onChange={(e) => ctx.setRouteMode({ 'mode': e.target.value, 'opts': ctx.routeMode.opts})}
                    >
                        <MenuItem value='car'>Auto</MenuItem>
                        <MenuItem value='bicycle'>Bicycle</MenuItem>
                        <MenuItem value='pedestrian'>Pedestrian</MenuItem>
                        <MenuItem value='boat'>Boat</MenuItem>
                        <MenuItem value='ski'>Ski</MenuItem>
                        <MenuItem value='horsebackriding'>Horse</MenuItem>
                    </Select>
                </FormControl>
                <IconButton sx={{ ml: 1 }} onClick={() => {setOpenSettings(true)}} >
                    <Settings fontSize="small" />
                </IconButton>
            </MenuItem>
            {!ctx.routeTrackFile && ctx.startPoint && <MenuItem sx={{ ml: 2, mr: 2, mt: 1 }} disableRipple={true}>
                <FormControl fullWidth>
                    <InputLabel id="start-point-label">Start point</InputLabel>
                    <Input
                        labelid="start-point-label"
                        label="Start"
                        value={formatLatLon(ctx.startPoint)} >
                    </Input>
                </FormControl>
            </MenuItem>}
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
            {!ctx.routeTrackFile && ctx.endPoint && <MenuItem sx={{ ml: 2, mr: 2, mt: 1 }} disableRipple={true}>
                <FormControl fullWidth>
                    <InputLabel id="end-point-label">End point</InputLabel>
                    <Input
                        labelid="end-point-label"
                        label="End"
                        value={formatLatLon(ctx.endPoint)} >
                    </Input>
                </FormControl>
            </MenuItem>}
            {ctx.routeTrackFile && <MenuItem sx={{ ml: 2, mr: 2, mt: 1 }} disableRipple={true}>
                <FormControl fullWidth>
                    <InputLabel id="track-file-label">Selected track</InputLabel>
                    <Input
                        labelid="track-file-label"
                        label="Track"
                        value={ctx.routeTrackFile.name} >
                    </Input>
                </FormControl>
            </MenuItem>}
            <MenuItem disableRipple={true}>
                <label htmlFor="contained-button-file" >
                    <StyledInput ref={btnFile} accept=".gpx" id="contained-button-file" type="file" 
                        onChange={(e) => ctx.setRouteTrackFile(e.target.files[0])} />
                    <Button variant="contained" component="span" sx={{ ml: 3 }}>
                        Select Track
                    </Button>
                </label>
            </MenuItem>
        </Collapse>
    </>;

}
