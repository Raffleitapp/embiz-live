@extends('layouts.app')

@section('title', 'Edit Opportunity')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">Edit Opportunity</h1>

            <form method="POST" action="{{ route('dashboard.opportunities.update', $opportunity) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Title -->
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                        <input type="text" id="title" name="title" required 
                               value="{{ old('title', $opportunity->title) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Type -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type *</label>
                        <select id="type" name="type" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('type') border-red-500 @enderror">
                            <option value="">Select Type</option>
                            <option value="investment" {{ old('type', $opportunity->type) == 'investment' ? 'selected' : '' }}>Investment</option>
                            <option value="funding" {{ old('type', $opportunity->type) == 'funding' ? 'selected' : '' }}>Funding</option>
                            <option value="partnership" {{ old('type', $opportunity->type) == 'partnership' ? 'selected' : '' }}>Partnership</option>
                            <option value="mentorship" {{ old('type', $opportunity->type) == 'mentorship' ? 'selected' : '' }}>Mentorship</option>
                            <option value="grant" {{ old('type', $opportunity->type) == 'grant' ? 'selected' : '' }}>Grant</option>
                        </select>
                        @error('type')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="status" name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('status') border-red-500 @enderror">
                            <option value="active" {{ old('status', $opportunity->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="paused" {{ old('status', $opportunity->status) == 'paused' ? 'selected' : '' }}>Paused</option>
                            <option value="closed" {{ old('status', $opportunity->status) == 'closed' ? 'selected' : '' }}>Closed</option>
                            <option value="draft" {{ old('status', $opportunity->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Amount -->
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Amount</label>
                        <input type="number" id="amount" name="amount" min="0" step="0.01" 
                               value="{{ old('amount', $opportunity->amount) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('amount') border-red-500 @enderror">
                        @error('amount')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Currency -->
                    <div>
                        <label for="currency" class="block text-sm font-medium text-gray-700 mb-2">Currency</label>
                        <select id="currency" name="currency" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('currency') border-red-500 @enderror">
                            <option value="USD" {{ old('currency', $opportunity->currency) == 'USD' ? 'selected' : '' }}>USD</option>
                            <option value="EUR" {{ old('currency', $opportunity->currency) == 'EUR' ? 'selected' : '' }}>EUR</option>
                            <option value="GBP" {{ old('currency', $opportunity->currency) == 'GBP' ? 'selected' : '' }}>GBP</option>
                            <option value="CAD" {{ old('currency', $opportunity->currency) == 'CAD' ? 'selected' : '' }}>CAD</option>
                            <option value="AUD" {{ old('currency', $opportunity->currency) == 'AUD' ? 'selected' : '' }}>AUD</option>
                        </select>
                        @error('currency')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <input type="text" id="location" name="location" 
                               value="{{ old('location', $opportunity->location) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('location') border-red-500 @enderror">
                        @error('location')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Industry -->
                    <div>
                        <label for="industry" class="block text-sm font-medium text-gray-700 mb-2">Industry</label>
                        <input type="text" id="industry" name="industry" 
                               value="{{ old('industry', $opportunity->industry) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('industry') border-red-500 @enderror">
                        @error('industry')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stage -->
                    <div>
                        <label for="stage" class="block text-sm font-medium text-gray-700 mb-2">Stage</label>
                        <select id="stage" name="stage" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('stage') border-red-500 @enderror">
                            <option value="">Select Stage</option>
                            <option value="idea" {{ old('stage', $opportunity->stage) == 'idea' ? 'selected' : '' }}>Idea</option>
                            <option value="startup" {{ old('stage', $opportunity->stage) == 'startup' ? 'selected' : '' }}>Startup</option>
                            <option value="growth" {{ old('stage', $opportunity->stage) == 'growth' ? 'selected' : '' }}>Growth</option>
                            <option value="established" {{ old('stage', $opportunity->stage) == 'established' ? 'selected' : '' }}>Established</option>
                        </select>
                        @error('stage')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deadline -->
                    <div>
                        <label for="deadline" class="block text-sm font-medium text-gray-700 mb-2">Deadline</label>
                        <input type="date" id="deadline" name="deadline" 
                               value="{{ old('deadline', $opportunity->deadline ? $opportunity->deadline->format('Y-m-d') : '') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('deadline') border-red-500 @enderror">
                        @error('deadline')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                        <textarea id="description" name="description" rows="6" required 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('description') border-red-500 @enderror">{{ old('description', $opportunity->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div class="md:col-span-2">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                        @if($opportunity->image)
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $opportunity->image) }}" alt="Current image" class="w-32 h-32 object-cover rounded">
                                <p class="text-sm text-gray-600 mt-1">Current image</p>
                            </div>
                        @endif
                        <input type="file" id="image" name="image" accept="image/*" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('image') border-red-500 @enderror">
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contact Information -->
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Contact Information</h3>
                    </div>

                    <!-- Contact Email -->
                    <div>
                        <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-2">Contact Email</label>
                        <input type="email" id="contact_email" name="contact_email" 
                               value="{{ old('contact_email', $opportunity->contact_email) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('contact_email') border-red-500 @enderror">
                        @error('contact_email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contact Phone -->
                    <div>
                        <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-2">Contact Phone</label>
                        <input type="tel" id="contact_phone" name="contact_phone" 
                               value="{{ old('contact_phone', $opportunity->contact_phone) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('contact_phone') border-red-500 @enderror">
                        @error('contact_phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Website -->
                    <div class="md:col-span-2">
                        <label for="website" class="block text-sm font-medium text-gray-700 mb-2">Website</label>
                        <input type="url" id="website" name="website" 
                               value="{{ old('website', $opportunity->website) }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('website') border-red-500 @enderror">
                        @error('website')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="mt-8 flex justify-between">
                    <a href="{{ route('dashboard.opportunities.show', $opportunity) }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded">
                        Cancel
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Update Opportunity
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
