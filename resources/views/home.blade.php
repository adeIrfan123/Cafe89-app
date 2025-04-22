@extends('layouts.main')

@section('content')
    <div class="relative rounded-2xl h-[70vh] flex items-center px-[4%]">
        <!-- Banner Container -->
        <div class="slider flex rounded-2xl overflow-x-auto snap-x snap-mandatory w-full gap-4 scrollbar-hide">
            @foreach ($banners as $banner)
                <div class="slide snap-start flex-shrink-0 w-full h-full relative">
                    <!-- Banner Image -->
                    <img src="{{ Storage::url($banner->image) }}" alt="{{ $banner->title }}"
                        class="w-full h-[600px] lg:h-[900px] object-cover rounded-2xl">

                    <!-- Overlay Content -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-8">
                        <div class="text-white max-w-2xl mb-10 ml-5">
                            <h2 class="text-3xl md:text-5xl font-bold mb-2">{{ $banner->title ?? 'Special Offer' }}</h2>
                            <p class="text-lg">{{ $banner->description ?? 'Discover our premium selection' }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Navigation Arrows -->
        <div class="hidden lg:block">
            <button id="prev"
                class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 p-3 rounded-full shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button id="next"
                class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-gray-800 p-3 rounded-full shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>

        <!-- Pagination Dots -->
        <div class=" absolute bottom-0 lg:bottom-10 left-1/2 transform -translate-x-1/2 flex gap-2">
            @foreach ($banners as $index => $banner)
                <span
                    class="pagination-dots w-3 h-3 rounded-full bg-white/60 hover:bg-white transition-all cursor-pointer"></span>
            @endforeach
        </div>
    </div>
    <div class="text-white mx-auto pt-20 pb-52 bg-amber-900">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="text-center mb-16 lg:pt-[150px]">
                <h2 class="font-bold text-4xl md:text-6xl mb-4">Menu Kami</h2>
                <p class="text-lg md:text-xl max-w-2xl mx-auto">Discover our delicious selection of premium coffee and
                    beverages</p>
            </div>

            <!-- Categories Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8 px-10">
                @foreach ($categories as $category)
                    <div
                        class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300">
                        <!-- Category Image -->
                        <div class="h-64 overflow-hidden">
                            <img src="{{ Storage::url($category->image) }}" alt="{{ $category->category }}"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                onerror="this.src='{{ asset('images/placeholder-food.jpg') }}'">
                        </div>

                        <!-- Category Content -->
                        <div class="p-6 bg-amber-800">
                            <a href="{{ route('products') }}#kategori-{{ $category->id }}"
                                class="text-center block text-2xl font-bold mb-3 hover:text-amber-200 transition-colors">
                                {{ $category->category }}
                            </a>
                            <p class="text-center text-amber-100">
                                {{ $category->description ?? 'Lorem ipsum dolor sit amet consectetur adipisicing elit.' }}
                            </p>

                            <!-- View Button -->
                            <div class="mt-6 text-center">
                                <a href="{{ route('products') }}#kategori-{{ $category->id }}"
                                    class="inline-block px-6 py-2 bg-amber-600 hover:bg-amber-500 rounded-full text-sm font-semibold transition-colors">
                                    View Products
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
    {{-- About --}}
    <div class="w-full max-w-[1800px] bg-amber-200 mx-auto pt-24 pb-16 md:pt-40 px-4 sm:px-8 rounded-2xl relative -top-14">
        <h2 class="text-center font-bold text-4xl md:text-5xl mb-12">
            <span class="text-amber-800">About</span>
            <span class="text-amber-600">Us</span>
        </h2>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Image Section -->
            <div class="lg:w-1/2 px-4 lg:pl-12 lg:pr-0 flex justify-center">
                <div class="w-full max-w-[800px] h-auto aspect-[4/3] rounded-xl overflow-hidden shadow-lg">
                    <img src="https://heydaycanning.com/cdn/shop/files/yes-we-can-v2.jpg?crop=center&v=1664822967&width=1205"
                        alt="Coffee Shop Interior" class="w-full h-full object-cover">
                </div>
            </div>

            <!-- Text Section -->
            <div class="lg:w-1/2 px-4 lg:pr-12 lg:pl-0 flex items-center justify-center">
                <div class="w-full max-w-md text-center lg:text-left">
                    <h3 class="font-bold text-3xl md:text-4xl mb-6 text-amber-900">
                        Coffee<span class="text-amber-700">89</span>
                    </h3>
                    <p class="text-amber-900 text-lg leading-relaxed mb-8">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi natus voluptatem, quas molestiae quis
                        earum mollitia dicta consequuntur laborum provident!
                    </p>
                    <button
                        class="px-8 py-3 bg-amber-700 text-white rounded-lg font-medium hover:bg-amber-800 transition-colors duration-300">
                        Our Story
                    </button>
                </div>
            </div>
        </div>
        <div class="flex flex-col lg:flex-row gap-8 mt-12">

            <!-- Text Section -->
            <div class="lg:w-1/2 px-4 lg:pr-12 lg:pl-0 flex items-center justify-center order-2 lg:order-1">
                <div class="w-full max-w-md text-center lg:text-left">
                    <h3 class="font-bold text-3xl md:text-4xl mb-6 text-amber-900">
                        Coffee<span class="text-amber-700">89</span>
                    </h3>
                    <p class="text-amber-900 text-lg leading-relaxed mb-8">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi natus voluptatem, quas molestiae quis
                        earum mollitia dicta consequuntur laborum provident!
                    </p>
                    <button
                        class="px-8 py-3 bg-amber-700 text-white rounded-lg font-medium hover:bg-amber-800 transition-colors duration-300">
                        Our Story
                    </button>
                </div>
            </div>

            <!-- Image Section -->
            <div class="lg:w-1/2 px-4 lg:pl-12 lg:pr-0 flex justify-center order-1 lg:order-2">
                <div class="w-full max-w-[800px] h-auto aspect-[4/3] rounded-xl overflow-hidden shadow-lg">
                    <img src="https://heydaycanning.com/cdn/shop/files/yes-we-can-v2.jpg?crop=center&v=1664822967&width=1205"
                        alt="Coffee Shop Interior" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </div>

    {{-- Memories Section --}}
    <div class="w-full bg-amber-200 py-24 px-4 sm:px-8 rounded-2xl">
        <div class="max-w-[1800px] mx-auto">
            <h2 class="text-center text-4xl md:text-5xl font-bold text-amber-800 mb-4">Sweet <span
                    class="text-amber-600">Memories</span></h2>
            <p class="text-center text-amber-900 text-lg max-w-2xl mx-auto mb-12">Moments shared by our beloved customers
            </p>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
                <!-- Memory 1 - Large with Quote -->
                <div class="memory-card md:col-span-2 md:row-span-2 relative group overflow-hidden rounded-xl shadow-lg">
                    <img src="https://images.unsplash.com/photo-1517701550927-30cf4ba1dba5?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                        alt="Happy customers"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent flex items-end p-6 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        <div
                            class="text-white transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">
                            <p class="text-lg italic mb-3">"The best coffee experience in town! Love the atmosphere."</p>
                            <p class="font-semibold">- Sarah & Team</p>
                        </div>
                    </div>
                </div>

                <!-- Memory 2 - Regular -->
                <div class="memory-card relative group overflow-hidden rounded-xl shadow-lg">
                    <img src="https://images.unsplash.com/photo-1521012012373-6a85bade18da?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                        alt="Coffee art"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div
                        class="absolute inset-0 bg-black/30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        <p class="text-white text-center px-4 font-medium">"Latte art that brightens my day"</p>
                    </div>
                </div>

                <!-- Memory 3 - Regular with Poem -->
                <div class="memory-card relative group overflow-hidden rounded-xl shadow-lg">
                    <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                        alt="Coffee cup"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div
                        class="absolute inset-0 bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        <div class="text-white text-center px-4">
                            <p class="italic text-sm">"A cup of warmth,<br>A moment of peace,<br>In every sip,<br>My
                                worries cease."</p>
                        </div>
                    </div>
                </div>

                <!-- Memory 4 - Regular -->
                <div class="memory-card relative group overflow-hidden rounded-xl shadow-lg">
                    <img src="https://images.unsplash.com/photo-1509042239860-f550ce710b93?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                        alt="Coffee break"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div
                        class="absolute inset-0 bg-black/30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        <p class="text-white text-center px-4 font-medium">"My favorite work-from-cafe spot"</p>
                    </div>
                </div>

                <!-- Memory 5 - Regular -->
                <div class="memory-card relative group overflow-hidden rounded-xl shadow-lg">
                    <img src="https://images.unsplash.com/photo-1485182708500-e8f1f318ba72?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80"
                        alt="Friends gathering"
                        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div
                        class="absolute inset-0 bg-black/30 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                        <p class="text-white text-center px-4 font-medium">"Where friends become family"</p>
                    </div>
                </div>
            </div>

            <!-- CTA -->
            <div class="text-center mt-16">
                <p class="text-amber-900 text-lg mb-6">Share your Coffee89 moments with us!</p>
                <button id="shareMemoryBtn"
                    class="px-8 py-3 bg-amber-700 hover:bg-amber-800 text-white rounded-lg font-medium transition-colors duration-300">
                    Share Your Memory
                </button>
            </div>
        </div>
    </div>
@endsection
