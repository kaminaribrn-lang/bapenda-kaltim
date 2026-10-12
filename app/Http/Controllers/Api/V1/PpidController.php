<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PpidResource;
use App\Models\Ppid;
use App\Models\Website;
use Illuminate\Http\Request;

class PpidController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['nullable', 'string'],
            'website_slug' => ['nullable', 'string'],
        ]);

        $query = Ppid::query()->whereNull('parent_id');

        if (!empty($validated['website_slug'])) {
            $website = Website::query()->where('slug', $validated['website_slug'])->firstOrFail();
            $query->where('website_id', $website->id);
        }

        if (!empty($validated['nama'])) {
            $query->where('name', 'like', '%' . $validated['nama'] . '%');
        }

        $ppids = $query->get();

        return PpidResource::collection($ppids);
    }

    public function show(Request $request, int $id)
    {
        $validated = $request->validate([
            'website_slug' => ['nullable', 'string'],
        ]);

        $query = Ppid::with(['children', 'items'])->whereKey($id);

        if (!empty($validated['website_slug'])) {
            $website = Website::query()->where('slug', $validated['website_slug'])->firstOrFail();
            $query->where('website_id', $website->id);
        }

        $ppid = $query->firstOrFail();

        return new PpidResource($ppid);
    }
}
