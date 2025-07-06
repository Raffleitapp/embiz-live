@extends('layouts.dashboard')

@section('page-title', 'Dashboard')

@section('header-actions')
    <div class="flex items-center space-x-3">
        <a href="{{ route('opportunities.create') }}" class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 text-sm font-medium">
            <i class="bx bx-plus mr-2"></i>Create Opportunity
        </a>
    </div>
@endsection

@section('content')
    <div class="space-y-4 sm:space-y-6">
        <!-- Welcome Section -->
        <div class="bg-teal-600 rounded-lg p-4 sm:p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold mb-2">Welcome back, {{ auth()->user()->name }}!</h2>
                    <p class="text-teal-100 text-sm sm:text-base">Here's your business network overview.</p>
                </div>
                <div class="hidden md:block">
                    <i class='bx bx-user text-4xl lg:text-6xl text-white opacity-20'></i>
                </div>
            </div>
        </div>

        <!-- User Stats Cards -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
            <div class="bg-white rounded-lg shadow-sm p-4 sm:p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-xs sm:text-sm font-medium text-gray-600">My Connections</div>
                        <div class="text-xl sm:text-3xl font-bold text-gray-900 mt-1">{{ $userConnections ?? 0 }}</div>
                        <div class="text-xs sm:text-sm text-blue-600 mt-1">
                            <i class='bx bx-trending-up'></i> <span class="hidden sm:inline">Network growing</span><span class="sm:hidden">Growing</span>
                        </div>
                    </div>
                    <div class="w-8 h-8 sm:w-12 sm:h-12 bg-blue-50 rounded-full flex items-center justify-center">
                        <i class='bx bx-user-circle text-blue-600 text-sm sm:text-xl'></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-4 sm:p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-xs sm:text-sm font-medium text-gray-600">Messages</div>
                        <div class="text-xl sm:text-3xl font-bold text-gray-900 mt-1">{{ $userMessages ?? 0 }}</div>
                        <div class="text-xs sm:text-sm text-orange-600 mt-1">
                            <i class='bx bx-message'></i> <span class="hidden sm:inline">{{ $unreadMessages ?? 0 }} unread</span><span class="sm:hidden">{{ $unreadMessages ?? 0 }} new</span>
                        </div>
                    </div>
                    <div class="w-8 h-8 sm:w-12 sm:h-12 bg-orange-50 rounded-full flex items-center justify-center">
                        <i class='bx bx-message-dots text-orange-600 text-sm sm:text-xl'></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-4 sm:p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-xs sm:text-sm font-medium text-gray-600">My Opportunities</div>
                        <div class="text-xl sm:text-3xl font-bold text-gray-900 mt-1">{{ $userOpportunities ?? 0 }}</div>
                        <div class="text-xs sm:text-sm text-green-600 mt-1">
                            <i class='bx bx-briefcase'></i> <span class="hidden sm:inline">Active posts</span><span class="sm:hidden">Active</span>
                        </div>
                    </div>
                    <div class="w-8 h-8 sm:w-12 sm:h-12 bg-green-50 rounded-full flex items-center justify-center">
                        <i class='bx bx-briefcase text-green-600 text-sm sm:text-xl'></i>
                    </div>
                </div>
            </div>

            @if(auth()->user()->isFoundingMember())
            <div class="bg-white rounded-lg shadow-sm p-4 sm:p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-xs sm:text-sm font-medium text-gray-600">Member Status</div>
                        <div class="text-sm sm:text-lg font-bold text-purple-900 mt-1">Founding Member</div>
                        <div class="text-xs sm:text-sm text-purple-600 mt-1">
                            <i class='bx bx-crown'></i> <span class="hidden sm:inline">Premium access</span><span class="sm:hidden">Premium</span>
                        </div>
                    </div>
                    <div class="w-8 h-8 sm:w-12 sm:h-12 bg-purple-50 rounded-full flex items-center justify-center">
                        <i class='bx bx-crown text-purple-600 text-sm sm:text-xl'></i>
                    </div>
                </div>
            </div>
            @else
            <div class="bg-white rounded-lg shadow-sm p-4 sm:p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-xs sm:text-sm font-medium text-gray-600">Profile Status</div>
                        <div class="text-sm sm:text-lg font-bold text-gray-900 mt-1">Active Member</div>
                        <div class="text-xs sm:text-sm text-gray-600 mt-1">
                            <i class='bx bx-check-circle'></i> <span class="hidden sm:inline">Verified account</span><span class="sm:hidden">Verified</span>
                        </div>
                    </div>
                    <div class="w-8 h-8 sm:w-12 sm:h-12 bg-gray-50 rounded-full flex items-center justify-center">
                        <i class='bx bx-user-check text-gray-600 text-sm sm:text-xl'></i>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
            <!-- Quick Actions -->
            <div class="bg-white rounded-lg shadow-sm p-4 sm:p-6">
                <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('opportunities.index') }}"
                        class="flex flex-col sm:flex-row items-center sm:space-x-3 p-3 sm:p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mb-2 sm:mb-0">
                            <i class='bx bx-search text-blue-600 text-sm sm:text-base'></i>
                        </div>
                        <div class="min-w-0 text-center sm:text-left">
                            <div class="font-medium text-gray-900 truncate text-sm sm:text-base">Find Opportunities</div>
                            <div class="text-xs sm:text-sm text-gray-500 truncate hidden sm:block">Explore new deals</div>
                        </div>
                    </a>

                    <a href="{{ route('network.index') }}"
                        class="flex flex-col sm:flex-row items-center sm:space-x-3 p-3 sm:p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mb-2 sm:mb-0">
                            <i class='bx bx-group text-green-600 text-sm sm:text-base'></i>
                        </div>
                        <div class="min-w-0 text-center sm:text-left">
                            <div class="font-medium text-gray-900 truncate text-sm sm:text-base">Network</div>
                            <div class="text-xs sm:text-sm text-gray-500 truncate hidden sm:block">Connect with others</div>
                        </div>
                    </a>

                    <a href="{{ route('messages.index') }}"
                        class="flex flex-col sm:flex-row items-center sm:space-x-3 p-3 sm:p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0 mb-2 sm:mb-0">
                            <i class='bx bx-message text-purple-600 text-sm sm:text-base'></i>
                        </div>
                        <div class="min-w-0 text-center sm:text-left">
                            <div class="font-medium text-gray-900 truncate text-sm sm:text-base">Messages</div>
                            <div class="text-xs sm:text-sm text-gray-500 truncate hidden sm:block">Check your inbox</div>
                        </div>
                    </a>

                    <a href="{{ route('user-profile') }}"
                        class="flex flex-col sm:flex-row items-center sm:space-x-3 p-3 sm:p-4 bg-orange-50 rounded-lg hover:bg-orange-100 transition-colors">
                        <div class="w-8 h-8 sm:w-10 sm:h-10 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0 mb-2 sm:mb-0">
                            <i class='bx bx-user text-orange-600 text-sm sm:text-base'></i>
                        </div>
                        <div class="min-w-0 text-center sm:text-left">
                            <div class="font-medium text-gray-900 truncate text-sm sm:text-base">My Profile</div>
                            <div class="text-xs sm:text-sm text-gray-500 truncate hidden sm:block">Update your info</div>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-lg shadow-sm p-4 sm:p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900">Recent Activity</h3>
                    <a href="{{ route('dashboard.activity-logs') }}" class="text-xs sm:text-sm text-teal-600 hover:text-teal-700">View all</a>
                </div>
                
                @if(isset($recentActivities) && $recentActivities->count() > 0)
                    <div class="space-y-4">
                        @foreach($recentActivities as $activity)
                            <div class="flex items-center space-x-3">
                                <div class="w-8 h-8 bg-{{ $activity->type === 'create' ? 'green' : ($activity->type === 'update' ? 'blue' : ($activity->type === 'login' ? 'teal' : 'gray')) }}-100 rounded-full flex items-center justify-center flex-shrink-0">
                                    @if($activity->type === 'create')
                                        <i class='bx bx-plus text-green-600 text-sm'></i>
                                    @elseif($activity->type === 'update')
                                        <i class='bx bx-edit text-blue-600 text-sm'></i>
                                    @elseif($activity->type === 'login')
                                        <i class='bx bx-log-in text-teal-600 text-sm'></i>
                                    @else
                                        <i class='bx bx-info-circle text-gray-600 text-sm'></i>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-gray-900 truncate">{{ $activity->action }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ $activity->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class='bx bx-time text-gray-300 text-4xl mb-2'></i>
                        <p class="text-gray-500 text-sm">No recent activity</p>
                    </div>
                @endif
            </div>
        </div>

        <!-- Investment Messages (if any) -->
        @if(auth()->user()->isFoundingMember() || (auth()->user()->profile && auth()->user()->profile->profile_type === 'investor'))
        <div class="bg-white rounded-lg shadow-sm">
            <div class="px-4 sm:px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900">Investment Opportunities</h3>
                    <a href="{{ route('messages.index') }}" class="text-xs sm:text-sm text-teal-600 hover:text-teal-700 font-medium">View All</a>
                </div>
            </div>

            <div class="p-6">
                @php
                    $investmentMessages = \App\Models\Message::where('recipient_id', auth()->id())
                                                           ->where('message_type', 'investment')
                                                           ->whereNull('read_at')
                                                           ->with('sender')
                                                           ->limit(3)
                                                           ->get();
                @endphp
                
                @if($investmentMessages && $investmentMessages->count() > 0)
                    <div class="space-y-4">
                        @foreach($investmentMessages as $message)
                            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                                <div class="flex items-start justify-between">
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-900 mb-1">{{ $message->subject }}</h4>
                                        <p class="text-sm text-gray-600 mb-2">{{ Str::limit($message->message, 100) }}</p>
                                        <div class="flex items-center text-xs text-gray-500">
                                            <span>From: {{ $message->sender->name }}</span>
                                            <span class="mx-2">•</span>
                                            <span>{{ $message->created_at->format('M j, Y g:i A') }}</span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                            <i class="bx bx-broadcast mr-1"></i>Investment
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8">
                        <i class='bx bx-message-square-dots text-gray-300 text-4xl mb-2'></i>
                        <p class="text-gray-500 text-sm">No new investment opportunities</p>
                    </div>
                @endif
            </div>
        </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        // Refresh stats periodically
        setInterval(function() {
            // Optional: Update stats via AJAX
        }, 60000); // Every minute
    </script>
@endpush
