<?php

namespace App\Http\Controllers;

use HTMLPurifier;
use HTMLPurifier_Config;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function create(): View
    {
        return view('pages.articles.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|alpha_dash|unique:articles,slug',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $validated['content'] = $this->sanitizeHtml(
            $validated['content']
        );

        if ($request->hasFile('image')){
             $validated['image'] = $request->file('image')
            ->store('articles', 'public');
        }

        //Article::create($validated);
        $request->user()->articles()->create($validated);

        return redirect()
                ->route('dashboard')
                ->with('success','Artikel berhasil ditambahkan');
    }

    public function edit(Request $request, string $slug): View
    {
        $article = $request->user()
        ->articles()
        ->where('slug', $slug)
        ->firstOrFail();

        return view('pages.articles.edit', [
            'article' => $article,
        ]);
    }

    public function update(Request $request, string $slug): RedirectResponse
    {
        //$article = Article::where('slug', $slug)->firstOrFail();

        $article = $request->user()
        ->articles()
        ->where('slug', $slug)
        ->firstOrFail();

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|alpha_dash|unique:articles,slug,' . $article->id,
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $validated['content'] = $this->sanitizeHtml(
            $validated['content']
        );

        if ($request->hasFile('image')) {
            $oldImage = $article->image;

            $validated['image'] = $request->file('image')
                ->store('articles', 'public');


            if ($oldImage) {
                Storage::disk('public')->delete($oldImage);
            }
        } else {
            unset($validated['image']);

        }


        $article->update($validated);

        return redirect()
                ->route('dashboard')
                ->with('success', 'Artikel berhasil diperbarui');
    }

    public function destroy(Request $request, string $slug): RedirectResponse
    {
        //$article = Article::where('slug', $slug)->firstOrFail();

        $article = $request->user()
        ->articles()
        ->where('slug', $slug)
        ->firstOrFail();

        if ($article->image) {
            Storage::disk('public')->delete($article->image);
        }

        $article->delete();

        return redirect()
                ->route('home')
                ->with('success', 'Artikel berhasil dihapus');        
    }

    public function show(Request $request, string $slug): View
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        // Ambil daftar artikel yang sudah dihitung dalam session.
        $viewedArticles = $request->session()->get(
            'viewed_articles',
            []
        );

        if (!isset($viewedArticles[$article->id])) {
            $article->increment('views');

            $viewedArticles[$article->id] = true;

            $request->session()->put(
                'viewed_articles',
                $viewedArticles
            );
        }


        $article->loadCount('likes');

        $liked = auth()->check()
        && $article->likes()
            ->where('user_id', auth()->id())
            ->exists();

        return view('pages.article', ['article' => $article, 'liked' => $liked]);
    }

    
    public function uploadContentImage(Request $request)
    {
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = $request->file('image')
            ->store('articles/content', 'public');

        return response()->json([
            'url' => asset('storage/' . $path),
        ]);
    }

    //html purifier
    private function sanitizeHtml(string $html): string
    {
        $config = HTMLPurifier_Config::createDefault();

        $config->set(
            'HTML.Allowed',
            'p,br,strong,b,em,i,u,s,sub,sup,h1,h2,h3,h4,blockquote,pre,code,ol,ul,li,a[href|title],img[src|alt|width|height],span[class],div[class]'
        );

        $config->set('Attr.AllowedClasses', [
            'ql-align-center',
            'ql-align-right',
            'ql-align-justify',
            'ql-indent-1',
            'ql-indent-2',
            'ql-indent-3',
            'ql-indent-4',
            'ql-indent-5',
            'ql-indent-6',
            'ql-indent-7',
            'ql-indent-8',
        ]);

        $config->set('URI.AllowedSchemes', [
            'http' => true,
            'https' => true,
        ]);

        $cachePath = storage_path('framework/cache/htmlpurifier');

        File::ensureDirectoryExists($cachePath);

        $config->set('Cache.SerializerPath', $cachePath);

        $purifier = new HTMLPurifier($config);

        $cleanHtml = $purifier->purify($html);


        return $cleanHtml;

                return $purifier->purify($html);
            }
}
