@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Network</h1>
            <p class="text-gray-600">Connect with professionals and grow your business network</p>
        </div>

        <!-- Search and Filter Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <div class="p-6">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <div class="relative">
                            <i class='bx bx-search absolute left-3 top-3 text-gray-400'></i>
                            <input type="text" 
                                   placeholder="Search professionals, companies, or skills..." 
                                   class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-opacity-50 focus:border-transparent"
                                   style="focus:ring-color: #006C5F;">
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-3">
                        <!-- Industry Dropdown -->
                        <div class="relative" x-data="{ open: false, selected: 'All Industries' }">
                            <button @click="open = !open" 
                                    class="flex items-center justify-between px-4 py-2.5 bg-white border border-gray-300 rounded-lg hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-opacity-50 focus:border-transparent transition-all duration-200 min-w-[160px]"
                                    style="focus:ring-color: #006C5F;">
                                <span class="text-gray-700 font-medium" x-text="selected"></span>
                                <i class='bx bx-chevron-down text-gray-500 transition-transform duration-200' 
                                   :class="{ 'rotate-180': open }"></i>
                            </button>
                            <div x-show="open" 
                                 x-cloak
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 transform scale-95"
                                 x-transition:enter-end="opacity-100 transform scale-100"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 transform scale-100"
                                 x-transition:leave-end="opacity-0 transform scale-95"
                                 class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                                <div class="py-1">
                                    <button @click="selected = 'All Industries'; open = false" 
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                        All Industries
                                    </button>
                                    <button @click="selected = 'Technology'; open = false" 
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                        <i class='bx bx-code-alt mr-2'></i>Technology
                                    </button>
                                    <button @click="selected = 'Finance'; open = false" 
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                        <i class='bx bx-dollar mr-2'></i>Finance
                                    </button>
                                    <button @click="selected = 'Healthcare'; open = false" 
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                        <i class='bx bx-heart mr-2'></i>Healthcare
                                    </button>
                                    <button @click="selected = 'Real Estate'; open = false" 
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                        <i class='bx bx-home mr-2'></i>Real Estate
                                    </button>
                                    <button @click="selected = 'Marketing'; open = false" 
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                        <i class='bx bx-bullhorn mr-2'></i>Marketing
                                    </button>
                                    <button @click="selected = 'Consulting'; open = false" 
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                        <i class='bx bx-briefcase mr-2'></i>Consulting
                                    </button>
                                    <button @click="selected = 'Education'; open = false" 
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                        <i class='bx bx-book mr-2'></i>Education
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Location Dropdown -->
                        <div class="relative" x-data="{ open: false, selected: 'All Locations' }">
                            <button @click="open = !open" 
                                    class="flex items-center justify-between px-4 py-2.5 bg-white border border-gray-300 rounded-lg hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-opacity-50 focus:border-transparent transition-all duration-200 min-w-[160px]"
                                    style="focus:ring-color: #006C5F;">
                                <span class="text-gray-700 font-medium" x-text="selected"></span>
                                <i class='bx bx-chevron-down text-gray-500 transition-transform duration-200' 
                                   :class="{ 'rotate-180': open }"></i>
                            </button>
                            <div x-show="open" 
                                 x-cloak
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 transform scale-95"
                                 x-transition:enter-end="opacity-100 transform scale-100"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 transform scale-100"
                                 x-transition:leave-end="opacity-0 transform scale-95"
                                 class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                                <div class="py-1">
                                    <button @click="selected = 'All Locations'; open = false" 
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                        All Locations
                                    </button>
                                    <button @click="selected = 'Atlanta, GA'; open = false" 
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                        <i class='bx bx-map mr-2'></i>Atlanta, GA
                                    </button>
                                    <button @click="selected = 'Birmingham, UK'; open = false" 
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                        <i class='bx bx-map mr-2'></i>Birmingham, UK
                                    </button>
                                    <button @click="selected = 'New York, NY'; open = false" 
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                        <i class='bx bx-map mr-2'></i>New York, NY
                                    </button>
                                    <button @click="selected = 'Los Angeles, CA'; open = false" 
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                        <i class='bx bx-map mr-2'></i>Los Angeles, CA
                                    </button>
                                    <button @click="selected = 'Chicago, IL'; open = false" 
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                        <i class='bx bx-map mr-2'></i>Chicago, IL
                                    </button>
                                    <button @click="selected = 'San Francisco, CA'; open = false" 
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                        <i class='bx bx-map mr-2'></i>San Francisco, CA
                                    </button>
                                    <button @click="selected = 'Toronto, ON'; open = false" 
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                        <i class='bx bx-map mr-2'></i>Toronto, ON
                                    </button>
                                    <button @click="selected = 'London, UK'; open = false" 
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                        <i class='bx bx-map mr-2'></i>London, UK
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Connection Type Dropdown -->
                        <div class="relative" x-data="{ open: false, selected: 'All Connections' }">
                            <button @click="open = !open" 
                                    class="flex items-center justify-between px-4 py-2.5 bg-white border border-gray-300 rounded-lg hover:border-gray-400 focus:outline-none focus:ring-2 focus:ring-opacity-50 focus:border-transparent transition-all duration-200 min-w-[160px]"
                                    style="focus:ring-color: #006C5F;">
                                <span class="text-gray-700 font-medium" x-text="selected"></span>
                                <i class='bx bx-chevron-down text-gray-500 transition-transform duration-200' 
                                   :class="{ 'rotate-180': open }"></i>
                            </button>
                            <div x-show="open" 
                                 x-cloak
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 transform scale-95"
                                 x-transition:enter-end="opacity-100 transform scale-100"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 transform scale-100"
                                 x-transition:leave-end="opacity-0 transform scale-95"
                                 class="absolute z-10 mt-1 w-full bg-white border border-gray-300 rounded-lg shadow-lg max-h-60 overflow-y-auto">
                                <div class="py-1">
                                    <button @click="selected = 'All Connections'; open = false" 
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                        All Connections
                                    </button>
                                    <button @click="selected = '1st Connections'; open = false" 
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                        <i class='bx bx-user-check mr-2'></i>1st Connections
                                    </button>
                                    <button @click="selected = '2nd Connections'; open = false" 
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                        <i class='bx bx-group mr-2'></i>2nd Connections
                                    </button>
                                    <button @click="selected = '3rd+ Connections'; open = false" 
                                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900 transition-colors">
                                        <i class='bx bx-network-chart mr-2'></i>3rd+ Connections
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <button class="px-6 py-2.5 text-white font-medium rounded-lg hover:opacity-90 transition-opacity shadow-sm flex items-center"
                                style="background-color: #006C5F;">
                            <i class='bx bx-search mr-2'></i>Search
                        </button>
                        
                        <!-- Clear Filters Button -->
                        <button class="px-4 py-2.5 text-gray-600 hover:text-gray-800 font-medium rounded-lg border border-gray-300 hover:bg-gray-50 transition-colors">
                            <i class='bx bx-x mr-2'></i>Clear
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Network Stats -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Your Network</h2>
                        <div class="grid grid-cols-3 gap-4">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900">247</div>
                                <div class="text-sm text-gray-600">Connections</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900">15</div>
                                <div class="text-sm text-gray-600">New This Week</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-gray-900">8</div>
                                <div class="text-sm text-gray-600">Pending Requests</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- People You May Know -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">People You May Know</h2>
                        <div class="space-y-4">
                            <!-- Connection Suggestion 1 -->
                            <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg">
                                <div class="w-16 h-16 rounded-full overflow-hidden flex-shrink-0">
                                    <img src="https://images.unsplash.com/photo-1494790108755-2616b332c1cd?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                         alt="Marcus Johnson" 
                                         class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900">Marcus Johnson</h3>
                                    <p class="text-sm text-gray-600">CEO & Founder at TechFlow Solutions</p>
                                    <p class="text-sm text-gray-500">Atlanta, GA • Technology</p>
                                    <div class="flex items-center text-sm text-gray-500 mt-1">
                                        <i class='bx bx-user mr-1'></i>
                                        <span>5 mutual connections</span>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="px-4 py-2 text-white font-medium rounded-lg hover:opacity-90 transition-opacity"
                                            style="background-color: #006C5F;">
                                        Connect
                                    </button>
                                    <button class="px-4 py-2 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                                        View Profile
                                    </button>
                                </div>
                            </div>

                            <!-- Connection Suggestion 2 -->
                            <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg">
                                <div class="w-16 h-16 rounded-full overflow-hidden flex-shrink-0">
                                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                         alt="Sarah Williams" 
                                         class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900">Sarah Williams</h3>
                                    <p class="text-sm text-gray-600">Investment Director at Growth Capital Partners</p>
                                    <p class="text-sm text-gray-500">New York, NY • Finance</p>
                                    <div class="flex items-center text-sm text-gray-500 mt-1">
                                        <i class='bx bx-user mr-1'></i>
                                        <span>12 mutual connections</span>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="px-4 py-2 text-white font-medium rounded-lg hover:opacity-90 transition-opacity"
                                            style="background-color: #006C5F;">
                                        Connect
                                    </button>
                                    <button class="px-4 py-2 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                                        View Profile
                                    </button>
                                </div>
                            </div>

                            <!-- Connection Suggestion 3 -->
                            <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg">
                                <div class="w-16 h-16 rounded-full overflow-hidden flex-shrink-0">
                                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                         alt="David Thompson" 
                                         class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900">David Thompson</h3>
                                    <p class="text-sm text-gray-600">Senior Product Manager at InnovateLabs</p>
                                    <p class="text-sm text-gray-500">San Francisco, CA • Technology</p>
                                    <div class="flex items-center text-sm text-gray-500 mt-1">
                                        <i class='bx bx-user mr-1'></i>
                                        <span>3 mutual connections</span>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="px-4 py-2 text-white font-medium rounded-lg hover:opacity-90 transition-opacity"
                                            style="background-color: #006C5F;">
                                        Connect
                                    </button>
                                    <button class="px-4 py-2 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                                        View Profile
                                    </button>
                                </div>
                            </div>

                            <!-- Connection Suggestion 4 -->
                            <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg">
                                <div class="w-16 h-16 rounded-full overflow-hidden flex-shrink-0">
                                    <img src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                         alt="Angela Davis" 
                                         class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-semibold text-gray-900">Angela Davis</h3>
                                    <p class="text-sm text-gray-600">Marketing Director at Brand Innovators</p>
                                    <p class="text-sm text-gray-500">Chicago, IL • Marketing</p>
                                    <div class="flex items-center text-sm text-gray-500 mt-1">
                                        <i class='bx bx-user mr-1'></i>
                                        <span>7 mutual connections</span>
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <button class="px-4 py-2 text-white font-medium rounded-lg hover:opacity-90 transition-opacity"
                                            style="background-color: #006C5F;">
                                        Connect
                                    </button>
                                    <button class="px-4 py-2 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">
                                        View Profile
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="text-center mt-6">
                            <button class="text-sm font-medium hover:underline" style="color: #006C5F;">
                                View all suggestions →
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold text-gray-900 mb-4">Recent Network Activity</h2>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0">
                                    <img src="https://images.unsplash.com/photo-1494790108755-2616b332c1cd?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                         alt="Marcus Johnson" 
                                         class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-900">
                                        <span class="font-medium">Marcus Johnson</span> connected with you
                                    </p>
                                    <p class="text-xs text-gray-500">2 hours ago</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0">
                                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                         alt="Sarah Williams" 
                                         class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-900">
                                        <span class="font-medium">Sarah Williams</span> viewed your profile
                                    </p>
                                    <p class="text-xs text-gray-500">1 day ago</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0">
                                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                         alt="David Thompson" 
                                         class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm text-gray-900">
                                        <span class="font-medium">David Thompson</span> sent you a connection request
                                    </p>
                                    <p class="text-xs text-gray-500">2 days ago</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="lg:col-span-1">
                <!-- Quick Actions -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                        <div class="space-y-3">
                            <button class="w-full px-4 py-2 text-left text-gray-700 hover:bg-gray-50 rounded-lg transition-colors flex items-center">
                                <i class='bx bx-user-plus mr-3 text-xl'></i>
                                Import Contacts
                            </button>
                            <button class="w-full px-4 py-2 text-left text-gray-700 hover:bg-gray-50 rounded-lg transition-colors flex items-center">
                                <i class='bx bx-search mr-3 text-xl'></i>
                                Advanced Search
                            </button>
                            <button class="w-full px-4 py-2 text-left text-gray-700 hover:bg-gray-50 rounded-lg transition-colors flex items-center">
                                <i class='bx bx-group mr-3 text-xl'></i>
                                My Connections
                            </button>
                            <button class="w-full px-4 py-2 text-left text-gray-700 hover:bg-gray-50 rounded-lg transition-colors flex items-center">
                                <i class='bx bx-bell mr-3 text-xl'></i>
                                Connection Requests
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Network Insights -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Network Insights</h3>
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Profile Views</span>
                                <span class="text-sm font-medium text-gray-900">42 this week</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Connection Growth</span>
                                <span class="text-sm font-medium text-green-600">+15 this month</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Top Industry</span>
                                <span class="text-sm font-medium text-gray-900">Technology</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Trending Topics -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Trending in Your Network</h3>
                        <div class="space-y-3">
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                <span class="text-sm text-gray-700">#StartupFunding</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                <span class="text-sm text-gray-700">#BlackEntrepreneurs</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
                                <span class="text-sm text-gray-700">#TechInnovation</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-orange-500 rounded-full"></div>
                                <span class="text-sm text-gray-700">#InvestmentOpportunities</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection