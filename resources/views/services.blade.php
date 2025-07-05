@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 md:px-8 lg:px-16 py-16">
    <div class="text-center mb-16">
        <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">Our Services</h1>
        <p class="text-xl text-gray-600 max-w-3xl mx-auto">
            Comprehensive business solutions designed to accelerate your growth and success.
        </p>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
            <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6" style="background: linear-gradient(135deg, #006C5F, #00857A);">
                <i class='bx bx-bar-chart text-3xl text-white'></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Business Analytics</h3>
            <p class="text-gray-600 leading-relaxed">
                Comprehensive analytics and reporting tools to help you make data-driven decisions and optimize your business performance.
            </p>
        </div>

        <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
            <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6" style="background: linear-gradient(135deg, #006C5F, #00857A);">
                <i class='bx bx-book-open text-3xl text-white'></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Strategic Consulting</h3>
            <p class="text-gray-600 leading-relaxed">
                Expert consultation services to help you develop and implement effective business strategies for sustainable growth.
            </p>
        </div>

        <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
            <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6" style="background: linear-gradient(135deg, #006C5F, #00857A);">
                <i class='bx bx-buildings text-3xl text-white'></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Digital Transformation</h3>
            <p class="text-gray-600 leading-relaxed">
                Modernize your business operations with our cutting-edge digital transformation solutions and technology integration.
            </p>
        </div>
    </div>

    <div class="mt-16 text-center">
        <div class="rounded-3xl p-12 text-white" style="background: linear-gradient(135deg, #006C5F, #00857A);">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to Get Started?</h2>
            <p class="text-lg md:text-xl mb-8 opacity-90 max-w-2xl mx-auto">
                Let's discuss how our services can help transform your business
            </p>
            <a href="{{ route('messages.index') }}" 
               class="inline-flex items-center px-8 py-4 bg-white font-semibold rounded-xl hover:bg-gray-100 transition-colors duration-200"
               style="color: #006C5F;">
                Get In Touch
            </a>
        </div>
    </div>
</div>
@endsection
