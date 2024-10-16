{{--<header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">--}}
{{--    @if (Route::has('login'))--}}
{{--        <nav class="-mx-3 flex flex-1 justify-end">--}}
{{--            @auth--}}
{{--                <a--}}
{{--                    href="{{ url('/dashboard') }}"--}}
{{--                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"--}}
{{--                >--}}
{{--                    Dashboard--}}
{{--                </a>--}}
{{--            @else--}}
{{--                <a--}}
{{--                    href="{{ route('login') }}"--}}
{{--                    class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"--}}
{{--                >--}}
{{--                    Log in--}}
{{--                </a>--}}

{{--                @if (Route::has('register'))--}}
{{--                    <a--}}
{{--                        href="{{ route('register') }}"--}}
{{--                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"--}}
{{--                    >--}}
{{--                        Register--}}
{{--                    </a>--}}
{{--                @endif--}}
{{--            @endauth--}}
{{--        </nav>--}}
{{--    @endif--}}
{{--</header>--}}



{{--<h1>about page</h1>--}}



<x-layout title="About">
    <h1>Hello from the About Page.</h1>

    @if (Route::has('login'))
        @auth
            <h2>Logged in</h2>
        @else
            @if (Route::has('register'))
                <h2>Not logged in</h2>
            @endif
        @endauth
    @endif
</x-layout>
