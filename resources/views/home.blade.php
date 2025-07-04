@extends('layouts.main')

@section('content')
    <!-- Hero Section with Image and Text on Left -->
    <div class="relative mb-16 mt-8">
        <div class="relative h-96 md:h-[500px] lg:h-[600px] mx-4 md:mx-8 lg:mx-16 rounded-2xl overflow-hidden shadow-2xl">
            <!-- Background Image -->
            <img src="https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80"
                alt="Business Team" class="absolute inset-0 w-full h-full object-cover">

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
                        A trusted space to showcase your startup, connect with co-founders, and respond to investment
                        invitations curated by our team.
                    </p>
                    <div class="flex justify-start">
                        <a href="{{ route('network') }}"
                            class="inline-flex items-center px-4 py-2 text-white font-medium rounded-lg hover:opacity-90 transform hover:scale-105 transition-all duration-200 shadow-lg"
                            style="background-color: #006C5F;">
                            <i class='bx bx-network-chart text-sm mr-1'></i>
                            Join Our Network
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Section with Profile Left and Features Right -->
    <div class="container mx-auto px-4 md:px-8 lg:px-16 py-16">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            <!-- Left Side - Profile Section -->
            <div class="bg-gray-50 rounded-2xl p-8 shadow-sm border border-gray-200 h-fit">
                <div class="text-center">
                    <div class="w-20 h-20 mx-auto mb-4 rounded-full overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                             alt="Kemi Robinson" 
                             class="w-full h-full object-cover">
                    </div>
                    
                    <div class="flex items-center justify-center mb-3">
                        <i class='bx bx-star text-yellow-500 text-sm mr-2'></i>
                        <span class="text-sm font-medium" style="color: #006C5F;">Founding Member</span>
                    </div>
                    
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Kemi Robinson</h3>
                    
                    <div class="flex items-center justify-center text-sm text-gray-500 mb-2">
                        <i class='bx bx-briefcase text-sm mr-2'></i>
                        <span>Founder - NourishHer</span>
                    </div>
                    
                    <div class="flex items-center justify-center text-sm text-gray-500 mb-6">
                        <i class='bx bx-map text-sm mr-2'></i>
                        <span>Birmingham, UK</span>
                    </div>
                    
                    <div class="flex justify-center space-x-2 mb-4">
                        <span class="px-3 py-1 bg-gray-200 text-gray-700 text-xs rounded-full">Business</span>
                        <span class="px-3 py-1 bg-gray-200 text-gray-700 text-xs rounded-full">Business</span>
                        <span class="px-3 py-1 bg-gray-200 text-gray-700 text-xs rounded-full">Business</span>
                    </div>
                </div>
            </div>

            <!-- Right Side - Features Content -->
            <div>
                <div class="mb-12">
                    <h2 class="text-4xl md:text-4xl font-bold text-gray-900 mb-4">
                        Connect. Build. Grow. — All in One Place
                    </h2>
                </div>

                <div class="space-y-8">
                    <!-- Discover Aligned Founders -->
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0"
                            style="background-color: #006C5F;">
                            <i class='bx bx-search text-white text-xl'></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Discover Aligned Founders</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Find partners with shared goals and complementary skills
                            </p>
                        </div>
                    </div>

                    <!-- Opportunity Alerts -->
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0"
                            style="background-color: #006C5F;">
                            <i class='bx bx-bell text-white text-xl'></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Opportunity Alerts</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Get notified when admin shares investor or collaboration offers
                            </p>
                        </div>
                    </div>

                    <!-- Track and RSVP to Events -->
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0"
                            style="background-color: #006C5F;">
                            <i class='bx bx-calendar text-white text-xl'></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Track and RSVP to Events</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Stay updated on events around the globe
                            </p>
                        </div>
                    </div>

                    <!-- Community-Focused -->
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center flex-shrink-0"
                            style="background-color: #006C5F;">
                            <i class='bx bx-group text-white text-xl'></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Community-Focused</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Uplifting Black entrepreneurs and global changemakers
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 flex flex-col sm:flex-row gap-3">
                    <a href="{{ route('network') }}"
                        class="inline-flex items-center justify-center px-4 py-2 text-white text-sm font-medium rounded-lg hover:opacity-90 transition-opacity duration-200"
                        style="background-color: #006C5F;">
                        <i class='bx bx-user-plus text-sm mr-1'></i>
                        Sign up for free
                    </a>
                    <a href="{{ route('about') }}"
                        class="inline-flex items-center justify-center px-4 py-2 border-2 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors duration-200"
                        style="border-color: #006C5F; color: #006C5F;">
                        <i class='bx bx-info-circle text-sm mr-1'></i>
                        Learn how it works
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Meet the Visionaries Section -->
    <div class="container mx-auto px-4 md:px-8 lg:px-16 py-16">
        <div class="mb-12">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Meet the Visionaries Behind Our Network</h2>
            <p class="text-lg text-gray-600 mb-4">Get to know the Founders? <a href="{{ route('network') }}" class="font-semibold" style="color: #006C5F;">Explore all</a></p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Founder 1 - Kemi Robinson -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="relative h-48 bg-gradient-to-br from-gray-100 to-gray-200">
                    <img src="https://images.unsplash.com/photo-1515187029135-18ee286d815b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                         alt="Business Event" 
                         class="w-full h-full object-cover opacity-80">
                    <div class="absolute bottom-4 left-4">
                        <div class="w-16 h-16 rounded-full overflow-hidden border-4 border-white shadow-lg">
                            <img src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                 alt="Kemi Robinson" 
                                 class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-3">
                        <i class='bx bx-check-circle text-sm mr-2' style="color: #006C5F;"></i>
                        <span class="text-sm font-medium" style="color: #006C5F;">Founding Member</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Kemi Robinson</h3>
                    <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                        Building a food-tech platform focused on healthy meals for busy women of color.
                    </p>
                    <div class="flex items-center text-sm text-gray-500 mb-2">
                        <i class='bx bx-briefcase text-sm mr-2'></i>
                        <span>Founder - NourishHer</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-500 mb-6">
                        <i class='bx bx-map text-sm mr-2'></i>
                        <span>Birmingham, UK</span>
                    </div>
                    <a href="{{ route('network') }}" 
                       class="w-full inline-flex items-center justify-center px-4 py-2 text-white text-sm font-medium rounded-lg hover:opacity-90 transition-opacity duration-200"
                       style="background-color: #006C5F;">
                        View Profile
                    </a>
                </div>
            </div>

            <!-- Founder 2 - Chantelle Nkrumah -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="relative h-48 bg-gradient-to-br from-gray-100 to-gray-200">
                    <img src="https://images.unsplash.com/photo-1515187029135-18ee286d815b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                         alt="Business Meeting" 
                         class="w-full h-full object-cover opacity-80">
                    <div class="absolute bottom-4 left-4">
                        <div class="w-16 h-16 rounded-full overflow-hidden border-4 border-white shadow-lg">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                 alt="Chantelle Nkrumah" 
                                 class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-3">
                        <i class='bx bx-check-circle text-sm mr-2' style="color: #006C5F;"></i>
                        <span class="text-sm font-medium" style="color: #006C5F;">Founding Member</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Chantelle Nkrumah</h3>
                    <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                        Helping Black-led startups secure funding through smart financial planning.
                    </p>
                    <div class="flex items-center text-sm text-gray-500 mb-2">
                        <i class='bx bx-briefcase text-sm mr-2'></i>
                        <span>CFO - EquitySpark</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-500 mb-6">
                        <i class='bx bx-map text-sm mr-2'></i>
                        <span>Houston, TX</span>
                    </div>
                    <a href="{{ route('network') }}" 
                       class="w-full inline-flex items-center justify-center px-4 py-2 text-white text-sm font-medium rounded-lg hover:opacity-90 transition-opacity duration-200"
                       style="background-color: #006C5F;">
                        View Profile
                    </a>
                </div>
            </div>

            <!-- Founder 3 - Amina Walker -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden">
                <div class="relative h-48 bg-gradient-to-br from-gray-100 to-gray-200">
                    <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                         alt="Professional Event" 
                         class="w-full h-full object-cover opacity-80">
                    <div class="absolute bottom-4 left-4">
                        <div class="w-16 h-16 rounded-full overflow-hidden border-4 border-white shadow-lg">
                            <img src="https://images.unsplash.com/photo-1488508872907-592763824245?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                 alt="Amina Walker" 
                                 class="w-full h-full object-cover">
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-3">
                        <i class='bx bx-check-circle text-sm mr-2' style="color: #006C5F;"></i>
                        <span class="text-sm font-medium" style="color: #006C5F;">Founding Member</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Amina Walker</h3>
                    <p class="text-gray-600 text-sm mb-4 leading-relaxed">
                        Empowering Black women entrepreneurs through access to funding and mentorship.
                    </p>
                    <div class="flex items-center text-sm text-gray-500 mb-2">
                        <i class='bx bx-briefcase text-sm mr-2'></i>
                        <span>Founder & CEO - FemmeFound</span>
                    </div>
                    <div class="flex items-center text-sm text-gray-500 mb-6">
                        <i class='bx bx-map text-sm mr-2'></i>
                        <span>Washington, D.C.</span>
                    </div>
                    <a href="{{ route('network') }}" 
                       class="w-full inline-flex items-center justify-center px-4 py-2 text-white text-sm font-medium rounded-lg hover:opacity-90 transition-opacity duration-200"
                       style="background-color: #006C5F;">
                        View Profile
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="container mx-auto px-4 md:px-8 lg:px-16 py-16">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Frequently asked questions</h2>
                <p class="text-lg text-gray-600">Everything you need to know about Embiz.</p>
            </div>

            <div class="space-y-4">
                <!-- FAQ Item 1 -->
                <div class="border border-gray-200 rounded-lg">
                    <button class="w-full px-6 py-4 text-left focus:outline-none" 
                            onclick="toggleFAQ('faq1')">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">What is Embiz?</h3>
                            <i class='bx bx-minus text-xl' style="color: #006C5F;" id="faq1-icon"></i>
                        </div>
                    </button>
                    <div id="faq1" class="px-6 pb-4">
                        <p class="text-gray-600 leading-relaxed">
                            Embiz is a micro-lending platform that provides quick and easy access to small loans for individuals and entrepreneurs. Our user-friendly app allows you to apply for, receive, and manage loans seamlessly.
                        </p>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="border border-gray-200 rounded-lg">
                    <button class="w-full px-6 py-4 text-left focus:outline-none" 
                            onclick="toggleFAQ('faq2')">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">How do I apply for a loan?</h3>
                            <i class='bx bx-plus text-xl' style="color: #006C5F;" id="faq2-icon"></i>
                        </div>
                    </button>
                    <div id="faq2" class="px-6 pb-4 hidden">
                        <p class="text-gray-600 leading-relaxed">
                            Simply download our app, create an account, and follow the step-by-step application process. You'll need to provide basic information about yourself and your financial situation. The entire process can be completed in minutes.
                        </p>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="border border-gray-200 rounded-lg">
                    <button class="w-full px-6 py-4 text-left focus:outline-none" 
                            onclick="toggleFAQ('faq3')">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">How long does it take to get approved?</h3>
                            <i class='bx bx-plus text-xl' style="color: #006C5F;" id="faq3-icon"></i>
                        </div>
                    </button>
                    <div id="faq3" class="px-6 pb-4 hidden">
                        <p class="text-gray-600 leading-relaxed">
                            Most applications are processed within 24-48 hours. Once approved, funds are typically transferred to your account within 1-3 business days, depending on your bank's processing time.
                        </p>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="border border-gray-200 rounded-lg">
                    <button class="w-full px-6 py-4 text-left focus:outline-none" 
                            onclick="toggleFAQ('faq4')">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">What types of loans do you offer?</h3>
                            <i class='bx bx-plus text-xl' style="color: #006C5F;" id="faq4-icon"></i>
                        </div>
                    </button>
                    <div id="faq4" class="px-6 pb-4 hidden">
                        <p class="text-gray-600 leading-relaxed">
                            We offer personal loans, business loans, and emergency funding. Loan amounts typically range from $500 to $50,000, depending on your creditworthiness and financial profile.
                        </p>
                    </div>
                </div>

                <!-- FAQ Item 5 -->
                <div class="border border-gray-200 rounded-lg">
                    <button class="w-full px-6 py-4 text-left focus:outline-none" 
                            onclick="toggleFAQ('faq5')">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">How much can I borrow?</h3>
                            <i class='bx bx-plus text-xl' style="color: #006C5F;" id="faq5-icon"></i>
                        </div>
                    </button>
                    <div id="faq5" class="px-6 pb-4 hidden">
                        <p class="text-gray-600 leading-relaxed">
                            Loan amounts vary based on your income, credit score, and repayment capacity. First-time borrowers typically qualify for $500-$5,000, while established customers may access larger amounts up to $50,000.
                        </p>
                    </div>
                </div>

                <!-- FAQ Item 6 -->
                <div class="border border-gray-200 rounded-lg">
                    <button class="w-full px-6 py-4 text-left focus:outline-none" 
                            onclick="toggleFAQ('faq6')">
                        <div class="flex items-center justify-between">
                            <h3 class="text-lg font-semibold text-gray-900">How can I contact customer support?</h3>
                            <i class='bx bx-plus text-xl' style="color: #006C5F;" id="faq6-icon"></i>
                        </div>
                    </button>
                    <div id="faq6" class="px-6 pb-4 hidden">
                        <p class="text-gray-600 leading-relaxed">
                            You can reach our customer support team through the in-app chat feature, email us at support@embiz.com, or call our helpline at 1-800-EMBIZ-HELP. We're available Monday through Friday, 8 AM to 8 PM EST.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="container mx-auto px-4 md:px-8 lg:px-16 py-16">
        <div class="rounded-3xl p-12 text-center text-white" style="background: linear-gradient(135deg, #006C5F, #00857A);">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Ready to Transform Your Business?</h2>
            <p class="text-lg md:text-xl mb-8 opacity-90 max-w-2xl mx-auto">
                Join thousands of successful entrepreneurs and businesses already growing with EmbizLive
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('network') }}" 
                   class="inline-flex items-center px-4 py-2 bg-white text-sm font-medium rounded-lg hover:bg-gray-100 transition-colors duration-200"
                   style="color: #006C5F;">
                    Start Your Journey
                </a>
                <a href="{{ route('messages') }}" 
                   class="inline-flex items-center px-4 py-2 bg-black/20 text-white text-sm font-medium rounded-lg hover:bg-black/30 transition-colors duration-200">
                    Connect Today
                </a>
            </div>
        </div>
    </div>

    <script>
        function toggleFAQ(faqId) {
            const content = document.getElementById(faqId);
            const icon = document.getElementById(faqId + '-icon');
            
            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                icon.classList.remove('bx-plus');
                icon.classList.add('bx-minus');
            } else {
                content.classList.add('hidden');
                icon.classList.remove('bx-minus');
                icon.classList.add('bx-plus');
            }
        }
    </script>
@endsection
