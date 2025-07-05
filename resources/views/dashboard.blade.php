@extends('layouts.dashboard')

@section('page-title', 'Dashboard')

@section('header-actions')
<div class="relative">
    <i class='bx bx-search absolute left-3 top-3 text-gray-400'></i>
    <input type="text" 
           placeholder="Search members by name/email" 
           class="pl-10 pr-4 py-2 w-80 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
           id="searchInput">
</div>
@endsection

@section('content')
            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-medium text-gray-600">Total Users</div>
                            <div class="text-2xl font-bold text-gray-900 mt-1" id="totalUsers">{{ $totalUsers ?? 0 }}</div>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class='bx bx-user text-blue-600 text-xl'></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-medium text-gray-600">Active Users</div>
                            <div class="text-2xl font-bold text-gray-900 mt-1" id="activeUsers">{{ $activeUsers ?? 0 }}</div>
                        </div>
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                            <i class='bx bx-check-circle text-green-600 text-xl'></i>
                        </div>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <div class="text-sm font-medium text-gray-600">Founding Members</div>
                            <div class="text-2xl font-bold text-gray-900 mt-1" id="foundingMembers">{{ $foundingMembers ?? 0 }}</div>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                            <i class='bx bx-crown text-purple-600 text-xl'></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User List -->
            <div class="bg-white rounded-lg shadow-sm">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">User List</h3>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-teal-600 focus:ring-teal-500">
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registered Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Login</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="userTableBody">
                            @forelse($users ?? [] as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <input type="checkbox" class="rounded border-gray-300 text-teal-600 focus:ring-teal-500">
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-900">#{{ $user->id }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 bg-teal-600 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-white font-medium text-xs">{{ substr($user->name, 0, 1) }}</span>
                                        </div>
                                        <div>
                                            <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                            <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($user->profile && $user->profile->is_founding_member)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                            Founding Member
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ $user->profile->profile_type ?? 'User' }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    @if($user->profile && !$user->profile->is_verified)
                                        <span class="text-amber-600">Pending Approval</span>
                                    @else
                                        {{ $user->created_at->format('d M Y') }}
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $user->updated_at->format('M d, Y \a\t g:i A') }}
                                </td>
                                <td class="px-6 py-4">
                                    <button class="text-gray-400 hover:text-gray-600">
                                        <i class='bx bx-dots-horizontal-rounded text-xl'></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                    No users found.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Select all checkbox functionality
document.getElementById('selectAll').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('#userTableBody input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
});

// Search functionality
document.getElementById('searchInput').addEventListener('input', async function() {
    const searchTerm = this.value;
    
    if (searchTerm.length > 2) {
        try {
            const response = await fetch(`{{ route('dashboard.search-members') }}?q=${encodeURIComponent(searchTerm)}`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                }
            });
            
            const users = await response.json();
            updateUserTable(users);
        } catch (error) {
            console.error('Error searching users:', error);
        }
    } else if (searchTerm.length === 0) {
        // Reset to original view
        location.reload();
    }
});

function updateUserTable(users) {
    const tbody = document.getElementById('userTableBody');
    
    if (users.length === 0) {
        tbody.innerHTML = `
            <tr>
                <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                    No users found.
                </td>
            </tr>
        `;
        return;
    }
    
    tbody.innerHTML = users.map(user => `
        <tr class="hover:bg-gray-50">
            <td class="px-6 py-4">
                <input type="checkbox" class="rounded border-gray-300 text-teal-600 focus:ring-teal-500">
            </td>
            <td class="px-6 py-4 text-sm text-gray-900">#${user.id}</td>
            <td class="px-6 py-4">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-teal-600 rounded-full flex items-center justify-center mr-3">
                        <span class="text-white font-medium text-xs">${user.name.charAt(0)}</span>
                    </div>
                    <div>
                        <div class="text-sm font-medium text-gray-900">${user.name}</div>
                        <div class="text-sm text-gray-500">${user.email}</div>
                    </div>
                </div>
            </td>
            <td class="px-6 py-4">
                ${user.profile && user.profile.is_founding_member 
                    ? '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">Founding Member</span>'
                    : '<span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">' + (user.profile?.profile_type || 'User') + '</span>'
                }
            </td>
            <td class="px-6 py-4 text-sm text-gray-500">
                ${user.profile && !user.profile.is_verified 
                    ? '<span class="text-amber-600">Pending Approval</span>'
                    : new Date(user.created_at).toLocaleDateString('en-GB', { day: 'numeric', month: 'short', year: 'numeric' })
                }
            </td>
            <td class="px-6 py-4 text-sm text-gray-500">
                ${new Date(user.updated_at).toLocaleDateString('en-US', { 
                    month: 'short', 
                    day: 'numeric', 
                    year: 'numeric' 
                })} at ${new Date(user.updated_at).toLocaleTimeString('en-US', { 
                    hour: 'numeric', 
                    minute: '2-digit', 
                    hour12: true 
                })}
            </td>
            <td class="px-6 py-4">
                <button class="text-gray-400 hover:text-gray-600">
                    <i class='bx bx-dots-horizontal-rounded text-xl'></i>
                </button>
            </td>
        </tr>
    `).join('');
}
</script>
@endpush
