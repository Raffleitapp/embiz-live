@extends('layouts.dashboard')

@section('page-title', 'Create Opportunity')

@section('header-icon')
    <i class="bx bx-plus-circle text-teal-600 text-lg sm:text-xl"></i>
@endsection

@section('header-actions')
    <a href="{{ route('dashboard.opportunities') }}"
        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 text-sm font-medium transition-colors duration-200">
        <i class="bx bx-arrow-back mr-2"></i>Back to Opportunities
    </a>
@endsection

@section('content')
    <div class="min-h-screen bg-gray-50 py-3 sm:py-4 px-3 sm:px-4 lg:px-6">
        <div class="max-w-4xl mx-auto">
            <!-- Header Section -->
            <div class="mb-4 sm:mb-6 lg:mb-8">
                <h1 class="text-xl sm:text-2xl lg:text-3xl xl:text-4xl font-bold text-gray-900 mb-2">Create New Opportunity
                </h1>
                <p class="text-gray-600 text-xs sm:text-sm lg:text-base">Share your investment, funding, partnership, or
                    mentorship opportunity with the community</p>
            </div>

            <div class="bg-white rounded-lg sm:rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div
                    class="px-3 sm:px-4 lg:px-6 py-3 sm:py-4 bg-gradient-to-r from-teal-50 to-white border-b border-gray-200">
                    <div class="flex items-center">
                        <div
                            class="w-6 h-6 sm:w-8 sm:h-8 lg:w-10 lg:h-10 bg-teal-100 rounded-lg flex items-center justify-center mr-2 sm:mr-3">
                            <i class="bx bx-plus-circle text-teal-600 text-sm sm:text-lg lg:text-xl"></i>
                        </div>
                        <div>
                            <h2 class="text-sm sm:text-base lg:text-lg font-semibold text-gray-900">Opportunity Details</h2>
                            <p class="text-xs sm:text-sm text-gray-600 hidden sm:block">Fill in the information below to
                                create your opportunity</p>
                        </div>
                    </div>
                </div>

                <div class="p-3 sm:p-4 lg:p-6 xl:p-8">

                    @if (session('success'))
                        <div
                            class="mb-6 p-4 bg-gradient-to-r from-green-50 to-green-100 border border-green-200 rounded-lg">
                            <div class="flex items-center">
                                <i class="bx bx-check-circle text-green-600 text-xl mr-3"></i>
                                <div>
                                    <p class="text-green-800 font-medium">Success!</p>
                                    <p class="text-green-700 text-sm">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-gradient-to-r from-red-50 to-red-100 border border-red-200 rounded-lg">
                            <div class="flex items-start">
                                <i class="bx bx-error-circle text-red-600 text-xl mr-3 mt-0.5"></i>
                                <div>
                                    <p class="text-red-800 font-medium mb-2">Please fix the following errors:</p>
                                    <ul class="list-disc list-inside text-red-700 text-sm space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('dashboard.opportunities.store') }}" method="POST"
                        class="space-y-6 sm:space-y-8">
                        @csrf

                        <!-- Basic Information -->
                        <div class="space-y-4 sm:space-y-6 lg:space-y-8">
                            <div class="border-b border-gray-200 pb-2 sm:pb-3 lg:pb-4">
                                <h3 class="text-sm sm:text-base lg:text-lg font-semibold text-gray-900 flex items-center">
                                    <i class="bx bx-info-circle text-teal-600 mr-2"></i>
                                    Basic Information
                                </h3>
                                <p class="text-xs sm:text-sm text-gray-600 mt-1">Provide essential details about your
                                    opportunity</p>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-3 sm:gap-4 lg:gap-6">
                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="bx bx-edit-alt text-gray-400 mr-1"></i>
                                        Opportunity Title *
                                    </label>
                                    <input type="text" id="title" name="title" value="{{ old('title') }}"
                                        class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors duration-200 placeholder-gray-400 text-sm sm:text-base"
                                        placeholder="Enter a compelling title for your opportunity" required>
                                </div>

                                <div>
                                    <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="bx bx-category text-gray-400 mr-1"></i>
                                        Opportunity Type *
                                    </label>
                                    <select id="type" name="type"
                                        class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors duration-200 text-sm sm:text-base"
                                        required>
                                        <option value="">Select Type</option>
                                        <option value="investment" {{ old('type') == 'investment' ? 'selected' : '' }}>
                                            Investment</option>
                                        <option value="funding" {{ old('type') == 'funding' ? 'selected' : '' }}>Funding
                                        </option>
                                        <option value="partnership" {{ old('type') == 'partnership' ? 'selected' : '' }}>
                                            Partnership</option>
                                        <option value="mentorship" {{ old('type') == 'mentorship' ? 'selected' : '' }}>
                                            Mentorship</option>
                                        <option value="grant" {{ old('type') == 'grant' ? 'selected' : '' }}>Grant</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="bx bx-text text-gray-400 mr-1"></i>
                                    Description *
                                </label>
                                <textarea id="description" name="description" rows="4"
                                    class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors duration-200 placeholder-gray-400 text-sm sm:text-base resize-none"
                                    placeholder="Describe your opportunity in detail. What are you looking for? What do you offer? What are the benefits?"
                                    required>{{ old('description') }}</textarea>
                            </div>
                        </div>

                        <!-- Financial & Timeline Information -->
                        <div class="space-y-4 sm:space-y-6">
                            <div class="border-b border-gray-200 pb-3 sm:pb-4">
                                <h3 class="text-base sm:text-lg font-semibold text-gray-900 flex items-center">
                                    <i class="bx bx-dollar-circle text-teal-600 mr-2"></i>
                                    Financial & Timeline Details
                                </h3>
                                <p class="text-xs sm:text-sm text-gray-600 mt-1">Add budget and timeline information</p>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 sm:gap-6">
                                <div class="lg:col-span-2">
                                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="bx bx-money text-gray-400 mr-1"></i>
                                        Opportunity Amount
                                    </label>
                                    <input type="number" id="amount" name="amount" value="{{ old('amount') }}"
                                        min="0" step="0.01" placeholder="e.g., 50000"
                                        class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors duration-200 placeholder-gray-400 text-sm sm:text-base">
                                    <p class="text-xs sm:text-sm text-gray-500 mt-1">Leave blank if amount is negotiable or
                                        not applicable</p>
                                </div>

                                <div class="lg:col-span-2">
                                    <label for="currency" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="bx bx-dollar-circle text-gray-400 mr-1"></i>
                                        Currency
                                    </label>
                                    <select id="currency" name="currency"
                                        class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors duration-200 text-sm sm:text-base">
                                        <option value="USD" {{ old('currency', 'USD') == 'USD' ? 'selected' : '' }}>USD
                                            ($)</option>
                                        <option value="EUR" {{ old('currency') == 'EUR' ? 'selected' : '' }}>EUR (€)
                                        </option>
                                        <option value="GBP" {{ old('currency') == 'GBP' ? 'selected' : '' }}>GBP (£)
                                        </option>
                                        <option value="CAD" {{ old('currency') == 'CAD' ? 'selected' : '' }}>CAD ($)
                                        </option>
                                        <option value="AUD" {{ old('currency') == 'AUD' ? 'selected' : '' }}>AUD ($)
                                        </option>
                                        <option value="JPY" {{ old('currency') == 'JPY' ? 'selected' : '' }}>JPY (¥)
                                        </option>
                                        <option value="CNY" {{ old('currency') == 'CNY' ? 'selected' : '' }}>CNY (¥)
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                                <div>
                                    <label for="industry" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="bx bx-building text-gray-400 mr-1"></i>
                                        Industry
                                    </label>
                                    <input type="text" id="industry" name="industry" value="{{ old('industry') }}"
                                        placeholder="e.g., Technology, Healthcare, Finance"
                                        class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors duration-200 placeholder-gray-400 text-sm sm:text-base">
                                </div>

                                <div>
                                    <label for="stage" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="bx bx-trending-up text-gray-400 mr-1"></i>
                                        Stage
                                    </label>
                                    <select id="stage" name="stage"
                                        class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors duration-200 text-sm sm:text-base">
                                        <option value="">Select Stage</option>
                                        <option value="idea" {{ old('stage') == 'idea' ? 'selected' : '' }}>Idea
                                        </option>
                                        <option value="startup" {{ old('stage') == 'startup' ? 'selected' : '' }}>Startup
                                        </option>
                                        <option value="growth" {{ old('stage') == 'growth' ? 'selected' : '' }}>Growth
                                        </option>
                                        <option value="established" {{ old('stage') == 'established' ? 'selected' : '' }}>
                                            Established</option>
                                    </select>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                                <div>
                                    <label for="deadline" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="bx bx-calendar text-gray-400 mr-1"></i>
                                        Application Deadline
                                    </label>
                                    <input type="date" id="deadline" name="deadline" value="{{ old('deadline') }}"
                                        class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors duration-200 text-sm sm:text-base">
                                </div>

                                <div>
                                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                                        <i class="bx bx-map text-gray-400 mr-1"></i>
                                        Location
                                    </label>
                                    <input type="text" id="location" name="location" value="{{ old('location') }}"
                                        placeholder="e.g., Remote, New York, London, Global"
                                        class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors duration-200 placeholder-gray-400 text-sm sm:text-base">
                                </div>
                            </div>
                        </div>

                        <!-- Requirements & Contact -->
                        <div class="space-y-4 sm:space-y-6">
                            <div class="border-b border-gray-200 pb-3 sm:pb-4">
                                <h3 class="text-base sm:text-lg font-semibold text-gray-900 flex items-center">
                                    <i class="bx bx-clipboard text-teal-600 mr-2"></i>
                                    Requirements & Contact
                                </h3>
                                <p class="text-xs sm:text-sm text-gray-600 mt-1">Specify requirements and contact
                                    information</p>
                            </div>

                            <div>
                                <label for="requirements" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="bx bx-check-square text-gray-400 mr-1"></i>
                                    Requirements
                                </label>
                                <div class="space-y-3">
                                    <!-- Requirements Tags Container -->
                                    <div id="requirements-tags"
                                        class="flex flex-wrap gap-2 min-h-[2.5rem] p-3 border border-gray-300 rounded-lg bg-gray-50 transition-colors duration-200 focus-within:ring-2 focus-within:ring-teal-500 focus-within:border-transparent">
                                        <!-- Tags will be added here dynamically -->
                                    </div>

                                    <!-- Requirements Input -->
                                    <div class="flex">
                                        <input type="text" id="requirements-input"
                                            placeholder="Type a requirement and press Enter..."
                                            class="flex-1 px-3 py-2 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors duration-200 text-sm">
                                        <button type="button" id="add-requirement-btn"
                                            class="px-4 py-2 bg-teal-600 text-white rounded-r-lg hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition-colors duration-200">
                                            <i class="bx bx-plus"></i>
                                        </button>
                                    </div>

                                    <!-- Hidden textarea for form submission -->
                                    <textarea id="requirements" name="requirements" class="hidden"
                                        placeholder="Enter requirements (one per line):&#10;• Minimum 5 years of experience&#10;• Bachelor's degree in relevant field&#10;• Strong communication skills&#10;• Portfolio of previous work">{{ old('requirements') }}</textarea>
                                </div>
                                <div class="mt-2 text-xs sm:text-sm text-gray-500">
                                    <i class="bx bx-lightbulb text-amber-500 mr-1"></i>
                                    <strong>Tip:</strong> Add requirements one at a time. Click on a tag to remove it.
                                </div>
                            </div>

                            <div>
                                <label for="contact_info" class="block text-sm font-medium text-gray-700 mb-2">
                                    <i class="bx bx-envelope text-gray-400 mr-1"></i>
                                    Contact Information
                                </label>
                                <textarea id="contact_info" name="contact_info" rows="3"
                                    placeholder="How should interested parties contact you? Include email, phone, or application process..."
                                    class="w-full px-3 sm:px-4 py-2.5 sm:py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors duration-200 placeholder-gray-400 text-sm sm:text-base resize-none">{{ old('contact_info') }}</textarea>
                            </div>
                        </div>

                        <!-- Additional Options -->
                        <div class="space-y-4 sm:space-y-6">
                            <div class="border-b border-gray-200 pb-3 sm:pb-4">
                                <h3 class="text-base sm:text-lg font-semibold text-gray-900 flex items-center">
                                    <i class="bx bx-cog text-teal-600 mr-2"></i>
                                    Additional Options
                                </h3>
                                <p class="text-xs sm:text-sm text-gray-600 mt-1">Configure additional settings</p>
                            </div>

                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-start">
                                    <div class="flex items-center h-5">
                                        <input type="checkbox" id="is_featured" name="is_featured" value="1"
                                            {{ old('is_featured') ? 'checked' : '' }}
                                            class="w-4 h-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500 focus:ring-2">
                                    </div>
                                    <div class="ml-3">
                                        <label for="is_featured" class="text-sm font-medium text-gray-700">
                                            Feature this opportunity
                                        </label>
                                        <p class="text-xs sm:text-sm text-gray-500 mt-1">
                                            Featured opportunities appear at the top of listings with a special badge
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="border-t border-gray-200 pt-4 sm:pt-6">
                            <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3">
                                <a href="{{ route('dashboard.opportunities') }}"
                                    class="inline-flex items-center justify-center px-4 sm:px-6 py-2.5 sm:py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200 font-medium text-sm sm:text-base">
                                    <i class="bx bx-x mr-2"></i>
                                    Cancel
                                </a>
                                <button type="submit"
                                    class="inline-flex items-center justify-center px-4 sm:px-6 py-2.5 sm:py-3 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors duration-200 font-medium shadow-sm text-sm sm:text-base">
                                    <i class="bx bx-check mr-2"></i>
                                    Create Opportunity
                                </button>
                            </div>
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
                        tag.className =
                            'inline-flex items-center gap-1 px-3 py-1 bg-teal-100 text-teal-700 rounded-full text-sm font-medium cursor-pointer hover:bg-teal-200 transition-colors duration-200';
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
