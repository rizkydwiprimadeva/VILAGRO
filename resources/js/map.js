function initializeVillageMap() {
    var mapSection = document.querySelector(".village-map");

    if (!mapSection) {
        return;
    }

    var map = mapSection.querySelector("#kediri-map-group");
    var infoPanel = mapSection.querySelector("#info-panel");
    var infoTitle = mapSection.querySelector("#info-title");
    var infoDescription = mapSection.querySelector("#info-desc");
    var closeButton = mapSection.querySelector("#close-btn");

    if (!map || !infoPanel || !infoTitle || !infoDescription || !closeButton) {
        return;
    }

    function getField(target) {
        if (!(target instanceof Element)) {
            return null;
        }

        var field = target.closest('path[data-nama][data-deskripsi]');
        var fieldGroup = field ? field.closest('g[class^="sawah-"]') : null;

        return fieldGroup && map.contains(fieldGroup) ? field : null;
    }

    function showField(field) {
        mapSection.querySelectorAll("path.active").forEach(function (activeField) {
            activeField.classList.remove("active");
            activeField.setAttribute("aria-pressed", "false");
        });

        field.classList.add("active");
        field.setAttribute("aria-pressed", "true");
        infoTitle.textContent = field.getAttribute("data-nama");
        infoDescription.textContent = field.getAttribute("data-deskripsi");
        infoPanel.hidden = false;
    }

    function hideInfo() {
        infoPanel.hidden = true;
        mapSection.querySelectorAll("path.active").forEach(function (activeField) {
            activeField.classList.remove("active");
            activeField.setAttribute("aria-pressed", "false");
        });
    }

    mapSection.querySelectorAll('#kediri-map-group > g[class^="sawah-"] > path[data-nama][data-deskripsi]').forEach(function (field) {
        field.setAttribute("tabindex", "0");
        field.setAttribute("role", "button");
        field.setAttribute("aria-pressed", "false");
        field.setAttribute(
            "aria-label",
            field.getAttribute("data-nama") + ". " + field.getAttribute("data-deskripsi")
        );
    });

    map.addEventListener("click", function (event) {
        var field = getField(event.target);

        if (field) {
            showField(field);
        }
    });

    map.addEventListener("keydown", function (event) {
        var field = getField(event.target);

        if (field && (event.key === "Enter" || event.key === " ")) {
            event.preventDefault();
            showField(field);
        }
    });

    closeButton.addEventListener("click", hideInfo);
}

if (document.readyState === "loading") {
    document.addEventListener("DOMContentLoaded", initializeVillageMap, { once: true });
} else {
    initializeVillageMap();
}
