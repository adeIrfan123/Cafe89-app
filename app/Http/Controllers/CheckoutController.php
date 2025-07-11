<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
        public function cekOngkir(Request $request)
    {
        if (!Auth::guard('customer')->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }
        $request->validate([
            'alamat' => 'required|string',
            'pengiriman' => 'required|string',
            'weight' => 'required|numeric|min:1',
        ]);

        try {
            $destinationResponse = Http::withHeaders([
                'key' => config('rajaOngkir.api_key'),
            ])->get('https://rajaongkir.komerce.id/api/v1/destination/domestic-destination', [
                'search' => $request->alamat,
                'limit' => 1,
                'offset' => 0
            ]);

            if (!$destinationResponse->ok() || empty($destinationResponse['data'])) {
                return response()->json(['error' => 'Alamat tidak ditemukan'], 400);
            }

            $destinationId = $destinationResponse['data'][0]['id'];

            $ongkirResponse = Http::withHeaders([
                'key' => config('rajaOngkir.api_key'),
            ])->asForm()->post('https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost', [
                'origin' => 18700,
                'destination' => $destinationId,
                'weight' => $request->weight,
                'courier' => $request->pengiriman,
                'price' => 'lowest',
            ]);

            if (!$ongkirResponse->ok()) {
                return response()->json(['error' => 'Gagal menghitung ongkir'], 400);
            }

            $costs = $ongkirResponse['data'];
            if (empty($costs)) {
                return response()->json(['error' => 'Tidak ada opsi ongkir'], 400);
            }

            $lowest = collect($costs)->sortBy('cost')->first();

            return response()->json([
                'ongkir' => $lowest['cost'],
                'service' => $lowest['service'] ?? 'Tidak diketahui',
                 'etd' => $lowest['etd'] ?? '-'
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }


    public function buyNow(Request $request)
{
    if (!Auth::guard('customer')->check()) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
        'alamat' => 'required|string',
        'ongkir' => 'required|integer|min:0',
    ]);

    $customer = Auth::guard('customer')->user();
    $product = Product::findOrFail($request->product_id);

    $productPrice = (int) str_replace('.', '', $product->price);
    $ongkir = (int) $request->ongkir;
    $quantity = (int) $request->quantity;
    $grossAmount = ($productPrice * $quantity) + $ongkir;

    Config::$serverKey = config('midtrans.server_key');
    Config::$isProduction = false;
    Config::$isSanitized = true;
    Config::$is3ds = true;

    $transactionDetails = [
        'transaction_details' => [
            'order_id' => 'ORDER-' . time(),
            'gross_amount' => $grossAmount,
        ],
        'customer_details' => [
            'first_name' => $customer->name,
            'email' => $customer->email,
        ],
        'item_details' => [
            [
                'id' => $product->id,
                'price' => $productPrice,
                'quantity' => $quantity,
                'name' => $product->name,
            ],
            [
                'id' => 'ongkir',
                'price' => $ongkir,
                'quantity' => 1,
                'name' => 'Ongkir',
            ]
        ]
    ];

    try {
        $snapToken = Snap::getSnapToken($transactionDetails);

        return response()->json([
            'snap_token' => $snapToken,
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'error' => 'Gagal membuat Snap Token: ' . $e->getMessage(),
        ], 500);
    }
}



    public function process(Request $request)
    {
        // Get cart items from session
        $customer = Auth::guard('customer')->user();
        $cart = $customer->cart;

        if (!$cart || $cart->items->isEmpty()) {
            return response()->json(['error' => 'Keranjang kosong'], 400);
        }

        $cartItems = $customer->cart->items()->with('product')->get();

        if ($cartItems->isEmpty()) {
            return response()->json([
                'error' => 'Keranjang belanja kosong.'
            ], 400);
        }

        // Calculate total amount
        $item_details = [];
        $total = 0;

        foreach ($cart->items as $item) {
            $product = $item->product;
            $price = (int) str_replace('.', '', $product->price);
            $quantity = $item->quantity;
            $subtotal = $price * $quantity;

            $item_details[] = [
                'id' => $product->id,
                'price' => $price,
                'quantity' => $quantity,
                'name' => $product->name,
            ];

            $total += $subtotal;
        }
        $ongkirCost = session('ongkir.cost', 0);
        if ($ongkirCost > 0) {
            $item_details[] = [
                'id' => 'ONGKIR',
                'price' => $ongkirCost,
                'quantity' => 1,
                'name' => 'Ongkos Kirim',
            ];

            $total += $ongkirCost;
        }

        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;


        $params = [
            'transaction_details' => [
                'order_id' => 'ORDER-' . strtoupper(uniqid()),
                'gross_amount' => $total,
            ],
            'item_details' => $item_details,
            'customer_details' => [
                'first_name' => $customer->name,
                'email' => $customer->email,
                'phone' => $customer->no_hp,
                'shipping_address' => [
                    'first_name' => $customer->name,
                    'address' => session('alamat', 'Alamat belum diisi'),
                    'postal_code' => '12345',
                    'phone' => $customer->no_hp,
                    'country_code' => 'IDN'
                ],
            ]
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);

            return response()->json([
                'snap_token' => $snapToken,
                'order_id' => $params['transaction_details']['order_id']
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
