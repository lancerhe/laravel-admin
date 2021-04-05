<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Permission;
use App\Models\Admin\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $roles = Role::query()->paginate(15);
        return view('admin.roles.index', compact('roles'));
    }

    public function create() {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
    }

    public function store(Request $request) {
        $permissionIds = $request->post("permission_ids");
        $this->validate($request, [
            'name' => 'required|max:50|unique:roles,name',
            'slug' => 'required|max:50',
        ]);

        $role       = new Role();
        $role->name = $request->post('name');
        $role->slug = $request->post('slug');

        DB::transaction(function () use ($role, $permissionIds) {
            $role->save();
            $role->attachPermissions($permissionIds);
        });

        session()->flash('success', 'Role create success.');
        return redirect()->route('admin.roles.show', [$role]);
    }

    public function show($id) {
        $role        = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('admin.roles.show', compact('role', 'permissions'));
    }

    public function edit($id) {
        $role        = Role::findOrFail($id);
        $permissions = Permission::all();
        return view('admin.roles.edit', compact('role', 'permissions'));
    }

    public function update(Request $request, $id) {
        /** @var Role $role */
        $role          = Role::findOrFail($id);
        $permissionIds = $request->post("permission_ids");

        $this->validate($request, [
            'name' => 'required|max:50|unique:roles,name,' . $id,
            'slug' => 'required|max:50',
        ]);

        $role->name = $request->post('name');
        $role->slug = $request->post('slug');

        DB::transaction(function () use ($role, $permissionIds) {
            $role->save();
            $role->detachPermissions($role->permissions()->pluck('id')->toArray());
            $role->attachPermissions($permissionIds);
        });

        session()->flash('success', 'Role update success.');
        return redirect()->route('admin.roles.show', [$role]);
    }
}
