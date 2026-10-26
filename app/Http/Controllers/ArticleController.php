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
use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;

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

        if ($request->hasFile('image')) {
            $uploaded = $this->uploadToCloudinary(
                $request->file('image')->getRealPath(),
                'articles/covers'
            );

            $validated['image'] = $uploaded['url'];
            $validated['image_public_id'] = $uploaded['public_id'];
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

        $oldImage = $article->image;
        $oldPublicId = $article->image_public_id;

        if ($request->hasFile('image')) {
            $uploaded = $this->uploadToCloudinary(
                $request->file('image')->getRealPath(),
                'articles/covers'
            );

            $validated['image'] = $uploaded['url'];
            $validated['image_public_id'] = $uploaded['public_id'];
        } else {
            unset($validated['image']);
        }

        // Simpan perubahan artikel terlebih dahulu.
        $article->update($validated);

        // Hapus gambar lama hanya setelah update berhasil.
        if ($request->hasFile('image')) {
            if ($oldPublicId) {
                $this->cloudinaryConfig();

                (new UploadApi())->destroy($oldPublicId);
            } elseif ($oldImage && !\Illuminate\Support\Str::startsWith(
                $oldImage,
                ['http://', 'https://']
            )) {
                // Membersihkan gambar lama yang masih tersimpan lokal.
                Storage::disk('public')->delete($oldImage);
            }
        }

        return redirect()
            ->route('dashboard')
            ->with('success', 'Artikel berhasil diperbarui');
    }

    
    public function destroy(Request $request, string $slug): RedirectResponse
    {
        $article = $request->user()
            ->articles()
            ->where('slug', $slug)
            ->firstOrFail();

        $image = $article->image;
        $publicId = $article->image_public_id;

        // Hapus artikel dari database terlebih dahulu.
        $article->delete();

        // Hapus gambar dari Cloudinary jika memiliki public ID.
        if ($publicId) {
            $this->cloudinaryConfig();

            (new UploadApi())->destroy($publicId);
        } elseif ($image && !\Illuminate\Support\Str::startsWith(
            $image,
            ['http://', 'https://']
        )) {
            // Hapus gambar lama yang masih berupa path lokal.
            Storage::disk('public')->delete($image);
        }

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
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $uploaded = $this->uploadToCloudinary(
            $request->file('image')->getRealPath(),
            'articles/content'
        );

        return response()->json([
            'url' => $uploaded['url'],
        ]);
    }


    
    private function cloudinaryConfig(): void
    {
        Configuration::instance([
            'cloud' => [
                'cloud_name' => config('services.cloudinary.cloud_name'),
                'api_key' => config('services.cloudinary.api_key'),
                'api_secret' => config('services.cloudinary.api_secret'),
            ],
            'url' => [
                'secure' => true,
            ],
        ]);
    }

    private function uploadToCloudinary(
        string $filePath,
        string $folder
    ): array {
        $this->cloudinaryConfig();

        $result = (new UploadApi())->upload($filePath, [
            'folder' => $folder,
            'resource_type' => 'image',
        ]);

        return [
            'url' => $result['secure_url'],
            'public_id' => $result['public_id'],
        ];
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

        
        return $purifier->purify($html);
    }
}