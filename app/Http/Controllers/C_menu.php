<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\MenuService;
use App\Models\M_menu_first;
use App\Models\M_menu_second;

class C_menu extends Controller
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

        $menus = $this->menuService->getMenus($role_id);
        $menu_firsts     = M_menu_first::orderBy('id', 'DESC')->get();
        $menu_seconds    = M_menu_second::with('menu_first')->orderBy('id', 'DESC')->get();
        $menu_first_list = M_menu_first::orderBy('first_menu_name', 'ASC')->get()
            ->mapWithKeys(function ($item) {
                return [$item->id => $item->first_menu_name];
            })->toArray();

        return view('menu.V-index-menu', compact('menus', 'menu_firsts', 'menu_seconds', 'menu_first_list'));
    }
}
