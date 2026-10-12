const fs = require('fs');

async function getMap() {
    console.log("Fetching Kaltim boundaries from Overpass API...");
    const query = `
        [out:json][timeout:60];
        area["name"="Kalimantan Timur"]->.searchArea;
        (
          relation["admin_level"="6"](area.searchArea);
        );
        out geom;
    `;
    
    try {
        const res = await fetch("https://overpass-api.de/api/interpreter", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
                "Accept": "application/json",
                "User-Agent": "NodeJS/MapFetcher (contact@example.com)"
            },
            body: "data=" + encodeURIComponent(query)
        });
        
        if (!res.ok) {
            console.error("HTTP Error:", res.status, res.statusText);
            return;
        }
        
        const data = await res.json();
        console.log("Got data, elements:", data.elements?.length);
        
        fs.writeFileSync("kaltim.json", JSON.stringify(data));
        console.log("Saved raw to kaltim.json");
        
    } catch (e) {
        console.error(e);
    }
}

getMap();
