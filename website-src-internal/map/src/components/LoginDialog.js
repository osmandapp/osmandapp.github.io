import React, { useState, useContext } from 'react';
import { Button, Checkbox, TextField, FormControlLabel, FormGroup } from '@mui/material/';
import Dialog from '@mui/material/Dialog';
import DialogActions from '@mui/material/DialogActions';
import DialogContent from '@mui/material/DialogContent';
import DialogContentText from '@mui/material/DialogContentText';
import DialogTitle from '@mui/material/DialogTitle';
import AppContext from "../context/AppContext"

async function userLogin(data) {
    const response = await fetch(`api/user_login`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ user: data })
    })
    if (!response.ok) {
        const message = `An error has occured: ${response.status}`;
        throw new Error(message);
    }
    const user = await response.json();
    console.log(user);
    return user;
    // json = response.json();
    // console.log(json);
    // return await json;
}

export default function LoginDialog({ open, setOpen }) {
    const ctx = useContext(AppContext);
    const [fieldEmail, setFieldEmail] = useState(ctx.userEmail);
    const [pwd, setPwd] = useState();
    const [noPwd, setNoPwd] = useState(false);
    const handleLogin = () => {
        console.log(fieldEmail);
        ctx.setUserEmail(fieldEmail, { days: 30 });
        userLogin(fieldEmail);
        setOpen(false);

    }
    const handleClose = () => {
        setOpen(false);
    };
    return (
        <Dialog open={open} onClose={handleClose}>
            <DialogTitle>Login</DialogTitle>
            <DialogContent>
                <DialogContentText>You can login to the website only if you have OsmAnd Pro subscription.
                    Please enter your email below.
                </DialogContentText>
                
                    <TextField
                        autoFocus
                        margin="dense"
                        onChange={(e) => setFieldEmail(e.target.value)}
                        id="useremail"
                        label="Email Address"
                        type="email"
                        fullWidth
                        variant="standard"
                        value={fieldEmail}
                    >
                    </TextField>
                    {noPwd ? <></> : <TextField
                        margin="dense"
                        onChange={(e) => setPwd(e.target.value)}
                        id="pwd"
                        label="Password"
                        type="password"
                        fullWidth
                        variant="standard"
                        value={pwd}

                    ></TextField>
                }
                <FormControlLabel control={
                    <Checkbox checked={noPwd} onChange={(e) => setNoPwd(!noPwd)} />
                }
                    label="Don't have password yet?" />

            </DialogContent>
            <DialogActions>
                <Button onClick={handleClose}>Cancel</Button>
                <Button onClick={handleLogin}>Login</Button>
            </DialogActions>
        </Dialog>
    );
}