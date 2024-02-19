<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\floor;
use App\Models\MaySD;
use App\Models\Product;
use App\Models\Room;
use App\Models\RoomDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index() {
        $floors = floor::all();
        $rooms = Room::paginate(5);

        return view('admin.room.index', compact('floors', 'rooms'), [
            'title' => 'Quản lý phòng máy'
        ]);
    }

    public function store(Request $request) {
        $this->validate($request, [
            'name'=> 'required|unique:rooms,r_name,',
        ], [
            'name.required'=> 'Tên lớp không được để trống',
            'name.unique'=> 'Tên lớp đã tồn tại',
        ]);

        $room = new Room;
        $room->r_name = $request->name;
        $room->r_floor_id = $request->floor_id;
        $room->r_active = $request->active ? 1 : 0;
        $room->save();
        return redirect()->back()->with('message','Thêm mới thành công');
    }

    public function show(Request $request)
    {
        $floors = Floor::all();
        $searchTerm = $request->input('search');
        $floorId = $request->input('floor');
    
        $query = Room::query();
    
        if ($searchTerm) {
            $query->where('r_name', 'like', '%' . $searchTerm . '%');
        }
    
        if ($floorId) {
            $query->where('r_floor_id', $floorId);
        }
    
        $rooms = $query->paginate(5);
    
        return view("admin.room.index", compact('rooms', 'floors'), [
            "title" => "Tìm kiếm phòng",
        ]);
    }
    public function update(Request $request, Room $room) {
        $this->validate($request, [
            'name'=> 'required|unique:rooms,r_name,'. $room->id,
        ], [
            'name.required'=> 'Tên lớp không được để trống',
            'name.unique'=> 'Tên lớp đã tồn tại',
        ]);
        $room->r_name = $request->name;
        $room->r_floor_id = $request->floor_id;
        $room->r_active = $request->active ? 1 : 0;
        $room->save();
        return redirect()->back()->with('message','Cập nhật thành công');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->back()->with('message','Xóa thành công');
    }

    public function deleteAllRooms() {
        Room::truncate(); 
        return redirect()->back()->with('message', 'Xóa tất cả thành công');
    }

    public function getList($id) {
        $room = Room::where('id', $id)->first();
        $maySDs = MaySD::where('m_room_id', $id)->paginate(4);

        return view('admin.room.danhsach', compact('room', 'maySDs'), [
            'title' => 'Danh sách máy'
        ]);
    }

    public function getPDFKiemKe($id) {
        $room = Room::where('id', $id)->first();
        $devices = MaySD::where('m_room_id', $id)->get();
        $categoryIds = $devices->pluck('m_cate_id')->toArray();
        $categories = Category::whereIn('id', $categoryIds)->get();
    
        $deviceIds = $devices->pluck('id')->toArray();
        $roomDetails = RoomDetail::whereIn('rd_device_id', $deviceIds)->get();
    
        $combinedProducts = [];
    
        foreach ($roomDetails as $roomDetail) {
            $productId = $roomDetail->rd_product_id;
    
            if (!isset($combinedProducts[$productId])) {
                $combinedProducts[$productId] = [
                    'product' => $roomDetail->product,
                    'quantity' => 0,
                    'total' => 0,
                    'State1' => 0, 
                    'State0' => 0,
                    'status1' => 0,
                    'status2' => 0,
                    'status3' => 0,
                ];
            }
    
            if ($roomDetail->rd_state == 1) {
                $combinedProducts[$productId]['State1'] += $roomDetail->rd_quantity;
            } elseif ($roomDetail->rd_state == 0) {
                $combinedProducts[$productId]['State0'] += $roomDetail->rd_quantity;
            }

            if($roomDetail->rd_Percentage == 1) {
                $combinedProducts[$productId]['status1'] += $roomDetail->rd_quantity;
            }elseif ($roomDetail->rd_Percentage == 2) {
                $combinedProducts[$productId]['status2'] += $roomDetail->rd_quantity;
            }else {
                $combinedProducts[$productId]['status3'] += $roomDetail->rd_quantity;
            }
    
            $combinedProducts[$productId]['quantity'] += $roomDetail->rd_quantity;
            $combinedProducts[$productId]['total'] += $roomDetail->rd_total;
        }

        $tong = 0;

    // Cập nhật biến tổng
        foreach ($combinedProducts as $product) {
            $tong += $product['total'];
        }
    
        $pdf = Pdf::loadView('admin.room.kiemke', compact('room', 'devices', 'categories', 'tong', 'combinedProducts'));
        return $pdf->stream();
        // return View('admin.room.kiemke', compact('room', 'devices', 'categories', 'combinedProducts'));
    }

    public function getPDFNghiemThu($id) {
        $room = Room::where('id', $id)->first();
        $devices = MaySD::where('m_room_id', $id)->get();
        $categoryIds = $devices->pluck('m_cate_id')->toArray();
        $categories = Category::whereIn('id', $categoryIds)->get();
    
        $deviceIds = $devices->pluck('id')->toArray();
        $roomDetails = RoomDetail::whereIn('rd_device_id', $deviceIds)
        ->where('rd_state', 0)->get();

    
        $pdf = Pdf::loadView('admin.room.nghiemthu', compact('room', 'devices', 'categories', 'roomDetails'));
        return $pdf->stream();
        // return View('admin.room.kiemke', compact('room', 'devices', 'categories', 'combinedProducts'));
    }
    
}
