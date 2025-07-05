@extends('layouts.dashboard')

@section('page-title', 'Settings')

@section('header-icon')
<i class="bx bx-cog text-gray-600 text-lg sm:text-xl"></i>
@endsection

@section('content')
<div class="p-3 sm:p-4 lg:p-6">
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-4 sm:mb-6 text-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="space-y-4 sm:space-y-6">
        <!-- General Settings -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-4 sm:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">General Settings</h3>
                <form action="{{ route('dashboard.update-settings') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="site_name" class="block text-sm font-medium text-gray-700 mb-2">Site Name</label>
                            <input type="text" 
                                   id="site_name" 
                                   name="site_name" 
                                   value="{{ $settings['site_name']->value ?? 'Embiz' }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm">
                        </div>
                        <div>
                            <label for="admin_email" class="block text-sm font-medium text-gray-700 mb-2">Admin Email</label>
                            <input type="email" 
                                   id="admin_email" 
                                   name="admin_email" 
                                   value="{{ $settings['admin_email']->value ?? 'admin@embiz.com' }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm">
                        </div>
                    </div>
                    
                    <div>
                        <label for="site_description" class="block text-sm font-medium text-gray-700 mb-2">Site Description</label>
                        <textarea id="site_description" 
                                  name="site_description" 
                                  rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent text-sm"
                                  placeholder="Enter site description...">{{ $settings['site_description']->value ?? 'Connecting Black entrepreneurs and professionals worldwide' }}</textarea>
                    </div>
                    
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   id="notifications_enabled" 
                                   name="notifications_enabled" 
                                   checked
                                   class="rounded border-gray-300 text-teal-600 focus:ring-teal-500">
                            <label for="notifications_enabled" class="ml-2 text-sm text-gray-700">Enable email notifications</label>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" 
                                   id="maintenance_mode" 
                                   name="maintenance_mode"
                                   class="rounded border-gray-300 text-teal-600 focus:ring-teal-500">
                            <label for="maintenance_mode" class="ml-2 text-sm text-gray-700">Maintenance mode</label>
                        </div>
                    </div>
                    
                    <div class="flex justify-end pt-4">
                        <button type="submit" 
                                class="px-4 py-2 bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors text-sm">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Security Settings -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-4 sm:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Security Settings</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div>
                            <div class="font-medium text-gray-900 text-sm">Two-Factor Authentication</div>
                            <div class="text-xs text-gray-500">Add an extra layer of security to your account</div>
                        </div>
                        <button class="px-3 py-1.5 text-sm bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors">
                            Enable
                        </button>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div>
                            <div class="font-medium text-gray-900 text-sm">Session Management</div>
                            <div class="text-xs text-gray-500">Manage active sessions across devices</div>
                        </div>
                        <button class="px-3 py-1.5 text-sm border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                            Manage
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Backup & Export -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-4 sm:p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Backup & Export</h3>
                <div class="space-y-4">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-3 bg-gray-50 rounded-lg space-y-2 sm:space-y-0">
                        <div>
                            <div class="font-medium text-gray-900 text-sm">Database Backup</div>
                            <div class="text-xs text-gray-500">Last backup: 2 hours ago</div>
                        </div>
                        <button class="px-3 py-1.5 text-sm bg-teal-600 text-white rounded-lg hover:bg-teal-700 transition-colors w-full sm:w-auto">
                            Create Backup
                        </button>
                    </div>
                    
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-3 bg-gray-50 rounded-lg space-y-2 sm:space-y-0">
                        <div>
                            <div class="font-medium text-gray-900 text-sm">Export Data</div>
                            <div class="text-xs text-gray-500">Download all system data as CSV/JSON</div>
                        </div>
                        <button class="px-3 py-1.5 text-sm border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors w-full sm:w-auto">
                            Export
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
