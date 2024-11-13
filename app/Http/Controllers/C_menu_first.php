<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MenuService;
use Illuminate\Validation\ValidationException;
use App\Models\M_menu_first;

class C_menu_first extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'first_menu_name' => 'required|string|max:255',
                'first_menu_link' => 'required|string|max:255',
                'first_menu_icon' => 'required|string|max:255',
            ]);

            $data = $request->all();
            M_menu_first::create($data);

            return redirect()->route('menus.index')->with('success', 'Data added successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'Data added failed, please check again.')->withErrors($e->validator)->withInput();
        }
    }

    public function edit(M_menu_first $menu_first)
    {
        return response()->json([
            'first_menu_name' => $menu_first->first_menu_name,
            'first_menu_link' => $menu_first->first_menu_link,
            'first_menu_icon' => $menu_first->first_menu_icon,
        ]);
    }

    public function update(Request $request, M_menu_first $menu_first)
    {
        try {
            $request->validate([
                'first_menu_name' => 'required|string|max:255',
                'first_menu_link' => 'required|string|max:255',
                'first_menu_icon' => 'required|string|max:255',
            ]);

            $data = $request->all();
            $menu_first->update($data);

            return redirect()->route('menus.index')->with('success', 'Data updated successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'Data failed to update, please check again.')->withErrors($e->validator)->withInput();
        }
    }

    public function destroy(M_menu_first $menu_first)
    {
        try {
            $menu_first->delete();
            return redirect()->route('menus.index')->with('success', 'Data deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('menus.index')->with('error', 'Data failed to delete.');
        }
    }
}
