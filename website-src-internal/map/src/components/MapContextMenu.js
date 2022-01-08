import {
    Paper, Tab, AppBar, Typography, Box,
} from "@mui/material";
import AppContext from "../context/AppContext"
import { useState, useContext } from "react";
import { TabContext, TabList, TabPanel } from "@mui/lab";
import GeneralInfo from "./gpxinfo/GeneralInfo";
import Elevation from "./gpxinfo/Elevation";
import Speed from "./gpxinfo/Speed";

const centerStyle = {
    left: "50%",
    transform: 'translate(-50%, 0%)'
}


export default function MapContextMenu() {
    const [value, setValue] = useState("0");
    const ctx = useContext(AppContext);
    const handleChange = (event, newValue) => {
        setValue(newValue);
    };
    const hasSpeed = ctx.selectedGpxFile?.summary?.hasSpeedData ;
    const hasAltitude = ctx.selectedGpxFile?.summary?.hasElevationData;
    const graphWidth = 600;
    const tabs = { };
    if (hasAltitude) {
        tabs.Elevation = <Elevation renderedGpx={ctx.selectedGpxFile} width={graphWidth} />
    }
    if (hasSpeed) {
        tabs.Speed = <Speed renderedGpx={ctx.selectedGpxFile} width={graphWidth}/>;
    }
    tabs.Info = <GeneralInfo renderedGpx={ctx.selectedGpxFile} width={graphWidth} />;

    const tabList = Object.keys(tabs).map((item, index) => <Tab value={index+''} label={item} key={index} /> );
    return (
        <div className="leaflet-bottom" style={centerStyle}>
            <div className="leaflet-control leaflet-bar padding-container" >
                {ctx.selectedGpxFile?.summary ? 
                    <Paper >
                        <TabContext value={value} >
                        {Object.values(tabs).map((item, index) =>
                            <TabPanel value={index + ''} key={index} > {item} </TabPanel>)
                        }
                            <AppBar position="static" color="default">
                                <TabList onChange={handleChange} children={tabList}>
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