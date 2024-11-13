@props(['contacts'])

<footer class="bg-gray-800 text-white py-8">
    <div class="md:w-3/4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <div class="mb-4 md:mb-0">
                <p class="text-sm"> Copyright &copy; {{ $business_profile->brand_name . ' ' . date('Y', strtotime($business_profile->brand_founding_date)) }}. All rights reserved.</p>
            </div>
            <div class="flex space-x-4">
                @foreach ($contacts as $item)
                    <a href="{{ $item->url }}" class="hover:text-purple-400 text-2xl" target="_blank">
                        <i class="{{ $item->icon }}"></i>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</footer>
