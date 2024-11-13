<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MenuService;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use App\Models\User;
use App\Models\M_role;

class C_user extends Controller
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
            $users = User::with('role')->select('*')->orderBy('id', 'desc');

            return DataTables::of($users)
                ->addColumn('role_name', function ($user) {
                    return $user->role ? $user->role->role_name : 'N/A';
                })->make(true);
        } else {
            $menus = $this->menuService->getMenus($role_id);
        }

        return view('user.V-index-user', compact('menus'));
    }

    public function create()
    {
        $user_id = Auth::user()->id;
        $role_id = Auth::user()->role_id;

        $menus = $this->menuService->getMenus($role_id);
        $roles = M_role::orderBy('role_name', 'ASC')->get()
            ->mapWithKeys(function ($item) {
                return [$item->id => $item->role_name];
            })->toArray();

        $status = [
            'active'   => 'active',
            'inactive' => 'inactive',
        ];

        return view('user.V-create-user', compact('menus', 'roles', 'status'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|unique:users',
                'no_hp'    => 'required|string|max:255',
                'address'  => 'required|string|max:255',
                'password' => 'required|string|min:8|confirmed',
                'role_id'  => 'required|int',
            ]);

            $data = $request->all();
            if ($request->filled('password')) {
                $data['password'] = bcrypt($data['password']);
            } else {
                unset($data['password']);
            }
            User::create($data);

            return redirect()->route('users.index')->with('success', 'Data berhasil ditambahkan.');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'Gagal menambahkan data, harap periksa kembali.')->withErrors($e->validator)->withInput();
        }
    }

    public function edit(User $user)
    {
        $user_id = Auth::user()->id;
        $role_id = Auth::user()->role_id;

        $menus = $this->menuService->getMenus($role_id);
        $roles = M_role::orderBy('role_name', 'ASC')->get()
            ->mapWithKeys(function ($item) {
                return [$item->id => $item->role_name];
            })->toArray();

        $status = [
            'active'   => 'active',
            'inactive' => 'inactive',
        ];

        return view('user.V-edit-user', compact('menus', 'user', 'roles', 'status'));
    }

    public function update(Request $request, User $user)
    {
        try {
            $request->validate([
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|unique:users,email,' . $user->id,
                'no_hp'    => 'required|string|max:255',
                'address'  => 'required|string|max:255',
                'password' => 'nullable|string|min:8|confirmed',
                'role_id'  => 'required|int',
            ]);

            $data = $request->all();
            if ($request->filled('password')) {
                $data['password'] = bcrypt($data['password']);
            } else {
                unset($data['password']);
            }
            $user->update($data);

            return redirect()->route('users.index')->with('success', 'Data berhasil diperbarui.');
        } catch (ValidationException $e) {
            return redirect()->back()->with('error', 'Data gagal diperbarui, harap periksa kembali.')->withErrors($e->validator)->withInput();
        }
    }

    public function destroy(User $user)
    {
        try {
            $user->delete();
            return redirect()->route('users.index')->with('success', 'Data berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Data gagal dihapus.');
        }
    }
}
