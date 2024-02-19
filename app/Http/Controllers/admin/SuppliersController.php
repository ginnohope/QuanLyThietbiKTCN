<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SuppliersController extends Controller
{
    public function index()
    {
        $suppliers = Suppliers::paginate(2);
        return view("admin.supplier.index", compact("suppliers"), [
            "title"=> 'Quản lý nhà cung cấp'
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=> 'required',
            'email'=> 'required|unique:suppliers,s_email',
            'phone'=> 'required|unique:suppliers,s_phone',
            'tax' => 'required|unique:suppliers,s_tax',
            'address' => 'required',
        ], [
            'name.required'=> 'Vui lòng nhập tên nhà cung cấp',
            'email.required'=> 'Vui lòng nhập email',
            'email.unique'=> 'Email đã tồn tại',
            'phone.required'=> 'Vui lòng nhập số điện thoại',
            'phone.unique'=> 'Số điện thoại đã tồn tại',
            'tax.required'=> 'Vui lòng nhập Mã thuế',
            'tax.unique'=> 'Mã thuế đã tồn tại',
            'address.required'=> 'Nhập địa chỉ',
        ]);

        $supplier = new Suppliers;
        $supplier->s_name = $request->name;
        $supplier->s_email = $request->email;
        $supplier->s_phone = $request->phone;
        $supplier->s_tax = $request->tax;
        $supplier->s_address = $request->address;
        $name = $request->name;
        $logo = $request->file('logo');
        if($logo) {
            $fileName = Str::slug($name) . '.jpg';
            $logo->storeAs('public/images/logos', $fileName);
            $supplier->s_logo = $fileName;
        }
        $supplier->s_acc_number = $request->accountNumber;
        $supplier->s_name_bank = $request->nameBank;
        $supplier->save();
        return redirect()->back()->with('message', 'Thêm mới thành công');
    }

    public function update(Request $request, Suppliers $supplier)
    {
        $this->validate($request, [
            'name'=> 'required',
            'email'=> 'required|unique:suppliers,s_email,' . $supplier->id,
            'phone'=> 'required|unique:suppliers,s_phone,' . $supplier->id,
            'tax' => 'required|unique:suppliers,s_tax,' . $supplier->id,
            'address' => 'required',
        ], [
            'name.required'=> 'Vui lòng nhập tên nhà cung cấp',
            'email.required'=> 'Vui lòng nhập email',
            'email.unique'=> 'Email đã tồn tại',
            'phone.required'=> 'Vui lòng nhập số điện thoại',
            'phone.unique'=> 'Số điện thoại đã tồn tại',
            'tax.required'=> 'Vui lòng nhập Mã thuế',
            'tax.unique'=> 'Mã thuế đã tồn tại',
            'address.required'=> 'Nhập địa chỉ',
        ]);
        $supplier->s_name = $request->name;
        $supplier->s_email = $request->email;
        $supplier->s_phone = $request->phone;
        $supplier->s_tax = $request->tax;
        $supplier->s_address = $request->address;
        $name = $request->name;
        $logo = $request->file('logo');
        if($logo) {
            $fileName = Str::slug($name) . '.jpg';
            $logo->storeAs('public/images/logos', $fileName);
            $supplier->s_logo = $fileName;
        }
        $supplier->s_acc_number = $request->accountNumber;
        $supplier->s_name_bank = $request->nameBank;
        $supplier->save();
        return redirect()->back()->with('message', 'Cập nhật thành công');
    }

    public function destroy(Suppliers $supplier)
    {
        $supplier->delete();
        // Chuyển hướng về trang danh sách cate hoặc trang khác (tuỳ ý)
        // return response()->json(['message' => 'Danh mục đã được xóa thành công']);
        return redirect()->back()->with('message', 'Xóa thành công');
    }

    public function deleteAllSuppliers() {
        Suppliers::truncate(); 
        return redirect()->back()->with('message', 'Xóa tất cả thành công');
    }
}
