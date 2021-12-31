import React, { useState, useEffect } from 'react';
import {
    Air, Cloud, Compress, Shower, Thermostat
} from '@mui/icons-material';
import useCookie from 'react-use-cookie';

const osmandTileURL = 'https://tile.osmand.net/hd/{z}/{x}/{y}.png';

function getWeatherUrl(layer) {
    // const urlWeatherPefix = '.';
    const urlWeatherPefix = 'https://test.osmand.net/weather/gfs';
    return urlWeatherPefix + '/tiles/' + layer + '/{time}/{z}/{x}/{y}.png';
}
function getLayers() {
    const layers = [
        { key: "temperature", name: "Temperature", opacity: 0.5, iconComponent: <Thermostat fontSize="small" /> },
        { key: "pressure", name: "Pressure", opacity: 0.6, iconComponent: <Compress fontSize="small" /> },
        { key: "wind", name: "Wind", opacity: 0.6, iconComponent: <Air fontSize="small" /> },
        { key: "cloud", name: "Cloud", opacity: 0.5, iconComponent: <Cloud fontSize="small" /> },
        { key: "precip", name: "Precipitation", opacity: 0.7, iconComponent: <Shower fontSize="small" /> },
    ];
    layers.map((item) => {
        item.url = getWeatherUrl(item.key);
        item.maxNativeZoom = 3;
        item.maxZoom = 11;
        item.checked = false;
        return item;
    });
    return layers;
}

async function loadListFiles(listFiles, setListFiles) {
    const response = await fetch(`/map/api/list-files`, {});
    const res = await response.json();
    setListFiles(res);
}
async function checkUserLogin(loginUser, setLoginUser, userEmail, setUserEmail, listFiles, setListFiles) {
    const response = await fetch(`/map/api/auth/info`, {
        method: 'GET'
    });
    if (response.ok) {
        const user = await response.json();
        let newUser = user && user.principal ? user.principal.username : null;
        if (loginUser != newUser) {
            if (newUser) {
                setUserEmail(newUser, { days: 30 });
            }
            setLoginUser(newUser);
            loadListFiles(listFiles, setListFiles);
        }
    }
}


function getWeatherDate() {
    // // "20211222_0600"
    // let [searchParams, setSearchParams] = useSearchParams();
    const searchParams = new URLSearchParams(window.location.search);
    const weatherDateObj = new Date();
    if (searchParams.get("date")) {
        let weather_date = searchParams.get("date");
        weatherDateObj.setUTCFullYear(parseInt(weather_date.slice(0, 4)));
        weatherDateObj.setUTCMonth(parseInt(weather_date.slice(4, 6)) - 1);
        weatherDateObj.setUTCDate(parseInt(weather_date.slice(6, 8)));
        weatherDateObj.setUTCHours(parseInt(weather_date.slice(9, 11)));
    }
    weatherDateObj.setUTCMinutes(0);
    weatherDateObj.setUTCSeconds(0);
    return weatherDateObj;
}
// var originalDateObj = new Date(weatherDateObj);
const AppContext = React.createContext();

export const AppContextProvider = (props) => {
    const [weatherLayers, updateWeatherLayers] = useState(getLayers());
    const [weatherDate, setWeatherDate] = useState(getWeatherDate());
    // cookie to store email logged in
    const [userEmail, setUserEmail] = useCookie('email', '');
    // server state of login
    const [loginUser, setLoginUser] = useState(null);
    const [listFiles, setListFiles] = useState(null);
    useEffect(() => {
        checkUserLogin(loginUser, setLoginUser, userEmail, setUserEmail,
            listFiles, setListFiles);
    }, [loginUser]);
    return <AppContext.Provider value={{
        weatherLayers: weatherLayers, updateWeatherLayers: updateWeatherLayers,
        weatherDate: weatherDate, setWeatherDate: setWeatherDate,
        userEmail: userEmail, setUserEmail: setUserEmail,
        listFiles: listFiles, setListFiles: setListFiles,
        loginUser: loginUser, setLoginUser: setLoginUser,
        tileURL: osmandTileURL
    }}>
        {props.children}
    </AppContext.Provider>;
};

export default AppContext;