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
                                {{-- <div class="col-sm-12 col-md-10">
                                </div> --}}
                                <div class="col-sm-12 col-md-2">
                                    <div class="d-flex justify-content-between mb-10">
                                        <button type="button" data-id="" class="btn btn-primary me-2 px-2 py-1 fw-bolder" data-toggle="modal" data-target="#createfloor">Thêm mới</button>
                                        {{-- <button type="button"class="btn btn-danger me-2 px-2 py-1 fw-bolder" data-toggle="modal" data-target="#deleteModalAll">Xóa tất cả</button> --}}
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="modal fade" id="deleteModalAll" tabindex="-1" aria-labelledby="deleteModalAllLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title fs-5" id="deleteModalLabel">Bạn có chắc chắn xóa tất cả bản ghi không ?</h3>
                                        </div>
                                        <form action="{{route('deleteAllFloors')}}" method="post" class="modal-footer">
                                            @csrf
                                            <button class="delete-forever btn btn-danger fw-bolder">Xóa</button>
                                            <button type="button" class="btn btn-secondary fw-bolder" data-dismiss="modal">Đóng</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- Create modal --}}
                            <div class="modal fade" id="createfloor" tabindex="-1" aria-labelledby="createfloorLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title fs-5" id="createfloorLabel">Thêm mới khu vực</h3>
                                        </div>
                                        <div class="card-body">
                                            <form id="form_createfloor_store" class="form-create" method='POST' action='{{route('floors.store')}}' enctype="multipart/form-data">
                                                @csrf
                                                <div class='mb-3'>
                                                    <label
                                                        class='form-label'
                                                        for='basic-default-fullname'
                                                    >Tên khu vực</label>
                                                    <input
                                                        type='text'
                                                        class='form-control input-field'
                                                        id='name_store'
                                                        placeholder='Nhập tên khu vực'
                                                        name='name' data-require='Mời nhập tên khu vực'
                                                    />
                                                    @error('name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>

                                                <div class="modal-footer">
                                                    <div class="col-sm-12 col-md-6 m-0">
                                                        <button type='submit' class='btn btn-block btn-primary'>Thêm mới</button>
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
                                            <th>Tên khu vực</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1 ?>
                                        @foreach($floors as $floor)
                                            <tr class="odd">
                                                <td><?php echo $i++?></td>
                                                <td>{{$floor->f_name}}</td>
                                                <td>
                                                    <button type="button" data-id="{{$floor->id}}" class="btn btn-edit btn-info btnEditfloor px-2 py-1 fw-bolder" data-toggle="modal" data-target="#editfloor{{$floor->id}}"><i class="fa-solid fa-pen-to-square"></i></button>
                                                    <button type="button" data-url="/admin/floors/{{$floor->id}}" data-id="{{$floor->id}}" class="btn btn-danger btnDeleteAsk px-2 py-1 fw-bolder" data-toggle="modal" data-target="#deleteModal{{$floor->id}}"><i class="fa-solid fa-trash"></i></button>
                                                </td>

                                                {{-- Modal Delete --}}
                                                <div class="modal fade" id="deleteModal{{$floor->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h3 class="modal-title fs-5" id="deleteModalLabel">Bạn có chắc chắn xóa bản ghi này vĩnh viễn không ?</h3>
                                                            </div>
                                                            <ul class="mt-2">
                                                                <li><strong>Tên khu vực: </strong>{{ $floor->f_name }}</li>
                                                            </ul>
                                                            <div class="modal-footer">
                                                                <form action="{{ route('floors.destroy', ['floor' => $floor]) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="delete-forever btn btn-danger" data-id="{{ $floor->id }}">Xóa</button>
                        
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
                                    @foreach($floors as $floor)
                                        <div class="modal fade" id="editfloor{{$floor->id}}" tabindex="-1" aria-labelledby="editfloor{{$floor->id}}Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h2 class="modal-title fs-5" id="editfloor{{$floor->id}}Label">Cập nhật khu vực</h2>
                                                    </div>
                                                    <div class="card-body">
                                                        <form id="form_floors_update-{{$floor->id}}" data-id="{{$floor->id}}" class="form-edit" method='POST' action='{{route('floors.update', ['floor' => $floor])}}' enctype="multipart/form-data">
                                                            @method('PATCH')
                                                            @csrf
                                                            <div class='mb-3'>
                                                                <label
                                                                    class='form-label'
                                                                    for='basic-default-fullname'
                                                                >Tên khu vực</label>
                                                                <input
                                                                    type='text'
                                                                    class='form-control input-field'
                                                                    id='name_edit-{{$floor->id}}'
                                                                    placeholder='Nhập tên khu vực'
                                                                    name='name' data-require='Mời nhập tên'
                                                                    value="{{$floor->f_name}}"
                                                                />
                                                                @error('name')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
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
                                        {{ $floors->links() }}
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
    <!-- /.container-fluid -->
@endsection