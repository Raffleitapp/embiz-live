@extends('layouts.dashboard')

@section('page-title', 'Create Opportunity')

@section('header-icon')
<i class="bx bx-plus-circle text-gray-600 text-lg sm:text-xl"></i>
@endsection

@section('content')
<div class="p-3 sm:p-4 lg:p-6">
    <div class="max-w-3xl mx-auto">
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Create New Opportunity</h2>

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

            <form action="{{ route('opportunities.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Opportunity Title *
                        </label>
                        <input type="text" 
                               id="title" 
                               name="title" 
                               value="{{ old('title') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                               required>
                    </div>

                    <div>
                        <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                            Opportunity Type *
                        </label>
                        <select id="type" 
                                name="type" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                                required>
                            <option value="">Select Type</option>
                            <option value="investment" {{ old('type') == 'investment' ? 'selected' : '' }}>Investment</option>
                            <option value="funding" {{ old('type') == 'funding' ? 'selected' : '' }}>Funding</option>
                            <option value="partnership" {{ old('type') == 'partnership' ? 'selected' : '' }}>Partnership</option>
                            <option value="mentorship" {{ old('type') == 'mentorship' ? 'selected' : '' }}>Mentorship</option>
                            <option value="grant" {{ old('type') == 'grant' ? 'selected' : '' }}>Grant</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Description *
                    </label>
                    <textarea id="description" 
                              name="description" 
                              rows="4"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent"
                              required>{{ old('description') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="budget_range" class="block text-sm font-medium text-gray-700 mb-2">
                            Budget Range
                        </label>
                        <input type="text" 
                               id="budget_range" 
                               name="budget_range" 
                               value="{{ old('budget_range') }}"
                               placeholder="e.g., $10k - $50k"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                    </div>

                    <div>
                        <label for="deadline" class="block text-sm font-medium text-gray-700 mb-2">
                            Application Deadline
                        </label>
                        <input type="date" 
                               id="deadline" 
                               name="deadline" 
                               value="{{ old('deadline') }}"
                               class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                    </div>
                </div>

                <div>
                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                        Location
                    </label>
                    <input type="text" 
                           id="location" 
                           name="location" 
                           value="{{ old('location') }}"
                           placeholder="e.g., Remote, New York, London"
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                </div>

                <div>
                    <label for="requirements" class="block text-sm font-medium text-gray-700 mb-2">
                        Requirements
                    </label>
                    <textarea id="requirements" 
                              name="requirements" 
                              rows="3"
                              placeholder="List any specific requirements or qualifications..."
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">{{ old('requirements') }}</textarea>
                </div>

                <div>
                    <label for="contact_info" class="block text-sm font-medium text-gray-700 mb-2">
                        Contact Information
                    </label>
                    <textarea id="contact_info" 
                              name="contact_info" 
                              rows="2"
                              placeholder="How should interested parties contact you?"
                              class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent">{{ old('contact_info') }}</textarea>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" 
                           id="is_featured" 
                           name="is_featured" 
                           value="1"
                           {{ old('is_featured') ? 'checked' : '' }}
                           class="w-4 h-4 text-teal-600 border-gray-300 rounded focus:ring-teal-500">
                    <label for="is_featured" class="ml-2 text-sm text-gray-700">
                        Feature this opportunity (appears at the top of listings)
                    </label>
                </div>

                <div class="flex justify-end space-x-3 pt-4">
                    <a href="{{ route('opportunities.index') }}" 
                       class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        Cancel
                    </a>
                    <button type="submit" 
                            class="px-6 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors">
                        Create Opportunity
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
