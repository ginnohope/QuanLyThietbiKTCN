<?php

use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\FloorsController;
use App\Http\Controllers\admin\Goods_warehousesController;
use App\Http\Controllers\admin\HomeController;
use App\Http\Controllers\admin\MaySDController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\RoomController;
use App\Http\Controllers\admin\RoomDetailController;
use App\Http\Controllers\admin\SuppliersController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\AuthController;
use App\Models\floor;
use App\Models\Product;
use App\Models\Room;
use App\Models\Suppliers;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/login', [AuthController::class,'showLoginForm'])->name('login');
Route::post('/loginForm', [AuthController::class,'login'])->name('loginForm')->middleware('throttle_logins');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

// Route hiển thị form quên mật khẩu
Route::get('/forgot-password', [AuthController::class,'showLinkRequestForm'])->name('forgetPassForm');
// Route xử lý yêu cầu reset mật khẩu
Route::post('/forgot-password', [AuthController::class,'sendResetLinkEmail'])->name('forgetPassRequest');
// Route hiển thị form đặt lại mật khẩu
Route::get('/reset-password/{token}', [AuthController::class,'showResetForm'])->name('password.reset');
// Route xử lý việc đặt lại mật khẩu
Route::post('/reset-password', [AuthController::class,'reset'])->name('reset');


Route::middleware(['auth'])->group(function () {
    Route::get('/admin', function() {
        $rooms = Room::all();
        $floors = floor::all();
        return view('admin.home', [
            'title' => 'Trang chủ',
            'rooms' => $rooms,
            'floors' => $floors,
        ]);
    });

    Route::middleware(['auth', 'checkLevel'])->group(function() {
        Route::get('/', function () {
            return redirect('/admin');
        });
        Route::prefix('admin')->group(function () {
            Route::get('/',[HomeController::class,'home'])->name('admin');
            Route::get('/search',[HomeController::class, 'search'])->name('search');
            //User
            Route::get('/userAdmin', [UsersController::class,'userAdmin'])->name('userAdmin');
            Route::get('/user', [UsersController::class,'user'])->name('user');
            Route::post('/userAdmin', [UsersController::class, 'store'])->name('user.store');
            Route::patch('/userAdmin/{user}', [UsersController::class,'update'])->name('user.update');
            Route::delete('/user/{id}', [UsersController::class,'destroy'])->name('user.destroy');

            //Supplier
            Route::resource('suppliers', SuppliersController::class);
            Route::post('suppliers/delete-all', [SuppliersController::class,'deleteAllSuppliers'])->name('deleteAllSuppliers');

            //Categories

            Route::resource('cates', CategoryController::class);
            Route::post('cates/delete-all', [CategoryController::class,'deleteAllCates'])->name('deleteAllcates');

            //Products
            Route::resource('products', ProductController::class);
            Route::post('products/delete-all', [ProductController::class,'deleteAllProducts'])->name('deleteAllProducts');
            Route::get('product/search', [ProductController::class, 'search'])->name('productSearch');

            // Goods Warehouse
            Route::get('goods_warehouse', [Goods_warehousesController::class,'index'])->name('getdanhsach');
            Route::get('goods_warehouse_nhap', [Goods_warehousesController::class,'getList'])->name('getList');
            Route::post('goods_warehouse_nhap', [Goods_warehousesController::class,'postList'])->name('postList');
            Route::get('suanhapkho/{id}', [Goods_warehousesController::class,'getEdit'])->name('getNhapKho');
            Route::post('suanhapkho/{id}', [Goods_warehousesController::class,'postEdit'])->name('postNhapKho');
            Route::get('xoanhapkho/{id}', [Goods_warehousesController::class,'getDelete'])->name('xoaNhapKho');
            Route::get('/goods_warehouse/search',[Goods_warehousesController::class,'search'])->name('searchWarehouse');
// Theo sản phẩm
            Route::get('xem-theo-san-pham', [Goods_warehousesController::class,'getProduct'])->name('xemsanpham');
            Route::get('sua-theo-san-pham/{id}', [Goods_warehousesController::class,'getEditProduct'])->name('suatheosanpham');
            // Route::post('sua-theo-san-pham/{id}', [Goods_warehousesController::class,'postEdit'])->name('postNhapKho');
            Route::get('suatheosanpham/{id}/{qty}', [Goods_warehousesController::class,'getUpdateProduct']);
            Route::get('xoatheosanpham{id}/{qty}', [Goods_warehousesController::class,'getDeleteProduct'])->name('getDeleteProductDetail');

            Route::get('in/{id}', [Goods_warehousesController::class,'getPDF'])->name('getPDFWarehouses');


            // Route::get('goods_warehouse_Add', [Goods_warehousesController::class,'getAdd'])->name('AddList');
            

            Route::get('suppliers/ajax-call', function () {
                $s_id = Request::get('gwSupplierID');
                $supplier = Suppliers::where('id', $s_id)->get();
                return Response::json($supplier);
            });
            //Ajax sản phẩm
            Route::get('products/ajax-call', function(){
                $p_id = Request::get('gwProductID');
                $product = Product::where('id', $p_id)->get();
                return Response::json($product);
            });

            Route::get('nhaphang/{id}/{qty}', [Goods_warehousesController::class,'postNhaphang'])->name('AddList');

            Route::post('xoa-san-pham', [Goods_warehousesController::class,'xoaSanPham'])->name('xoaSanPham');

            // Tầng nhà KTCN

            Route::resource('floors', FloorsController::class);
            Route::post('floors/delete-all', [FloorsController::class,'deleteAllFloors'])->name('deleteAllFloors');

            // Phòng học KTCN
            Route::resource('rooms', RoomController::class);
            Route::post('rooms/delete-all', [RoomController::class,'deleteAllRooms'])->name('deleteAllRooms');
            Route::get('rooms/danh-sach/{id}', [RoomController::class,'getList'])->name('danh-sach-may');

            Route::get('rooms/in-kiem-ke/{id}', [RoomController::class,'getPDFKiemKe'])->name('in-kiem-ke');
            Route::get('rooms/in-nghiem-thu/{id}', [RoomController::class,'getPDFNghiemThu'])->name('in-nghiem-thu');
            Route::get('/rooms/search',[RoomController::class, 'show'])->name('search-rooms');

            // Thiết bị
            Route::get('may-tinh/{id}', [MaySDController::class, 'create'])->name('MaySDCreate');
            Route::post('may-tinh/{id}', [MaySDController::class, 'store'])->name('may-tinh.store');
            Route::get('/may-tinh/{id}/edit/{idMaySD}', [MaySDController::class, 'edit'])->name('may-tinh.edit');
            Route::post('/may-tinh/{id}/edit/{idMaySD}', [MaySDController::class, 'update'])->name('may-tinh.update');
            Route::delete('/may-tinh/{id}/delete/{idMaySD}', [MaySDController::class, 'destroy'])->name('may-tinh.destroy');
            Route::get('thiet-bi/{did}/danh-sach/{cid}', [MaySDController::class,'getListDevice'])->name('danh-sach-thiet-bi');

            // Chi tiết thiết bị
            Route::get('/thiet-bi/{did}/them-moi-thiet-bi/{cid}', [RoomDetailController::class, 'create'])->name('them-moi-thiet-bi');
            Route::post('/thiet-bi/{did}/them-moi-thiet-bi/{cid}', [RoomDetailController::class, 'store'])->name('them-moi-thiet-bi.store');
            Route::get('/thiet-bi/{did}/cap-nhat-thiet-bi/{pid}/{id}', [RoomDetailController::class, 'edit'])->name('cap-nhat-thiet-bi');
            Route::post('/thiet-bi/{did}/cap-nhat-thiet-bi/{pid}/{id}', [RoomDetailController::class, 'update'])->name('cap-nhat-thiet-bi.update');
            Route::delete('/thietbi/{did}/delete/{id}', [RoomDetailController::class, 'destroy'])->name('thiet-bi.destroy');
            // Route::get('/thiet-bi/{did}/loai-thiet-bi/{cid}/search',[RoomDetailController::class, 'show'])->name('search-rooms-detail');
        });
    });
});
