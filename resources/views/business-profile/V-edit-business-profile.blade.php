@extends('layouts.app-dashboard')

@push('title')
    Profil Bisnis
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profil Bisnis</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Profil Bisnis</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">

                        @if (session('success') || session('error'))
                            <x-alert :type="session('success') ? 'success' : 'danger'" :message="session('success') ? session('success') : session('error')" />
                        @endif

                        <form action="{{ route('business-profiles.update', $business_profile->uuid) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <x-input-file type="file" name="logo" :value="$business_profile->logo" label="Logo" placeholder="Masukkan Logo" />
                                            </div>
                                            <div class="mb-3">
                                                <x-input type="text" name="brand_name" :value="$business_profile->brand_name" label="Nama Bisnis" placeholder="Masukkan Nama Bisnis" />
                                            </div>
                                            <div class="mb-3">
                                                <x-input type="date" name="brand_founding_date" :value="$business_profile->brand_founding_date" label="Tanggal Pendirian Bisnis" placeholder="Masukkan Tanggal Pendirian Bisnis" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <x-textarea name="address" :value="$business_profile->address" label="Alamat" placeholder="Masukkan Alamat" rows="2" />
                                            </div>
                                            <div class="mb-3">
                                                <x-input type="email" name="brand_email" :value="$business_profile->brand_email" label="Email" placeholder="Masukkan Email" />
                                            </div>
                                            <div class="mb-3">
                                                <x-input type="url" name="brand_website" :value="$business_profile->brand_website" label="Website" placeholder="Masukkan Website" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <x-textarea name="google_maps" :value="$business_profile->google_maps" label="Google Maps" placeholder="Masukkan Google Maps" rows="5" />
                                        <small class="text-info">Gunakan fitur sematkan peta dari Google Maps.</small>
                                    </div>
                                    <div class="mb-3">
                                        <x-textarea type="text" name="about" :value="$business_profile->about" label="About" placeholder="Masukkan About" class="ckeditor1" rows="5" />
                                    </div>
                                </div>
                                <div class="card-footer bg-whitesmoke">
                                    <button type="submit" class="btn btn-primary btn-loading" data-loading-text="Memuat">Perbarui</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('styles')
@endpush

@push('scripts')
@endpush
