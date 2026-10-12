import json
import re

with open("output_smooth.json", "r") as f:
    data = json.load(f)

paths = data['paths']
centroids = data['centroids']

with open("../resources/views/portal.blade.php", "r", encoding="utf-8") as f:
    content = f.read()

# Replace SVG paths
start_marker = "{{-- Region paths (Kalimantan Timur) --}}"
end_marker = "{{-- Markers injected by JS --}}"

start_idx = content.find(start_marker)
end_idx = content.find(end_marker)

if start_idx != -1 and end_idx != -1:
    new_paths = []
    # User said: "Hapus juga path/elemen pelengkap yang tidak relevan jika ada (mis. reg-mahulu)"
    for name, d in paths.items():
        if name == 'mahulu': continue
        new_paths.append(f'                                <path id="reg-{name}" class="reg" data-id="{name}" d="{d}" />')
    
    paths_str = "\n".join(new_paths)
    replacement = start_marker + "\n" + paths_str + "\n                                "
    content = content[:start_idx] + replacement + content[end_idx:]

# Update uptdData
for name, (cx, cy) in centroids.items():
    if name == 'mahulu': continue
    # Regex to find the object with id:'name' and replace its ix and iy
    pattern = r"(id:\s*'" + name + r"'.*?ix:\s*)\d+(.*?iy:\s*)\d+"
    # We use a function to replace only the numbers
    def repl(m):
        return m.group(1) + str(int(cx)) + m.group(2) + str(int(cy))
    
    content = re.sub(pattern, repl, content)

# Check if there is CSS class .reg-mahulu and delete it as requested (optional)
# "Class .reg-mahulu di stylesheet (sekitar baris 288) dipakai oleh path lama; jika peta baru tidak memuat region tersebut, baris itu boleh dihapus."
content = re.sub(r'\s*\.reg-mahulu\s*\{[^}]+\}\s*', '\n        ', content)

with open("../resources/views/portal.blade.php", "w", encoding="utf-8") as f:
    f.write(content)

print("Updated portal.blade.php successfully.")
