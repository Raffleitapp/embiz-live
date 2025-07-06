@extends('layouts.dashboard')

@section('page-title', $opportunity->title)

@section('header-icon')
<i class="bx bx-briefcase text-teal-600 text-lg sm:text-xl"></i>
@endsection

@section('header-actions')
<div class="flex space-x-3">
    <a href="{{ route('dashboard.opportunities') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 text-sm font-medium transition-colors duration-200">
        <i class="bx bx-arrow-back mr-2"></i>Back to Opportunities
    </a>
    @if(auth()->check() && auth()->user()->id === $opportunity->user_id)
        <a href="{{ route('dashboard.opportunities.edit', $opportunity) }}" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 text-sm font-medium transition-colors duration-200">
            <i class="bx bx-edit mr-2"></i>Edit
        </a>
    @endif
</div>
@endsection

@section('content')
<div class="p-3 sm:p-4 lg:p-6">
    <div class="max-w-4xl mx-auto">
        <!-- Header Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden mb-6">
            @if($opportunity->image)
                <div class="relative">
                    <img src="{{ asset('storage/' . $opportunity->image) }}" alt="{{ $opportunity->title }}" class="w-full h-64 sm:h-80 object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent"></div>
                </div>
            @else
                <div class="w-full h-64 sm:h-80 bg-gradient-to-br from-teal-500 to-teal-600 flex items-center justify-center">
                    <div class="text-center text-white">
                        <i class="bx bx-briefcase text-6xl mb-4 opacity-80"></i>
                        <p class="text-xl font-medium">{{ ucfirst($opportunity->type) }} Opportunity</p>
                    </div>
                </div>
            @endif

            <div class="p-6 sm:p-8">
                <!-- Badges -->
                <div class="flex flex-wrap items-center gap-2 mb-6">
                    @php
                        $typeColors = [
                            'investment' => 'bg-emerald-100 text-emerald-700',
                            'funding' => 'bg-blue-100 text-blue-700',
                            'partnership' => 'bg-purple-100 text-purple-700',
                            'mentorship' => 'bg-orange-100 text-orange-700',
                            'grant' => 'bg-indigo-100 text-indigo-700',
                            'default' => 'bg-teal-100 text-teal-700'
                        ];
                        $colorClass = $typeColors[$opportunity->type] ?? $typeColors['default'];
                    @endphp
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium {{ $colorClass }}">
                        <i class="bx bx-category mr-1.5"></i>
                        {{ ucfirst($opportunity->type) }}
                    </span>
                    
                    @if($opportunity->is_featured)
                        <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-yellow-100 text-yellow-700">
                            <i class="bx bx-star mr-1.5"></i>
                            Featured
                        </span>
                    @endif
                    
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-medium bg-gray-100 text-gray-700">
                        <i class="bx bx-signal-{{ $opportunity->status === 'active' ? '5' : '2' }} mr-1.5"></i>
                        {{ ucfirst($opportunity->status) }}
                    </span>
                </div>

                <!-- Title -->
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">{{ $opportunity->title }}</h1>

                <!-- Amount -->
                @if($opportunity->amount)
                    <div class="mb-6 p-4 bg-gradient-to-r from-teal-50 to-teal-100 rounded-xl">
                        <div class="flex items-center">
                            <i class="bx bx-dollar-circle text-teal-600 text-2xl mr-3"></i>
                            <div>
                                <p class="text-sm font-medium text-teal-700">Opportunity Value</p>
                                <span class="text-3xl font-bold text-teal-800">
                                    {{ $opportunity->currency ?? '$' }}{{ number_format($opportunity->amount) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Key Details -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                        <i class="bx bx-map text-teal-600 text-xl mr-3"></i>
                        <div>
                            <p class="text-sm text-gray-600">Location</p>
                            <p class="font-semibold text-gray-900">{{ $opportunity->location ?? 'Remote' }}</p>
                        </div>
                    </div>
                    
                    @if($opportunity->industry)
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <i class="bx bx-building text-teal-600 text-xl mr-3"></i>
                            <div>
                                <p class="text-sm text-gray-600">Industry</p>
                                <p class="font-semibold text-gray-900">{{ $opportunity->industry }}</p>
                            </div>
                        </div>
                    @endif
                    
                    <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                        <i class="bx bx-time text-teal-600 text-xl mr-3"></i>
                        <div>
                            <p class="text-sm text-gray-600">Posted</p>
                            <p class="font-semibold text-gray-900">{{ $opportunity->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Owner Actions -->
                @if(auth()->check() && auth()->user()->id === $opportunity->user_id)
                    <div class="border-t border-gray-200 pt-6">
                        <div class="flex flex-col sm:flex-row gap-3">
                            <a href="{{ route('dashboard.opportunities.edit', $opportunity) }}" 
                               class="inline-flex items-center justify-center px-6 py-3 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors duration-200 font-medium">
                                <i class="bx bx-edit mr-2"></i>Edit Opportunity
                            </a>
                            <form method="POST" action="{{ route('dashboard.opportunities.destroy', $opportunity) }}" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="inline-flex items-center justify-center px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200 font-medium" 
                                        onclick="return confirm('Are you sure you want to delete this opportunity?')">
                                    <i class="bx bx-trash mr-2"></i>Delete Opportunity
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <!-- Content Sections -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Description -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="bx bx-text text-teal-600 mr-2"></i>
                        Description
                    </h3>
                    <div class="prose max-w-none">
                        <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $opportunity->description }}</p>
                    </div>
                </div>

                <!-- Requirements -->
                @if($opportunity->requirements)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="bx bx-check-square text-teal-600 mr-2"></i>
                            Requirements
                        </h3>
                        <div class="prose max-w-none">
                            @php
                                $requirements = explode("\n", $opportunity->requirements);
                                $requirements = array_filter(array_map('trim', $requirements));
                            @endphp
                            @if(count($requirements) > 1)
                                <ul class="space-y-2">
                                    @foreach($requirements as $requirement)
                                        <li class="flex items-start">
                                            <i class="bx bx-check text-teal-500 mr-2 mt-1 flex-shrink-0"></i>
                                            <span class="text-gray-700">{{ ltrim($requirement, '•-*') }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $opportunity->requirements }}</p>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Additional Info -->
                @if($opportunity->deadline || $opportunity->stage)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="bx bx-info-circle text-teal-600 mr-2"></i>
                            Additional Information
                        </h3>
                        <div class="space-y-3">
                            @if($opportunity->deadline)
                                <div class="flex items-center">
                                    <i class="bx bx-calendar text-gray-400 mr-3"></i>
                                    <div>
                                        <p class="text-sm text-gray-600">Application Deadline</p>
                                        <p class="font-semibold text-gray-900">{{ $opportunity->deadline->format('F j, Y') }}</p>
                                    </div>
                                </div>
                            @endif
                            
                            @if($opportunity->stage)
                                <div class="flex items-center">
                                    <i class="bx bx-trending-up text-gray-400 mr-3"></i>
                                    <div>
                                        <p class="text-sm text-gray-600">Stage</p>
                                        <p class="font-semibold text-gray-900 capitalize">{{ $opportunity->stage }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Contact Information -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="bx bx-user text-teal-600 mr-2"></i>
                        Posted By
                    </h3>
                    <div class="flex items-center mb-4">
                        @if($opportunity->user->profile && $opportunity->user->profile->avatar)
                            <img src="{{ asset('storage/' . $opportunity->user->profile->avatar) }}" alt="{{ $opportunity->user->name }}" class="w-12 h-12 rounded-full mr-3 ring-2 ring-teal-100">
                        @else
                            <div class="w-12 h-12 rounded-full bg-teal-600 flex items-center justify-center mr-3 ring-2 ring-teal-100">
                                <span class="text-white text-lg font-medium">{{ $opportunity->user->initials }}</span>
                            </div>
                        @endif
                        <div>
                            <p class="font-semibold text-gray-900">{{ $opportunity->user->name }}</p>
                            <p class="text-sm text-gray-500">{{ $opportunity->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    
                    @if($opportunity->contact_info)
                        <div class="border-t border-gray-200 pt-4">
                            <h4 class="font-medium text-gray-900 mb-2">Contact Information</h4>
                            <div class="text-sm text-gray-700 whitespace-pre-wrap">{{ $opportunity->contact_info }}</div>
                        </div>
                    @endif
                </div>

                <!-- Apply Section -->
                @if(auth()->check() && auth()->user()->id !== $opportunity->user_id && $opportunity->status === 'active')
                    <div class="bg-gradient-to-r from-teal-50 to-teal-100 rounded-xl border border-teal-200 p-6">
                        <h3 class="text-lg font-semibold text-teal-900 mb-4 flex items-center">
                            <i class="bx bx-send text-teal-600 mr-2"></i>
                            Apply for this Opportunity
                        </h3>
                        <p class="text-sm text-teal-700 mb-4">Interested in this opportunity? Send your application directly to the poster.</p>
                        
                        <form method="POST" action="{{ route('dashboard.opportunities.apply', $opportunity) }}" class="space-y-4">
                            @csrf
                            <div>
                                <label for="contact_email" class="block text-sm font-medium text-teal-700 mb-2">Email</label>
                                <input type="email" id="contact_email" name="contact_email" required 
                                       value="{{ auth()->user()->email }}" 
                                       class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                            </div>
                            
                            <div>
                                <label for="contact_phone" class="block text-sm font-medium text-teal-700 mb-2">Phone (Optional)</label>
                                <input type="tel" id="contact_phone" name="contact_phone" 
                                       class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                            </div>
                            
                            <div>
                                <label for="message" class="block text-sm font-medium text-teal-700 mb-2">Message</label>
                                <textarea id="message" name="message" rows="4" required 
                                          class="w-full px-3 py-2 border border-teal-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                          placeholder="Tell them why you're interested in this opportunity..."></textarea>
                            </div>
                            
                            <button type="submit" class="w-full bg-teal-600 hover:bg-teal-700 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200">
                                <i class="bx bx-send mr-2"></i>Submit Application
                            </button>
                        </form>
                    </div>
                @elseif(!auth()->check())
                    <div class="bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <i class="bx bx-user-plus text-gray-600 mr-2"></i>
                            Interested in this Opportunity?
                        </h3>
                        <p class="text-sm text-gray-700 mb-4">Sign in to apply for this opportunity and connect with the poster.</p>
                        <a href="{{ route('login') }}" class="w-full inline-flex items-center justify-center bg-teal-600 hover:bg-teal-700 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200">
                            <i class="bx bx-log-in mr-2"></i>Sign In to Apply
                        </a>
                    </div>
                @endif

                <!-- Quick Stats -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="bx bx-bar-chart text-teal-600 mr-2"></i>
                        Quick Stats
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Views</span>
                            <span class="font-semibold text-gray-900">{{ $opportunity->views ?? 0 }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Applications</span>
                            <span class="font-semibold text-gray-900">{{ $opportunity->applications_count ?? 0 }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Posted</span>
                            <span class="font-semibold text-gray-900">{{ $opportunity->created_at->format('M j, Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
