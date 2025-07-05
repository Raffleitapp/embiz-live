@extends('layouts.main')

@section('content')
<div class="flex min-h-screen bg-gray-50">
    <!-- Sidebar -->
    <div class="w-64 bg-white shadow-lg">
        <div class="p-6">
            <div class="flex items-center space-x-2 mb-8">
                <div class="w-8 h-8 bg-teal-600 rounded-lg flex items-center justify-center">
                    <span class="text-white font-bold text-sm">E</span>
                </div>
                <span class="text-xl font-bold text-gray-800">Embiz</span>
            </div>
            
            <nav class="space-y-2">
                <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">GENERAL</div>
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg">
                    <i class='bx bx-grid-alt text-lg'></i>
                    <span class="font-medium">Dashboard</span>
                </a>
                
                <div class="relative">
                    <button class="flex items-center justify-between w-full px-3 py-2 text-teal-600 bg-teal-50 rounded-lg" onclick="toggleSubmenu('members')">
                        <div class="flex items-center space-x-3">
                            <i class='bx bx-users text-lg'></i>
                            <span class="font-medium">Members</span>
                        </div>
                        <i class='bx bx-chevron-down text-sm transform rotate-180 transition-transform' id="members-chevron"></i>
                    </button>
                    <div class="mt-2 ml-6 space-y-1 block" id="members-submenu">
                        <a href="{{ route('dashboard.members') }}" class="block px-3 py-2 text-sm text-teal-600 font-medium">All Members</a>
                        <a href="{{ route('dashboard.add-member') }}" class="block px-3 py-2 text-sm text-gray-600 hover:text-gray-900">Add Member</a>
                    </div>
                </div>
                
                <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg">
                    <i class='bx bx-shield text-lg'></i>
                    <span class="font-medium">Roles & Permissions</span>
                </a>
                
                <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg">
                    <i class='bx bx-list-ul text-lg'></i>
                    <span class="font-medium">Activity Logs</span>
                </a>
                
                <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3 mt-6">OTHERS</div>
                <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg">
                    <i class='bx bx-cog text-lg'></i>
                    <span class="font-medium">Settings</span>
                </a>
                
                <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg">
                    <i class='bx bx-help-circle text-lg'></i>
                    <span class="font-medium">Support / Help</span>
                </a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg w-full text-left">
                        <i class='bx bx-log-out text-lg'></i>
                        <span class="font-medium">Logout</span>
                    </button>
                </form>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 overflow-hidden">
        <!-- Header -->
        <div class="bg-white shadow-sm border-b">
            <div class="px-6 py-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                            <i class='bx bx-users text-gray-600 text-xl'></i>
                        </div>
                        <h1 class="text-2xl font-bold text-gray-900">Members</h1>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <i class='bx bx-search absolute left-3 top-3 text-gray-400'></i>
                            <input type="text" 
                                   id="searchInput"
                                   placeholder="Search members by name/email" 
                                   class="pl-10 pr-4 py-2 w-80 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                        </div>
                        
                        <div class="relative">
                            <button class="p-2 text-gray-400 hover:text-gray-600">
                                <i class='bx bx-bell text-xl'></i>
                            </button>
                        </div>
                        
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 bg-teal-600 rounded-full flex items-center justify-center">
                                <span class="text-white font-medium text-sm">{{ substr(auth()->user()->name, 0, 1) }}</span>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</div>
                                <div class="text-xs text-gray-500">Admin</div>
                            </div>
                            <i class='bx bx-chevron-down text-gray-400'></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Members Content -->
        <div class="p-6">
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Actions Bar -->
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-4">
                    <button class="px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50">
                        <i class='bx bx-filter text-sm mr-2'></i>
                        Filter
                    </button>
                    <button class="px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50">
                        <i class='bx bx-export text-sm mr-2'></i>
                        Export
                    </button>
                </div>
                <a href="{{ route('dashboard.add-member') }}" 
                   class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors">
                    <i class='bx bx-plus text-sm mr-2'></i>
                    Add Member
                </a>
            </div>

            <!-- User List -->
            <div class="bg-white rounded-lg shadow-sm">
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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Registered Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Last Login</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200" id="userTableBody">
                            @forelse($users as $user)
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
                                            {{ ucfirst($user->profile->profile_type ?? 'User') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if($user->profile && $user->profile->is_verified)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Active
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Pending Approval
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $user->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $user->updated_at->format('M d, Y \a\t g:i A') }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="relative">
                                        <button class="text-gray-400 hover:text-gray-600" onclick="toggleDropdown({{ $user->id }})">
                                            <i class='bx bx-dots-horizontal-rounded text-xl'></i>
                                        </button>
                                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-200 z-10 hidden" id="dropdown-{{ $user->id }}">
                                            <div class="py-1">
                                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                                    <i class='bx bx-edit text-sm mr-2'></i>
                                                    Edit
                                                </a>
                                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                                    <i class='bx bx-shield text-sm mr-2'></i>
                                                    Change Role
                                                </a>
                                                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                                                    <i class='bx bx-toggle-left text-sm mr-2'></i>
                                                    Toggle Status
                                                </a>
                                                <hr class="my-1">
                                                <a href="#" class="block px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                                                    <i class='bx bx-trash text-sm mr-2'></i>
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                                    No members found.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if($users->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $users->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
function toggleSubmenu(submenu) {
    const submenuElement = document.getElementById(submenu + '-submenu');
    const chevron = document.getElementById(submenu + '-chevron');
    
    if (submenuElement.style.display === 'none') {
        submenuElement.style.display = 'block';
        chevron.style.transform = 'rotate(180deg)';
    } else {
        submenuElement.style.display = 'none';
        chevron.style.transform = 'rotate(0deg)';
    }
}

function toggleDropdown(userId) {
    // Close all other dropdowns
    document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
        if (dropdown.id !== `dropdown-${userId}`) {
            dropdown.classList.add('hidden');
        }
    });
    
    // Toggle the clicked dropdown
    const dropdown = document.getElementById(`dropdown-${userId}`);
    dropdown.classList.toggle('hidden');
}

// Close dropdowns when clicking outside
document.addEventListener('click', function(event) {
    if (!event.target.closest('[onclick^="toggleDropdown"]')) {
        document.querySelectorAll('[id^="dropdown-"]').forEach(dropdown => {
            dropdown.classList.add('hidden');
        });
    }
});

// Select all checkbox functionality
document.getElementById('selectAll').addEventListener('change', function() {
    const checkboxes = document.querySelectorAll('#userTableBody input[type="checkbox"]');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
});

// Search functionality
document.getElementById('searchInput').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase();
    const rows = document.querySelectorAll('#userTableBody tr');
    
    rows.forEach(row => {
        const nameCell = row.querySelector('td:nth-child(3)');
        if (nameCell) {
            const name = nameCell.textContent.toLowerCase();
            if (name.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
});
</script>
@endsection
