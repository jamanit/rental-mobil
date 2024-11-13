@extends('layouts.app-dashboard')

@push('title')
    Profile
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Profile</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Profile</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">

                        @if (session('success') || session('error'))
                            <x-alert :type="session('success') ? 'success' : 'danger'" :message="session('success') ? session('success') : session('error')" />
                        @endif

                        <form action="{{ route('profiles.update', $profile->uuid) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <x-input type="email" name="email" label="Email" :value="$profile->email" placeholder="Masukkan Email" readonly />
                                            </div>
                                            <div class="mb-3">
                                                <x-input type="text" name="name" label="Nama" :value="$profile->name" placeholder="Masukkan Nama" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <x-input type="text" name="no_hp" label="No. HP" :value="$profile->no_hp" placeholder="Masukkan No. HP" />
                                            </div>
                                            <div class="mb-3">
                                                <x-input type="text" name="address" label="Alamat" :value="$profile->address" placeholder="Masukkan Alamat" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-whitesmoke">
                                    <button type="submit" class="btn btn-primary btn-loading" data-loading-text="Loading">Update</button>
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
