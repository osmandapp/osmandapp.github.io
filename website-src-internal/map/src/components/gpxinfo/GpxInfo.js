import {
    Paper, Tab, AppBar,
} from "@mui/material";

import TabPanel from '@mui/lab/TabPanel';
import {useState} from "react";
import {TabContext, TabList} from "@mui/lab";
import Elevation from "./Elevation";
import Speed from "./Speed";

const centerStyle = {
    left: "50%",
    transform: 'translate(-50%, 0%)'
}
export default function GpxInfo( props ) {

    const [value, setValue] = useState("1");

    const handleChange = (event, newValue) => {
        setValue(newValue);
    };

    return (
        <div className="leaflet-bottom" style={centerStyle}>
            <div className="leaflet-control leaflet-bar padding-container" >
                <Paper >
                    <TabContext value={value}>
                        <TabPanel value="1">{props.renderedGpx && <Elevation renderedGpx={props.renderedGpx}/>}</TabPanel>
                        <TabPanel value="2">{props.renderedGpx && <Speed renderedGpx={props.renderedGpx}/>}</TabPanel>
                    <AppBar position="static" color="default">
                        <TabList onChange={handleChange}>
                            <Tab value={"1"} label="Elevation"/>
                            <Tab value={"2"} label="Speed"/>
                        </TabList>
                    </AppBar>
                    </TabContext>
                </Paper>
            </div>
        </div>);
}