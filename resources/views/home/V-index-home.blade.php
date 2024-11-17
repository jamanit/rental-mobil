@extends('layouts.app-home')

@push('title')
    {{ 'Home' }}
@endpush

@section('content')
    <!-- cover -->
    <section id="home" class="relative w-full h-screen mt-0 overflow-hidden bg-gray-800">
        <div class="relative w-full h-full overflow-hidden">
            <div class="slide absolute w-full h-full">
                <img src="{{ Storage::url($setting->home_cover_image) }}" alt="Cover" class="w-full h-full object-cover object-left opacity-90">
                <div class="absolute inset-0 flex items-center justify-center text-center z-10">
                    <div class="bg-black bg-opacity-50 rounded-lg p-4 m-8" data-aos="fade-in">
                        <div class="text-gray-200 text-base sm:text-xl lg:text-2xl font-semibold">
                            {!! $setting->home_cover_text !!}
                        </div>
                    </div>
                </div>

                <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-10">
                    <a href="#services" class="text-white text-3xl" data-aos="fade-down" data-aos-offset="50">
                        <i class="fas fa-chevron-down"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- car   -->
    <section id="car" class="relative w-full pt-16 bg-white">
        <div class="md:w-3/4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-10 overflow-hidden">
            <h2 class="text-3xl text-center font-bold text-blue-400 mb-8">Mobil Rental</h2>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-2 gap-4 pb-10">
                @foreach ($mobil as $item)
                    @php
                        // Membuat array foto yang valid
                        $validImages = [$item->foto_1, $item->foto_2, $item->foto_3, $item->foto_4];
                        // Menyaring gambar yang ada
                        $validImages = array_filter($validImages);
                        $imageCount = count($validImages);
                    @endphp

                    <!-- Card Wrapper for each vehicle -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden transform hover:scale-105 transition duration-300 ease-in-out hover:shadow-2xl">

                        <div class="relative w-full" id="carousel-{{ $item->id }}">
                            <div class="overflow-hidden relative">
                                <!-- Carousel Inner -->
                                <div class="flex transition-transform duration-500 ease-in-out" style="transform: translateX(0%);">
                                    @foreach ($validImages as $index => $image)
                                        <div class="carousel-item flex-shrink-0 w-full">
                                            <img src="{{ Storage::url($image) }}" class="w-full h-56 object-cover" alt="Slide {{ $index + 1 }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Carousel Controls (Menonaktifkan tombol jika hanya ada satu gambar) -->
                            @if ($imageCount > 1)
                                <!-- Previous Button -->
                                <button class="absolute top-1/2 left-4 transform -translate-y-1/2 px-4 py-2 bg-gray-800 opacity-80 text-white rounded-full" id="prev-{{ $item->id }}">
                                    <i class="fa-solid fa-chevron-left"></i>
                                </button>
                                <!-- Next Button -->
                                <button class="absolute top-1/2 right-4 transform -translate-y-1/2 px-4 py-2 bg-gray-800 opacity-80 text-white rounded-full" id="next-{{ $item->id }}">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </button>
                            @endif
                        </div>


                        <!-- Card Content with Vehicle Info -->
                        <div class="p-4">
                            <h3 class="text-xl font-bold mb-2">{{ $item->merk }} {{ $item->model }}</h3>
                            <table class="table-auto w-full text-left text-sm">
                                <tr>
                                    <th class="pr-4">No. Polisi:</th>
                                    <td>{{ $item->no_polisi }}</td>
                                </tr>
                                <tr>
                                    <th class="pr-4">Tahun:</th>
                                    <td>{{ $item->tahun }}</td>
                                </tr>
                                <tr>
                                    <th class="pr-4">Warna:</th>
                                    <td>{{ $item->warna }}</td>
                                </tr>
                                <tr>
                                    <th class="pr-4">Harga Harian:</th>
                                    <td>Rp. {{ number_format($item->harga_harian) }}</td>
                                </tr>
                                <tr>
                                    <th class="pr-4">Status:</th>
                                    <td>{{ $item->status }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- pagination --}}
            <div class="flex justify-between items-center mb-4">
                @if ($mobil->total() > 0)
                    <div class="text-sm text-gray-700 mb-4">
                        Menampilkan {{ $mobil->firstItem() }} hingga {{ $mobil->lastItem() }} dari {{ $mobil->total() }} hasil
                    </div>
                @endif

                @if ($mobil->hasPages())
                    <ul class="flex justify-center space-x-2">
                        {{-- Previous Page Link --}}
                        @if ($mobil->onFirstPage())
                            <li class="disabled" aria-disabled="true">
                                <span class="px-4 py-2 border rounded-md bg-gray-200 text-gray-500 cursor-not-allowed">&laquo;</span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $mobil->previousPageUrl() }}#car" rel="prev" class="px-4 py-2 border rounded-md bg-white text-gray-700 hover:bg-blue-500 hover:text-white">&laquo;</a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @for ($page = 1; $page <= $mobil->lastPage(); $page++)
                            @if ($page == $mobil->currentPage())
                                <li aria-current="page">
                                    <span class="px-4 py-2 border rounded-md bg-blue-500 text-white">{{ $page }}</span>
                                </li>
                            @else
                                <li>
                                    <a href="{{ $mobil->url($page) }}#car" class="px-4 py-2 border rounded-md bg-white text-gray-700 hover:bg-blue-500 hover:text-white">{{ $page }}</a>
                                </li>
                            @endif
                        @endfor

                        {{-- Next Page Link --}}
                        @if ($mobil->hasMorePages())
                            <li>
                                <a href="{{ $mobil->nextPageUrl() }}#car" rel="next" class="px-4 py-2 border rounded-md bg-white text-gray-700 hover:bg-blue-500 hover:text-white">&raquo;</a>
                            </li>
                        @else
                            <li class="disabled" aria-disabled="true">
                                <span class="px-4 py-2 border rounded-md bg-gray-200 text-gray-500 cursor-not-allowed">&raquo;</span>
                            </li>
                        @endif
                    </ul>
                @endif
            </div>
        </div>

        <!-- Decorative SVG -->
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#d1d5db" fill-opacity="1" d="M0,96L48,122.7C96,149,192,203,288,218.7C384,235,480,213,576,192C672,171,768,149,864,154.7C960,160,1056,192,1152,202.7C1248,213,1344,203,1392,197.3L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </section>

    <!-- about -->
    <section id="about" class="relative w-full pt-16 bg-gray-300">
        <div class="md:w-3/4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 overflow-hidden">
            <h2 class="text-3xl text-center font-bold text-blue-400 mb-4">Tentang Kami</h2>
            <div class="text-gray-700 leading-relaxed text-justify" data-aos="zoom-in">
                {!! $business_profile->about !!}
            </div>
        </div>

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#ffffff" fill-opacity="1" d="M0,288L48,272C96,256,192,224,288,197.3C384,171,480,149,576,165.3C672,181,768,235,864,250.7C960,267,1056,245,1152,250.7C1248,256,1344,288,1392,304L1440,320L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
            </path>
        </svg>
    </section>

    <!-- contact -->
    <section id="contact" class="relative w-full py-16 bg-white">
        <div class="md:w-3/4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 overflow-hidden">
            <h2 class="text-3xl text-center font-bold text-blue-400 mb-8">Kontak</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div data-aos="fade-right">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Ikuti Kami</h3>
                    <div class="flex space-x-4 mb-4">
                        @foreach ($contacts as $item)
                            <a href="{{ $item->url }}" class="text-gray-800 hover:text-blue-400 text-2xl" target="_blank">
                                <i class="{{ $item->icon }}"></i>
                            </a>
                        @endforeach
                    </div>
                    <div class="mb-4 text-gray-800">
                        {{ $business_profile->address }}
                    </div>
                    {!! $business_profile->google_maps !!}
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($mobil as $item)
                // Menggunakan template literal untuk memberikan nama unik pada variabel
                const carousel_{{ $item->id }} = document.getElementById('carousel-{{ $item->id }}');
                const prevButton_{{ $item->id }} = document.getElementById('prev-{{ $item->id }}');
                const nextButton_{{ $item->id }} = document.getElementById('next-{{ $item->id }}');
                const slides_{{ $item->id }} = carousel_{{ $item->id }}.querySelectorAll('.carousel-item');
                const totalSlides_{{ $item->id }} = slides_{{ $item->id }}.length;
                let currentIndex_{{ $item->id }} = 0;

                // Fungsi untuk update transformasi carousel
                function updateCarousel_{{ $item->id }}() {
                    const offset = -100 * currentIndex_{{ $item->id }};
                    carousel_{{ $item->id }}.querySelector('.flex').style.transform = `translateX(${offset}%)`;
                }

                // Menyembunyikan tombol jika hanya ada satu gambar
                if (totalSlides_{{ $item->id }} <= 1) {
                    if (prevButton_{{ $item->id }}) prevButton_{{ $item->id }}.style.display = 'none';
                    if (nextButton_{{ $item->id }}) nextButton_{{ $item->id }}.style.display = 'none';
                }

                // Navigasi ke gambar berikutnya
                if (nextButton_{{ $item->id }}) {
                    nextButton_{{ $item->id }}.addEventListener('click', function() {
                        if (currentIndex_{{ $item->id }} < totalSlides_{{ $item->id }} - 1) {
                            currentIndex_{{ $item->id }}++;
                            updateCarousel_{{ $item->id }}();
                        }
                    });
                }

                // Navigasi ke gambar sebelumnya
                if (prevButton_{{ $item->id }}) {
                    prevButton_{{ $item->id }}.addEventListener('click', function() {
                        if (currentIndex_{{ $item->id }} > 0) {
                            currentIndex_{{ $item->id }}--;
                            updateCarousel_{{ $item->id }}();
                        }
                    });
                }
            @endforeach
        });
    </script>
@endpush
