import React, { useEffect, useRef, useContext, useState, useMemo, useCallback } from 'react';
import { Marker, GeoJSON, useMap } from "react-leaflet";
import L from 'leaflet';
import MarkerIcon from './MarkerIcon.js'
import AppContext from "../context/AppContext";


async function calcRoute(startPoint, endPoint, routeMode, setRouteData) {
    // encodeURIComponent(startPoint.lat)
    setRouteData(null);
    const starturl = `points=${startPoint.lat.toFixed(6)},${startPoint.lng.toFixed(6)}`;
    const endurl = `points=${endPoint.lat.toFixed(6)},${endPoint.lng.toFixed(6)}`;
    const response = await fetch(`/routing/route?routeMode=${routeMode.mode}&${starturl}&${endurl}`, {
        method: 'GET',
        headers: { 'Content-Type': 'application/json' }
    });
    if (response.ok) {
        let data = await response.json();
        setRouteData({ geojson: data, id: new Date().getTime() });
    }
}
const setRoutePoints = (setStartPoint, setEndPoint, ctx) => (e) => {
    if (setStartPoint) {
        setStartPoint(e.latlng);
        ctx.startPoint = e.latlng;
    } else if (setEndPoint) {
        setEndPoint(e.latlng);
        ctx.endPoint = e.latlng;
    }
}

const RouteLayer = () => {
    const map = useMap();
    const ctx = useContext(AppContext);
    const startPointRef = useRef(null);
    const endPointRef = useRef(null);
    const startEventHandlers = useCallback({
        dragend() {
            const marker = startPointRef.current;
            if (marker != null) {
                ctx.setStartPoint(marker.getLatLng());
            }
        }
    }, [ctx.setStartPoint, startPointRef]);
    const endEventHandlers = useCallback({
        dragend() {
            const marker = endPointRef.current;
            if (marker != null) {
                ctx.setEndPoint(marker.getLatLng());
            }
        }
    }, [ctx.setEndPoint, endPointRef]);

    useEffect(() => {
        if (ctx.startPoint && ctx.endPoint) {
            calcRoute(ctx.startPoint, ctx.endPoint, ctx.routeMode, ctx.setRouteData);
        }
    }, [ctx.routeMode, ctx.startPoint, ctx.endPoint, ctx.setRouteData])

    useEffect(() => {
        if (map) {
            // const map = mapRef.current;
            map.contextmenu.removeAllItems();
            map.contextmenu.addItem({
                text: 'Set as start',
                callback: setRoutePoints(ctx.setStartPoint, null, ctx.startPoint, ctx.endPoint, ctx.setRouteData)
            });
            map.contextmenu.addItem({
                text: 'Set as end',
                callback: setRoutePoints(null, ctx.setEndPoint, ctx.startPoint, ctx.endPoint, ctx.setRouteData)
            });
        }
    }, [ctx.startPoint, ctx.endPoint, ctx.setStartPoint, ctx.setEndPoint, map, ctx.setRouteData]);
    const geojsonMarkerOptions = {
        radius: 8,
        fillColor: "#ff7800",
        color: "#000",
        weight: 1,
        opacity: 1,
        fillOpacity: 0.8
    };
    const onEachFeature = (feature, layer) => {
        if (feature.properties && feature.properties.description) {
            layer.bindPopup(feature.properties.description);
        }
    }
    const pointToLayer = (feature, latlng) => {
        return L.circleMarker(latlng, geojsonMarkerOptions);
    };


    return <>
        {ctx.routeData && <GeoJSON key={ctx.routeData.id} data={ctx.routeData.geojson}
            pointToLayer={pointToLayer} onEachFeature={onEachFeature} />}
        {ctx.startPoint && //<CircleMarker center={ctx.startPoint} radius={5} pathOptions={{ color: 'green' }} opacity={1}
            <Marker position={ctx.startPoint} icon={MarkerIcon({ bg: 'blue' })}
                ref={startPointRef} draggable={true} eventHandlers={startEventHandlers} />}
        {ctx.endPoint && <Marker position={ctx.endPoint} icon={MarkerIcon({ bg: 'red' })}
            ref={endPointRef} draggable={true} eventHandlers={endEventHandlers} />}
    </>;
};

export default RouteLayer;
