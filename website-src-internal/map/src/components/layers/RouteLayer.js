import React, { useEffect, useRef, useContext, useState, useMemo, useCallback } from 'react';
import { Marker, CircleMarker, GeoJSON, useMap } from "react-leaflet";
import L from 'leaflet';
import MarkerIcon from '../MarkerIcon.js'
import AppContext from "../../context/AppContext";




function moveableMarker(ctx, map, marker) {
    let moved ;
    function trackCursor(evt) {
        marker.setLatLng(evt.latlng)
    }

    marker.on("mousedown", () => {
        moved = marker._point;//marker.getLatLng();
        map.dragging.disable()
        map.on("mousemove", trackCursor)
    })

    marker.on("mouseup", () => {
        map.dragging.enable();
        map.off("mousemove", trackCursor);
        if (moved && Math.abs(moved.x - marker._point.x) + Math.abs(moved.y - marker._point.y) > 10) {
            ctx.setInterPoints([marker.getLatLng()]);
        }
    })

    return marker
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
                ctx.setRouteTrackFile(null);
            }
        }
    }, [ctx.setStartPoint, startPointRef]);
    const endEventHandlers = useCallback({
        dragend() {
            const marker = endPointRef.current;
            if (marker != null) {
                ctx.setEndPoint(marker.getLatLng());
                ctx.setRouteTrackFile(null);
            }
        }
    }, [ctx.setEndPoint, endPointRef]);


    useEffect(() => {
        if (map) {
            // const map = mapRef.current;
            map.contextmenu.removeAllItems();
            map.contextmenu.addItem({
                text: 'Set as start',
                callback: (e) => ctx.setStartPoint(e.latlng)
            });
            map.contextmenu.addItem({
                text: 'Set as end',
                callback: (e) => ctx.setEndPoint(e.latlng)
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
        let opts = Object.assign({}, geojsonMarkerOptions);
        if (feature.properties && feature.properties.description && 
            feature.properties.description.includes('[MUTE]')) {
            opts.fillColor = '#777';
        }
        return moveableMarker(ctx, map, L.circleMarker(latlng, opts));
    };


    return <>
        {ctx.routeData && <GeoJSON key={ctx.routeData.id} data={ctx.routeData.geojson}
            pointToLayer={pointToLayer} onEachFeature={onEachFeature} />}
        {ctx.startPoint && //<CircleMarker center={ctx.startPoint} radius={5} pathOptions={{ color: 'green' }} opacity={1}
            <Marker position={ctx.startPoint} icon={MarkerIcon({ bg: 'blue' })}
                ref={startPointRef} draggable={true} eventHandlers={startEventHandlers} />}
        {ctx.interPoints.map((it, ind) => 
            //<CircleMarker key={'mark'+ind} center={it} radius={5} pathOptions={{ color: 'green' }} opacity={1}
            <Marker key={'mark' + ind} position={it} icon={MarkerIcon({ bg: 'blue' })} draggable={true}
                 />)}
        {ctx.endPoint && <Marker position={ctx.endPoint} icon={MarkerIcon({ bg: 'red' })}
            ref={endPointRef} draggable={true} eventHandlers={endEventHandlers} />}
    </>;
};

export default RouteLayer;
