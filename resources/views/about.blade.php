@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 md:px-8 lg:px-16 py-16">
    <div class="text-center mb-16">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">About EmbizLive</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Learn more about our mission, vision, and the team behind EmbizLive.
        </p>
    </div>

    <div class="grid md:grid-cols-2 gap-12 items-center">
        <div>
            <h2 class="text-3xl font-bold text-gray-900 mb-6">Our Mission</h2>
            <p class="text-gray-600 mb-6 leading-relaxed">
                At EmbizLive, we're dedicated to empowering entrepreneurs and businesses with the tools, 
                connections, and resources they need to succeed in today's competitive landscape.
            </p>
            <p class="text-gray-600 leading-relaxed">
                We believe that every business has the potential to thrive when provided with the right 
                support system, innovative technology, and a strong network of like-minded professionals.
            </p>
        </div>
        <div class="bg-gradient-to-br from-gray-50 to-gray-100 rounded-2xl p-8">
            <h3 class="text-2xl font-bold text-gray-900 mb-4">Why Choose Us?</h3>
            <ul class="space-y-3">
                <li class="flex items-start">
                    <div class="w-6 h-6 rounded-full flex items-center justify-center mt-0.5 mr-3" style="background-color: #006C5F;">
                        <i class='bx bx-check text-white text-sm'></i>
                    </div>
                    <span class="text-gray-700">Expert guidance and mentorship</span>
                </li>
                <li class="flex items-start">
                    <div class="w-6 h-6 rounded-full flex items-center justify-center mt-0.5 mr-3" style="background-color: #006C5F;">
                        <i class='bx bx-check text-white text-sm'></i>
                    </div>
                    <span class="text-gray-700">Advanced networking opportunities</span>
                </li>
                <li class="flex items-start">
                    <div class="w-6 h-6 rounded-full flex items-center justify-center mt-0.5 mr-3" style="background-color: #006C5F;">
                        <i class='bx bx-check text-white text-sm'></i>
                    </div>
                    <span class="text-gray-700">Cutting-edge technology solutions</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
