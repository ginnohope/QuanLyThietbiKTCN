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

    /* Các điều chỉnh khác có thể được thêm vào tùy thuộc vào nhu cầu của bạn */
</style>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Danh sách máy phòng máy</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('admin')}}">
                      <i class="fa-solid fa-house"></i>
                      Trang chủ</a>
                    </li>
                    <li class="breadcrumb-item">Bảng điều khiển</li>
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
                                <form method="GET" action="{{route('search')}}">
                                    <h4>Tìm kiếm</h4>
                                    <div class="d-flex justify-content-between mb-10">
                                        <div class="col-sm-4">
                                            <input type="text" name="search" class="form-control" id="searchInput" placeholder="Nhập tên phòng">
                                        </div>
                                        <div class="col-sm-4">
                                            <select name="floor" class="form-control" id="selectOption1">
                                                <option value="">Chọn khu vực</option>
                                                @foreach($floors as $floor)
                                                            <option value="{{ $floor->id }}">{{ $floor->f_name }}</option>
                                                        @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-4">
                                            <select name="active" class="form-control" id="">
                                                <option value="">Trạng thái</option>
                                                <option value="1">Hoạt động</option>
                                                <option value="0">Bảo trì</option>
                                            </select>
                                        </div>
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
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="d-flex justify-content-between mb-10">
                                      <h3>Phòng máy</h3>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            @foreach($rooms as $room)
                                <div class="col-md-2">
                                  <div class="card card-primary card-outline" style="background-color: {{$room->r_active == 1 ? '#009900' : '#CC0000'}};">
                                        <div class="card-body box-profile">
                                            <div class="text-center">
                                                <i class="fa-solid fa-computer"></i>
                                            </div>

                                            <h3 class="profile-username text-center cl-white">{{$room->r_name}}</h3>

                                            <div class="d-flex justify-content-around mt-20">
                                              <button type="button" data-id="{{$room->id}}" class="btn cl-white btnEditroom px-2 py-1 fw-bolder" data-toggle="modal" data-target="#editroom{{$room->id}}"><i class="fa-solid fa-pen-to-square"></i></button>
                                              <button type="button" data-url="/admin/rooms/{{$room->id}}" data-id="{{$room->id}}" class="btn cl-white btnDeleteAsk px-2 py-1 fw-bolder" data-toggle="modal" data-target="#deleteModal{{$room->id}}"><i class="fa-solid fa-trash"></i></button>
                                              <a href="{{ route('MaySDCreate', ['id' => $room->id]) }}" class="btn cl-white px-2 py-1 fw-bolder"><i class="fa-solid fa-plus"></i></a>
                                            </div>
                                        </div>
                                        <div class="text-center custom-list">
                                          <a href="{{ route('danh-sach-may', ['id' => $room->id]) }}" class="btn cl-white px-2 py-1 fw-bolder">
                                            Danh sách
                                            <i class="fa-solid fa-circle-arrow-right"></i>
                                          </a>
                                          
                                      </div>
                                    </div>
                                </div>

                                {{-- Modal Edit --}}
                                <div class="modal fade" id="editroom{{$room->id}}" tabindex="-1" aria-labelledby="editroom{{$room->id}}Label" aria-hidden="true">

                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="editroom{{$room->id}}Label">Cập nhật</h1>
                                            </div>
                                            <div class="card-body">
                                                <div class="error">
                                                    @include('admin.error')
                                                </div>
                                                <form id="form_rooms_update-{{$room->id}}" data-id="{{$room->id}}" class="form-edit" method='POST' action='{{route('rooms.update', ['room' => $room])}}' enctype="multipart/form-data">
                                                    @method('PATCH')
                                                    @csrf
                                                    <div class='mb-3'>
                                                        <label
                                                            class='form-label'for='basic-default-fullname'
                                                        >Tên phòng máy</label>
                                                        <input
                                                            type='text'
                                                            class='form-control input-field'
                                                            id='name_edit-{{$room->id}}'
                                                            placeholder='Input Name'
                                                            name='name' data-require='Mời nhập tên'
                                                            value="{{$room->r_name}}"
                                                        />
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label class='form-label'
                                                               for='basic-default-email'>Tầng học</label>
                                                        <select name="floor_id" class="form-control" id="floor_id">
                                                            @if($room->r_floor_id != null)
                                                                <option value="{{ $room->r_floor_id }}">{{ $room->floor->f_name }}</option>
                                                            @else
                                                            <option value="">Chọn tầng học</option>
                                                            @endif
                                                            @foreach($floors as $floor)
                                                                <option value="{{ $floor->id }}">{{ $floor->f_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    {{-- <div class="icheck-primary">
                                                        <input {{ $room->avtive == 1 ? 'checked' : '' }} name="active" type="checkbox" id="check{{$room->id}}">
                                                        <label class="form-check-label mb-10" for="check{{$room->id}}">Active</label> 
                                                    </div> --}}

                                                    <div class="form-check">
                                                        @if($room->r_active == 1)
                                                            <input checked name="active" type="checkbox" class="form-check-input" id="">
                                                        @else
                                                            <input name="active" type="checkbox" class="form-check-input" id="">
                                                        @endif
                                                        <label class="form-check-label" for="">Hoạt động</label>
                                                    </div>
                                            
    
                                                    <div class="modal-footer">
                                                                <div class="col-sm-12 col-md-6 m-0">
                                                                <button type='submit' class='btn btn-block btn-success'>Cập nhật</button>
                                                            </div>
                                                            <div class="col-sm-12 col-md-6 m-0">
                                                                <button type="button" class="btn btn-secondary btn-block" data-dismiss="modal">Đóng</button>
                                                            </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Modal Delete --}}
                                <div class="modal fade" id="deleteModal{{$room->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" role="dialog" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h1 class="modal-title fs-5" id="deleteModalLabel">Bạn có chắc chắn xóa bản ghi này vĩnh viễn không ?</h1>
                                          </div>
                                          <div class="modal-footer">
                                              <form action="{{ route('rooms.destroy', ['room' => $room]) }}" method="POST">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
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