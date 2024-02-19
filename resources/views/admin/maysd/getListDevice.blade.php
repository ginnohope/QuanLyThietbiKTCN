@extends('admin.main')
@section('contents')

<style>
    .card {
        width: 100%; /* Chắc chắn rằng mỗi card chiếm toàn bộ chiều rộng */
    }

    .card .fa-computer {
        font-size: 48px; /* Kích thước icon */
        color: #fff;
    }

    hr {
        width: 100%;
    }

</style>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Danh sách {{$device->category->c_name}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin')}}">
                        <i class="fa-solid fa-house"></i>
                        Trang chủ
                    </a></li>
                    <li class="breadcrumb-item"><a href="{{route('danh-sach-may', $device->m_room_id)}}">phòng máy {{$device->room->r_name}}</a></li>
                    <li class="breadcrumb-item"><a href="#">Danh sách {{$device->category->c_name}}</a></li>
                </ol>
            </div>
        </div>
    </div>
</section>

<div class="col-12">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form id="searchDetail" action="" method="GET">
                        {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
                        <fieldset>
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <input type="text" name="search" class="form-control" id="searchInput" placeholder="Nhập tên thiết bị">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <select name="active" class="form-control" id="">
                                        <option value="">Trạng thái</option>
                                        <option value="1">Hoạt động</option>
                                        <option value="0">Bảo trì</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <select name="state" class="form-control" id="">
                                        <option value="">Tình trạng</option>
                                        <option value="1">Tốt</option>
                                        <option value="2">Kém</option>
                                        <option value="3">Hỏng</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row text-right">
                                <div class="col-md-12">
                                    <button class="btn btn-primary" type="submit">Tìm kiếm</button>
                                    <button type="button" class="btn btn-secondary ml-2" onclick="reset()"><i class="fa-solid fa-rotate-right"></i> Reset</button>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
    
                    <div class="d-flex justify-content-between mb-10">
                        <div class="text-left">
                            <p class="text-muted text-sd"><b>Tổng số: {{$productCount}}</b></p>
                            <p class="text-muted text-sd"><b>Đang hoạt động: {{$hoatdong}}</b></p>
                            <p class="text-muted text-sd"><b>Bảo trì: {{$baotri}}</b></p>
    
                        </div>
                        <div class="text-right">
                            <form class="form">
                                <a href="{{ route('them-moi-thiet-bi', ['did' => $device->id, 'cid' => $device->m_cate_id]) }}" data-id="" class="btn btn-primary mx-auto me-2 px-2 py-1 fw-bolder">Thêm mới</a>
                            </form>
                            <a href="{{ route('danh-sach-may', [$device->room->id]) }}" class="btn btn-secondary mx-auto mt-4 mx-2"><i class="fa-solid fa-arrow-left"></i> Trở về</a>
                        </div>
                    </div>
                    
                                
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-sm-12">
                    {{-- <div class="d-flex justify-content-between mb-10">
                        <form class="form">
                            <a href="{{ route('them-moi-thiet-bi', ['did' => $device->id, 'cid' => $device->m_cate_id]) }}" data-id="" class="btn btn-primary me-2 px-2 py-1 fw-bolder">Thêm mới</a>
                        </form>
                    </div> --}}
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <?php $i = 1 ?>
                            @foreach($roomDetails as $item)
                            <div class="col-sm-12">
                                {{-- STT --}}
                                
                                <div class="d-flex justify-content-between mb-10">
                                    <div class="col-sm-2">
                                        <p class="text-muted text-sm"><b>Thông tin thiết bị <?php echo $i++ ?></b></p>
                                    </div>
                                </div>
                        
                                <div class="d-flex justify-content-between mb-10">
                                    <div class="col-sm-5">
                                        {{-- <p class="text-muted text-sm"><b>Hình ảnh: </b> --}}
                                            <img width="60" src="{{ asset('storage/images/products/'. $item->product->p_image) }}" alt="Avatar">
                                        </p>
                                        <p class="text-muted text-sm"><b>Tên thiết bị: </b>{{$item->product->p_name}}</p>
                                        <p class="text-muted text-sm"><b>Mã thiết bị: </b>{{$item->rd_code}}</p>
                                        <p class="text-muted text-sm"><b>Thuộc loại: </b>{{$item->product->category->c_name}}</p>
                                    </div>
                                    <div class="col-sm-5">
                                        <p class="text-muted text-sm"><b>Trạng thái: </b>
                                            @if($item->rd_state == 1)
                                                <span class="ms-2 badge bg-primary">Hoạt động</span>
                                            @else
                                                <span class="ms-2 badge bg-danger">Bảo trì</span>
                                            @endif
                                        </p>
                                        <p class="text-muted text-sm"><b>Tình trạng: </b>
                                            @if($item->rd_Percentage == 1)
                                                Tốt
                                            @elseif($item->rd_Percentage == 2)
                                                Kém chất lượng
                                            @else
                                                Hỏng
                                            @endif
                                        </p>
                                        <p class="text-muted text-sm"><b>Ngày tạo: </b>{{$item->created_at}}</p>
                                        <p class="text-muted text-sm"><b>Ghi chú: </b>{{$item->rd_notes}}</p>
                                        
                                    </div>
                        
                                    <div class="col-sm-2">
                                        <div class="mb-3 mt-20">
                                            <a href="{{ route('cap-nhat-thiet-bi', ['did' => $item->rd_device_id, 'pid' => $item->rd_product_id, 'id' => $item->id]) }}" class="btn btn-success px-2 py-1 fw-bolder"><i class="fa-solid fa-pen-to-square"></i></a>
                                            <button type="button" data-id="{{$item->id}}" class="btn btn-danger btnDeleteAsk px-2 py-1 fw-bolder" data-toggle="modal" data-target="#deleteModal{{$item->id}}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                            {{-- <button type="button" data-id="{{$item->id}}" class="btn btn-info btnDeleteAsk px-2 py-1 fw-bolder" data-toggle="modal" data-target="#infoComputer{{$item->id}}">
                                                <i class="fa-solid fa-eye"></i>
                                            </button> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                        
                                {{-- Modal Delete --}}
                                <div class="modal fade" id="deleteModal{{$item->id}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$item->id}}" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title fs-5" id="deleteModalLabel">Bạn có chắc chắn xóa {{$item->m_name}} vĩnh viễn không ?</h4>
                                            </div>
                                            <ul>
                                                <li><strong>Tên thiết bị: </strong>{{$item->product->p_name}}</li>
                                                <li><strong>Thuộc loại: </strong>{{$item->product->category->c_name}}</li>
                                                <li><strong>Ngày tạo: </strong>{{$item->created_at}}</li>
                                            </ul>
                                            <div class="modal-footer">
                                                <form action="{{ route('thiet-bi.destroy', ['did' => $item->rd_device_id, 'id' => $item->id]) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="delete-forever btn btn-danger" data-id="{{ $item->id }}">Xóa</button>
                        
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="pagination mt-4 pb-4">
                                {{ $roomDetails->appends(request()->all())->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection
