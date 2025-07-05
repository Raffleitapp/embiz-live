@extends('layouts.dashboard')

@section('page-title', 'Dashboard')

@section('header-actions')
    <div class="flex items-center space-x-3">
        <div class="relative">
            <i class='bx bx-search absolute left-3 top-3 text-gray-400'></i>
            <input type="text" placeholder="Search members"
                class="pl-10 pr-4 py-2 w-full sm:w-80 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm"
                id="searchInput">
        </div>
    </div>
@endsection

@section('content')
    <div class="space-y-6">
        <!-- Welcome Section -->
        <div class="bg-teal-600 rounded-lg p-6 text-white">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-bold mb-2">Welcome back, {{ auth()->user()->name }}!</h2>
                    <p class="text-teal-100">Here's what's happening with your business network today.</p>
                </div>
                <div class="hidden md:block">
                    <i class='bx bx-world text-6xl text-white opacity-20'></i>
                </div>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-sm font-medium text-gray-600">Total Users</div>
                        <div class="text-3xl font-bold text-gray-900 mt-1">{{ $totalUsers ?? 0 }}</div>
                        <div class="text-sm text-green-600 mt-1">
                            <i class='bx bx-trending-up'></i> +12% from last month
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-blue-50 rounded-full flex items-center justify-center">
                        <i class='bx bx-user text-blue-600 text-xl'></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-sm font-medium text-gray-600">Active Users</div>
                        <div class="text-3xl font-bold text-gray-900 mt-1">{{ $activeUsers ?? 0 }}</div>
                        <div class="text-sm text-green-600 mt-1">
                            <i class='bx bx-trending-up'></i> +8% from last week
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-green-50 rounded-full flex items-center justify-center">
                        <i class='bx bx-check-circle text-green-600 text-xl'></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-sm font-medium text-gray-600">Founding Members</div>
                        <div class="text-3xl font-bold text-gray-900 mt-1">{{ $foundingMembers ?? 0 }}</div>
                        <div class="text-sm text-blue-600 mt-1">
                            <i class='bx bx-crown'></i> Premium tier
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-purple-50 rounded-full flex items-center justify-center">
                        <i class='bx bx-crown text-purple-600 text-xl'></i>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6 border border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="text-sm font-medium text-gray-600">Total Opportunities</div>
                        <div class="text-3xl font-bold text-gray-900 mt-1">{{ $totalOpportunities ?? 0 }}</div>
                        <div class="text-sm text-orange-600 mt-1">
                            <i class='bx bx-briefcase'></i> {{ $activeOpportunities ?? 0 }} active
                        </div>
                    </div>
                    <div class="w-12 h-12 bg-orange-50 rounded-full flex items-center justify-center">
                        <i class='bx bx-briefcase text-orange-600 text-xl'></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts and Analytics Row -->
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            <!-- User Growth Chart -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">User Growth</h3>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 text-sm bg-teal-100 text-teal-700 rounded-full">7d</button>
                        <button class="px-3 py-1 text-sm text-gray-500 hover:bg-gray-100 rounded-full">30d</button>
                        <button class="px-3 py-1 text-sm text-gray-500 hover:bg-gray-100 rounded-full">90d</button>
                    </div>
                </div>
                <div class="h-64 flex items-center justify-center bg-gray-50 rounded-lg">
                    <div class="text-center">
                        <i class='bx bx-trending-up text-4xl text-gray-400 mb-2'></i>
                        <p class="text-gray-500">Chart visualization will be here</p>
                        <p class="text-sm text-gray-400">Integration with Chart.js or similar library</p>
                    </div>
                </div>
            </div>

            <!-- User Activity -->
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">User Activity</h3>
                    <button class="text-sm text-teal-600 hover:text-teal-700">View all</button>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class='bx bx-user-plus text-green-600 text-sm'></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">New user registered</p>
                            <p class="text-xs text-gray-500 truncate">John Doe joined as entrepreneur</p>
                        </div>
                        <span class="text-xs text-gray-400 flex-shrink-0">2 min ago</span>
                    </div>

                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class='bx bx-briefcase text-blue-600 text-sm'></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">New opportunity posted</p>
                            <p class="text-xs text-gray-500 truncate">Tech startup seeking funding</p>
                        </div>
                        <span class="text-xs text-gray-400 flex-shrink-0">15 min ago</span>
                    </div>

                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class='bx bx-link text-purple-600 text-sm'></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">New connection made</p>
                            <p class="text-xs text-gray-500 truncate">Sarah connected with Mike</p>
                        </div>
                        <span class="text-xs text-gray-400 flex-shrink-0">1 hour ago</span>
                    </div>

                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class='bx bx-message text-orange-600 text-sm'></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-gray-900 truncate">Message sent</p>
                            <p class="text-xs text-gray-500 truncate">Business proposal discussion</p>
                        </div>
                        <span class="text-xs text-gray-400 flex-shrink-0">3 hours ago</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <a href="{{ route('dashboard.add-member') }}"
                    class="flex items-center space-x-3 p-4 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class='bx bx-user-plus text-blue-600'></i>
                    </div>
                    <div class="min-w-0">
                        <div class="font-medium text-gray-900 truncate">Add Member</div>
                        <div class="text-sm text-gray-500 truncate">Invite new users</div>
                    </div>
                </a>

                <a href="{{ route('opportunities.create') }}"
                    class="flex items-center space-x-3 p-4 bg-green-50 rounded-lg hover:bg-green-100 transition-colors">
                    <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class='bx bx-briefcase text-green-600'></i>
                    </div>
                    <div class="min-w-0">
                        <div class="font-medium text-gray-900 truncate">Create Opportunity</div>
                        <div class="text-sm text-gray-500 truncate">Post new business opportunity</div>
                    </div>
                </a>

                <a href="{{ route('dashboard.members') }}"
                    class="flex items-center space-x-3 p-4 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors">
                    <div class="w-10 h-10 bg-purple-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class='bx bx-group text-purple-600'></i>
                    </div>
                    <div class="min-w-0">
                        <div class="font-medium text-gray-900 truncate">Manage Members</div>
                        <div class="text-sm text-gray-500 truncate">View and edit users</div>
                    </div>
                </a>

                <a href="#"
                    class="flex items-center space-x-3 p-4 bg-orange-50 rounded-lg hover:bg-orange-100 transition-colors">
                    <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center flex-shrink-0">
                        <i class='bx bx-chart text-orange-600'></i>
                    </div>
                    <div class="min-w-0">
                        <div class="font-medium text-gray-900 truncate">View Analytics</div>
                        <div class="text-sm text-gray-500 truncate">Detailed reports</div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Recent Users -->
        <div class="bg-white rounded-lg shadow-sm">
            <div class="px-4 sm:px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-gray-900">Recent Users</h3>
                    <a href="{{ route('dashboard.members') }}"
                        class="text-sm text-teal-600 hover:text-teal-700 font-medium">View All</a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                User</th>
                            <th
                                class="hidden sm:table-cell px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Role</th>
                            <th
                                class="hidden md:table-cell px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status</th>
                            <th
                                class="hidden lg:table-cell px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Joined</th>
                            <th
                                class="px-4 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @if (isset($users) && count($users) > 0)
                            @foreach ($users as $user)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 sm:px-6 py-4">
                                        <div class="flex items-center">
                                            <div
                                                class="w-10 h-10 bg-teal-600 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                                <span
                                                    class="text-white font-medium text-sm">{{ substr($user->name ?? 'U', 0, 1) }}</span>
                                            </div>
                                            <div class="min-w-0 flex-1">
                                                <div class="text-sm font-medium text-gray-900 truncate">
                                                    {{ $user->name ?? 'N/A' }}</div>
                                                <div class="text-sm text-gray-500 truncate">{{ $user->email ?? 'N/A' }}
                                                </div>
                                                <!-- Show role and status on mobile -->
                                                <div class="sm:hidden">
                                                    @if ($user->profile && $user->profile->is_founding_member)
                                                        <span
                                                            class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 mt-1">
                                                            <i class='bx bx-crown mr-1'></i>
                                                            Founding
                                                        </span>
                                                    @else
                                                        <span
                                                            class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 mt-1">
                                                            {{ $user->profile ? $user->profile->profile_type : 'User' }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="hidden sm:table-cell px-4 sm:px-6 py-4">
                                        @if ($user->profile && $user->profile->is_founding_member)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                <i class='bx bx-crown mr-1'></i>
                                                Founding Member
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                {{ $user->profile ? $user->profile->profile_type : 'User' }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="hidden md:table-cell px-4 sm:px-6 py-4">
                                        @if ($user->profile && $user->profile->is_verified)
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <i class='bx bx-check-circle mr-1'></i>
                                                Verified
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                <i class='bx bx-time mr-1'></i>
                                                Pending
                                            </span>
                                        @endif
                                    </td>
                                    <td class="hidden lg:table-cell px-4 sm:px-6 py-4 text-sm text-gray-500">
                                        {{ $user->created_at ? $user->created_at->format('M d, Y') : 'N/A' }}
                                    </td>
                                    <td class="px-4 sm:px-6 py-4">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('user-profile.show', $user) }}"
                                                class="text-blue-600 hover:text-blue-800" title="View Profile">
                                                <i class='bx bx-show text-lg'></i>
                                            </a>
                                            <button class="text-gray-400 hover:text-gray-600"
                                                onclick="toggleUserActions({{ $user->id }})" title="More Actions">
                                                <i class='bx bx-dots-horizontal-rounded text-lg'></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="px-4 sm:px-6 py-8 text-center text-gray-500">
                                    <i class='bx bx-user-plus text-4xl text-gray-300 mb-2'></i>
                                    <p class="text-lg mb-1">No users found</p>
                                    <p class="text-sm">Get started by adding your first member</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Toggle user actions dropdown
        function toggleUserActions(userId) {
            // This is a placeholder for user actions functionality
            // You can implement dropdown menus, modals, etc.
            console.log('User actions for user ID:', userId);
        }

        // Dashboard analytics - placeholder for future chart integration
        document.addEventListener('DOMContentLoaded', function() {
            // Animate counter numbers
            animateCounters();

            // Real-time updates every 30 seconds
            setInterval(function() {
                // updateDashboardStats();
            }, 30000);
        });

        function animateCounters() {
            const counters = document.querySelectorAll('.text-3xl.font-bold');
            counters.forEach(counter => {
                const target = parseInt(counter.textContent);
                const increment = Math.ceil(target / 100);
                let current = 0;

                const updateCounter = () => {
                    if (current < target) {
                        current += increment;
                        counter.textContent = Math.min(current, target);
                        requestAnimationFrame(updateCounter);
                    }
                };

                // Start animation after a brief delay
                setTimeout(updateCounter, 100);
            });
        }

        // Update dashboard statistics (for future real-time updates)
        function updateDashboardStats() {
            fetch('{{ route('dashboard') }}', {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Update statistics
                    console.log('Dashboard stats updated');
                })
                .catch(error => {
                    console.error('Error updating dashboard stats:', error);
                });
        }
    </script>
@endpush
