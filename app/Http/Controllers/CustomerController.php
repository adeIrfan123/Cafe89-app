<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;

class CustomerController extends Controller
{
    public function showRegisterForm()
    {
        $title = 'Register';
        return view('customer.register', compact('title'));
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3|max:255|regex:/^[^\d]*$/',
            'email' => 'required|email:rfc,dns|unique:customers,email',
            'password' => 'required|min:6|max:255',
            'no_hp' => 'required|min:6|max:13',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:Laki-laki,Perempuan',
        ]);

        $validatedData['address'] = 'alamat default';
        $validatedData['image'] = 'default.jpg';
        $validatedData['role'] = 'customer';
        $validatedData['password'] = Hash::make($validatedData['password']);

        Customer::create($validatedData);

        return redirect('/login')->with('success', 'Pendaftaran berhasil, silakan login.');
    }

    public function showLoginForm()
    {
        $title = 'Login';
        return view('customer.login', compact('title'));
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('customer')->attempt($credentials)) {
            return redirect()->intended('/cart');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil logout.');
    }
}
