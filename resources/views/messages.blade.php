@extends('layouts.main')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-7xl mx-auto">
        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Left Sidebar - Messages List -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 h-full">
                    <!-- Messages Header -->
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex items-center justify-between mb-4">
                            <h1 class="text-2xl font-bold text-gray-900">Messages</h1>
                            <button class="text-gray-400 hover:text-gray-600">
                                <i class='bx bx-dots-horizontal-rounded text-xl'></i>
                            </button>
                        </div>
                        
                        <!-- Search Bar -->
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class='bx bx-search text-gray-400'></i>
                            </div>
                            <input type="text" 
                                   class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg text-sm placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-opacity-50 focus:border-transparent" 
                                   style="focus:ring-color: #006C5F;" 
                                   placeholder="Search for founders">
                        </div>
                    </div>

                    <!-- Messages List -->
                    <div class="divide-y divide-gray-200">
                        <!-- Message Item 1 -->
                        <div class="p-4 hover:bg-gray-50 cursor-pointer" onclick="selectMessage(1)">
                            <div class="flex items-start space-x-3">
                                <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0">
                                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                         alt="Profile" 
                                         class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-sm font-semibold text-gray-900 truncate">Elevate Capital Sprint</h3>
                                        <span class="text-xs text-gray-500">May 12, 2025</span>
                                    </div>
                                    <p class="text-xs text-gray-600 mt-1 line-clamp-2">
                                        Elevate Capital Sprint is a fast-track investment program targeting scalable...
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Message Item 2 - Selected -->
                        <div class="p-4 bg-gray-50 border-r-2 cursor-pointer" style="border-right-color: #006C5F;" onclick="selectMessage(2)">
                            <div class="flex items-start space-x-3">
                                <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0">
                                    <img src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                         alt="Profile" 
                                         class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-sm font-semibold text-gray-900 truncate">Black Wealth Builders</h3>
                                        <span class="text-xs text-gray-500">May 13, 2025</span>
                                    </div>
                                    <p class="text-xs text-gray-600 mt-1 line-clamp-2">
                                        The Black Wealth Builders Cohort is a guided program that helps first-time investors...
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Message Item 3 -->
                        <div class="p-4 hover:bg-gray-50 cursor-pointer" onclick="selectMessage(3)">
                            <div class="flex items-start space-x-3">
                                <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0">
                                    <img src="https://images.unsplash.com/photo-1488508872907-592763824245?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                         alt="Profile" 
                                         class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-sm font-semibold text-gray-900 truncate">Global Property Acc...</h3>
                                        <span class="text-xs text-gray-500">May 12, 2025</span>
                                    </div>
                                    <p class="text-xs text-gray-600 mt-1 line-clamp-2">
                                        For those looking to invest in their roots or expand their portfolio the Global Property...
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Message Item 4 -->
                        <div class="p-4 hover:bg-gray-50 cursor-pointer" onclick="selectMessage(4)">
                            <div class="flex items-start space-x-3">
                                <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0">
                                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                         alt="Profile" 
                                         class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-sm font-semibold text-gray-900 truncate">First-Time Homeown...</h3>
                                        <span class="text-xs text-gray-500">May 12, 2025</span>
                                    </div>
                                    <p class="text-xs text-gray-600 mt-1 line-clamp-2">
                                        Buying your first home can feel out of reach this program was designed to close the...
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Message Item 5 -->
                        <div class="p-4 hover:bg-gray-50 cursor-pointer" onclick="selectMessage(5)">
                            <div class="flex items-start space-x-3">
                                <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0">
                                    <img src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                         alt="Profile" 
                                         class="w-full h-full object-cover">
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-sm font-semibold text-gray-900 truncate">Black Tech Scale-Up...</h3>
                                        <span class="text-xs text-gray-500">May 12, 2025</span>
                                    </div>
                                    <p class="text-xs text-gray-600 mt-1 line-clamp-2">
                                        The Horizon VC Scale-Up Program was created to bridge the funding gap for...
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Side - Message Detail -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 h-full">
                    <!-- Message Header -->
                    <div class="p-6 border-b border-gray-200" id="message-header">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2" id="message-title">Real Estate Investment Cohort (Buy & Hold)</h2>
                        <p class="text-sm text-gray-600 mb-4" id="message-source">Announcement from Embiz</p>
                        <p class="text-sm text-gray-500" id="message-date">May 13, 2025</p>
                    </div>

                    <!-- Message Content -->
                    <div class="p-6" id="message-content">
                        <!-- Sender Info -->
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="w-10 h-10 rounded-full overflow-hidden flex-shrink-0">
                                <img src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                                     alt="Embiz Admin" 
                                     class="w-full h-full object-cover"
                                     id="sender-avatar">
                            </div>
                            <div>
                                <div class="flex items-center space-x-2">
                                    <h3 class="font-semibold text-gray-900" id="sender-name">Embiz Admin</h3>
                                    <span class="px-2 py-1 bg-gray-100 text-xs font-medium text-gray-700 rounded" id="sender-badge">APP</span>
                                    <span class="text-sm text-gray-500" id="sender-time">4:56 AM</span>
                                </div>
                                <p class="text-sm text-gray-600" id="sender-greeting">Hi Leon,</p>
                            </div>
                        </div>

                        <!-- Message Details -->
                        <div class="space-y-4" id="message-details">
                            <div>
                                <p class="text-sm text-gray-700 mb-2"><strong>Type:</strong> Group Investment & Mentorship</p>
                                <p class="text-sm text-gray-700 mb-2"><strong>Funding Amount:</strong> $5,000-$15,000 (pooled investment)</p>
                                <p class="text-sm text-gray-700 mb-2"><strong>Application Deadline:</strong> September 15, 2025</p>
                                <p class="text-sm text-gray-700 mb-4"><strong>Eligibility Criteria:</strong></p>
                                <ul class="text-sm text-gray-700 space-y-1 mb-4">
                                    <li>• Black professionals or entrepreneurs looking to get into real estate</li>
                                    <li>• Willing to invest collaboratively with other vetted members</li>
                                    <li>• Strong financial standing (credit score 650+)</li>
                                    <li>• Interest in learning real estate fundamentals</li>
                                </ul>
                            </div>

                            <div>
                                <p class="text-sm text-gray-700 mb-2"><strong>Opportunity Description:</strong></p>
                                <p class="text-sm text-gray-700 mb-4">
                                    The Black Wealth Builders Cohort is a guided program that helps first-time investors co-own income-generating rental properties in growing markets. You'll learn everything from property analysis to closing deals — and then own equity in a property that earns monthly rental income.
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-700 mb-2"><strong>Investment includes:</strong></p>
                                <ul class="text-sm text-gray-700 space-y-1 mb-6">
                                    <li>• Property sourcing and deal walkthroughs</li>
                                    <li>• Group legal setup (LLC or joint structure)</li>
                                    <li>• Risk education: vacancies, maintenance, market trends</li>
                                    <li>• Coaching from Black real estate investors with 10+ years experience</li>
                                </ul>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex space-x-4">
                                <button class="px-6 py-2 text-white font-medium rounded-lg hover:opacity-90 transition-opacity duration-200" 
                                        style="background-color: #006C5F;">
                                    INTERESTED
                                </button>
                                <button class="px-6 py-2 border-2 font-medium rounded-lg hover:bg-gray-50 transition-colors duration-200" 
                                        style="border-color: #006C5F; color: #006C5F;">
                                    NOT INTERESTED
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Message data
const messages = {
    1: {
        title: "Elevate Capital Sprint",
        source: "Investment Opportunity",
        date: "May 12, 2025",
        senderName: "Embiz Admin",
        senderBadge: "APP",
        senderTime: "3:22 AM",
        senderGreeting: "Hi Leon,",
        senderAvatar: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
        content: `
            <div>
                <p class="text-sm text-gray-700 mb-2"><strong>Type:</strong> Fast-Track Investment Program</p>
                <p class="text-sm text-gray-700 mb-2"><strong>Funding Amount:</strong> $10,000-$50,000 (individual investment)</p>
                <p class="text-sm text-gray-700 mb-2"><strong>Application Deadline:</strong> August 30, 2025</p>
                <p class="text-sm text-gray-700 mb-4"><strong>Eligibility Criteria:</strong></p>
                <ul class="text-sm text-gray-700 space-y-1 mb-4">
                    <li>• Tech entrepreneurs with scalable business models</li>
                    <li>• Minimum viable product (MVP) completed</li>
                    <li>• Strong market validation and user traction</li>
                    <li>• Commitment to 6-month accelerator program</li>
                </ul>
            </div>
            <div>
                <p class="text-sm text-gray-700 mb-2"><strong>Opportunity Description:</strong></p>
                <p class="text-sm text-gray-700 mb-4">
                    Elevate Capital Sprint is a fast-track investment program targeting scalable tech startups. Get funding, mentorship, and network access to accelerate your business growth in record time.
                </p>
            </div>
            <div>
                <p class="text-sm text-gray-700 mb-2"><strong>Program includes:</strong></p>
                <ul class="text-sm text-gray-700 space-y-1 mb-6">
                    <li>• Direct investment and funding opportunities</li>
                    <li>• 1-on-1 mentorship with successful entrepreneurs</li>
                    <li>• Access to investor networks and demo days</li>
                    <li>• Business development and scaling workshops</li>
                </ul>
            </div>
        `
    },
    2: {
        title: "Real Estate Investment Cohort (Buy & Hold)",
        source: "Announcement from Embiz",
        date: "May 13, 2025",
        senderName: "Embiz Admin",
        senderBadge: "APP",
        senderTime: "4:56 AM",
        senderGreeting: "Hi Leon,",
        senderAvatar: "https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
        content: `
            <div>
                <p class="text-sm text-gray-700 mb-2"><strong>Type:</strong> Group Investment & Mentorship</p>
                <p class="text-sm text-gray-700 mb-2"><strong>Funding Amount:</strong> $5,000-$15,000 (pooled investment)</p>
                <p class="text-sm text-gray-700 mb-2"><strong>Application Deadline:</strong> September 15, 2025</p>
                <p class="text-sm text-gray-700 mb-4"><strong>Eligibility Criteria:</strong></p>
                <ul class="text-sm text-gray-700 space-y-1 mb-4">
                    <li>• Black professionals or entrepreneurs looking to get into real estate</li>
                    <li>• Willing to invest collaboratively with other vetted members</li>
                    <li>• Strong financial standing (credit score 650+)</li>
                    <li>• Interest in learning real estate fundamentals</li>
                </ul>
            </div>
            <div>
                <p class="text-sm text-gray-700 mb-2"><strong>Opportunity Description:</strong></p>
                <p class="text-sm text-gray-700 mb-4">
                    The Black Wealth Builders Cohort is a guided program that helps first-time investors co-own income-generating rental properties in growing markets. You'll learn everything from property analysis to closing deals — and then own equity in a property that earns monthly rental income.
                </p>
            </div>
            <div>
                <p class="text-sm text-gray-700 mb-2"><strong>Investment includes:</strong></p>
                <ul class="text-sm text-gray-700 space-y-1 mb-6">
                    <li>• Property sourcing and deal walkthroughs</li>
                    <li>• Group legal setup (LLC or joint structure)</li>
                    <li>• Risk education: vacancies, maintenance, market trends</li>
                    <li>• Coaching from Black real estate investors with 10+ years experience</li>
                </ul>
            </div>
        `
    },
    3: {
        title: "Global Property Investment Accelerator",
        source: "International Opportunity",
        date: "May 12, 2025",
        senderName: "Embiz Admin",
        senderBadge: "APP",
        senderTime: "2:15 PM",
        senderGreeting: "Hi Leon,",
        senderAvatar: "https://images.unsplash.com/photo-1488508872907-592763824245?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
        content: `
            <div>
                <p class="text-sm text-gray-700 mb-2"><strong>Type:</strong> International Real Estate Investment</p>
                <p class="text-sm text-gray-700 mb-2"><strong>Funding Amount:</strong> $25,000-$100,000 (individual investment)</p>
                <p class="text-sm text-gray-700 mb-2"><strong>Application Deadline:</strong> October 1, 2025</p>
                <p class="text-sm text-gray-700 mb-4"><strong>Eligibility Criteria:</strong></p>
                <ul class="text-sm text-gray-700 space-y-1 mb-4">
                    <li>• Experienced investors looking to diversify globally</li>
                    <li>• Minimum $25,000 investment capacity</li>
                    <li>• Understanding of international market risks</li>
                    <li>• Interest in emerging markets and cultural heritage properties</li>
                </ul>
            </div>
            <div>
                <p class="text-sm text-gray-700 mb-2"><strong>Opportunity Description:</strong></p>
                <p class="text-sm text-gray-700 mb-4">
                    For those looking to invest in their roots or expand their portfolio, the Global Property Accelerator offers opportunities in emerging markets across Africa, the Caribbean, and other diaspora-focused regions.
                </p>
            </div>
            <div>
                <p class="text-sm text-gray-700 mb-2"><strong>Investment includes:</strong></p>
                <ul class="text-sm text-gray-700 space-y-1 mb-6">
                    <li>• Direct property ownership in emerging markets</li>
                    <li>• Local market research and due diligence</li>
                    <li>• Legal and regulatory guidance</li>
                    <li>• Cultural heritage and community impact projects</li>
                </ul>
            </div>
        `
    },
    4: {
        title: "First-Time Homeowner Program",
        source: "Housing Initiative",
        date: "May 12, 2025",
        senderName: "Embiz Admin",
        senderBadge: "APP",
        senderTime: "11:30 AM",
        senderGreeting: "Hi Leon,",
        senderAvatar: "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
        content: `
            <div>
                <p class="text-sm text-gray-700 mb-2"><strong>Type:</strong> First-Time Homebuyer Support</p>
                <p class="text-sm text-gray-700 mb-2"><strong>Funding Amount:</strong> $2,000-$10,000 (down payment assistance)</p>
                <p class="text-sm text-gray-700 mb-2"><strong>Application Deadline:</strong> December 31, 2025</p>
                <p class="text-sm text-gray-700 mb-4"><strong>Eligibility Criteria:</strong></p>
                <ul class="text-sm text-gray-700 space-y-1 mb-4">
                    <li>• First-time homebuyers in underserved communities</li>
                    <li>• Stable income and employment history</li>
                    <li>• Completion of homebuyer education course</li>
                    <li>• Commitment to homeownership for minimum 5 years</li>
                </ul>
            </div>
            <div>
                <p class="text-sm text-gray-700 mb-2"><strong>Opportunity Description:</strong></p>
                <p class="text-sm text-gray-700 mb-4">
                    Buying your first home can feel out of reach - this program was designed to close the gap between aspiration and reality. Get down payment assistance, education, and ongoing support through your homeownership journey.
                </p>
            </div>
            <div>
                <p class="text-sm text-gray-700 mb-2"><strong>Program includes:</strong></p>
                <ul class="text-sm text-gray-700 space-y-1 mb-6">
                    <li>• Down payment and closing cost assistance</li>
                    <li>• Pre-purchase counseling and education</li>
                    <li>• Preferred lender network access</li>
                    <li>• Post-purchase homeownership support</li>
                </ul>
            </div>
        `
    },
    5: {
        title: "Black Tech Scale-Up Program",
        source: "Technology Initiative",
        date: "May 12, 2025",
        senderName: "Embiz Admin",
        senderBadge: "APP",
        senderTime: "9:45 AM",
        senderGreeting: "Hi Leon,",
        senderAvatar: "https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80",
        content: `
            <div>
                <p class="text-sm text-gray-700 mb-2"><strong>Type:</strong> Technology Venture Capital</p>
                <p class="text-sm text-gray-700 mb-2"><strong>Funding Amount:</strong> $50,000-$500,000 (Series A focus)</p>
                <p class="text-sm text-gray-700 mb-2"><strong>Application Deadline:</strong> November 15, 2025</p>
                <p class="text-sm text-gray-700 mb-4"><strong>Eligibility Criteria:</strong></p>
                <ul class="text-sm text-gray-700 space-y-1 mb-4">
                    <li>• Black-founded technology startups</li>
                    <li>• Revenue of $100K+ annually</li>
                    <li>• Proven product-market fit</li>
                    <li>• Clear path to scalability and growth</li>
                </ul>
            </div>
            <div>
                <p class="text-sm text-gray-700 mb-2"><strong>Opportunity Description:</strong></p>
                <p class="text-sm text-gray-700 mb-4">
                    The Horizon VC Scale-Up Program was created to bridge the funding gap for Black tech entrepreneurs. Get access to capital, strategic guidance, and network connections to scale your technology startup to the next level.
                </p>
            </div>
            <div>
                <p class="text-sm text-gray-700 mb-2"><strong>Investment includes:</strong></p>
                <ul class="text-sm text-gray-700 space-y-1 mb-6">
                    <li>• Series A funding and follow-on rounds</li>
                    <li>• Strategic advisory and board guidance</li>
                    <li>• Access to enterprise customers and partnerships</li>
                    <li>• Technical talent recruitment support</li>
                </ul>
            </div>
        `
    }
};

function selectMessage(messageId) {
    // Remove selection from all messages
    const allMessages = document.querySelectorAll('[onclick^="selectMessage"]');
    allMessages.forEach(msg => {
        msg.classList.remove('bg-gray-50', 'border-r-2');
        msg.style.borderRightColor = '';
    });
    
    // Add selection to clicked message
    const selectedMessage = document.querySelector(`[onclick="selectMessage(${messageId})"]`);
    if (selectedMessage) {
        selectedMessage.classList.add('bg-gray-50', 'border-r-2');
        selectedMessage.style.borderRightColor = '#006C5F';
    }
    
    // Update the right panel with the selected message
    const message = messages[messageId];
    if (message) {
        document.getElementById('message-title').textContent = message.title;
        document.getElementById('message-source').textContent = message.source;
        document.getElementById('message-date').textContent = message.date;
        document.getElementById('sender-name').textContent = message.senderName;
        document.getElementById('sender-badge').textContent = message.senderBadge;
        document.getElementById('sender-time').textContent = message.senderTime;
        document.getElementById('sender-greeting').textContent = message.senderGreeting;
        document.getElementById('sender-avatar').src = message.senderAvatar;
        document.getElementById('message-details').innerHTML = message.content + `
            <div class="flex space-x-4">
                <button class="px-6 py-2 text-white font-medium rounded-lg hover:opacity-90 transition-opacity duration-200" 
                        style="background-color: #006C5F;">
                    INTERESTED
                </button>
                <button class="px-6 py-2 border-2 font-medium rounded-lg hover:bg-gray-50 transition-colors duration-200" 
                        style="border-color: #006C5F; color: #006C5F;">
                    NOT INTERESTED
                </button>
            </div>
        `;
    }
}
</script>
@endsection