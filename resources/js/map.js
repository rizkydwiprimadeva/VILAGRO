const DEFAULT_MAP_CENTER = [-2.5, 118];
const mapInstances = new Map();

function setMapStatus(mapElement, message) {
    const status = document.getElementById(
        mapElement.id === "farm-map" ? "farm-map-status" : "scan-map-status",
    );

    if (status) {
        status.textContent = message;
    }
}

function validCoordinate(latitude, longitude) {
    return (
        Number.isFinite(latitude) &&
        Number.isFinite(longitude) &&
        latitude >= -90 &&
        latitude <= 90 &&
        longitude >= -180 &&
        longitude <= 180
    );
}

function createPopup(title, details) {
    const content = document.createElement("div");
    const heading = document.createElement("strong");
    heading.textContent = title;
    content.append(heading);

    if (details) {
        const detail = document.createElement("p");
        detail.className = "mt-1";
        detail.textContent = details;
        content.append(detail);
    }

    return content;
}

function initializeMap(mapElement) {
    if (!window.L) {
        setMapStatus(
            mapElement,
            "Peta tidak dapat dimuat. Anda masih dapat mengisi koordinat atau menggunakan lokasi perangkat.",
        );
        return;
    }

    const latitudeInput = document.getElementById(
        mapElement.dataset.latitudeInput,
    );
    const longitudeInput = document.getElementById(
        mapElement.dataset.longitudeInput,
    );
    const inputLatitude = Number.parseFloat(latitudeInput?.value ?? "");
    const inputLongitude = Number.parseFloat(longitudeInput?.value ?? "");
    const hasInputLocation = validCoordinate(inputLatitude, inputLongitude);
    const map = window.L.map(mapElement, { scrollWheelZoom: false });
    const initialCenter = hasInputLocation
        ? [inputLatitude, inputLongitude]
        : DEFAULT_MAP_CENTER;

    map.setView(initialCenter, hasInputLocation ? 13 : 5);
    window.L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
        attribution:
            '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
    }).addTo(map);
    window.L.control.scale().addTo(map);

    let selectedMarker = null;
    const updateLocation = (latitude, longitude, panTo = true) => {
        if (!validCoordinate(latitude, longitude)) {
            setMapStatus(mapElement, "Koordinat tidak valid.");
            return;
        }

        latitudeInput && (latitudeInput.value = latitude.toFixed(7));
        longitudeInput && (longitudeInput.value = longitude.toFixed(7));

        if (!selectedMarker) {
            selectedMarker = window.L.marker([latitude, longitude]).addTo(map);
        } else {
            selectedMarker.setLatLng([latitude, longitude]);
        }

        selectedMarker.bindPopup(createPopup("Lokasi yang dipilih"));

        if (panTo) {
            map.setView([latitude, longitude], Math.max(map.getZoom(), 13));
        }

        setMapStatus(
            mapElement,
            `Lokasi dipilih: ${latitude.toFixed(5)}, ${longitude.toFixed(5)}.`,
        );
    };

    if (hasInputLocation) {
        updateLocation(inputLatitude, inputLongitude, false);
    }

    map.on("click", (event) => {
        if (latitudeInput && longitudeInput) {
            updateLocation(event.latlng.lat, event.latlng.lng);
        }
    });

    mapInstances.set(mapElement.id, { map, updateLocation });

    if (mapElement.id !== "farm-map") {
        return;
    }

    const mapData = window.vilagroFarmMapData ?? { reports: [], farms: [] };
    const bounds = [];

    mapData.reports.forEach((report) => {
        const point = [report.latitude, report.longitude];
        const marker = window.L.circleMarker(point, {
            color: "#ba1a1a",
            fillColor: "#ba1a1a",
            fillOpacity: 0.85,
            radius: 8,
        }).addTo(map);

        marker.bindPopup(
            createPopup(
                report.name,
                `Dilaporkan ${report.created_at}${
                    report.confidence === null
                        ? ""
                        : ` · skor model ${report.confidence}%`
                }`,
            ),
        );
        bounds.push(point);
    });

    mapData.farms.forEach((farm) => {
        const point = [farm.latitude, farm.longitude];
        const marker = window.L.circleMarker(point, {
            color: "#072417",
            fillColor: "#072417",
            fillOpacity: 0.75,
            radius: 7,
        }).addTo(map);

        marker.bindPopup(
            createPopup(
                "Kebun petani mitra",
                "Titik lokasi perkiraan dibagikan dengan persetujuan pemilik.",
            ),
        );
        bounds.push(point);
    });

    if (bounds.length > 0 && !hasInputLocation) {
        map.fitBounds(bounds, { maxZoom: 12, padding: [24, 24] });
    }
}

document
    .querySelectorAll("#scan-location-map, #farm-map")
    .forEach(initializeMap);

document.querySelectorAll("[data-location-map]").forEach((button) => {
    button.addEventListener("click", () => {
        const mapElement = document.getElementById(button.dataset.locationMap);
        const target = mapInstances.get(button.dataset.locationMap);

        if (!mapElement) {
            return;
        }

        if (!navigator.geolocation) {
            setMapStatus(mapElement, "Browser ini tidak mendukung fitur lokasi. Pilih titik pada peta atau isi koordinat secara manual.");
            return;
        }

        button.disabled = true;
        navigator.geolocation.getCurrentPosition(
            (position) => {
                if (target) {
                    target.updateLocation(
                        position.coords.latitude,
                        position.coords.longitude,
                    );
                } else {
                    const latitudeInput = document.getElementById(
                        mapElement.dataset.latitudeInput,
                    );
                    const longitudeInput = document.getElementById(
                        mapElement.dataset.longitudeInput,
                    );

                    if (latitudeInput && longitudeInput) {
                        latitudeInput.value = position.coords.latitude.toFixed(7);
                        longitudeInput.value = position.coords.longitude.toFixed(7);
                        setMapStatus(
                            mapElement,
                            "Lokasi perangkat berhasil diisi. Peta belum dapat dimuat.",
                        );
                    }
                }
                button.disabled = false;
            },
            () => {
                setMapStatus(mapElement, "Lokasi tidak dapat diakses. Izinkan akses lokasi atau pilih titik pada peta.");
                button.disabled = false;
            },
            { enableHighAccuracy: true, maximumAge: 60000, timeout: 10000 },
        );
    });
});

[
    ["scan-latitude", "scan-longitude", "scan-location-map"],
    ["farm-latitude", "farm-longitude", "farm-map"],
].forEach(([latitudeId, longitudeId, mapId]) => {
    const latitudeInput = document.getElementById(latitudeId);
    const longitudeInput = document.getElementById(longitudeId);
    const target = mapInstances.get(mapId);

    if (!latitudeInput || !longitudeInput || !target) {
        return;
    }

    const updateFromInputs = () => {
        const latitude = Number.parseFloat(latitudeInput.value);
        const longitude = Number.parseFloat(longitudeInput.value);

        if (validCoordinate(latitude, longitude)) {
            target.updateLocation(latitude, longitude, false);
        }
    };

    latitudeInput.addEventListener("change", updateFromInputs);
    longitudeInput.addEventListener("change", updateFromInputs);
});
