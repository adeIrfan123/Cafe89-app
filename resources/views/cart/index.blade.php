@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if (session('success'))
            <div id="flash-message"
                class="bg-green-600 text-white px-6 py-3 rounded-lg mb-8 flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button onclick="document.getElementById('flash-message').remove()" class="text-white hover:text-gray-200">
                    ✕
                </button>
            </div>
        @endif

        @if ($cartItems->count() > 0)
            <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden mb-8">
                <div class="hidden md:grid grid-cols-12 bg-gray-700 text-gray-300 p-4 font-medium">
                    <div class="col-span-5">Produk</div>
                    <div class="col-span-2 text-right">Harga</div>
                    <div class="col-span-2 text-center">Jumlah</div>
                    <div class="col-span-2 text-right">Subtotal</div>
                    <div class="col-span-1 text-center">Aksi</div>
                </div>

                <div class="divide-y divide-gray-700">
                    @foreach ($cartItems as $item)
                        @php
                            $price = (int) str_replace('.', '', $item->product->price);
                            $subtotal = $price * $item->quantity;
                        @endphp
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 p-4 items-center">
                            <div class="col-span-5 flex items-center space-x-4">
                                <img src="{{ Storage::url($item->product->image) }}" alt="{{ $item->product->name }}"
                                    class="w-20 h-20 object-cover rounded-lg">
                                <div>
                                    <a href="{{ route('product.show', $item->product->slug) }}"
                                        class="text-white hover:text-amber-400 font-medium text-lg">
                                        {{ $item->product->name }}
                                    </a>
                                </div>
                            </div>

                            <div class="col-span-2 text-right text-white">
                                Rp {{ number_format($price, 0, ',', '.') }}
                            </div>

                            <div class="col-span-2 text-center text-white flex justify-center items-center space-x-2">
                                {{-- Kurangi --}}
                                <form action="{{ route('cart.item.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="quantity" value="{{ max(1, $item->quantity - 1) }}">
                                    <button type="submit"
                                        class="px-2 py-1 bg-gray-700 rounded hover:bg-gray-600">-</button>
                                </form>

                                <span class="mx-2">{{ $item->quantity }}</span>

                                {{-- Tambah --}}
                                <form action="{{ route('cart.item.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                    <button type="submit"
                                        class="px-2 py-1 bg-gray-700 rounded hover:bg-gray-600">+</button>
                                </form>
                            </div>

                            <div class="col-span-2 text-right text-white">
                                Rp {{ number_format($subtotal, 0, ',', '.') }}
                            </div>

                            <div class="col-span-1 flex justify-center">
                                <form action="{{ route('cart.item.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-400 hover:text-red-600">🗑️</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Total & Checkout --}}
            <div class="bg-gray-800 rounded-xl shadow-lg p-6">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <h3 class="text-xl font-bold text-white mb-4 md:mb-0">
                        Total: Rp {{ number_format($total, 0, ',', '.') }}
                    </h3>

                    <div class="flex space-x-4">
                        <a href="{{ route('products') }}"
                            class="px-6 py-3 border border-amber-400 text-amber-400 rounded-lg font-medium hover:bg-amber-400 hover:text-gray-900">
                            Lanjut Belanja
                        </a>
                        <form action="" method="POST">
                            @csrf
                            <button type="submit"
                                class="px-8 py-3 bg-amber-400 text-gray-900 rounded-lg font-bold hover:bg-amber-500">
                                Checkout Sekarang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            {{-- Empty Cart Message --}}
            <div class="text-center py-16">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mx-auto text-gray-500 mb-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h3 class="text-2xl font-medium text-gray-300 mb-4">Keranjang kamu kosong</h3>
                <p class="text-gray-500 mb-6">Mulai belanja dan tambahkan produk ke keranjang</p>
                <a href="{{ route('products') }}"
                    class="inline-block px-6 py-3 bg-amber-400 text-gray-900 rounded-lg font-medium hover:bg-amber-500">
                    Lihat Menu
                </a>
            </div>
        @endif
    </div>
@endsection
