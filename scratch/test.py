import urllib.request
import urllib.parse
import urllib.error

OVERPASS_URL = "https://lz4.overpass-api.de/api/interpreter"
OVERPASS_QUERY = """[out:json][timeout:60];
area["name"="Kalimantan Timur"]->.searchArea;
(
  relation["admin_level"="6"](area.searchArea);
);
out geom;"""

data_payload = urllib.parse.urlencode({'data': OVERPASS_QUERY}).encode('utf-8')
req = urllib.request.Request(OVERPASS_URL, data=data_payload, headers={
    'User-Agent': 'KaltimMapGenerator/1.0 (contact: bappenda_dev@example.com)',
    'Content-Type': 'application/x-www-form-urlencoded'
})

try:
    with urllib.request.urlopen(req, timeout=45) as response:
        print("Success!")
except urllib.error.HTTPError as e:
    print(f"HTTP Error: {e.code}")
    print(e.read().decode('utf-8'))
except Exception as e:
    print(f"Other Error: {e}")
