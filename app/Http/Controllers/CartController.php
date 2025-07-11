<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Auth::guard('customer')->user()->cart;

        if (!$cart) {
            $cartItems = collect();
            $total = 0;
        } else {
            $cartItems = $cart->items()->with('product')->get();
            $total = $cartItems->sum(function ($item) {
                $price = (int) str_replace('.', '', $item->price ?? $item->product->price);
                return $price * $item->quantity;
            });
        }

        $title = 'Cart';

        $ongkir = session('ongkir');
        if (!is_array($ongkir)) {
            $ongkir = null; // jika session ada tapi bukan array, reset ke null
        }
        $alamat = session('alamat');
        $kurir = session('kurir');

        if ($ongkir) {
            logger('Ongkir dari session: ', $ongkir);
        }

        return view('cart.index', compact('cartItems', 'total', 'title', 'ongkir', 'alamat', 'kurir'));
    }


    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);

        $customer = Auth::guard('customer')->user();

        // Buat cart jika belum ada
        $cart = $customer->cart ?? Cart::create(['customer_id' => $customer->id]);

        $product = Product::findOrFail($request->product_id);

        $item = $cart->items()->where('product_id', $product->id)->first();
        $quantity = $request->filled('quantity') ? (int) $request->quantity : 1;

        if ($item) {
            $item->update(['quantity' => $item->quantity + $quantity]);
        } else {
            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $product->price,
            ]);
        }

        return redirect('cart')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, CartItem $item)
    {
        $quantity = max(1, (int) $request->quantity);
        $item->update(['quantity' => $quantity]);

        return back()->with('success', 'Jumlah produk berhasil diperbarui.');
    }

    public function destroy(CartItem $item)
    {
        $customer = Auth::guard('customer')->user();
        $cart = $customer->cart;
        $item->delete();
        if ($cart && $cart->items()->count() == 0) {
            $cart->delete(); // Hapus keranjang jika tidak ada item
        }


        return back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }

    public function clear()
    {
        $customer = Auth::guard('customer')->user();
        $cart = $customer->cart;

        if ($cart) {
            $cart->items()->delete(); // Hapus semua item di keranjang
            $cart->delete(); // Hapus keranjang itu sendiri
        }

        // Jika request dari fetch/AJAX, kirim JSON saja
        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }

        // Jika request biasa (browser), redirect seperti biasa
        return redirect('cart')->with('success', 'Keranjang berhasil dikosongkan.');
    }

}
