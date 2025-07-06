@extends('layouts.dashboard')

@section('title', 'Edit Opportunity')

@section('content')
<div class="min-h-screen bg-gray-50 py-4 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 mb-6">
            <div class="px-4 py-5 sm:px-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-xl sm:text-2xl font-bold text-gray-900">Edit Opportunity</h1>
                        <p class="mt-1 text-sm text-gray-600">Update your opportunity details</p>
                    </div>
                    <a href="{{ route('dashboard.opportunities.show', $opportunity) }}" 
                       class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                        </svg>
                        Back to Opportunity
                    </a>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <form method="POST" action="{{ route('dashboard.opportunities.update', $opportunity) }}" enctype="multipart/form-data" class="p-4 sm:p-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                    <!-- Title -->
                    <div class="lg:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                        <input type="text" id="title" name="title" required 
                               value="{{ old('title', $opportunity->title) }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm"
                               placeholder="Enter opportunity title">
                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Type -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type *</label>
                        <select id="type" name="type" required 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm">
                            <option value="">Select type</option>
                            <option value="investment" {{ old('type', $opportunity->type) == 'investment' ? 'selected' : '' }}>Investment</option>
                            <option value="funding" {{ old('type', $opportunity->type) == 'funding' ? 'selected' : '' }}>Funding</option>
                            <option value="partnership" {{ old('type', $opportunity->type) == 'partnership' ? 'selected' : '' }}>Partnership</option>
                            <option value="mentorship" {{ old('type', $opportunity->type) == 'mentorship' ? 'selected' : '' }}>Mentorship</option>
                            <option value="grant" {{ old('type', $opportunity->type) == 'grant' ? 'selected' : '' }}>Grant</option>
                        </select>
                        @error('type')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="status" name="status" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm">
                            <option value="active" {{ old('status', $opportunity->status) == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="paused" {{ old('status', $opportunity->status) == 'paused' ? 'selected' : '' }}>Paused</option>
                            <option value="closed" {{ old('status', $opportunity->status) == 'closed' ? 'selected' : '' }}>Closed</option>
                            <option value="draft" {{ old('status', $opportunity->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                        @error('status')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Amount -->
                    <div>
                        <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">Amount</label>
                        <input type="number" id="amount" name="amount" step="0.01" min="0"
                               value="{{ old('amount', $opportunity->amount) }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm"
                               placeholder="Enter amount">
                        @error('amount')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Currency -->
                    <div>
                        <label for="currency" class="block text-sm font-medium text-gray-700 mb-2">Currency</label>
                        <select id="currency" name="currency" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm">
                            <option value="">Select currency</option>
                            <option value="USD" {{ old('currency', $opportunity->currency) == 'USD' ? 'selected' : '' }}>USD</option>
                            <option value="EUR" {{ old('currency', $opportunity->currency) == 'EUR' ? 'selected' : '' }}>EUR</option>
                            <option value="GBP" {{ old('currency', $opportunity->currency) == 'GBP' ? 'selected' : '' }}>GBP</option>
                            <option value="NGN" {{ old('currency', $opportunity->currency) == 'NGN' ? 'selected' : '' }}>NGN</option>
                            <option value="ZAR" {{ old('currency', $opportunity->currency) == 'ZAR' ? 'selected' : '' }}>ZAR</option>
                        </select>
                        @error('currency')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Location -->
                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                        <input type="text" id="location" name="location" 
                               value="{{ old('location', $opportunity->location) }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm"
                               placeholder="Enter location">
                        @error('location')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Industry -->
                    <div>
                        <label for="industry" class="block text-sm font-medium text-gray-700 mb-2">Industry</label>
                        <input type="text" id="industry" name="industry" 
                               value="{{ old('industry', $opportunity->industry) }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm"
                               placeholder="Enter industry">
                        @error('industry')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stage -->
                    <div>
                        <label for="stage" class="block text-sm font-medium text-gray-700 mb-2">Stage</label>
                        <select id="stage" name="stage" 
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm">
                            <option value="">Select stage</option>
                            <option value="idea" {{ old('stage', $opportunity->stage) == 'idea' ? 'selected' : '' }}>Idea</option>
                            <option value="startup" {{ old('stage', $opportunity->stage) == 'startup' ? 'selected' : '' }}>Startup</option>
                            <option value="growth" {{ old('stage', $opportunity->stage) == 'growth' ? 'selected' : '' }}>Growth</option>
                            <option value="established" {{ old('stage', $opportunity->stage) == 'established' ? 'selected' : '' }}>Established</option>
                        </select>
                        @error('stage')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Website -->
                    <div>
                        <label for="website" class="block text-sm font-medium text-gray-700 mb-2">Website</label>
                        <input type="url" id="website" name="website" 
                               value="{{ old('website', $opportunity->website) }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm"
                               placeholder="https://example.com">
                        @error('website')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deadline -->
                    <div>
                        <label for="deadline" class="block text-sm font-medium text-gray-700 mb-2">Deadline</label>
                        <input type="date" id="deadline" name="deadline" 
                               value="{{ old('deadline', $opportunity->deadline?->format('Y-m-d')) }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm">
                        @error('deadline')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contact Email -->
                    <div>
                        <label for="contact_email" class="block text-sm font-medium text-gray-700 mb-2">Contact Email</label>
                        <input type="email" id="contact_email" name="contact_email" 
                               value="{{ old('contact_email', $opportunity->contact_email) }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm"
                               placeholder="contact@example.com">
                        @error('contact_email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contact Phone -->
                    <div>
                        <label for="contact_phone" class="block text-sm font-medium text-gray-700 mb-2">Contact Phone</label>
                        <input type="tel" id="contact_phone" name="contact_phone" 
                               value="{{ old('contact_phone', $opportunity->contact_phone) }}" 
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm"
                               placeholder="+1 (555) 123-4567">
                        @error('contact_phone')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Contact Info -->
                    <div class="lg:col-span-2">
                        <label for="contact_info" class="block text-sm font-medium text-gray-700 mb-2">Contact Information</label>
                        <textarea id="contact_info" name="contact_info" rows="3" 
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm"
                                  placeholder="How should interested parties contact you? Include email, phone, or application process...">{{ old('contact_info', $opportunity->contact_info) }}</textarea>
                        @error('contact_info')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="lg:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                        <textarea id="description" name="description" rows="6" required 
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500 sm:text-sm"
                                  placeholder="Describe your opportunity in detail...">{{ old('description', $opportunity->description) }}</textarea>
                        @error('description')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Requirements -->
                    <div class="lg:col-span-2">
                        <label for="requirements" class="block text-sm font-medium text-gray-700 mb-2">Requirements</label>
                        <div class="space-y-3">
                            <!-- Requirements Tags Container -->
                            <div id="requirements-tags" class="flex flex-wrap gap-2 min-h-[2.5rem] p-3 border border-gray-300 rounded-lg bg-gray-50 transition-colors duration-200 focus-within:ring-2 focus-within:ring-teal-500 focus-within:border-transparent">
                                <!-- Tags will be added here dynamically -->
                            </div>
                            
                            <!-- Requirements Input -->
                            <div class="flex">
                                <input type="text" 
                                       id="requirements-input" 
                                       placeholder="Type a requirement and press Enter..."
                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors duration-200 text-sm">
                                <button type="button" 
                                        id="add-requirement-btn"
                                        class="px-4 py-2 bg-teal-600 text-white rounded-r-lg hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition-colors duration-200">
                                    <i class="bx bx-plus"></i>
                                </button>
                            </div>
                            
                            <!-- Hidden textarea for form submission -->
                            <textarea id="requirements" name="requirements" class="hidden"
                                      placeholder="Enter each requirement on a new line...">{{ old('requirements', $opportunity->requirements) }}</textarea>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">Add requirements one at a time. Click on a tag to remove it.</p>
                        @error('requirements')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div class="lg:col-span-2">
                        <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Image</label>
                        @if($opportunity->image)
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $opportunity->image) }}" alt="Current image" class="w-32 h-32 object-cover rounded-lg">
                                <p class="mt-2 text-sm text-gray-500">Current image (leave blank to keep)</p>
                            </div>
                        @endif
                        <input type="file" id="image" name="image" accept="image/*" 
                               class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                        <p class="mt-2 text-sm text-gray-500">JPG, PNG, GIF up to 2MB</p>
                        @error('image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4 mt-6 pt-6 border-t border-gray-200">
                    <a href="{{ route('dashboard.opportunities.show', $opportunity) }}" 
                       class="inline-flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Cancel
                    </a>
                    <button type="submit" 
                            class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-teal-600 hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                        Update Opportunity
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const requirementsInput = document.getElementById('requirements-input');
    const requirementsTextarea = document.getElementById('requirements');
    const requirementsTagsContainer = document.getElementById('requirements-tags');
    const addRequirementBtn = document.getElementById('add-requirement-btn');
    let requirements = [];

    // Initialize with existing requirements if any
    if (requirementsTextarea.value) {
        const existingRequirements = requirementsTextarea.value.split('\n').filter(req => req.trim());
        requirements = existingRequirements;
        renderRequirements();
    }

    function addRequirement() {
        const requirement = requirementsInput.value.trim();
        if (requirement && !requirements.includes(requirement)) {
            requirements.push(requirement);
            requirementsInput.value = '';
            renderRequirements();
            updateTextarea();
        }
    }

    function removeRequirement(index) {
        requirements.splice(index, 1);
        renderRequirements();
        updateTextarea();
    }

    function renderRequirements() {
        requirementsTagsContainer.innerHTML = '';
        requirements.forEach((requirement, index) => {
            const tag = document.createElement('span');
            tag.className = 'inline-flex items-center gap-1 px-3 py-1 bg-teal-100 text-teal-700 rounded-full text-sm font-medium cursor-pointer hover:bg-teal-200 transition-colors duration-200';
            tag.innerHTML = `
                <span>${requirement}</span>
                <i class="bx bx-x text-sm hover:text-red-600"></i>
            `;
            tag.onclick = () => removeRequirement(index);
            requirementsTagsContainer.appendChild(tag);
        });

        // Add placeholder if no requirements
        if (requirements.length === 0) {
            const placeholder = document.createElement('span');
            placeholder.className = 'text-gray-400 text-sm italic';
            placeholder.textContent = 'No requirements added yet...';
            requirementsTagsContainer.appendChild(placeholder);
        }
    }

    function updateTextarea() {
        requirementsTextarea.value = requirements.join('\n');
    }

    // Event listeners
    requirementsInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            addRequirement();
        }
    });

    addRequirementBtn.addEventListener('click', addRequirement);

    // Initial render
    renderRequirements();
});
</script>
@endpush
