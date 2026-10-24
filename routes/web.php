<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PageController;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\ArticleLikeController;


// Halaman utama: daftar artikel publik
Route::get('/', [PageController::class, 'home'])->name('home');

// Halaman About
Route::get('/about', [PageController::class, 'about'])->name('about');

// Detail artikel publik
Route::get('/artikel/{slug}', [ArticleController::class, 'show'])
    ->name('articles.show');

// Dashboard admin
Route::get('/dashboard', function (Request $request) {
    //$articles = Article::latest()->get();
    $search = $request->input('search');
    $articles = auth()->user()
    ->articles()
    ->when($search, function ($query, $search) {
            $query->where('title', 'like', '%' . $search . '%');
        })
    ->latest()
    ->paginate(1)
    ->withQueryString();

    return view('dashboard',[
        'articles'=> $articles,
        'search' => $search,
    ]);
})->middleware(['auth'])->name('dashboard');

// Like artikel: hanya pengguna yang login
Route::post('/artikel/{slug}/like', [
    ArticleLikeController::class,
    'toggle',
])->middleware('auth')->name('articles.like');

// CRUD artikel: hanya pengguna yang login
Route::middleware('auth','verified','admin')->group(function () {

    // Menyimpan artikel baru
    Route::post('/artikel', [ArticleController::class, 'store'])
        ->name('articles.store');

    // Menampilkan formulir tambah artikel
    Route::get('/tambah', [ArticleController::class, 'create'])
        ->name('articles.create');

    // Upload gambar untuk konten artikel
    Route::post('/upload-gambar', [
        ArticleController::class,
        'uploadContentImage'
    ])->name('articles.upload-image');


    // Menampilkan formulir edit
    Route::get('/artikel/{slug}/edit', [ArticleController::class, 'edit'])
        ->name('articles.edit');

    // Memperbarui artikel
    Route::put('/artikel/{slug}', [ArticleController::class, 'update'])
        ->name('articles.update');

    // Menghapus artikel
    Route::delete('/artikel/{slug}', [ArticleController::class, 'destroy'])
        ->name('articles.destroy');


    // Profil pengguna dari Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


require __DIR__.'/auth.php';
