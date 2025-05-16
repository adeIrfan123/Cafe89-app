<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Coffee Shop</title>
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

    <div class="flex mt-20 md:relative">
        <main class="flex items-center justify-center md:ml-53 bg">
            <div class="bg-white rounded-3xl shadow-lg p-10 w-[90%] md:w-full max-w-lg">
                <h2 class="text-3xl font-bold text-center text-amber-700 mb-6">Create Your Account</h2>
                <form action="/register" method="POST" class="space-y-4">
                    @csrf

                    <div class="flex space-x-4">
                        <div class="w-1/2">
                            <input type="text" name="name" placeholder="Full Name"
                                class="w-full px-4 py-2 border border-amber-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 @error('name') border-red-500 @enderror"
                                value="{{ old('name') }}">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="w-1/2">
                            <input type="text" name="no_hp" placeholder="Phone Number"
                                class="w-full px-4 py-2 border border-amber-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 @error('no_hp') border-red-500 @enderror"
                                value="{{ old('no_hp') }}">
                            @error('no_hp')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <input type="email" name="email" placeholder="Email Address"
                            class="w-full px-4 py-2 border border-amber-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 @error('email') border-red-500 @enderror"
                            value="{{ old('email') }}">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <input type="password" name="password" placeholder="Password"
                            class="w-full px-4 py-2 border border-amber-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="tanggal_lahir" class="block text-sm font-medium text-amber-700">Tanggal
                            Lahir</label>
                        <input type="date" id="tanggal_lahir" name="date_of_birth"
                            class="w-full px-4 py-2 border border-amber-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 @error('date_of_birth') border-red-500 @enderror"
                            value="{{ old('date_of_birth') }}">
                        @error('date_of_birth')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-amber-700 mb-1">Jenis Kelamin</label>
                        <div class="flex space-x-4">
                            <label class="inline-flex items-center">
                                <input type="radio" name="gender" value="Laki-laki" class="text-amber-600"
                                    {{ old('gender') == 'Laki-laki' ? 'checked' : '' }}>
                                <span class="ml-2">Laki-laki</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="gender" value="Perempuan" class="text-amber-600"
                                    {{ old('gender') == 'Perempuan' ? 'checked' : '' }}>
                                <span class="ml-2">Perempuan</span>
                            </label>
                        </div>
                        @error('gender')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="w-full bg-amber-700 text-white py-2 rounded-lg font-semibold hover:bg-amber-800 transition">
                        Register
                    </button>
                </form>

                <p class="text-center text-sm text-gray-600 mt-4">
                    Already have an account?
                    <a href="/login" class="text-amber-700 font-semibold hover:underline">Login here</a>
                </p>
            </div>
        </main>
        <div class="w-[50%] hidden md:absolute -z-1 left-140 md:flex flex-wrap justify-center items-center gap-4 p-4"
            style="perspective: 1000px;">
            <img src="https://images.unsplash.com/photo-1521017432531-fbd92d768814?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0"
                alt="Coffee Shop"
                class="transform rotate-x-12 rotate-y-6 rotate-z-2 w-[250px] h-[250px] rounded-xl shadow-2xl transition hover:rotate-x-6 hover:rotate-y-12 hover:shadow-[0_15px_30px_rgba(0,0,0,0.5)] hover:scale-105">
            <img src="https://images.unsplash.com/photo-1567880905822-56f8e06fe630?q=80&w=1935&auto=format&fit=crop&ixlib=rb-4.1.0"
                alt="Coffee Shop"
                class="transform rotate-x-6 -rotate-y-30 -rotate-z-6 relative -left-15 top-6 w-[250px] h-[250px] rounded-xl shadow-2xl transition hover:rotate-x-12 hover:rotate-y-6 hover:shadow-[0_15px_30px_rgba(0,0,0,0.5)] hover:scale-105">
            <img src="https://images.unsplash.com/photo-1567880905822-56f8e06fe630?q=80&w=1935&auto=format&fit=crop&ixlib=rb-4.1.0"
                alt="Coffee Shop"
                class="transform rotate-x-3 rotate-y-9 rotate-z-6 w-[250px] h-[250px] rounded-xl shadow-2xl transition hover:rotate-x-9 hover:rotate-y-3 hover:shadow-[0_15px_30px_rgba(0,0,0,0.5)] hover:scale-105">
            <img src="https://images.unsplash.com/photo-1567880905822-56f8e06fe630?q=80&w=1935&auto=format&fit=crop&ixlib=rb-4.1.0"
                alt="Coffee Shop"
                class="transform rotate-x-9 rotate-y-3 rotate-z-9 w-[250px] h-[250px] rounded-xl shadow-2xl transition hover:rotate-x-3 hover:rotate-y-9 hover:shadow-[0_15px_30px_rgba(0,0,0,0.5)] hover:scale-105">
        </div>

    </div>

    <footer class="py-4 text-center text-sm text-gray-600">
        &copy; 2025 #89 Coffee. All rights reserved.
    </footer>
</body>

</html>
