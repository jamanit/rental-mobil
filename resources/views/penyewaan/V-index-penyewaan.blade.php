@extends('layouts.app-dashboard')

@push('title')
    Penyewaan
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Penyewaan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Penyewaan</div>
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
                                <a href="{{ url('penyewaan/create') }}" class="btn btn-primary btn-sm">Pilih Mobil</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-serverside">
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th>Pelanggan</th>
                                                <th>Data Mobil</th>
                                                <th>Tanggal Penyewaan</th>
                                                <th>Status Penyewaan</th>
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

    @include('penyewaan.V-delete-penyewaan')
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
                ajax: "{{ route('penyewaan.index') }}",
                columns: [{
                    data: 'pelanggan',
                    name: 'pelanggan'
                }, {
                    data: 'data_mobil',
                    name: 'data_mobil'
                }, {
                    data: 'tgl_penyewaan',
                    name: 'tgl_penyewaan'
                }, {
                    data: 'status',
                    name: 'status'
                }, {
                    data: 'uuid',
                    class: 'width-1 text-nowrap',
                    "render": function(data, type, row) {

                        let button_access = '{{ Auth::user()->role->button_access }}';
                        let button_pembayaran = '';
                        let delete_button = '';

                        button_pembayaran =
                            `<a href="/penyewaan/${data}/edit" class="btn btn-primary btn-sm" title="Pembayaran">
                                    Pembayaran
                                </a>`

                        if (button_access == '1') {
                            delete_button =
                                `<a href="#" class="btn btn-danger btn-sm text-white" data-toggle="modal" data-target="#deleteModal" data-id="${data}" title="Hapus">
                                    <i class="fa fa-trash"></i>
                                </a>`;
                        }

                        return `
                                ${button_pembayaran}
                                ${delete_button}  
                            `;
                    }
                }, ]
            });

            $('#deleteModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var itemId = button.data('id');
                var form = $(this).find('#deleteForm');
                form.attr('action', '/penyewaan/' + itemId);
            });
        });
    </script>
@endpush
