@extends('layouts.dashboard')

@section('page-title', 'Create Opportunity')

@section('header-icon')
<i class="bx bx-plus-circle text-teal-600 text-lg sm:text-xl"></i>
@endsection

@section('header-actions')
<a href="{{ route('dashboard.opportunities') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 text-sm font-medium transition-colors duration-200">
    <i class="bx bx-arrow-back mr-2"></i>Back to Opportunities
</a>
@endsection

@section('content')
<div class="p-3 sm:p-4 lg:p-6">
    <div class="max-w-3xl mx-auto">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">Create New Opportunity</h1>
            <p class="text-gray-600">Share your investment, funding, partnership, or mentorship opportunity with the community</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <div class="px-6 py-4 bg-gradient-to-r from-teal-50 to-white border-b border-gray-200">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-teal-100 rounded-lg flex items-center justify-center mr-3">
                        <i class="bx bx-plus-circle text-teal-600 text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-semibold text-gray-900">Opportunity Details</h2>
                        <p class="text-sm text-gray-600">Fill in the information below to create your opportunity</p>
                    </div>
                </div>
            </div>
            
            <div class="p-6">

            @if(session('success'))
                <div class="mb-6 p-4 bg-gradient-to-r from-green-50 to-green-100 border border-green-200 rounded-lg">
                    <div class="flex items-center">
                        <i class="bx bx-check-circle text-green-600 text-xl mr-3"></i>
                        <div>
                            <p class="text-green-800 font-medium">Success!</p>
                            <p class="text-green-700 text-sm">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 bg-gradient-to-r from-red-50 to-red-100 border border-red-200 rounded-lg">
                    <div class="flex items-start">
                        <i class="bx bx-error-circle text-red-600 text-xl mr-3 mt-0.5"></i>
                        <div>
                            <p class="text-red-800 font-medium mb-2">Please fix the following errors:</p>
                            <ul class="list-disc list-inside text-red-700 text-sm space-y-1">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <form action="{{ route('dashboard.opportunities.store') }}" method="POST" class="space-y-8">
                @csrf

                <!-- Basic Information -->
                <div class="space-y-6">
                    <div class="border-b border-gray-200 pb-4">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="bx bx-info-circle text-teal-600 mr-2"></i>
                            Basic Information
                        </h3>
                        <p class="text-sm text-gray-600 mt-1">Provide essential details about your opportunity</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="bx bx-edit-alt text-gray-400 mr-1"></i>
                                Opportunity Title *
                            </label>
                            <input type="text" 
                                   id="title" 
                                   name="title" 
                                   value="{{ old('title') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors duration-200 placeholder-gray-400"
                                   placeholder="Enter a compelling title for your opportunity"
                                   required>
                        </div>

                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="bx bx-category text-gray-400 mr-1"></i>
                                Opportunity Type *
                            </label>
                            <select id="type" 
                                    name="type" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors duration-200"
                                    required>
                                <option value="">Select Type</option>
                                <option value="investment" {{ old('type') == 'investment' ? 'selected' : '' }}>💰 Investment</option>
                                <option value="funding" {{ old('type') == 'funding' ? 'selected' : '' }}>💸 Funding</option>
                                <option value="partnership" {{ old('type') == 'partnership' ? 'selected' : '' }}>🤝 Partnership</option>
                                <option value="mentorship" {{ old('type') == 'mentorship' ? 'selected' : '' }}>🎓 Mentorship</option>
                                <option value="grant" {{ old('type') == 'grant' ? 'selected' : '' }}>🏆 Grant</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="bx bx-text text-gray-400 mr-1"></i>
                            Description *
                        </label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="5"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors duration-200 placeholder-gray-400"
                                  placeholder="Describe your opportunity in detail. What are you looking for? What do you offer? What are the benefits?"
                                  required>{{ old('description') }}</textarea>
                    </div>
                </div>

                <!-- Financial & Timeline Information -->
                <div class="space-y-6">
                    <div class="border-b border-gray-200 pb-4">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="bx bx-dollar-circle text-teal-600 mr-2"></i>
                            Financial & Timeline Details
                        </h3>
                        <p class="text-sm text-gray-600 mt-1">Add budget and timeline information</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="budget_range" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="bx bx-money text-gray-400 mr-1"></i>
                                Budget Range
                            </label>
                            <input type="text" 
                                   id="budget_range" 
                                   name="budget_range" 
                                   value="{{ old('budget_range') }}"
                                   placeholder="e.g., $10,000 - $50,000"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors duration-200 placeholder-gray-400">
                        </div>

                        <div>
                            <label for="deadline" class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="bx bx-calendar text-gray-400 mr-1"></i>
                                Application Deadline
                            </label>
                            <input type="date" 
                                   id="deadline" 
                                   name="deadline" 
                                   value="{{ old('deadline') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors duration-200">
                        </div>
                    </div>
                </div>

                <!-- Location & Requirements -->
                <div class="space-y-6">
                    <div class="border-b border-gray-200 pb-4">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="bx bx-map-pin text-teal-600 mr-2"></i>
                            Location & Requirements
                        </h3>
                        <p class="text-sm text-gray-600 mt-1">Specify location and requirements</p>
                    </div>

                    <div>
                        <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="bx bx-map text-gray-400 mr-1"></i>
                            Location
                        </label>
                        <input type="text" 
                               id="location" 
                               name="location" 
                               value="{{ old('location') }}"
                               placeholder="e.g., Remote, New York, London, Global"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors duration-200 placeholder-gray-400">
                    </div>

                    <div>
                        <label for="requirements" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="bx bx-check-square text-gray-400 mr-1"></i>
                            Requirements
                        </label>
                        <textarea id="requirements" 
                                  name="requirements" 
                                  rows="4"
                                  placeholder="List any specific requirements, qualifications, or criteria that applicants should meet..."
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors duration-200 placeholder-gray-400">{{ old('requirements') }}</textarea>
                    </div>

                    <div>
                        <label for="contact_info" class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="bx bx-envelope text-gray-400 mr-1"></i>
                            Contact Information
                        </label>
                        <textarea id="contact_info" 
                                  name="contact_info" 
                                  rows="3"
                                  placeholder="How should interested parties contact you? Include email, phone, or application process..."
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-colors duration-200 placeholder-gray-400">{{ old('contact_info') }}</textarea>
                    </div>
                </div>

                <!-- Additional Options -->
                <div class="space-y-6">
                    <div class="border-b border-gray-200 pb-4">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <i class="bx bx-cog text-teal-600 mr-2"></i>
                            Additional Options
                        </h3>
                        <p class="text-sm text-gray-600 mt-1">Configure additional settings</p>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input type="checkbox" 
                                       id="is_featured" 
                                       name="is_featured" 
                                       value="1"
                                       {{ old('is_featured') ? 'checked' : '' }}
                                       class="w-4 h-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500 focus:ring-2">
                            </div>
                            <div class="ml-3">
                                <label for="is_featured" class="text-sm font-medium text-gray-700">
                                    Feature this opportunity
                                </label>
                                <p class="text-sm text-gray-500 mt-1">
                                    Featured opportunities appear at the top of listings with a special badge
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="border-t border-gray-200 pt-6">
                    <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3">
                        <a href="{{ route('dashboard.opportunities') }}" 
                           class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors duration-200 font-medium">
                            <i class="bx bx-x mr-2"></i>
                            Cancel
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center justify-center px-6 py-3 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors duration-200 font-medium shadow-sm">
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
