<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MaySD;
use App\Models\Product;
use App\Models\Room;
use App\Models\RoomDetail;
use Illuminate\Http\Request;

class MaySDController extends Controller
{
    public function index() {
        //
    }

    public function create($id) {
        $cates = Category::all();
        $room = Room::where('id', $id)->first();
        return view('admin.maysd.create', compact('id', 'cates', 'room'), [
            'title' => 'Thêm mới thiết bị'
        ]);
    }

    public function store(Request $request, $id) {
        // $request->validate([
        //     'name' => 'required',
        // ], [
        //     'name.required'=> 'Icon không được để trống',
        // ]);

        $IconValue = "";
        if($request->icon == null) {
            $IconValue = '<i class="fa-solid fa-house"></i>';
        }else {
            $IconValue = $request->icon;
        }

        MaySD::create([
            'm_name' => $IconValue,
            'm_cate_id' => $request->CateID,
            'm_active' => $request->has('active'),
            'm_room_id' => $id,
            'm_usedate' => $request->date,
        ]);
        return redirect()->back()->with('message','Thêm mới thành công');
    }

    public function edit($id, $idMaySD) {
        $devices = MaySD::all();
        $cates = Category::all();
        $room = Room::where('id', $id)->first();
        $maySD = MaySD::where('m_room_id', $id)
        ->where('id', $idMaySD)->first();
        return view('admin.maysd.edit', compact('id', 'cates', 'maySD', 'room', 'devices', 'idMaySD'), [
            'title' => 'Cập nhật thiết bị'
        ]);
    }

    public function update(Request $request, $id, $idMaySD) {
        // $request->validate([
        //     'name'=> 'required',
        // ], [
        //     'name.required'=> 'Icon được để trống',
        // ]);
    
        $maySD = MaySD::where('m_room_id', $id)->findOrFail($idMaySD);
        $IconValue = "";
        if($request->name == null) {
            $IconValue = '<i class="fa-solid fa-house"></i>';
        }else {
            $IconValue = $request->name;
        }
    
        // Cập nhật thông tin từ request
        $maySD->update([
            'm_name' => $IconValue,
            'm_cate_id' => $request->cateID,
            'm_active' => $request->has('active'),
            'm_usedate' => $request->date,
        ]);
    
        return redirect()->back()->with('message', 'Cập nhật thành công');
    }

    public function getListDevice($d_id, $c_id) {
        $device = MaySD::where('id', $d_id)->first();
        $cate = Category::where('id', $c_id)->first();

        $productCount = RoomDetail::where('rd_device_id', $device->id)->count();
        $hoatdong = RoomDetail::where('rd_state', true)->where('rd_device_id', $device->id)->count();
        $baotri = RoomDetail::where('rd_state', false)->where('rd_device_id', $device->id)->count();
        
        $productIDs = Product::where('p_category_id', $cate->id)->pluck('id');
        $product = Product::all();
        $roomDetails = RoomDetail::whereIn('rd_product_id', $productIDs)
            ->where('rd_device_id', $d_id)
            ->paginate(3);

        // Search
        $search = request()->search;
        $productSearch = Product::where('p_name', 'like', "%$search%")
        ->where('p_category_id', $c_id)->get();
        if($search) {
                    $productId = $productSearch->pluck('id')->toArray();
                    $roomDetails = RoomDetail::whereIn('rd_product_id', $productId)
                    ->where('rd_device_id', $d_id)->paginate(3);
        }

        $active = request()->active;
        if($active !== null) {
                    $productId = $productSearch->pluck('id')->toArray();
                    $roomDetails = RoomDetail::whereIn('rd_product_id', $productId)
                    ->where('rd_device_id', $d_id)
                    ->where('rd_state', $active)->paginate(3);
        }

        if($state = request()->state) {
                    $productId = $productSearch->pluck('id')->toArray();
                    $roomDetails = RoomDetail::whereIn('rd_product_id', $productId)
                    ->where('rd_device_id', $d_id)
                    ->where('rd_Percentage', $state)->paginate(3);
        }

        return view('admin.maysd.getListDevice', 
            compact('device', 'product', 'roomDetails', 'productCount', 'hoatdong', 'baotri'), [
            'title' => 'Danh sách các thiết bị'
        ]);
    }


    public function destroy($id, $idMaySD) {
        $maySD = MaySD::where('m_room_id', $id)->findOrFail($idMaySD);
        $maySD->delete();
        return redirect()->back()->with('message', 'Xóa thành công');
    }
}
