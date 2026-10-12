<?php
// Load Laravel environment
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Website;
use App\Models\Menu;

$website = Website::first();
if (!$website) {
    echo "No websites found!\n";
    exit;
}

echo "Website: {$website->name} (Slug: {$website->slug})\n";
$menus = Menu::getForWebsite($website);
echo "Menus count: " . $menus->count() . "\n\n";
foreach ($menus as $menu) {
    echo "- {$menu->name} (Link: {$menu->link}, Icon: " . ($menu->svg_icon ? 'SVG present' : 'None') . ", Variant: " . ($menu->css_variant ?: 'Default') . ", Active Pattern: {$menu->active_pattern})\n";
    if ($menu->children->isNotEmpty()) {
        foreach ($menu->children as $child) {
            echo "  * {$child->name} (Link: {$child->link})\n";
        }
    }
}
