<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MenuService;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Models\M_contact;

class C_contact extends Controller
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
            $contacts = M_contact::SELECT('*')->orderBy('id', 'desc');
            return DataTables::of($contacts)->make(true);
        } else {
            $menus = $this->menuService->getMenus($role_id);
        }

        return view('contact.V-index-contact', compact('menus'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'platform'        => 'required|string|max:255',
                'username_number' => 'required|string|max:255',
                'icon'            => 'required|string|max:255',
                'url'             => 'required|string',
            ]);

            $data = $request->all();
            M_contact::create($data);

            return redirect()->route('contacts.index')->with('success', 'Data berhasil ditambahkan.');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan data, harap periksa kembali.')->withErrors($e->validator)->withInput();
        }
    }

    public function edit(M_contact $contact)
    {
        return response()->json([
            'platform'        => $contact->platform,
            'username_number' => $contact->username_number,
            'icon'            => $contact->icon,
            'url'             => $contact->url,
        ]);
    }

    public function update(Request $request, M_contact $contact)
    {
        try {
            $request->validate([
                'platform'        => 'required|string|max:255',
                'username_number' => 'required|string|max:255',
                'icon'            => 'required|string|max:255',
                'url'             => 'required|string',
            ]);

            $data = $request->all();
            $contact->update($data);

            return redirect()->route('contacts.index')->with('success', 'Data berhasil diperbarui.');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'Data gagal diperbarui, harap periksa kembali.')->withErrors($e->validator)->withInput();
        }
    }

    public function show_contact_us()
    {
        $user_id = Auth::user()->id;
        $role_id = Auth::user()->role_id;

        $menus = $this->menuService->getMenus($role_id);

        $contacts = M_contact::all();

        return view('contact.V-show-contact-us', compact('menus', 'contacts'));
    }

    public function destroy(M_contact $contact)
    {
        try {
            $contact->delete();
            return redirect()->route('contacts.index')->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('contacts.index')->with('error', 'Data gagal dihapus.');
        }
    }
}
