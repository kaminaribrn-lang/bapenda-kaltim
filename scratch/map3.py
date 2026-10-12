import urllib.request
import json
import time

query = """
[out:json][timeout:60];
area["name"="Kalimantan Timur"]->.searchArea;
(
  relation["admin_level"="6"](area.searchArea);
);
out geom;
"""

url = "http://overpass-api.de/api/interpreter"
data = query.encode("utf-8")

print("Querying Overpass API...")
try:
    req = urllib.request.Request(url, data=data)
    response = urllib.request.urlopen(req)
    res_data = json.loads(response.read())
except Exception as e:
    print("Error:", e)
    import sys
    sys.exit(1)

min_lon, max_lon = 180, -180
min_lat, max_lat = 90, -90

# Pre-calculate bounding box
elements = res_data.get('elements', [])
print(f"Found {len(elements)} elements.")

# Filter and collect paths
target_kabs = ['berau', 'kutai timur', 'kutai kartanegara', 'kutai barat', 'samarinda', 'balikpapan', 'bontang', 'penajam', 'paser']

valid_elements = []
for el in elements:
    if el['type'] == 'relation':
        tags = el.get('tags', {})
        name = tags.get('name', '').lower()
        if any(tk in name for tk in target_kabs):
            valid_elements.append(el)

print(f"Valid elements: {len(valid_elements)}")

for el in valid_elements:
    bounds = el.get('bounds')
    if bounds:
        min_lon = min(min_lon, bounds['minlon'])
        max_lon = max(max_lon, bounds['maxlon'])
        min_lat = min(min_lat, bounds['minlat'])
        max_lat = max(max_lat, bounds['maxlat'])
    else:
        # compute from geom
        for member in el.get('members', []):
            for pt in member.get('geometry', []):
                lon, lat = pt['lon'], pt['lat']
                min_lon = min(min_lon, lon)
                max_lon = max(max_lon, lon)
                min_lat = min(min_lat, lat)
                max_lat = max(max_lat, lat)

def project(lon, lat, width=480, height=520):
    pad = 20
    eff_w = width - 2*pad
    eff_h = height - 2*pad
    x = (lon - min_lon) / (max_lon - min_lon)
    y = (lat - min_lat) / (max_lat - min_lat)
    return pad + x * eff_w, pad + (1 - y) * eff_h

svg_paths = {}
centroids = {}

for el in valid_elements:
    tags = el.get('tags', {})
    name = tags.get('name', '').lower()
    
    id_map = {
        'berau': 'berau',
        'kutai timur': 'kutim',
        'kutai kartanegara': 'kukar',
        'kutai barat': 'kubar',
        'samarinda': 'samarinda',
        'balikpapan': 'balikpapan',
        'bontang': 'bontang',
        'penajam': 'ppu', 
        'paser': 'paser'
    }
    
    assigned_id = None
    for k, v in id_map.items():
        if k in name:
            if k == 'paser' and 'penajam' in name:
                continue
            assigned_id = v
            break
            
    if not assigned_id:
        continue
        
    path_str = ""
    cx, cy, count = 0, 0, 0
    
    # Overpass relations for boundaries consist of 'way' members
    # To form continuous paths, we just take outer roles.
    # For a simple SVG, we can just draw them as disconnected or somewhat connected paths
    # Better: sort ways to form a continuous ring, or just draw each way as a line/polygon.
    # To fill properly, drawing each way might not be enough, but SVG can handle `<path d="M... L... M... L..." fill="..."/>`
    
    for member in el.get('members', []):
        if member.get('type') == 'way' and member.get('role') in ['outer', '']:
            geom = member.get('geometry', [])
            if not geom: continue
            
            # Subsample to keep SVG size small
            step = max(1, len(geom) // 20)
            subgeom = geom[::step]
            if geom[-1] not in subgeom:
                subgeom.append(geom[-1])
                
            for i, pt in enumerate(subgeom):
                x, y = project(pt['lon'], pt['lat'])
                if i == 0:
                    path_str += f"M{x:.1f},{y:.1f} "
                else:
                    path_str += f"L{x:.1f},{y:.1f} "
                cx += x
                cy += y
                count += 1
                
    if assigned_id in centroids:
        old_cx, old_cy = centroids[assigned_id]
        centroids[assigned_id] = ((old_cx + cx/count)/2, (old_cy + cy/count)/2)
        svg_paths[assigned_id] += path_str
    else:
        centroids[assigned_id] = (cx / count, cy / count)
        svg_paths[assigned_id] = path_str

with open("output.json", "w") as f:
    json.dump({"paths": svg_paths, "centroids": centroids}, f)
print("Saved to output.json with keys:", list(svg_paths.keys()))
