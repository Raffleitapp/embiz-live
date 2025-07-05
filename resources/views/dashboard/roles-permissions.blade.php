@extends('layouts.dashboard')

@section('page-title', 'Roles & Permissions')

@section('header-icon')
<i class="bx bx-shield text-gray-600 text-lg sm:text-xl"></i>
@endsection

@section('header-actions')
<button class="bg-teal-600 text-white px-3 sm:px-4 py-2 rounded-lg hover:bg-teal-700 transition-colors flex items-center space-x-2 text-sm sm:text-base w-full sm:w-auto justify-center" onclick="openCreateRoleModal()">
    <i class='bx bx-plus'></i>
    <span>Create Role</span>
</button>
@endsection

@section('content')
<div class="p-3 sm:p-4 lg:p-6">
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-4 sm:mb-6 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <!-- Roles Overview -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6 mb-6">
        <!-- Roles List -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-4 sm:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">System Roles</h3>
                <div class="space-y-3">
                    @foreach($roles as $role)
                    <div class="flex items-center justify-between p-3 border border-gray-200 rounded-lg">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3">
                                <div class="font-medium text-gray-900 text-sm">{{ $role->display_name }}</div>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    {{ $role->users_count }} users
                                </span>
                            </div>
                            <div class="text-xs text-gray-500 mt-1">{{ $role->description }}</div>
                        </div>
                        <div class="flex items-center space-x-2">
                            <button class="text-gray-400 hover:text-gray-600" onclick="editRole({{ $role->id }})">
                                <i class='bx bx-edit text-lg'></i>
                            </button>
                            @if(!in_array($role->name, ['super_admin', 'admin', 'user']))
                            <button class="text-red-400 hover:text-red-600" onclick="deleteRole({{ $role->id }})">
                                <i class='bx bx-trash text-lg'></i>
                            </button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Permissions Matrix -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-4 sm:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Permissions by Group</h3>
                <div class="space-y-4">
                    @foreach($permissions as $group => $groupPermissions)
                    <div class="border border-gray-200 rounded-lg p-4">
                        <h4 class="font-medium text-gray-900 mb-3 capitalize">{{ str_replace('_', ' ', $group) }}</h4>
                        <div class="space-y-2">
                            @foreach($groupPermissions as $permission)
                            <div class="flex items-center justify-between py-2">
                                <div class="text-sm text-gray-700">{{ $permission->display_name }}</div>
                                <div class="flex items-center space-x-4">
                                    @foreach($roles->take(4) as $role)
                                    <div class="text-center">
                                        <div class="text-xs text-gray-500 mb-1">{{ substr($role->display_name, 0, 5) }}</div>
                                        @if($role->permissions->contains('id', $permission->id))
                                            <i class='bx bx-check text-green-600'></i>
                                        @else
                                            <i class='bx bx-x text-red-600'></i>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Role Changes -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-4 sm:p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Recent Role Changes</h3>
            <div class="space-y-3">
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-teal-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-medium text-xs">SJ</span>
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-900">Sarah Johnson promoted to Admin</div>
                            <div class="text-xs text-gray-500">2 hours ago by Marcus Johnson</div>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-teal-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-medium text-xs">DT</span>
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-900">David Thompson assigned Moderator role</div>
                            <div class="text-xs text-gray-500">1 day ago by Sarah Williams</div>
                        </div>
                    </div>
                </div>
                
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-teal-600 rounded-full flex items-center justify-center">
                            <span class="text-white font-medium text-xs">AD</span>
                        </div>
                        <div>
                            <div class="text-sm font-medium text-gray-900">Angela Davis role updated</div>
                            <div class="text-xs text-gray-500">3 days ago by Marcus Johnson</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Create Role Modal -->
<div id="createRoleModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-lg max-w-md w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Create New Role</h3>
                <button onclick="closeCreateRoleModal()" class="text-gray-400 hover:text-gray-600">
                    <i class='bx bx-x text-xl'></i>
                </button>
            </div>
            
            <form action="{{ route('dashboard.create-role') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="role_name" class="block text-sm font-medium text-gray-700 mb-2">Role Name</label>
                    <input type="text" 
                           id="role_name" 
                           name="name" 
                           required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm">
                </div>
                
                <div>
                    <label for="role_description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea id="role_description" 
                              name="description" 
                              rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm"></textarea>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Permissions</label>
                    <div class="space-y-2 max-h-40 overflow-y-auto">
                        @foreach($permissions as $group => $groupPermissions)
                            <div class="mb-3">
                                <div class="font-medium text-gray-800 mb-1">{{ ucfirst(str_replace('_', ' ', $group)) }}</div>
                                @foreach($groupPermissions as $permission)
                                <div class="flex items-center ml-4">
                                    <input type="checkbox" 
                                           id="perm_{{ $permission->id }}" 
                                           name="permissions[]" 
                                           value="{{ $permission->id }}"
                                           class="rounded border-gray-300 text-teal-600 focus:ring-teal-500">
                                    <label for="perm_{{ $permission->id }}" class="ml-2 text-sm text-gray-700">{{ $permission->display_name }}</label>
                                </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" 
                            onclick="closeCreateRoleModal()"
                            class="px-4 py-2 text-sm border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 text-sm bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors">
                        Create Role
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Role Modal -->
<div id="editRoleModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-lg max-w-md w-full max-h-[90vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900">Edit Role</h3>
                <button onclick="closeEditRoleModal()" class="text-gray-400 hover:text-gray-600">
                    <i class='bx bx-x text-xl'></i>
                </button>
            </div>
            
            <form id="editRoleForm" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="edit_role_name" class="block text-sm font-medium text-gray-700 mb-2">Role Name</label>
                    <input type="text" 
                           id="edit_role_name" 
                           name="name" 
                           required
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm">
                </div>
                
                <div>
                    <label for="edit_role_description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                    <textarea id="edit_role_description" 
                              name="description" 
                              rows="3"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm"></textarea>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Permissions</label>
                    <div class="space-y-2 max-h-40 overflow-y-auto" id="editPermissionsContainer">
                        <!-- Permissions will be populated dynamically -->
                    </div>
                </div>
                
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" 
                            onclick="closeEditRoleModal()"
                            class="px-4 py-2 text-sm border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 text-sm bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors">
                        Update Role
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openCreateRoleModal() {
    document.getElementById('createRoleModal').classList.remove('hidden');
}

function closeCreateRoleModal() {
    document.getElementById('createRoleModal').classList.add('hidden');
}

function openEditRoleModal() {
    document.getElementById('editRoleModal').classList.remove('hidden');
}

function closeEditRoleModal() {
    document.getElementById('editRoleModal').classList.add('hidden');
}

function editRole(roleId) {
    fetch(`/dashboard/roles/${roleId}/edit`)
        .then(response => response.json())
        .then(data => {
            const role = data.role;
            const permissions = data.permissions;
            
            // Set form action
            document.getElementById('editRoleForm').action = `/dashboard/roles/${roleId}/update`;
            
            // Populate form fields
            document.getElementById('edit_role_name').value = role.display_name;
            document.getElementById('edit_role_description').value = role.description || '';
            
            // Populate permissions
            const permissionsContainer = document.getElementById('editPermissionsContainer');
            permissionsContainer.innerHTML = '';
            
            Object.keys(permissions).forEach(group => {
                const groupDiv = document.createElement('div');
                groupDiv.className = 'mb-3';
                groupDiv.innerHTML = `
                    <div class="font-medium text-gray-800 mb-1">${group.charAt(0).toUpperCase() + group.slice(1).replace('_', ' ')}</div>
                `;
                
                permissions[group].forEach(permission => {
                    const isChecked = role.permissions.some(p => p.id === permission.id);
                    const permDiv = document.createElement('div');
                    permDiv.className = 'flex items-center ml-4';
                    permDiv.innerHTML = `
                        <input type="checkbox" 
                               id="edit_perm_${permission.id}" 
                               name="permissions[]" 
                               value="${permission.id}"
                               ${isChecked ? 'checked' : ''}
                               class="rounded border-gray-300 text-teal-600 focus:ring-teal-500">
                        <label for="edit_perm_${permission.id}" class="ml-2 text-sm text-gray-700">${permission.display_name}</label>
                    `;
                    groupDiv.appendChild(permDiv);
                });
                
                permissionsContainer.appendChild(groupDiv);
            });
            
            openEditRoleModal();
        })
        .catch(error => {
            console.error('Error fetching role data:', error);
            alert('Error loading role data');
        });
}

function deleteRole(roleId) {
    if (confirm('Are you sure you want to delete this role? This action cannot be undone.')) {
        fetch(`/dashboard/roles/${roleId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.message || 'Error deleting role');
            }
        })
        .catch(error => {
            console.error('Error deleting role:', error);
            alert('Error deleting role');
        });
    }
}

// Close modals when clicking outside
document.getElementById('createRoleModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeCreateRoleModal();
    }
});

document.getElementById('editRoleModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditRoleModal();
    }
});
</script>
@endsection
