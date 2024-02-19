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
                                            <button type="button" data-id="" class="btn btn-primary me-2 px-2 py-1 fw-bolder" data-toggle="modal" data-target="#createroom">Thêm mới</button>
                                        </div>
                                        <div class="col-sm-8">
                                            <form method="GET" action="{{route('search-rooms')}}">
                                                <div class="d-flex jmb-10">
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

                            <div class="modal fade" id="deleteModalAll" tabindex="-1" aria-labelledby="deleteModalAllLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleteModalLabel">Bạn có chắc chắn xóa tất cả bản ghi không ?</h1>
                                        </div>
                                        <form action="{{route('deleteAllRooms')}}" method="post" class="modal-footer">
                                            @csrf
                                            <button class="delete-forever btn btn-danger fw-bolder">Xóa</button>
                                            <button type="button" class="btn btn-secondary fw-bolder" data-dismiss="modal">Đóng</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- Create modal --}}
                            <div class="modal fade" id="createroom" tabindex="-1" aria-labelledby="createroomLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title fs-5" id="createroomLabel">Thêm mới</h3>
                                        </div>
                                        <div class="card-body">
                                            <form id="form_createroom_store" class="form-create" method='POST' action='{{route('rooms.store')}}' enctype="multipart/form-data">
                                                @csrf
                                                <div class='mb-3'>
                                                    <label
                                                        class='form-label'
                                                        for='basic-default-fullname'
                                                    >Tên phòng máy</label>
                                                    <input
                                                        type='text'
                                                        class='form-control input-field'
                                                        id='name_store'
                                                        placeholder='Nhập tên phòng máy'
                                                        name='name' data-require='Mời nhập tên'
                                                    />
                                                    @error('name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class='form-label'for='basic-default-email'>Khu vực</label>
                                                    <select name="floor_id" class="form-control" id="floor_id">
                                                        <option value="">Chọn khu vực</option>
                                                        @foreach($floors as $floor)
                                                            <option value="{{ $floor->id }}">{{ $floor->f_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-2">
                                                    <input class="custom-control-input" name="active" type="checkbox" id="customCheckbox1" value="option1">
                                                    <label for="customCheckbox1" class="custom-control-label">Hoạt động</label>
                                                </div>
                                        
                                                <div class="modal-footer">
                                                        <div class="col-sm-12 col-md-6 m-0">
                                                            <button type='submit' class='btn btn-block btn-success'>Thêm mới</button>
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
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                                        <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Tên phòng máy</th>
                                            <th>Khu vực</th>
                                            <th>Hoạt động</th>
                                            <th>#</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1 ?>
                                        @foreach($rooms as $room)
                                            <tr class="odd">
                                                <td><?php echo $i++?></td>
                                                <td>{{$room->r_name}}</td>
                                                <td>{{$room->floor->f_name}}</td>
                                                <td>
                                                    @if($room->r_active == true)
                                                    <div class="d-flex align-items-center fw-bold">
                                                        <p class="circle-active bg-success rounded-circle"></p>
                                                        <p class="ms-2 badge bg-primary">Hoạt động</p>
                                                    </div>
                                                    @else
                                                        <div class="d-flex align-items-center fw-bold">
                                                            <p class="circle-active bg-danger rounded-circle"></p>
                                                            <p class="ms-2 badge bg-danger">Bảo trì</p>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button" data-id="{{$room->id}}" class="btn btn-edit btn-info btnEditroom px-2 py-1 fw-bolder" data-toggle="modal" data-target="#editroom{{$room->id}}"><i class="fa-solid fa-pen-to-square"></i></button>
                                                    <button type="button" data-url="/admin/rooms/{{$room->id}}" data-id="{{$room->id}}" class="btn btn-danger btnDeleteAsk px-2 py-1 fw-bolder" data-toggle="modal" data-target="#deleteModal{{$room->id}}"><i class="fa-solid fa-trash"></i></button>
                                                    <a href="{{ route('danh-sach-may', ['id' => $room->id]) }}" class="btn btn-info px-2 py-1 fw-bolder"><i class="fa-solid fa-computer"></i></a>
                                                    <a href="{{ route('MaySDCreate', ['id' => $room->id]) }}" class="btn btn-primary px-2 py-1 fw-bolder"><i class="fa-solid fa-plus"></i></a>
                                                    <a href="{{ route('in-kiem-ke', ['id' => $room->id]) }}" target="_blank" class="btn btn-primary px-2 py-1 fw-bolder"><i class="fa-solid fa-print"></i></a>
                                                    <a href="{{ route('in-nghiem-thu', ['id' => $room->id]) }}" target="_blank" class="btn btn-primary px-2 py-1 fw-bolder"><i class="fa-solid fa-print"></i></a>
                                                </td>

                                                {{-- Modal Delete --}}
                                                <div class="modal fade" id="deleteModal{{$room->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h3 class="modal-title fs-5" id="deleteModalLabel">Bạn có chắc chắn xóa bản ghi này vĩnh viễn không ?</h3>
                                                            </div>
                                                            <ul>
                                                                <li><strong>Tên phòng máy: </strong> {{ $room->r_name }}</li>
                                                                <li><strong>Tên khu vực: </strong> {{$room->floor->f_name }}</li>
                                                            </ul>
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
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>

                                        </tfoot>
                                    </table>
                                    {{-- Modal Edit --}}
                                    @foreach($rooms as $room)
                                    <div class="modal fade" id="editroom{{$room->id}}" tabindex="-1" aria-labelledby="editroom{{$room->id}}Label" aria-hidden="true">

                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title fs-5" id="editroom{{$room->id}}Label">Cập nhật phòng máy</h3>
                                                </div>
                                                <div class="card-body">
                                                    <form id="form_rooms_update-{{$room->id}}" data-id="{{$room->id}}" class="form-edit" method='POST' action='{{route('rooms.update', ['room' => $room])}}' enctype="multipart/form-data">
                                                        @method('PATCH')
                                                        @csrf
                                                        <div class='mb-3'>
                                                            <label
                                                                class='form-label'
                                                                for='basic-default-fullname'
                                                            >Tên phòng máy</label>
                                                            <input
                                                                type='text'
                                                                class='form-control input-field'
                                                                id='name_edit-{{$room->id}}'
                                                                placeholder='Input Name'
                                                                name='name' data-require='Mời nhập tên'
                                                                value="{{$room->r_name}}"
                                                            />
                                                            @error('name')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label class='form-label'
                                                                for='basic-default-email'>Khu vực</label>
                                                            <select name="floor_id" class="form-control" id="floor_id">
                                                                @if($room->r_floor_id != null)
                                                                    <option value="{{ $room->r_floor_id }}">{{ $room->floor->f_name }}</option>
                                                                @else
                                                                <option value="">Chọn khu vực</option>
                                                                @endif
                                                                @foreach($floors as $floor)
                                                                    <option value="{{ $floor->id }}">{{ $floor->f_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-check mb-2">
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
                                    @endforeach

                                    <div class="pagination mt-4 pb-4">
                                        {{ $rooms->appends(request()->all())->links() }}
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