@extends('layouts.main')

@section('content')
    <div class="mt-30 px-4 sm:px-6 lg:px-8 py-12">
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-[#b6895b] mb-6 animate-fadeIn">Our Menu</h1>
            <p class="text-lg text-gray-300 max-w-3xl mx-auto">Discover our exquisite selection of coffee and delicacies
                crafted with passion</p>
        </div>

        <div class="sticky top-20 bg-[#854836] z-10 mb-8 py-3 shadow-md lg:top-20 lg:py-3">
            <div class="flex overflow-x-auto space-x-6 px-4 hide-scrollbar">
                @foreach ($categories as $category)
                    <a href="#kategori-{{ $category->id }}"
                        class="whitespace-nowrap px-4 py-2 rounded-full text-white hover:bg-[#b6895b] transition-colors duration-300 category-nav-link">
                        {{ $category->category }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="max-w-7xl mx-auto">
            @if ($searchQuery && $searchedProducts->count())
                <section id="search-results" class="mb-20 scroll-mt-24">
                    <h2
                        class="text-3xl font-bold text-[#b6895b] mb-8 pt-[97px] lg:pt-[70px] pb-2 border-b-2 border-[#b6895b]">
                        Search Results for "{{ $searchQuery }}"
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach ($searchedProducts as $product)
                            @include('partials.product-card', ['product' => $product])
                        @endforeach
                    </div>
                </section>
            @elseif($searchQuery)
                <p class="text-center text-4xl text-gray-400 mb-12">Produk "{{ $searchQuery }}" tidak ditemukan</p>
            @endif

            @foreach ($categories as $category)
                <section id="kategori-{{ $category->id }}" class="category-section mb-20 scroll-mt-24 ">
                    <h2
                        class="text-3xl font-bold text-[#b6895b] mb-8 pt-[97px] lg:pt-[70px] pb-2 border-b-2 border-[#b6895b]">
                        {{ $category->category }}
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach ($allProducts->where('category_id', $category->id) as $product)
                            @include('partials.product-card', ['product' => $product])
                        @endforeach
                    </div>
                </section>
            @endforeach
        </div>

        <button id="back-to-top"
            class="fixed bottom-8 right-8 bg-[#b6895b] text-white p-3 rounded-full shadow-lg opacity-0 invisible transition-all duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
            </svg>
        </button>
    </div>
@endsection
