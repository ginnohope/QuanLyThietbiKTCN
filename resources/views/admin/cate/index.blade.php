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
                                        <button type="button" data-id="" class="btn btn-primary me-2 px-2 py-1 fw-bolder" data-toggle="modal" data-target="#createcate">Thêm mới</button>
                                        {{-- <button type="button"class="btn btn-danger me-2 px-2 py-1 fw-bolder" data-toggle="modal" data-target="#deleteModalAll">Xóa tất cả</button> --}}
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="modal fade" id="deleteModalAll" tabindex="-1" aria-labelledby="deleteModalAllLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleteModalLabel">Bạn có chắc chắn xóa tất cả bản ghi không ?</h1>
                                        </div>
                                        <form action="{{route('deleteAllcates')}}" method="post" class="modal-footer">
                                            @csrf
                                            <button class="delete-forever btn btn-danger fw-bolder">Xóa</button>
                                            <button type="button" class="btn btn-secondary fw-bolder" data-dismiss="modal">Đóng</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- Create modal --}}
                            <div class="modal fade" id="createcate" tabindex="-1" aria-labelledby="createcateLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title fs-5" id="createcateLabel">Thêm mới danh mục</h3>
                                        </div>
                                        <div class="card-body">
                                            <form id="form_createCate_store" class="form-create" method='POST' action='{{route('cates.store')}}' enctype="multipart/form-data">
                                                @csrf
                                                <div class='mb-3'>
                                                    <label
                                                        class='form-label'
                                                        for='basic-default-fullname'
                                                    >Tên danh mục</label>
                                                    <input
                                                        type='text'
                                                        class='form-control input-field'
                                                        id='name_store'
                                                        placeholder='Nhập tên danh mục'
                                                        name='name' data-require='Mời nhập tên'
                                                    />
                                                    @error('name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class='form-label'
                                                           for='basic-default-email'>Danh mục</label>
                                                    <select name="parent_id" class="form-control" id="parent_id">
                                                        <option value="">Chọn danh mục cha</option>
                                                        @foreach($cates as $cate)
                                                            <option value="{{ $cate->id }}">{{ $cate->id }}-{{ $cate->c_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="custom-control custom-checkbox mb-2">
                                                    <input class="custom-control-input" name="active" type="checkbox" id="customCheckbox1" value="option1">
                                                    <label for="customCheckbox1" class="custom-control-label">Hoạt động</label>
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
                                            <th>Tên danh mục</th>
                                            <th>Trạng thái</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1 ?>
                                        @foreach($cates as $cate)
                                            <tr class="odd">
                                                <td><?php echo $i++?></td>
                                                <td>{{$cate->c_name}}</td>
                                                <td>
                                                    @if($cate->avtive == true)
                                                       <div class="d-flex align-items-center fw-bold">
                                                           <p class="circle-active bg-success rounded-circle"></p>
                                                           <p class="ms-2 badge bg-primary">Hoạt động</p>
                                                       </div>
                                                    @else
                                                        <div class="d-flex align-items-center fw-bold">
                                                            <p class="circle-active bg-danger rounded-circle"></p>
                                                            <p class="ms-2 badge bg-danger">Không hoạt động</p>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td>
                                                    <button type="button" data-id="{{$cate->id}}" class="btn btn-edit btn-info btnEditcate px-2 py-1 fw-bolder" data-toggle="modal" data-target="#editcate{{$cate->id}}"><i class="fa-solid fa-pen-to-square"></i></button>
                                                    <button type="button" data-url="/admin/cates/{{$cate->id}}" data-id="{{$cate->id}}" class="btn btn-danger btnDeleteAsk px-2 py-1 fw-bolder" data-toggle="modal" data-target="#deleteModal{{$cate->id}}"><i class="fa-solid fa-trash"></i></button>
                                                </td>

                                                {{-- Modal Delete --}}
                                                <div class="modal fade" id="deleteModal{{$cate->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h3 class="modal-title fs-5" id="deleteModalLabel">Bạn có chắc chắn xóa bản ghi này vĩnh viễn không ?</h3>
                                                            </div>
                                                            <ul>
                                                                <li><strong>Tên danh mục:</strong> {{$cate->c_name}}</li>
                                                                @if($cate->avtive == true)
                                                                    <li><strong>Trạng thái:</strong> <p class="ms-2 badge bg-primary">Hoạt động</p></li>
                                                                @else
                                                                    <li><strong>Trạng thái:</strong> <p class="ms-2 badge bg-danger">Không hoạt động</p></li>
                                                                @endif
                                                            </ul>
                                                            <div class="modal-footer">
                                                                <form action="{{ route('cates.destroy', ['cate' => $cate]) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="delete-forever btn btn-danger" data-id="{{ $cate->id }}">Xóa</button>
                        
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
                                    @foreach($cates as $cate)
                                    <div class="modal fade" id="editcate{{$cate->id}}" tabindex="-1" aria-labelledby="editcate{{$cate->id}}Label" aria-hidden="true">

                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h3 class="modal-title fs-5" id="editcate{{$cate->id}}Label">Cập nhật danh mục</h3>
                                                </div>
                                                <div class="card-body">
                                                    <form id="form_cates_update-{{$cate->id}}" data-id="{{$cate->id}}" class="form-edit" method='POST' action='{{route('cates.update', ['cate' => $cate])}}' enctype="multipart/form-data">
                                                        @method('PATCH')
                                                        @csrf
                                                        <div class='mb-3'>
                                                            <label
                                                                class='form-label'
                                                                for='basic-default-fullname'
                                                            >Tên danh mục</label>
                                                            <input
                                                                type='text'
                                                                class='form-control input-field'
                                                                id='name_edit-{{$cate->id}}'
                                                                placeholder='Input Name'
                                                                name='name' data-require='Mời nhập tên'
                                                                value="{{$cate->c_name}}"
                                                            />
                                                            @error('name')
                                                                <div class="text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group mb-3">
                                                            <label class='form-label'
                                                                   for='basic-default-email'>Danh mục</label>
                                                            <select name="parent_id" class="form-control" id="parent_id">
                                                                @if($cate->c_parent_id != null)
                                                                    <option value="{{ $cate->parent->id }}">{{ $cate->parent->id }}-{{ $cate->parent->c_name }}</option>
                                                                @else
                                                                <option value="">Chọn danh mục cha</option>
                                                                @endif
                                                                @foreach($cates as $cate)
                                                                    <option value="{{ $cate->id }}">{{ $cate->id }}-{{ $cate->c_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="form-check mb-2">
                                                            @if($cate->avtive == 1)
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
                                        {{ $cates->links() }}
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