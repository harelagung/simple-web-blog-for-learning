<div>
    <nav class="bg-gray-800/50">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <div class="shrink-0">
                        <svg class="h-8 w-8 text-indigo-500" fill="currentColor" viewBox="0 0 54 33">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M27 0c-7.2 0-11.7 3.6-13.5 10.8 2.7-3.6 5.85-4.95 9.45-4.05 2.054.513 3.522 2.004 5.147 3.653C30.744 13.09 33.808 16.2 40.5 16.2c7.2 0 11.7-3.6 13.5-10.8-2.7 3.6-5.85 4.95-9.45 4.05-2.054-.513-3.522-2.004-5.147-3.653C36.756 3.11 33.692 0 27 0zM13.5 16.2C6.3 16.2 1.8 19.8 0 27c2.7-3.6 5.85-4.95 9.45-4.05 2.054.514 3.522 2.004 5.147 3.653C17.244 29.29 20.308 32.4 27 32.4c7.2 0 11.7-3.6 13.5-10.8-2.7 3.6-5.85 4.95-9.45 4.05-2.054-.513-3.522-2.004-5.147-3.653C23.256 19.31 20.192 16.2 13.5 16.2z" />
                        </svg>
                    </div>
                    <div class="hidden md:block">
                        <div class="ml-10 flex items-baseline space-x-4">
                            <x-my-nav-link href='/' :current="request()->is('/')">Home</x-my-nav-link>
                            <x-my-nav-link href='/posts' :current="request()->is('posts')">Blog</x-my-nav-link>
                            <x-my-nav-link href='/about' :current="request()->is('about')">About</x-my-nav-link>
                            <x-my-nav-link href='/contact' :current="request()->is('contact')">Contact</x-my-nav-link>
                        </div>
                    </div>
                </div>
                <div class="hidden md:block">
                    <div class="ml-4 flex items-center md:ml-6">
                        <!-- Profile dropdown -->
                        <div class="flex gap-6 ml-3" x-data="{ profileOpen: false }">
                            @if (Auth::check())
                                <button @click="profileOpen = !profileOpen" type="button"
                                    class="relative flex max-w-xs items-center rounded-full focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 cursor-pointer hover:text-white hover:underline">
                                    <span class="absolute -inset-1.5"></span>
                                    <span class="sr-only">Open user menu</span>
                                    <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('img/default-avatar.png') }}"
                                        alt="{{ Auth::user()->name }}"
                                        class="h-8 w-8 rounded-full outline -outline-offset-1 outline-white/10" />
                                    <div class="text-sm text-gray-300 font-medium ml-3">{{ Auth::user()->name }}</div>
                                    {{-- <div class="ms-1 text-gray-300"> --}}
                                    <svg class="fill-current h-4 w-4 text-gray-300" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    {{-- </div> --}}
                                </button>
                            @else
                                <a href="/login" class="text-white text-sm font-medium hover:text-blue-400">Login</a>
                                <span class="text-white font-medium"> | </span>
                                <a href="/register"
                                    class="text-white text-sm font-medium hover:text-blue-400">Register</a>
                            @endif

                            <div x-show="profileOpen" @click.away="profileOpen = false"
                                x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md bg-gray-800 py-1 shadow-lg ring-1 ring-white/10"
                                style="display: none;">
                                <a href="/profile" class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5">Your
                                    profile</a>
                                <a href="/dashboard"
                                    class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5">Dashboard</a>
                                <form method="POST" action="/logout"
                                    class="block px-4 py-2 text-sm text-gray-300 hover:bg-white/5">
                                    @csrf
                                    <button type="submit" class="w-full text-left cursor-pointer">Log
                                        out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="-mr-2 flex md:hidden">
                    <!-- Mobile menu button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" type="button"
                        class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-white/5 hover:text-white focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500">
                        <span class="absolute -inset-0.5"></span>
                        <span class="sr-only">Open main menu</span>
                        <!-- Icon when menu is closed -->
                        <svg x-show="!mobileMenuOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <!-- Icon when menu is open -->
                        <svg x-show="mobileMenuOpen" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" style="display: none;">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile menu -->
        <div x-show="mobileMenuOpen" x-transition:enter="transition ease-out duration-100"
            x-transition:enter-start="transform opacity-0 scale-95"
            x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
            x-transition:leave-start="transform opacity-100 scale-100"
            x-transition:leave-end="transform opacity-0 scale-95" class="md:hidden" style="display: none;">
            <div class="space-y-1 px-2 pt-2 pb-3 sm:px-3">
                <x-my-nav-link class="block" href='/' :current="request()->is('/')">Home</x-my-nav-link>
                <x-my-nav-link class="block" href='/posts' :current="request()->is('posts')">Blog</x-my-nav-link>
                <x-my-nav-link class="block" href='/about' :current="request()->is('about')">About</x-my-nav-link>
                <x-my-nav-link class="block" href='/contact' :current="request()->is('contact')">Contact</x-my-nav-link>
            </div>
            <div class="border-t border-white/10 pt-4 pb-3">
                @if (Auth::check())
                    <div class="flex items-center px-5">
                        <div class="shrink-0">
                            <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('img/default-avatar.png') }}"
                                alt="{{ Auth::user()->name }}"
                                class="h-10 w-10 rounded-full outline -outline-offset-1 outline-white/10" />
                        </div>
                        <div class="ml-3">
                            <div class="text-base font-medium text-white">{{ Auth::user()->name }}</div>
                            <div class="text-sm font-medium text-gray-400">{{ Auth::user()->email }}</div>

                        </div>
                    </div>
                    <div class="mt-3 space-y-1 px-2">
                        <a href="/profile"
                            class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white">Your
                            profile</a>
                        <a href="/dashboard"
                            class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white">Dashboard</a>
                        <form method="POST" action="/logout">
                            @csrf
                            <button type="submit"
                                class="block rounded-md px-3 py-2 text-base font-medium text-gray-400 hover:bg-white/5 hover:text-white w-full text-left">Log
                                out</button>
                        </form>
                    </div>
                @else
                    <div class="px-5 text-center">
                        <a href="/login"
                            class="text-sm font-medium text-gray-100 hover:bg-white/5 hover:text-white mr-8">Login</a>
                        <span class="mx-5 text-white">|</span>
                        <a href="/register"
                            class="text-sm font-medium text-gray-100 hover:bg-white/5 hover:text-white ml-8">Register</a>
                    </div>
                @endif
            </div>
        </div>
    </nav>
</div>
