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
                                        <div class="col-sm-4">
                                            <form class="form">
                                                <a href="{{route('getList')}}" data-id="" class="btn btn-primary me-2 px-2 py-1 fw-bolder">Tạo hóa đơn</a>
                                                <a href="{{route('getdanhsach')}}" data-id="" class="btn btn-primary me-2 px-2 py-1 fw-bolder">Theo chứng từ</a>
                                                <a href="{{route('xemsanpham')}}" data-id="" class="btn btn-primary me-2 px-2 py-1 fw-bolder">Theo thiết bị</a>
                                            </form>   
                                        </div>
                                        <div class="col-sm-8">
                                            <form method="GET" action="{{route('searchWarehouse')}}">
                                                <div class="d-flex jmb-10">
                                                    <div class="col-sm-4">
                                                        <input type="text" name="search" class="form-control" id="searchInput" placeholder="Mã đơn hàng">
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="date" name="date" class="form-control" id="dateInput">
                                                    </div>
                                                <div class="d-flex">
                                                    <button type="submit" class="btn btn-primary mr-2">Tìm kiếm</button>
                                                    <button type="button" class="btn btn-secondary ml-2" onclick="reset()"><i class="fa-solid fa-rotate-right"></i> Reset</button>
                                                </div>
                                            </form>    
                                        </div>
                                    </div>
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
                                            <th>Ngày</th>
                                            <th>lý do</th>
                                            <th>Tổng tiền</th>
                                            <th>Tên NCC</th>
                                            <th style="width:150px"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1 ?>
                                        @foreach($goodswarehouses as $goodswarehouse)
                                            <tr class="odd">
                                                <td><?php echo $i++?></td>
                                                <td>{{$goodswarehouse->gw_code}}</td>
                                                <td>{{$goodswarehouse->created_at}}</td>
                                                <td>{{$goodswarehouse->gw_reason}}</td>
                                                <td>{!! number_format("$goodswarehouse->gw_total",0,".",",")  !!} vnđ</td>
                                                <td>{{$goodswarehouse->supplier->s_name}}</td>
                                                <td class="td-actions">
                                                    <a href="{!! URL::route('getNhapKho',$goodswarehouse->id) !!}" class="btn btn-small btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                                                    </a>
                                                    <button type="button" data-id="{{$goodswarehouse->id}}" class="btn btn-danger btnDeleteAsk px-2 py-1 fw-bolder" data-toggle="modal" data-target="#deleteModal{{$goodswarehouse->id}}">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                    <a href="{!! URL::route('getPDFWarehouses',$goodswarehouse->id) !!}" class="btn btn-small btn-info" target="_blank"><i class="fa-solid fa-print"></i></a>
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
                                                                <li><strong>Ngày tạo: </strong>{{$goodswarehouse->created_at}}</li>
                                                                <li><strong>Đơn giá: </strong>{!! number_format("$goodswarehouse->gw_total",0,".",",")  !!} vnđ</li>
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
                                        </tbody>
                                        <tfoot>
                                        </tfoot>
                                    </table>

                                    {{-- <div class="pagination mt-4 pb-4">
                                        {{ $goodswarehouses->links() }}
                                    </div> --}}
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


<script>
    function reset() {

        document.getElementById('searchInput').value = "";
        document.getElementById('selectOption1').selectedIndex = 0;
        document.getElementById('selectOption2').selectedIndex = 0;

        console.log("Đã reset");
    }
</script>