@extends('layouts.blog')

@section('title', $article->title)

@section('content')

<div class="mx-auto max-w-5xl px-5 py-10 sm:px-8 sm:py-14">

    {{-- Navigasi kembali --}}
    <div class="mb-8">
        <a href="{{ route('home') }}"
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
            Kembali ke beranda
        </a>
    </div>

    <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- Header Artikel --}}
        <header class="px-6 pt-8 sm:px-10 sm:pt-12">

            <div class="mb-5 flex flex-wrap items-center gap-3 text-sm">
                <span class="rounded-full bg-blue-50 px-3 py-1 font-semibold text-blue-700">
                    Artikel
                </span>

                <span class="text-slate-400">
                    {{ $article->created_at->format('d F Y') }}
                </span>
            </div>

            <h1 class="text-3xl font-extrabold leading-tight tracking-tight text-slate-900 sm:text-4xl lg:text-5xl">
                {{ $article->title }}
            </h1>

            <div class="mt-6 flex flex-wrap items-center justify-between gap-4 border-b border-slate-100 pb-7">

                {{-- Informasi Penulis --}}
                <div class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-full bg-blue-100 text-lg font-bold text-blue-700">
                        {{ strtoupper(substr($article->user?->name ?? 'P', 0, 1)) }}
                    </div>

                    <div>
                        <p class="text-xs text-slate-500">Ditulis oleh</p>
                        <p class="font-semibold text-slate-800">
                            {{ $article->user?->name ?? 'Tidak diketahui' }}
                        </p>
                    </div>
                </div>

                {{-- Jumlah Views --}}
                <div class="flex items-center gap-2 text-sm text-slate-500">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-5 w-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="1.8">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M2.25 12s3.5-7 9.75-7 9.75 7 9.75 7-3.5 7-9.75 7-9.75-7-9.75-7z" />
                        <circle cx="12" cy="12" r="3" />
                    </svg>

                    <span>{{ number_format($article->views) }} kali dilihat</span>
                </div>

            </div>
        </header>

        {{-- Gambar Utama --}}
        @if ($article->image)
            <div class="px-4 pt-6 sm:px-10 sm:pt-8">
                <img
                    src="{{ asset('storage/' . $article->image) }}"
                    alt="{{ $article->title }}"
                    class="max-h-[520px] w-full rounded-xl bg-slate-100 object-cover"
                >
            </div>
        @endif

        {{-- Isi Artikel --}}
        <div class="px-6 py-8 sm:px-10 sm:py-10">
            <div class="article-content prose prose-slate max-w-none
                        prose-headings:font-bold prose-headings:tracking-tight
                        prose-a:text-blue-600 prose-a:no-underline hover:prose-a:underline
                        prose-img:mx-auto prose-img:rounded-xl
                        prose-blockquote:border-blue-500 prose-blockquote:text-slate-600
                        prose-li:marker:text-blue-600">
                {!! $article->content !!}
            </div>
        </div>

        {{-- Interaksi Like --}}
        <footer class="border-t border-slate-100 bg-slate-50 px-6 py-6 sm:px-10">

            <div
                class="flex flex-wrap items-center justify-between gap-4"
                id="article-like"
                data-url="{{ route('articles.like', $article->slug) }}"
            >
                <div>
                    <p class="font-semibold text-slate-900">
                        Apakah artikel ini menarik?
                    </p>
                    <p class="mt-1 text-sm text-slate-500">
                        <span id="likes-count">{{ number_format($article->likes_count) }}</span>
                        orang menyukai artikel ini
                    </p>
                </div>

                @auth
                    <form id="like-form">
                        @csrf

                        <button
                            type="submit"
                            id="like-button"
                            data-liked="{{ $liked ? 'true' : 'false' }}"
                            aria-pressed="{{ $liked ? 'true' : 'false' }}"
                            class="inline-flex items-center gap-2 rounded-xl px-5 py-3 text-sm font-bold transition
                                {{ $liked
                                    ? 'bg-blue-600 text-white hover:bg-blue-700'
                                    : 'border border-slate-300 bg-white text-slate-700 hover:border-blue-300 hover:bg-blue-50 hover:text-blue-700' }}"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-5 w-5"
                                 fill="{{ $liked ? 'currentColor' : 'none' }}"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="1.8">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M14 9V5a3 3 0 00-3-3l-4 9v11h11.28a2 2 0 001.98-1.72l1.4-9A2 2 0 0019.68 9H14zM7 22H4a2 2 0 01-2-2v-7a2 2 0 012-2h3" />
                            </svg>

                            <span id="like-button-text">
                                {{ $liked ? 'Batal menyukai' : 'Suka artikel' }}
                            </span>
                        </button>
                    </form>

                    <span id="like-error" class="w-full text-sm text-red-600" role="status"></span>
                @else
                    <a href="{{ route('login') }}"
                       class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-bold text-white transition hover:bg-blue-700">
                        Login untuk menyukai
                    </a>
                @endauth
            </div>

        </footer>

    </article>

</div>

@endsection