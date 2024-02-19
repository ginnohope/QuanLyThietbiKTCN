<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\floor;
use App\Models\Room;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        $rooms = Room::all();
        $floors = floor::all();
        // dd($floors);
        return view("admin.home", compact('rooms', 'floors'), [
        "title" => "Bảng điều kiển",
        
        ]);
    }

    public function search(Request $request) {
        $floors = floor::all();
        $searchTerm = $request->input('search');
        $floorId = $request->input('floor');
        $isActive = $request->input('active');

        $query = Room::query(); 

        if ($searchTerm) {
            $query->where('r_name', 'like', '%' . $searchTerm . '%');
        }

        if ($floorId) {
            $query->where('r_floor_id', $floorId);
        }

        if ($isActive !== null) {
            $query->where('r_active', $isActive);
        }

        // Lấy kết quả
        $rooms = $query->get();
    
        return view("admin.home", compact('rooms', 'floors'), [
            "title" => "Tìm kiếm phòng",
        ]);
    }
} 
