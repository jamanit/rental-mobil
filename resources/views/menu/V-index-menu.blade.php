@extends('layouts.app-dashboard')

@push('title')
    Menus
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Menus</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item">Menus</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-md-12">

                        @if (session('success') || session('error'))
                            <x-alert :type="session('success') ? 'success' : 'danger'" :message="session('success') ? session('success') : session('error')" />
                        @endif

                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#formModal-1">Add</a>
                                <h5 class="ml-auto">First Menu</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th>First Menu Name</th>
                                                <th>First Menu Link</th>
                                                <th>First Menu Icon</th>
                                                <th>Created At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i = 1; @endphp
                                            @foreach ($menu_firsts as $menu_first)
                                                <tr>
                                                    <td>{{ $menu_first->first_menu_name }}</td>
                                                    <td>{{ $menu_first->first_menu_link }}</td>
                                                    <td>{{ $menu_first->first_menu_icon }}</td>
                                                    <th>{{ date('Y-m-d H:i', strtotime($menu_first->created_at)) }}</th>
                                                    <td class="width-1 text-nowrap">
                                                        <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#formModal-1" data-id="{{ $menu_first->uuid }}" title="Edit">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-danger btn-sm text-white" data-toggle="modal" data-target="#deleteModal" data-id="{{ $menu_first->uuid }}" data-type="1" title="Delete">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header d-flex align-items-center">
                                <a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#formModal-2">Add</a>
                                <h5 class="ml-auto">Second Menu</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-2">
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th>First Menu Name</th>
                                                <th>Second Menu Name</th>
                                                <th>Second Menu Link</th>
                                                <th>Second Menu Icon</th>
                                                <th>Created At</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $i = 1; @endphp
                                            @foreach ($menu_seconds as $menu_second)
                                                <tr>
                                                    <td>{{ $menu_second->menu_first->first_menu_name }}</td>
                                                    <td>{{ $menu_second->second_menu_name }}</td>
                                                    <td>{{ $menu_second->second_menu_link }}</td>
                                                    <td>{{ $menu_second->second_menu_icon }}</td>
                                                    <th>{{ date('Y-m-d H:i', strtotime($menu_second->created_at)) }}</th>
                                                    <td class="width-1 text-nowrap">
                                                        <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#formModal-2" data-id="{{ $menu_second->uuid }}" title="Edit">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <a href="#" class="btn btn-danger btn-sm text-white" data-toggle="modal" data-target="#deleteModal" data-id="{{ $menu_second->uuid }}" data-type="2" title="Delete">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
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

    @include('menu.V-modal-menu')
@endsection

@push('styles')
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#deleteModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var itemId = button.data('id');
                var modaTitle = $('.modal-title');
                var form = $(this).find('#deleteForm');
                var itemType = button.data('type');

                if (itemType == 1) {
                    modaTitle.text('Delete First Menu');
                    form.attr('action', '/menu-firsts/' + itemId);
                } else {
                    modaTitle.text('Delete Second Menu');
                    form.attr('action', '/menu-seconds/' + itemId);
                }
            });

            $('#formModal-1').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var itemId = button.data('id');
                var modaTitle = $('.modal-title');
                var btnSubmit = $('.btn-submit');
                var form = $(this).find('#modalForm-1');

                if (typeof itemId === 'undefined') {
                    modaTitle.text('Add First Menu');
                    btnSubmit.text('Save');
                    form.attr('action', '/menu-firsts');
                    form.append('<input type="hidden" name="_method" value="POST">');

                    form.find('.modal-body input').val('');
                } else {
                    modaTitle.text('Edit First Menu');
                    btnSubmit.text('Update');
                    form.attr('action', '/menu-firsts/' + itemId);
                    form.append('<input type="hidden" name="_method" value="PUT">');

                    $.ajax({
                        url: '/menu-firsts/' + itemId + '/edit',
                        method: 'GET',
                        success: function(data) {
                            form.find('#first_menu_name').val(data.first_menu_name);
                            form.find('#first_menu_link').val(data.first_menu_link);
                            form.find('#first_menu_icon').val(data.first_menu_icon);
                        },
                        error: function(xhr) {
                            console.error("Error fetching data:", xhr);
                        }
                    });
                }
            });

            $('#formModal-2').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var itemId = button.data('id');
                var modaTitle = $('.modal-title');
                var btnSubmit = $('.btn-submit');
                var form = $(this).find('#modalForm-2');

                if (typeof itemId === 'undefined') {
                    modaTitle.text('Add Second Menu');
                    btnSubmit.text('Save');
                    form.attr('action', '/menu-seconds');
                    form.append('<input type="hidden" name="_method" value="POST">');

                    form.find('.modal-body input').val('');
                    form.find('.modal-body select').val('');
                } else {
                    modaTitle.text('Edit Second Menu');
                    btnSubmit.text('Update');
                    form.attr('action', '/menu-seconds/' + itemId);
                    form.append('<input type="hidden" name="_method" value="PUT">');

                    $.ajax({
                        url: '/menu-seconds/' + itemId + '/edit',
                        method: 'GET',
                        success: function(data) {
                            form.find('#first_menu_id').val(data.first_menu_id).change();
                            form.find('#second_menu_name').val(data.second_menu_name);
                            form.find('#second_menu_link').val(data.second_menu_link);
                            form.find('#second_menu_icon').val(data.second_menu_icon);
                        },
                        error: function(xhr) {
                            console.error("Error fetching data:", xhr);
                        }
                    });
                }
            });

        });
    </script>
@endpush
