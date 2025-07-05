@extends('layouts.dashboard')

@section('page-title', 'All Members')

@section('header-actions')
<div class="flex flex-col sm:flex-row items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-3">
    <div class="relative w-full sm:w-auto">
        <i class='bx bx-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400'></i>
        <input type="text" 
               placeholder="Search members..." 
               class="pl-10 pr-4 py-2 w-full sm:w-64 lg:w-80 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm"
               id="searchInput">
    </div>
    <a href="{{ route('dashboard.add-member') }}" class="bg-teal-600 text-white px-3 sm:px-4 py-2 rounded-lg hover:bg-teal-700 transition-colors flex items-center space-x-2 text-sm sm:text-base w-full sm:w-auto justify-center">
        <i class='bx bx-plus'></i>
        <span>Add Member</span>
    </a>
</div>
@endsection

@section('content')
<div class="p-3 sm:p-4 lg:p-6">
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-4 sm:mb-6 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Actions Bar -->
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-4 sm:mb-6 space-y-3 sm:space-y-0">
        <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-2 sm:space-y-0 sm:space-x-4 w-full sm:w-auto">
            <button class="px-3 sm:px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50 text-sm flex items-center w-full sm:w-auto justify-center">
                <i class='bx bx-filter text-sm mr-2'></i>
                Filter
            </button>
            <button class="px-3 sm:px-4 py-2 text-gray-600 border border-gray-300 rounded-lg hover:bg-gray-50 text-sm flex items-center w-full sm:w-auto justify-center">
                <i class='bx bx-export text-sm mr-2'></i>
                Export
            </button>
        </div>
        <a href="{{ route('dashboard.add-member') }}" 
           class="px-3 sm:px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors text-sm flex items-center justify-center w-full sm:w-auto">
            <i class='bx bx-plus text-sm mr-2'></i>
            Add Member
        </a>
    </div>

    <!-- Desktop Table View -->
    <div class="hidden lg:block bg-white rounded-lg shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <input type="checkbox" id="selectAll" class="rounded border-gray-300 text-teal-600 focus:ring-teal-500">
                        </th>
                        {{-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User ID</th> --}}
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
                        {{-- <td class="px-4 py-2 text-sm text-gray-900">#{{ $user->id }}</td> --}}
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="w-8 h-8 bg-teal-600 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-white font-medium text-xs">{{ $user->initials }}</span>
                                </div>
                                <div>
                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-3 py-3">
                            @if($user->profile && $user->profile->is_founding_member)
                                <span class="inline-flex items-center px-2 py-0.8 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
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
                        <td colspan="7" class="px-6 py-4 text-center text-gray-500">
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

    <!-- Mobile Card View -->
    <div class="lg:hidden space-y-3 sm:space-y-4" id="mobileUserList">
        @forelse($users as $user)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 user-card">
            <div class="flex items-start justify-between">
                <div class="flex items-start space-x-3 flex-1">
                    <input type="checkbox" class="rounded border-gray-300 text-teal-600 focus:ring-teal-500 mt-1">
                    <div class="w-10 h-10 bg-teal-600 rounded-full flex items-center justify-center flex-shrink-0">
                        <span class="text-white font-medium text-sm">{{ $user->initials }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between">
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                <div class="text-xs text-gray-400 mt-1">ID: #{{ $user->id }}</div>
                            </div>
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
                        </div>
                        
                        <div class="flex flex-wrap gap-2 mt-3">
                            @if($user->profile && $user->profile->is_founding_member)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                    Founding Member
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    {{ ucfirst($user->profile->profile_type ?? 'User') }}
                                </span>
                            @endif
                            
                            @if($user->profile && $user->profile->is_verified)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    Pending Approval
                                </span>
                            @endif
                        </div>
                        
                        <div class="grid grid-cols-2 gap-2 mt-3 pt-3 border-t border-gray-100">
                            <div>
                                <div class="text-xs text-gray-500">Registered</div>
                                <div class="text-xs text-gray-900">{{ $user->created_at->format('d M Y') }}</div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500">Last Login</div>
                                <div class="text-xs text-gray-900">{{ $user->updated_at->format('M d, Y') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 text-center">
            <div class="text-gray-500">No members found.</div>
        </div>
        @endforelse
    </div>

    <!-- Mobile Pagination -->
    @if($users->hasPages())
    <div class="mt-6">
        {{ $users->links() }}
    </div>
    @endif
</div>

<script>
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
    const mobileCards = document.querySelectorAll('.user-card');
    
    // Search in desktop table
    rows.forEach(row => {
        const nameCell = row.querySelector('td:nth-child(2)'); // Changed from 3 to 2 since User ID column is commented out
        if (nameCell) {
            const name = nameCell.textContent.toLowerCase();
            if (name.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
    
    // Search in mobile cards
    mobileCards.forEach(card => {
        const nameElement = card.querySelector('.text-sm.font-medium.text-gray-900');
        const emailElement = card.querySelector('.text-xs.text-gray-500');
        if (nameElement && emailElement) {
            const name = nameElement.textContent.toLowerCase();
            const email = emailElement.textContent.toLowerCase();
            if (name.includes(searchTerm) || email.includes(searchTerm)) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        }
    });
});
</script>
@endsection
