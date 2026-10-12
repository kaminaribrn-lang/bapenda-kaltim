import urllib.request
import json

url = 'https://raw.githubusercontent.com/Vizzuality/growasia_calculator/master/public/carto/geojson/idn_gadm28_2.geojson'
print("Downloading GADM level 2...")
try:
    req = urllib.request.Request(url, headers={'User-Agent': 'Mozilla/5.0'})
    response = urllib.request.urlopen(req)
    data = json.loads(response.read())
except Exception as e:
    print("Error:", e)
    import sys
    sys.exit(1)

target_kabs = ['berau', 'kutai timur', 'kutai kartanegara', 'kutai barat', 'samarinda', 'balikpapan', 'bontang', 'penajam', 'paser']

kaltim_features = []
for feature in data['features']:
    props = feature['properties']
    # in GADM, NAME_1 is province, NAME_2 is regency
    name1 = props.get('NAME_1', '').lower()
    name2 = props.get('NAME_2', '').lower()
    
    if 'kalimantan timur' in name1:
        # Check if it matches our list
        if any(tk in name2 for tk in target_kabs):
            kaltim_features.append(feature)

print(f"Found {len(kaltim_features)} features for Kaltim.")

if len(kaltim_features) == 0:
    print("Trying without NAME_1 filter...")
    for feature in data['features']:
        props = feature['properties']
        name2 = props.get('NAME_2', '').lower()
        if any(tk in name2 for tk in target_kabs) and ('selatan' not in name2):
            kaltim_features.append(feature)
    print(f"Found {len(kaltim_features)} features for Kaltim (fallback).")

min_lon, max_lon = 180, -180
min_lat, max_lat = 90, -90

for feature in kaltim_features:
    geom = feature['geometry']
    coords_list = []
    if geom['type'] == 'Polygon':
        coords_list = [geom['coordinates']]
    elif geom['type'] == 'MultiPolygon':
        coords_list = geom['coordinates']
    
    for poly in coords_list:
        ring = poly[0]
        for p in ring:
            lon, lat = p[0], p[1]
            min_lon = min(min_lon, lon)
            max_lon = max(max_lon, lon)
            min_lat = min(min_lat, lat)
            max_lat = max(max_lat, lat)

print(f"BBox: {min_lon}, {min_lat} to {max_lon}, {max_lat}")

def project(lon, lat, width=480, height=520):
    pad = 20
    eff_w = width - 2*pad
    eff_h = height - 2*pad
    x = (lon - min_lon) / (max_lon - min_lon)
    y = (lat - min_lat) / (max_lat - min_lat)
    return pad + x * eff_w, pad + (1 - y) * eff_h

svg_paths = {}
centroids = {}

for feature in kaltim_features:
    props = feature['properties']
    name2 = props.get('NAME_2', '').lower()
    
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
        if k in name2:
            if k == 'paser' and 'penajam' in name2:
                continue
            assigned_id = v
            break
            
    if not assigned_id:
        continue
        
    geom = feature['geometry']
    path_str = ""
    
    cx, cy, count = 0, 0, 0
    
    coords_list = []
    if geom['type'] == 'Polygon':
        coords_list = [geom['coordinates']]
    elif geom['type'] == 'MultiPolygon':
        coords_list = geom['coordinates']
        
    for poly in coords_list:
        ring = poly[0]
        step = max(1, len(ring) // 50)
        simplified_ring = ring[::step]
        if ring[-1] not in simplified_ring:
            simplified_ring.append(ring[-1])
            
        for i, p in enumerate(simplified_ring):
            lon, lat = p[0], p[1]
            x, y = project(lon, lat)
            if i == 0:
                path_str += f"M{x:.1f},{y:.1f} "
            else:
                path_str += f"L{x:.1f},{y:.1f} "
            cx += x
            cy += y
            count += 1
        path_str += "Z "
        
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
