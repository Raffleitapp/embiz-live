@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <!-- Profile Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <div class="relative h-48 bg-gradient-to-r from-gray-100 to-gray-200 rounded-t-lg">
                <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" 
                     alt="Cover" 
                     class="w-full h-full object-cover rounded-t-lg opacity-60">
                <div class="absolute bottom-6 left-6">
                    <div class="flex items-end space-x-4">
                        <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-white shadow-lg">
                            <img src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                 alt="Profile" 
                                 class="w-full h-full object-cover">
                        </div>
                        <div class="text-white mb-2">
                            <h1 class="text-3xl font-bold">Leon Johnson</h1>
                            <p class="text-lg opacity-90">Founder & CEO</p>
                        </div>
                    </div>
                </div>
                <div class="absolute top-6 right-6">
                    <button class="bg-white/90 hover:bg-white text-gray-800 px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                        <i class='bx bx-edit-alt mr-2'></i>Edit Profile
                    </button>
                </div>
            </div>
        </div>

        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Left Sidebar - Profile Info -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Profile Information</h2>
                    
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background-color: #006C5F;">
                                <i class='bx bx-briefcase text-white'></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Company</p>
                                <p class="font-semibold text-gray-900">TechVenture Labs</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background-color: #006C5F;">
                                <i class='bx bx-map text-white'></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Location</p>
                                <p class="font-semibold text-gray-900">Atlanta, GA</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background-color: #006C5F;">
                                <i class='bx bx-calendar text-white'></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Member Since</p>
                                <p class="font-semibold text-gray-900">January 2025</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background-color: #006C5F;">
                                <i class='bx bx-envelope text-white'></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Email</p>
                                <p class="font-semibold text-gray-900">leon@techventure.com</p>
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background-color: #006C5F;">
                                <i class='bx bx-phone text-white'></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Phone</p>
                                <p class="font-semibold text-gray-900">+1 (555) 123-4567</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Skills & Interests -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Skills & Interests</h2>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-3 py-1 text-sm rounded-full text-white" style="background-color: #006C5F;">Technology</span>
                        <span class="px-3 py-1 bg-gray-200 text-gray-700 text-sm rounded-full">Real Estate</span>
                        <span class="px-3 py-1 bg-gray-200 text-gray-700 text-sm rounded-full">Fintech</span>
                        <span class="px-3 py-1 bg-gray-200 text-gray-700 text-sm rounded-full">Investment</span>
                        <span class="px-3 py-1 bg-gray-200 text-gray-700 text-sm rounded-full">Mentoring</span>
                        <span class="px-3 py-1 bg-gray-200 text-gray-700 text-sm rounded-full">Blockchain</span>
                        <span class="px-3 py-1 bg-gray-200 text-gray-700 text-sm rounded-full">AI/ML</span>
                    </div>
                </div>

                <!-- Stats -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Activity Stats</h2>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Investment Opportunities</span>
                            <span class="font-semibold text-gray-900">12</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Active Applications</span>
                            <span class="font-semibold text-gray-900">3</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Network Connections</span>
                            <span class="font-semibold text-gray-900">45</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Events Attended</span>
                            <span class="font-semibold text-gray-900">8</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Content - Main Profile Content -->
            <div class="lg:col-span-2">
                <!-- About Section -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">About</h2>
                    <p class="text-gray-700 leading-relaxed mb-4">
                        Passionate entrepreneur with over 10 years of experience in technology and startup ecosystem. 
                        Founded TechVenture Labs to bridge the gap between innovative ideas and market success. 
                        Dedicated to supporting Black entrepreneurs and fostering inclusive innovation.
                    </p>
                    <p class="text-gray-700 leading-relaxed">
                        Currently focused on fintech solutions that democratize access to financial services and investment opportunities. 
                        Actively seeking collaborative partnerships and mentorship opportunities within the EmbizLive community.
                    </p>
                </div>

                <!-- Experience Section -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Experience</h2>
                    <div class="space-y-6">
                        <div class="border-l-4 pl-4" style="border-left-color: #006C5F;">
                            <h3 class="text-lg font-semibold text-gray-900">Founder & CEO</h3>
                            <p class="text-gray-600">TechVenture Labs • 2020 - Present</p>
                            <p class="text-gray-700 mt-2">
                                Leading a technology incubator focused on early-stage fintech and blockchain startups. 
                                Successfully launched 12 companies with a combined valuation of $50M.
                            </p>
                        </div>
                        
                        <div class="border-l-4 border-gray-300 pl-4">
                            <h3 class="text-lg font-semibold text-gray-900">Senior Product Manager</h3>
                            <p class="text-gray-600">InnovateFinance • 2018 - 2020</p>
                            <p class="text-gray-700 mt-2">
                                Led product development for mobile banking solutions serving underbanked communities. 
                                Grew user base from 10K to 500K users in 18 months.
                            </p>
                        </div>
                        
                        <div class="border-l-4 border-gray-300 pl-4">
                            <h3 class="text-lg font-semibold text-gray-900">Software Engineer</h3>
                            <p class="text-gray-600">TechCorp • 2016 - 2018</p>
                            <p class="text-gray-700 mt-2">
                                Developed scalable backend systems for financial applications. 
                                Specialized in payment processing and fraud detection systems.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Recent Activity</h2>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0" style="background-color: #006C5F;">
                                <i class='bx bx-check text-white text-sm'></i>
                            </div>
                            <div>
                                <p class="text-gray-900 font-medium">Applied to Real Estate Investment Cohort</p>
                                <p class="text-gray-600 text-sm">2 days ago</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0" style="background-color: #006C5F;">
                                <i class='bx bx-calendar text-white text-sm'></i>
                            </div>
                            <div>
                                <p class="text-gray-900 font-medium">Attended "Tech Founders Networking" event</p>
                                <p class="text-gray-600 text-sm">1 week ago</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0" style="background-color: #006C5F;">
                                <i class='bx bx-user-plus text-white text-sm'></i>
                            </div>
                            <div>
                                <p class="text-gray-900 font-medium">Connected with 3 new founders</p>
                                <p class="text-gray-600 text-sm">2 weeks ago</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0" style="background-color: #006C5F;">
                                <i class='bx bx-message text-white text-sm'></i>
                            </div>
                            <div>
                                <p class="text-gray-900 font-medium">Received invitation to Black Tech Scale-Up Program</p>
                                <p class="text-gray-600 text-sm">3 weeks ago</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Investment Interests -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">Investment Interests</h2>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background-color: #006C5F;">
                                    <i class='bx bx-home text-white'></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">Real Estate</h3>
                                    <p class="text-sm text-gray-600">Buy & Hold Strategy</p>
                                </div>
                            </div>
                            <p class="text-sm text-gray-700">
                                Interested in residential and commercial real estate investments with strong cash flow potential.
                            </p>
                        </div>
                        
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background-color: #006C5F;">
                                    <i class='bx bx-code-alt text-white'></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">Tech Startups</h3>
                                    <p class="text-sm text-gray-600">Early Stage</p>
                                </div>
                            </div>
                            <p class="text-sm text-gray-700">
                                Focusing on fintech, blockchain, and AI/ML startups with social impact potential.
                            </p>
                        </div>
                        
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background-color: #006C5F;">
                                    <i class='bx bx-group text-white'></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">Community</h3>
                                    <p class="text-sm text-gray-600">Social Impact</p>
                                </div>
                            </div>
                            <p class="text-sm text-gray-700">
                                Supporting Black-owned businesses and community development initiatives.
                            </p>
                        </div>
                        
                        <div class="border border-gray-200 rounded-lg p-4">
                            <div class="flex items-center space-x-3 mb-3">
                                <div class="w-10 h-10 rounded-full flex items-center justify-center" style="background-color: #006C5F;">
                                    <i class='bx bx-trending-up text-white'></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900">Growth Capital</h3>
                                    <p class="text-sm text-gray-600">Scale-Up Stage</p>
                                </div>
                            </div>
                            <p class="text-sm text-gray-700">
                                Providing growth capital to established businesses ready to scale operations.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
