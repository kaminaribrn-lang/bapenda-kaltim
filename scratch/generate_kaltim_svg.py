import urllib.request
import urllib.parse
import json
import math
import re
import os
import sys

# PURPOSE: Generate SVG path data and markers for East Kalimantan (Kaltim) map.
# SOURCES:
# 1. Overpass API (admin_level=6 inside "Kalimantan Timur")
# 2. Fallback: superpikar/indonesia-geojson (indonesia.geojson)
# 3. Fallback: local geojson if provided (like map4.py did)
# MAHAKAM ULU FALLBACK:
# If Mahakam Ulu is not found in the source, it will merge with Kutai Barat (pre-2013 boundary).
# A warning will be printed. Kubar's path will be untouched, no 'mahulu' region will be emitted,
# but the 'mahulu' marker will still be emitted.
# DEPENDENCIES:
# Standard library only. If 'shapely' is installed, it is used for better simplification and centroids.
# Otherwise, it falls back to a pure-Python Douglas-Peucker and area-weighted centroid.

try:
    import shapely
    import shapely.geometry
    HAS_SHAPELY = True
except ImportError:
    HAS_SHAPELY = False

# 1a. Region ID mapping
REGION_MAP = {
    'berau': {'match': ['berau'], 'label': 'BERAU'},
    'kutim': {'match': ['kutai timur'], 'label': 'KUTAI TIMUR'},
    'bontang': {'match': ['bontang'], 'label': 'BONTANG'},
    'kukar': {'match': ['kutai kartanegara'], 'label': 'KUTAI KARTANEGARA'},
    'samarinda': {'match': ['samarinda'], 'label': 'SAMARINDA'},
    'kubar': {'match': ['kutai barat'], 'not_match': ['mahakam'], 'label': 'KUTAI BARAT'},
    'mahulu': {'match': ['mahakam ulu'], 'label': 'MAHAKAM ULU'},
    'ppu': {'match': ['penajam'], 'label': 'PENAJAM PASER UTARA'},
    'balikpapan': {'match': ['balikpapan'], 'label': 'BALIKPAPAN'},
    'paser': {'match': ['paser'], 'not_match': ['penajam', 'utara'], 'label': 'PASER'},
}

def get_region_id(name):
    name_low = name.lower()
    for reg_id, rules in REGION_MAP.items():
        match_all = True
        for m in rules['match']:
            if m not in name_low:
                match_all = False
                break
        if not match_all: continue
        
        not_match_any = False
        if 'not_match' in rules:
            for nm in rules['not_match']:
                if nm in name_low:
                    not_match_any = True
                    break
        if not_match_any: continue
        
        return reg_id
    return None

# 1b. Reference marker coordinates
MARKERS_REF = {
    'berau':      (2.15, 117.49),
    'kutim':      (0.50, 117.58),
    'bontang':    (0.13, 117.49),
    'kukar':     (-0.42, 116.99),
    'samarinda': (-0.50, 117.15),
    'kubar':     (-0.22, 115.86),
    'mahulu':    (0.20, 115.10),
    'ppu':       (-1.27, 116.83),
    'balikpapan':(-1.27, 116.83),
    'paser':     (-1.84, 116.21),
}

# 1c. Fetch data
OVERPASS_URL = "https://lz4.overpass-api.de/api/interpreter"
OVERPASS_QUERY = """[out:json][timeout:60];
area["name"="Kalimantan Timur"]->.searchArea;
(
  relation["admin_level"="6"](area.searchArea);
);
out geom;"""

FALLBACK_URL_1 = "https://raw.githubusercontent.com/superpikar/indonesia-geojson/master/indonesia-edit.geojson"
FALLBACK_URL_2 = "https://raw.githubusercontent.com/azunzios/indonesia-geojson/main/indonesia_kabkota_simple.geojson"

def try_overpass():
    try:
        data_payload = urllib.parse.urlencode({'data': OVERPASS_QUERY}).encode('utf-8')
        req = urllib.request.Request(OVERPASS_URL, data=data_payload, headers={
            'User-Agent': 'KaltimMapGenerator/1.0 (contact: bappenda_dev@example.com)',
            'Content-Type': 'application/x-www-form-urlencoded'
        })
        with urllib.request.urlopen(req, timeout=45) as response:
            data = json.loads(response.read().decode('utf-8'))
            if 'elements' in data and len(data['elements']) > 0:
                features = []
                for el in data.get('elements', []):
                    if el['type'] == 'relation':
                        name = el.get('tags', {}).get('name', 'Unknown')
                        outers = []
                        for mem in el.get('members', []):
                            if mem['type'] == 'way' and mem.get('role', '') in ('outer', 'inner', ''):
                                way = [[pt['lon'], pt['lat']] for pt in mem.get('geometry', [])]
                                if way: outers.append(way)
                        
                        def assemble(lines):
                            if not lines: return []
                            rings = []
                            current = lines.pop(0)
                            while True:
                                changed = False
                                for i in range(len(lines)):
                                    if lines[i][0] == current[-1]:
                                        current.extend(lines[i][1:])
                                        lines.pop(i)
                                        changed = True; break
                                    elif lines[i][-1] == current[-1]:
                                        current.extend(reversed(lines[i][:-1]))
                                        lines.pop(i)
                                        changed = True; break
                                    elif lines[i][-1] == current[0]:
                                        current = lines[i][:-1] + current
                                        lines.pop(i)
                                        changed = True; break
                                    elif lines[i][0] == current[0]:
                                        current = list(reversed(lines[i][1:])) + current
                                        lines.pop(i)
                                        changed = True; break
                                if not changed:
                                    if current[0] != current[-1]: current.append(current[0])
                                    rings.append(current)
                                    if lines: current = lines.pop(0)
                                    else: break
                            return rings
                        
                        rings = assemble(outers)
                        if not rings: continue
                        coords = [[[pt[0], pt[1]] for pt in r] for r in rings]
                        features.append({
                            "type": "Feature",
                            "properties": {"name": name, "source": "overpass"},
                            "geometry": {
                                "type": "MultiPolygon",
                                "coordinates": [[r] for r in coords]
                            }
                        })
                if features:
                    return {"type": "FeatureCollection", "features": features}
    except Exception as e:
        print(f"Overpass fetch failed: {e}")
    return None

def try_fallback(url):
    try:
        req = urllib.request.Request(url, headers={'User-Agent': 'Mozilla/5.0'})
        with urllib.request.urlopen(req, timeout=30) as response:
            return json.loads(response.read().decode('utf-8'))
    except Exception as e:
        print(f"Fallback fetch {url} failed: {e}")
    return None

def main():
    sources_to_try = [
        ("overpass", try_overpass),
        ("azunzios", lambda: try_fallback(FALLBACK_URL_2)),
        ("superpikar", lambda: try_fallback(FALLBACK_URL_1)),
    ]

    selected_features = []
    source = ""

    for src_name, src_func in sources_to_try:
        data = src_func()
        if not data:
            continue
            
        features_to_check = []
        if src_name == 'superpikar':
            for feat in data['features']:
                props = feat['properties']
                provinsi = props.get('state', props.get('Propinsi', props.get('provinsi', ''))).lower()
                name = props.get('name', props.get('Kabupaten', props.get('kabkot', ''))).lower()
                if 'timur' in provinsi and 'kalimantan' in provinsi:
                    features_to_check.append(feat)
                else:
                    target_kabs = ['berau', 'kutai timur', 'kutai kartanegara', 'kutai barat', 'samarinda', 'balikpapan', 'bontang', 'penajam paser utara', 'paser']
                    if any(tk in name for tk in target_kabs) and ('selatan' not in name) and ('tengah' not in name):
                        if 'paser' in name and 'tanah bumbu' in name: continue
                        features_to_check.append(feat)
        elif src_name == 'azunzios':
            for feat in data.get('features', []):
                props = feat['properties']
                provinsi = props.get('NAME_1', '').lower()
                name = props.get('NAME_2', '').lower()
                if 'timur' in provinsi and 'kalimantan' in provinsi:
                    features_to_check.append(feat)
                else:
                    target_kabs = ['berau', 'kutai timur', 'kutai kartanegara', 'kutai barat', 'samarinda', 'balikpapan', 'bontang', 'penajam paser utara', 'paser']
                    if any(tk in name for tk in target_kabs) and ('selatan' not in name):
                        features_to_check.append(feat)
        elif src_name == 'yusufsyaifudin':
            target_kabs = ['berau', 'kutai timur', 'kutai kartanegara', 'kutai barat', 'samarinda', 'balikpapan', 'bontang', 'penajam', 'paser']
            for feat in data.get('features', []):
                props = feat['properties']
                name = props.get('name', props.get('kabkota', '')).lower()
                if any(tk in name for tk in target_kabs) and ('selatan' not in name):
                    features_to_check.append(feat)
        else:
            features_to_check = data.get('features', [])

        current_selected = []
        for feat in features_to_check:
            props = feat['properties']
            name = props.get('name', props.get('Kabupaten', props.get('kabkota', props.get('NAME_2', str(props)))))
            if src_name == 'superpikar' and name == 'Kalimantan Timur':
                continue
            if name:
                reg_id = get_region_id(str(name))
                if reg_id:
                    feat['properties']['region_id'] = reg_id
                    current_selected.append(feat)
                    
        if current_selected:
            selected_features = current_selected
            source = src_name
            break
            
    if not selected_features:
        print("Error: No regions matched from any source.")
        sys.exit(1)
        
    print(f"Loaded {len(selected_features)} features from source: {source}")
        
    cwd = os.path.dirname(os.path.abspath(__file__))
    raw_path = os.path.join(cwd, "kaltim_raw.geojson")
    with open(raw_path, "w") as f:
        json.dump({"type": "FeatureCollection", "features": selected_features}, f)
    print(f"Saved {len(selected_features)} raw features to kaltim_raw.geojson")

    # 1d. Compute bounding box & viewBox
    min_lon, max_lon = float('inf'), float('-inf')
    min_lat, max_lat = float('inf'), float('-inf')
    
    for feat in selected_features:
        geom = feat['geometry']
        coords = geom['coordinates'] if geom['type'] == 'MultiPolygon' else [geom['coordinates']]
        for poly in coords:
            for ring in poly:
                for pt in ring:
                    min_lon = min(min_lon, pt[0])
                    max_lon = max(max_lon, pt[0])
                    min_lat = min(min_lat, pt[1])
                    max_lat = max(max_lat, pt[1])
                    
    mid_lat = (min_lat + max_lat) / 2.0
    aspect = (max_lon - min_lon) * math.cos(math.radians(mid_lat)) / (max_lat - min_lat)
    
    H_inner = 600
    W_inner = round(H_inner * aspect)
    W = W_inner + 32
    H = H_inner + 32
    viewBox = f"0 0 {W} {H}"
    
    def project(lon, lat):
        x = (lon - min_lon) / (max_lon - min_lon) * W_inner
        y = (lat - min_lat) / (max_lat - min_lat) * H_inner
        y = H_inner - y
        return 16 + x, 16 + y

    # Pure Python Douglas-Peucker fallback
    def perpendicular_distance(pt, line_start, line_end):
        x0, y0 = pt
        x1, y1 = line_start
        x2, y2 = line_end
        if x1 == x2 and y1 == y2:
            return math.hypot(x0 - x1, y0 - y1)
        num = abs((y2 - y1)*x0 - (x2 - x1)*y0 + x2*y1 - y2*x1)
        den = math.hypot(y2 - y1, x2 - x1)
        return num / den

    def douglas_peucker(points, epsilon):
        if len(points) < 3: return points
        dmax = 0
        index = 0
        for i in range(1, len(points) - 1):
            d = perpendicular_distance(points[i], points[0], points[-1])
            if d > dmax:
                index = i
                dmax = d
        if dmax > epsilon:
            left = douglas_peucker(points[:index+1], epsilon)
            right = douglas_peucker(points[index:], epsilon)
            return left[:-1] + right
        else:
            return [points[0], points[-1]]

    def simplify_ring(ring):
        if HAS_SHAPELY:
            poly = shapely.geometry.Polygon(ring)
            if not poly.is_valid: poly = poly.buffer(0)
            epsilon = 0.4
            while True:
                simp = poly.simplify(epsilon, preserve_topology=True)
                if simp.geom_type == 'Polygon': pts = list(simp.exterior.coords)
                elif simp.geom_type == 'MultiPolygon': pts = list(max(simp.geoms, key=lambda g: g.area).exterior.coords)
                else: pts = ring
                if len(pts) <= 150: return pts
                epsilon += 0.2
                if epsilon > 10: break
            return pts
        else:
            pts = ring
            if len(pts) <= 150: return pts
            epsilon = 0.4
            while True:
                simp = douglas_peucker(pts, epsilon)
                if len(simp) <= 150: return simp
                epsilon += 0.2
                if epsilon > 10: break
            return simp

    def get_centroid(rings):
        if HAS_SHAPELY:
            polys = [shapely.geometry.Polygon(r) for r in rings if len(r) >= 3]
            if not polys: return rings[0][0][0], rings[0][0][1]
            mp = shapely.geometry.MultiPolygon(polys)
            if not mp.is_valid: mp = mp.buffer(0)
            pt = mp.representative_point()
            return pt.x, pt.y
        else:
            best_area = -1
            best_c = (0,0)
            for r in rings:
                area, cx, cy = 0, 0, 0
                for i in range(len(r)-1):
                    x0, y0 = r[i]
                    x1, y1 = r[i+1]
                    cross = (x0 * y1 - x1 * y0)
                    area += cross
                    cx += (x0 + x1) * cross
                    cy += (y0 + y1) * cross
                area = area / 2.0
                if abs(area) > best_area:
                    best_area = abs(area)
                    if area != 0:
                        best_c = (cx / (6.0 * area), cy / (6.0 * area))
                    else:
                        best_c = (r[0][0], r[0][1])
            return best_c[0], best_c[1]

    # 1e & 1f. Build paths & centroids
    regions_out = {}
    
    # group rings by reg_id
    grouped_rings = {}
    for feat in selected_features:
        reg_id = feat['properties']['region_id']
        geom = feat['geometry']
        coords = geom['coordinates'] if geom['type'] == 'MultiPolygon' else [geom['coordinates']]
        if reg_id not in grouped_rings:
            grouped_rings[reg_id] = []
        for poly in coords:
            for ring in poly:
                # project
                proj_ring = [project(pt[0], pt[1]) for pt in ring]
                grouped_rings[reg_id].append(proj_ring)
                
    for reg_id, rings in grouped_rings.items():
        path_str = ""
        for ring in rings:
            simp = simplify_ring(ring)
            for i, pt in enumerate(simp):
                x, y = round(pt[0], 1), round(pt[1], 1)
                if i == 0: path_str += f"M {x},{y} "
                else: path_str += f"L {x},{y} "
            path_str += "Z "
        
        cx, cy = get_centroid(rings)
        regions_out[reg_id] = {
            "d": path_str.strip(),
            "centroid": [round(cx, 1), round(cy, 1)],
            "label": REGION_MAP[reg_id]['label']
        }

    # 1g. Markers
    markers_out = {}
    for reg_id, (lat, lng) in MARKERS_REF.items():
        ix, iy = project(lng, lat)
        markers_out[reg_id] = {
            "ix": round(ix, 1),
            "iy": round(iy, 1),
            "lat": lat,
            "lng": lng
        }

    # 1i. Mahakam Ulu fallback
    mahulu_warned = False
    if "mahulu" not in regions_out:
        print("WARN: mahulu not found in source; merging with kubar (pre-2013 boundary).")
        mahulu_warned = True

    # 1h. Output JSON schema
    out_data = {
        "viewBox": viewBox,
        "source": source,
        "regions": regions_out,
        "markers": markers_out
    }
    
    out_path = os.path.join(cwd, "output_smooth.json")
    with open(out_path, "w") as f:
        json.dump(out_data, f, indent=2)
        
    # 1k. CLI ergonomics
    print(f"OK  regions={len(regions_out)} markers={len(markers_out)} viewBox={viewBox} source={source}")

if __name__ == "__main__":
    main()
