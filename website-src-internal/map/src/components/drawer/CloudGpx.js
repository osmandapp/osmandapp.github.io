import React, { useEffect, useState, useContext } from 'react';
import { styled } from '@mui/material/styles';
import {
    Typography, ListItemText, Switch, Collapse, 
    IconButton, MenuItem, ListItemIcon, Tooltip,
} from "@mui/material";
import {
    DirectionsWalk, ExpandLess, ExpandMore, Sort, SortByAlpha
} from '@mui/icons-material';
import AppContext from "../../context/AppContext"

export default function CloudGpx({ setAppText }) {
    const ctx = useContext(AppContext);
    const [gpxOpen, setGpxOpen] = useState(false);
    let gpxFiles = (!ctx.listFiles || !ctx.listFiles.uniqueFiles ? [] :
        ctx.listFiles.uniqueFiles).filter((item) => {
            return (item.type === 'gpx' || item.type === 'GPX')
                && (item.name.slice(-4) === '.gpx' || item.name.slice(-4) === '.GPX');
        });
    return <>
        <MenuItem onClick={(e) => setGpxOpen(!gpxOpen)}>
            <ListItemIcon>
                <DirectionsWalk fontSize="small" />
            </ListItemIcon>
            <ListItemText>Tracks {gpxFiles.length > 0 ? `(${gpxFiles.length})` : ''} </ListItemText>
            <Typography variant="body2" color="textSecondary">
                GPX
            </Typography>
            {
                gpxFiles.length === 0 ? <></> :
                    gpxOpen ? <ExpandLess /> : <ExpandMore />
            }
        </MenuItem>

        <Collapse in={gpxOpen} timeout="auto" unmountOnExit>
            <MenuItem disableRipple={true}>
                <IconButton sx={{ ml: 2 }}>
                    <Sort fontSize="small" />
                </IconButton>
                <IconButton sx={{ ml: 2 }}>
                    <SortByAlpha fontSize="small" />
                </IconButton>
            </MenuItem>
            {gpxFiles.map((item, index) => (
                <MenuItem key={item.name}>
                    <Tooltip title={item.name}>
                        <ListItemText inset>
                            <Typography variant="inherit" noWrap>
                                {item.name.slice(0, -4).replace('_', ' ')}
                            </Typography>
                        </ListItemText>
                    </Tooltip>
                    <Switch
                        checked={ctx.gpxFiles[item.name]?.url ? true : false}
                        onChange={(e) => {
                            let url = `/map/api/download-file?type=${encodeURIComponent(item.type)}&name=${encodeURIComponent(item.name)}`;
                            const newGpxFiles = Object.assign({}, ctx.gpxFiles);
                            if (!e.target.checked) {
                                // delete newGpxFiles[item.name];
                                newGpxFiles[item.name].url = null;
                            } else {
                                newGpxFiles[item.name] = {
                                    'url': url
                                }
                            }
                            ctx.setGpxFiles(newGpxFiles);

                        }} />
                </MenuItem>
            ))}
        </Collapse>
    </>;

}