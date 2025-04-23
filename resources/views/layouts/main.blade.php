<!doctype html>
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>


    @vite('resources/css/app.css')

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
                            Coffe<span
                                class="text-[#854836] hover:text-[#6a3a2b] transition-colors duration-300">89</span>
                        </a>

                        <div class="hidden md:flex items-center space-x-6">
                            <a href="{{ route('home') }}"
                                class="{{ request()->is('/') ? 'text-black font-semibold' : 'text-white hover:text-amber-100' }} text-lg transition-colors duration-300">
                                Home
                            </a>
                            <a href="{{ route('about') }}"
                                class="{{ request()->is('about') ? 'text-black font-semibold' : 'text-white hover:text-amber-100' }} text-lg transition-colors duration-300">
                                About
                            </a>
                            <a href="{{ route('products') }}"
                                class="{{ request()->is('products') ? 'text-black font-semibold' : 'text-white hover:text-amber-100' }} text-lg transition-colors duration-300">
                                Menu
                            </a>
                            <a href="{{ route('contact') }}"
                                class="{{ request()->is('contact') ? 'text-black font-semibold' : 'text-white hover:text-amber-100' }} text-lg transition-colors duration-300">
                                Contact
                            </a>
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="relative hidden md:block">
                            <input type="text" placeholder="Search..."
                                class="bg-white/20 backdrop-blur-sm border border-amber-200/30 rounded-full py-1 px-4 pr-10 text-white placeholder-amber-100/70 focus:outline-none focus:ring-2 focus:ring-amber-200 focus:border-transparent transition-all duration-300 w-48 lg:w-64">
                            <button
                                class="absolute right-3 top-1/2 transform -translate-y-1/2 text-amber-100 hover:text-white">
                                <i data-feather="search" class="w-5 h-5"></i>
                            </button>
                        </div>

                        <div class="flex items-center space-x-4">
                            <a href="{{ route('cart.index') }}"
                                class="{{ request()->routeIs('cart.index') ? 'text-black font-semibold' : 'text-white hover:text-amber-100' }} relative p-2 transition-colors duration-300">
                                <i data-feather="shopping-cart" class="w-6 h-6"></i>
                                <span
                                    class="absolute -top-1 -right-1 bg-[#854836] text-white text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                                    0
                                </span>
                            </a>

                            <a href="#"
                                class="p-2 text-white hover:text-amber-100 transition-colors duration-300">
                                <i data-feather="user" class="w-6 h-6"></i>
                            </a>

                            <button id="mobile-menu-button" class="md:hidden text-white focus:outline-none">
                                <i id="hamburger-menu" data-feather="menu" class="w-6 h-6"></i>
                            </button>

                            <div id="mobile-menu"
                                class="md:hidden invisible opacity-0 scale-95 w-[50%] absolute top-full right-0 bg-[#b6895b] shadow-lg z-40 transition-all duration-300 transform origin-top-right rounded-lg">
                                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                                    <a href="{{ route('home') }}"
                                        class="{{ request()->is('/') ? 'bg-amber-700 text-white' : 'text-white hover:bg-amber-600' }} block px-3 py-2 rounded-md text-base font-medium transition-colors duration-300">
                                        Home
                                    </a>
                                    <a href="{{ route('about') }}"
                                        class="{{ request()->is('about') ? 'bg-amber-700 text-white' : 'text-white hover:bg-amber-600' }} block px-3 py-2 rounded-md text-base font-medium transition-colors duration-300">
                                        About
                                    </a>
                                    <a href="{{ route('products') }}"
                                        class="{{ request()->is('products') ? 'bg-amber-700 text-white' : 'text-white hover:bg-amber-600' }} block px-3 py-2 rounded-md text-base font-medium transition-colors duration-300">
                                        Menu
                                    </a>
                                    <a href="{{ route('contact') }}"
                                        class="{{ request()->is('contact') ? 'bg-amber-700 text-white' : 'text-white hover:bg-amber-600' }} block px-3 py-2 rounded-md text-base font-medium transition-colors duration-300">
                                        Contact
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="md:hidden mt-3 px-4">
                    <div class="relative">
                        <input type="text" placeholder="Search..."
                            class="w-full bg-white/20 backdrop-blur-sm border border-amber-200/30 rounded-full py-1 px-4 pr-10 text-white placeholder-amber-100/70 focus:outline-none focus:ring-2 focus:ring-amber-200 focus:border-transparent">
                        <button class="absolute right-3 top-1/2 transform -translate-y-1/2 text-amber-100">
                            <i data-feather="search" class="w-5 h-5"></i>
                        </button>
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
