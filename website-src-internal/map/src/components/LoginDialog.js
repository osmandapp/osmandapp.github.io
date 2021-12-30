import React, { useState, useContext } from 'react';
import { Button, Checkbox, TextField, FormControlLabel, FormGroup } from '@mui/material/';
import Dialog from '@mui/material/Dialog';
import DialogActions from '@mui/material/DialogActions';
import DialogContent from '@mui/material/DialogContent';
import DialogContentText from '@mui/material/DialogContentText';
import DialogTitle from '@mui/material/DialogTitle';
import AppContext from "../context/AppContext"


async function userRegister(username, setEmailError, setState) {
    const response = await fetch(`/map/api/auth/register`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ 'username': username })
    });
    if (!response.ok) {
        const message = `An error has occured: ${response.message}`;
        setEmailError(message);
        return false;
    }
    const user = await response.json();
    if (user.status == 'OK') {
        setState('register-verify');
        return true;
    }
    return false;
}

async function userActivate(ctx, username, pwd, token, setEmailError, setOpen) {
    const response = await fetch(`/map/api/auth/activate`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ 'username': username, 'password': pwd, 'token' : token })
    });
    if (!response.ok) {
        const message = `An error has occured: ${response.message}`;
        setEmailError(message);
        return false;
    }
    const user = await response.json();
    if (user.status == 'OK') {
        ctx.setUserEmail(username, { days: 30 });
        setOpen(false);
        return true;
    }
    return false;
}

async function userLogout(ctx, username, setEmailError, setOpen, setState) {
    const response = await fetch(`/map/api/auth/logout`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ 'username': username })
    });
    if (!response.ok) {
        const message = `An error has occured: ${response.message}`;
        setEmailError(message);
        return false;
    }
    const user = await response.json();
    if (user.status == 'OK') {
        ctx.setUserEmail('');
        setState('login');
        setOpen(false);
        return true;
    }
    return false;
}


async function userLogin(ctx, username, pwd, setEmailError, setOpen) {
    const response = await fetch(`/map/api/auth/login`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ 'username': username, 'password': pwd })
    });
    if (!response.ok) {
        const message = `An error has occured: ${response.message}`;
        setEmailError(message);
        return false;
    }
    const user = await response.json();
    if (user.status == 'OK') {
        ctx.setUserEmail(username, { days: 30 });
        setOpen(false);
        return true;
    }
    return false;
}

export default function LoginDialog({ open, setOpen }) {
    const ctx = useContext(AppContext);
    const [userEmail, setUserEmail] = useState(ctx.userEmail);
    const [pwd, setPwd] = useState();
    const [code, setCode] = useState();
    const [emailError, setEmailError] = useState('');
    const [state, setState] = useState('login'); // login, register, register-verify
    
    const handleLogin = () => {
        if ( state === 'register' ) {
            userRegister(userEmail, setEmailError, setState);
        } else if (state === 'register-verify') {
            userActivate(ctx, userEmail, pwd, code, setEmailError, setOpen);
        } else {
            userLogin(ctx, userEmail, pwd, setEmailError, setOpen, setState);
        }
    }
    const handleClose = () => {
        setOpen(false);
        setEmailError('');
    };
    if (ctx.userEmail) {
        return (
            <Dialog open={open} onClose={handleClose}>    
            <DialogTitle>{ctx.userEmail}</DialogTitle>
            <DialogContent>
                <DialogContentText>
                    You logged in as {ctx.userEmail}
                </DialogContentText>
            </DialogContent>
                <DialogActions>
                    <Button onClick={handleClose}>Cancel</Button>
                    <Button onClick={(e) => userLogout(ctx, userEmail, setEmailError, setOpen, setState)}>
                        Logout</Button>
                </DialogActions>
                </Dialog>);

    }
    return (
        <Dialog open={open} onClose={handleClose}>
            <DialogTitle>{state === 'register' ? 'Register' : (
                state === 'register-verify' ? 'Verify your email' : 'Login'
            )}</DialogTitle>
            <DialogContent>
                <DialogContentText>
                    {state === 'register-verify' ?
                        `Please check your email and enter verification code`:
                        `You can login to the website only if you have OsmAnd Pro subscription.
                         Please enter your email below.`
                    }
                </DialogContentText>
                
                    <TextField
                        autoFocus
                        margin="dense"
                        onChange={(e) => {
                            if (emailError != '') {
                                setEmailError('')
                            }
                            setUserEmail(e.target.value);
                        }}
                        id="username"
                        label="Email Address"
                        type="email"
                        fullWidth
                        variant="standard"
                        helperText={emailError}
                        error={emailError.length > 0}
                        value={userEmail}
                    >
                    </TextField>
                    {state != 'register-verify' ? <></> : <TextField
                        margin="dense"
                        onChange={(e) => setCode(e.target.value)}
                        id="code"
                        label="Code from Email"
                        type="text"
                        fullWidth
                        variant="standard"
                        value={code}
                    ></TextField>
                    }
                    {state === 'register' ? <></> : <TextField
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
                {state === 'register-verify' ? <></> :
                    <FormControlLabel control={
                        <Checkbox checked={state === 'register'} onChange={(e) =>
                            setState(state === 'login' ? 'register' : 'login')} />}
                        label="Don't have the password or forgot it?" />
                }

            </DialogContent>
            <DialogActions>
                <Button onClick={handleClose}>Cancel</Button>
                <Button onClick={handleLogin}>{
                    state === 'register' ? 'Register' : (
                        state === 'register-verify' ? 'Activate' : 'Login' 
                    )}</Button>
            </DialogActions>
        </Dialog>
    );
}