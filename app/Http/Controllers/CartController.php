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

        return view('cart.index', compact('cartItems', 'total', 'title'));
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
        $item->delete();

        return back()->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}
