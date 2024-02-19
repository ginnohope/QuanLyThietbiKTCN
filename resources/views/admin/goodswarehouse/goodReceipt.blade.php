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
                    <li class="breadcrumb-item"><a href="{{route('getdanhsach')}}">Danh sách</a></li>
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
                            <div id="acct-password-row" class="span13">
                                <form action="" method="POST" accept-charset="utf-8">

                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div id="acct-password-row" class="span8">
                                        <fieldset>
                                            <div class="control-group ">
                                                <label>Tên NCC:&nbsp&nbsp</label>
                                                <select  class="span7" name="gwSupplierID" id="gwSupplierID">
                                                    <option>--Chọn--</option>
                                                    @foreach($suppliers as $supplier)
                                                        <option value="{{ $supplier->id }}" >{{ $supplier->s_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="control-group">
                                                <label>Lý do:&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</label>
                                                <input type="text" name="gwReason" value="{{ old('gwReason') }}" class="form-control input-field">
                                            </div>
                                            <div class="control-group">
                                                {{-- <label>Nhân viên:</label>
                                                <input type="text" value="{{$user->name }}" class="form-control input-field"> --}}
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
                                        <fieldset>
                                            <div>
                                                <u><p><b>Danh sách thiết bị</b></p></u>
                                            </div>
                                        </fieldset>                    
                                    </div>
                                    </form>
                                    <form action="" method="POST" accept-charset="utf-8">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div id="acct-password-row" class="span13">
                                            <fieldset>
                                                <div class="control-group">
                                                    <label>Tên sản phẩm:</label>
                                                        <select  class="selSP1 span2" name="gwProductID" id="gwProductID">
                                                            <option>--Chọn--</option>
                                                            @foreach($products as $product)
                                                            <option value="{{ $product->id}}">{{ $product->p_name}}</option>
                                                            @endforeach
                                                        </select>  
                                                </div>
                                                <div class="control-group mt-20 mb-10">
                                                    <label>Số lượng:</label>
                                                    <input type="number" name="sluong" id="sluong" class="sluong span2">&nbsp&nbsp
                                                    <a href="#" class="add1 btn btn-default" type="submit"><i class="fa-solid fa-plus"></i>&nbsp&nbspThêm</a>
                                                </div>
                                            </fieldset>
    
                                        </div>
                                        
                                    </form>
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
                                                    @foreach($contents as $content)
                                                    <tr>
                                                        <td>{{ $content->id }}</td>
                                                        <td>{{ $content->name }}</td>
                                                        <td>{{ $content->qty }}</td>
                                                        <td>{{ number_format($content->price, 0, ",", ".") }} vnđ</td>
                                                        <td>{{ number_format($content->subtotal, 0, ",", ".") }} vnđ</td>
                                                        <td class="td-actions">
                                                            <a class="del btn btn-small btn-danger" name="id" id="{{ $content->id }}"><i class="fa-solid fa-trash"></i></a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                
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
            $(".add1").click(function() {
                console.log("Button clicked");
              // var id = $(this).attr('.selVT1');
                var id = $(this).parent().parent().find(".selSP1").val();
                var qty = $(this).parent().parent().find(".sluong").val();
                var token = $("input[name='_token']").val();
                $.ajax({
                    url:'nhaphang/'+id+'/'+qty,
                    type:'GET',
                    cache:false,
                    data:{"_token":token,"id":id,"qty":qty},
                    success: function(data) {
                        if(data == "oke") {
                          window.location = 'goods_warehouse_nhap';
                        }
                        else {
                         alert("Error!" + data);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        alert("AJAX request failed: " + status);
                    }
                });
            });
        });

        $(document).ready(function() {
        $(".del").click(function(){
            var productId = $(this).attr("id");

            // Xóa hàng khỏi bảng HTML
            $("#myTable").find(`tr[data-id='${productId}']`).remove();

            // Gọi AJAX để xóa sản phẩm khỏi giỏ hàng
            var token = $("input[name='_token']").val();
            $.ajax({
                url: 'xoa-san-pham',
                type: 'POST',
                data: {"_token": token, "id": productId},
                success: function(data) {
                    if(data == 'oke') {
                        alert("Sản phẩm đã được xóa khỏi giỏ hàng thành công!");
                        window.location = "goods_warehouse_nhap";
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("AJAX request failed: " + status);
                }
            });
        });
    });
    </script>


    <!-- Ajax sản phẩm -->
    <script>
        $('#gwProductID').on('change', function(e) {
            console.log(e);
            var gwProductID = e.target.value;

            //ajax

            $.getJSON("products/ajax-call?gwProductID="+gwProductID, function (data) {

                console.log(data);

                $('#product').empty();
                $.each(data, function(index, productObj){

                     $('#product').append('<option value="'+productObj.id+'  selected="{{ old("ten") === "'+productObj.id+'" ? true : false }} ">'+productObj.vt_ten+'</option>');
                });

                // $('#country1').empty();
                // $.each(data, function(index, countryObj){

                //     $('#country1').append('<option value="'+countryObj.id+'  selected="{{ old("dvt") === "'+countryObj.id+'" ? true : false }} ">'+countryObj.dvt_ten+'</option>');
                // });

                // $('#country2').empty();
                // $.each(data, function(index, countryObj){

                //     $('#country2').append('<option value="'+countryObj.id+'  selected="{{ old("kho") === "'+countryObj.id+'" ? true : false }} ">'+countryObj.kho_ten+'</option>');
                // });
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