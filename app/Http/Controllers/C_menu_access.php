<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MenuService;
use Illuminate\Support\Facades\Auth;
use App\Models\M_menu_access;

class C_menu_access extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function show(string $uuid)
    {
        $role_id = Auth::user()->role_id;

        $menus = $this->menuService->getMenus($role_id);
        $role_list = M_menu_access::level($uuid);
        $menu_list = M_menu_access::menus();

        return view('menu-access.V-show-menu-access', compact('menus', 'role_list', 'menu_list'));
    }

    public function store(Request $request)
    {
        M_menu_access::where('role_id', $request->role_id)->delete();

        if ($request->has('id_menu') && is_array($request->id_menu)) {
            foreach ($request->id_menu as $menu) {
                list($role_id, $first_menu_id, $second_menu_id) = explode(',', $menu);

                $role_id  = $role_id ? $role_id : null;
                $first_menu_id  = $first_menu_id ? $first_menu_id : null;
                $second_menu_id = $second_menu_id ? $second_menu_id : null;

                M_menu_access::create([
                    'role_id'      => $role_id,
                    'first_menu_id'  => $first_menu_id,
                    'second_menu_id' => $second_menu_id
                ]);
            }
        }

        return redirect()->route('roles.index')->with('success', 'Data saved successfully.');
    }
}
