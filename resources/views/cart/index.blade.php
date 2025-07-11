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
                    @php
                        $ongkirCost = session('ongkir.cost', 0);
                        $grandTotal = $total + $ongkirCost;
                    @endphp

                    <h3 class="text-xl font-bold text-white mb-4 md:mb-0">
                        Total: Rp {{ number_format($grandTotal, 0, ',', '.') }}
                        @if ($ongkirCost > 0)
                            <span class="text-sm text-gray-300 font-normal block mt-1">
                                (Termasuk Ongkir Rp {{ number_format($ongkirCost, 0, ',', '.') }})
                            </span>
                        @endif
                    </h3>
                    <div class="flex space-x-4 relative">
                        <button id="shipping-btn"
                            class="bg-amber-400 rounded-xl py-2 px-4 cursor-pointer hover:bg-amber-300 transition-all text-black font-bold">
                            Pengiriman
                        </button>
                        <div id="shipping-form"
                            class="hidden bg-[#b6895b] absolute -top-84 left-20 lg:-top-60 lg:-left-70 w-67 rounded-3xl py-4 px-4 shadow-lg">
                            @if (session('error'))
                                <div class="bg-red-500 text-white px-4 py-2 rounded-lg mb-4 text-sm text-center w-full">
                                    {{ session('error') }}
                                </div>
                            @endif
                            <form action="/shipping" method="post" class="flex flex-col items-center">
                                @csrf

                                {{-- Alamat --}}
                                <div class="flex flex-col mb-4 w-full">
                                    <label class="ml-2 mb-1 text-black text-sm font-medium">Alamat tujuan</label>
                                    <input name="alamat" type="text"
                                        class="text-black bg-white/20 placeholder-white/70 border border-white/30 focus:outline-none focus:ring-2 focus:ring-white/60 focus:border-transparent transition-all px-3 py-2 rounded-xl"
                                        placeholder="Masukkan alamat" value="{{ old('alamat', session('alamat')) }}">
                                </div>

                                {{-- Pilih Pengiriman --}}
                                <div
                                    class="bg-white/20 backdrop-blur-sm flex flex-col rounded-xl px-4 mb-4 py-4 w-full border border-white/30">
                                    <label class="mb-2 text-black text-sm font-medium">Pilih pengiriman</label>
                                    <select name="pengiriman"
                                        class="w-full bg-white/30 text-black border border-white/30 rounded-xl px-3 py-2 focus:outline-none focus:ring-2 focus:ring-white/60">
                                        <option value="jne" {{ session('kurir') == 'jne' ? 'selected' : '' }}>JNE
                                        </option>
                                        <option value="jnt" {{ session('kurir') == 'jnt' ? 'selected' : '' }}>J&T
                                        </option>
                                        <option value="sicepat" {{ session('kurir') == 'sicepat' ? 'selected' : '' }}>
                                            Sicepat</option>
                                    </select>

                                    {{-- Harga Ongkir --}}
                                    <div class="mt-4">
                                        @php
                                            $ongkirCost = data_get($ongkir, 'cost', null);
                                        @endphp

                                        <p class="text-black text-sm font-medium mb-1">Harga Ongkir</p>
                                        <input type="text"
                                            class="text-black bg-white/20 placeholder-white/70 border border-white/30 px-3 py-2 rounded-xl w-full"
                                            value="{{ $ongkir && data_get($ongkir, 'cost') ? 'Rp ' . number_format(data_get($ongkir, 'cost'), 0, ',', '.') : 'Belum dihitung' }}"
                                            readonly>
                                    </div>
                                </div>

                                {{-- Tombol Simpan --}}
                                <div class="flex justify-end w-full">
                                    <button type="submit"
                                        class="bg-white/30 text-black px-4 py-2 rounded-xl hover:bg-white/50 transition-all font-semibold shadow-lg">
                                        Simpan Pilihan
                                    </button>
                                </div>
                            </form>
                        </div>


                        <a href="{{ route('products') }}"
                            class="transition-all px-6 py-3 border border-amber-400 text-amber-400 rounded-lg font-medium hover:bg-amber-400 hover:text-gray-900">
                            Lanjut Belanja
                        </a>
                        <button id="pay-button"
                            class="btn btn-primary px-8 py-3 rounded-lg font-bold transition-all
{{ session('ongkir') && !session('error') ? 'bg-amber-400 hover:bg-amber-500 text-gray-900 cursor-pointer' : 'bg-gray-400 text-gray-300 cursor-not-allowed' }}"
                            {{ session('ongkir') && !session('error') ? '' : 'data-disabled=true' }}>
                            {{ session('ongkir') && !session('error') ? 'Checkout Sekarang' : 'Isi Form Pengiriman Dulu' }}
                        </button>
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
    <!-- Midtrans Snap.js -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <!-- Script Checkout -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const payButton = document.getElementById('pay-button');

            // if (!payButton) {
            //     console.warn('Tombol #pay-button tidak ditemukan.');
            //     return;
            // }

            payButton.addEventListener('click', function(e) {
                e.preventDefault();

                if (payButton.getAttribute('data-disabled') === 'true') {
                    alert('Silakan isi form pengiriman terlebih dahulu.');
                    return;
                }

                payButton.innerHTML = 'Memproses...';
                payButton.disabled = true;

                fetch('{{ route('checkout.process') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(response => {
                        if (response.error) {
                            alert('Error: ' + response.error);
                            payButton.disabled = false;
                            payButton.innerHTML = 'Checkout Sekarang';
                            return;
                        }

                        window.snap.pay(response.snap_token, {
                            onSuccess: function(result) {
                                console.log("SUKSES", result);
                                // alert('Pembayaran berhasil! Order ID: ' + result.order_id);
                                alert('Pembayaran berhasil! Order ID: ' + response
                                    .order_id);

                                fetch('/cart/clear', {
                                    method: 'POST',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json',
                                    }
                                }).then(() => {
                                    window.location.href = '/cart';
                                });
                            },
                            onPending: function(result) {
                                alert('Menunggu pembayaran! Order ID: ' + response
                                    .order_id);
                                window.location.href = '/cart';
                            },
                            onError: function(result) {
                                alert('Pembayaran gagal!');
                                payButton.disabled = false;
                                payButton.innerHTML = 'Checkout Sekarang';
                            },
                            onClose: function() {
                                alert('Anda menutup popup tanpa menyelesaikan pembayaran');
                                payButton.disabled = false;
                                payButton.innerHTML = 'Checkout Sekarang';
                            }
                        });
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat memproses pembayaran');
                        payButton.disabled = false;
                        payButton.innerHTML = 'Checkout Sekarang';
                    });
            });
        });
    </script>


@endsection
