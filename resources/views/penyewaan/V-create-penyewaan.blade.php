@extends('layouts.app-dashboard')

@push('title')
    Pilih Mobil
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pilih Mobil</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item active"><a href="{{ url('penyewaan') }}">Penyewaan</a></div>
                    <div class="breadcrumb-item">Pilih Mobil</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @if (session('success') || session('error'))
                            <x-alert :type="session('success') ? 'success' : 'danger'" :message="session('success') ? session('success') : session('error')" />
                        @endif

                        <div class="row">
                            @foreach ($mobil as $item)
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body p-1">
                                            <div id="carouselExampleFade{{ $item->id }}" class="carousel slide carousel-fade" data-ride="carousel">
                                                <div class="carousel-inner">
                                                    @if ($item->foto_1)
                                                        <div class="carousel-item active">
                                                            <img class="d-block w-100" src="{{ Storage::url($item->foto_1) }}" alt="Slide 1">
                                                        </div>
                                                    @endif
                                                    @if ($item->foto_2)
                                                        <div class="carousel-item">
                                                            <img class="d-block w-100" src="{{ Storage::url($item->foto_2) }}" alt="Slide 2">
                                                        </div>
                                                    @endif
                                                    @if ($item->foto_3)
                                                        <div class="carousel-item">
                                                            <img class="d-block w-100" src="{{ Storage::url($item->foto_3) }}" alt="Slide 3">
                                                        </div>
                                                    @endif
                                                    @if ($item->foto_4)
                                                        <div class="carousel-item">
                                                            <img class="d-block w-100" src="{{ Storage::url($item->foto_4) }}" alt="Slide 4">
                                                        </div>
                                                    @endif

                                                    @if (($item->foto_1 != '' && $item->foto_2 != '') || $item->foto_3 != '' || $item->foto_4 != '')
                                                        <a class="carousel-control-prev" href="#carouselExampleFade{{ $item->id }}" role="button" data-slide="prev">
                                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                        <a class="carousel-control-next" href="#carouselExampleFade{{ $item->id }}" role="button" data-slide="next">
                                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                            <span class="sr-only">Next</span>
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="table table-bordered custom-table">
                                                    <tr class="text-nowrap">
                                                        <th style="width: 1%">Merk</th>
                                                        <td>{{ $item->merk }}</td>
                                                    </tr>
                                                    <tr class="text-nowrap">
                                                        <th style="width: 1%">Model</th>
                                                        <td>{{ $item->model }}</td>
                                                    </tr>
                                                    <tr class="text-nowrap">
                                                        <th style="width: 1%">No. Polisi</th>
                                                        <td>{{ $item->no_polisi }}</td>
                                                    </tr>
                                                    <tr class="text-nowrap">
                                                        <th style="width: 1%">Tahun</th>
                                                        <td>{{ $item->tahun }}</td>
                                                    </tr>
                                                    <tr class="text-nowrap">
                                                        <th style="width: 1%">Warna</th>
                                                        <td>{{ $item->warna }}</td>
                                                    </tr>
                                                    <tr class="text-nowrap">
                                                        <th style="width: 1%">Harga Harian</th>
                                                        <td>Rp. {{ number_format($item->harga_harian) }}</td>
                                                    </tr>
                                                    <tr class="text-nowrap">
                                                        <th style="width: 1%">Status</th>
                                                        <td>{{ $item->status }}</td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="card-footer bg-whitesmoke">
                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#selectModal" data-id_mobil="{{ $item->id }}">Pilih</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="d-flex justify-content-center">
                            {{ $mobil->links('pagination::bootstrap-4') }}
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="selectModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pilih Mobil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="selectForm" method="POST" action="">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id_mobil" id="id_mobil">
                        <div class="row">
                            <div class="col-md-6">
                                <x-input type="date" name="tgl_mulai" label="Tanggal Mulai" placeholder="Masukkan Tanggal Mulai" />
                            </div>
                            <div class="col-md-6">
                                <x-input type="date" name="tgl_selesai" label="Tanggal Selesai" placeholder="Masukkan Tanggal Selesai" />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="submit" class="btn btn-primary btn-loading" data-loading-text="Memuat">Lanjut</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .carousel-inner {
            background-color: gray;
            height: 350px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .carousel-img {
            object-fit: contain;
            height: 100%;
            width: 100%;
        }

        .custom-table,
        .custom-table td,
        .custom-table th {
            border-width: 2px;
            border-color: #000;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $('#selectModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var itemId = button.data('id_mobil');
            $('#id_mobil').val(itemId);

            var form = $(this).find('#selectForm');
            form.attr('action', "{{ route('penyewaan.store') }}");
        });
    </script>
@endpush
