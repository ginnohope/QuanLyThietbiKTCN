{{-- Create modal --}}
<div class="modal fade" id="createroom" tabindex="-1" aria-labelledby="createroomLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createroomLabel">Thêm mới</h1>
            </div>
            <div class="card-body">
                <div class="error">
                    @include('admin.error')
                </div>
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
                    <div class="custom-control custom-checkbox">
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
                        <a href="{{ route('in-kiem-ke', ['id' => $room->id]) }}" class="btn btn-primary px-2 py-1 fw-bolder"><i class="fa-solid fa-print"></i></a>
                    </td>

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
        @endforeach

        {{-- <div class="pagination mt-4 pb-4">
            {{ $rooms->links() }}
        </div> --}}