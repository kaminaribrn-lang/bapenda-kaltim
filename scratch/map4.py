import urllib.request
import json

url = 'https://raw.githubusercontent.com/yusufsyaifudin/indonesia-kota-kabupaten-in-geojson/master/kabkota.geojson'
print("Downloading...")
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
for feature in data.get('features', []):
    props = feature['properties']
    name = props.get('name', props.get('kabkota', '')).lower()
    if any(tk in name for tk in target_kabs) and ('selatan' not in name):
        kaltim_features.append(feature)

print(f"Found {len(kaltim_features)} features.")
