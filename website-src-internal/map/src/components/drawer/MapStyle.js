import React, { useState, useContext } from 'react';
import {
    ListItemText, Collapse,
    MenuItem, ListItemIcon,
    FormControl, InputLabel, Select
} from "@mui/material";
import {
    ExpandLess, ExpandMore, Map
} from '@mui/icons-material';
import AppContext from "../../context/AppContext"
// import Utils from "../../util/Utils";


export default function MapStyle() {
    const ctx = useContext(AppContext);
    const [open, setOpen] = useState(false);

    return <>
        <MenuItem sx={{ mb: 1 }} onClick={(e) => setOpen(!open)}>
            <ListItemIcon>
                <Map fontSize="small" />
            </ListItemIcon>
            <ListItemText>Map Style</ListItemText>
            {open ? <ExpandLess /> : <ExpandMore />}
        </MenuItem>

        <Collapse in={open} timeout="auto" unmountOnExit>        
            <MenuItem disableRipple={true}>
                <FormControl fullWidth>
                    <InputLabel id="rendering-style-selector-label">Map Style</InputLabel>
                    <Select
                        labelid="rendering-style-selector-label"
                        label="Map Style"
                        value={ctx.tileURL.key}
                        onChange={(e) => ctx.setTileURL(ctx.allTileURLs[e.target.value])}
                    >
                        {Object.values(ctx.allTileURLs).map((item) => {
                            return <MenuItem key={item.key} value={item.key}>{item.uiname}</MenuItem>
                        })}
                    </Select>
                </FormControl>
            </MenuItem>
        </Collapse>
    </>;

}
