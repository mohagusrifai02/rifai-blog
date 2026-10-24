@extends('layouts.blog')

@section('title', 'Edit Artikel')

@section('content')

<div class="min-h-screen bg-slate-50 px-4 py-10 sm:px-6 lg:px-8">
    <div class="mx-auto max-w-4xl">

        {{-- Header --}}
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
                    Edit Artikel
                </h1>

                <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-500 sm:text-base">
                    Perbarui informasi dan isi artikelmu tanpa kehilangan data yang sudah tersimpan.
                </p>
            </div>
        </div>

        {{-- Form Edit --}}
        <form
            action="{{ route('articles.update', ['slug' => $article->slug]) }}"
            method="POST"
            enctype="multipart/form-data"
            class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm"
        >
            @csrf
            @method('PUT')

            <div class="space-y-8 p-6 sm:p-8">

                {{-- Informasi Artikel --}}
                <section>
                    <div class="mb-6">
                        <h2 class="text-lg font-bold text-slate-900">
                            Informasi Artikel
                        </h2>
                        <p class="mt-1 text-sm text-slate-500">
                            Ubah judul atau slug artikel sesuai kebutuhan.
                        </p>
                    </div>

                    <div class="mb-6">
                        <label for="title"
                               class="mb-2 block text-sm font-semibold text-slate-700">
                            Judul Artikel
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="title"
                            id="title"
                            value="{{ old('title', $article->title) }}"
                            required
                            class="w-full rounded-xl border-slate-300 px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 focus:border-blue-500 focus:ring-blue-500"
                        >

                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="slug"
                               class="mb-2 block text-sm font-semibold text-slate-700">
                            Slug Artikel
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="text"
                            name="slug"
                            id="slug"
                            value="{{ old('slug', $article->slug) }}"
                            required
                            class="w-full rounded-xl border-slate-300 px-4 py-3 text-sm text-slate-800 placeholder:text-slate-400 focus:border-blue-500 focus:ring-blue-500"
                        >

                        <p class="mt-2 text-xs leading-5 text-slate-500">
                            Slug merupakan bagian URL artikel. Jika diubah, URL artikel juga akan berubah.
                        </p>

                        @error('slug')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </section>

                <div class="border-t border-slate-100"></div>

                {{-- Gambar Artikel --}}
                <section>
                    <div class="mb-5">
                        <h2 class="text-lg font-bold text-slate-900">
                            Gambar Utama
                        </h2>
                        <p class="mt-1 text-sm text-slate-500">
                            Pertahankan gambar saat ini atau pilih gambar pengganti.
                        </p>
                    </div>

                    @if ($article->image)
                        <div class="mb-5 rounded-xl border border-slate-200 bg-slate-50 p-4">
                            <p class="mb-3 text-sm font-semibold text-slate-700">
                                Cover saat ini
                            </p>

                            <img
                                src="{{ asset('storage/' . $article->image) }}"
                                alt="{{ $article->title }}"
                                class="max-h-72 max-w-full rounded-lg border border-slate-200 bg-white object-contain"
                            >
                        </div>
                    @else
                        <p class="mb-5 rounded-xl bg-slate-50 p-4 text-sm text-slate-500">
                            Artikel ini belum memiliki gambar utama.
                        </p>
                    @endif

                    <label for="image"
                           class="mb-2 block text-sm font-semibold text-slate-700">
                        Pilih Gambar Pengganti
                    </label>

                    <input
                        type="file"
                        name="image"
                        id="image"
                        accept="image/jpeg,image/png,image/webp"
                        class="block w-full cursor-pointer rounded-xl border border-slate-300 bg-white text-sm text-slate-600 file:mr-4 file:border-0 file:bg-blue-50 file:px-4 file:py-3 file:font-semibold file:text-blue-700 hover:file:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >

                    <p class="mt-2 text-xs leading-5 text-slate-500">
                        Kosongkan jika tidak ingin mengganti gambar. Format yang disarankan: JPG, PNG, atau WebP.
                    </p>

                    @error('image')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror

                    <div id="preview-container" class="mt-5 hidden rounded-xl border border-blue-100 bg-blue-50/50 p-4">
                        <p class="mb-3 text-sm font-semibold text-blue-800">
                            Preview gambar pengganti
                        </p>

                        <img
                            id="image-preview"
                            src=""
                            alt="Preview gambar pengganti"
                            class="max-h-72 max-w-full rounded-lg border border-slate-200 bg-white object-contain"
                        >
                    </div>
                </section>

                <div class="border-t border-slate-100"></div>

                {{-- Konten --}}
                <section>
                    <div class="mb-5">
                        <h2 class="text-lg font-bold text-slate-900">
                            Isi Artikel
                        </h2>
                        <p class="mt-1 text-sm text-slate-500">
                            Edit teks, format tulisan, atau gambar di dalam konten menggunakan editor Quill.
                        </p>
                    </div>

                    <label for="editor"
                           class="mb-2 block text-sm font-semibold text-slate-700">
                        Konten Artikel
                        <span class="text-red-500">*</span>
                    </label>

                    <div
                        id="editor"
                        class="min-h-80 rounded-xl border border-slate-300 bg-white text-slate-800"
                    >{!! old('content', $article->content) !!}</div>

                    <input
                        type="hidden"
                        name="content"
                        id="content"
                        value="{{ old('content', $article->content) }}"
                    >

                    @error('content')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </section>

            </div>

            {{-- Tombol --}}
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
                    Simpan Perubahan
                </button>

            </div>
        </form>

    </div>
</div>

{{-- Preview gambar pengganti --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('image-preview');
        const previewContainer = document.getElementById('preview-container');

        if (!imageInput || !imagePreview || !previewContainer) {
            return;
        }

        let previewUrl = null;

        imageInput.addEventListener('change', function () {
            const file = this.files && this.files[0];

            if (previewUrl) {
                URL.revokeObjectURL(previewUrl);
                previewUrl = null;
            }

            if (!file) {
                imagePreview.removeAttribute('src');
                previewContainer.classList.add('hidden');
                return;
            }

            if (!file.type.startsWith('image/')) {
                this.value = '';
                imagePreview.removeAttribute('src');
                previewContainer.classList.add('hidden');
                alert('Pilih file gambar yang valid.');
                return;
            }

            previewUrl = URL.createObjectURL(file);
            imagePreview.src = previewUrl;
            previewContainer.classList.remove('hidden');
        });
    });
</script>

@endsection