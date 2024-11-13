@extends('layouts.app-dashboard')

@push('title')
    Ubah Pengguna
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Ubah Pengguna</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item active"><a href="{{ url('users') }}">Pengguna</a></div>
                    <div class="breadcrumb-item">Ubah Pengguna</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">

                        <form action="{{ route('users.update', $user->uuid) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <x-input type="text" name="name" label="Nama" :value="$user->name" placeholder="Masukkan Nama" />
                                            </div>
                                            <div class="mb-3">
                                                <x-input type="email" name="email" label="Email" :value="$user->email" placeholder="Masukkan Email" />
                                            </div>
                                            <div class="mb-3">
                                                <x-input type="text" name="no_hp" label="No.HP" :value="$user->no_hp" placeholder="Masukkan No.HP" />
                                            </div>
                                            <div class="mb-3">
                                                <x-input type="text" name="address" label="Alamat" :value="$user->address" placeholder="Masukkan Alamat" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <x-input type="password" name="password" label="Password" placeholder="Enter Password" class="pwstrength" data-indicator="pwindicator" autocomplete="new-password" />
                                            </div>
                                            <div class="mb-3">
                                                <x-input type="password" name="password_confirmation" label="Konfirmasi Password" placeholder="Konfirmasi Password" autocomplete="new-password" />
                                            </div>
                                            <div class="mb-3">
                                                <x-select name="role_id" label="Nama Peran" :options="$roles" :selected="$user->role_id" />
                                            </div>
                                        </div>
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
