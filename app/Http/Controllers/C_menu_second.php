<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MenuService;
use Illuminate\Validation\ValidationException;
use App\Models\M_menu_second;

class C_menu_second extends Controller
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
                'first_menu_id'    => 'required|int',
                'second_menu_name' => 'required|string|max:255',
                'second_menu_link' => 'required|string|max:255',
            ]);

            $data = $request->all();
            M_menu_second::create($data);

            return redirect()->route('menus.index')->with('success', 'Data added successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'Data added failed, please check again.')->withErrors($e->validator)->withInput();
        }
    }

    public function edit(M_menu_second $menu_second)
    {
        return response()->json([
            'first_menu_id'    => $menu_second->first_menu_id,
            'second_menu_name' => $menu_second->second_menu_name,
            'second_menu_link' => $menu_second->second_menu_link,
            'second_menu_icon' => $menu_second->second_menu_icon,
        ]);
    }

    public function update(Request $request, M_menu_second $menu_second)
    {
        try {
            $request->validate([
                'first_menu_id'    => 'required|int',
                'second_menu_name' => 'required|string|max:255',
                'second_menu_link' => 'required|string|max:255',
            ]);

            $data = $request->all();
            $menu_second->update($data);

            return redirect()->route('menus.index')->with('success', 'Data updated successfully.');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'Data failed to update, please check again.')->withErrors($e->validator)->withInput();
        }
    }

    public function destroy(M_menu_second $menu_second)
    {
        try {
            $menu_second->delete();
            return redirect()->route('menus.index')->with('success', 'Data deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('menus.index')->with('error', 'Data failed to delete.');
        }
    }
}
