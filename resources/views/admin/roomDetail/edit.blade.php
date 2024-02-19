@extends('admin.main')

@section('contents')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Cập nhật thiết bị {{$device->category->c_name}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin')}}">
                        <i class="fa-solid fa-house"></i>
                        Trang chủ
                    </a></li>
                    <li class="breadcrumb-item"><a href="{{route('danh-sach-may', $device->m_room_id)}}">Danh sách {{$device->category->c_name}}</a></li>
                    <li class="breadcrumb-item"><a href="{{route('danh-sach-thiet-bi', [$device->id, $device->m_cate_id])}}">Danh sách thiết bị {{$device->category->c_name}}</a></li>
                </ol>
            </div>
        </div>
    </div>
</section>

    <div class="container-fluid">
        <form action="{{ route('cap-nhat-thiet-bi.update', ['did' => $did, 'pid' => $pid, 'id' => $roomDetail->id]) }}" method="POST" accept-charset="utf-8">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mã thiết bị</label>
                                            <input type="text" name="code" value="{{$roomDetail->rd_code}}" class="form-control" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tên sản phẩm</label>
                                            <select class="form-control" name="ProductID" id="ProductID">
                                                @if($roomDetail->rd_product_id != null)
                                                    <option value="{{ $roomDetail->rd_product_id }}">{{ $roomDetail->product->p_name}}</option>
                                                @else
                                                    <option>--Chọn--</option>
                                                @endif
                                                @foreach($products as $product)
                                                    <option value="{{ $product->id }}">{{ $product->p_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {{-- <label>Số lượng</label> --}}
                                            <input type="hidden" name="quantity" value="1" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Tình trạng</label>
                                        <select name="percentage" class="form-control">
                                            <option value="1" {{ $roomDetail->rd_Percentage == 1 ? 'selected' : '' }}>Tốt</option>
                                            <option value="2" {{ $roomDetail->rd_Percentage == 2 ? 'selected' : '' }}>Kém</option>
                                            <option value="3" {{ $roomDetail->rd_Percentage == 3 ? 'selected' : '' }}>Hỏng</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group mt-2">
                                    <label>Ghi chú</label>
                                    <input type="text" name="notes" value="{{$roomDetail->rd_notes}}" class="form-control">
                                </div>
                            </fieldset>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="custom-control custom-checkbox">
                            @if($roomDetail->rd_state == 1)
                                <input checked name="active" type="checkbox" class="form-check-input" id="">
                            @else
                                <input name="active" type="checkbox" class="form-check-input" id="">
                            @endif
                            <label class="form-check-label" for="">trạng thái</label>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success mt-4"><i class="fa-solid fa-floppy-disk"></i> Cập nhật</button>
                            <a href="{{route('danh-sach-thiet-bi', [$device->id, $device->m_cate_id])}}" class="btn btn-secondary mt-4 mx-2"><i class="fa-solid fa-arrow-left"></i> Trở về</a>
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
