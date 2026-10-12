<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Response;

class TileProxyController extends Controller
{
    /**
     * Proxy tile request to tile.openstreetmap.org with a proper User-Agent
     * and a small cache to avoid hammering OSM servers. Suitable for low-medium
     * traffic. For production, consider using a proper tile provider or
     * a reverse proxy with persistent caching (Varnish, CDN, etc.).
     */
    public function tile(Request $request, $z, $x, $y)
    {
        $z = (int) $z;
        $x = (int) $x;
        $y = (int) $y;

        // Basic bounds check (tiles with z/x/y outside reasonable ranges should be rejected)
        if ($z < 0 || $z > 22) {
            return response('Invalid tile z', 400);
        }

        $cacheKey = "osm_tile_{$z}_{$x}_{$y}";
        $tileCache = Cache::store('file');
        $cached = $tileCache->get($cacheKey);
        if ($cached) {
            return response($cached['body'], 200)
                ->header('Content-Type', $cached['content_type'] ?? 'image/png')
                ->header('Cache-Control', 'public, max-age=' . (int) env('OSM_TILE_CACHE_TTL', 3600))
                ->header('Access-Control-Allow-Origin', '*');
        }

        $url = "https://tile.openstreetmap.org/{$z}/{$x}/{$y}.png";

        try {
            $resp = Http::withHeaders([
                'User-Agent' => env('OSM_PROXY_USER_AGENT', 'bapenda-kaltimprov/1.0 (contact@yourdomain.example)')
            ])->timeout(10)->get($url);
        } catch (\Exception $e) {
            return response('Upstream request failed', 502);
        }

        if (!$resp->ok()) {
            return response('Upstream tile not available', 502);
        }

        $body = $resp->body();
        $contentType = $resp->header('Content-Type', 'image/png');

        // Cache body using file-based storage so binary image payloads are safe.
        $ttl = (int) env('OSM_TILE_CACHE_TTL', 3600);
        $tileCache->put($cacheKey, ['body' => $body, 'content_type' => $contentType], $ttl);

        return response($body, 200)
            ->header('Content-Type', $contentType)
            ->header('Cache-Control', 'public, max-age=' . $ttl)
            ->header('Access-Control-Allow-Origin', '*');
    }
}
