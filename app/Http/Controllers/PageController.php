<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Models\Article;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home(Request $request): View
    {
        //$articles = Article::latest()->get();
        $search = $request->input('search');

        $articles = Article::query()
        ->when($search, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%');
        })
        ->latest()
        ->paginate(4)
        ->withQueryString();

        return view('pages.home', [
            'articles' => $articles,
            'search' => $search,
        ]);
    }

    public function about(): View
    {
        return view('pages.about');
    }
}
