<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

class ArticleLikeController extends Controller
{
    public function toggle(
        Request $request,
        string $slug
    ): JsonResponse|RedirectResponse {
        $article = Article::where('slug', $slug)->firstOrFail();

        $like = $article->likes()
            ->where('user_id', $request->user()->id)
            ->first();

        if ($like) {
            $like->delete();
        } else {
            $article->likes()->create([
                'user_id' => $request->user()->id,
            ]);
        }

        $liked = $article->likes()
            ->where('user_id', $request->user()->id)
            ->exists();

        $likesCount = $article->likes()->count();

        if ($request->expectsJson()) {
            return response()->json([
                'liked' => $liked,
                'likes_count' => $likesCount,
            ]);
        }

        return back();
    }
}
