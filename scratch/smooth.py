import re
import json

paths = {
    'berau':      "M155,20 L230,10 L310,15 L375,45 L420,90 L445,135 L415,170 L365,158 L325,170 L285,162 L245,170 L205,162 L160,165 L138,142 L122,105 L132,60 Z",
    'kutim':      "M285,162 L325,170 L365,158 L415,170 L445,135 L458,185 L460,255 L438,300 L400,330 L368,320 L340,285 L312,258 L280,228 L265,195 Z",
    'bontang':    "M400,330 L438,325 L442,358 L412,368 L388,350 L372,332 Z",
    'kukar':      "M160,165 L205,162 L245,170 L265,195 L280,228 L312,258 L340,285 L328,350 L302,388 L268,405 L235,400 L202,380 L172,348 L152,290 L148,232 Z",
    'samarinda':  "M302,388 L332,378 L348,400 L328,420 L295,418 L282,400 Z",
    'kubar':      "M92,192 L138,185 L160,165 L148,232 L152,290 L130,328 L100,328 L72,298 L68,248 L75,212 Z",
    'ppu':        "M202,380 L235,400 L268,405 L282,400 L295,418 L278,450 L248,468 L220,475 L192,455 L180,432 Z",
    'balikpapan': "M278,450 L312,442 L328,462 L312,488 L280,482 L262,465 Z",
    'paser':      "M100,328 L130,328 L152,348 L172,368 L180,398 L180,432 L192,455 L178,485 L148,498 L110,492 L82,460 L70,420 L68,380 L72,340 Z"
}

def parse_path(d):
    pts = []
    tokens = d.replace(',', ' ').split()
    for tok in tokens:
        if tok in ['M', 'L', 'Z']:
            pass
        else:
            try:
                # sometimes they are stuck together like M155,20
                pass
            except:
                pass
            
    # better parsing
    matches = re.findall(r'[ML]?\s*(-?\d+(?:\.\d+)?),(-?\d+(?:\.\d+)?)', d)
    return [(float(m[0]), float(m[1])) for m in matches]

def chaikin_smooth(pts, iterations=3):
    if len(pts) < 3: return pts
    for _ in range(iterations):
        new_pts = []
        for i in range(len(pts)):
            p0 = pts[i]
            p1 = pts[(i+1) % len(pts)]
            
            # Subdivide
            p0x = 0.75*p0[0] + 0.25*p1[0]
            p0y = 0.75*p0[1] + 0.25*p1[1]
            p1x = 0.25*p0[0] + 0.75*p1[0]
            p1y = 0.25*p0[1] + 0.75*p1[1]
            
            new_pts.append((p0x, p0y))
            new_pts.append((p1x, p1y))
        pts = new_pts
    return pts

def add_noise(pts):
    import random
    new_pts = []
    for i, p in enumerate(pts):
        # random jitter
        nx = p[0] + random.uniform(-1, 1)
        ny = p[1] + random.uniform(-1, 1)
        new_pts.append((nx, ny))
    return new_pts

smoothed_paths = {}
centroids = {}

for name, d in paths.items():
    pts = parse_path(d)
    
    # Smooth them to look like organic borders
    s_pts = chaikin_smooth(pts, iterations=4)
    # add slight noise then smooth again for fractal-like coastline
    s_pts = add_noise(s_pts)
    s_pts = chaikin_smooth(s_pts, iterations=1)
    
    # Calculate centroid
    cx = sum(p[0] for p in s_pts) / len(s_pts)
    cy = sum(p[1] for p in s_pts) / len(s_pts)
    centroids[name] = (cx, cy)
    
    # Convert back to SVG path string
    path_str = ""
    for i, p in enumerate(s_pts):
        if i == 0:
            path_str += f"M{p[0]:.1f},{p[1]:.1f} "
        else:
            path_str += f"L{p[0]:.1f},{p[1]:.1f} "
    path_str += "Z"
    
    smoothed_paths[name] = path_str

print("SMOOTHED PATHS:")
for name, d in smoothed_paths.items():
    print(f"<path id=\"reg-{name}\" class=\"reg\" data-id=\"{name}\" d=\"{d}\" />")

print("\nCENTROIDS:")
for name, (cx, cy) in centroids.items():
    print(f"{name}: ix:{cx:.0f}, iy:{cy:.0f}")

with open("output_smooth.json", "w") as f:
    json.dump({'paths': smoothed_paths, 'centroids': centroids}, f, indent=2)
