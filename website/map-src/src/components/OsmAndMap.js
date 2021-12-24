import React from "react";
import { makeStyles } from "@material-ui/core/styles";
import { MapContainer, TileLayer, Marker, Popup } from "react-leaflet";

const useStyles = makeStyles((theme) => ({
  root: {
    width: "100%",
    height: "100%"
  },
}));
// initial location on map
const position = [50, 5];
// sample locations
const locations = [
  {
    title: "Kiyv",
    description: "Ksenia + Dima",
    coordinates: [50.4434, 30.5119],
  },
  {
    title: "Vinnitsya",
    description: "Ivan",
    coordinates: [49.2378, 28.4709],
  },
  {
    title: "Amsterdam",
    description: "Victor",
    coordinates: [52.3590, 4.8952],
  }
];
const OsmAndMap = () => {
  const classes = useStyles();
  return (
    <MapContainer center={position} zoom={5} className={classes.root}>
      <TileLayer
        attribution='&amp;copy <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
        url="https://tile.osmand.net/hd/{z}/{x}/{y}.png"
      />
      {locations.map((item) => (
        <Marker key={item.title} position={item.coordinates}>
          <Popup>
            <h1>{item.title}</h1>
            <p>{item.description}</p>
          </Popup>
        </Marker>
      ))}
    </MapContainer>
  );
};
export default OsmAndMap;
