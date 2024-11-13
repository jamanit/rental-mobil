@extends('layouts.app-dashboard')

@push('title')
    Pembayaran
@endpush

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Pembayaran</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{ url('dashboard') }}">Dashboard</a></div>
                    <div class="breadcrumb-item active"><a href="{{ url('penyewaan') }}">Penyewaan</a></div>
                    <div class="breadcrumb-item">Pembayaran</div>
                </div>
            </div>
            <div class="section-body">

                @if ($penyewaan->status == 'Pending')
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        Silahkan melakukan pembayaran dan mengirim bukti pembayaran.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if ($penyewaan->status == 'Proses')
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        Bukti pembayaran berhasil dikirim, mohon menunggu akan segera dicek oleh admin.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if ($penyewaan->status == 'Gagal')
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        Pembayaran gagal silahkan periksa kembali bukti pembayaran Anda.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        @if (session('success') || session('error'))
                            <x-alert :type="session('success') ? 'success' : 'danger'" :message="session('success') ? session('success') : session('error')" />
                        @endif

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <x-input type="text" label="Pelanggan" :value="'ID' . $penyewaan->pengguna->id . ' - ' . $penyewaan->pengguna->name" readonly />
                                </div>
                                <div class="mb-3">
                                    <x-input type="text" label="Merk" :value="$penyewaan->mobil->merk" readonly />
                                </div>
                                <div class="mb-3">
                                    <x-input type="text" label="Model" :value="$penyewaan->mobil->model" readonly />
                                </div>
                                <div class="mb-3">
                                    <x-input type="text" label="No. Polisi" :value="$penyewaan->mobil->no_polisi" readonly />
                                </div>
                                <div class="mb-3">
                                    <x-input type="text" label="Tahun" :value="$penyewaan->mobil->tahun" readonly />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <x-input type="text" label="Warna" :value="$penyewaan->mobil->warna" readonly />
                                </div>
                                <div class="mb-3">
                                    <x-input type="text" label="Harga Harian" :value="'Rp. ' . number_format($penyewaan->mobil->harga_harian)" readonly />
                                </div>
                                <div class="mb-3">
                                    <x-input type="text" label="Tanggal Penyewaan" :value="date('d-m-Y', strtotime($penyewaan->tgl_mulai)) . ' s/d ' . date('d-m-Y', strtotime($penyewaan->tgl_selesai))" readonly />
                                </div>
                                <div class="mb-3">
                                    <x-input type="text" label="Status Penyewaan" :value="$penyewaan->status" readonly />
                                </div>
                            </div>
                        </div>

                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <x-input type="text" name="kode_pembayaran" label="Kode Pembayaran" :value="$penyewaan->pembayaran->kode_pembayaran" readonly />
                                </div>
                                <div class="mb-3">
                                    <x-input type="text" name="tanggal_pembayaran" label="Tanggal Pembayaran" :value="date('d-m-Y H:i', strtotime($penyewaan->pembayaran->created_at))" readonly />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <x-input type="text" name="total_harga" label="Total Harga" :value="'Rp. ' . number_format($penyewaan->pembayaran->total_harga)" readonly />
                                </div>
                            </div>
                        </div>

                        @if ($penyewaan->status == 'Pending' || $penyewaan->status == 'Proses' || $penyewaan->status == 'Gagal')
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                Silahkan melakukan pembayaran sebesar <strong>Rp. {{ number_format($penyewaan->pembayaran->total_harga) }}</strong> transfer ke rekening dibawah ini dan kirim upload bukti pembayaran.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="formPembayaran" action="{{ route('penyewaan.update', $penyewaan->uuid) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-6">
                                        <ul class="list-group">
                                            @foreach ($metode_pembayaran as $item)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span>
                                                        {{ $item->nama_rekening . ' / ' . $item->nomor_rekening . ' / ' . $item->pemilik_rekening }}
                                                    </span>
                                                    <i class="fas fa-copy copy-icon" onclick="copyToClipboard('{{ $item->nomor_rekening }}')" title="Copy" style="cursor: pointer;"></i>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <x-input-file type="text" name="bukti_pembayaran" label="Bukti Pembayaran" :value="$penyewaan->pembayaran->bukti_pembayaran" readonliy />
                                            <div class="invalid-feedback font-weight-bold" role="alert">{{ $errors->first('bukti_pembayaran') }}</div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @else
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="">Bukti Pembayaran</label>
                                        <div>
                                            <a href="{{ Storage::url($penyewaan->pembayaran->bukti_pembayaran) }}" target="_blank" data-fancybox="gallery-2">
                                                <img src="{{ Storage::url($penyewaan->pembayaran->bukti_pembayaran) }}" alt="" class="img-thumbnail" style="height: 100px; object-fit: cover;">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                    <div class="card-footer bg-whitesmoke d-flex">
                        @if ($penyewaan->status == 'Pending' || $penyewaan->status == 'Proses' || $penyewaan->status == 'Gagal')
                            <button type="button" class="btn btn-primary btn-loading" data-loading-text="Memuat" id="btnPembayaran">Kirim</button>
                        @else
                            <a href="{{ url('/penyewaan/cetak-penyewaan', $penyewaan->uuid) }}" class="btn btn-secondary" target="_blank">Cetak</a>
                        @endif

                        @if (Auth::user()->role->button_access == 1)
                            <a href="#" class="btn btn-warning text-white ml-auto" data-toggle="modal" data-target="#statusPenyewaanModal">
                                Ubah Status Penyewaan
                            </a>
                        @endif
                    </div>
                </div>

            </div>
        </section>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="statusPenyewaanModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ubah Status Penyewaan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Pilih status penyewaan di bawah.</p>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <form action="{{ route('penyewaan.update_status', $penyewaan->uuid) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" id="status" value="Aktif">
                        <button type="submit" class="btn btn-success btn-loading" data-loading-text="Memuat">Aktif</button>
                    </form>

                    <form action="{{ route('penyewaan.update_status', $penyewaan->uuid) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" id="status" value="Gagal">
                        <button type="submit" class="btn btn-danger btn-loading" data-loading-text="Memuat">Gagal</button>
                    </form>

                    <form action="{{ route('penyewaan.update_status', $penyewaan->uuid) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="status" id="status" value="Selesai">
                        <button type="submit" class="btn btn-secondary btn-loading" data-loading-text="Memuat">Selesai</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
@endpush

@push('scripts')
    <script>
        $('#btnPembayaran').on('click', function() {
            $('#formPembayaran').submit();
        });
    </script>

    <script>
        function copyToClipboard(accountNumber) {
            const el = document.createElement('input');
            el.value = accountNumber;
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);

            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: 'Disalin',
                showConfirmButton: false,
                timer: 3000
            });
        }
    </script>
@endpush
