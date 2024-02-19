@extends('admin.main')
@section('contents')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Cập nhật máy phòng {{$room->r_name}}</h1>
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
        <form action="{{ route('may-tinh.update', ['id' => $id, 'idMaySD' => $idMaySD]) }}" method="POST" accept-charset="utf-8">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <fieldset>
                                <div class="form-group">
                                    <label>Biểu tượng thiết bị</label>
                                    <input type="text" value="{{$maySD->m_name}}" name="name" class="form-control">
                                    {{-- <label>Biểu tượng thiết bị</label>
                                    <select class="form-control" name="cateID" id="cateID">
                                        @if($maySD->m_cate_id != null)
                                            <option value="{{ $maySD->m_name }}">{{ $maySD->category->c_name }}</option>
                                        @else
                                        <option>--Chọn--</option>
                                        @endif
                                        @foreach($devices as $device)
                                            <option value="{{ $device->id }}">{{ $device->category->c_name }}</option>
                                        @endforeach
                                    </select> --}}
                                </div>

                                <div class="form-group">
                                    <label>Tên danh mục</label>
                                    <select class="form-control" name="cateID" id="cateID">
                                        @if($maySD->m_cate_id != null)
                                            <option value="{{ $maySD->m_cate_id }}">{{ $maySD->category->c_name }}</option>
                                        @else
                                        <option>--Chọn--</option>
                                        @endif
                                        @foreach($cates as $cate)
                                            <option value="{{ $cate->id }}">{{ $cate->c_name }}</option>
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
                            @if($maySD->m_active == 1)
                                <input checked name="active" type="checkbox" class="form-check-input" id="">
                            @else
                                <input name="active" type="checkbox" class="form-check-input" id="">
                            @endif
                            <label class="form-check-label" for="">Hoạt động</label>
                        </div>

                        <div class="form-group">
                            <label>Ngày lập</label>
                            <input type="date" value="{{ date('Y-m-d', strtotime($maySD->m_usedate)) }}" name="date" class="form-control">
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4"><i class="fa-solid fa-pen-to-square"></i> Cập nhật</button>
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
