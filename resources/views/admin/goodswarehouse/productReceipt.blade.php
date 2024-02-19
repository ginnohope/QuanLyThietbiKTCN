@extends('admin.main')
@section('contents')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>{{$title}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin')}}">
                      <i class="fa-solid fa-house"></i>
                      Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item">{{$title}}</li>
                </ol>
            </div>
        </div>
    </div>
</section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="d-flex justify-content-between mb-10">
                                        <form class="form">
                                            <a href="{{route('getList')}}" data-id="" class="btn btn-primary me-2 px-2 py-1 fw-bolder">Tạo hóa đơn</a>
                                            <a href="{{route('getdanhsach')}}" data-id="" class="btn btn-primary me-2 px-2 py-1 fw-bolder">Theo chứng từ</a>
                                            <a href="{{route('xemsanpham')}}" data-id="" class="btn btn-primary me-2 px-2 py-1 fw-bolder">Theo thiết bị</a>
                                        </form>    
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="deleteModalAll" tabindex="-1" aria-labelledby="deleteModalAllLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleteModalLabel">Bạn có chắc chắn xóa tất cả bản ghi không ?</h1>
                                        </div>
                                        {{-- {{route('deleteAllgoodswarehouses')}} --}}
                                        <form action="" method="post" class="modal-footer">
                                            @csrf
                                            <button class="delete-forever btn btn-danger fw-bolder">Xóa</button>
                                            <button type="button" class="btn btn-secondary fw-bolder" data-dismiss="modal">Đóng</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                                        <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Mã đơn hàng</th>
                                            <th>Mã sản phẩm</th>
                                            <th>Số lượng</th>
                                            <th>Tổng tiền</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1 ?>
                                        @foreach($goodswarehouses as $goodswarehouse)
                                            <?php 
                                                // $count = WarehousesInvoiceDetail::where('wid_goodwarehouse_id',$goodswarehouse->id)->count();
                                                $chitiet = DB::table('warehouses_invoice_details')->where('wid_goodwarehouse_id',$goodswarehouse->id)->get();
                                                
                                            ?>
                                            @foreach ($chitiet as $val)
                                            <?php 
                                                $sp = DB::table('products')->where('id',$val->wid_product_id)->first();
                                            ?>
                                            <tr class="odd">
                                                <td><?php echo $i++?></td>
                                                <td>{{$goodswarehouse->gw_code}}</td>
                                                <td>{{$sp->p_code}}</td>
                                                <td>{{$val->wid_quantity}}</td>
                                                <td>{{ number_format($val->wid_total, 0, ",", ".") }} vnđ</td>
                                                <td class="td-actions">
                                                    <a href="{!! URL::route('suatheosanpham',$goodswarehouse->id) !!}" class="btn btn-small btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    </a>
                                                    <button type="button" data-id="{{$goodswarehouse->id}}" class="btn btn-danger btnDeleteAsk px-2 py-1 fw-bolder" data-toggle="modal" data-target="#deleteModal{{$goodswarehouse->id}}">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                    {{-- <a onclick="return confirmDel('Bạn có chắc muốn xóa dữ liệu này?')"  href="{!! URL::route('xoaNhapKho',$goodswarehouse->id) !!}" class="btn btn-small btn-danger">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a> --}}
                                                    {{-- <a href="{!! URL::route('chucnang.nhapkho.getPDF',$goodswarehouse->id) !!}" class="btn btn-small btn-info" target="_blank"><i class="icon-print" ></i></a> --}}
                                                </td>

                                                {{-- Modal Delete --}}
                                                <div class="modal fade" id="deleteModal{{$goodswarehouse->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title fs-5" id="deleteModalLabel">Bạn có chắc chắn xóa bản ghi này vĩnh viễn không ?</h4>
                                                            </div>
                                                            <ul>
                                                                <li><strong>Mã đơn hàng: </strong>{{$goodswarehouse->gw_code}}</li>
                                                                <li><strong>Tên sản phẩm: </strong>{{$sp->p_name}}</li>
                                                                <li><strong>Mã sản phẩm: </strong>{{$sp->p_code}}</li>
                                                            </ul>
                                                            <div class="modal-footer">
                                                                <a href="{!! URL::route('xoaNhapKho',$goodswarehouse->id) !!}" class="btn btn-small btn-danger">Xóa</a>
                                                                <a href="#" class="btn btn-secondary" data-dismiss="modal">Đóng</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </tr>
                                        @endforeach
                                        @endforeach 
                                        </tbody>
                                        <tfoot>

                                        </tfoot>
                                    </table>

                                    <div class="pagination mt-4 pb-4">
                                        {{ $goodswarehouses->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection