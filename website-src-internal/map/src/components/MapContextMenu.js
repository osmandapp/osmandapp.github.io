import {
    Paper, Tab, AppBar, Button,
} from "@mui/material";
import AppContext from "../context/AppContext"
import { useState, useContext } from "react";
import { TabContext, TabList, TabPanel } from "@mui/lab";
import GeneralInfo from "./gpxinfo/GeneralInfo";
import Elevation from "./gpxinfo/Elevation";
import Speed from "./gpxinfo/Speed";
import {
    Close
} from '@mui/icons-material';

const centerStyle = {
    left: "50%",
    transform: 'translate(-50%, 0%)'
}


export default function MapContextMenu() {
    const [value, setValue] = useState("general");
    const ctx = useContext(AppContext);
    const handleChange = (event, newValue) => {
        setValue(newValue);
    };
    const hasSpeed = ctx.selectedGpxFile?.summary?.hasSpeedData ;
    const hasAltitude = ctx.selectedGpxFile?.summary?.hasElevationData;
    const graphWidth = 600;
    const tabs = { };
    if (ctx.selectedGpxFile?.summary) {
        tabs.Info = <GeneralInfo key='general' summary={ctx.selectedGpxFile.summary}
            url={ctx.selectedGpxFile.url} width={graphWidth} />;
    }
    const elevationData = ctx.selectedGpxFile?.summary?.elevationData;
    if (elevationData && elevationData.length > 0 && hasAltitude) {
        tabs.Elevation = <Elevation key='elevation' data={elevationData} width={graphWidth} />
    }
    const speedData = ctx.selectedGpxFile?.summary?.speedData;
    if (speedData && speedData.length > 0 && hasSpeed) {
        tabs.Speed = <Speed key='speed' data={speedData} width={graphWidth}/>;
    }
    
    if (ctx.selectedGpxFile?.srtmSummary) {
        tabs.SRTM = <GeneralInfo key='srtm' 
                width={graphWidth} summary={ctx.selectedGpxFile.srtmSummary} />;
    }
    if (ctx.selectedGpxFile?.srtmSummary?.elevationData && 
        ctx.selectedGpxFile.srtmSummary.elevationData.length > 0) {
        tabs["SRTM Ele"] = <Elevation key='srtmele' data={ctx.selectedGpxFile.srtmSummary.elevationData} 
                width={graphWidth} />
    }
    let presentValue = false;
    Object.values(tabs).forEach((item) => {
        if (item.key === value) {
            presentValue = true;
            return false;
        }
    });
    if (!presentValue && value !== 'general') {
        setValue('general');
    }

    let tabList = [];
    // tabList.push(<Button key='close' onClick={() => ctx.setSelectedGpxFile(null)}>
    //     <Close />
    // </Button>);

    tabList = tabList.concat(Object.keys(tabs).map((item, index) => 
        <Tab value={tabs[item].key + ''} label={item} key={'tab:' + item} /> ));
    
    return (
        <div className="leaflet-bottom" style={centerStyle}>
            <div className="leaflet-control leaflet-bar padding-container" >
                {ctx.selectedGpxFile?.summary ? 
                    <Paper >
                        <TabContext value={value} >
                        {Object.values(tabs).map((item, index) =>
                            <TabPanel value={item.key+''} key={'tabpanel:' + item.key} > {item} </TabPanel>)
                        }
                            <AppBar position="static" color="default">
                                <div style={{display : 'inherit'}}>
                                <Button key='close' onClick={() => {
                                        ctx.setSelectedGpxFile(null);
                                        if (ctx.mapMarkerListener) {
                                            ctx.mapMarkerListener();
                                        }
                                }}>
                                    <Close />
                                </Button>
                                <TabList onChange={handleChange} children={tabList}>
                                </TabList>
                                </div>
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