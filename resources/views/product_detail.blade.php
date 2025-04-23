@extends('layouts.main')

@section('content')
    <div class="mx-4 sm:mx-8 lg:mx-16 mt-20 text-white">
        <nav class="mb-8">
            <ol class="flex items-center space-x-2 text-sm text-gray-300">
                <li>
                    <a href="{{ route('home') }}" class="hover:text-amber-200 transition-colors">Home</a>
                </li>
                <li>
                    <span class="text-gray-500">/</span>
                </li>
                <li>
                    <a href="{{ route('products') }}" class="hover:text-amber-200 transition-colors">Menu</a>
                </li>
                <li>
                    <span class="text-gray-500">/</span>
                </li>
                <li class="text-amber-200" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            <div class="top-0 sticky lg:top-24">
                <div class="bg-gray-800 rounded-xl shadow-xl overflow-hidden">
                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                        class="w-full h-auto object-cover transition-transform duration-500 hover:scale-105 cursor-zoom-in"
                        id="main-product-image">
                </div>
                <div class="flex mt-4 space-x-3" id="thumbnail-container">
                </div>
            </div>

            <div class="relative">
                <div class="contents">
                    <div class="sticky top-30 z-10 bg-gray-900/95 backdrop-blur-sm py-3 px-4 -mx-4 mb-4 lg:top-16">
                        <h1 class="text-2xl font-bold line-clamp-1 text-white">{{ $product->name }}</h1>
                        <div class="flex items-center justify-between mt-1">
                            <p class="text-xl text-amber-200 font-semibold">
                                Rp {{ $product->price }}
                            </p>
                            <div class="flex items-center">
                                <div class="flex text-amber-300 mr-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4 @if ($i <= 4) fill-current @else fill-none @endif"
                                            viewBox="0 0 20 20" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                    @endfor
                                </div>
                                <span class="text-gray-300 text-xs">(24 reviews mobiles)</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-800/50 p-4 rounded-lg lg:bg-transparent lg:p-0">

                    <div class="mb-8">
                        <p class="text-lg text-white">
                            Availability:
                            <span
                                class="font-semibold @if ($product->stock > 0) text-green-400 @else text-red-400 @endif">
                                @if ($product->stock > 0)
                                    In Stock ({{ $product->stock }} available)
                                @else
                                    Out of Stock
                                @endif
                            </span>
                        </p>
                    </div>

                    <form action="{{ route('cart.add') }}" method="POST" class="mb-6">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <div class="flex items-end mb-8">
                            <div class="mr-4">
                                <label for="quantity" class="block text-sm font-medium text-gray-300 mb-1">Quantity</label>
                                <div class="flex border border-gray-600 rounded-lg overflow-hidden">
                                    <button type="button" class="px-3 py-2 bg-gray-700 text-white decrement-qty">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M20 12H4" />
                                        </svg>
                                    </button>
                                    <input type="number" id="quantity" name="quantity" min="1" value="1"
                                        max="{{ $product->stock }}"
                                        class="w-16 text-center bg-gray-800 text-white py-2 px-0 border-0 focus:ring-2 focus:ring-amber-300">
                                    <button type="button" class="px-3 py-2 bg-gray-700 text-white increment-qty">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 4v16m8-8H4" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <button type="submit"
                                class="flex-1 bg-amber-400 hover:bg-amber-500 transition-colors duration-300 py-3 px-6 rounded-lg font-bold text-gray-900 flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                                Add to Cart
                            </button>
                        </div>
                    </form>

                    <form action="/" method="POST" class="mb-10">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1" id="buy-now-quantity">
                        <button type="submit"
                            class="w-full bg-transparent hover:bg-amber-400 border-2 border-amber-400 text-amber-400 hover:text-gray-900 transition-colors duration-300 py-3 px-6 rounded-lg font-bold flex items-center justify-center">
                            BUY NOW
                        </button>
                    </form>

                    <div class="border-t border-gray-700 pt-8">
                        <h3 class="text-xl font-bold mb-4 text-white">Product Details</h3>
                        <div class="prose prose-invert max-w-none text-gray-300">
                            {{ $product->deskripsi_panjang }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
