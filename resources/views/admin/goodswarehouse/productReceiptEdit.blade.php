@extends('admin.main')
@section('contents')
    <h3 class="bg-gradient-primary font-weight-bold p-3">{{$title}}</h3>
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
                            <div id="acct-password-row" class="span13">
                                <form action="" method="POST" accept-charset="utf-8">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div id="acct-password-row" class="span8">
                                        <fieldset>
                                            <div class="control-group ">
                                                <label>Tên NCC:&nbsp&nbsp</label>
                                                <select  class="span7" name="gwSupplierID" id="gwSupplierID">
                                                    @if($goodswarehouses->wg_supplier_id != null)
                                                        <option value="{{ $goodswarehouses->supplier->id }}">{{ $goodswarehouses->supplier->id }}-{{ $goodswarehouses->supplier->s_name }}</option>
                                                        @else
                                                        <option value="">Chọn NCC</option>
                                                        @foreach($suppliers as $supplier)
                                                            <option value="{{ $supplier->id }}" >{{ $supplier->id }}-{{ $supplier->s_name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                            <div class="control-group">
                                                <label>Lý do:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                                                <input type="text" name="gwReason" value="{{$goodswarehouses->gw_reason}}" class="form-control input-field">
                                            </div>
                                            <div class="control-group">
                                                {{-- <label>Nhân viên:</label>
                                                <input type="hidden" value="{{$user->name }}" class="form-control input-field"> --}}
                                                <input type="hidden" name="gwUser" value="{{$user->id }}">
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div id="acct-password-row" class="span4">
                                        <fieldset>
                                            <div class="control-group ">
                                                <label>Mã phiếu:</label>
                                                <input type="text" name="gwCode" value="PNK{!! date('dmYhms') !!}" class="form-control input-field">
                                            </div>
                                            <div class="control-group">
                                                <label>Ngày lập:&nbsp</label>
                                                <input type="date" name="gwDate" value="{{ date('Y-m-d') }}" class="form-control input-field">
                                            </div>
                                            <div>
                                                <button type="submit" class="btn btn-primary mt-20 mb-10"><i class="fa-solid fa-floppy-disk"></i>&nbsp&nbsp&nbspLưu</button>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div id="acct-password-row" class="span12">
                                        <div>
                                        <form action="" method="POST" accept-charset="utf-8">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                                            <table class="tb table table-bordered table-hover" id="myTable" name="myTable">
                                                <thead style="background:#EFEFEF;">
                                                    <tr>
                                                        <th>Mã SP</th>
                                                        <th>Tên SP</th>
                                                        <th>Số lượng</th>
                                                        <th>Đơn giá</th>
                                                        <th>Thành tiền</th>
                                                        <th class="span1"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($warehousesDetails as $warehousesDetail)
                                                    <tr>
                                                        <td>{{ $warehousesDetail->id }}</td>
                                                        <td>{{ $warehousesDetail->product->p_name}}</td>
                                                        <td>
                                                            <input type="number" value="{!! $warehousesDetail->wid_quantity !!}" class="qty">
                                                            <input type="hidden" name="" value="{{ $warehousesDetail->wid_product_id }}" class="pID">
                                                            <input type="hidden" name="" value="{{ $goodswarehouses->id }}" class="nkID">
                                                        </td>
                                                        <td>{{ number_format($warehousesDetail->product->p_price, 0, ",", ".") }} vnđ</td>
                                                        <td>{{ number_format($warehousesDetail->wid_total, 0, ",", ".") }} vnđ</td>
                                                        <td class="td-actions">
                                                            <a class="update btn btn-small btn-success" name="id" id="{{ $warehousesDetail->id }}"><i class="fa-solid fa-pen-to-square"></i></a>
                                                            <a class="del btn btn-small btn-danger" href="{!! URL::route('getDeleteProductDetail',[$warehousesDetail->wid_product_id,$goodswarehouses->id]) !!}"><i class="fa-solid fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                    @endforeach

                                                    <tr>
                                                        <td colspan="5"><b><i>Tổng tiền</i></b></td>
                                                        <td>{!! number_format("$goodswarehouses->gw_total",0,".",",")  !!} vnđ</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            </form>
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
    <script>
        $(document).ready(function() {
            $(".update").click(function(){
                var nkID = $(this).parent().parent().find(".nkID").val();
                var pID = $(this).parent().parent().find(".pID").val();
                var qty = $(this).parent().parent().find(".qty").val();
                var token = $("input[name='_token']").val();
                // alert(xkID);
                $.ajax({
                    url:'http://quanlyphongmayktcn.vtest/admin/suatheosanpham/'+pID+'/'+qty,
                    type:'GET',
                    cache:false,
                    data:{"_token":token,"nkID":nkID,"qty":qty,"pID":pID},
                    success: function(data) {
                        if(data == "oke") {
                            alert('thành công')
                          window.location = "http://quanlyphongmayktcn.vtest/admin/sua-theo-san-pham/"+nkID;
                        }
                        else {
                         alert("Error!");
                        }
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Kích hoạt DatePicker
            $('#gwDate').datepicker({
                format: 'dd-mm-yyyy', // Định dạng ngày tháng năm
                autoclose: true,
                todayHighlight: true
            });
        });
    </script>
@endsection