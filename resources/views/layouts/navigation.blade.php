<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <style>
        /* Enhanced dropdown styling */
        .dropdown-item {
            position: relative;
            overflow: hidden;
        }
        
        .dropdown-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(14, 165, 233, 0.1), transparent);
            transition: left 0.5s;
        }
        
        .dropdown-item:hover::before {
            left: 100%;
        }
        
        .profile-dropdown {
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }
    </style>
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <svg viewBox="0 0 316 316" xmlns="http://www.w3.org/2000/svg" class="block h-9 w-auto fill-current text-gray-800">
                            <path d="M305.8 81.125C305.77 80.995 305.69 80.885 305.65 80.755C305.56 80.525 305.49 80.285 305.37 80.075C305.29 79.935 305.17 79.815 305.07 79.685C304.94 79.515 304.83 79.325 304.68 79.175C304.55 79.045 304.39 78.955 304.25 78.845C304.09 78.715 303.95 78.575 303.77 78.475L251.32 48.275C249.97 47.495 248.31 47.495 246.96 48.275L194.51 78.475C194.33 78.575 194.19 78.725 194.03 78.845C193.89 78.955 193.73 79.045 193.6 79.175C193.45 79.325 193.34 79.515 193.21 79.685C193.11 79.815 192.99 79.935 192.91 80.075C192.79 80.285 192.71 80.525 192.63 80.755C192.58 80.875 192.51 80.995 192.48 81.125C192.38 81.495 192.33 81.875 192.33 82.265V139.625L148.62 164.795V52.575C148.62 52.185 148.57 51.805 148.47 51.435C148.44 51.305 148.36 51.195 148.32 51.065C148.23 50.835 148.16 50.595 148.04 50.385C147.96 50.245 147.84 50.125 147.74 49.995C147.61 49.825 147.5 49.635 147.35 49.485C147.22 49.355 147.06 49.265 146.92 49.155C146.76 49.025 146.62 48.885 146.44 48.785L93.99 18.585C92.64 17.805 90.98 17.805 89.63 18.585L37.18 48.785C37 48.885 36.86 49.035 36.7 49.155C36.56 49.265 36.4 49.355 36.27 49.485C36.12 49.635 36.01 49.825 35.88 49.995C35.78 50.125 35.66 50.245 35.58 50.385C35.46 50.595 35.38 50.835 35.3 51.065C35.25 51.185 35.18 51.305 35.15 51.435C35.05 51.805 35 52.185 35 52.575V232.235C35 233.795 35.84 235.245 37.19 236.025L142.1 296.425C142.33 296.555 142.58 296.635 142.82 296.725C142.93 296.765 143.04 296.835 143.16 296.865C143.53 296.965 143.9 297.015 144.28 297.015C144.66 297.015 145.03 296.965 145.4 296.865C145.5 296.835 145.59 296.775 145.69 296.745C145.95 296.655 146.21 296.565 146.45 296.435L251.36 236.035C252.72 235.255 253.55 233.815 253.55 232.245V174.885L303.81 145.945C305.17 145.165 306 143.725 306 142.155V82.265C305.95 81.875 305.89 81.495 305.8 81.125ZM144.2 227.205L100.57 202.515L146.39 176.135L196.66 147.195L240.33 172.335L208.29 190.625L144.2 227.205ZM244.75 114.995V164.795L226.39 154.225L201.03 139.625V89.825L219.39 100.395L244.75 114.995ZM249.12 57.105L292.81 82.265L249.12 107.425L205.43 82.265L249.12 57.105ZM114.49 184.425L96.13 194.995V85.305L121.49 70.705L139.85 60.135V169.815L114.49 184.425ZM91.76 27.425L135.45 52.585L91.76 77.745L48.07 52.585L91.76 27.425ZM43.67 60.135L62.03 70.705L87.39 85.305V202.545V202.555V202.565C87.39 202.735 87.44 202.895 87.46 203.055C87.49 203.265 87.49 203.485 87.55 203.695V203.705C87.6 203.875 87.69 204.035 87.76 204.195C87.84 204.375 87.89 204.575 87.99 204.745C87.99 204.745 87.99 204.755 88 204.755C88.09 204.905 88.22 205.035 88.33 205.175C88.45 205.335 88.55 205.495 88.69 205.635L88.7 205.645C88.82 205.765 88.98 205.855 89.12 205.965C89.28 206.085 89.42 206.225 89.59 206.325C89.6 206.325 89.6 206.325 89.61 206.335C89.62 206.335 89.62 206.345 89.63 206.345L139.87 234.775V285.065L43.67 229.705V60.135ZM244.75 229.705L148.58 285.075V234.775L219.8 194.115L244.75 179.875V229.705ZM297.2 139.625L253.49 164.795V114.995L278.85 100.395L297.21 89.825V139.625H297.2Z"/>
                        </svg>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out' : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out' }}">
                        {{ __('Dashboard') }}
                    </a>
                    <a href="{{ route('dashboard.opportunities') }}" class="{{ request()->routeIs('dashboard.opportunities*') ? 'inline-flex items-center px-1 pt-1 border-b-2 border-indigo-400 text-sm font-medium leading-5 text-gray-900 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out' : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out' }}">
                        {{ __('Opportunities') }}
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
                    <div @click="open = ! open">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150 hover:bg-gray-50">
                            <div class="flex items-center space-x-2">
                                <div class="w-8 h-8 bg-teal-600 rounded-full flex items-center justify-center">
                                    <span class="text-white font-medium text-xs">{{ Auth::user()->initials }}</span>
                                </div>
                                <div class="hidden md:block">
                                    <div class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</div>
                                </div>
                            </div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4 transition-transform duration-200" :class="{ 'rotate-180': open }" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </div>

                    <div x-show="open"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 scale-95"
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="opacity-100 scale-100"
                            x-transition:leave-end="opacity-0 scale-95"
                            class="absolute z-50 mt-2 w-64 rounded-lg shadow-lg ltr:origin-top-right rtl:origin-top-left end-0 bg-white ring-1 ring-black ring-opacity-5 profile-dropdown"
                            style="display: none;"
                            @click="open = false">
                        <div class="py-2">
                            <!-- User Info Header -->
                            <div class="px-4 py-3 border-b border-gray-100">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-teal-600 rounded-full flex items-center justify-center">
                                        <span class="text-white font-medium text-sm">{{ Auth::user()->initials }}</span>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">{{ Auth::user()->name }}</p>
                                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                        <p class="text-xs text-teal-600 font-medium mt-1">{{ Auth::user()->role ? Auth::user()->role->display_name : 'User' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Navigation Links -->
                            <div class="py-2">
                                <a href="{{ route('user-profile') }}" class="dropdown-item flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors duration-200">
                                    <i class='bx bx-user mr-3 text-gray-400 text-base'></i>
                                    <span>View Profile</span>
                                </a>
                                
                                <a href="{{ route('dashboard') }}" class="dropdown-item flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors duration-200">
                                    <i class='bx bx-grid-alt mr-3 text-gray-400 text-base'></i>
                                    <span>Dashboard</span>
                                </a>
                                
                                <a href="{{ route('dashboard.opportunities') }}" class="dropdown-item flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors duration-200">
                                    <i class='bx bx-briefcase mr-3 text-gray-400 text-base'></i>
                                    <span>Opportunities</span>
                                </a>
                                
                                <a href="{{ route('messages.index') }}" class="dropdown-item flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors duration-200">
                                    <i class='bx bx-message-dots mr-3 text-gray-400 text-base'></i>
                                    <span>Messages</span>
                                </a>
                                
                                <a href="{{ route('network.index') }}" class="dropdown-item flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors duration-200">
                                    <i class='bx bx-network-chart mr-3 text-gray-400 text-base'></i>
                                    <span>Network</span>
                                </a>
                            </div>

                            <!-- Settings Section -->
                            <div class="border-t border-gray-100 py-2">
                                <a href="{{ route('account.edit') }}" class="dropdown-item flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors duration-200">
                                    <i class='bx bx-cog mr-3 text-gray-400 text-base'></i>
                                    <span>Account Settings</span>
                                </a>
                                
                                @if(Auth::user()->isAdmin())
                                <a href="{{ route('dashboard.settings') }}" class="dropdown-item flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors duration-200">
                                    <i class='bx bx-shield mr-3 text-gray-400 text-base'></i>
                                    <span>Admin Settings</span>
                                </a>
                                @endif
                                
                                <a href="{{ route('dashboard.support') }}" class="dropdown-item flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-gray-900 transition-colors duration-200">
                                    <i class='bx bx-help-circle mr-3 text-gray-400 text-base'></i>
                                    <span>Support & Help</span>
                                </a>
                            </div>

                            <!-- Logout -->
                            <div class="border-t border-gray-100 py-2">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition-colors duration-200">
                                        <i class='bx bx-log-out mr-3 text-red-400 text-base'></i>
                                        <span>Sign Out</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-indigo-400 text-start text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out' : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out' }}">
                {{ __('Dashboard') }}
            </a>
            <a href="{{ route('dashboard.opportunities') }}" class="{{ request()->routeIs('dashboard.opportunities*') ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-indigo-400 text-start text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out' : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out' }}">
                {{ __('Opportunities') }}
            </a>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4 pb-3 border-b border-gray-200">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-teal-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-medium text-sm">{{ Auth::user()->initials }}</span>
                    </div>
                    <div>
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                        <div class="text-xs text-teal-600 font-medium mt-1">{{ Auth::user()->role ? Auth::user()->role->display_name : 'User' }}</div>
                    </div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('user-profile') }}" class="flex items-center w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                    <i class='bx bx-user mr-3 text-gray-400'></i>
                    <span>View Profile</span>
                </a>
                
                <a href="{{ route('messages.index') }}" class="flex items-center w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                    <i class='bx bx-message-dots mr-3 text-gray-400'></i>
                    <span>Messages</span>
                </a>
                
                <a href="{{ route('network.index') }}" class="flex items-center w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                    <i class='bx bx-network-chart mr-3 text-gray-400'></i>
                    <span>Network</span>
                </a>
                
                <a href="{{ route('account.edit') }}" class="flex items-center w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                    <i class='bx bx-cog mr-3 text-gray-400'></i>
                    <span>Account Settings</span>
                </a>
                
                @if(Auth::user()->isAdmin())
                <a href="{{ route('dashboard.settings') }}" class="flex items-center w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                    <i class='bx bx-shield mr-3 text-gray-400'></i>
                    <span>Admin Settings</span>
                </a>
                @endif
                
                <a href="{{ route('dashboard.support') }}" class="flex items-center w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out">
                    <i class='bx bx-help-circle mr-3 text-gray-400'></i>
                    <span>Support & Help</span>
                </a>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-red-600 hover:text-red-800 hover:bg-red-50 hover:border-red-300 focus:outline-none focus:text-red-800 focus:bg-red-50 focus:border-red-300 transition duration-150 ease-in-out">
                        <i class='bx bx-log-out mr-3 text-red-400'></i>
                        <span>Sign Out</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
