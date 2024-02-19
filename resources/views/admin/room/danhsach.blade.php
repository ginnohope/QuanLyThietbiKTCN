@extends('admin.main')
@section('contents')

<style>
    .card {
        width: 100%;
    }

    .text-center > .fa-solid {
        font-size: 48px;
        color: #fff;
    }
</style>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Danh sách máy phòng {{$room->r_name}}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin')}}">
                        <i class="fa-solid fa-house"></i>
                        Trang chủ
                    </a></li>
                    <li class="breadcrumb-item"><a href="{{route('rooms.index')}}">Danh sách phòng máy</a></li>
                    <li class="breadcrumb-item"><a href="{{route('danh-sach-may', $room->id)}}">phòng máy {{$room->r_name}}</a></li>
                    <li class="breadcrumb-item active">{{$title}}</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="d-flex justify-content-between mb-10">
                                    <div class="col-sm-6">
                                        <p class="text-muted text-sm"><b>Tên phòng: </b>{{$room->r_name}}</p>
                                        <p class="text-muted text-sm"><b>Ngày tạo: </b>{{$room->created_at}}</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="text-muted text-sm"><b>Khu vực: </b>{{$room->floor->f_name}}</p>
                                        <p class="text-muted text-sm"><b>Trạng thái: </b>
                                            @if($room->r_active == 1)
                                                Hoạt động
                                            @else
                                                Không hoạt động
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="d-flex justify-content-between mb-10">
                                    <form class="form">
                                        <a href="{{ route('MaySDCreate', ['id' => $room->id]) }}" data-id="" class="btn btn-primary me-2 px-2 py-1 fw-bolder">Thêm mới</a>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            @foreach($maySDs as $item)
                                <div class="col-md-3">
                                    <div class="card card-primary card-outline" style="background-color: {{$item->m_active == 1 ? '#009900' : '#CC0000'}};">
                                        <div class="card-body box-profile">
                                                <div class="text-center">
                                                    {!! $item->m_name !!}
                                                </div>

                                            <h3 class="profile-username text-center cl-white">{{$item->category->c_name}}</h3>

                                            <div class="d-flex justify-content-around mb-3 mt-20">
                                                <a href="{{ route('may-tinh.edit', ['id' => $room->id, 'idMaySD' => $item->id]) }}" class="btn cl-white px-2 py-1 fw-bolder"><i class="fa-solid fa-pen-to-square"></i></a>
                                                <button type="button" data-url="/admin/rooms/{{$room->id}}" data-id="{{$room->id}}" class="btn cl-white btnDeleteAsk px-2 py-1 fw-bolder" data-toggle="modal" data-target="#deleteModal{{$item->id}}">
                                                    <i class="fa-solid fa-trash"></i>
                                                </button>
                                                <a href="{{ route('danh-sach-thiet-bi', ['did' => $item->id, 'cid' => $item->m_cate_id]) }}" class="btn cl-white px-2 py-1 fw-bolder"> <i class="fa-solid fa-eye"></i></a>
                                                {{-- <button type="button" data-id="{{$room->id}}" class="btn cl-white btnDeleteAsk px-2 py-1 fw-bolder" data-toggle="modal" data-target="#infoComputer{{$item->id}}">
                                                    <i class="fa-solid fa-eye"></i>
                                                </button> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Modal infor --}}
                                <div class="modal fade" id="infoComputer{{$item->id}}" tabindex="-1" aria-labelledby="infoComputerLabel{{$item->id}}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header justify-content-center">
                                                <h1 class="modal-title fs-5" id="infoComputerLabel">Thông tin {{$item->m_name}}</h1>
                                            </div>
                                            <div class="card-body">
                                                <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="d-flex justify-content-between mb-10">
                                                                <div class="col-sm-6">
                                                                    <p class="text-muted text-sm"><b>Mã máy: </b>{{$item->m_code}}</p>
                                                                    <p class="text-muted text-sm"><b>Danh mục thiết bị: </b>{{$item->category->c_name}}</p>
                                                                  </div>
                                                                  <div class="col-sm-6">
                                                                    <p class="text-muted text-sm"><b>Ngày sử dụng: </b>{{ date('d/m/Y', strtotime($item->m_usedate)) }}</p>
                                                                    <p class="text-muted text-sm"><b>Trạng thái: </b>
                                                                        @if($item->m_active == 1)
                                                                            Hoạt động
                                                                        @else
                                                                            Bảo trì
                                                                        @endif
                                                                    </p>
                                                                  </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12 m-0">       
                                                            <div class="modal-footer">
                                                                <div class="col-sm-4">
                                                                    <button type="button" class="btn btn-danger btn-block" data-dismiss="modal">Đóng</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Modal Delete --}}
                                <div class="modal fade" id="deleteModal{{$item->id}}" tabindex="-1" aria-labelledby="deleteModalLabel{{$item->id}}" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title fs-5" id="deleteModalLabel">Bạn có chắc chắn xóa {{$item->category->c_name}} vĩnh viễn không ?</h3>
                                            </div>
                                            <ul>
                                                <li><strong>Tên loại thiết bị: </strong>{{$item->category->c_name}}</li>
                                                <li><strong>Ngày tạo: </strong>{{$item->created_at}}</li>
                                            </ul>
                                            <div class="modal-footer">
                                                <form action="{{ route('may-tinh.destroy', ['id' => $room->id, 'idMaySD' => $item->id]) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="delete-forever btn btn-danger" data-id="{{ $room->id }}">Xóa</button>
        
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="pagination mt-4 pb-4">
                            {{ $maySDs->appends(request()->all())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection
