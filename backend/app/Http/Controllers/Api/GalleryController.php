<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = GalleryItem::active()->orderBy('sort_order')->orderByDesc('created_at');

        if ($request->category && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        return response()->json(
            $query->get(['id', 'title', 'description', 'content', 'image_url', 'image_path', 'category', 'is_featured'])
                ->map(fn ($item) => array_merge($item->toArray(), ['image_url' => $item->display_image_url]))
        );
    }

    public function featured(): JsonResponse
    {
        $items = GalleryItem::active()->featured()
            ->orderBy('sort_order')
            ->limit(6)
            ->get(['id', 'title', 'description', 'image_url', 'image_path', 'category']);

        return response()->json(
            $items->map(fn ($item) => array_merge($item->toArray(), ['image_url' => $item->display_image_url]))
        );
    }
}
