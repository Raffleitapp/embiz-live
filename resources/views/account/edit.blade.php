@extends('layouts.dashboard')

@section('page-title', 'Edit Account & Profile')

@section('header-icon')
<i class="bx bx-user text-gray-600 text-lg sm:text-xl"></i>
@endsection

@section('content')
<div class="p-3 sm:p-4 lg:p-6">
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-4 sm:mb-6 text-sm">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-4 sm:mb-6">
            <ul class="list-disc list-inside text-sm">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="max-w-4xl">
        <h2 class="text-xl font-semibold text-gray-900 mb-6">Account & Profile Settings</h2>
        
        <!-- Profile Section -->
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6 mb-8">
            @csrf
            @method('PATCH')
            
            <!-- Profile Photos -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Profile Photos</h3>
                
                <!-- Cover Photo -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cover Photo</label>
                    <div class="relative h-32 bg-gradient-to-r from-gray-600 to-gray-800 rounded-lg overflow-hidden">
                        @if($user->profile && $user->profile->cover_photo)
                            <img src="{{ asset('storage/' . $user->profile->cover_photo) }}" 
                                 alt="Cover Photo" 
                                 class="w-full h-full object-cover"
                                 id="cover-preview">
                        @else
                            <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80" 
                                 alt="Default Cover" 
                                 class="w-full h-full object-cover"
                                 id="cover-preview">
                        @endif
                        <div class="absolute bottom-2 right-2">
                            <label for="cover_photo" class="bg-white bg-opacity-90 hover:bg-opacity-100 text-gray-700 px-3 py-1 rounded text-sm font-medium cursor-pointer transition-all duration-200">
                                <i class='bx bx-camera mr-1'></i>Change
                            </label>
                            <input type="file" id="cover_photo" name="cover_photo" accept="image/*" class="hidden" onchange="previewImage(this, 'cover-preview')">
                        </div>
                    </div>
                </div>

                <!-- Avatar -->
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Profile Picture</label>
                    <div class="flex items-center space-x-4">
                        <div class="w-20 h-20 bg-white rounded-full p-1 shadow-lg relative">
                            @if($user->profile && $user->profile->avatar)
                                <img src="{{ asset('storage/' . $user->profile->avatar) }}" 
                                     alt="{{ $user->name }}" 
                                     class="w-full h-full rounded-full object-cover"
                                     id="avatar-preview">
                            @else
                                <div class="w-full h-full bg-teal-600 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-lg" id="avatar-initials">{{ substr($user->name, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>
                        <div>
                            <label for="avatar" class="bg-teal-600 hover:bg-teal-700 text-white font-medium py-2 px-4 rounded cursor-pointer text-sm">
                                <i class='bx bx-camera mr-2'></i>Change Picture
                            </label>
                            <input type="file" id="avatar" name="avatar" accept="image/*" class="hidden" onchange="previewImage(this, 'avatar-preview')">
                            <p class="text-xs text-gray-500 mt-1">Max 2MB</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Profile Information</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name *</label>
                        <input type="text" 
                               id="first_name" 
                               name="first_name" 
                               value="{{ old('first_name', $user->first_name) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm"
                               required>
                    </div>
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name *</label>
                        <input type="text" 
                               id="last_name" 
                               name="last_name" 
                               value="{{ old('last_name', $user->last_name) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm"
                               required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Job Title</label>
                        <input type="text" 
                               id="title" 
                               name="title" 
                               value="{{ old('title', $user->profile->title ?? '') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm">
                    </div>
                    <div>
                        <label for="company" class="block text-sm font-medium text-gray-700 mb-2">Company</label>
                        <input type="text" 
                               id="company" 
                               name="company" 
                               value="{{ old('company', $user->profile->company ?? '') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <input type="text" 
                               id="location" 
                               name="location" 
                               value="{{ old('location', $user->profile->location ?? '') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm">
                    </div>
                    <div>
                        <label for="profile_type" class="block text-sm font-medium text-gray-700 mb-2">Profile Type *</label>
                        <select id="profile_type" name="profile_type" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm">
                            <option value="">Select Profile Type</option>
                            <option value="entrepreneur" {{ old('profile_type', $user->profile->profile_type ?? '') == 'entrepreneur' ? 'selected' : '' }}>Entrepreneur</option>
                            <option value="investor" {{ old('profile_type', $user->profile->profile_type ?? '') == 'investor' ? 'selected' : '' }}>Investor</option>
                            <option value="affiliate" {{ old('profile_type', $user->profile->profile_type ?? '') == 'affiliate' ? 'selected' : '' }}>Affiliate</option>
                            <option value="advisor" {{ old('profile_type', $user->profile->profile_type ?? '') == 'advisor' ? 'selected' : '' }}>Advisor</option>
                        </select>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">About / Bio</label>
                    <textarea id="bio" 
                              name="bio" 
                              rows="4" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm"
                              placeholder="Tell us about yourself...">{{ old('bio', $user->profile->bio ?? '') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="interests_text" class="block text-sm font-medium text-gray-700 mb-2">Interests</label>
                        <input type="text" 
                               id="interests_text" 
                               name="interests_text" 
                               value="{{ old('interests_text', $user->profile && $user->profile->interests ? implode(', ', $user->profile->interests) : '') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm"
                               placeholder="e.g., Technology, Finance, Marketing">
                        <p class="text-xs text-gray-500 mt-1">Separate with commas</p>
                    </div>
                    <div>
                        <label for="skills_text" class="block text-sm font-medium text-gray-700 mb-2">Skills</label>
                        <input type="text" 
                               id="skills_text" 
                               name="skills_text" 
                               value="{{ old('skills_text', $user->profile && $user->profile->skills ? implode(', ', $user->profile->skills) : '') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm"
                               placeholder="e.g., JavaScript, Leadership, Analytics">
                        <p class="text-xs text-gray-500 mt-1">Separate with commas</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label for="website" class="block text-sm font-medium text-gray-700 mb-2">Website</label>
                        <input type="url" 
                               id="website" 
                               name="website" 
                               value="{{ old('website', $user->profile->website ?? '') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm">
                    </div>
                    <div>
                        <label for="linkedin" class="block text-sm font-medium text-gray-700 mb-2">LinkedIn</label>
                        <input type="url" 
                               id="linkedin" 
                               name="linkedin" 
                               value="{{ old('linkedin', $user->profile->linkedin ?? '') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm">
                    </div>
                    <div>
                        <label for="twitter" class="block text-sm font-medium text-gray-700 mb-2">Twitter</label>
                        <input type="url" 
                               id="twitter" 
                               name="twitter" 
                               value="{{ old('twitter', $user->profile->twitter ?? '') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm">
                    </div>
                </div>
            </div>

            <!-- Submit Button for Profile -->
            <div class="flex justify-end">
                <button type="submit" 
                        class="bg-teal-600 text-white px-6 py-2 rounded-lg hover:bg-teal-700 transition-colors">
                    Update Profile
                </button>
            </div>
        </form>

        <!-- Account Settings Section -->
        <form action="{{ route('account.update') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Basic Information -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Account Settings</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="account_first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                        <input type="text" 
                               id="account_first_name" 
                               name="first_name" 
                               value="{{ old('first_name', $user->first_name) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm"
                               required>
                    </div>
                    <div>
                        <label for="account_last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                        <input type="text" 
                               id="account_last_name" 
                               name="last_name" 
                               value="{{ old('last_name', $user->last_name) }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm"
                               required>
                    </div>
                </div>
                
                <div class="mt-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input type="email" 
                           id="email" 
                           name="email" 
                           value="{{ old('email', $user->email) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm"
                           required>
                </div>
            </div>

            <!-- Password Change -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Change Password</h3>
                <p class="text-sm text-gray-600 mb-4">Leave blank if you don't want to change your password.</p>
                
                <div class="space-y-4">
                    <div>
                        <label for="current_password" class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                        <input type="password" 
                               id="current_password" 
                               name="current_password" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm">
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm">
                        </div>
                        <div>
                            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                            <input type="password" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button for Account -->
            <div class="flex justify-end">
                <button type="submit" 
                        class="bg-teal-600 text-white px-6 py-2 rounded-lg hover:bg-teal-700 transition-colors">
                    Update Account
                </button>
            </div>
        </form>

        <!-- Account Deletion Section -->
        <div class="bg-white rounded-lg shadow-sm border border-red-200 p-6 mt-6">
            <h3 class="text-lg font-medium text-red-900 mb-4">Delete Account</h3>
            <p class="text-sm text-red-600 mb-4">
                Once your account is deleted, all of your data will be permanently removed. Please enter your password to confirm you would like to permanently delete your account.
            </p>
            
            <form method="POST" action="{{ route('account.destroy') }}" class="space-y-4" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.')">
                @csrf
                @method('DELETE')
                
                <div class="max-w-md">
                    <label for="delete_password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" 
                           id="delete_password" 
                           name="password" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent text-sm"
                           required>
                </div>
                
                <div class="flex justify-start">
                    <button type="submit" 
                            class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition-colors">
                        Delete Account
                    </button>
                </div>
            </form>
        </div>

        <!-- Role Information (Read-only) -->
        <div class="bg-gray-50 rounded-lg border border-gray-200 p-6 mt-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Role Information</h3>
            <div class="flex items-center space-x-3">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-teal-100 text-teal-800">
                    {{ $user->role ? $user->role->display_name : 'No Role Assigned' }}
                </span>
                <span class="text-sm text-gray-600">
                    {{ $user->role ? $user->role->description : 'Contact an administrator to assign a role.' }}
                </span>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById(previewId).src = e.target.result;
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
