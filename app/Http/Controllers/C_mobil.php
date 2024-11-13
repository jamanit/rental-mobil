<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MenuService;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;
use App\Models\M_mobil;

class C_mobil extends Controller
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
            $mobil = M_mobil::orderBy('id', 'desc');

            return DataTables::of($mobil)->make(true);
        } else {
            $menus = $this->menuService->getMenus($role_id);
        }

        return view('mobil.V-index-mobil', compact('menus'));
    }

    public function create()
    {
        $user_id = Auth::user()->id;
        $role_id = Auth::user()->role_id;

        $menus = $this->menuService->getMenus($role_id);

        $daftar_status = [
            'Tersedia' => 'Tersedia',
            'Disewa'   => 'Disewa',
        ];

        return view('mobil.V-create-mobil', compact('menus', 'daftar_status'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'no_polisi'    => 'required|string|max:255|unique:tb_mobils,no_polisi',
                'merk'         => 'required|string|max:255',
                'model'        => 'required|string|max:255',
                'tahun'        => 'required|string|max:255',
                'warna'        => 'required|string|max:255',
                'harga_harian' => 'required|string|max:255',
                'status'       => 'required|string|max:255',
                'foto_1'       => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
                'foto_2'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
                'foto_3'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
                'foto_4'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            ]);

            $data = $request->all();
            if ($request->hasFile('foto_1')) {
                $foto_1Path     = $request->file('foto_1')->store('mobil', 'public');
                $data['foto_1'] = $foto_1Path;
            }
            if ($request->hasFile('foto_2')) {
                $foto_2Path     = $request->file('foto_2')->store('mobil', 'public');
                $data['foto_2'] = $foto_2Path;
            }
            if ($request->hasFile('foto_3')) {
                $foto_3Path     = $request->file('foto_3')->store('mobil', 'public');
                $data['foto_3'] = $foto_3Path;
            }
            if ($request->hasFile('foto_4')) {
                $foto_4Path     = $request->file('foto_4')->store('mobil', 'public');
                $data['foto_4'] = $foto_4Path;
            }
            M_mobil::create($data);

            return redirect()->route('mobil.index')->with('success', 'Data berhasil ditambahkan.');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan data, harap periksa kembali.')->withErrors($e->validator)->withInput();
        }
    }

    public function edit(M_mobil $mobil)
    {
        $user_id = Auth::user()->id;
        $role_id = Auth::user()->role_id;

        $menus = $this->menuService->getMenus($role_id);

        $daftar_status = [
            'Tersedia' => 'Tersedia',
            'Disewa'   => 'Disewa',
        ];

        return view('mobil.V-edit-mobil', compact('menus', 'mobil', 'daftar_status'));
    }

    public function update(Request $request, M_mobil $mobil)
    {
        try {
            $request->validate([
                'no_polisi'    => 'required|string|max:255|unique:tb_mobils,no_polisi,' . $mobil->id,
                'merk'         => 'required|string|max:255',
                'model'        => 'required|string|max:255',
                'tahun'        => 'required|string|max:255',
                'warna'        => 'required|string|max:255',
                'harga_harian' => 'required|string|max:255',
                'status'       => 'required|string|max:255',
                'foto_1'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
                'foto_2'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
                'foto_3'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
                'foto_4'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            ]);

            $data = $request->all();
            if ($request->hasFile('foto_1')) {
                if ($mobil->foto_1) {
                    Storage::disk('public')->delete($mobil->foto_1);
                }
                $foto_1Path     = $request->file('foto_1')->store('mobil', 'public');
                $data['foto_1'] = $foto_1Path;
            }
            if ($request->hasFile('foto_2')) {
                if ($mobil->foto_2) {
                    Storage::disk('public')->delete($mobil->foto_2);
                }
                $foto_2Path     = $request->file('foto_2')->store('mobil', 'public');
                $data['foto_2'] = $foto_2Path;
            }
            if ($request->hasFile('foto_3')) {
                if ($mobil->foto_3) {
                    Storage::disk('public')->delete($mobil->foto_3);
                }
                $foto_3Path     = $request->file('foto_3')->store('mobil', 'public');
                $data['foto_3'] = $foto_3Path;
            }
            if ($request->hasFile('foto_4')) {
                if ($mobil->foto_4) {
                    Storage::disk('public')->delete($mobil->foto_4);
                }
                $foto_4Path     = $request->file('foto_4')->store('mobil', 'public');
                $data['foto_4'] = $foto_4Path;
            }

            $mobil->update($data);

            return redirect()->route('mobil.index')->with('success', 'Data berhasil diperbarui.');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'Data gagal diperbarui, harap periksa kembali.')->withErrors($e->validator)->withInput();
        }
    }

    public function destroy(M_mobil $mobil)
    {
        try {
            $mobil->delete();
            return redirect()->route('mobil.index')->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('mobil.index')->with('error', 'Data gagal dihapus.');
        }
    }
}
