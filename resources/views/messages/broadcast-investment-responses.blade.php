@extends('layouts.dashboard')

@section('page-title', 'Broadcast Investment Responses')

@section('header-icon')
<i class="bx bx-broadcast text-gray-600 text-lg sm:text-xl"></i>
@endsection

@section('header-actions')
<a href="{{ route('messages.index') }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 text-sm font-medium">
    <i class="bx bx-arrow-back mr-2"></i>Back to Messages
</a>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Broadcast Message Details -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-6 border-b border-gray-200">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $broadcastMessage->subject }}</h2>
                    <div class="flex items-center text-sm text-gray-600 space-x-4">
                        <span>From: {{ $broadcastMessage->sender->name }}</span>
                        <span>•</span>
                        <span>{{ $broadcastMessage->created_at->format('M j, Y g:i A') }}</span>
                        <span>•</span>
                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                            <i class="bx bx-broadcast mr-1"></i>Broadcast Investment
                        </span>
                        <span>•</span>
                        <span class="text-sm font-medium text-gray-700">{{ $recipientCount }} recipients</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="p-6">
            <div class="prose max-w-none">
                <p class="text-gray-700 whitespace-pre-wrap">{{ $broadcastMessage->message }}</p>
            </div>
        </div>
    </div>

    <!-- Response Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="bx bx-users text-blue-600"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Responses</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['total_responses'] }}</p>
                    <p class="text-xs text-gray-500">{{ number_format(($stats['total_responses'] / $recipientCount) * 100, 1) }}% response rate</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="bx bx-check-circle text-green-600"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Interested</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['interested_count'] }}</p>
                    <p class="text-xs text-gray-500">{{ number_format($stats['interest_rate'], 1) }}% interest rate</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="bx bx-x-circle text-red-600"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Not Interested</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['not_interested_count'] }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-yellow-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="bx bx-crown text-yellow-600"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Founding Members</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $stats['founding_member_interested'] }}/{{ $stats['founding_member_total'] }}</p>
                    <p class="text-xs text-gray-500">{{ number_format($stats['founding_member_interest_rate'], 1) }}% interest rate</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Investment Summary -->
    @if($totalInvestmentAmount > 0)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Investment Summary</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="text-center">
                        <p class="text-2xl font-bold text-green-600">${{ number_format($totalInvestmentAmount, 2) }}</p>
                        <p class="text-sm text-gray-600">Total Investment Interest</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-blue-600">${{ number_format($averageInvestmentAmount, 2) }}</p>
                        <p class="text-sm text-gray-600">Average Investment</p>
                    </div>
                    <div class="text-center">
                        <p class="text-2xl font-bold text-purple-600">{{ $investmentResponseCount }}</p>
                        <p class="text-sm text-gray-600">Responses with Investment Amount</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Responses List -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">All Responses</h3>
                <div class="flex items-center space-x-2">
                    <select id="responseFilter" class="text-sm border border-gray-300 rounded-lg px-3 py-1 focus:outline-none focus:ring-2 focus:ring-teal-500">
                        <option value="all">All Responses</option>
                        <option value="interested">Interested Only</option>
                        <option value="not_interested">Not Interested Only</option>
                        <option value="founding_members">Founding Members Only</option>
                    </select>
                </div>
            </div>
        </div>
        
        @if($responses->count() > 0)
            <div class="divide-y divide-gray-200" id="responsesList">
                @foreach($responses as $response)
                    <div class="p-6 response-item" 
                         data-response-type="{{ $response->response_type }}" 
                         data-is-founding-member="{{ $response->user->isFoundingMember() ? 'true' : 'false' }}">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start space-x-4">
                                <!-- User Avatar -->
                                <div class="w-10 h-10 bg-teal-600 rounded-full flex items-center justify-center flex-shrink-0">
                                    <span class="text-white font-medium text-sm">{{ $response->user->initials }}</span>
                                </div>
                                
                                <!-- Response Content -->
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-2">
                                        <h4 class="font-medium text-gray-900">{{ $response->user->name }}</h4>
                                        @if($response->user->isFoundingMember())
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <i class="bx bx-crown mr-1"></i>Founding Member
                                            </span>
                                        @endif
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium 
                                            @if($response->response_type === 'interested') bg-green-100 text-green-800 
                                            @else bg-red-100 text-red-800 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $response->response_type)) }}
                                        </span>
                                    </div>
                                    
                                    <div class="text-sm text-gray-600 mb-2">
                                        <span>{{ $response->user->profile->profile_type ?? 'Member' }}</span>
                                        <span class="mx-2">•</span>
                                        <span>{{ $response->responded_at->format('M j, Y g:i A') }}</span>
                                    </div>
                                    
                                    @if($response->interest_level)
                                        <div class="mb-2">
                                            <span class="text-sm font-medium text-gray-700">Interest Level: </span>
                                            <span class="text-sm text-gray-600 capitalize">{{ $response->interest_level }}</span>
                                        </div>
                                    @endif
                                    
                                    @if($response->investment_amount)
                                        <div class="mb-2">
                                            <span class="text-sm font-medium text-gray-700">Investment Amount: </span>
                                            <span class="text-sm text-gray-600 font-medium">${{ number_format($response->investment_amount, 2) }}</span>
                                        </div>
                                    @endif
                                    
                                    @if($response->comments)
                                        <div class="mt-3 p-3 bg-gray-50 rounded-lg">
                                            <p class="text-sm text-gray-700">{{ $response->comments }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- User Actions -->
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('user-profile.show', $response->user) }}" 
                                   class="text-blue-600 hover:text-blue-800 text-sm" 
                                   title="View Profile">
                                    <i class="bx bx-user"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="p-12 text-center">
                <i class="bx bx-broadcast text-gray-400 text-4xl mb-4"></i>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No responses yet</h3>
                <p class="text-gray-500">Responses to this broadcast investment message will appear here.</p>
            </div>
        @endif
    </div>
</div>

<script>
// Filter functionality
document.getElementById('responseFilter').addEventListener('change', function() {
    const filterValue = this.value;
    const responseItems = document.querySelectorAll('.response-item');
    
    responseItems.forEach(item => {
        const responseType = item.dataset.responseType;
        const isFoundingMember = item.dataset.isFoundingMember === 'true';
        
        let shouldShow = true;
        
        switch(filterValue) {
            case 'interested':
                shouldShow = responseType === 'interested';
                break;
            case 'not_interested':
                shouldShow = responseType === 'not_interested';
                break;
            case 'founding_members':
                shouldShow = isFoundingMember;
                break;
            case 'all':
            default:
                shouldShow = true;
                break;
        }
        
        if (shouldShow) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
});
</script>
@endsection
