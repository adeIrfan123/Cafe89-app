@extends('layouts.main')

@section('content')
    <div class="mx-4 sm:mx-8 lg:mx-16 mt-20 text-white">
        {{-- ... breadcrumb & gambar ... --}}

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            {{-- Gambar --}}
            <div class="top-0 sticky lg:top-24">
                <div class="bg-gray-800 rounded-xl shadow-xl overflow-hidden">
                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
                        class="w-full h-auto object-cover transition-transform duration-500 hover:scale-105 cursor-zoom-in"
                        id="main-product-image">
                </div>
                <div class="flex mt-4 space-x-3" id="thumbnail-container"></div>
            </div>

            {{-- Detail Produk --}}
            <div class="relative">
                {{-- Sticky Title & Price --}}
                <div class="sticky top-30 z-10 bg-gray-900/95 backdrop-blur-sm py-3 px-4 -mx-4 mb-4 lg:top-16">
                    <h1 class="text-2xl font-bold text-white">{{ $product->name }}</h1>
                    <div class="flex items-center justify-between mt-1">
                        @php $price = (int) str_replace('.', '', $product->price); @endphp
                        <p class="text-xl text-amber-200 font-semibold">Rp {{ number_format($price, 0, ',', '.') }}</p>
                        {{-- Rating Dummy --}}
                        <div class="flex items-center">
                            <div class="flex text-amber-300 mr-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 {{ $i <= 4 ? 'fill-current' : 'fill-none' }}" viewBox="0 0 20 20"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                            </div>
                            <span class="text-gray-300 text-xs">(24 reviews)</span>
                        </div>
                    </div>
                </div>

                {{-- Isi --}}
                <div class="bg-gray-800/50 p-4 rounded-lg lg:bg-transparent lg:p-0">
                    <div class="mb-8">
                        <p class="text-lg text-white">
                            Availability:
                            <span class="font-semibold {{ $product->stock > 0 ? 'text-green-400' : 'text-red-400' }}">
                                {{ $product->stock > 0 ? 'In Stock (' . $product->stock . ' available)' : 'Out of Stock' }}
                            </span>
                        </p>
                    </div>

                    {{-- Tambah ke Keranjang --}}
                    <form action="{{ route('cart.add') }}" method="POST" class="mb-6">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="flex items-end mb-8">
                            <div class="mr-4">
                                <label for="quantity" class="block text-sm font-medium text-gray-300 mb-1">Quantity</label>
                                <div class="flex border border-gray-600 rounded-lg overflow-hidden">
                                    <button type="button" class="px-3 py-2 bg-gray-700 text-white decrement-qty">-</button>
                                    <input type="number" id="quantity" name="quantity" min="1" value="1"
                                        max="{{ $product->stock }}"
                                        class="w-16 text-center bg-gray-800 text-white py-2 px-0 border-0">
                                    <button type="button" class="px-3 py-2 bg-gray-700 text-white increment-qty">+</button>
                                </div>
                            </div>
                            <button type="submit"
                                class="flex-1 bg-amber-400 hover:bg-amber-500 py-3 px-6 rounded-lg font-bold text-gray-900 flex items-center justify-center">
                                Tambah ke Keranjang
                            </button>
                        </div>
                    </form>

                    {{-- Buy Now --}}
                    {{-- <form action="/shipping" method="POST" class="mb-10"> --}}
                    <div class="mb-10">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" id="buy-now-quantity" value="1">

                        {{-- Cek Ongkir --}}
                        <div class="mb-8">
                            <h3 class="text-white font-semibold mb-2">Cek Ongkir</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm text-gray-300 mb-1">Kota Tujuan</label>
                                    <input type="text" id="destination" name="alamat"required
                                        class="w-full px-3 py-2 rounded bg-gray-700 text-white"
                                        placeholder="Contoh: Jakarta" required>
                                </div>
                                <div>
                                    <label class="block text-sm text-gray-300 mb-1">Kurir</label>
                                    <select id="courier" name="pengiriman"required
                                        class="w-full px-3 py-2 rounded bg-gray-700 text-white" required>
                                        <option value="jne" {{ session('kurir') == 'jne' ? 'selected' : '' }}>JNE
                                        </option>
                                        <option value="jnt" {{ session('kurir') == 'jnt' ? 'selected' : '' }}>J&T
                                        </option>
                                        <option value="sicepat" {{ session('kurir') == 'sicepat' ? 'selected' : '' }}>
                                            SiCepat</option>
                                    </select>
                                </div>
                            </div>

                            <button type="button" id="cek-ongkir-btn"
                                class="mt-4 bg-amber-500 hover:bg-amber-600 text-black font-bold py-2 px-4 rounded">
                                Cek Ongkir
                            </button>

                            <div class="mt-4 text-gray-300">
                                <p>Ongkir:
                                    <span id="ongkir-text">
                                        @if (session('ongkir'))
                                            Rp{{ number_format(session('ongkir.cost'), 0, ',', '.') }}
                                            ({{ session('ongkir.service') }})
                                        @else
                                            -
                                        @endif
                                    </span>
                                </p>
                                <p>Estimasi:
                                    <span id="estimasi-text">
                                        @if (session('ongkir'))
                                            {{ session('ongkir.etd') ?? '-' }}
                                        @else
                                            -
                                        @endif
                                    </span>
                                </p>
                                <p>Total:
                                    <span id="total-harga-text">
                                        @if (session('ongkir'))
                                            Rp{{ number_format($product->price * old('quantity', 1) + session('ongkir.cost'), 0, ',', '.') }}
                                        @else
                                            -
                                        @endif
                                    </span>
                                </p>
                            </div>

                        </div>
                    </div>
                    {{-- </form> --}}

                    <div id="buy-now-error"
                        class="hidden bg-red-500 text-white px-4 py-2 rounded-lg mb-4 text-sm text-center w-full">
                    </div>


                    <button id="pay-btn-now" type="button"
                        class="w-full bg-transparent hover:bg-amber-400 border-2 border-amber-400 text-amber-400 hover:text-gray-900 transition-colors duration-300 py-3 px-6 rounded-lg font-bold flex items-center justify-center">
                        BUY NOW
                    </button>

                    {{-- Deskripsi --}}
                    <div class="border-t border-gray-700 pt-8">
                        <h3 class="text-xl font-bold mb-4 text-white">Deskripsi Produk</h3>
                        <p class="text-gray-300">{!! nl2br(e($product->deskripsi_panjang)) !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Midtrans & Script --}}
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
    <script>
        let selectedOngkir = 0;
        const productPrice = {{ $price }};

        document.getElementById('cek-ongkir-btn').addEventListener('click', function() {
            const destination = document.getElementById('destination').value;
            const courier = document.getElementById('courier').value;
            const quantity = parseInt(document.getElementById('buy-now-quantity').value) || 1;

            if (!destination || !courier) {
                alert('Harap isi kota tujuan dan kurir!');
                return;
            }

            const weight = 1000; // berat total produk dalam gram
            const subtotal = productPrice * quantity;

            document.getElementById('ongkir-text').textContent = 'Menghitung...';
            document.getElementById('estimasi-text').textContent = '-';
            document.getElementById('total-harga-text').textContent = 'Menghitung...';

            fetch('/api/cek-ongkir', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        alamat: destination,
                        pengiriman: courier,
                        weight: weight
                    })
                })
                .then(res => {
                    if (!res.ok) {
                        throw new Error('Gagal memproses response dari server');
                    }
                    return res.json();
                })
                .then(data => {
                    if (data.error) {
                        showBuyNowError(data.error);
                        document.getElementById('ongkir-text').textContent = '-';
                        document.getElementById('estimasi-text').textContent = '-';
                        document.getElementById('total-harga-text').textContent = '-';
                        document.getElementById('pay-btn-now').disabled = true;
                        return;
                    }

                    selectedOngkir = data.ongkir; // hanya 1x ongkir, tidak dikali quantity
                    const total = subtotal + selectedOngkir;

                    document.getElementById('ongkir-text').textContent = 'Rp ' + selectedOngkir.toLocaleString(
                        'id-ID') + ' (' + data.service + ')';
                    document.getElementById('estimasi-text').textContent =
                        data.etd ? data.etd + ' hari' : '-';
                    document.getElementById('total-harga-text').textContent = 'Rp ' + total.toLocaleString(
                        'id-ID');
                    document.getElementById('pay-btn-now').disabled = false;
                })
                .catch(err => {
                    console.error('Error saat fetch ongkir:', err);
                    showBuyNowError('Terjadi kesalahan saat cek ongkir');
                    document.getElementById('ongkir-text').textContent = '-';
                    document.getElementById('estimasi-text').textContent = '-';
                    document.getElementById('total-harga-text').textContent = '-';
                    document.getElementById('pay-btn-now').disabled = true;
                });
        });

        function showBuyNowError(message) {
            const errorBox = document.getElementById('buy-now-error');
            errorBox.textContent = message;
            errorBox.classList.remove('hidden');
            errorBox.classList.add('opacity-100');

            setTimeout(() => {
                errorBox.classList.add('opacity-0', 'transition-opacity', 'duration-500');
                setTimeout(() => {
                    errorBox.classList.add('hidden');
                    errorBox.classList.remove('opacity-0');
                }, 500);
            }, 3000);
        }




        document.getElementById('pay-btn-now').addEventListener('click', function() {
            const quantity = parseInt(document.getElementById('buy-now-quantity').value) || 1;
            const alamat = document.getElementById('destination').value;

            if (!selectedOngkir || !alamat) {
                alert('Harap cek ongkir terlebih dahulu!');
                return;
            }

            const total = (productPrice * quantity) + selectedOngkir;

            const button = this;
            button.disabled = true;
            button.textContent = 'Memproses...';

            fetch("{{ route('buy.now') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        product_id: {{ $product->id }},
                        quantity: quantity,
                        alamat: alamat,
                        ongkir: selectedOngkir
                    })
                })
                .then(response => response.json())
                .then(response => {
                    if (response.error) {
                        alert('Error: ' + response.error);
                        button.disabled = false;
                        button.textContent = 'BUY NOW';
                        return;
                    }

                    window.snap.pay(response.snap_token, {
                        onSuccess: function(result) {
                            alert('Pembayaran berhasil! Order ID: ' + result.order_id);
                            window.location.href = '/';
                        },
                        onPending: function(result) {
                            alert('Menunggu pembayaran...');
                            window.location.href = '/buy-now';
                        },
                        onError: function(result) {
                            alert('Pembayaran gagal!');
                            button.disabled = false;
                            button.textContent = 'BUY NOW';
                        },
                        onClose: function() {
                            alert('Popup ditutup');
                            button.disabled = false;
                            button.textContent = 'BUY NOW';
                        }
                    });
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan');
                    button.disabled = false;
                    button.textContent = 'BUY NOW';
                });
        });
    </script>
@endsection
