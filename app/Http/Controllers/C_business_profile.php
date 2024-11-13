<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MenuService;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\M_business_profile;

class C_business_profile extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function edit(M_business_profile $business_profile)
    {
        $user_id = Auth::user()->id;
        $role_id = Auth::user()->role_id;

        $menus = $this->menuService->getMenus($role_id);

        return view('business-profile.V-edit-business-profile', compact('menus', 'business_profile'));
    }

    public function update(Request $request, M_business_profile $business_profile)
    {
        try {
            $request->validate([
                'logo'                   => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
                'brand_name'             => 'required|string|max:255',
                'brand_founding_date'    => 'required|string',
                'address'                => 'required|string|max:255',
                'google_maps'            => 'required|string',
                'about'                  => 'required|string',
                'brand_email'            => 'required|string|max:255',
                'brand_website'          => 'required|string|max:255',
            ]);

            $data = $request->all();
            if ($request->hasFile('logo')) {
                if ($business_profile->logo) {
                    Storage::disk('public')->delete($business_profile->logo);
                }

                $filePath     = $request->file('logo')->store('image', 'public');
                $data['logo'] = $filePath;
            }
            $business_profile->update($data);

            return redirect()->route('business-profiles.edit', $business_profile->uuid)->with('success', 'Data berhasil diperbarui.');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'Data gagal diperbarui, harap periksa kembali.')->withErrors($e->validator)->withInput();
        }
    }
}
