@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <!-- Flash Message -->
        @if (session('success'))
            <div id="flash-message"
                class="bg-green-600 text-white px-6 py-3 rounded-lg mb-8 flex justify-between items-center transition-all duration-300">
                <span>{{ session('success') }}</span>
                <button onclick="document.getElementById('flash-message').remove()" class="text-white hover:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        @endif

        @if (count($cart) > 0)
            <!-- Cart Items -->
            <div class="bg-gray-800 rounded-xl shadow-lg overflow-hidden mb-8">
                <div class="hidden md:grid grid-cols-12 bg-gray-700 text-gray-300 p-4 font-medium">
                    <div class="col-span-5">Produk</div>
                    <div class="col-span-2 text-right">Harga</div>
                    <div class="col-span-2 text-center">Jumlah</div>
                    <div class="col-span-2 text-right">Subtotal</div>
                    <div class="col-span-1 text-center">Aksi</div>
                </div>

                <div class="divide-y divide-gray-700">
                    @foreach ($cart as $item)
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 p-4 items-center">
                            <!-- Product Image & Name -->
                            <div class="col-span-5 flex items-center space-x-4">
                                <img src="{{ Storage::url($item['image']) }}" alt="{{ $item['name'] }}"
                                    class="w-20 h-20 object-cover rounded-lg">
                                <div>
                                    <a href="{{ route('product.show', ['slug' => $item['slug']]) }}"
                                        class="text-white hover:text-amber-400 font-medium text-lg">
                                        {{ $item['name'] }}
                                    </a>
                                </div>
                            </div>

                            <!-- Price -->
                            <div class="col-span-2 md:text-right">
                                <span class="md:hidden text-gray-400">Harga: </span>
                                <span class="text-white">Rp
                                    {{ number_format(floatval(str_replace('.', '', $item['price'])), 0, ',', '.') }}</span>
                            </div>

                            <!-- Quantity -->
                            <div class="col-span-2 text-white">
                                <div class="flex items-center justify-center space-x-2">
                                    <form action="{{ route('cart.update', $item['id']) }}" method="POST"
                                        class="cart-update-form">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="action" value="decrement">
                                        <button type="submit" class="quantity-btn decrement">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M5 10a1 1 0 011-1h8a1 1 0 110 2H6a1 1 0 01-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>

                                    <span
                                        class="quantity-value px-4 py-1 bg-gray-700 rounded-md">{{ $item['quantity'] }}</span>

                                    <form action="{{ route('cart.update', $item['id']) }}" method="POST"
                                        class="cart-update-form">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="action" value="increment">
                                        <button type="submit" class="quantity-btn increment">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Subtotal -->
                            <div class="col-span-2 md:text-right">
                                <span class="md:hidden text-gray-400">Subtotal: </span>
                                <span class="text-white font-medium">Rp
                                    {{ number_format(floatval(str_replace('.', '', $item['price'])) * $item['quantity'], 0, ',', '.') }}</span>
                            </div>

                            <!-- Remove -->
                            <div class="col-span-1 flex justify-center">
                                <form action="{{ route('cart.remove', $item['id']) }}" method="POST"
                                    class="cart-remove-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:text-red-600 p-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Checkout Section -->
            <div class="bg-gray-800 rounded-xl shadow-lg p-6">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-4 md:mb-0">
                        <h3 class="text-xl font-bold text-white">Total: <span id="cart-total">Rp
                                {{ number_format($total, 0, ',', '.') }}</span>
                        </h3>
                    </div>
                    <div class="flex space-x-4">
                        <a href="{{ route('products') }}"
                            class="px-6 py-3 border border-amber-400 text-amber-400 rounded-lg font-medium hover:bg-amber-400 hover:text-gray-900 transition-colors duration-300">
                            Lanjut Belanja
                        </a>
                        <form action="" method="POST">
                            @csrf
                            <button type="submit"
                                class="px-8 py-3 bg-amber-400 text-gray-900 rounded-lg font-bold hover:bg-amber-500 transition-colors duration-300">
                                Checkout Sekarang
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="text-center py-16">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 mx-auto text-gray-500 mb-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <h3 class="text-2xl font-medium text-gray-300 mb-4">Keranjang kamu kosong</h3>
                <p class="text-gray-500 mb-6">Mulai belanja dan tambahkan produk ke keranjang</p>
                <a href="{{ route('products') }}"
                    class="inline-block px-6 py-3 bg-amber-400 text-gray-900 rounded-lg font-medium hover:bg-amber-500 transition-colors duration-300">
                    Lihat Menu
                </a>
            </div>
        @endif
    </div>
@endsection
