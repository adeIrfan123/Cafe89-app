@extends('layouts.main')

@section('content')
    <div class="min-h-screen bg-gray-900 text-white pt-32 pb-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16">
                <h1 class="text-4xl md:text-5xl font-bold mb-6 text-amber-400">Contact Us</h1>
                <p class="text-lg text-gray-300 max-w-2xl mx-auto">
                    Have questions or feedback? We'd love to hear from you!
                </p>
            </div>

            <div class="bg-gray-800 rounded-xl shadow-xl overflow-hidden">
                <div class="bg-[#b6895b] p-8 text-center">
                    <h2 class="text-2xl font-semibold mb-6">Connect With Us</h2>
                    <div class="flex justify-center space-x-8">
                        <a href="https://www.instagram.com/89coffee.karundang"
                            class="bg-white p-4 rounded-full hover:bg-amber-100 transition-colors duration-300">
                            <i data-feather="instagram" class="w-8 h-8 text-gray-800"></i>
                        </a>
                        <a href="#"
                            class="bg-white p-4 rounded-full hover:bg-amber-100 transition-colors duration-300">
                            <i data-feather="twitter" class="w-8 h-8 text-gray-800"></i>
                        </a>
                        <a href="#"
                            class="bg-white p-4 rounded-full hover:bg-amber-100 transition-colors duration-300">
                            <i data-feather="facebook" class="w-8 h-8 text-gray-800"></i>
                        </a>
                    </div>
                </div>

                <div class="p-8 md:p-12">
                    <form action="#" method="POST" class="space-y-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-lg font-medium mb-2">Name</label>
                                <input type="text" id="name" name="name"
                                    class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-amber-400 focus:border-transparent text-white placeholder-gray-400">
                            </div>
                            <div>
                                <label for="email" class="block text-lg font-medium mb-2">Email</label>
                                <input type="email" id="email" name="email"
                                    class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-amber-400 focus:border-transparent text-white placeholder-gray-400">
                            </div>
                        </div>
                        <div>
                            <label for="subject" class="block text-lg font-medium mb-2">Subject</label>
                            <input type="text" id="subject" name="subject"
                                class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-amber-400 focus:border-transparent text-white placeholder-gray-400">
                        </div>
                        <div>
                            <label for="message" class="block text-lg font-medium mb-2">Your Message</label>
                            <textarea id="message" name="message" rows="5"
                                class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg focus:ring-2 focus:ring-amber-400 focus:border-transparent text-white placeholder-gray-400"></textarea>
                        </div>
                        <div class="pt-4">
                            <button type="submit"
                                class="w-full md:w-auto px-8 py-3 bg-amber-500 hover:bg-amber-600 text-gray-900 font-bold rounded-lg transition-colors duration-300">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                <div class="bg-gray-800 p-6 rounded-xl">
                    <i data-feather="mail" class="w-10 h-10 mx-auto text-amber-400 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Email Us</h3>
                    <p class="text-gray-400">info@coffe89.com</p>
                </div>
                <div class="bg-gray-800 p-6 rounded-xl">
                    <i data-feather="phone" class="w-10 h-10 mx-auto text-amber-400 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Call Us</h3>
                    <p class="text-gray-400">+62 123 4567 890</p>
                </div>
                <div class="bg-gray-800 p-6 rounded-xl">
                    <i data-feather="map-pin" class="w-10 h-10 mx-auto text-amber-400 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-2">Visit Us</h3>
                    <p class="text-gray-400">Jl. Coffee Bean No. 89, Jakarta</p>
                </div>
            </div>
        </div>
    </div>
@endsection
