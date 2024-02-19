<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function user()
    {
        $users = User::where("level", '0')->paginate(5);
        return view('admin.user.user', compact('users'), [
            'title'=> 'tài khoản người dùng'
        ]);
    }

    public function userAdmin()
    {
        $users = User::where('level', '!=', '0')->orderby('level','asc')->paginate(5);
        return view('admin.user.userAdmin', compact('users'), [
            'title'=> 'Tài khoản quản trị'
        ]);
    }

    public function store(Request $request)
    {
        try {
            $this->authorize('create', User::class);
            $this->validate($request, [
                'name'=> 'required',
                'email'=> 'required|unique:users',
                'role'=> 'required',
                'level'=> 'required',
                'password' => 'required|min:6'
            ], [
                'name.required'=> 'Vui lòng nhập họ tên',
                'email.required'=> 'Vui lòng nhập email',
                'email.unique' => 'email đã tồn tại',
                'role'=> 'Vui lòng phân chức danh',
                'level'=> 'Vui lòng nhập cấp',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min' => 'Mật khẩu phải ít nhất 6 ký tự'
            ]);
    
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->level = $request->level;
            $user->password = bcrypt($request->password);
            $user->save();
            return redirect()->back()->with('message', 'Thêm mới thành công');
        }catch (AuthorizationException $e) {
            abort(403, 'Bạn không có quyền thực hiện');
        }
    }

    public function update(Request $request, User $user)
    {
         try {
            $this->authorize('create', User::class);
            $this->authorize('update', $user);
            $this->validate($request,[
                'name' => 'required',
                'email' => [
                    'required',
                    Rule::unique('users')->ignore($user->id),
                ],
                'role' => 'required',
                'level' => 'required'
            ],[
                'name.required' => 'Vui lòng nhập tên !',
                'email.required' => 'Vui lòng nhập email',
                'email.unique' => 'email đã tồn tại',
                'role.required' => 'Vui lòng phân quyền',
                'level.required' => 'Vui lòng nhập level',
            ]);

            $user->name = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->level = $request->level;
             if ($request->has('password') && !empty($request->password)) {
                 $user->password = bcrypt($request->password);
             }
             $user->save();
             return redirect()->back()->with('message', 'Cập nhật thành công');
         } catch (AuthorizationException $e) {
             abort(403, 'Bạn không có quyền thực hiện');
         }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        try {
            $this->authorize('delete', $user);
            $user->delete();
            return redirect()->back()->with('message', 'Cập nhật thành công');
        } catch (AuthorizationException $e) {
            abort(403, 'Bạn không có quyền thực hiện hành động này!');
        }
    }
}
