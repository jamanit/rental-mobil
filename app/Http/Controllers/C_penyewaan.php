<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MenuService;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Models\M_penyewaan;
use App\Models\M_mobil;
use App\Models\M_pembayaran;
use App\Models\M_metode_pembayaran;

class C_penyewaan extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function index(Request $request)
    {
        $user_id = Auth::user()->id;
        $role_id = Auth::user()->role_id;

        if ($request->ajax()) {
            $penyewaan = M_penyewaan::with('pengguna', 'mobil')
                ->orderBy('id', 'desc');

            if ($role_id == 3) {
                $penyewaan->where('id_pelanggan', $user_id);
            }

            $penyewaan = $penyewaan->get();

            return DataTables::of($penyewaan)
                ->addColumn('pelanggan', function ($row) {
                    return $row->pengguna ? 'ID' . $row->pengguna->id . ' - ' . $row->pengguna->name : 'N/A';
                })
                ->addColumn('tgl_penyewaan', function ($row) {
                    return $row ? ($row->tgl_mulai . ' s/d ' . $row->tgl_selesai) : 'N/A';
                })
                ->addColumn('data_mobil', function ($row) {
                    return $row->mobil ? ($row->mobil->merk . '-' . $row->mobil->model . '-' . $row->mobil->no_polisi) : 'N/A';
                })
                ->make(true);
        } else {
            $menus         = $this->menuService->getMenus($role_id);
            $mobil         = M_mobil::orderBy('id', 'desc')->get();
        }

        return view('penyewaan.V-index-penyewaan', compact('menus', 'mobil'));
    }

    public function create()
    {
        $user_id = Auth::user()->id;
        $role_id = Auth::user()->role_id;

        $menus = $this->menuService->getMenus($role_id);
        $mobil = M_mobil::orderBy('id', 'desc')->paginate(6);

        return view('penyewaan.V-create-penyewaan', compact('menus', 'mobil'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_mobil'    => 'required|string',
                'tgl_mulai'   => 'required|date',
                'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            ], [
                'tgl_selesai.after_or_equal' => 'Tanggal selesai tidak boleh lebih kecil dari tanggal mulai.',
            ]);

            $mobil = M_mobil::find($request->id_mobil);

            if ($mobil->status != 'Tersedia') {
                return redirect()->back()->with('error', 'Mobil sudah tidak tersedia untuk disewa.');
            }

            $data                = $request->all();
            $data['status']      = 'Pending';
            $data['id_pelanggan'] = Auth::user()->id;
            $penyewaan           = M_penyewaan::create($data);

            $mobil       = M_mobil::find($request->id_mobil);
            $tgl_mulai   = \Carbon\Carbon::parse($request->tgl_mulai);
            $tgl_selesai = \Carbon\Carbon::parse($request->tgl_selesai);
            $total_hari  = $tgl_mulai->diffInDays($tgl_selesai) + 1;
            $total_harga = $mobil->harga_harian * $total_hari;

            $data2 = [
                'id_penyewaan'    => $penyewaan->id,
                'kode_pembayaran' => 'KD-' . rand(0000, 9999),
                'total_harga'     => $total_harga,
            ];
            M_pembayaran::create($data2);

            return redirect()->route('penyewaan.index')->with('success', 'Data berhasil ditambahkan.');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'Gagal memilih data, harap periksa kembali.')->withErrors($e->validator)->withInput();
        }
    }

    public function edit(M_penyewaan $penyewaan)
    {
        $user_id = Auth::user()->id;
        $role_id = Auth::user()->role_id;

        $menus = $this->menuService->getMenus($role_id);

        $penyewaan->load('pengguna', 'mobil', 'pembayaran');
        $metode_pembayaran = M_metode_pembayaran::orderBy('id', 'desc')->get();

        return view('penyewaan.V-edit-penyewaan', compact('menus', 'penyewaan', 'metode_pembayaran'));
    }

    public function update(Request $request, M_penyewaan $penyewaan)
    {
        try {
            $rules = [
                'bukti_pembayaran' => $penyewaan->pembayaran && $penyewaan->pembayaran->bukti_pembayaran
                    ? 'nullable|image|mimes:jpeg,png,jpg,gif|max:5024'
                    : 'required|image|mimes:jpeg,png,jpg,gif|max:5024',
            ];

            $request->validate($rules);

            if ($request->hasFile('bukti_pembayaran')) {
                if ($penyewaan->pembayaran && $penyewaan->pembayaran->bukti_pembayaran) {
                    Storage::disk('public')->delete($penyewaan->pembayaran->bukti_pembayaran);
                }
                $filePath = $request->file('bukti_pembayaran')->store('pembayaran', 'public');
            }

            if (isset($filePath)) {
                if ($penyewaan->pembayaran) {
                    $penyewaan->pembayaran->update([
                        'bukti_pembayaran' => $filePath,
                    ]);
                }
            }

            $penyewaan->update([
                'status' => 'Proses',
            ]);

            return redirect()->route('penyewaan.index')->with('success', 'Bukti pembayaran berhasil dikirim, mohon menunggu akan segera dicek oleh admin.');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'Gagal memilih data, harap periksa kembali.')->withErrors($e->validator)->withInput();
        }
    }

    public function update_status(Request $request, string $uuid_penyewaan)
    {
        try {
            $penyewaan = M_penyewaan::where('uuid', $uuid_penyewaan)->first();
            $penyewaan->update([
                'status' => $request->status,
            ]);

            return redirect()->route('penyewaan.index')->with('success', 'Data berhasil diperbarui.');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'Gagal memilih data, harap periksa kembali.')->withErrors($e->validator)->withInput();
        }
    }

    public function cetak_penyewaan(string $uuid_penyewaan)
    {
        $user_id = Auth::user()->id;
        $role_id = Auth::user()->role_id;

        $menus = $this->menuService->getMenus($role_id);

        $penyewaan = M_penyewaan::with('pengguna', 'mobil', 'pembayaran')->where('uuid', $uuid_penyewaan)->first();
        $penyewaan->load('pengguna', 'mobil', 'pembayaran');
        $metode_pembayaran = M_metode_pembayaran::orderBy('id', 'desc')->get();

        return view('penyewaan.V-cetak-penyewaan', compact('menus', 'penyewaan', 'metode_pembayaran'));
    }

    public function destroy(M_penyewaan $penyewaan)
    {
        try {
            if ($penyewaan->pembayaran) {
                $penyewaan->pembayaran->delete();
            }

            $penyewaan->delete();
            return redirect()->route('penyewaan.index')->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('penyewaan.index')->with('error', 'Data gagal dihapus.');
        }
    }
}
