import {
    Drawer, Toolbar, Typography, Box, Paper, Button,
    Grid,
} from "@mui/material";
const centerStyle = {
    left: "50%",
    transform: 'translate(-50%, 0%)'
}
export default function GpxInfo({ }) {
    return (
        <div className="leaflet-bottom" style={centerStyle}>
            <div className="leaflet-control leaflet-bar padding-container" >
                <Paper >
                    <Typography type="title" color="inherit" sx={{ p: 2 }}>
                        Here will be a track graph
                    </Typography>
                    <div>
                        <Box sx={{ px: 1, mx: "auto" }}>
                            <Button >
                                Button 1
                            </Button>
                            <Button >
                                Button 2
                            </Button>
                        </Box>
                    </div>
                </Paper>
            </div>
        </div>);
}