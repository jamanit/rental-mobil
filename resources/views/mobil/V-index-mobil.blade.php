    @extends('layouts.app-dashboard')

    @push('title')
        Mobil
    @endpush

    @section('content')
        <div class="main-content">
            <section class="section">
                <div class="section-header">
                    <h1>Mobil</h1>
                    <div class="section-header-breadcrumb">
                        <div class="breadcrumb-item active"><a href="{{ url('dashboard') }}">Dashboard</a></div>
                        <div class="breadcrumb-item">Mobil</div>
                    </div>
                </div>
                <div class="section-body">
                    <div class="row">
                        <div class="col-md-12">

                            @if (session('success') || session('error'))
                                <x-alert :type="session('success') ? 'success' : 'danger'" :message="session('success') ? session('success') : session('error')" />
                            @endif

                            <div class="card">
                                <div class="card-header">
                                    <a href="{{ route('mobil.create') }}" class="btn btn-primary btn-sm">Tambah</a>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-serverside">
                                            <thead>
                                                <tr class="text-nowrap">
                                                    <th>No. Polisi</th>
                                                    <th>Merk</th>
                                                    <th>Model</th>
                                                    <th>Tahun</th>
                                                    <th>Warna</th>
                                                    <th>Harga Harian</th>
                                                    <th>Status</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>

        @include('mobil.V-delete-mobil')
    @endsection

    @push('styles')
    @endpush

    @push('scripts')
        <script>
            $(document).ready(function() {
                $("#table-serverside").DataTable({
                    processing: true,
                    serverSide: true,
                    order: [],
                    ajax: "{{ route('mobil.index') }}",
                    columns: [{
                        data: 'no_polisi',
                        name: 'no_polisi',
                    }, {
                        data: 'merk',
                        name: 'merk',
                    }, {
                        data: 'model',
                        name: 'model',
                    }, {
                        data: 'tahun',
                        name: 'tahun',
                    }, {
                        data: 'warna',
                        name: 'warna',
                    }, {
                        data: 'harga_harian',
                        name: 'harga_harian',
                    }, {
                        data: 'status',
                        name: 'status',
                    }, {
                        data: 'uuid',
                        class: 'width-1 text-nowrap',
                        "render": function(data, type, row) {
                            return ` 
                                <a href="/mobil/${data}/edit" class="btn btn-warning btn-sm" title="Ubah">
                                    <i class="fa fa-pencil"></i>
                                </a>
                                <a href="#" class="btn btn-danger btn-sm text-white" data-toggle="modal" data-target="#deleteModal" data-id="${data}" title="Hapus">
                                    <i class="fa fa-trash"></i>
                                </a>
                            `;
                        }
                    }, ]
                });

                $('#deleteModal').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget);
                    var itemId = button.data('id');
                    var form = $(this).find('#deleteForm');
                    form.attr('action', '/mobil/' + itemId);
                });
            });
        </script>
    @endpush
