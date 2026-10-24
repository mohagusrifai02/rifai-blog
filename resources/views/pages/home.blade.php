@extends('layouts.blog')

@section('title', 'Beranda')

@section('content')
<div class="min-h-screen bg-white">
    {{-- Hero --}}
    <section class="border-b border-slate-100 bg-gradient-to-b from-blue-50 to-white">
        <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8 lg:py-20">
            <p class="mb-4 text-sm font-bold uppercase tracking-[0.2em] text-blue-600">
                Jelajahi cerita
            </p>

            <h1 class="max-w-3xl text-4xl font-extrabold tracking-tight text-slate-900 sm:text-5xl lg:text-6xl">
                Ide baru,
                <span class="text-blue-600">perspektif baru.</span>
            </h1>

            <p class="mt-5 max-w-2xl text-base leading-7 text-slate-600 sm:text-lg">
                Temukan artikel, wawasan, dan cerita terbaru yang menambah
                pengetahuan serta membuka sudut pandang baru.
            </p>

            {{-- Pencarian --}}
            <form action="{{ route('home') }}" method="GET"
                class="mt-8 flex max-w-2xl flex-col gap-3 sm:flex-row">
                <input
                    type="search"
                    name="search"
                    value="{{ $search ?? '' }}"
                    placeholder="Cari judul artikel..."
                    aria-label="Cari judul artikel"
                    class="min-w-0 flex-1 rounded-xl border border-slate-200 bg-white px-4 py-3 text-slate-800 shadow-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                >

                <button type="submit"
                    class="rounded-xl bg-blue-600 px-6 py-3 font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Cari artikel
                </button>

                @if ($search)
                    <a href="{{ route('home') }}"
                        class="rounded-xl border border-slate-200 px-5 py-3 text-center font-medium text-slate-600 transition hover:bg-slate-50">
                        Reset
                    </a>
                @endif
            </form>
        </div>
    </section>

    <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
        {{-- Ringkasan --}}
        <div class="mb-8 flex flex-wrap items-end justify-between gap-3">
            <div>
                <p class="text-sm font-semibold text-blue-600">
                    {{ $search ? 'HASIL PENCARIAN' : 'JANGAN LEWATKAN' }}
                </p>

                <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                    {{ $search ? 'Artikel yang ditemukan' : 'Artikel terbaru' }}
                </h2>
            </div>

            <p class="text-sm text-slate-500">
                {{ $articles->total() }} artikel ditemukan
            </p>
        </div>

        @if ($articles->isNotEmpty())
            {{-- Artikel unggulan --}}
            @if (!$search)
                @php($featured = $articles->first())

                <article class="mb-12 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <div class="grid md:grid-cols-2">
                        <a href="{{ route('articles.show', $featured->slug) }}"
                            class="block overflow-hidden bg-slate-100">
                            @if ($featured->image)
                                <img
                                    src="{{ asset('storage/' . $featured->image) }}"
                                    alt="{{ $featured->title }}"
                                    class="h-64 w-full object-cover transition duration-500 hover:scale-105 md:h-full md:min-h-80"
                                >
                            @else
                                <div class="flex h-64 items-center justify-center bg-gradient-to-br from-blue-100 to-slate-100 md:min-h-80">
                                    <span class="text-5xl font-black text-blue-200">BLOG</span>
                                </div>
                            @endif
                        </a>

                        <div class="flex flex-col justify-center p-6 sm:p-9">
                            <span class="mb-3 text-xs font-bold uppercase tracking-widest text-blue-600">
                                Pilihan editor
                            </span>

                            <h3 class="text-2xl font-bold leading-tight tracking-tight text-slate-900 sm:text-3xl">
                                <a href="{{ route('articles.show', $featured->slug) }}"
                                    class="transition hover:text-blue-600">
                                    {{ $featured->title }}
                                </a>
                            </h3>

                            <p class="mt-4 text-sm text-slate-500">
                                Oleh {{ $featured->user?->name ?? 'Penulis' }}
                                <span class="mx-2">·</span>
                                {{ $featured->created_at->format('d M Y') }}
                            </p>

                            <a href="{{ route('articles.show', $featured->slug) }}"
                                class="mt-6 inline-flex w-fit items-center gap-2 rounded-lg bg-blue-600 px-5 py-3 font-semibold text-white transition hover:bg-blue-700">
                                Baca artikel
                                <span aria-hidden="true">→</span>
                            </a>
                        </div>
                    </div>
                </article>
            @endif

            {{-- Grid artikel --}}
            <div class="mb-6 flex items-center justify-between">
                <h3 class="text-xl font-bold text-slate-900">
                    {{ $search ? 'Hasil pencarian' : 'Tulisan lainnya' }}
                </h3>
            </div>

            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($articles as $article)
                    @if ($search || $loop->index > 0)
                        <article class="group overflow-hidden rounded-2xl border border-slate-200 bg-white transition duration-300 hover:-translate-y-1 hover:border-blue-200 hover:shadow-lg">
                            <a href="{{ route('articles.show', $article->slug) }}"
                                class="block overflow-hidden bg-slate-100">
                                @if ($article->image)
                                    <img
                                        src="{{ asset('storage/' . $article->image) }}"
                                        alt="{{ $article->title }}"
                                        loading="lazy"
                                        class="h-52 w-full object-cover transition duration-500 group-hover:scale-105"
                                    >
                                @else
                                    <div class="flex h-52 items-center justify-center bg-gradient-to-br from-blue-50 to-slate-100">
                                        <span class="text-3xl font-black text-blue-200">BLOG</span>
                                    </div>
                                @endif
                            </a>

                            <div class="p-5">
                                <p class="text-xs font-medium text-slate-500">
                                    {{ $article->created_at->format('d M Y') }}
                                    <span class="mx-1">·</span>
                                    {{ $article->user?->name ?? 'Penulis' }}
                                </p>

                                <h4 class="mt-3 text-lg font-bold leading-snug text-slate-900 transition group-hover:text-blue-600">
                                    <a href="{{ route('articles.show', $article->slug) }}">
                                        {{ $article->title }}
                                    </a>
                                </h4>

                                <a href="{{ route('articles.show', $article->slug) }}"
                                    class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-blue-600 hover:text-blue-800">
                                    Baca selengkapnya
                                    <span aria-hidden="true">→</span>
                                </a>
                            </div>
                        </article>
                    @endif
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-10">
                {{ $articles->links() }}
            </div>
        @else
            <div class="rounded-2xl border border-dashed border-slate-300 px-6 py-16 text-center">
                <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-full bg-blue-50 text-blue-600">
                    <span class="text-2xl" aria-hidden="true">⌕</span>
                </div>

                <h3 class="mt-4 text-lg font-bold text-slate-900">
                    Artikel belum ditemukan
                </h3>

                <p class="mt-2 text-sm text-slate-500">
                    @if ($search)
                        Coba gunakan kata kunci yang berbeda.
                    @else
                        Belum ada artikel yang diterbitkan.
                    @endif
                </p>

                @if ($search)
                    <a href="{{ route('home') }}"
                        class="mt-5 inline-flex rounded-lg bg-blue-600 px-5 py-3 font-semibold text-white hover:bg-blue-700">
                        Lihat semua artikel
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection
