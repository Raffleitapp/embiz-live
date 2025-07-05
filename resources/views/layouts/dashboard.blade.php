<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Embiz') }} - Dashboard</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Boxicons -->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        
        <!-- Alpine.js -->
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
        <!-- Alpine.js Cloak Style -->
        <style>
            [x-cloak] { display: none !important; }
        </style>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="flex min-h-screen bg-gray-50">
            <!-- Sidebar -->
            <div class="hidden md:flex w-64 bg-white shadow-lg">
                <div class="p-6">
                    <div class="flex items-center space-x-2 mb-8">
                        <span class="text-xl font-bold text-gray-800">Embiz</span>
                    </div>
                    
                    <nav class="space-y-2">
                        <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">GENERAL</div>
                        <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-3 py-2 {{ request()->routeIs('dashboard') ? 'text-teal-600 bg-teal-50' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg">
                            <i class='bx bx-grid-alt text-lg'></i>
                            <span class="font-medium">Dashboard</span>
                        </a>
                        
                        <div class="relative">
                            <button class="flex items-center justify-between w-full px-3 py-2 {{ request()->routeIs('dashboard.members*') || request()->routeIs('dashboard.add-member') ? 'text-teal-600 bg-teal-50' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg" onclick="toggleSubmenu('members')">
                                <div class="flex items-center space-x-3">
                                    <i class='bx bx-users text-lg'></i>
                                    <span class="font-medium">Members</span>
                                </div>
                                <i class='bx bx-chevron-down text-sm transform transition-transform {{ request()->routeIs('dashboard.members*') || request()->routeIs('dashboard.add-member') ? 'rotate-180' : '' }}' id="members-chevron"></i>
                            </button>
                            <div class="mt-2 ml-6 space-y-1 {{ request()->routeIs('dashboard.members*') || request()->routeIs('dashboard.add-member') ? 'block' : 'hidden' }}" id="members-submenu">
                                <a href="{{ route('dashboard.members') }}" class="block px-3 py-2 text-sm {{ request()->routeIs('dashboard.members') ? 'text-teal-600 font-medium' : 'text-gray-600 hover:text-gray-900' }}">All Members</a>
                                <a href="{{ route('dashboard.add-member') }}" class="block px-3 py-2 text-sm {{ request()->routeIs('dashboard.add-member') ? 'text-teal-600 font-medium' : 'text-gray-600 hover:text-gray-900' }}">Add Member</a>
                            </div>
                        </div>
                        
                        <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg">
                            <i class='bx bx-shield text-lg'></i>
                            <span class="font-medium">Roles & Permissions</span>
                        </a>
                        
                        <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg">
                            <i class='bx bx-list-ul text-lg'></i>
                            <span class="font-medium">Activity Logs</span>
                        </a>
                        
                        <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3 mt-6">OTHERS</div>
                        <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg">
                            <i class='bx bx-cog text-lg'></i>
                            <span class="font-medium">Settings</span>
                        </a>
                        
                        <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg">
                            <i class='bx bx-help-circle text-lg'></i>
                            <span class="font-medium">Support / Help</span>
                        </a>
                        
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg w-full text-left">
                                <i class='bx bx-log-out text-lg'></i>
                                <span class="font-medium">Logout</span>
                            </button>
                        </form>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="flex-1 overflow-hidden">
                <!-- Header -->
                <div class="bg-white shadow-sm border-b">
                    <div class="px-4 sm:px-6 py-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <!-- Mobile menu button -->
                                <button class="md:hidden p-2 rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100" onclick="toggleMobileMenu()">
                                    <i class='bx bx-menu text-xl'></i>
                                </button>
                                
                                <div class="w-10 h-10 bg-gray-100 rounded-lg flex items-center justify-center">
                                    @hasSection('header-icon')
                                        {!! $__env->yieldContent('header-icon') !!}
                                    @else
                                        <i class="bx bx-grid-alt text-gray-600 text-xl"></i>
                                    @endif
                                </div>
                                <h1 class="text-xl sm:text-2xl font-bold text-gray-900">@yield('page-title', 'Dashboard')</h1>
                            </div>
                            
                            <div class="flex items-center space-x-2 sm:space-x-4">
                                <div class="hidden sm:block">
                                    @yield('header-actions')
                                </div>
                                
                                <div class="relative">
                                    <button class="p-2 text-gray-400 hover:text-gray-600">
                                        <i class='bx bx-bell text-xl'></i>
                                    </button>
                                </div>
                                
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-teal-600 rounded-full flex items-center justify-center">
                                        <span class="text-white font-medium text-sm">{{ substr(auth()->user()->name, 0, 1) }}</span>
                                    </div>
                                    <div class="hidden sm:block">
                                        <div class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</div>
                                        <div class="text-xs text-gray-500">Admin</div>
                                    </div>
                                    <i class='bx bx-chevron-down text-gray-400'></i>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Mobile header actions -->
                        <div class="sm:hidden mt-4">
                            @yield('header-actions')
                        </div>
                    </div>
                </div>

                <!-- Page Content -->
                <main class="p-4 sm:p-6">
                    @yield('content')
                </main>
            </div>
        </div>

        <!-- Mobile Sidebar Overlay -->
        <div id="mobile-sidebar-overlay" class="hidden fixed inset-0 bg-black bg-opacity-50 z-40 md:hidden" onclick="toggleMobileMenu()"></div>
        
        <!-- Mobile Sidebar -->
        <div id="mobile-sidebar" class="hidden fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out md:hidden">
            <div class="p-6">
                <div class="flex items-center justify-between mb-8">
                    <span class="text-xl font-bold text-gray-800">Embiz</span>
                    <button class="p-2 rounded-lg text-gray-400 hover:text-gray-600 hover:bg-gray-100" onclick="toggleMobileMenu()">
                        <i class='bx bx-x text-xl'></i>
                    </button>
                </div>
                
                <nav class="space-y-2">
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">GENERAL</div>
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 px-3 py-2 {{ request()->routeIs('dashboard') ? 'text-teal-600 bg-teal-50' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg">
                        <i class='bx bx-grid-alt text-lg'></i>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    
                    <div class="relative">
                        <button class="flex items-center justify-between w-full px-3 py-2 {{ request()->routeIs('dashboard.members*') || request()->routeIs('dashboard.add-member') ? 'text-teal-600 bg-teal-50' : 'text-gray-700 hover:bg-gray-50' }} rounded-lg" onclick="toggleSubmenu('mobile-members')">
                            <div class="flex items-center space-x-3">
                                <i class='bx bx-users text-lg'></i>
                                <span class="font-medium">Members</span>
                            </div>
                            <i class='bx bx-chevron-down text-sm transform transition-transform {{ request()->routeIs('dashboard.members*') || request()->routeIs('dashboard.add-member') ? 'rotate-180' : '' }}' id="mobile-members-chevron"></i>
                        </button>
                        <div class="mt-2 ml-6 space-y-1 {{ request()->routeIs('dashboard.members*') || request()->routeIs('dashboard.add-member') ? 'block' : 'hidden' }}" id="mobile-members-submenu">
                            <a href="{{ route('dashboard.members') }}" class="block px-3 py-2 text-sm {{ request()->routeIs('dashboard.members') ? 'text-teal-600 font-medium' : 'text-gray-600 hover:text-gray-900' }}">All Members</a>
                            <a href="{{ route('dashboard.add-member') }}" class="block px-3 py-2 text-sm {{ request()->routeIs('dashboard.add-member') ? 'text-teal-600 font-medium' : 'text-gray-600 hover:text-gray-900' }}">Add Member</a>
                        </div>
                    </div>
                    
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg">
                        <i class='bx bx-shield text-lg'></i>
                        <span class="font-medium">Roles & Permissions</span>
                    </a>
                    
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg">
                        <i class='bx bx-list-ul text-lg'></i>
                        <span class="font-medium">Activity Logs</span>
                    </a>
                    
                    <div class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3 mt-6">OTHERS</div>
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg">
                        <i class='bx bx-cog text-lg'></i>
                        <span class="font-medium">Settings</span>
                    </a>
                    
                    <a href="#" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg">
                        <i class='bx bx-help-circle text-lg'></i>
                        <span class="font-medium">Support / Help</span>
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center space-x-3 px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg w-full text-left">
                            <i class='bx bx-log-out text-lg'></i>
                            <span class="font-medium">Logout</span>
                        </button>
                    </form>
                </nav>
            </div>
        </div>

        <script>
        function toggleMobileMenu() {
            const overlay = document.getElementById('mobile-sidebar-overlay');
            const sidebar = document.getElementById('mobile-sidebar');
            
            if (overlay.classList.contains('hidden')) {
                overlay.classList.remove('hidden');
                sidebar.classList.remove('hidden');
                setTimeout(() => {
                    sidebar.classList.remove('-translate-x-full');
                }, 10);
            } else {
                sidebar.classList.add('-translate-x-full');
                setTimeout(() => {
                    overlay.classList.add('hidden');
                    sidebar.classList.add('hidden');
                }, 300);
            }
        }
        
        function toggleSubmenu(submenu) {
            const submenuElement = document.getElementById(submenu + '-submenu');
            const chevron = document.getElementById(submenu + '-chevron');
            
            if (submenuElement && chevron) {
                if (submenuElement.classList.contains('hidden')) {
                    submenuElement.classList.remove('hidden');
                    submenuElement.classList.add('block');
                    chevron.classList.add('rotate-180');
                } else {
                    submenuElement.classList.add('hidden');
                    submenuElement.classList.remove('block');
                    chevron.classList.remove('rotate-180');
                }
            }
        }
        </script>
        @stack('scripts')
    </body>
</html>
