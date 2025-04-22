@extends('layouts.main')

@section('content')
    <!-- Hero Section -->
    <div class="relative h-[60vh] flex items-center px-[4%] bg-amber-900 rounded-2xl overflow-hidden">
        <!-- Background Image with Overlay -->
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1445116572660-236099ec97a0?ixlib=rb-1.2.1&auto=format&fit=crop&w=1800&q=80"
                alt="Coffee Shop" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-amber-900/60"></div>
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 text-center w-full text-white">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">About Coffee<span class="text-amber-300">89</span></h1>
            <p class="text-xl md:text-2xl max-w-3xl mx-auto">Our journey from a small coffee stand to your favorite
                neighborhood cafe</p>
        </div>
    </div>

    <!-- Our Story Section -->
    <div class="w-full max-w-[1800px] bg-amber-200 mx-auto py-24 px-4 sm:px-8 rounded-2xl relative -top-10">
        <div class="container mx-auto">
            <div class="flex flex-col lg:flex-row gap-12 items-center">
                <!-- Image -->
                <div class="lg:w-1/2">
                    <div class="rounded-xl overflow-hidden shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1463797221720-6b07e6426c24?ixlib=rb-1.2.1&auto=format&fit=crop&w=1200&q=80"
                            alt="Our Story" class="w-full h-auto object-cover">
                    </div>
                </div>

                <!-- Content -->
                <div class="lg:w-1/2">
                    <h2 class="text-3xl md:text-4xl font-bold mb-6 text-amber-800">
                        Our <span class="text-amber-600">Story</span>
                    </h2>
                    <p class="text-lg text-amber-900 mb-6">
                        Founded in 2015, Coffee89 began as a small coffee cart in downtown Jakarta. What started as a
                        passion project between two college friends quickly grew into a beloved local spot known for its
                        artisanal coffee blends and warm atmosphere.
                    </p>
                    <p class="text-lg text-amber-900 mb-8">
                        Today, we operate three locations across the city, each maintaining our commitment to quality,
                        sustainability, and community. We source our beans directly from ethical growers and roast them
                        in-house to ensure the freshest cup possible.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <div class="bg-amber-700 text-white px-6 py-3 rounded-lg">
                            <span class="block text-2xl font-bold">8</span>
                            <span class="text-sm">Years in Business</span>
                        </div>
                        <div class="bg-amber-700 text-white px-6 py-3 rounded-lg">
                            <span class="block text-2xl font-bold">3</span>
                            <span class="text-sm">Locations</span>
                        </div>
                        <div class="bg-amber-700 text-white px-6 py-3 rounded-lg">
                            <span class="block text-2xl font-bold">50+</span>
                            <span class="text-sm">Employees</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Our Values Section -->
    <div class="w-full bg-amber-900 py-24 text-white">
        <div class="container mx-auto px-4 sm:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Our <span class="text-amber-300">Values</span></h2>
                <p class="text-lg max-w-2xl mx-auto">The principles that guide everything we do</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Value 1 -->
                <div class="bg-amber-800 p-8 rounded-xl text-center hover:bg-amber-700 transition-colors">
                    <div class="w-16 h-16 bg-amber-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Quality</h3>
                    <p>We never compromise on quality, from bean selection to brewing techniques. Every cup must meet our
                        exacting standards.</p>
                </div>

                <!-- Value 2 -->
                <div class="bg-amber-800 p-8 rounded-xl text-center hover:bg-amber-700 transition-colors">
                    <div class="w-16 h-16 bg-amber-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Sustainability</h3>
                    <p>We partner with ethical growers and use compostable packaging to minimize our environmental impact.
                    </p>
                </div>

                <!-- Value 3 -->
                <div class="bg-amber-800 p-8 rounded-xl text-center hover:bg-amber-700 transition-colors">
                    <div class="w-16 h-16 bg-amber-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold mb-3">Community</h3>
                    <p>We're more than a coffee shop - we're a gathering place that supports local artists and
                        organizations.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Team Section -->
    <div class="w-full max-w-[1800px] bg-amber-200 mx-auto py-24 px-4 sm:px-8 rounded-2xl">
        <div class="container mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-amber-800">Meet Our <span
                        class="text-amber-600">Team</span></h2>
                <p class="text-lg text-amber-900 max-w-2xl mx-auto">The passionate people behind your perfect cup</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Team Member 1 -->
                <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow">
                    <div class="h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80"
                            alt="Team Member" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold text-amber-900 mb-1">Alex Johnson</h3>
                        <p class="text-amber-700 mb-4">Founder & Head Roaster</p>
                        <p class="text-amber-900 text-sm">With 15 years in the industry, Alex ensures every bean meets our
                            standards.</p>
                    </div>
                </div>

                <!-- Team Member 2 -->
                <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow">
                    <div class="h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80"
                            alt="Team Member" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold text-amber-900 mb-1">Sarah Williams</h3>
                        <p class="text-amber-700 mb-4">Head Barista</p>
                        <p class="text-amber-900 text-sm">Latte art champion who trains all our baristas in the craft of
                            coffee.</p>
                    </div>
                </div>

                <!-- Team Member 3 -->
                <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow">
                    <div class="h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80"
                            alt="Team Member" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold text-amber-900 mb-1">Michael Chen</h3>
                        <p class="text-amber-700 mb-4">Pastry Chef</p>
                        <p class="text-amber-900 text-sm">Creates all our delicious baked goods in-house daily.</p>
                    </div>
                </div>

                <!-- Team Member 4 -->
                <div class="bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow">
                    <div class="h-64 overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&q=80"
                            alt="Team Member" class="w-full h-full object-cover">
                    </div>
                    <div class="p-6 text-center">
                        <h3 class="text-xl font-bold text-amber-900 mb-1">Priya Patel</h3>
                        <p class="text-amber-700 mb-4">Operations Manager</p>
                        <p class="text-amber-900 text-sm">Keeps all three locations running smoothly every day.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Visit Us CTA -->
    <div class="w-full bg-amber-900 py-20 text-white">
        <div class="container mx-auto px-4 sm:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-6">Come Visit Us</h2>
            <p class="text-xl max-w-2xl mx-auto mb-8">Experience the Coffee89 difference in person at one of our locations
            </p>
            <a href="{{ route('contact') }}"
                class="inline-block px-8 py-3 bg-amber-600 hover:bg-amber-500 rounded-lg font-medium transition-colors duration-300">
                View Locations & Hours
            </a>
        </div>
    </div>
@endsection
