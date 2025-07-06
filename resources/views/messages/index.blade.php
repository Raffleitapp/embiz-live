@extends('layouts.dashboard')

@section('page-title', 'Messages')

@section('header-icon')
<i class="bx bx-message-dots text-gray-600 text-lg sm:text-xl"></i>
@endsection

@section('header-actions')
@if(auth()->user()->isAdmin())
    <a href="{{ route('messages.create-investment-broadcast-form') }}" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 text-sm font-medium">
        <i class="bx bx-plus mr-2"></i>Create Broadcast
    </a>
@endif
@endsection

@section('content')
<div class="space-y-6">
    <!-- Message Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="bx bx-message text-blue-600"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Messages</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $messages->total() }}</p>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="bx bx-bell text-green-600"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Unread Messages</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $unreadCount }}</p>
                </div>
            </div>
        </div>
        
        @if(auth()->user()->isAdmin())
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <div class="flex items-center">
                <div class="w-8 h-8 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                    <i class="bx bx-broadcast text-purple-600"></i>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600">Investment Broadcasts</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $messages->where('message_type', 'investment')->count() }}</p>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Messages List -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex items-center justify-between">
                <h3 class="text-lg font-semibold text-gray-900">All Messages</h3>
                <div class="flex items-center space-x-2">
                    <select class="text-sm border border-gray-300 rounded-lg px-3 py-1 focus:outline-none focus:ring-2 focus:ring-teal-500">
                        <option value="all">All Types</option>
                        <option value="investment">Investment Broadcasts</option>
                        <option value="regular">Regular Messages</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="divide-y divide-gray-200">
            @forelse($messages as $message)
                <div class="p-6 hover:bg-gray-50">
                    <div class="flex items-start justify-between">
                        <div class="flex items-start space-x-4 flex-1">
                            <!-- Sender Avatar -->
                            <div class="w-10 h-10 bg-teal-600 rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-medium text-sm">{{ $message->sender ? $message->sender->initials : 'UK' }}</span>
                            </div>
                            
                            <!-- Message Content -->
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center space-x-2 mb-1">
                                    <h4 class="text-sm font-semibold text-gray-900">{{ $message->subject ?: 'No Subject' }}</h4>
                                    @if($message->message_type === 'investment')
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                            <i class="bx bx-broadcast mr-1"></i>Investment
                                        </span>
                                        @if($message->investment_amount)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                {{ $message->investment_currency ?? 'USD' }} {{ number_format($message->investment_amount, 2) }}
                                            </span>
                                        @endif
                                    @endif
                                    @if($message->is_important)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                            <i class="bx bx-star mr-1"></i>Important
                                        </span>
                                    @endif
                                </div>
                                
                                <div class="flex items-center text-sm text-gray-600 mb-2">
                                    <span>From: {{ $message->sender ? $message->sender->name : 'Unknown' }}</span>
                                    <span class="mx-2">•</span>
                                    @if(isset($message->is_broadcast) && $message->is_broadcast)
                                        <span>To: {{ $message->recipient_count }} recipients</span>
                                    @else
                                        <span>To: {{ $message->recipient ? $message->recipient->name : 'Unknown' }}</span>
                                    @endif
                                    <span class="mx-2">•</span>
                                    <span>{{ $message->created_at ? $message->created_at->format('M j, Y g:i A') : 'No date' }}</span>
                                </div>
                                
                                <p class="text-sm text-gray-700 line-clamp-2">{{ Str::limit($message->message, 150) }}</p>
                                
                                <!-- Investment Message Actions -->
                                @if($message->message_type === 'investment' && auth()->user()->isAdmin())
                                    <div class="mt-3 flex items-center space-x-4">
                                        @if(isset($message->is_broadcast) && $message->is_broadcast)
                                            @php
                                                // For broadcast messages, get all responses from all messages in the thread
                                                $allThreadMessages = \App\Models\Message::where('thread_id', $message->thread_id)->get();
                                                $totalResponses = $allThreadMessages->sum(function($msg) {
                                                    return $msg->interests->count();
                                                });
                                                $totalInterested = $allThreadMessages->sum(function($msg) {
                                                    return $msg->interestedResponses->count();
                                                });
                                                $totalNotInterested = $allThreadMessages->sum(function($msg) {
                                                    return $msg->notInterestedResponses->count();
                                                });
                                                $foundingMembersInterested = $allThreadMessages->sum(function($msg) {
                                                    return $msg->foundingMemberResponses()->interested()->count();
                                                });
                                                $foundingMembersTotal = $allThreadMessages->sum(function($msg) {
                                                    return $msg->foundingMemberResponses()->count();
                                                });
                                                $interestRate = $totalResponses > 0 ? ($totalInterested / $totalResponses) * 100 : 0;
                                                $foundingMemberInterestRate = $foundingMembersTotal > 0 ? ($foundingMembersInterested / $foundingMembersTotal) * 100 : 0;
                                            @endphp
                                            
                                            <button onclick="viewBroadcastResponses('{{ $message->thread_id }}')" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                                                <i class="bx bx-chart mr-1"></i>View Responses ({{ $totalResponses }})
                                            </button>
                                            
                                            <span class="text-sm text-gray-500">
                                                Interest Rate: {{ number_format($interestRate, 1) }}%
                                            </span>
                                            
                                            @if($foundingMembersTotal > 0)
                                                <span class="text-sm text-gray-500">
                                                    Founding Members: {{ number_format($foundingMemberInterestRate, 1) }}%
                                                </span>
                                            @endif
                                        @else
                                            <button onclick="viewResponses({{ $message->id }})" class="text-sm text-blue-600 hover:text-blue-700 font-medium">
                                                <i class="bx bx-chart mr-1"></i>View Responses ({{ $message->interests->count() }})
                                            </button>
                                            
                                            @php
                                                $stats = $message->getResponseStats();
                                            @endphp
                                            
                                            <span class="text-sm text-gray-500">
                                                Interest Rate: {{ number_format($stats['interest_rate'], 1) }}%
                                            </span>
                                            
                                            @if($stats['founding_member_total'] > 0)
                                                <span class="text-sm text-gray-500">
                                                    Founding Members: {{ number_format($stats['founding_member_interest_rate'], 1) }}%
                                                </span>
                                            @endif
                                        @endif
                                    </div>
                                @endif
                                
                                <!-- Regular user response option -->
                                @if($message->message_type === 'investment' && !auth()->user()->isAdmin() && $message->recipient_id === auth()->id())
                                    @php
                                        $userResponse = auth()->user()->getMessageResponse($message->id);
                                    @endphp
                                    
                                    @if($userResponse)
                                        <div class="mt-3 p-3 bg-gray-50 rounded-lg">
                                            <p class="text-sm font-medium text-gray-900">Your Response:</p>
                                            <p class="text-sm text-gray-600 capitalize">{{ str_replace('_', ' ', $userResponse->response_type) }}</p>
                                            @if($userResponse->interest_level)
                                                <p class="text-sm text-gray-600">Interest Level: {{ ucfirst($userResponse->interest_level) }}</p>
                                            @endif
                                            @if($userResponse->investment_amount)
                                                <p class="text-sm text-gray-600">Amount: ${{ number_format((float)$userResponse->investment_amount, 2) }}</p>
                                            @endif
                                        </div>
                                    @else
                                        <div class="mt-3">
                                            <button onclick="respondToInvestment({{ $message->id }})" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 text-sm">
                                                <i class="bx bx-message-check mr-2"></i>Respond to Investment
                                            </button>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                        
                        <!-- Message Actions -->
                        <div class="flex items-center space-x-2 ml-4">
                            @if($message->message_type === 'investment' && auth()->user()->isAdmin())
                                <button onclick="viewResponses({{ $message->id }})" class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100">
                                    <i class="bx bx-chart"></i>
                                </button>
                            @endif
                            
                            <button class="p-2 text-gray-400 hover:text-gray-600 rounded-lg hover:bg-gray-100">
                                <i class="bx bx-dots-horizontal-rounded"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center">
                    <i class="bx bx-message text-gray-400 text-4xl mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No messages yet</h3>
                    <p class="text-gray-500 mb-4">When you send or receive messages, they'll appear here.</p>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('messages.create-investment-broadcast-form') }}" class="inline-flex items-center px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700">
                            <i class="bx bx-plus mr-2"></i>Create Your First Broadcast
                        </a>
                    @endif
                </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if($messages->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
</div>

<!-- Response Modal (for investment messages) -->
<div id="responseModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg max-w-md w-full p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Respond to Investment</h3>
            
            <form id="responseForm" class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Your Interest</label>
                    <select name="response_type" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                        <option value="">Select your interest</option>
                        <option value="interested">Interested</option>
                        <option value="not_interested">Not Interested</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Interest Level</label>
                    <select name="interest_level" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500">
                        <option value="">Select level</option>
                        <option value="high">High</option>
                        <option value="medium">Medium</option>
                        <option value="low">Low</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Potential Investment Amount</label>
                    <input type="number" name="investment_amount" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="0.00">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Comments</label>
                    <textarea name="comments" rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500" placeholder="Any additional comments..."></textarea>
                </div>
                
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeResponseModal()" class="px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700">
                        Submit Response
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
let currentMessageId = null;

function respondToInvestment(messageId) {
    currentMessageId = messageId;
    document.getElementById('responseModal').classList.remove('hidden');
}

function closeResponseModal() {
    document.getElementById('responseModal').classList.add('hidden');
    currentMessageId = null;
}

document.getElementById('responseForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    if (!currentMessageId) return;
    
    const formData = new FormData(this);
    const data = Object.fromEntries(formData);
    
    fetch(`/messages/${currentMessageId}/respond-investment`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('[name="csrf-token"]').content
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.message) {
            alert(data.message);
            closeResponseModal();
            location.reload();
        } else {
            alert('Error submitting response');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error submitting response');
    });
});

function viewResponses(messageId) {
    window.location.href = `/messages/${messageId}/investment-responses`;
}
</script>
@endsection
