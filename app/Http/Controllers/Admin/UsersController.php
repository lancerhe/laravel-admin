<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Permission;
use App\Models\Admin\Role;
use App\Models\Admin\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $users = User::query()->paginate(30);
        return view('admin.users.index', compact('users'));
    }

    public function show($id) {
        $user = User::findOrFail($id);
        $permissions = Permission::all();
        return view('admin.users.show', compact('user', 'permissions'));
    }

    public function create() {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.users.create', compact('roles', 'permissions'));
    }

    public function edit($id) {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $permissions = Permission::all();
        return view('admin.users.edit', compact('user', 'roles', 'permissions'));
    }

    public function store(Request $request) {
        /** @var User $user */
        $roleIds = $request->post("role_ids");
        $permissionIds = $request->post("permission_ids");
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|unique:users,email|max:250',
            'password' => 'required|confirmed|min:6',
        ]);

        $user = new User();
        $user->name = $request->post('name');
        $user->email = $request->post('email');
        $user->password = bcrypt($request->post('password'));

        DB::transaction(function () use ($user, $roleIds, $permissionIds) {
            $user->save();
            $user->attachRoles($roleIds);
            $user->attachPermissions($permissionIds);
        });

        session()->flash('success', "用户添加成功，用户名: {$user->name}, 默认密码: {$request->post('password')}");
        return redirect()->route('admin.users.show', [$user]);
    }

    public function update(Request $request, $id) {
        /** @var User $user */
        $user = User::findOrFail($id);
        $roleIds = $request->post("role_ids"
        );
        $permissionIds = $request->post("permission_ids");
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|max:250|unique:users,email,' . $id,
            'password' => 'nullable|confirmed|min:6',
        ]);

        $user->name = $request->post('name');
        $user->email = $request->post('email');
        if ($request->post('password')) {
            $user->password = bcrypt($request->post('password'));
        }
        DB::transaction(function () use ($user, $roleIds, $permissionIds) {
            $user->save();
            $user->detachRoles($user->roles()->pluck('id')->toArray());
            $user->attachRoles($roleIds);
            $user->detachPermissions($user->permissions()->pluck('id')->toArray());
            $user->attachPermissions($permissionIds);
        });

        session()->flash('success', "用户[{$user->name}]更新成功");
        return redirect()->route('admin.users.show', [$user]);
    }
}
