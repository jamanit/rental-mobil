<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MenuService;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\M_setting;

class C_setting extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function edit(M_setting $setting)
    {
        $user_id = Auth::user()->id;
        $role_id = Auth::user()->role_id;

        $menus = $this->menuService->getMenus($role_id);

        return view('setting.V-edit-setting', compact('menus', 'setting'));
    }

    public function update(Request $request, M_setting $setting)
    {
        try {
            $request->validate([
                'home_cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
                'home_cover_text'  => 'required|string|max:255',
            ]);

            $data = $request->all();
            if ($request->hasFile('home_cover_image')) {
                if ($setting->home_cover_image) {
                    Storage::disk('public')->delete($setting->home_cover_image);
                }

                $home_cover_imagePath     = $request->file('home_cover_image')->store('image', 'public');
                $data['home_cover_image'] = $home_cover_imagePath;
            }
            $setting->update($data);

            return redirect()->route('settings.edit', $setting->uuid)->with('success', 'Data berhasil diperbarui.');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'Data gagal diperbarui, harap periksa kembali.')->withErrors($e->validator)->withInput();
        }
    }
}
