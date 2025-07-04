@extends('layouts.main')

@section('content')
<!-- Hero Section with Image and Text on Left -->
<div class="relative mb-16 mt-8">
    <div class="relative h-96 md:h-[500px] lg:h-[600px] mx-4 md:mx-8 lg:mx-16 rounded-2xl overflow-hidden shadow-2xl">
        <!-- Background Image -->
        <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" 
             alt="Business Team" 
             class="absolute inset-0 w-full h-full object-cover">
        
        <!-- Dark Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-gray-900/90 to-gray-900/40"></div>
        
        <!-- Text Content - Left Aligned -->
        <div class="relative z-10 flex items-center h-full px-8 md:px-12 lg:px-16">
            <div class="text-left text-white max-w-2xl">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4 leading-tight">
                    <span style="color: #006C5F;">EmbizLive</span>
                </h1>
                <h2 class="text-5xl md:text-6xl lg:text-7xl font-bold mb-6 text-gray-200 leading-tight">
                    Where Founders Meet Opportunity
                </h2>
                <p class="text-base md:text-lg mb-8 text-gray-300 leading-relaxed">
                    A trusted space to showcase your startup, connect with co-founders, and respond to investment invitations curated by our team.
                </p>
                <div class="flex justify-start">
                    <a href="{{ route('network') }}" 
                       class="inline-flex items-center px-8 py-4 text-white font-semibold rounded-xl hover:opacity-90 transform hover:scale-105 transition-all duration-200 shadow-lg"
                       style="background-color: #006C5F;">
                        <i class='bx bx-network-chart text-xl mr-2'></i>
                        Join Our Network
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Grid Section -->
<div class="container mx-auto px-4 md:px-8 lg:px-16 py-16">
    <div class="text-center mb-16">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Why Choose EmbizLive?</h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto">
            Discover the powerful features that make our platform the perfect choice for growing businesses
        </p>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
        <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
            <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6" style="background: linear-gradient(135deg, #006C5F, #00857A);">
                <i class='bx bx-trending-up text-3xl text-white'></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Fast Growth</h3>
            <p class="text-gray-600 leading-relaxed">
                Accelerate your business growth with our proven strategies, advanced tools, and expert guidance.
            </p>
        </div>
        
        <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
            <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6" style="background: linear-gradient(135deg, #006C5F, #00857A);">
                <i class='bx bx-network-chart text-3xl text-white'></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Strong Network</h3>
            <p class="text-gray-600 leading-relaxed">
                Build meaningful connections with professionals and entrepreneurs in your industry worldwide.
            </p>
        </div>
        
        <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
            <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6" style="background: linear-gradient(135deg, #006C5F, #00857A);">
                <i class='bx bx-bulb text-3xl text-white'></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Smart Solutions</h3>
            <p class="text-gray-600 leading-relaxed">
                Innovative solutions and cutting-edge technology designed to solve your complex business challenges.
            </p>
        </div>

        <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
            <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6" style="background: linear-gradient(135deg, #006C5F, #00857A);">
                <i class='bx bx-dollar-circle text-3xl text-white'></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Revenue Growth</h3>
            <p class="text-gray-600 leading-relaxed">
                Maximize your revenue potential with our affiliate programs and strategic partnership opportunities.
            </p>
        </div>

        <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
            <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6" style="background: linear-gradient(135deg, #006C5F, #00857A);">
                <i class='bx bx-message-dots text-3xl text-white'></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Real-time Communication</h3>
            <p class="text-gray-600 leading-relaxed">
                Stay connected with instant messaging, video calls, and collaborative tools for seamless communication.
            </p>
        </div>

        <div class="bg-white rounded-2xl p-8 shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
            <div class="w-16 h-16 rounded-2xl flex items-center justify-center mb-6" style="background: linear-gradient(135deg, #006C5F, #00857A);">
                <i class='bx bx-shield-check text-3xl text-white'></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-3">Secure Platform</h3>
            <p class="text-gray-600 leading-relaxed">
                Enterprise-grade security with end-to-end encryption to protect your business data and communications.
            </p>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="rounded-3xl p-12 text-center text-white" style="background: linear-gradient(135deg, #006C5F, #00857A);">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to Transform Your Business?</h2>
        <p class="text-lg md:text-xl mb-8 opacity-90 max-w-2xl mx-auto">
            Join thousands of successful entrepreneurs and businesses already growing with EmbizLive
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('network') }}" 
               class="inline-flex items-center px-8 py-4 bg-white font-semibold rounded-xl hover:bg-gray-100 transition-colors duration-200"
               style="color: #006C5F;">
                Start Your Journey
            </a>
            <a href="{{ route('messages') }}" 
               class="inline-flex items-center px-8 py-4 bg-black/20 text-white font-semibold rounded-xl hover:bg-black/30 transition-colors duration-200">
                Connect Today
            </a>
        </div>
    </div>
</div>
@endsection
