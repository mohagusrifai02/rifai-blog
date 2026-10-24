@extends('layouts.blog')

@section('title', 'Buat Artikel Baru')

@section('content')

<div class="min-h-screen bg-slate-50 px-4 py-10 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-4xl">

        {{-- Header Halaman --}}
        <div class="mb-8">
            <a href="{{ route('dashboard') }}"
               class="inline-flex items-center gap-2 text-sm font-semibold text-slate-500 transition hover:text-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg"
                     class="h-4 w-4"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M15 19l-7-7 7-7" />
                </svg>
                Kembali ke dashboard
            </a>

            <div class="mt-5">
                <span class="text-sm font-semibold text-blue-600">
                    RUANG EDITOR
                </span>

                <h1 class="mt-2 text-3xl font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                    Buat Artikel Baru
                </h1>

                <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-500 sm:text-base">
                    Tuangkan ide dan perspektifmu ke dalam tulisan yang menarik untuk pembaca.
                </p>
            </div>
        </div>

        {{-- Form Artikel --}}
        <form
            action="{{ route('articles.store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm"
        >
            @csrf

            <div class="space-y-8 p-6 sm:p-8">

                {{-- Informasi Dasar --}}
                <section>
                    <div class="mb-6">
                        <h2 class="text-lg font-bold text-slate-900">
                            Informasi Artikel
                        </h2>
                        <p class="mt-1 text-sm text-slate-500">
                            Tentukan judul dan alamat artikel.
                        </p>
                    </div>

                    {{-- Judul --}}
                    <div class="mb-6">
                        <label for="title"
                               class="mb-2 block text-sm font-semibold text-slate-700">
                            Judul Artikel
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            id="title"
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="Contoh: Mengenal Dasar-Dasar Laravel"
                            required
                            class="w-full rounded-xl border-slate-300 px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 focus:border-blue-500 focus:ring-blue-500"
                        >

                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Slug --}}
                    <div>
                        <label for="slug"
                               class="mb-2 block text-sm font-semibold text-slate-700">
                            Slug Artikel
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            id="slug"
                            name="slug"
                            value="{{ old('slug') }}"
                            placeholder="mengenal-dasar-dasar-laravel"
                            required
                            class="w-full rounded-xl border-slate-300 px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 focus:border-blue-500 focus:ring-blue-500"
                        >

                        <p class="mt-2 text-xs leading-5 text-slate-500">
                            Slug digunakan sebagai bagian URL artikel. Gunakan huruf kecil dan tanda hubung.
                        </p>

                        @error('slug')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </section>

                <div class="border-t border-slate-100"></div>

                {{-- Gambar Utama --}}
                <section>
                    <div class="mb-5">
                        <h2 class="text-lg font-bold text-slate-900">
                            Gambar Utama
                        </h2>
                        <p class="mt-1 text-sm text-slate-500">
                            Pilih gambar yang mewakili isi artikel.
                        </p>
                    </div>

                    <label for="image"
                           class="mb-2 block text-sm font-semibold text-slate-700">
                        Upload Gambar
                    </label>

                    <input
                        type="file"
                        name="image"
                        id="image"
                        accept="image/jpeg,image/png,image/webp"
                        class="block w-full cursor-pointer rounded-xl border border-slate-300 bg-white text-sm text-slate-600 file:mr-4 file:border-0 file:bg-blue-50 file:px-4 file:py-3 file:font-semibold file:text-blue-700 hover:file:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >

                    <p class="mt-2 text-xs text-slate-500">
                        Format yang disarankan: JPG, PNG, atau WebP. Ikuti batas ukuran file pada validasi aplikasi.
                    </p>

                    <img
                        id="image-preview"
                        src=""
                        alt="Preview gambar cover"
                        class="mt-4 hidden max-h-80 w-auto max-w-full rounded-xl border border-slate-200 object-contain"
                    >

                    @error('image')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </section>

                <div class="border-t border-slate-100"></div>

                {{-- Konten Artikel --}}
                <section>
                    <div class="mb-5">
                        <h2 class="text-lg font-bold text-slate-900">
                            Isi Artikel
                        </h2>
                        <p class="mt-1 text-sm text-slate-500">
                            Tulis artikel dengan editor di bawah. Kamu juga dapat menggunakan fitur pemformatan Quill yang sudah tersedia.
                        </p>
                    </div>

                    <label for="editor"
                           class="mb-2 block text-sm font-semibold text-slate-700">
                        Konten
                        <span class="text-red-500">*</span>
                    </label>

                    <div
                        id="editor"
                        class="min-h-80 rounded-xl border border-slate-300 bg-white text-slate-800"
                    >{!! old('content') !!}</div>

                    <input
                        type="hidden"
                        name="content"
                        id="content"
                        value="{{ old('content') }}"
                    >

                    @error('content')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </section>

            </div>

            {{-- Tombol Aksi --}}
            <div class="flex flex-col-reverse gap-3 border-t border-slate-200 bg-slate-50 px-6 py-5 sm:flex-row sm:items-center sm:justify-end sm:px-8">

                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center justify-center rounded-xl border border-slate-300 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                    Batal
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-6 py-3 text-sm font-bold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                >
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-5 w-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan Artikel
                </button>

            </div>
        </form>

        <p class="mt-5 text-center text-xs text-slate-400">
            Pastikan judul, slug, gambar, dan isi artikel sudah benar sebelum disimpan.
        </p>

    </div>
</div>

@endsection