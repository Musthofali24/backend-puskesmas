<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of published blogs.
     */
    public function index(Request $request)
    {
        $query = Blog::published()
            ->select(
                'id',
                'title',
                'slug',
                'category',
                'excerpt',
                'featured_image',
                'author',
                'read_time',
                'published_at',
                'views_count'
            )
            ->latest('published_at');

        // Filter by category if provided
        if ($request->has('category')) {
            $query->category($request->category);
        }

        // Search functionality
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        $perPage = $request->get('per_page', 12);
        $blogs = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $blogs,
        ]);
    }

    /**
     * Display the specified blog by slug.
     */
    public function show($slug)
    {
        $blog = Blog::published()
            ->where('slug', $slug)
            ->firstOrFail();

        // Increment views count
        $blog->increment('views_count');

        return response()->json([
            'success' => true,
            'data' => $blog,
        ]);
    }

    /**
     * Get blogs by category.
     */
    public function byCategory($category, Request $request)
    {
        $query = Blog::published()
            ->category($category)
            ->select(
                'id',
                'title',
                'slug',
                'category',
                'excerpt',
                'featured_image',
                'author',
                'read_time',
                'published_at',
                'views_count'
            )
            ->latest('published_at');

        $perPage = $request->get('per_page', 12);
        $blogs = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => $blogs,
        ]);
    }

    /**
     * Get latest blogs (for homepage).
     */
    public function latest(Request $request)
    {
        $limit = $request->get('limit', 3);

        $blogs = Blog::published()
            ->select(
                'id',
                'title',
                'slug',
                'category',
                'excerpt',
                'featured_image',
                'author',
                'read_time',
                'published_at',
                'views_count'
            )
            ->latest('published_at')
            ->limit($limit)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $blogs,
        ]);
    }

    /**
     * Get popular blogs (most viewed).
     */
    public function popular(Request $request)
    {
        $limit = $request->get('limit', 5);

        $blogs = Blog::published()
            ->select(
                'id',
                'title',
                'slug',
                'category',
                'featured_image',
                'views_count',
                'published_at'
            )
            ->orderBy('views_count', 'desc')
            ->limit($limit)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $blogs,
        ]);
    }

    /**
     * Get related blogs (same category, exclude current).
     */
    public function related($slug, Request $request)
    {
        $currentBlog = Blog::where('slug', $slug)->firstOrFail();
        $limit = $request->get('limit', 3);

        $blogs = Blog::published()
            ->category($currentBlog->category)
            ->where('id', '!=', $currentBlog->id)
            ->select(
                'id',
                'title',
                'slug',
                'category',
                'excerpt',
                'featured_image',
                'author',
                'read_time',
                'published_at'
            )
            ->latest('published_at')
            ->limit($limit)
            ->get();

        return response()->json([
            'success' => true,
            'data' => $blogs,
        ]);
    }
}
