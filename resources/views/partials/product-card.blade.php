<div
    class="hover:cursor-pointer product-card bg-[#1e1e1e] rounded-lg overflow-hidden shadow-xl hover:shadow-2xl transition-shadow duration-300 h-full flex flex-col">
    <div class="relative overflow-hidden h-48">
        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}"
            class="w-full h-full object-cover transition-transform duration-500 hover:scale-110">
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
        <span class="absolute top-3 right-3 bg-[#b6895b] text-white px-3 py-1 rounded-full text-sm font-semibold">
            Rp {{ number_format($product->price, 0, ',', '.') }}K
        </span>
    </div>

    <div class="p-6 flex-grow flex flex-col">
        <div class="flex-grow">
            <h3 class="text-xl font-bold text-white mb-2 hover:text-[#b6895b] transition-colors duration-300">
                <a href="{{ route('product.show', ['slug' => $product->slug]) }}" class="block">
                    {{ $product->name }}
                </a>
            </h3>
            <p class="text-gray-300 line-clamp-3 mb-4">
                {!! $product->deskripsi_singkat !!}
            </p>
        </div>

        <form action="/cart/add" method="POST" class="mt-auto">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button type="submit"
                class="hover:cursor-pointer w-full bg-[#b6895b] hover:bg-[#854836] text-white font-bold py-3 px-4 rounded-lg transition-colors duration-300 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                Add to Cart
            </button>
        </form>
    </div>
</div>
