<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-medium text-blue-600">
                    Ruang Kerja
                </p>
                <h2 class="text-2xl font-extrabold tracking-tight text-slate-900">
                    Dashboard
                </h2>
            </div>

            <p class="text-sm text-slate-500">
                Selamat datang, {{ auth()->user()->name }}
            </p>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 py-8 sm:py-10">
        <div class="mx-auto max-w-7xl space-y-8 px-4 sm:px-6 lg:px-8">

            {{-- Notifikasi --}}
            @if (session('success'))
                <div class="flex items-start gap-3 rounded-xl border border-green-200 bg-green-50 p-4 text-green-800">
                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="mt-0.5 h-5 w-5 shrink-0"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M5 13l4 4L19 7" />
                    </svg>

                    <p class="text-sm font-medium">
                        {{ session('success') }}
                    </p>
                </div>
            @endif

            {{-- Ringkasan --}}
            <section class="grid gap-5 sm:grid-cols-2">
                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Artikel pada halaman ini
                            </p>
                            <p class="mt-2 text-3xl font-extrabold text-slate-900">
                                {{ $articles->count() }}
                            </p>
                            <p class="mt-2 text-sm text-slate-500">
                                Artikel yang sedang ditampilkan
                            </p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-600">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-6 w-6"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="1.8">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex items-center justify-between gap-4">
                        <div>
                            <p class="text-sm font-medium text-slate-500">
                                Status akun
                            </p>
                            <p class="mt-2 text-2xl font-extrabold text-slate-900">
                                {{ auth()->user()->is_admin ? 'Administrator' : 'Pengguna' }}
                            </p>
                            <p class="mt-2 text-sm text-slate-500">
                                Hak akses akun saat ini
                            </p>
                        </div>

                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-6 w-6"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="1.8">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM5 21a7 7 0 0114 0" />
                            </svg>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Daftar Artikel --}}
            <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

                <div class="flex flex-col gap-4 border-b border-slate-100 p-6 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-xl font-bold text-slate-900">
                            Daftar Artikel
                        </h3>
                        <p class="mt-1 text-sm text-slate-500">
                            Kelola dan pantau artikelmu.
                        </p>
                    </div>

                    @if (auth()->user()->is_admin)
                        <a href="{{ route('articles.create') }}"
                           class="inline-flex items-center justify-center gap-2 rounded-xl bg-blue-600 px-5 py-3 text-sm font-bold text-white transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-5 w-5"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M12 4v16m8-8H4" />
                            </svg>
                            Buat Artikel
                        </a>
                    @endif
                </div>

                {{-- Pencarian --}}
                <div class="border-b border-slate-100 bg-slate-50/70 p-6">
                    <form action="{{ route('dashboard') }}"
                          method="GET"
                          class="flex flex-col gap-3 sm:flex-row">

                        <div class="relative flex-1">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="absolute left-3 top-1/2 h-5 w-5 -translate-y-1/2 text-slate-400"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="1.8">
                                <circle cx="11" cy="11" r="7" />
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="m16 16 4 4" />
                            </svg>

                            <input
                                type="text"
                                name="search"
                                placeholder="Cari judul artikel..."
                                value="{{ $search ?? '' }}"
                                class="w-full rounded-xl border-slate-300 py-3 pl-10 pr-4 text-sm focus:border-blue-500 focus:ring-blue-500"
                            >
                        </div>

                        <button type="submit"
                                class="rounded-xl bg-slate-900 px-6 py-3 text-sm font-bold text-white transition hover:bg-slate-700">
                            Cari Artikel
                        </button>

                        @if ($search ?? false)
                            <a href="{{ route('dashboard') }}"
                               class="rounded-xl border border-slate-300 bg-white px-5 py-3 text-center text-sm font-semibold text-slate-600 transition hover:bg-slate-100">
                                Reset
                            </a>
                        @endif
                    </form>
                </div>

                {{-- Isi daftar --}}
                <div class="divide-y divide-slate-100">
                    @forelse ($articles as $article)
                        <div class="flex flex-col gap-5 p-6 transition hover:bg-slate-50/70 sm:flex-row sm:items-center">

                            {{-- Thumbnail --}}
                            <div class="h-32 w-full shrink-0 overflow-hidden rounded-xl bg-slate-100 sm:h-24 sm:w-36">
                                @if ($article->image)
                                    <img                                      
                                        src="{{ \Illuminate\Support\Str::startsWith($article->image, ['http://', 'https://'])
                                            ? $article->image
                                            : asset('storage/' . $article->image) }}"
                                        alt="{{ $article->title }}"
                                        class="h-full w-full object-cover"
                                        loading="lazy"
                                    >
                                @else
                                    <div class="flex h-full items-center justify-center text-sm font-medium text-slate-400">
                                        Tanpa gambar
                                    </div>
                                @endif
                            </div>

                            {{-- Informasi --}}
                            <div class="min-w-0 flex-1">
                                <h4 class="break-words text-lg font-bold text-slate-900">
                                    {{ $article->title }}
                                </h4>

                                <div class="mt-2 flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-slate-500">
                                    <span>
                                        {{ $article->created_at->format('d M Y') }}
                                    </span>

                                    <span class="inline-flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="h-4 w-4"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor"
                                             stroke-width="1.8">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M2.25 12s3.5-7 9.75-7 9.75 7 9.75 7-3.5 7-9.75 7-9.75-7-9.75-7z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                        {{ number_format($article->views) }} views
                                    </span>
                                </div>

                                <div class="mt-4 flex flex-wrap items-center gap-4 text-sm font-semibold">
                                    <a href="{{ route('articles.show', $article->slug) }}"
                                       class="text-blue-600 transition hover:text-blue-800">
                                        Lihat Artikel
                                    </a>

                                    @if (auth()->user()->is_admin)
                                        <a href="{{ route('articles.edit', $article->slug) }}"
                                           class="text-amber-600 transition hover:text-amber-700">
                                            Edit
                                        </a>

                                        <form action="{{ route('articles.destroy', $article->slug) }}"
                                              method="POST"
                                              onsubmit="return confirm('Yakin ingin menghapus artikel ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="text-red-600 transition hover:text-red-800">
                                                Hapus
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>

                        </div>
                    @empty
                        <div class="px-6 py-16 text-center">
                            <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="h-7 w-7"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="1.8">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
                                </svg>
                            </div>

                            <h4 class="mt-4 font-bold text-slate-900">
                                {{ ($search ?? false) ? 'Artikel tidak ditemukan' : 'Belum ada artikel' }}
                            </h4>

                            <p class="mt-2 text-sm text-slate-500">
                                {{ ($search ?? false)
                                    ? 'Coba gunakan kata kunci pencarian yang berbeda.'
                                    : 'Artikel yang tersedia akan muncul di bagian ini.' }}
                            </p>

                            @if ($search ?? false)
                                <a href="{{ route('dashboard') }}"
                                   class="mt-5 inline-block font-semibold text-blue-600 hover:text-blue-800">
                                    Tampilkan semua artikel
                                </a>
                            @endif
                        </div>
                    @endforelse
                </div>

                {{-- Pagination --}}
                @if ($articles->hasPages())
                    <div class="border-t border-slate-100 px-6 py-5">
                        {{ $articles->links() }}
                    </div>
                @endif

            </section>

        </div>
    </div>
</x-app-layout>