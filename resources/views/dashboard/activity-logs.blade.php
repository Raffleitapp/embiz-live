@extends('layouts.dashboard')

@section('page-title', 'Activity Logs')

@section('header-icon')
<i class="bx bx-list-ul text-gray-600 text-lg sm:text-xl"></i>
@endsection

@section('header-actions')
<div class="flex flex-col sm:flex-row items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-3">
    <div class="relative w-full sm:w-auto">
        <i class='bx bx-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400'></i>
        <input type="text" 
               placeholder="Search activities..." 
               class="pl-10 pr-4 py-2 w-full sm:w-64 lg:w-80 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm"
               id="searchInput">
    </div>
    <select class="px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm w-full sm:w-auto" id="typeFilter">
        <option value="">All Activities</option>
        <option value="create">Create</option>
        <option value="update">Update</option>
        <option value="delete">Delete</option>
        <option value="login">Login</option>
        <option value="message">Message</option>
        <option value="connection">Connection</option>
    </select>
</div>
@endsection

@section('content')
<div class="p-3 sm:p-4 lg:p-6">
    <!-- Stats Overview -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 lg:gap-6 mb-4 sm:mb-6">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-3 sm:p-4">
            <div class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900">{{ $activities->total() }}</div>
            <div class="text-xs sm:text-sm text-gray-600">Total Activities</div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-3 sm:p-4">
            <div class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900">{{ \App\Models\ActivityLog::whereDate('created_at', today())->count() }}</div>
            <div class="text-xs sm:text-sm text-gray-600">Today</div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-3 sm:p-4">
            <div class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900">{{ \App\Models\ActivityLog::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count() }}</div>
            <div class="text-xs sm:text-sm text-gray-600">This Week</div>
        </div>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-3 sm:p-4">
            <div class="text-lg sm:text-xl lg:text-2xl font-bold text-gray-900">{{ \App\Models\ActivityLog::where('type', 'login')->count() }}</div>
            <div class="text-xs sm:text-sm text-gray-600">Total Logins</div>
        </div>
    </div>

    <!-- Activity Timeline -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-4 sm:p-6 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">Recent Activities</h3>
        </div>
        
        <div class="p-4 sm:p-6">
            @if($activities->count() > 0)
                <div class="space-y-4" id="activitiesList">
                    @foreach($activities as $activity)
                        <div class="flex items-start space-x-3 p-3 sm:p-4 border border-gray-100 rounded-lg hover:bg-gray-50 transition-colors activity-item" data-type="{{ $activity->type }}">
                            <div class="flex-shrink-0">
                                <div class="w-8 h-8 sm:w-10 sm:h-10 bg-{{ $activity->type === 'create' ? 'green' : ($activity->type === 'update' ? 'blue' : ($activity->type === 'delete' ? 'red' : ($activity->type === 'login' ? 'teal' : 'gray'))) }}-100 rounded-full flex items-center justify-center">
                                    @if($activity->type === 'create')
                                        <i class='bx bx-plus text-green-600 text-sm sm:text-base'></i>
                                    @elseif($activity->type === 'update')
                                        <i class='bx bx-edit text-blue-600 text-sm sm:text-base'></i>
                                    @elseif($activity->type === 'delete')
                                        <i class='bx bx-trash text-red-600 text-sm sm:text-base'></i>
                                    @elseif($activity->type === 'login')
                                        <i class='bx bx-log-in text-teal-600 text-sm sm:text-base'></i>
                                    @elseif($activity->type === 'message')
                                        <i class='bx bx-message text-purple-600 text-sm sm:text-base'></i>
                                    @elseif($activity->type === 'connection')
                                        <i class='bx bx-user-plus text-indigo-600 text-sm sm:text-base'></i>
                                    @else
                                        <i class='bx bx-info-circle text-gray-600 text-sm sm:text-base'></i>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="flex-1 min-w-0">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                                    <div class="flex-1">
                                        <div class="font-medium text-gray-900 text-sm">{{ $activity->user->full_name }}</div>
                                        <div class="text-sm text-gray-600">{{ $activity->action }}</div>
                                        <div class="text-xs text-gray-500 mt-1">{{ $activity->description }}</div>
                                    </div>
                                    <div class="text-xs text-gray-400 mt-2 sm:mt-0 sm:ml-4">
                                        {{ $activity->created_at->diffForHumans() }}
                                    </div>
                                </div>
                                
                                <div class="flex flex-wrap gap-2 mt-2">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-{{ $activity->type === 'create' ? 'green' : ($activity->type === 'update' ? 'blue' : ($activity->type === 'delete' ? 'red' : ($activity->type === 'login' ? 'teal' : 'gray'))) }}-100 text-{{ $activity->type === 'create' ? 'green' : ($activity->type === 'update' ? 'blue' : ($activity->type === 'delete' ? 'red' : ($activity->type === 'login' ? 'teal' : 'gray'))) }}-800">
                                        {{ ucfirst($activity->type) }}
                                    </span>
                                    @if($activity->ip_address)
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ $activity->ip_address }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                @if($activities->hasPages())
                <div class="mt-6 pt-4 border-t border-gray-200">
                    {{ $activities->links() }}
                </div>
                @endif
            @else
                <div class="text-center py-8 sm:py-12">
                    <i class='bx bx-list-ul text-4xl sm:text-5xl text-gray-300 mb-4'></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No activities yet</h3>
                    <p class="text-gray-500 text-sm">Activity logs will appear here as users interact with the system.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const activities = document.querySelectorAll('.activity-item');
    
    activities.forEach(activity => {
        const text = activity.textContent.toLowerCase();
        if (text.includes(searchTerm)) {
            activity.style.display = '';
        } else {
            activity.style.display = 'none';
        }
    });
});

// Filter by type
document.getElementById('typeFilter').addEventListener('change', function() {
    const filterType = this.value;
    const activities = document.querySelectorAll('.activity-item');
    
    activities.forEach(activity => {
        const activityType = activity.dataset.type;
        if (filterType === '' || activityType === filterType) {
            activity.style.display = '';
        } else {
            activity.style.display = 'none';
        }
    });
});
</script>
@endsection
