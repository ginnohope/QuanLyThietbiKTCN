<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class AuthController extends Controller
{
    //
    public function showLoginForm(Request $request)
    {
        return view("auth.login", [
            "title"=> "Đăng nhập"
        ]);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Vui lòng nhập email !',
            'password.required' => 'Vui lòng nhập mật khẩu !',
            'password.min' => 'Mật khẩu phải ít nhất 6 ký tự',
            'email.email' => 'Email không hợp lệ'
        ]);

        // $email = $request->email;
        // $password = $request->password;
        // if(empty($email) && empty($password)) {
        //     Session::flash('error', 'Vui lòng nhập tài khoản và mật khẩu');
        //  }

        if(Auth::attempt([
            'email'=> $request->input('email'),
            'password' => $request->input('password'),
        ], $request->input('remember'))) {
            return redirect('/admin')->with('message', 'Đăng nhập thành công');
        }

        return back()->with('error', 'Thông tin đăng nhập chưa chính xác !');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function showLinkRequestForm()
    {
        return view('auth.forgetPass', [
            'title' => 'Quên mật khẩu'
        ]);
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            Session::flash('success', 'Đã gửi xác thực đến Gmail');
            return back();
        } else {
            return back()->withErrors(['email' => __($status)]);
        }
    }

//    Đặt lại mật khẩu
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.resetPass',[
            'title' => 'Đặt lại mật khẩu'
        ])->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                ])->save();
            }
        );

        return $status == Password::PASSWORD_RESET
            ? redirect()->route('login')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }
}
