@extends('admin.main')

@section('contents')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Thêm máy phòng {{$room->r_name}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin')}}">
                        <i class="fa-solid fa-house"></i>
                        Trang chủ
                    </a></li>
                    <li class="breadcrumb-item"><a href="{{route('danh-sach-may', $id)}}">phòng máy {{$room->r_name}}</a></li>
                    <li class="breadcrumb-item active">{{$title}}</li>
                </ol>
            </div>
        </div>
    </div>
</section>

    <div class="container-fluid">
        <form action="{{ route('may-tinh.store', ['id' => $id]) }}" method="POST" accept-charset="utf-8">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <fieldset>
                                <div class="form-group">
                                    <label for="icon">Biểu tượng thiết bị</label>
                                    <select name="icon" class="form-control" id="icon">
                                        <option value="">Chọn biểu tượng thiết bị</option>
                                        <option value="<i class='fa-solid fa-desktop'></i>">Màn hình máy tính</option>
                                        <option value="<i class='fa-solid fa-keyboard'></i>">Bàn phím máy tính</option>
                                        <option value="<i class='fa-solid fa-computer-mouse'></i>">Chuột máy tính</option>
                                        <option value="<i class='fa-solid fa-table'></i>">Bàn học</option>
                                        <option value="<i class='fa-solid fa-chair'></i>">Ghế</option>
                                        <option value="<i class='fa-solid fa-pager'></i>">Bảng học</option>
                                        <option value="<i class='fa-solid fa-fan'></i>">Quạt trần</option>
                                        <option value="<i class='fa-solid fa-wind'></i>">Điều hòa</option>
                                        <option value="<i class='fa-solid fa-tarp-droplet'></i>">Máy chiếu</option>
                                        <option value="<i class='fa-solid fa-hard-drive'></i>">CPU</option>
                                        <option value="<i class='fa-solid fa-headphones'></i>">Tai nghe</option>
                                    </select>
                                </div>
                                
                                

                                <div class="form-group">
                                    <label>Tên danh mục</label>
                                    <select class="form-control" name="CateID" id="CateID">
                                        <option>--Chọn--</option>
                                        @foreach($cates as $cate)
                                            <option value="{{ $cate->id }}">{{ $cate->c_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </fieldset>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" name="active" type="checkbox" id="customCheckbox1" value="option1">
                            <label for="customCheckbox1" class="custom-control-label">Hoạt động</label>
                        </div>

                        <div class="form-group">
                            <label>Ngày thêm</label>
                            <input type="date" name="date" value="{{ date('Y-m-d') }}" class="form-control">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-4"><i class="fa-solid fa-floppy-disk"></i> Lưu</button>
                            <a href="{{route('danh-sach-may', $id)}}" class="btn btn-secondary mt-4 mx-2"><i class="fa-solid fa-arrow-left"></i> Trở về</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>

    <script>
        $(document).ready(function() {
            // Kích hoạt DatePicker
            $('#gwDate').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                todayHighlight: true
            });
        });
    </script>
@endsection
