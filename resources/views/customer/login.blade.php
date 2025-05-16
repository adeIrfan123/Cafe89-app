<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Coffee Shop</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>

<body class="font-[Poppins] bg-gradient-to-br from-amber-100 via-amber-200 to-amber-300 min-h-screen flex flex-col">
    <nav class="py-4 bg-amber-700 text-white shadow-md">
        <div class="container mx-auto flex justify-between items-center px-6">
            <h1 class="text-2xl font-bold">☕ #89 Coffee</h1>
            <a href="/" class="hover:underline">Home</a>
        </div>
    </nav>

    <main class="flex-grow flex items-center justify-center">
        <div class="bg-white rounded-3xl shadow-lg p-10 w-full max-w-md">
            <h2 class="text-3xl font-bold text-center text-amber-700 mb-6">Welcome Back</h2>
            <form action="/login" method="POST" class="space-y-4">
                @csrf
                <input type="email" name="email" placeholder="Email Address" required autofocus
                    value="{{ old('email') }}"
                    class="w-full px-4 py-2 border border-amber-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <input type="password" name="password" placeholder="Password" required
                    class="w-full px-4 py-2 border border-amber-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500">
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
                <div class="flex justify-between items-center">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember" class="text-amber-600">
                        <span class="ml-2 text-sm text-gray-700">Remember me</span>
                    </label>
                    <a href="#" class="text-sm text-amber-700 hover:underline">Forgot password?</a>
                </div>
                <button type="submit"
                    class="w-full bg-amber-700 text-white py-2 rounded-lg font-semibold hover:bg-amber-800 transition">Login</button>
            </form>
            <p class="text-center text-sm text-gray-600 mt-4">
                Don't have an account?
                <a href="/register" class="text-amber-700 font-semibold hover:underline">Register here</a>
            </p>
        </div>
    </main>

    <footer class="py-4 text-center text-sm text-gray-600">
        &copy; 2025 #89 Coffee. All rights reserved.
    </footer>
</body>

</html>
