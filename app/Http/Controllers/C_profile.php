<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MenuService;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class C_profile extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function index()
    {
        $role_id = Auth::user()->role_id;
        $id      = Auth::user()->id;

        $menus   = $this->menuService->getMenus($role_id);
        $profile = User::find($id);

        return view('profile.V-index-profile', compact('menus', 'profile'));
    }

    public function update(Request $request, User $profile)
    {
        try {
            $request->validate([
                'name'    => 'required|string|max:255',
                'email'   => 'required|string|max:255',
                'no_hp'   => 'required|string|max:255',
                'address' => 'required|string|max:255',
            ]);

            $data = $request->all();
            $profile->update($data);

            return redirect()->route('profiles.index')->with('success', 'Data updated successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'Data failed to update, please check again.')->withErrors($e->validator)->withInput();
        }
    }
}
