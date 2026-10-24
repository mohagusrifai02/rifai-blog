<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title', 'Blog Laravel')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-white text-slate-800 antialiased">

    <header class="sticky top-0 z-50 border-b border-slate-200 bg-white/95 backdrop-blur">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-5 py-4 sm:px-8">

            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-600 text-lg font-bold text-white">
                    B
                </span>

                <span class="text-xl font-extrabold tracking-tight text-slate-900">
                    Blog<span class="text-blue-600">Laravel</span>
                </span>
            </a>

            {{-- Navigasi Desktop --}}
            <nav class="hidden items-center gap-6 md:flex">
                <a href="{{ route('home') }}"
                   class="rounded-lg px-3 py-2 text-sm font-semibold text-blue-600 transition hover:bg-blue-50">
                    Beranda
                </a>
                <a href="{{ route('about') }}"
                   class="rounded-lg px-3 py-2 text-sm font-semibold text-blue-600 transition hover:bg-blue-50">
                    Tentang
                </a>

                @guest
                    <a href="{{ route('login') }}"
                       class="rounded-lg bg-blue-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-blue-700">
                        Login
                    </a>
                @else
                    <a href="{{ route('dashboard') }}"
                       class="rounded-lg px-3 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-100">
                        Dashboard
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="rounded-lg border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                            Logout
                        </button>
                    </form>
                @endguest
            </nav>

            {{-- Tombol Hamburger Mobile --}}
            <button
                id="menu-toggle"
                type="button"
                class="inline-flex h-10 w-10 items-center justify-center rounded-lg text-slate-700 transition hover:bg-slate-100 focus:outline-none focus:ring-2 focus:ring-blue-500 md:hidden"
                aria-label="Buka menu navigasi"
                aria-controls="mobile-menu"
                aria-expanded="false"
            >
                <svg id="menu-open-icon"
                     xmlns="http://www.w3.org/2000/svg"
                     class="h-6 w-6"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M4 6h16M4 12h16M4 18h16" />
                </svg>

                <svg id="menu-close-icon"
                     xmlns="http://www.w3.org/2000/svg"
                     class="hidden h-6 w-6"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

        </div>

        {{-- Navigasi Mobile --}}
        <nav id="mobile-menu"
             class="hidden border-t border-slate-200 bg-white px-5 py-4 md:hidden">

            <div class="mx-auto flex max-w-7xl flex-col gap-2">

                <a href="{{ route('home') }}"
                   class="rounded-lg px-4 py-3 text-sm font-semibold text-blue-600 transition hover:bg-blue-50">
                    Beranda
                </a>
                <a href="{{ route('about') }}"
                   class="rounded-lg px-4 py-3 text-sm font-semibold text-blue-600 transition hover:bg-blue-50">
                    Tentang
                </a>

                @guest
                    <a href="{{ route('login') }}"
                       class="rounded-lg px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                        Login
                    </a>
                @else
                    <a href="{{ route('dashboard') }}"
                       class="rounded-lg px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                        Dashboard
                    </a>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="w-full rounded-lg px-4 py-3 text-left text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                            Logout
                        </button>
                    </form>
                @endguest

            </div>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="mt-16 border-t border-slate-200 bg-slate-50">
        <div class="mx-auto max-w-7xl px-5 py-8 text-center sm:px-8">
            <p class="text-sm text-slate-500">
                &copy; {{ date('Y') }} Blog Laravel.
                Tempat menemukan ide dan perspektif baru.
            </p>
        </div>
    </footer>

    {{-- JavaScript Hamburger --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggle = document.getElementById('menu-toggle');
            const menu = document.getElementById('mobile-menu');
            const openIcon = document.getElementById('menu-open-icon');
            const closeIcon = document.getElementById('menu-close-icon');

            toggle.addEventListener('click', function () {
                const isExpanded = toggle.getAttribute('aria-expanded') === 'true';

                toggle.setAttribute('aria-expanded', String(!isExpanded));
                toggle.setAttribute(
                    'aria-label',
                    isExpanded ? 'Buka menu navigasi' : 'Tutup menu navigasi'
                );

                menu.classList.toggle('hidden');
                openIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
            });
        });
    </script>

</body>
</html>