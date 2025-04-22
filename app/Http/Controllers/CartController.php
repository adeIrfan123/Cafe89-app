<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {

        $cart = session()->get('cart', []);

        $total = 0;
        foreach ($cart as $item) {

            $price = str_replace('.', '', $item['price']);
            $total += (float)$price * $item['quantity'];
        }
        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $quantity = $request->input('quantity', 1);


        if (!$product->id) {
            return redirect()->route('products')->with('error', 'Produk tidak ditemukan.');
        }

        $cart = session()->get('cart', []);

        $cart[$product->id] = [
            'id' => $product->id,
            'slug' => $product->slug,
            'name' => $product->name,
            'image' => $product->image,
            'price' => $product->price,
            'quantity' => isset($cart[$product->id]) ? $cart[$product->id]['quantity'] + $quantity : $quantity,
        ];

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            if ($request->action === 'increment') {
                $cart[$id]['quantity'] += 1;
            } elseif ($request->action === 'decrement' && $cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity'] -= 1;
            }

            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Jumlah produk diperbarui.');
        }

        return redirect()->back()->with('error', 'Produk tidak ditemukan dalam keranjang.');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Produk berhasil dihapus dari keranjang!');
    }
}
