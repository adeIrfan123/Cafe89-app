<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            'password' => 'required|min:6|max:255|confirmed',
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

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        if (Auth::guard('customer')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('loginError', 'Login Gagal');
    }

    public function logout(Request $request)
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil logout.');
    }
}
