<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\PostResource;
use App\Models\Post;
use App\Models\Website;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['nullable', 'string'],
            'tanggal' => ['nullable', 'date'],
            'category' => ['nullable', 'string'],
            'website_slug' => ['nullable', 'string'],
            'per_page' => ['nullable', 'integer', 'min:1', 'max:100'],
        ]);

        $query = Post::with(['category', 'file'])
            ->where(function ($statusQuery) {
                $statusQuery->where('status', 'published')
                    ->orWhere('status', 1)
                    ->orWhere('status', true);
            });

        if (!empty($validated['website_slug'])) {
            $website = Website::query()->where('slug', $validated['website_slug'])->firstOrFail();
            $query->where('website_id', $website->id);
        }

        if (!empty($validated['nama'])) {
            $query->where('title', 'like', '%' . $validated['nama'] . '%');
        }

        if (!empty($validated['tanggal'])) {
            $query->whereDate('published_at', $validated['tanggal']);
        }

        if (!empty($validated['category'])) {
            $query->whereHas('category', function ($categoryQuery) use ($validated) {
                $categoryQuery->where('slug', $validated['category']);
            });
        }

        $posts = $query->orderBy('published_at', 'desc')->paginate($validated['per_page'] ?? 10);

        return PostResource::collection($posts);
    }

    public function show(Request $request, string $slug)
    {
        $validated = $request->validate([
            'website_slug' => ['nullable', 'string'],
        ]);

        $query = Post::with(['category', 'file'])
            ->where('slug', $slug)
            ->where(function ($statusQuery) {
                $statusQuery->where('status', 'published')
                    ->orWhere('status', 1)
                    ->orWhere('status', true);
            });

        if (!empty($validated['website_slug'])) {
            $website = Website::query()->where('slug', $validated['website_slug'])->firstOrFail();
            $query->where('website_id', $website->id);
        }

        $post = $query->firstOrFail();

        return new PostResource($post);
    }
}
