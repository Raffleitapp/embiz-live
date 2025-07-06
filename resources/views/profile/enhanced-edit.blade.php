@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Edit Profile</h1>

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

            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <!-- Cover Photo Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Cover Photo</h3>
                    <div class="relative">
                        <div class="h-48 bg-gradient-to-r from-gray-600 to-gray-800 rounded-lg relative overflow-hidden">
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
                        </div>
                        <div class="absolute bottom-4 right-4">
                            <label for="cover_photo" class="bg-white bg-opacity-90 hover:bg-opacity-100 text-gray-700 px-3 py-2 rounded-lg text-sm font-medium cursor-pointer transition-all duration-200">
                                <i class='bx bx-camera mr-2'></i>Change Cover
                            </label>
                            <input type="file" id="cover_photo" name="cover_photo" accept="image/*" class="hidden" onchange="previewImage(this, 'cover-preview')">
                        </div>
                    </div>
                </div>

                <!-- Profile Avatar Section -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Profile Picture</h3>
                    <div class="flex items-center space-x-6">
                        <div class="w-24 h-24 bg-white rounded-full p-1 shadow-lg relative">
                            @if($user->profile && $user->profile->avatar)
                                <img src="{{ asset('storage/' . $user->profile->avatar) }}" 
                                     alt="{{ $user->name }}" 
                                     class="w-full h-full rounded-full object-cover"
                                     id="avatar-preview">
                            @else
                                <div class="w-full h-full bg-teal-600 rounded-full flex items-center justify-center">
                                    <span class="text-white font-bold text-2xl" id="avatar-initials">{{ substr($user->name, 0, 1) }}</span>
                                </div>
                            @endif
                        </div>
                        <div>
                            <label for="avatar" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded cursor-pointer">
                                <i class='bx bx-camera mr-2'></i>Change Picture
                            </label>
                            <input type="file" id="avatar" name="avatar" accept="image/*" class="hidden" onchange="previewImage(this, 'avatar-preview')">
                            <p class="text-sm text-gray-500 mt-2">Upload a new profile picture (max 2MB)</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- First Name -->
                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name *</label>
                        <input type="text" id="first_name" name="first_name" required 
                               value="{{ old('first_name', $user->first_name) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('first_name') border-red-500 @enderror">
                        @error('first_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Last Name -->
                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name *</label>
                        <input type="text" id="last_name" name="last_name" required 
                               value="{{ old('last_name', $user->last_name) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('last_name') border-red-500 @enderror">
                        @error('last_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                        <input type="email" id="email" name="email" required readonly
                               value="{{ $user->email }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-50 cursor-not-allowed">
                        <p class="text-sm text-gray-500 mt-1">Contact support to change your email address</p>
                    </div>

                    <!-- Profile Type -->
                    <div>
                        <label for="profile_type" class="block text-sm font-medium text-gray-700 mb-2">Profile Type *</label>
                        <select id="profile_type" name="profile_type" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('profile_type') border-red-500 @enderror">
                            <option value="">Select Profile Type</option>
                            <option value="entrepreneur" {{ old('profile_type', $user->profile->profile_type ?? '') == 'entrepreneur' ? 'selected' : '' }}>Entrepreneur</option>
                            <option value="investor" {{ old('profile_type', $user->profile->profile_type ?? '') == 'investor' ? 'selected' : '' }}>Investor</option>
                            <option value="affiliate" {{ old('profile_type', $user->profile->profile_type ?? '') == 'affiliate' ? 'selected' : '' }}>Affiliate</option>
                            <option value="advisor" {{ old('profile_type', $user->profile->profile_type ?? '') == 'advisor' ? 'selected' : '' }}>Advisor</option>
                        </select>
                        @error('profile_type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Job Title</label>
                        <input type="text" id="title" name="title" 
                               value="{{ old('title', $user->profile->title ?? '') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Company -->
                    <div>
                        <label for="company" class="block text-sm font-medium text-gray-700 mb-2">Company</label>
                        <input type="text" id="company" name="company" 
                               value="{{ old('company', $user->profile->company ?? '') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('company') border-red-500 @enderror">
                        @error('company')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <input type="text" id="location" name="location" 
                               value="{{ old('location', $user->profile->location ?? '') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('location') border-red-500 @enderror">
                        @error('location')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Website -->
                    <div>
                        <label for="website" class="block text-sm font-medium text-gray-700 mb-2">Website</label>
                        <input type="url" id="website" name="website" 
                               value="{{ old('website', $user->profile->website ?? '') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('website') border-red-500 @enderror">
                        @error('website')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- LinkedIn -->
                    <div>
                        <label for="linkedin" class="block text-sm font-medium text-gray-700 mb-2">LinkedIn Profile</label>
                        <input type="url" id="linkedin" name="linkedin" 
                               value="{{ old('linkedin', $user->profile->linkedin ?? '') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('linkedin') border-red-500 @enderror">
                        @error('linkedin')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Twitter -->
                    <div>
                        <label for="twitter" class="block text-sm font-medium text-gray-700 mb-2">Twitter Profile</label>
                        <input type="url" id="twitter" name="twitter" 
                               value="{{ old('twitter', $user->profile->twitter ?? '') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('twitter') border-red-500 @enderror">
                        @error('twitter')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Bio -->
                <div class="mt-6">
                    <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">About / Bio</label>
                    <textarea id="bio" name="bio" rows="6" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('bio') border-red-500 @enderror"
                              placeholder="Tell us about yourself, your experience, and what you're looking for...">{{ old('bio', $user->profile->bio ?? '') }}</textarea>
                    @error('bio')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Interests -->
                <div class="mt-6">
                    <label for="interests" class="block text-sm font-medium text-gray-700 mb-2">Interests (comma-separated)</label>
                    <input type="text" id="interests" name="interests_text" 
                           value="{{ old('interests_text', is_array($user->profile->interests ?? null) ? implode(', ', $user->profile->interests) : '') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="e.g., Technology, Healthcare, Real Estate">
                    <p class="text-sm text-gray-500 mt-1">Separate interests with commas</p>
                </div>

                <!-- Skills -->
                <div class="mt-6">
                    <label for="skills" class="block text-sm font-medium text-gray-700 mb-2">Skills (comma-separated)</label>
                    <input type="text" id="skills" name="skills_text" 
                           value="{{ old('skills_text', is_array($user->profile->skills ?? null) ? implode(', ', $user->profile->skills) : '') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                           placeholder="e.g., Business Development, Marketing, Finance">
                    <p class="text-sm text-gray-500 mt-1">Separate skills with commas</p>
                </div>

                <div class="mt-8 flex justify-between">
                    <a href="{{ route('user-profile') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                        Cancel
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewImage(input, previewId) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            const preview = document.getElementById(previewId);
            if (previewId === 'avatar-preview') {
                preview.src = e.target.result;
                preview.className = 'w-full h-full rounded-full object-cover';
                // Hide initials if showing
                const initials = document.getElementById('avatar-initials');
                if (initials) {
                    initials.style.display = 'none';
                }
            } else {
                preview.src = e.target.result;
            }
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
