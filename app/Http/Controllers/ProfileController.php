<?php

namespace App\Http\Controllers;

use App\Models\Admin\Permission;
use App\Models\Admin\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class ProfileController
 * @package App\Http\Controllers
 */
class ProfileController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function index() {
        $user        = User::findOrFail(Auth::id());
        $permissions = Permission::all();
        return view('profile.index', compact('user', 'permissions'));
    }

    public function edit() {
        /** @var User $user */
        $user = User::findOrFail(Auth::id());
        return view('profile.edit', compact('user'));
    }


    public function update(Request $request) {
        /** @var User $user */
        $user = User::findOrFail(Auth::id());
        $this->validate($request, [
            'email'    => 'required|max:250|unique:users,email,' . $user->id,
            'password' => 'nullable|confirmed|min:6',
        ]);

        $user->email = $request->post('email');
        if ( $request->post('password') ) {
            $user->password = bcrypt($request->post('password'));
        }
        $user->save();

        session()->flash('success', '个人信息更新成功');
        return redirect()->route('profile.index');
    }
}
