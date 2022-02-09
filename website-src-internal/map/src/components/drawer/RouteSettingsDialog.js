import React, { useState, useContext } from 'react';
import { Button, Checkbox, FormControlLabel } from '@mui/material/';
import Dialog from '@mui/material/Dialog';
import DialogActions from '@mui/material/DialogActions';
import DialogContent from '@mui/material/DialogContent';
import DialogTitle from '@mui/material/DialogTitle';
import AppContext from "../../context/AppContext"

export default function RouteSettingsDialog({setOpenSettings}) {
    const ctx = useContext(AppContext);
    const [opts, setOpts] = useState(ctx.routeMode.opts);
    const handleClose = () => {
        setOpenSettings(false);
        setOpts(ctx.routeMode.opts);
    };
    const handleAccept = () => {
        setOpenSettings(false);
        let newRouteMode = Object.assign({}, ctx.routeMode);
        newRouteMode.opts = opts;
        ctx.setRouteMode(newRouteMode);
    };
    return (
        <Dialog open={true} onClose={handleClose}>
            <DialogTitle>Additional Route Settings</DialogTitle>
            <DialogContent>
                {Object.entries(opts).map(([key, opt]) => 
                    <>
                        <FormControlLabel key={key} control={
                            <Checkbox key={'check_' + key} checked={opt.value} onChange={(e) => {
                                let nopts = Object.assign({}, opts)
                                nopts[key].value = !nopts[key].value;
                                setOpts(nopts);
                            }} />} label={opt.label} />
                        <br></br>
                    </>
                )}

            </DialogContent>
            <DialogActions>
                <Button onClick={handleClose}>Cancel</Button>
                <Button onClick={handleAccept}>OK</Button>
            </DialogActions>
        </Dialog>
    );
}