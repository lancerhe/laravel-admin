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
        $users = User::query()->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function show($id) {
        $user        = User::findOrFail($id);
        $permissions = Permission::all();
        return view('admin.users.show', compact('user', 'permissions'));
    }

    public function edit($id) {
        $user        = User::findOrFail($id);
        $roles       = Role::all();
        $permissions = Permission::all();
        return view('admin.users.edit', compact('user', 'roles', 'permissions'));
    }

    public function update(Request $request, $id) {
        /** @var User $user */
        $user          = User::findOrFail($id);
        $roleIds       = $request->post("role_ids");
        $permissionIds = $request->post("permission_ids");
        $this->validate($request, [
            'name'     => 'required|max:50',
            'email'    => 'required|max:250',
            'password' => 'nullable|confirmed|min:6',
        ]);

        $user->name  = $request->post('name');
        $user->email = $request->post('email');
        if ( $request->post('password') ) {
            $user->password = bcrypt($request->post('password'));
        }
        DB::transaction(function () use ($user, $roleIds, $permissionIds) {
            $user->save();
            $user->detachRoles($user->roles()->pluck('id')->toArray());
            $user->attachRoles($roleIds);
            $user->detachPermissions($user->permissions()->pluck('id')->toArray());
            $user->attachPermissions($permissionIds);
        });

        session()->flash('success', 'User update success.');
        return redirect()->route('admin.users.show', [$user]);
    }
}
