@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Cover Image Section -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
                    <div class="relative">
                        <!-- Cover Image -->
                        <div class="h-48 bg-gradient-to-r from-gray-600 to-gray-800 rounded-t-lg relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" 
                                 alt="Cover Image" 
                                 class="w-full h-full object-cover">
                            <div class="absolute top-4 right-4">
                                <button class="bg-white bg-opacity-90 hover:bg-opacity-100 text-gray-700 px-3 py-1 rounded-lg text-sm font-medium transition-all duration-200">
                                    <i class='bx bx-camera mr-2'></i>Enhance cover image
                                </button>
                            </div>
                        </div>
                        
                        <!-- Profile Avatar -->
                        <div class="absolute -bottom-12 left-6">
                            <div class="w-24 h-24 bg-white rounded-full p-1 shadow-lg">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                     alt="Amina Walker" 
                                     class="w-full h-full rounded-full object-cover">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Profile Info -->
                    <div class="pt-16 pb-6 px-6">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <div class="flex items-center mb-2">
                                    <h1 class="text-2xl font-bold text-gray-900 mr-3">Amina Walker</h1>
                                    <div class="flex items-center">
                                        <i class='bx bx-check-circle text-lg mr-1' style="color: #006C5F;"></i>
                                        <span class="text-sm font-medium" style="color: #006C5F;">Founding Member</span>
                                    </div>
                                </div>
                                
                                <p class="text-gray-600 mb-2">Helping Black-led startups secure funding through smart financial planning.</p>
                                
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <i class='bx bx-briefcase mr-2'></i>
                                    <span>Founder - NourishHer</span>
                                </div>
                                
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <i class='bx bx-map mr-2'></i>
                                    <span>Birmingham, UK</span>
                                </div>
                                
                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    <i class='bx bx-briefcase mr-2'></i>
                                    <span>Portfolio 50</span>
                                </div>
                                
                                <div class="flex flex-wrap gap-2 mb-4">
                                    <span class="px-3 py-1 bg-gray-200 text-gray-700 text-sm rounded-full">Startup Finance</span>
                                    <span class="px-3 py-1 bg-gray-200 text-gray-700 text-sm rounded-full">Startup Finance</span>
                                    <span class="px-3 py-1 bg-gray-200 text-gray-700 text-sm rounded-full">Startup Finance</span>
                                    <span class="px-3 py-1 bg-gray-200 text-gray-700 text-sm rounded-full">Startup Finance</span>
                                </div>
                            </div>
                            
                            <div class="flex space-x-3 ml-4">
                                <button class="px-4 py-2 text-white font-medium rounded-lg hover:opacity-90 transition-opacity duration-200" 
                                        style="background-color: #006C5F;">
                                    <i class='bx bx-user-plus mr-2'></i>Add to network
                                </button>
                                <button class="px-4 py-2 border-2 font-medium rounded-lg hover:bg-gray-50 transition-colors duration-200" 
                                        style="border-color: #006C5F; color: #006C5F;">
                                    <i class='bx bx-message-dots mr-2'></i>Message
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- About Section -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-4">About</h2>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            Amina Walker is a mission-driven financial strategist passionate about empowering Black-led startups to secure capital and scale sustainably. With over a decade of experience in financial planning, investment readiness, and startup advisory, she has become a trusted guide for early-stage founders navigating the complex funding landscape.
                        </p>
                        <p class="text-gray-700 leading-relaxed mb-4">
                            She has helped dozens of underrepresented entrepreneurs craft investor-ready financial models, pitch decks, and funding roadmaps. Amina is known for her ability to translate complex numbers into clear strategies, helping visionary leaders make informed, confident decisions about growth.
                        </p>
                        <p class="text-gray-700 leading-relaxed">
                            Before co-founding this platform, Amina worked as a financial consultant for impact-focused VCs and incubators across North America. She's also a former startup founder herself, which gives her deep empathy for the real-world challenges of building a business from scratch.
                        </p>
                    </div>
                </div>

                <!-- Portfolio Section -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-xl font-bold text-gray-900">Portfolio</h2>
                            <div class="flex space-x-1">
                                <button class="px-4 py-2 text-white font-medium rounded-lg text-sm" style="background-color: #006C5F;">
                                    Investments
                                </button>
                                <button class="px-4 py-2 text-gray-600 hover:text-gray-900 font-medium rounded-lg text-sm hover:bg-gray-50">
                                    Past Investments
                                </button>
                                <button class="px-4 py-2 text-gray-600 hover:text-gray-900 font-medium rounded-lg text-sm hover:bg-gray-50">
                                    Events
                                </button>
                            </div>
                        </div>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Investment Card 1 -->
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-start space-x-3 mb-3">
                                    <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center text-white font-bold">
                                        BW
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-gray-900">Black Wealth Builders</h3>
                                        <p class="text-sm text-gray-500">May 13, 2025</p>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600 mb-3">
                                    The Black Wealth Builders Cohort is a guided program that helps first-time investors...
                                </p>
                                <div class="bg-gray-100 rounded-lg h-24 mb-3 overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                         alt="Investment" 
                                         class="w-full h-full object-cover">
                                </div>
                            </div>
                            
                            <!-- Investment Card 2 -->
                            <div class="border border-gray-200 rounded-lg p-4">
                                <div class="flex items-start space-x-3 mb-3">
                                    <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center text-white font-bold">
                                        BW
                                    </div>
                                    <div class="flex-1">
                                        <h3 class="font-semibold text-gray-900">Black Wealth Builders</h3>
                                        <p class="text-sm text-gray-500">May 13, 2025</p>
                                    </div>
                                </div>
                                <p class="text-sm text-gray-600 mb-3">
                                    The Black Wealth Builders Cohort is a guided program that helps first-time investors...
                                </p>
                                <div class="bg-gray-100 rounded-lg h-24 mb-3 overflow-hidden">
                                    <img src="https://images.unsplash.com/photo-1551836022-d5d88e9218df?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                         alt="Investment" 
                                         class="w-full h-full object-cover">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Experience Section -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6">
                        <h2 class="text-xl font-bold text-gray-900 mb-6">Experience</h2>
                        
                        <!-- Experience Item -->
                        <div class="flex space-x-4">
                            <div class="w-12 h-12 bg-gray-200 rounded-lg flex-shrink-0"></div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900">Strategic Communications Consultant</h3>
                                <p class="text-gray-600 mb-2">Walker Strategies Inc.</p>
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <i class='bx bx-calendar mr-2'></i>
                                    <span>Aug 2017 - Dec 2019 · 2 yrs 5 mos</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500 mb-3">
                                    <i class='bx bx-map mr-2'></i>
                                    <span>Vancouver, BC</span>
                                </div>
                                <p class="text-gray-700 text-sm mb-3">
                                    Provided branding, storytelling, and strategic planning for nonprofits and emerging entrepreneurs. Helped clients shape their core message, pitch decks, and digital presence for maximum impact.
                                </p>
                                <ul class="text-sm text-gray-700 space-y-1">
                                    <li>• Developed investor-ready communications for 12 startup clients, contributing to over $3M in combined funding.</li>
                                    <li>• Delivered communications audits and training workshops focused on equity-driven storytelling.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Add to your network</h3>
                        
                        <!-- Network Recommendation 1 -->
                        <div class="flex items-start space-x-3 mb-4">
                            <div class="w-12 h-12 rounded-full overflow-hidden flex-shrink-0">
                                <img src="https://images.unsplash.com/photo-1494790108755-2616b332c1cd?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                     alt="Amina Walker" 
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900">Amina Walker</h4>
                                <p class="text-sm text-gray-600 mb-2">Empowering Black women entrepreneurs through access to...</p>
                                <button class="px-3 py-1 border border-gray-300 text-gray-700 text-sm rounded-lg hover:bg-gray-50 transition-colors">
                                    Add to network
                                </button>
                            </div>
                        </div>
                        
                        <!-- Network Recommendation 2 -->
                        <div class="flex items-start space-x-3 mb-4">
                            <div class="w-12 h-12 rounded-full overflow-hidden flex-shrink-0">
                                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                     alt="Amina Walker" 
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900">Amina Walker</h4>
                                <p class="text-sm text-gray-600 mb-2">Empowering Black women entrepreneurs through access to...</p>
                                <button class="px-3 py-1 border border-gray-300 text-gray-700 text-sm rounded-lg hover:bg-gray-50 transition-colors">
                                    Add to network
                                </button>
                            </div>
                        </div>
                        
                        <!-- Network Recommendation 3 -->
                        <div class="flex items-start space-x-3 mb-4">
                            <div class="w-12 h-12 rounded-full overflow-hidden flex-shrink-0">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                     alt="Amina Walker" 
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900">Amina Walker</h4>
                                <p class="text-sm text-gray-600 mb-2">Empowering Black women entrepreneurs through access to...</p>
                                <button class="px-3 py-1 border border-gray-300 text-gray-700 text-sm rounded-lg hover:bg-gray-50 transition-colors">
                                    Add to network
                                </button>
                            </div>
                        </div>
                        
                        <div class="text-center mt-4">
                            <button class="text-sm font-medium hover:underline" style="color: #006C5F;">
                                View all recommendations →
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
