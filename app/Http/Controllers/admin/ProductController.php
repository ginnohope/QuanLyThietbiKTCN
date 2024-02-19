<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Suppliers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $cates = Category::all();
        $users = User::all();
        $products = Product::paginate(3);
        return view("admin.product.index", compact("products","users", "cates"), [
            'title' => 'Danh mục sản phẩm'
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=> 'required',
            'code'=> 'required|unique:products,p_code',
            'price' =>'required',
        ], [
            'name.required'=> 'Tên sản phẩm không được để trống',
            'code.required'=> 'Mã sản phẩm không được để trống',
            'code.unique'=> 'Mã sản phẩm đã tồn tại',
            'price.required'=> 'Giá tiền không được để trống',
        ]);

        $product = new Product;

        $product->p_name = $request->name;
        $product->p_code = $request->code;
        $name = $request->name;
        $images = $request->file('images');
        if($images) {
            $fileName = Str::slug($name) . '.jpg';
            $images->storeAs('public/images/products', $fileName);
            $product->p_image = $fileName;
        }
        $product->p_user_id = auth()->user()->id;
        $product->p_category_id = $request->cate_id;
        $product->p_price = $request->price;

        $product->save();
        return redirect()->back()->with('success','Thêm mới sản phẩm thành công');
    }

    public function show($id) {

    }

    public function search(Request $request) {
        $cates = Category::all();
        $query = Product::query();
        $productName = $request->input('search');
        if($productName) {
            $query->where('p_name', 'like', '%' . $productName . '%')
            ->orWhere('p_code', 'like', '%' . $productName . '%');
        }

        $products = $query->paginate(3);
        return view('admin.product.index',compact('cates', 'products'), [
            'title' => 'Tìm kiếm sản phẩm'
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'name'=> 'required',
            'code'=> 'required|unique:products,p_code,' . $product->id,
            'price' =>'required',
        ], [
            'name.required'=> 'Tên sản phẩm không được để trống',
            'code.required'=> 'Mã sản phẩm không được để trống',
            'code.unique'=> 'Mã sản phẩm đã tồn tại',
            'price.required'=> 'Giá tiền không được để trống',
        ]);

        $product->p_name = $request->name;
        $product->p_code = $request->code;
        $name = $request->name;
        $images = $request->file('images');
        if($images) {
            $fileName = Str::slug($name) . '.jpg';
            $images->storeAs('public/images/products', $fileName);
            $product->p_image = $fileName;
        }
        $product->p_user_id = auth()->user()->id;
        $product->p_category_id = $request->cate_id;
        $product->p_price = $request->price;

        $product->save();
        return redirect()->back()->with('success','Thêm mới sản phẩm thành công');
    }
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->back()->with('message', 'Xóa thành công');
    }

    public function deleteAllProducts() {
        Product::truncate(); 
        return redirect()->back()->with('message', 'Xóa tất cả thành công');
    }
}
