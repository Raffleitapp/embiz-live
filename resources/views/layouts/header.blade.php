@php
    $navLinks = [
        ['name' => 'Home', 'url' => url('/')],
        ['name' => 'Network', 'url' => url('/network')],
        ['name' => 'Messages', 'url' => url('/messages')],
        ['name' => 'Affiliate Partners', 'url' => url('/affiliates')],
        // ['name' => 'About', 'url' => url('/about')],
        // ['name' => 'Blog', 'url' => url('/blog')],
        // ['name' => 'Login', 'url' => route('login')],
        // ['name' => 'Register', 'url' => route('register')],
    ];
@endphp

<header class="bg-white shadow-md">
    <nav class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex-shrink-0">
                <a href="{{ url('/') }}" class="text-2xl font-bold text-gray-800">
                    Embizlive
                </a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex space-x-8">
                @foreach ($navLinks as $link )
                    <a href="{{ $link['url'] }}"
                        class="text-gray-600 hover:text-blue-600 font-medium {{ request()->is(trim(parse_url($link['url'], PHP_URL_PATH), '/')) ? 'text-blue-600' : '' }}">
                        {{ $link['name'] }}
                    </a>    
                @endforeach
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button id="mobile-menu-button" class="text-gray-600 hover:text-blue-600 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1">
                @foreach ($navLinks as $link )
                    <a href="{{ $link['url'] }}"
                        class="block text-gray-600 hover:text-blue-600 font-medium py-2 {{ request()->is(trim(parse_url($link['url'], PHP_URL_PATH), '/')) ? 'text-blue-600' : '' }}">
                        {{ $link['name'] }}
                    </a>                    
                @endforeach
            </div>
        </div>
    </nav>
</header>

<!-- JavaScript for Mobile Menu Toggle -->
<script>
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuButton.addEventListener('click', function() {
        mobileMenu.classList.toggle('hidden');
    });

    // Always hide mobile menu on desktop resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) { // Tailwind's md breakpoint
            mobileMenu.classList.add('hidden');
        }
    });
</script>
