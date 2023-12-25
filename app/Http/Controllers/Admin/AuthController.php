<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        if (!Auth::guard('admin')->check()) {
            return view('admin.auth.login');
        } else {
            return redirect()->route('admin.index');
        }
    }

    public function signIn(Request $request)
    {
        $remember_me = ($request->has('remember_me') && $request->remember_me == 1) ? true : false;
        if (Auth::guard('admin')->attempt(
            [
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ],
            $remember_me
        )) {

            return redirect()->route('admin.bookroom.list_room');
        } else {
            auth('admin')->logout();
            return redirect()->back();
        }
    }

    public function logout()
    {
        auth('admin')->logout();
        return redirect()->route('admin.auth.login');
    }

    public function changePass()
    {
        return view('admin/auth/changePass');
    }

    public function updatePass(Request $request)
    {
        // $response = $this->authService->update_pass($request);
        // if (isset($response['error'])) {
        //     Toastr::error('Thông báo', 'Thay đổi mật khẩu thất bại');
        //     return redirect()->back();
        // } else {
        //     Toastr::success('Thông báo', 'Thay đổi mật khẩu thành công');
        //     return redirect()->route('admin.index');
        // }
    }
}
