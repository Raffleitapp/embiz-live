@extends('layouts.dashboard')

@section('page-title', 'Opportunities')
@section('header-icon')
<i class="bx bx-briefcase text-teal-600 text-lg sm:text-xl"></i>
@endsection

@section('header-actions')
<a href="{{ route('dashboard.opportunities.create') }}" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 text-sm font-medium transition-colors duration-200">
    <i class="bx bx-plus-circle mr-2"></i>Create Opportunity
</a>
@endsection

@section('content')
<div class="p-3 sm:p-4 lg:p-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Discover Opportunities</h1>
            <p class="text-gray-600">Find investment, funding, partnership, and mentorship opportunities</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('dashboard.opportunities.create') }}" class="inline-flex items-center px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors duration-200 font-medium">
                <i class="bx bx-plus-circle mr-2"></i>Create Opportunity
            </a>
        </div>
    </div>

    <!-- Advanced Filters -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 sm:p-6 mb-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Filter Opportunities</h3>
            <i class="bx bx-filter-alt text-teal-500 text-xl"></i>
        </div>
        
        <form method="GET" action="{{ route('dashboard.opportunities') }}" class="space-y-4">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                    <div class="relative">
                        <input type="text" id="search" name="search" value="{{ request('search') }}" 
                               class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors duration-200"
                               placeholder="Search opportunities...">
                        <i class="bx bx-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                    <select id="type" name="type" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors duration-200">
                        <option value="">All Types</option>
                        <option value="investment" {{ request('type') == 'investment' ? 'selected' : '' }}>Investment</option>
                        <option value="funding" {{ request('type') == 'funding' ? 'selected' : '' }}>Funding</option>
                        <option value="partnership" {{ request('type') == 'partnership' ? 'selected' : '' }}>Partnership</option>
                        <option value="mentorship" {{ request('type') == 'mentorship' ? 'selected' : '' }}>Mentorship</option>
                        <option value="grant" {{ request('type') == 'grant' ? 'selected' : '' }}>Grant</option>
                    </select>
                </div>

                <div>
                    <label for="industry" class="block text-sm font-medium text-gray-700 mb-2">Industry</label>
                    <div class="relative">
                        <input type="text" id="industry" name="industry" value="{{ request('industry') }}" 
                               class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors duration-200"
                               placeholder="e.g., Technology, Finance">
                        <i class="bx bx-building absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>

                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                    <div class="relative">
                        <input type="text" id="location" name="location" value="{{ request('location') }}" 
                               class="w-full pl-10 pr-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors duration-200"
                               placeholder="e.g., New York, Remote">
                        <i class="bx bx-map absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    </div>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row gap-3 pt-2">
                <button type="submit" class="inline-flex items-center justify-center px-6 py-2 bg-teal-600 hover:bg-teal-700 text-white font-medium rounded-lg transition-colors duration-200">
                    <i class="bx bx-search mr-2"></i>Apply Filters
                </button>
                <a href="{{ route('dashboard.opportunities') }}" class="inline-flex items-center justify-center px-6 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition-colors duration-200">
                    <i class="bx bx-refresh mr-2"></i>Clear All
                </a>
            </div>
        </form>
    </div>

    <!-- Opportunities Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6">
        @forelse($opportunities as $opportunity)
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-lg hover:border-teal-200 transition-all duration-300 group">
                @if($opportunity->image)
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('storage/' . $opportunity->image) }}" alt="{{ $opportunity->title }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    </div>
                @else
                    <div class="w-full h-48 bg-gradient-to-br from-teal-50 to-gray-100 flex items-center justify-center relative">
                        <div class="text-center">
                            <i class="bx bx-briefcase text-4xl text-teal-300 mb-2"></i>
                            <span class="text-gray-500 text-sm">{{ $opportunity->type ?? 'Opportunity' }}</span>
                        </div>
                    </div>
                @endif

                <div class="p-4 sm:p-6">
                    <div class="flex items-center justify-between mb-3">
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
                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium {{ $colorClass }}">
                            <i class="bx bx-category mr-1"></i>
                            {{ ucfirst($opportunity->type) }}
                        </span>
                        @if($opportunity->is_featured)
                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-700">
                                <i class="bx bx-star mr-1"></i>
                                Featured
                            </span>
                        @endif
                    </div>

                    <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-teal-700 transition-colors duration-200">{{ $opportunity->title }}</h3>
                    <p class="text-gray-600 mb-4 text-sm sm:text-base line-clamp-3">{{ Str::limit($opportunity->description, 120) }}</p>

                    @if($opportunity->amount)
                        <div class="mb-4 p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <i class="bx bx-dollar-circle text-teal-500 mr-2"></i>
                                <span class="text-xl sm:text-2xl font-bold text-teal-600">
                                    {{ $opportunity->currency ?? '$' }}{{ number_format($opportunity->amount) }}
                                </span>
                            </div>
                        </div>
                    @endif

                    <div class="space-y-2 mb-4">
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="bx bx-map text-gray-400 mr-2"></i>
                            <span>{{ $opportunity->location ?? 'Remote' }}</span>
                        </div>
                        <div class="flex items-center text-sm text-gray-500">
                            <i class="bx bx-time text-gray-400 mr-2"></i>
                            <span>{{ $opportunity->created_at->diffForHumans() }}</span>
                        </div>
                        @if($opportunity->industry)
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="bx bx-building text-gray-400 mr-2"></i>
                                <span>{{ $opportunity->industry }}</span>
                            </div>
                        @endif
                    </div>

                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <div class="flex items-center">
                            @if($opportunity->user->profile && $opportunity->user->profile->avatar)
                                <img src="{{ asset('storage/' . $opportunity->user->profile->avatar) }}" alt="{{ $opportunity->user->name }}" class="w-8 h-8 rounded-full mr-2 ring-2 ring-teal-100">
                            @else
                                <div class="w-8 h-8 rounded-full bg-teal-600 flex items-center justify-center mr-2 ring-2 ring-teal-100">
                                    <span class="text-white text-sm font-medium">{{ $opportunity->user->initials }}</span>
                                </div>
                            @endif
                            <div>
                                <span class="text-sm font-medium text-gray-900">{{ $opportunity->user->name }}</span>
                                @if($opportunity->user->profile && $opportunity->user->profile->title)
                                    <p class="text-xs text-gray-500">{{ $opportunity->user->profile->title }}</p>
                                @endif
                            </div>
                        </div>
                        <a href="{{ route('dashboard.opportunities.show', $opportunity) }}" class="inline-flex items-center px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white font-medium rounded-lg text-sm transition-colors duration-200 group">
                            <span>View Details</span>
                            <i class="bx bx-right-arrow-alt ml-1 group-hover:translate-x-1 transition-transform duration-200"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12">
                <div class="max-w-md mx-auto">
                    <i class="bx bx-search-alt-2 text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No opportunities found</h3>
                    <p class="text-gray-500 mb-6">Try adjusting your search criteria or create a new opportunity to get started.</p>
                    <a href="{{ route('dashboard.opportunities.create') }}" class="inline-flex items-center px-4 py-2 bg-teal-600 hover:bg-teal-700 text-white font-medium rounded-lg transition-colors duration-200">
                        <i class="bx bx-plus-circle mr-2"></i>Create Your First Opportunity
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($opportunities->hasPages())
        <div class="mt-8 flex justify-center">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-1">
                {{ $opportunities->links() }}
            </div>
        </div>
    @endif
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection
