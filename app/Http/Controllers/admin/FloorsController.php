<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\floor;
use Illuminate\Http\Request;

class FloorsController extends Controller
{
    public function index() {
        $floors = floor::paginate(5);
        return view('admin.floor.index', compact('floors'), [
            'title' => 'Quản lý khu vực'
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name'=> 'required|unique:floors,f_name,',
        ], [
            'name.required'=> 'Không được để trống',
            'name.unique'=> 'Tên đã tồn tại',
        ]);

        $floor = new floor;
        $floor->f_name = $request->name;
        $floor->save();
        return redirect()->back()->with('message','Thêm mới thành công');
    }

    public function update(Request $request, floor $floor) {
        $this->validate($request, [
            'name'=> 'required|unique:floors,f_name,'. $floor->id,
        ], [
            'name.required'=> 'Không được để trống',
            'name.unique'=> 'Tên đã tồn tại',
        ]);

        $floor->f_name = $request->name;
        $floor->save();
        return redirect()->back()->with('message','Cập nhật thành công');
    }

    public function destroy(floor $floor)
    {
        $floor->delete();
        return redirect()->back()->with('message','Xóa thành công');
    }

    public function deleteAllFloors() {
        floor::truncate(); 
        return redirect()->back()->with('message', 'Xóa tất cả thành công');
    }
}
