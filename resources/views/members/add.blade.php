@extends('layouts.dashboard')

@section('page-title', 'Members')

@section('header-icon')
<i class='bx bx-users text-gray-600 text-xl'></i>
@endsection

@section('header-actions')
<div class="relative">
    <i class='bx bx-search absolute left-3 top-3 text-gray-400'></i>
    <input type="text" 
           placeholder="Search members by name/email" 
           class="pl-10 pr-4 py-2 w-80 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
</div>
@endsection

@section('content')
            <div class="max-w-2xl">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Add Members</h2>
                
                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6">
                        <ul class="list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('dashboard.store-member') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Name -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                            <input type="text" 
                                   id="first_name" 
                                   name="first_name" 
                                   placeholder="First name"
                                   value="{{ old('first_name') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                   required>
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                            <input type="text" 
                                   id="last_name" 
                                   name="last_name" 
                                   placeholder="Last name"
                                   value="{{ old('last_name') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                   required>
                        </div>
                    </div>
                    
                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                        <input type="email" 
                               id="email" 
                               name="email" 
                               placeholder="Members email address"
                               value="{{ old('email') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                               required>
                    </div>
                    
                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <div class="space-y-3">
                            <button type="button" 
                                    id="generatePassword"
                                    class="inline-flex items-center px-4 py-2 border border-blue-300 text-blue-700 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors text-sm">
                                Generate password
                            </button>
                            <div class="relative">
                                <input type="password" 
                                       id="password" 
                                       name="password" 
                                       placeholder="Password"
                                       value="{{ old('password') }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent pr-16"
                                       required>
                                <button type="button" 
                                        id="togglePassword"
                                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-blue-600 hover:text-blue-800 text-sm">
                                    Hide
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Send Notification -->
                    <div class="flex items-center space-x-3">
                        <input type="checkbox" 
                               id="send_notification" 
                               name="send_notification" 
                               value="1"
                               {{ old('send_notification') ? 'checked' : '' }}
                               class="w-4 h-4 rounded border-gray-300 text-teal-600 focus:ring-teal-500">
                        <label for="send_notification" class="text-sm text-gray-600">
                            Send the new member an email about their account
                        </label>
                    </div>
                    
                    <!-- Role -->
                    <div>
                        <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                        <select id="role" 
                                name="role" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                required>
                            <option value="">Select a role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ old('role') == $role->id ? 'selected' : '' }}>
                                    {{ $role->display_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="submit" 
                                class="px-8 py-3 bg-teal-600 text-white font-medium rounded-lg hover:bg-teal-700 transition-colors">
                            Add Member
                        </button>
                    </div>
                </form>
            </div>
        </div>
@endsection

@push('scripts')
<script>
// Generate password functionality
document.getElementById('generatePassword').addEventListener('click', async function() {
    try {
        const response = await fetch('{{ route("dashboard.generate-password") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });
        
        const data = await response.json();
        document.getElementById('password').value = data.password;
        document.getElementById('password').type = 'text';
        document.getElementById('togglePassword').textContent = 'Hide';
    } catch (error) {
        console.error('Error generating password:', error);
        // Fallback to client-side generation
        const password = generateRandomPassword();
        document.getElementById('password').value = password;
        document.getElementById('password').type = 'text';
        document.getElementById('togglePassword').textContent = 'Hide';
    }
});

function generateRandomPassword() {
    const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!@#$%^&*';
    let password = '';
    for (let i = 0; i < 12; i++) {
        password += chars.charAt(Math.floor(Math.random() * chars.length));
    }
    return password;
}

// Toggle password visibility
document.getElementById('togglePassword').addEventListener('click', function() {
    const passwordField = document.getElementById('password');
    const isPassword = passwordField.type === 'password';
    
    passwordField.type = isPassword ? 'text' : 'password';
    this.textContent = isPassword ? 'Show' : 'Hide';
});
</script>
@endpush
