<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ShippingController extends Controller
{

    public function cekOngkir(Request $request)
    {
        $request->validate([
            'alamat' => 'required|string',
            'pengiriman' => 'required|string',
            'weight' => 'required|numeric|min:1',
        ]);

        $city = $request->alamat;
        $courier = $request->pengiriman;
        $weight = $request->weight;

        // Contoh endpoint RajaOngkir: real API perlu ID kota tujuan (bukan string)
        // Untuk testing, bisa pakai nilai dummy
        $ongkir = 0;

        if (strtolower($city) === 'jakarta') {
            $ongkir = 10000;
        } elseif (strtolower($city) === 'bandung') {
            $ongkir = 15000;
        } elseif (strtolower($city) === 'surabaya') {
            $ongkir = 20000;
        } else {
            $ongkir = 25000;
        }

        return response()->json([
            'ongkir' => $ongkir,
        ]);
    }

    public function searchDestination(Request $request)
    {
        $alamat = $request->input('alamat');
        $courier = $request->input('pengiriman');

        try {
            // Ambil ID tujuan dari RajaOngkir
            $destinationResponse = Http::withHeaders([
                'key' => config('rajaOngkir.api_key'),
            ])->get('https://rajaongkir.komerce.id/api/v1/destination/domestic-destination', [
                'search' => $alamat,
                'limit' => 1,
                'offset' => 0
            ]);

            if (!$destinationResponse->ok()) {
                return back()->with('error', 'Gagal mengambil data tujuan dari RajaOngkir.');
            }

            $destinationData = $destinationResponse->json();

            if (empty($destinationData['data']) || !isset($destinationData['data'][0]['id'])) {
                return back()->with('error', 'Alamat tidak ditemukan. Pastikan kamu mengetikkan nama kota atau kabupaten dengan benar.');
            }

            $destinationId = $destinationData['data'][0]['id'];

            // Hitung ongkir
            $ongkirResponse = Http::withHeaders([
                'key' => config('rajaOngkir.api_key'),
            ])->asForm()->post('https://rajaongkir.komerce.id/api/v1/calculate/domestic-cost', [
                'origin' => 18700, // contoh origin_id (Bekasi)
                'destination' => $destinationId,
                'weight' => 500, // dalam gram
                'courier' => $courier,
                'price' => 'lowest',
            ]);

            if (!$ongkirResponse->ok()) {
                return back()->with('error', 'Gagal menghitung ongkir. Silakan coba lagi.');
            }

            $ongkirData = $ongkirResponse->json();
            $costs = $ongkirData['data'] ?? [];

            if (empty($costs)) {
                return back()->with('error', 'Tidak ada opsi ongkir tersedia untuk alamat tersebut.');
            }

            // Cari harga terendah
            $lowestCost = null;
            $lowestService = null;

            foreach ($costs as $cost) {
                $value = $cost['cost'] ?? null;
                if ($value !== null) {
                    if ($lowestCost === null || $value < $lowestCost) {
                        $lowestCost = $value;
                        $lowestService = $cost['service'] ?? 'Layanan tidak diketahui';
                        $lowestEtd = $cost['etd'] ?? null;
                    }
                }
            }

            // Simpan ke session
            session([
                'ongkir' => [
                    'service' => $lowestService,
                    'cost' => $lowestCost,
                    'etd' => $lowestEtd,
                ],
                'alamat' => $alamat,
                'kurir' => $courier,
            ]);

            return redirect()->back()->with('success', 'Ongkir berhasil dihitung.');

        } catch (\Exception $e) {
            Log::error('Error saat menghitung ongkir: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menghitung ongkir. Silakan coba lagi nanti.');
        }
    }
}
