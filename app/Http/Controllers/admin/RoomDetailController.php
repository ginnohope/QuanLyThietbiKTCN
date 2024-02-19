<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MaySD;
use App\Models\Product;
use App\Models\Room;
use App\Models\RoomDetail;
use Illuminate\Http\Request;

class RoomDetailController extends Controller
{
    public function create($did, $cid) {

        $device = MaySD::where('id', $did)->first();

        $products = Product::where('p_category_id', $cid)->get();

        $room = Room::where('id', $device->m_room_id)->first();
        $roomName = strtr($room->r_name, [' ' => '']);

        return view('admin.roomDetail.create', compact('device', 'did', 'cid', 'roomName', 'products'), [
            'title' => 'Thêm mới thiết bị'
        ]);
    }

    public function store(Request $request, $did, $cid) {
        // $request->validate([
        //     'code'=> 'required|unique:roomdetail,rd_code',
        // ], [
        //     'code.required' => 'Mã thiết bị không được để trống',
        // ]);
        $pID = Product::where('id', $request->ProductID)->first();
    
        // $existingRecord = RoomDetail::where('rd_product_id', $request->ProductID)
        //     ->where('rd_device_id', $did)
        //     ->first();
    
        $tong = $request->quantity * $pID->p_price;
    
        // if ($existingRecord) {
        //     // Nếu bản ghi đã tồn tại, cập nhật số lượng và giá tiền
        //     $existingRecord->update([
        //         'rd_quantity' => $existingRecord->rd_quantity + $request->quantity,
        //         'rd_total' => $existingRecord->rd_total + $tong,
        //     ]);
        // } else {
            // Nếu không tìm thấy bản ghi, tạo mới
            RoomDetail::create([
                'rd_code' => $request->code,
                'rd_quantity' => $request->quantity,
                'rd_product_id' => $request->ProductID,
                'rd_Percentage' => $request->percentage,
                'rd_state' => $request->has('active'),
                'rd_device_id' => $did,
                'rd_total' => $tong,
                'rd_notes' => $request->notes,
            ]);
        // }
    
        return redirect()->back()->with('message', 'Thêm mới thành công');
    }

    public function edit($did, $pid, $id) {
        $productID = Product::where('id', $pid)->first();
        $device = MaySD::where('id', $did)->first();
        if($productID) {
            $p_category_id = $productID->p_category_id;
        }
        $products = Product::where('p_category_id', $p_category_id)->get();
        $roomDetail = RoomDetail::where('rd_device_id', $did)
        ->where('id', $id)->first();

        return view('admin.roomDetail.edit', compact('device', 'did', 'pid', 'id', 'roomDetail', 'products'), [
            'title' => 'Chỉnh sửa thiết bị'
        ]);
    }

    public function update(Request $request, $did, $pid, $id) {
        // $request->validate([
        //     'quantity' => 'required',
        // ], [
        //     'quantity.required' => 'Số lượng không được để trống',
        // ]);
    
        $productPrice = Product::where('id', $pid)->first();
        $tong = $request->quantity * $productPrice->p_price;
    
        $roomDetail = RoomDetail::where('rd_device_id', $did)->findOrFail($id);
    
        $roomDetail->update([
            'rd_code' => $request->code,
            'rd_quantity' => $request->quantity,
            'rd_product_id' => $request->ProductID,
            'rd_Percentage' => $request->percentage,
            'rd_state' => $request->has('active'),
            'rd_device_id' => $did,
            'rd_total' => $tong,
            'rd_notes' => $request->notes,
        ]);
    
        return redirect()->back()->with('message', 'Cập nhật thành công');
    }
    
    public function destroy($did, $id) {
        $detailDel = RoomDetail::where('rd_device_id', $did)->findOrFail($id);
        $detailDel->delete();
        return redirect()->back()->with('message', 'Xóa thành công');
    }
}
