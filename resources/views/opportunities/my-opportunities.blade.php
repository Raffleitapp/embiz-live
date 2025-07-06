@extends('layouts.dashboard')

@section('page-title', 'My Opportunities')

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
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">My Opportunities</h1>
            <p class="text-gray-600">Manage and track your created opportunities</p>
        </div>
        <div class="mt-4 sm:mt-0">
            <a href="{{ route('dashboard.opportunities.create') }}" class="inline-flex items-center px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors duration-200 font-medium">
                <i class="bx bx-plus-circle mr-2"></i>Create New Opportunity
            </a>
        </div>
    </div>

    @if($opportunities->count() > 0)
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-teal-100 rounded-lg flex items-center justify-center">
                        <i class="bx bx-briefcase text-teal-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Opportunities</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $opportunities->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="bx bx-check-circle text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Active</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $opportunities->where('status', 'active')->count() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="bx bx-eye text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Views</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $opportunities->sum('views') }}</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="bx bx-dollar text-purple-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">Total Value</p>
                        <p class="text-2xl font-bold text-gray-900">${{ number_format($opportunities->sum('amount')) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Opportunities Table -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Your Opportunities</h3>
            </div>
            
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Opportunity
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Type
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Amount
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Views
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Created
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($opportunities as $opportunity)
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        @if($opportunity->image)
                                            <img src="{{ asset('storage/' . $opportunity->image) }}" alt="{{ $opportunity->title }}" class="w-12 h-12 object-cover rounded-lg mr-4 border-2 border-gray-100">
                                        @else
                                            <div class="w-12 h-12 bg-gradient-to-br from-teal-100 to-gray-100 rounded-lg mr-4 flex items-center justify-center border-2 border-gray-100">
                                                <i class="bx bx-briefcase text-teal-600"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="text-sm font-medium text-gray-900 hover:text-teal-600 transition-colors">{{ $opportunity->title }}</div>
                                            <div class="text-sm text-gray-500">{{ Str::limit($opportunity->description, 50) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
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
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium
                                        @if($opportunity->status === 'active') bg-green-100 text-green-700
                                        @elseif($opportunity->status === 'paused') bg-yellow-100 text-yellow-700
                                        @elseif($opportunity->status === 'closed') bg-red-100 text-red-700
                                        @elseif($opportunity->status === 'draft') bg-gray-100 text-gray-700
                                        @endif">
                                        @if($opportunity->status === 'active')
                                            <i class="bx bx-check-circle mr-1"></i>
                                        @elseif($opportunity->status === 'paused')
                                            <i class="bx bx-pause-circle mr-1"></i>
                                        @elseif($opportunity->status === 'closed')
                                            <i class="bx bx-x-circle mr-1"></i>
                                        @else
                                            <i class="bx bx-edit mr-1"></i>
                                        @endif
                                        {{ ucfirst($opportunity->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    @if($opportunity->amount)
                                        <span class="font-medium text-teal-600">{{ $opportunity->currency ?? '$' }}{{ number_format($opportunity->amount) }}</span>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center text-sm text-gray-900">
                                        <i class="bx bx-eye text-gray-400 mr-1"></i>
                                        {{ $opportunity->views ?? 0 }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <div class="flex items-center">
                                        <i class="bx bx-calendar text-gray-400 mr-1"></i>
                                        {{ $opportunity->created_at->format('M j, Y') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex items-center space-x-3">
                                        <a href="{{ route('dashboard.opportunities.show', $opportunity) }}" class="text-teal-600 hover:text-teal-900 transition-colors duration-200" title="View">
                                            <i class="bx bx-show"></i>
                                        </a>
                                        <a href="{{ route('dashboard.opportunities.edit', $opportunity) }}" class="text-blue-600 hover:text-blue-900 transition-colors duration-200" title="Edit">
                                            <i class="bx bx-edit-alt"></i>
                                        </a>
                                        <form method="POST" action="{{ route('dashboard.opportunities.destroy', $opportunity) }}" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 transition-colors duration-200" onclick="return confirm('Are you sure you want to delete this opportunity?')" title="Delete">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($opportunities->hasPages())
            <div class="mt-6 flex justify-center">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-1">
                    {{ $opportunities->links() }}
                </div>
            </div>
        @endif
    @else
        <div class="text-center py-12">
            <div class="max-w-md mx-auto">
                <i class="bx bx-briefcase text-6xl text-gray-300 mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No opportunities yet</h3>
                <p class="text-gray-500 mb-6">You haven't created any opportunities yet. Create your first opportunity to get started.</p>
                <a href="{{ route('dashboard.opportunities.create') }}" class="inline-flex items-center px-6 py-3 bg-teal-600 hover:bg-teal-700 text-white font-medium rounded-lg transition-colors duration-200">
                    <i class="bx bx-plus-circle mr-2"></i>Create Your First Opportunity
                </a>
            </div>
        </div>
    @endif
</div>
@endsection
