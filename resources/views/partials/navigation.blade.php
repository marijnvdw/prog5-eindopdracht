<nav class="bg-green-500 p-6 flex items-center justify-between flex-wrap">
    <!-- Logo or Icon -->
    <a href="{{ route('locations.index') }}">
        <div class="flex items-center flex-shrink-0 text-white mr-6">
            <svg width="50" height="50" viewBox="0 0 150 200">
                <!-- Map Marker -->
                <path d="M75 0C47.6 0 25 22.6 25 50C25 90 75 150 75 150C75 150 125 90 125 50C125 22.6 102.4 0 75 0Z"
                      fill="#FF6347"/>
                <!-- Eye Outline -->
                <ellipse cx="75" cy="55" rx="30" ry="20" fill="#FFFFFF"/>
                <!-- Pupil -->
                <circle cx="75" cy="55" r="10" fill="#000000"/>
            </svg>
            <span class="font-semibold text-xl tracking-tight ml-3">Location Finder</span>
        </div>
    </a>
    <!-- Mobile Menu Button -->
    <div class="block lg:hidden">
        <button
            class="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
            <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <title>Menu</title>
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
            </svg>
        </button>
    </div>

    <!-- Navigation Links -->
    <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
        <div class="text-sm lg:flex-grow">
            @if (Route::has('login'))
                @auth
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->is('dashboard')"
                                class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-gray-300 mr-4">
                        Dashboard
                    </x-nav-link>
                    <x-nav-link href="{{ route('locations.create') }}" :active="request()->is('locations.create')"
                                class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-gray-300 mr-4">Create
                    </x-nav-link>
                    @if (Auth::user()->admin === 1)
                        <x-nav-link href="{{ route('admin') }}" :active="request()->is('admin')"
                                    class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-gray-300 mr-4">Admin page
                        </x-nav-link>                    @endif

                @else
                    <x-nav-link href="{{ route('login') }}" :active="request()->is('login')"
                                class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-gray-300 mr-4">
                        Login
                    </x-nav-link>
                    <x-nav-link href="{{ route('register') }}" :active="request()->is('register')"
                                class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-gray-300">
                        Register
                    </x-nav-link>
                @endauth
            @endif
        </div>

        <!-- Authenticated User Info -->
        <div class="mt-4 lg:mt-0">
            @auth
                <p class="text-white">{{ Auth::user()->name }} - {{ Auth::user()->admin === 1 ? 'Admin' : 'User' }}</p>
            @endauth
        </div>
    </div>
</nav>
