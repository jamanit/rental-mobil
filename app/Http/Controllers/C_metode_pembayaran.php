<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MenuService;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Models\M_metode_pembayaran;

class C_metode_pembayaran extends Controller
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
            $metode_pembayaran = M_metode_pembayaran::SELECT('*')->orderBy('id', 'desc');
            return DataTables::of($metode_pembayaran)->make(true);
        } else {
            $menus = $this->menuService->getMenus($role_id);
        }

        return view('metode-pembayaran.V-index-metode-pembayaran', compact('menus'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_rekening'    => 'required|string|max:255',
                'nomor_rekening'   => 'required|string|max:255',
                'pemilik_rekening' => 'required|string|max:255',
            ]);

            $data = $request->all();
            M_metode_pembayaran::create($data);

            return redirect()->route('metode-pembayaran.index')->with('success', 'Data berhasil ditambahkan.');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan data, harap periksa kembali.')->withErrors($e->validator)->withInput();
        }
    }

    public function edit(M_metode_pembayaran $metode_pembayaran)
    {
        return response()->json([
            'nama_rekening'    => $metode_pembayaran->nama_rekening,
            'nomor_rekening'   => $metode_pembayaran->nomor_rekening,
            'pemilik_rekening' => $metode_pembayaran->pemilik_rekening,
        ]);
    }

    public function update(Request $request, M_metode_pembayaran $metode_pembayaran)
    {
        try {
            $request->validate([
                'nama_rekening'    => 'required|string|max:255',
                'nomor_rekening'   => 'required|string|max:255',
                'pemilik_rekening' => 'required|string|max:255',
            ]);

            $data = $request->all();
            $metode_pembayaran->update($data);

            return redirect()->route('metode-pembayaran.index')->with('success', 'Data berhasil diperbarui.');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'Data gagal diperbarui, harap periksa kembali.')->withErrors($e->validator)->withInput();
        }
    }

    public function destroy(M_metode_pembayaran $metode_pembayaran)
    {
        try {
            $metode_pembayaran->delete();
            return redirect()->route('metode-pembayaran.index')->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('metode-pembayaran.index')->with('error', 'Data gagal dihapus.');
        }
    }
}
