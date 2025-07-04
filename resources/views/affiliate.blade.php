@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Featured Investment Opportunity Card -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6 overflow-hidden">
                    <div class="relative h-48">
                        <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80" 
                             alt="Real Estate Investment" 
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black bg-opacity-40"></div>
                        <div class="absolute top-4 left-4 text-white">
                            <h2 class="text-2xl font-bold mb-2">Affiliate Partnership</h2>
                            <p class="text-sm mb-4 max-w-md">
                                Join our affiliate program and earn commissions by connecting Black entrepreneurs with funding opportunities.
                            </p>
                            <button class="px-4 py-2 text-white font-medium rounded-lg hover:opacity-90 transition-opacity"
                                    style="background-color: #006C5F;">
                                Interested
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Search Section -->
                <div class="mb-6">
                    <div class="relative">
                        <i class='bx bx-search absolute left-3 top-3 text-gray-400'></i>
                        <input type="text" 
                               placeholder="Search for opportunities" 
                               class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-opacity-50 focus:border-transparent"
                               style="focus:ring-color: #006C5F;">
                    </div>
                </div>

                <!-- Investment Opportunity Alert -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <div class="flex items-center">
                        <i class='bx bx-bell text-blue-600 mr-3'></i>
                        <div class="flex-1">
                            <span class="text-blue-900 font-medium">Investment opportunity in Texas</span>
                        </div>
                        <button class="px-4 py-2 text-white font-medium rounded-lg"
                                style="background-color: #006C5F;">
                            View all
                        </button>
                    </div>
                </div>

                <!-- Partner Profiles -->
                <div class="space-y-6">
                    <!-- Amina Walker -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <div class="flex items-start space-x-4">
                            <div class="w-16 h-16 rounded-full overflow-hidden flex-shrink-0">
                                <img src="https://images.unsplash.com/photo-1494790108755-2616b332c1cd?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                     alt="Amina Walker" 
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center mb-2">
                                    <h3 class="font-semibold text-gray-900 mr-2">Amina Walker</h3>
                                    <div class="flex items-center text-sm" style="color: #006C5F;">
                                        <i class='bx bx-check-circle mr-1'></i>
                                        <span>Founding Member</span>
                                    </div>
                                </div>
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <i class='bx bx-briefcase mr-2'></i>
                                    <span>Founder & CEO - FemmeFound</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500 mb-3">
                                    <i class='bx bx-map mr-2'></i>
                                    <span>Washington, DC</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    <i class='bx bx-briefcase mr-2'></i>
                                    <span>Portfolio: 50</span>
                                </div>
                                <p class="text-gray-700 text-sm">
                                    Amina Walker is a passionate advocate for the economic empowerment of Black women across the entrepreneurial landscape. With a strong background in finance and community development, Amina has spent the past...
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Kemi Robinson -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <div class="flex items-start space-x-4">
                            <div class="w-16 h-16 rounded-full overflow-hidden flex-shrink-0">
                                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                     alt="Kemi Robinson" 
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center mb-2">
                                    <h3 class="font-semibold text-gray-900 mr-2">Kemi Robinson</h3>
                                    <div class="flex items-center text-sm" style="color: #006C5F;">
                                        <i class='bx bx-check-circle mr-1'></i>
                                        <span>Founding Member</span>
                                    </div>
                                </div>
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <i class='bx bx-briefcase mr-2'></i>
                                    <span>Founder - NourishHer</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500 mb-3">
                                    <i class='bx bx-map mr-2'></i>
                                    <span>Birmingham, UK</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    <i class='bx bx-briefcase mr-2'></i>
                                    <span>Portfolio: 50</span>
                                </div>
                                <p class="text-gray-700 text-sm">
                                    Kemi Robinson is a passionate food-tech entrepreneur on a mission to transform how busy women of color access healthy, culturally resonant meals. With a background in nutrition science and digital innovation, Kemi...
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Chantelle Nkrumah -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <div class="flex items-start space-x-4">
                            <div class="w-16 h-16 rounded-full overflow-hidden flex-shrink-0">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                     alt="Chantelle Nkrumah" 
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center mb-2">
                                    <h3 class="font-semibold text-gray-900 mr-2">Chantelle Nkrumah</h3>
                                    <div class="flex items-center text-sm" style="color: #006C5F;">
                                        <i class='bx bx-check-circle mr-1'></i>
                                        <span>Founding Member</span>
                                    </div>
                                </div>
                                <div class="flex items-center text-sm text-gray-500 mb-2">
                                    <i class='bx bx-briefcase mr-2'></i>
                                    <span>CFO - EquitySpark</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500 mb-3">
                                    <i class='bx bx-map mr-2'></i>
                                    <span>Houston, TX</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    <i class='bx bx-briefcase mr-2'></i>
                                    <span>Portfolio: 50</span>
                                </div>
                                <p class="text-gray-700 text-sm">
                                    Chantelle Nkrumah is a dynamic financial strategist committed to empowering Black-led startups through funding education, smart capital structuring, and sustainable growth planning. With over a decade of experience...
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="lg:col-span-1">
                <!-- Profile Stats -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                    <div class="text-center mb-4">
                        <div class="w-16 h-16 rounded-full overflow-hidden mx-auto mb-3">
                            <img src="https://images.unsplash.com/photo-1494790108755-2616b332c1cd?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                 alt="Amina Walker" 
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="flex items-center justify-center mb-2">
                            <i class='bx bx-check-circle text-sm mr-1' style="color: #006C5F;"></i>
                            <span class="text-sm font-medium" style="color: #006C5F;">Founding Member</span>
                        </div>
                        <h3 class="font-semibold text-gray-900">Amina Walker</h3>
                        <p class="text-sm text-gray-600 mb-2">Empowering Black women entrepreneurs through access to funding and mentorship</p>
                        <div class="flex items-center justify-center text-sm text-gray-500 mb-2">
                            <i class='bx bx-briefcase mr-1'></i>
                            <span>Founder & CEO - FemmeFound</span>
                        </div>
                        <div class="flex items-center justify-center text-sm text-gray-500">
                            <i class='bx bx-map mr-1'></i>
                            <span>Washington, DC</span>
                        </div>
                    </div>
                    
                    <div class="border-t pt-4">
                        <div class="flex justify-between text-sm mb-2">
                            <span class="text-gray-600">Profile viewers</span>
                            <span class="font-medium" style="color: #006C5F;">50</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Portfolios</span>
                            <span class="font-medium" style="color: #006C5F;">3</span>
                        </div>
                    </div>
                </div>

                <!-- Add to Network -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h3 class="font-semibold text-gray-900 mb-4">Add to your network</h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 rounded-full overflow-hidden flex-shrink-0">
                                <img src="https://images.unsplash.com/photo-1494790108755-2616b332c1cd?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                     alt="Amina Walker" 
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-900 text-sm">Amina Walker</h4>
                                <p class="text-xs text-gray-600">Empowering Black women entrepreneurs through access to...</p>
                                <button class="mt-1 px-3 py-1 border border-gray-300 text-gray-700 text-xs rounded-lg hover:bg-gray-50 transition-colors">
                                    Add to network
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 rounded-full overflow-hidden flex-shrink-0">
                                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                     alt="Amina Walker" 
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-900 text-sm">Amina Walker</h4>
                                <p class="text-xs text-gray-600">Empowering Black women entrepreneurs through access to...</p>
                                <button class="mt-1 px-3 py-1 border border-gray-300 text-gray-700 text-xs rounded-lg hover:bg-gray-50 transition-colors">
                                    Add to network
                                </button>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 rounded-full overflow-hidden flex-shrink-0">
                                <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                     alt="Amina Walker" 
                                     class="w-full h-full object-cover">
                            </div>
                            <div class="flex-1">
                                <h4 class="font-medium text-gray-900 text-sm">Amina Walker</h4>
                                <p class="text-xs text-gray-600">Empowering Black women entrepreneurs through access to...</p>
                                <button class="mt-1 px-3 py-1 border border-gray-300 text-gray-700 text-xs rounded-lg hover:bg-gray-50 transition-colors">
                                    Add to network
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-4">
                        <button class="text-sm font-medium hover:underline" style="color: #006C5F;">
                            View all recommemdations →
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection