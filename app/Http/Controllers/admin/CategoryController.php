<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $cates = Category::paginate(5);
        return view("admin.cate.index", compact("cates"),[
            "title"=> 'Quản lý danh mục'
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name'=> 'required',
        ], [
            'name.required'=> 'Tên danh mục trống',
        ]);
        $cate = new Category;
        $cate->c_name = $request->name;
        $cate->c_parent_id = $request->parent_id;
        $cate->avtive = $request->active ? 1 : 0;
        $cate->save();

        return redirect()->back()->with('message','Thêm mới danh mục thành công');
    }

    public function update(Request $request, Category $cate) {
        $this->validate($request, [
            'name'=> 'required',
        ], [
            'name.required'=> 'Tên danh mục trống',
        ]);

        $cate->c_name = $request->name;
        // $cate->c_code = $request->code;
        $cate->c_parent_id = $request->parent_id;
        $cate->avtive = $request->active ? 1 : 0;
        $cate->save();
        return redirect()->back()->with('message','Cập nhật danh mục thành công');
    }

    public function destroy(Category $cate)
    {
        $cate->delete();
        return redirect()->back()->with('message','Xóa danh mục thành công');
    }

    public function deleteAllCates() {
        Category::truncate(); 
        return redirect()->back()->with('message', 'Xóa tất cả thành công');
    }
}
