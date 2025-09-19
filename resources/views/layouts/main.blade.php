<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title }}</title>


    @vite('resources/css/app.css')
    @vite('resources/js/app.js')

    <link rel="stylesheet" href="{{ asset('css/style/style.css') }}">

    <script src="https://unpkg.com/feather-icons"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
</head>

<body class="font-[Poppins] bg-[#1e1e1e] h-[4000px]">
    <div class="mb-19">
        <div class="container mx-auto">
            <nav class="bg-[#b6895b] p-4 fixed top-0 left-0 right-0 z-50 shadow-lg">
                <div class="flex items-center justify-between max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center space-x-8">
                        <a href="{{ route('home') }}"
                            class="flex items-center text-3xl font-bold text-white hover:text-amber-100 transition-colors duration-300">
                            ☕#89<span
                                class="text-[#854836] hover:text-[#6a3a2b] transition-colors duration-300">Coffe</span>
                        </a>

                        <div class="md:flex items-center">
                            <div id="mobile-menu"
                                class="hidden md:block absolute bg-[#b6895b] shadow-lg rounded-lg scale-95 w-[50%] top-full right-0 md:static z-40 md:rounded-none md:shadow-none md:bg-transparent md:max-w-full transition-all duration-300 rounded-lg">
                                <ul class="block lg:flex lg:font-semibold space-x-2">
                                    <li>
                                        <a href="{{ route('home') }}"
                                            class="{{ request()->is('/') ? 'bg-amber-700 text-white' : 'text-white hover:bg-amber-600' }} block px-3 py-2 rounded-md text-base font-medium transition-colors duration-300">
                                            Home
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('about') }}"
                                            class="{{ request()->is('about') ? 'bg-amber-700 text-white' : 'text-white hover:bg-amber-600' }} block px-3 py-2 rounded-md text-base font-medium transition-colors duration-300">
                                            About
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('products') }}"
                                            class="{{ request()->is('products') ? 'bg-amber-700 text-white' : 'text-white hover:bg-amber-600' }} block px-3 py-2 rounded-md text-base font-medium transition-colors duration-300">
                                            Menu
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('contact') }}"
                                            class="{{ request()->is('contact') ? 'bg-amber-700 text-white' : 'text-white hover:bg-amber-600' }} block px-3 py-2 rounded-md text-base font-medium transition-colors duration-300">
                                            Contact
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center">
                        <div class="relative md:block">
                            <form action="/products">
                                <input id="search-input" value="{{ request('search') }}" name="search" type="text"
                                    placeholder="Search Produk..."
                                    class="hidden absolute top-11 -right-28 w-[300px] md:static md:block bg-white/20 backdrop-blur-sm border border-amber-200/30 rounded-full py-1 px-4 md:pr-10 text-white placeholder-amber-100/70 focus:outline-none focus:ring-2 focus:ring-amber-200 focus:border-transparent transition-all duration-300 w-48 lg:w-64">
                            </form>
                            <i id="search-btn" data-feather="search"
                                class="hover:cursor-pointer w-6 h-6 md:w-5 md:h-5 absolute right-3 top-1/2 transform -translate-y-1/2 text-amber-100 hover:text-white">
                            </i>
                        </div>

                        <div class="flex items-center">
                            <a href="{{ route('cart.index') }}"
                                class="{{ request()->routeIs('cart.index') ? 'text-black font-semibold' : 'text-white hover:text-amber-100' }} relative p-2 transition-colors duration-300">
                                <i data-feather="shopping-cart" class="w-6 h-6"></i>
                                <span
                                    class="absolute -top-1 -right-1 bg-[#854836] text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                    {{ $cartCount }}
                                </span>
                            </a>

                            <ul class="relative">
                                @auth('customer')
                                    <div class="flex items-center space-x-2">
                                        <button id="profileDropdownButton"
                                            class="flex items-center space-x-2 focus:outline-none">
                                            <i data-feather="user" class="w-6 h-6 text-white hover:text-amber-100"></i>
                                            <p class="font-semibold text-white hover:text-amber-100">
                                                {{ auth('customer')->user()->name }}
                                            </p>
                                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7" />
                                            </svg>
                                        </button>

                                        <div id="profileDropdownMenu"
                                            class="absolute -right-8 top-7 mt-2 w-40 bg-white rounded-lg shadow-lg hidden z-50">
                                            <form method="POST" action="/logout">
                                                @csrf
                                                <button type="submit"
                                                    class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-amber-100 rounded-t-lg">
                                                    Logout
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <a href="/login" class="font-semibold ml-7 text-xl">Login</a>
                                    </div>
                                @endauth
                            </ul>

                            <button id="mobile-menu-button"
                                class="hover:cursor-pointer md:hidden text-white focus:outline-none">
                                <i id="hamburger-menu" data-feather="menu" class="w-6 h-6"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </nav>
        </div>

    </div>
    @yield('content')

    <script>
        feather.replace();
    </script>

    <script src="{{ asset('js/alert/myJavaScript.js') }}"></script>
</body>

</html>
