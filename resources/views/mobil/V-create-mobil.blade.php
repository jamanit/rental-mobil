@extends('layouts.app-dashboard')

@push('title')
    Tambah Mobil
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Mobil</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item active"><a href="{{ url('mobil') }}">Mobil</a></div>
                    <div class="breadcrumb-item">Tambah Mobil</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">

                        <form action="{{ route('mobil.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <x-input-file type="file" name="foto_1" label="Foto 1" />
                                            </div>
                                            <div class="mb-3">
                                                <x-input-file type="file" name="foto_2" label="Foto 2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <x-input-file type="file" name="foto_3" label="Foto 3" />
                                            </div>
                                            <div class="mb-3">
                                                <x-input-file type="file" name="foto_4" label="Foto 4" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <x-input type="text" name="no_polisi" label="Nomor Polisi" placeholder="Masukkan Nomor Polisi" />
                                            </div>
                                            <div class="mb-3">
                                                <x-input type="text" name="merk" label="Merk" placeholder="Masukkan Merk" />
                                            </div>
                                            <div class="mb-3">
                                                <x-input type="text" name="model" label="Model" placeholder="Masukkan Model" />
                                            </div>
                                            <div class="mb-3">
                                                <x-input type="number" name="tahun" label="Tahun" placeholder="Masukkan Tahun" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <x-input type="text" name="warna" label="Warna" placeholder="Masukkan Warna" />
                                            </div>
                                            <div class="mb-3">
                                                <x-input type="number" name="harga_harian" label="Harga Harian" placeholder="Masukkan Harga Harian" />
                                            </div>
                                            <div class="mb-3">
                                                <x-select name="status" label="Status" :options="$daftar_status" :selected="'Tersedia'" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer bg-whitesmoke">
                                    <button type="submit" class="btn btn-primary btn-loading" data-loading-text="Memuat">Simpan</button>
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
