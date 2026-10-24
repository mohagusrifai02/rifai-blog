 @extends('layouts.blog')

@section('title', 'Tentang Saya — Web Developer')

@section('content')
<div class="bg-white text-slate-800">

    {{-- HERO --}}
    <section class="relative overflow-hidden border-b border-slate-100">
        <div class="absolute -right-20 -top-24 h-72 w-72 rounded-full bg-blue-100/70 blur-3xl"></div>
        <div class="absolute -bottom-24 -left-20 h-64 w-64 rounded-full bg-indigo-100/60 blur-3xl"></div>

        <div class="relative mx-auto grid max-w-6xl items-center gap-12 px-6 py-20 md:grid-cols-2 md:py-28">

            <div>
                <div class="mb-6 inline-flex items-center gap-2 rounded-full border border-blue-100 bg-blue-50 px-4 py-2 text-sm font-semibold text-blue-700">
                    <span class="h-2 w-2 animate-pulse rounded-full bg-blue-600"></span>
                    Web Developer Portfolio
                </div>

                <p class="mb-3 text-sm font-semibold uppercase tracking-[0.2em] text-slate-500">
                    Halo, Teman
                </p>

                <h1 class="text-4xl font-extrabold leading-tight tracking-tight text-slate-900 sm:text-5xl lg:text-6xl">
                    Membangun Web
                    <span class="text-blue-600">yang Fungsional</span>
                    dan Modern.
                </h1>

                <p class="mt-6 max-w-xl text-base leading-8 text-slate-600 md:text-lg">
                    Saya seorang web developer yang berfokus pada pengembangan aplikasi web menggunakan
                    <strong class="text-slate-800">Laravel</strong> dan
                    <strong class="text-slate-800">JavaScript</strong>.
                    Saya senang mengubah ide menjadi aplikasi yang terstruktur, responsif, dan bermanfaat.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="#proyek"
                       class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-6 py-3.5 font-semibold text-white shadow-lg shadow-blue-600/20 transition hover:-translate-y-0.5 hover:bg-blue-700">
                        Lihat Proyek
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>

                    <a href="#kontak"
                       class="rounded-xl border border-slate-200 bg-white px-6 py-3.5 font-semibold text-slate-700 transition hover:border-blue-300 hover:text-blue-700">
                        Hubungi Saya
                    </a>
                </div>
            </div>

            {{-- CODE CARD --}}
            <div class="mx-auto w-full max-w-lg">
                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-slate-950 shadow-2xl shadow-blue-950/15">
                    <div class="flex items-center justify-between border-b border-white/10 px-5 py-4">
                        <div class="flex gap-2">
                            <span class="h-3 w-3 rounded-full bg-red-400"></span>
                            <span class="h-3 w-3 rounded-full bg-yellow-400"></span>
                            <span class="h-3 w-3 rounded-full bg-green-400"></span>
                        </div>
                        <span class="text-xs text-slate-400">developer.php</span>
                    </div>

                    <div class="overflow-x-auto p-6 font-mono text-sm leading-8 sm:p-8">
                        <p class="text-slate-500">// My development philosophy</p>
                        <p><span class="text-purple-400">class</span> <span class="text-yellow-300">WebDeveloper</span></p>
                        <p class="pl-4 text-slate-300">{</p>
                        <p class="pl-8">
                            <span class="text-purple-400">public string</span>
                            <span class="text-sky-300">$backend</span>
                            <span class="text-slate-300">= </span><span class="text-green-300">'Laravel'</span>;
                        </p>
                        <p class="pl-8">
                            <span class="text-purple-400">public string</span>
                            <span class="text-sky-300">$frontend</span>
                            <span class="text-slate-300">= </span><span class="text-green-300">'JavaScript'</span>;
                        </p>
                        <p class="pl-8">
                            <span class="text-purple-400">public string</span>
                            <span class="text-sky-300">$goal</span>
                            <span class="text-slate-300">= </span><span class="text-green-300">'Build useful products'</span>;
                        </p>
                        <p class="text-slate-300">}</p>
                        <div class="mt-5 border-t border-white/10 pt-4 text-slate-400">
                            <span class="text-green-400">➜</span>
                            Writing code with purpose<span class="animate-pulse">_</span>
                        </div>
                    </div>
                </div>

                <div class="mt-4 grid grid-cols-2 gap-4">
                    <div class="rounded-xl border border-slate-100 bg-slate-50 p-4">
                        <p class="text-sm text-slate-500">Backend</p>
                        <p class="mt-1 font-bold text-slate-900">Laravel & PHP</p>
                    </div>
                    <div class="rounded-xl border border-slate-100 bg-slate-50 p-4">
                        <p class="text-sm text-slate-500">Frontend</p>
                        <p class="mt-1 font-bold text-slate-900">JavaScript</p>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- ABOUT ME --}}
    <section class="mx-auto max-w-6xl px-6 py-20 md:py-24">
        <div class="grid gap-10 md:grid-cols-[0.8fr_1.2fr] md:gap-16">
            <div>
                <p class="text-sm font-bold uppercase tracking-[0.2em] text-blue-600">Tentang Saya</p>
                <h2 class="mt-4 text-3xl font-extrabold leading-tight text-slate-900 sm:text-4xl">
                    Bukan sekadar menulis kode, tetapi memecahkan masalah.
                </h2>
            </div>

            <div class="space-y-5 text-base leading-8 text-slate-600">
                <p>
                    Bagi saya, pengembangan web bukan hanya tentang membuat halaman terlihat menarik.
                    Sebuah aplikasi juga harus memiliki struktur kode yang jelas, alur kerja yang logis,
                    keamanan yang diperhatikan, dan pengalaman pengguna yang nyaman.
                </p>
                <p>
                    Saya berfokus pada Laravel untuk membangun sisi backend seperti autentikasi,
                    pengelolaan data, CRUD, dan API. Di sisi frontend, saya menggunakan JavaScript
                    untuk menghadirkan interaksi yang dinamis dan pengalaman pengguna yang lebih baik.
                </p>
                <p>
                    Saya terus mengembangkan kemampuan melalui proyek nyata, mempelajari cara kerja
                    teknologi, dan memperbaiki solusi secara bertahap agar aplikasi lebih mudah
                    dipelihara dan dikembangkan.
                </p>
            </div>
        </div>
    </section>

    {{-- SKILLS --}}
    <section class="border-y border-slate-100 bg-slate-50/70">
        <div class="mx-auto max-w-6xl px-6 py-20 md:py-24">
            <div class="mx-auto mb-12 max-w-2xl text-center">
                <p class="text-sm font-bold uppercase tracking-[0.2em] text-blue-600">Keahlian</p>
                <h2 class="mt-4 text-3xl font-extrabold text-slate-900 sm:text-4xl">
                    Teknologi yang Saya Gunakan
                </h2>
                <p class="mt-4 leading-7 text-slate-600">
                    Berfokus pada backend yang terstruktur dan frontend yang interaktif.
                </p>
            </div>

            <div class="grid gap-6 md:grid-cols-2">

                {{-- LARAVEL --}}
                <div class="rounded-2xl border border-red-100 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex items-start gap-5">
                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-red-50 text-red-600">
                            <svg class="h-8 w-8" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M7.2 2.5 2 5.5v6l5.2 3 5.2-3v-6l-5.2-3Zm0 2.1 3.4 2-3.4 2-3.4-2 3.4-2ZM3.7 8l2.7 1.6v3.1l-2.7-1.6V8Zm7 0v3.1L8 12.7V9.6L10.7 8ZM16.8 9.5l-5.2 3v6l5.2 3 5.2-3v-6l-5.2-3Zm0 2.1 3.4 2-3.4 2-3.4-2 3.4-2Zm-3.5 3.4 2.7 1.6v3.1l-2.7-1.6V15Zm7 0v3.1l-2.7 1.6v-3.1l2.7-1.6Z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">Laravel & PHP</h3>
                            <p class="mt-2 leading-7 text-slate-600">
                                Membangun aplikasi backend dengan MVC, routing, Blade, Eloquent ORM,
                                autentikasi, validasi, middleware, dan operasi CRUD.
                            </p>
                            <div class="mt-4 flex flex-wrap gap-2">
                                <span class="rounded-full bg-red-50 px-3 py-1 text-xs font-semibold text-red-700">MVC</span>
                                <span class="rounded-full bg-red-50 px-3 py-1 text-xs font-semibold text-red-700">Eloquent ORM</span>
                                <span class="rounded-full bg-red-50 px-3 py-1 text-xs font-semibold text-red-700">REST API</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- JAVASCRIPT --}}
                <div class="rounded-2xl border border-yellow-100 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex items-start gap-5">
                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-yellow-100 text-yellow-800">
                            <svg class="h-8 w-8" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M3 3h18v18H3V3Zm9.7 14.1c.4.7 1 1.1 1.9 1.1.8 0 1.3-.4 1.3-.9 0-.6-.5-.8-1.4-1.2l-.5-.2c-1.4-.6-2.3-1.3-2.3-2.8 0-1.4 1.1-2.5 2.8-2.5 1.2 0 2.1.4 2.8 1.5l-1.5 1c-.3-.6-.7-.8-1.3-.8-.6 0-.9.3-.9.8s.3.7 1.1 1l.5.2c1.7.7 2.7 1.4 2.7 2.9 0 1.7-1.3 2.7-3.1 2.7-1.7 0-2.8-.8-3.4-1.9l1.3-.9ZM7.2 17c.3.5.5.9 1.1.9.5 0 .8-.2.8-1.1v-6h1.9v6c0 2-1.2 2.9-2.8 2.9-1.5 0-2.4-.8-2.9-1.8l1.9-.9Z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">JavaScript</h3>
                            <p class="mt-2 leading-7 text-slate-600">
                                Membuat antarmuka interaktif melalui DOM, event handling, Fetch API,
                                pengolahan data JSON, dan komunikasi asynchronous dengan backend.
                            </p>
                            <div class="mt-4 flex flex-wrap gap-2">
                                <span class="rounded-full bg-yellow-50 px-3 py-1 text-xs font-semibold text-yellow-800">DOM</span>
                                <span class="rounded-full bg-yellow-50 px-3 py-1 text-xs font-semibold text-yellow-800">Fetch API</span>
                                <span class="rounded-full bg-yellow-50 px-3 py-1 text-xs font-semibold text-yellow-800">Async</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- FRONTEND --}}
                <div class="rounded-2xl border border-blue-100 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex items-start gap-5">
                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-blue-50 text-blue-600">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="16" rx="2" stroke-width="1.8"/>
                                <path d="M3 9h18M7 6.5h.01M10 6.5h.01" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">HTML, CSS & Tailwind</h3>
                            <p class="mt-2 leading-7 text-slate-600">
                                Menyusun struktur halaman yang semantik dan membangun layout responsif
                                untuk desktop maupun perangkat mobile.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- DATABASE --}}
                <div class="rounded-2xl border border-emerald-100 bg-white p-7 shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex items-start gap-5">
                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600">
                            <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <ellipse cx="12" cy="5" rx="8" ry="3" stroke-width="1.8"/>
                                <path d="M4 5v14c0 1.7 3.6 3 8 3s8-1.3 8-3V5M4 12c0 1.7 3.6 3 8 3s8-1.3 8-3" stroke-width="1.8"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-slate-900">Database & Git</h3>
                            <p class="mt-2 leading-7 text-slate-600">
                                Mengelola data menggunakan relasi model dan query database,
                                serta memanfaatkan Git untuk mencatat perubahan kode.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    {{-- PROJECTS --}}
    <section id="proyek" class="mx-auto max-w-6xl px-6 py-20 md:py-24">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <p class="text-sm font-bold uppercase tracking-[0.2em] text-blue-600">Portofolio</p>
                <h2 class="mt-4 text-3xl font-extrabold text-slate-900 sm:text-4xl">
                    Proyek Pilihan
                </h2>
                <p class="mt-4 max-w-2xl leading-7 text-slate-600">
                    Beberapa proyek yang dapat saya tampilkan untuk memperlihatkan proses belajar
                    dan penerapan teknologi web.
                </p>
            </div>
        </div>

        <div class="mt-10 grid gap-6 md:grid-cols-2">

            <article class="group overflow-hidden rounded-2xl border border-slate-200 bg-white transition hover:-translate-y-1 hover:shadow-xl">
                <div class="flex h-48 items-center justify-center bg-gradient-to-br from-red-50 via-white to-orange-50">
                    <div class="text-center">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-red-100 text-2xl font-black text-red-600">L</div>
                        <p class="mt-3 font-bold text-slate-800">Laravel Blog CMS</p>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-xs font-bold uppercase tracking-widest text-red-600">Laravel · PHP · SQLite</p>
                    <h3 class="mt-3 text-xl font-bold text-slate-900">Blog dengan Pengelolaan Artikel</h3>
                    <p class="mt-3 leading-7 text-slate-600">
                        Aplikasi blog dengan autentikasi, CRUD artikel, editor konten,
                        pencarian, pagination, serta fitur like dan penghitung kunjungan.
                    </p>
                    <p class="mt-4 text-sm font-semibold text-slate-500">Proyek pembelajaran aktif</p>
                </div>
            </article>

            <article class="group overflow-hidden rounded-2xl border border-slate-200 bg-white transition hover:-translate-y-1 hover:shadow-xl">
                <div class="flex h-48 items-center justify-center bg-gradient-to-br from-yellow-50 via-white to-blue-50">
                    <div class="text-center">
                        <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-yellow-100 font-mono text-2xl font-black text-yellow-800">JS</div>
                        <p class="mt-3 font-bold text-slate-800">Interactive Web</p>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-xs font-bold uppercase tracking-widest text-yellow-700">JavaScript · HTML · CSS</p>
                    <h3 class="mt-3 text-xl font-bold text-slate-900">Antarmuka Web Interaktif</h3>
                    <p class="mt-3 leading-7 text-slate-600">
                        Pengembangan interaksi antarmuka, manipulasi DOM, validasi input,
                        dan komunikasi data dengan Fetch API.
                    </p>
                    <p class="mt-4 text-sm font-semibold text-slate-500">Eksplorasi frontend</p>
                </div>
            </article>

        </div>

        <p class="mt-6 text-sm leading-6 text-slate-500">
            Catatan: bagian proyek di atas merupakan contoh untuk memulai. Sesuaikan dengan
            proyek yang benar-benar sudah kamu kerjakan dan tambahkan tautan demo atau repositori
            jika tersedia.
        </p>
    </section>

    {{-- WORK PROCESS --}}
    <section class="border-y border-slate-100 bg-slate-50/70">
        <div class="mx-auto max-w-6xl px-6 py-20 md:py-24">
            <div class="mx-auto max-w-2xl text-center">
                <p class="text-sm font-bold uppercase tracking-[0.2em] text-blue-600">Cara Kerja</p>
                <h2 class="mt-4 text-3xl font-extrabold text-slate-900 sm:text-4xl">
                    Dari Ide Menjadi Aplikasi
                </h2>
            </div>

            <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @php
                    $steps = [
                        ['01', 'Memahami Kebutuhan', 'Menentukan tujuan, pengguna, dan masalah yang ingin diselesaikan.'],
                        ['02', 'Merancang Solusi', 'Menyusun struktur data, alur aplikasi, dan antarmuka.'],
                        ['03', 'Mengembangkan', 'Membangun backend dan frontend secara bertahap.'],
                        ['04', 'Menguji & Memperbaiki', 'Memeriksa fitur, memperbaiki bug, dan menyempurnakan pengalaman pengguna.'],
                    ];
                @endphp

                @foreach ($steps as $step)
                    <div class="rounded-2xl border border-slate-200 bg-white p-6">
                        <p class="text-3xl font-black text-blue-600">{{ $step[0] }}</p>
                        <h3 class="mt-5 font-bold text-slate-900">{{ $step[1] }}</h3>
                        <p class="mt-3 text-sm leading-7 text-slate-600">{{ $step[2] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CONTACT CTA --}}
    <section id="kontak" class="mx-auto max-w-5xl px-6 py-20 md:py-24">
        <div class="relative overflow-hidden rounded-3xl bg-slate-950 px-7 py-12 text-center sm:px-12 sm:py-16">
            <div class="absolute -right-16 -top-20 h-56 w-56 rounded-full bg-blue-500/20 blur-3xl"></div>
            <div class="absolute -bottom-24 -left-16 h-56 w-56 rounded-full bg-indigo-500/20 blur-3xl"></div>

            <div class="relative">
                <p class="text-sm font-bold uppercase tracking-[0.2em] text-blue-300">Mari Berkolaborasi</p>
                <h2 class="mx-auto mt-4 max-w-2xl text-3xl font-extrabold text-white sm:text-4xl">
                    Punya ide untuk proyek web berikutnya?
                </h2>
                <p class="mx-auto mt-5 max-w-xl leading-7 text-slate-300">
                    Saya terbuka untuk belajar, berdiskusi, dan berkolaborasi dalam pengembangan aplikasi web.
                </p>

                <a href="mailto:emailkamu@example.com"
                   class="mt-8 inline-flex items-center gap-2 rounded-xl bg-white px-6 py-3.5 font-bold text-slate-900 transition hover:-translate-y-0.5 hover:bg-blue-50">
                    Hubungi Saya
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M4 6h16v12H4z M4 7l8 6 8-6" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>
        </div>
    </section>

</div>
@endsection