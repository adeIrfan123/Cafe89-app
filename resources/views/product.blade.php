@extends('layouts.main')

@section('content')
    <div class="mt-30 px-4 sm:px-6 lg:px-8 py-12">
        <!-- Hero Section -->
        <div class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-[#b6895b] mb-6 animate-fadeIn">Our Menu</h1>
            <p class="text-lg text-gray-300 max-w-3xl mx-auto">Discover our exquisite selection of coffee and delicacies
                crafted with passion</p>
        </div>

        <!-- Category Navigation (Sticky) -->
        <div class="sticky top-31 bg-[#854836] z-10 mb-8 py-3 shadow-md lg:top-20 lg:py-3">
            <div class="flex overflow-x-auto space-x-6 px-4 hide-scrollbar">
                @foreach ($categories as $category)
                    <a href="#kategori-{{ $category->id }}"
                        class="whitespace-nowrap px-4 py-2 rounded-full text-white hover:bg-[#b6895b] transition-colors duration-300 category-nav-link">
                        {{ $category->category }}
                    </a>
                @endforeach
            </div>
        </div>

        <!-- Menu Items -->
        <div class="max-w-7xl mx-auto ">
            @foreach ($categories as $category)
                <section id="kategori-{{ $category->id }}" class="mb-20 scroll-mt-24">
                    <h2 class="text-3xl font-bold text-[#b6895b] mb-8 pt-[70px] pb-2 border-b-2 border-[#b6895b]">
                        {{ $category->category }}
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 -mb-14">
                        @foreach ($products->where('category_id', $category->id) as $product)
                            <div
                                class="bg-[#1e1e1e] rounded-lg overflow-hidden shadow-xl hover:shadow-2xl transition-shadow duration-300 h-full flex flex-col">
                                <div class="relative overflow-hidden h-48">
                                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
                                    <span
                                        class="absolute top-3 right-3 bg-[#b6895b] text-white px-3 py-1 rounded-full text-sm font-semibold">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}K
                                    </span>
                                </div>

                                <div class="p-6 flex-grow flex flex-col">
                                    <div class="flex-grow">
                                        <h3
                                            class="text-xl font-bold text-white mb-2 hover:text-[#b6895b] transition-colors duration-300">
                                            <a href="{{ route('product.show', ['slug' => $product->slug]) }}"
                                                class="block">
                                                {{ $product->name }}
                                            </a>
                                        </h3>
                                        <p class="text-gray-300 line-clamp-3 mb-4">
                                            {!! $product->deskripsi_singkat !!}
                                        </p>
                                    </div>

                                    <form action="{{ route('cart.add') }}" method="POST" class="mt-auto">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <button type="submit"
                                            class="w-full bg-[#b6895b] hover:bg-[#854836] text-white font-bold py-3 px-4 rounded-lg transition-colors duration-300 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                            Add to Cart
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endforeach
        </div>

        <!-- Back to Top Button -->
        <button id="back-to-top"
            class="fixed bottom-8 right-8 bg-[#b6895b] text-white p-3 rounded-full shadow-lg opacity-0 invisible transition-all duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
            </svg>
        </button>
    </div>
@endsection
