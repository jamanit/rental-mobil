<?php

namespace App\Services;

use App\Models\M_menu_access;

class MenuService
{
    //     public function getMenus($role_id)
    //     {
    //         return M_menu_access::with(['menu_first.menu_seconds' => function ($query) use ($role_id) {
    //             $query->whereHas('menu_accesses', function ($subQuery) use ($role_id) {
    //                 $subQuery->where('role_id', $role_id);
    //             });
    //         }])
    //             ->where('role_id', $role_id)
    //             ->get()
    //             ->groupBy('first_menu_id')
    //             ->map(function ($group) {
    //                 return [
    //                     'id' => $group->first()->menu_first->id ?? null,
    //                     'link' => $group->first()->menu_first->first_menu_link ?? null,
    //                     'name' => $group->first()->menu_first->first_menu_name ?? null,
    //                     'icon' => $group->first()->menu_first->first_menu_icon ?? null,
    //                     'children' => $group->first()->menu_first->menu_seconds->map(function ($second_menu) {
    //                         return [
    //                             'link' => $second_menu->second_menu_link ?? null,
    //                             'name' => $second_menu->second_menu_name ?? null,
    //                             'icon' => $second_menu->second_menu_icon ?? null,
    //                         ];
    //                     })->toArray(),
    //                 ];
    //             })->values();
    //     }
    // }

    public function getMenus($role_id)
    {
        $menus = M_menu_access::with(['menu_first' => function ($query) use ($role_id) {
            $query->with(['menu_seconds' => function ($subQuery) use ($role_id) {
                $subQuery->whereHas('menu_accesses', function ($accessQuery) use ($role_id) {
                    $accessQuery->where('role_id', $role_id);
                });
            }]);
        }])
            ->where('role_id', $role_id)
            ->get();

        return $menus->groupBy('first_menu_id')
            ->map(function ($group) {
                $firstMenu = $group->first()->menu_first;

                $children = $firstMenu->menu_seconds->sortBy('id')->map(function ($second_menu) {
                    return [
                        'link' => $second_menu->second_menu_link ?? null,
                        'name' => $second_menu->second_menu_name ?? null,
                        'icon' => $second_menu->second_menu_icon ?? null,
                    ];
                })->toArray();

                return [
                    'id' => $firstMenu->id ?? null,
                    'link' => $firstMenu->first_menu_link ?? null,
                    'name' => $firstMenu->first_menu_name ?? null,
                    'icon' => $firstMenu->first_menu_icon ?? null,
                    'children' => $children,
                ];
            })->sortBy('id')->values();
    }
}
