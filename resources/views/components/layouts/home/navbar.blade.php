<nav id="navbar" class="fixed top-0 w-full z-20 bg-transparent navbar">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex-shrink-0 flex items-center">
                <a href="#home" class="flex items-center gap-2">
                    <img src="{{ Storage::url($business_profile->logo) }}" alt="" class="w-10 rounded-lg">
                    <div id="brand-name" class="text-lg text-white hover:text-purple-500 font-semibold">{{ $business_profile->brand_name }}</div>
                </a>
            </div>
            <div id="navbar-links" class="hidden md:flex space-x-8 items-center font-semibold">
                <a href="#home" class="text-white hover:text-purple-500">Home</a>
                <a href="#services" class="text-white hover:text-purple-500">Services</a>
                <a href="#template" class="text-white hover:text-purple-500">Template</a>
                <a href="#about" class="text-white hover:text-purple-500">About Us</a>
                <a href="#contact" class="text-white hover:text-purple-500">Contact</a>
                <a href="{{ url('register') }}" class="text-white hover:text-purple-500">Register</a>
                <a href="{{ url('login') }}" class="text-white hover:text-purple-500">Login</a>
            </div>
            <div class="md:hidden flex items-center">
                <button id="mobile-menu-button" class="text-white hover:text-purple-500 focus:outline-none text-2xl">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu (Sliding from left) -->
    <div id="mobile-menu" class="fixed top-0 left-0 w-64 h-full bg-white shadow-lg slide-left transform transition duration-300 ease-out md:hidden mx-auto px-4">
        <div class="flex justify-between h-16 mb-4">
            <div class="flex-shrink-0 flex items-center">
                <a href="#home" class="flex items-center gap-2">
                    <img src="{{ Storage::url($business_profile->logo) }}" alt="" class="w-10 rounded-lg">
                    <div id="brand-name" class="text-lg text-gray-800 hover:text-purple-500 font-semibold">{{ $business_profile->brand_name }}</div>
                </a>
            </div>
            <button id="close-menu-button" class="text-gray-800 hover:text-purple-500 text-2xl">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="font-semibold">
            <a href="#home" class="mobile-menu-link block text-gray-800 hover:text-purple-500 mb-3">Home</a>
            <a href="#services" class="mobile-menu-link block text-gray-800 hover:text-purple-500 mb-3">Services</a>
            <a href="#template" class="mobile-menu-link block text-gray-800 hover:text-purple-500 mb-3">Template</a>
            <a href="#about" class="mobile-menu-link block text-gray-800 hover:text-purple-500 mb-3">About Us</a>
            <a href="#contact" class="mobile-menu-link block text-gray-800 hover:text-purple-500 mb-3">Contact</a>
            <a href="{{ url('register') }}" class="mobile-menu-link block text-gray-800 hover:text-purple-500 mb-3">Register</a>
            <a href="{{ url('login') }}" class="mobile-menu-link block text-gray-800 hover:text-purple-500 mb-3">Login</a>
        </div>
    </div>

    <!-- Overlay -->
    <div id="overlay" class="overlay"></div>
</nav>
