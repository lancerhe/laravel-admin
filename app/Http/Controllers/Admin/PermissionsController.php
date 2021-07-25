<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Permission;
use Illuminate\Http\Request;

class PermissionsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $permissions = Permission::query()->paginate(30);
        return view('admin.permissions.index', compact('permissions'));
    }

    public function create() {
        return view('admin.permissions.create');
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name'   => 'required|max:50|unique:permissions,name',
            'slug'   => 'required|max:50',
            'prefix' => 'max:50',
        ]);

        $permission         = new Permission();
        $permission->name   = $request->post('name');
        $permission->slug   = $request->post('slug');
        $permission->prefix = $request->post('prefix');
        $permission->save();

        session()->flash('success', "权限[{$permission->slug}]添加成功");
        return redirect()->route('admin.permissions.show', [$permission]);
    }

    public function show($id) {
        $permission = Permission::findOrFail($id);
        return view('admin.permissions.show', compact('permission'));
    }

    public function edit($id) {
        $permission = Permission::findOrFail($id);
        return view('admin.permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id) {
        $permission = Permission::findOrFail($id);

        $this->validate($request, [
            'name'   => 'required|max:50|unique:permissions,name,' . $id,
            'slug'   => 'required|max:50',
            'prefix' => 'max:50',
        ]);

        $permission->name   = $request->post('name');
        $permission->slug   = $request->post('slug');
        $permission->prefix = $request->post('prefix');
        $permission->save();

        session()->flash('success', "权限[{$permission->slug}]更新成功");
        return redirect()->route('admin.permissions.show', [$permission]);
    }
}
