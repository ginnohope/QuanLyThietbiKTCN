<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\GoodsWarehouse;
use App\Models\Product;
use App\Models\Suppliers;
use App\Models\User;
use App\Models\WarehousesInvoiceDetail;
use Barryvdh\DomPDF\Facade\Pdf;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Goods_warehousesController extends Controller
{
    public function index()
    {
        $goodswarehouses = GoodsWarehouse::paginate(5);
        return view("admin.goodswarehouse.index", compact("goodswarehouses"), [
            'title' => 'Danh sách chứng từ' 
        ]);
    }

    public function getList() {
        $user = User::where('id', Auth::user()->id)->first();
        $suppliers = Suppliers::all();
        $products = Product::all();
        $contents = Cart::content();
        return view('admin.goodswarehouse.goodReceipt', compact('user', 'suppliers', 'products', 'contents'), [
            'title' => "Nhập thiết bị"
        ]);
    }

    public function postList(Request $request)
	{
		$id_user = Request('gwUser');
		$contents = Cart::content();
		$total = Cart::total();
		$nhapkho = new GoodsWarehouse;
		$nhapkho->gw_code = Request('gwCode');
		$nhapkho->gw_reason = Request('gwReason');
		$nhapkho->gw_total = $total;
		$nhapkho->wg_supplier_id =  Request('gwSupplierID') ;
		$nhapkho->gw_user_id = $id_user;
		$nhapkho->save();
		foreach ($contents as $item) {
			$chitiet = new WarehousesInvoiceDetail;
			
			$chitiet->wid_quantity = $item->qty;
			$chitiet->wid_total = $item->qty * $item->price;
			$chitiet->wid_product_id = $item->id;
			$chitiet->wid_goodwarehouse_id = $nhapkho->id;
			$chitiet->save();
		
			// $sp = Product::where('id', $item->id)->first();
			// $sp->p_total_number = $chitiet->wid_quantity;
			// $sp->save();
		}
		Cart::destroy();
		return redirect()->back()->with('message','Thêm mới thành công');
    }

	public function getAdd()
	{

		//
	}

    public function postNhaphang(Request $request)
    {
		if($request->ajax()) {
			$id = $request->input('id');
			$qty =$request->input('qty');
			
			$sp = Product::where('id', $id)->first();
			
			Cart::add([
				'id' => $id,
				'name' => $sp->p_name,
				'qty' => $qty,
				'price' => $sp->p_price,
			]);
			echo "oke";
		}
    }

	public function xoaSanPham(Request $request)
	{
		$productId = $request->input('id');
	
		// Sử dụng phương thức search để tìm kiếm sản phẩm trong giỏ hàng bằng id
		$cartItem = Cart::search(function ($cartItem, $rowId) use ($productId) {
			return $cartItem->id == $productId;
		})->first();
	
		if ($cartItem) {
			// Sử dụng phương thức remove để xóa sản phẩm khỏi giỏ hàng bằng rowId
			Cart::remove($cartItem->rowId);
		}
		echo "oke";
	}

	public function getEdit($id) {
		$user = User::where('id', Auth::user()->id)->first();
		$products = Product::all();
        $suppliers = Suppliers::all();
		$goodswarehouses = GoodsWarehouse::where('id', $id)->first();
		$warehousesDetails = WarehousesInvoiceDetail::where('wid_goodwarehouse_id', $id)->get();

        return view('admin.goodswarehouse.goodReceiptEdit', compact('products', 'user', 'suppliers', 'goodswarehouses', 'warehousesDetails'), [
            'title' => "Chỉnh sửa hóa đơn"
        ]);
	}


	public function postEdit(Request $request, $id) {
		GoodsWarehouse::where('id', $id)->update([
			'gw_code' => $request->input('gwCode'),
			'wg_supplier_id' =>$request->input('gwSupplierID'),
			'gw_user_id' => $request->input('gwUser'),
			'created_at' => $request->input('gwDate'),
			'gw_reason' => $request->input('gwReason')
		]);
		return redirect()->route('getdanhsach')->with('message','cập nhật thành công');
	}

	public function getDelete($id) {
		WarehousesInvoiceDetail::where('wid_goodwarehouse_id', $id)->delete();
		GoodsWarehouse::where('id', $id)->delete();
		return redirect()->route('getdanhsach')->with('message','Xóa thành công');
	}

	// Get Products

	public function getProduct() {
		$goodswarehouses = GoodsWarehouse::paginate(4);
        return view("admin.goodswarehouse.productReceipt", compact("goodswarehouses"), [
            'title' => 'Danh sách sản phẩm'
        ]);
	}

	public function getEditProduct($id) {
		$user = User::where('id', Auth::user()->id)->first();
		$products = Product::all();
        $suppliers = Suppliers::all();
		$goodswarehouses = GoodsWarehouse::where('id', $id)->first();
		$warehousesDetails = WarehousesInvoiceDetail::where('wid_goodwarehouse_id', $id)->get();

        return view('admin.goodswarehouse.productReceiptEdit', compact('products', 'user', 'suppliers', 'goodswarehouses', 'warehousesDetails'), [
            'title' => "Chỉnh sửa hóa đơn theo sản phẩm"
        ]);
	}

	public function getUpdateProduct(Request $request) {
		if($request->ajax()) {
			$nkID = $request->input('nkID');
			$pID = $request->input('pID');
			$qty = $request->input('qty');
			$product = Product::where('id', $pID)->first();

			WarehousesInvoiceDetail::where('wid_product_id', $pID)
			->update([
				'wid_quantity' => $qty,
				'wid_total' => $qty * $product->p_price,
			]);

			$tong = WarehousesInvoiceDetail::where('wid_goodwarehouse_id', $nkID)
			->sum('wid_total');

			GoodsWarehouse::where('id', $nkID)
			->update([
				'gw_total' => $tong
			]);
			echo 'oke';
		}
	}

	public function getDeleteProduct($id,$ad) {
		WarehousesInvoiceDetail::where('wid_product_id', $id)
		->where('wid_goodwarehouse_id', $ad)
		->delete();
		// Tính lại tổng tiền sau khi xóa sản phẩm
		$tong = WarehousesInvoiceDetail::where('wid_goodwarehouse_id', $ad)
        ->sum('wid_total');

    // Cập nhật giá tiền của hóa đơn
    GoodsWarehouse::where('id', $ad)
        ->update([
            'gw_total' => $tong,
        ]);

	return redirect()->route('getNhapKho', $ad)->with('message','Xóa thành công');
	}

	public function getPDF($id)
    {
        $goodswarehouse = GoodsWarehouse::where('id',$id)->first();
        $goodswarehouseDetail = WarehousesInvoiceDetail::where('wid_goodwarehouse_id',$id)->get();
        $user = User::where('id',$goodswarehouse->gw_user_id)->first();
        $supplier = Suppliers::where('id',$goodswarehouse->wg_supplier_id)->first();

        $pdf = Pdf::loadView('admin.goodswarehouse.filePDF',compact('goodswarehouse','goodswarehouseDetail','user','supplier'));
        return $pdf->stream();

		// return View('admin.goodswarehouse.filePDF',compact('goodswarehouse','goodswarehouseDetail','user','supplier'));
    }

	public function search(Request $request) {
		$search = $request->input('search');
		$date = $request->input('date');
		$query = GoodsWarehouse::query();

		if($search) {
			$query->where('gw_code', 'like', '%' . $search . '%');
		}

		if($date) {
			$query->whereDate('created_at', $date);
		}

		$goodswarehouses = $query->get();

		return view("admin.goodswarehouse.index", compact("goodswarehouses"), [
            'title' => 'Tìm kiếm' 
        ]);
	}

}
