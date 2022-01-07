import {
    Paper, Tab, AppBar,
} from "@mui/material";
import AppContext from "../context/AppContext"
import { useState, useContext } from "react";
import { TabContext, TabList, TabPanel } from "@mui/lab";
import Elevation from "./gpxinfo/Elevation";
import Speed from "./gpxinfo/Speed";

const centerStyle = {
    left: "50%",
    transform: 'translate(-50%, 0%)'
}
export default function MapContextMenu({}) {

    const [value, setValue] = useState("1");
    const ctx = useContext(AppContext);
    const handleChange = (event, newValue) => {
        setValue(newValue);
    };

    return (
        <div className="leaflet-bottom" style={centerStyle}>
            <div className="leaflet-control leaflet-bar padding-container" >
                {ctx.selectedGpxFile?.summary ? 
                    <Paper >
                        <TabContext value={value}>
                            <TabPanel value="1"><Elevation renderedGpx={ctx.selectedGpxFile} /></TabPanel>
                            <TabPanel value="2"><Speed renderedGpx={ctx.selectedGpxFile} /></TabPanel>
                            <AppBar position="static" color="default">
                                <TabList onChange={handleChange}>
                                    <Tab value={"1"} label="Elevation" />
                                    <Tab value={"2"} label="Speed" />
                                </TabList>
                            </AppBar>
                        </TabContext>
                    </Paper>
                    :
                    <></>
                }
            </div>
        </div>
    );
}