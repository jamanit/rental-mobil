@extends('layouts.app-home')

@push('title')
    {{ 'Home' }}
@endpush

@section('content')
    <!-- cover -->
    <section id="home" class="relative w-full h-screen mt-0 overflow-hidden bg-gray-800">
        <div class="relative w-full h-full overflow-hidden">
            <div class="slide absolute w-full h-full">
                <img src="{{ Storage::url($setting->home_cover_image) }}" alt="Cover" class="w-full h-full object-cover object-left">
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

    <!-- services -->
    <section id="services" class="relative w-full pt-16 bg-gray-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 overflow-hidden">
            <h2 class="text-3xl text-center font-bold text-purple-400 mb-4">Services</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                @foreach ($services as $item)
                    <div class="bg-white shadow-md rounded-lg p-4 flex items-center" data-aos="fade-up">
                        <div class="text-purple-400 text-5xl mr-4">
                            <i class="{{ $item->icon }}"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-lg">{{ $item->title }}</h3>
                            <p class="text-gray-600">{{ $item->description }}</p>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#ffffff" fill-opacity="1" d="M0,224L48,208C96,192,192,160,288,160C384,160,480,192,576,213.3C672,235,768,245,864,234.7C960,224,1056,192,1152,170.7C1248,149,1344,139,1392,133.3L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
            </path>
        </svg>
    </section>

    <!-- template -->
    <section id="template" class="relative w-full pt-16 bg-white">
        <div class="md:w-3/4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 overflow-hidden">
            <h2 class="text-3xl text-center font-bold text-purple-400 mb-8">Template</h2>
            <div id="templates" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">

                @foreach ($templates as $item)
                    <div class="shadow-md border border-gray-300 transition-transform transform duration-300 hover:scale-105 rounded-lg relative">
                        <div class="absolute top-2 right-0 bg-red-500 text-white text-xs font-semibold px-2 py-1 shadow-lg rounded-l-lg {{ $item->percent_discount > 0 ? 'block' : 'hidden' }}">
                            {{ $item->percent_discount }}% Diskon
                        </div>
                        <div class="w-full h-56 flex items-center justify-center">
                            <img src="{{ Storage::url($item->image) }}" alt="Deskripsi Gambar" class="object-contain max-h-full max-w-full p-1">
                        </div>
                        <div class="p-4">
                            <h3 class="text-base font-semibold">{{ $item->template_name }}</h3>
                            <p class="text-xs text-gray-600">{{ $item->template_type->template_type_name }}</p>
                            <div class="flex justify-between items-center mt-4 text-sm">
                                @if ($item->percent_discount <= 0)
                                    <p class="text-green-500 font-semibold">Rp. {{ number_format($item->price) }}</p>
                                @else
                                    <p class="text-gray-600 line-through">Rp. {{ number_format($item->price) }}</p>
                                    <p class="text-green-500 font-semibold">Rp. {{ number_format($item->total_amount) }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="p-4 flex justify-between">
                            <a href="{{ asset($item->example_url) }}" target="_blank" class="rounded-lg bg-purple-400 p-2 text-base text-white hover:bg-purple-500">
                                Lihat Contoh
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex justify-center mt-4">
                <button id="load-more-template" class="rounded-lg bg-purple-400 p-2 text-base text-white hover:bg-purple-500">
                    Lihat templat lainnya
                </button>
            </div>
        </div>

        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#d1d5db" fill-opacity="1" d="M0,96L48,122.7C96,149,192,203,288,218.7C384,235,480,213,576,192C672,171,768,149,864,154.7C960,160,1056,192,1152,202.7C1248,213,1344,203,1392,197.3L1440,192L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
            </path>
        </svg>
    </section>

    <!-- about -->
    <section id="about" class="relative w-full pt-16 bg-gray-300">
        <div class="md:w-3/4 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 overflow-hidden">
            <h2 class="text-3xl text-center font-bold text-purple-400 mb-4">About Us</h2>
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
            <h2 class="text-3xl text-center font-bold text-purple-400 mb-8">Contact</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Kolom Kiri: Formulir -->
                <div data-aos="fade-right">
                    <form id="contact-form" onsubmit="sendMessage(event, 'bg-purple-500')">
                        <div class="mb-4">
                            <label for="name" class="mb-2 block text-left text-sm font-semibold text-gray-800">Name</label>
                            <input type="text" name="name" id="name" placeholder="Enter Name" class="w-full rounded-lg border border-purple-400 p-3 focus:outline-none focus:ring-2 focus:ring-purple-400" />
                        </div>
                        <div class="mb-4">
                            <label for="email" class="mb-2 block text-left text-sm font-semibold text-gray-800">Email</label>
                            <input type="email" name="email" id="email" placeholder="Enter Email" class="w-full rounded-lg border border-purple-400 p-3 focus:outline-none focus:ring-2 focus:ring-purple-400" />
                        </div>
                        <div class="mb-4">
                            <label for="message" class="mb-2 block text-left text-sm font-semibold text-gray-800">Message</label>
                            <textarea name="message" id="message" placeholder="Enter Message" class="w-full rounded-lg border border-purple-400 p-3 focus:outline-none focus:ring-2 focus:ring-purple-400" rows="2"></textarea>
                        </div>
                        <button type="submit" class="mt-4 w-full rounded-lg bg-purple-400 p-2 text-base text-white hover:bg-purple-500">
                            <i class="fas fa-paper-plane"></i> SEND
                        </button>
                    </form>
                </div>

                <!-- Kolom Kanan: Media Sosial -->
                <div class="flex flex-col items-start" data-aos="fade-left">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Follow Us</h3>
                    <div class="flex space-x-4 mb-4">
                        @foreach ($contacts as $item)
                            <a href="{{ $item->url }}" class="text-gray-800 hover:text-purple-400 text-2xl" target="_blank">
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
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#contact-form').on('submit', function(event) {
                event.preventDefault();

                var formData = $(this).serialize();

                $.ajax({
                    type: 'POST',
                    url: '/send-contact-form',
                    data: formData,
                    success: function(response) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'success',
                            title: response.message,
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                        });
                        $('#contact-form')[0].reset();
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let errorMessage = '';
                            for (let key in errors) {
                                errorMessage += errors[key][0] + '\n';
                            }
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                text: errorMessage,
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            });
                        }
                    }
                });
            });
        });
    </script>

    <script>
        let offset = {{ count($templates) }};

        $('#load-more-template').on('click', function() {
            $.ajax({
                url: '/load-more-template',
                type: 'GET',
                data: {
                    offset: offset
                },
                success: function(data) {
                    if (data.length > 0) {
                        data.forEach(item => {
                            $('#templates').append(`
                                <div class="shadow-md border border-gray-300 transition-transform transform duration-300 hover:scale-105 rounded-lg relative">
                                    <div class="absolute top-2 right-0 bg-red-500 text-white text-xs font-semibold px-2 py-1 shadow-lg rounded-l-lg ${item.percent_discount > 0 ? 'block' : 'hidden'}">
                                        ${item.percent_discount}% Diskon
                                    </div>
                                    <div class="w-full h-56 flex items-center justify-center">
                                        <img src="${item.image}" alt="Deskripsi Gambar" class="object-contain max-h-full max-w-full p-1">
                                    </div>
                                    <div class="p-4">
                                        <h3 class="text-base font-semibold">${item.template_name}</h3>
                                        <p class="text-xs text-gray-600">${item.template_type_name}</p>
                                        <div class="flex justify-between items-center mt-4 text-sm">
                                            ${item.percent_discount <= 0 ?
                                                `<p class="text-green-500 font-semibold">Rp. ${item.price}</p>` :
                                                `<p class="text-gray-600 line-through">Rp. ${item.price}</p> 
                                                                                                                     <p class="text-green-500 font-semibold">Rp. ${item.total_amount}</p>`
                                            }
                                        </div>
                                    </div>
                                    <div class="p-4 flex justify-between">
                                        <a href="${item.example_url}" target="_blank" class="rounded-lg bg-purple-400 p-2 text-base text-white hover:bg-purple-500">
                                           Lihat Contoh
                                        </a>
                                    </div>
                                </div>
                            `);
                        });
                        offset += data.length;
                    } else {
                        $('#load-more-template').text('Tidak ada lagi templat yang tersedia').prop('disabled', true);
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan saat memuat templat.');
                }
            });
        });
    </script>
@endpush
