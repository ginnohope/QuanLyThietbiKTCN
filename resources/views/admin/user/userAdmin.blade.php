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
                                <div class="col-sm-12 col-md-10">
                                    
                                </div>
                                <div class="col-sm-12 col-md-2">
                                    <div class="d-flex p-4 justify-content-between">
                                        <button type="button" data-id="" class="btn btn-block btn-primary" data-toggle="modal" data-target="#createUser">Thêm mới</button>
                                    </div>
                                    
                                </div>
                            </div>

                            <div class="modal fade" id="createUser" tabindex="-1" aria-labelledby="createUserLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title fs-5" id="createUserLabel">Thêm mới tài khoản quản trị</h3>
                                        </div>
                                        <div class="card-body">
                                            {{-- <div class="error">
                                                @include('admin.error')
                                            </div> --}}
                                            <form id="form_userAdmin_store" class="form-create" method='POST' action='{{route('user.store')}}' enctype="multipart/form-data">
                                                @csrf
                                                <div class='mb-3'>
                                                    <label
                                                        class='form-label'
                                                        for='basic-default-fullname'
                                                    >Họ tên</label>
                                                    <input
                                                        type='text'
                                                        class='form-control input-field'
                                                        id='name'
                                                        placeholder='Nhập họ tên'
                                                        name='name' data-require='Mời nhập tên'
                                                    />
                                                    @error('name')
                                                        <div class="text-danger mt-0">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class='mb-3'>
                                                    <label
                                                        class='form-label'
                                                        for='basic-default-company'
                                                    >Email</label>
                                                    <input
                                                        type='email'
                                                        class='form-control input-field'
                                                        id='email'
                                                        placeholder='Nhập email'
                                                        name='email' data-require='Mời nhập email'
                                                    />
                                                    @error('email')
                                                        <div class="text-danger mt-0">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class='mb-3'>
                                                    <label
                                                        class='form-label'
                                                        for='basic-default-email'
                                                    >Mật khẩu</label>
                                                        <input
                                                            type='password'
                                                            id='password'
                                                            class='form-control input-field'
                                                            placeholder='Nhập mật khẩu (nếu thay đổi)'
                                                            name='password' data-require='Mời nhập mật khẩu'
                                                        />
                                                        @error('password')
                                                            <div class="text-danger mt-0">{{ $message }}</div>
                                                        @enderror
                                                </div>
                                                <div class='mb-3 d-flex justify-content-between'>
                                                    <div class='mb-3 me-3'>
                                                        <label
                                                            class='form-label'
                                                            for='basic-default-email'
                                                        >Cấp tài khoản</label>
                                                            <input
                                                                type='number'
                                                                id='level'
                                                                class='form-control'
                                                                min='0'
                                                                name='level'
                                                            />
                                                        @error('level')
                                                            <div class="text-danger mt-0">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class='mb-3 me-3'>
                                                        <label
                                                            class='form-label'
                                                            for='basic-default-email'
                                                        >Chức danh</label>
                                                            <input
                                                                type='text'
                                                                id='role'
                                                                class='form-control input-field'
                                                                min='0'
                                                                placeholder="Nhập chức danh"
                                                                name='role' data-require='Mời nhập quyền'
                                                            />
                                                        @error('role')
                                                            <div class="text-danger mt-0">{{ $message }}</div>
                                                        @enderror
                                                    </div>
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
                                            <th>Họ tên</th>
                                            <th>Email</th>
                                            <th>Chức danh</th>
                                            <th>Ngày tạo</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1 ?>
                                        @foreach($users as $user)
                                            <tr class="odd">
                                                <td><?php echo $i++?></td>
                                                <td>{{$user->name}}</td>
                                                <td>{{$user->email}}</td>
                                                <td>{{$user->role}}</td>
                                                <td>{{ date('d/m/Y', strtotime($user->created_at)) }}</td>
                                                <td>
                                                    <button type="button" data-id="{{$user->id}}" class="btn btn-edit btn-info btnEditUser px-2 py-1 fw-bolder" data-toggle="modal" data-target="#editUser{{$user->id}}"><i class="fa-solid fa-pen-to-square"></i></button>
                                                    <button type="button" data-url="/admin/users/{{$user->id}}" data-id="{{$user->id}}" class="btn btn-danger btnDeleteAsk px-2 py-1 fw-bolder" data-toggle="modal" data-target="#deleteModal{{$user->id}}"><i class="fa-solid fa-trash"></i></button>
                                                </td>

                                                <div class="modal fade" id="deleteModal{{$user->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title fs-5" id="deleteModalLabel">Bạn có chắc chắn xóa bản ghi này vĩnh viễn không ?</h4>
                                                            </div>
                                                            <ul>
                                                                <li><strong>Họ tên:</strong> {{$user->name}}</li>
                                                                <li><strong>Email:</strong> {{$user->email}}</li>
                                                                <li><strong>Chức danh:</strong> {{$user->role}}</li>
                                                            </ul>
                                                            <div class="modal-footer">
                                                                <form action="{{ route('user.destroy', ['id' => $user->id]) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="delete-forever btn btn-danger" data-id="{{ $user->id }}">Xóa</button>
                        
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
                                    @foreach($users as $user)
                                        <div class="modal fade" id="editUser{{$user->id}}" tabindex="-1" aria-labelledby="editUser{{$user->id}}Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title fs-5" id="createUserLabel">Chỉnh sửa tài khoản</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        {{-- <div class="error">
                                                            @include('admin.error')
                                                        </div> --}}
                                                        <form id="form_userAdmin_store" class="editUserForm form-edit" method='POST' action='{{route('user.update', ['user' => $user])}}' enctype="multipart/form-data" id="form_userAdmin_update-{{$user->id}}">
                                                            @method('PATCH')
                                                            @csrf
                                                            <div class='mb-3'>
                                                                <label
                                                                    class='form-label'
                                                                    for='basic-default-fullname'
                                                                >Họ tên</label>
                                                                <input
                                                                    type='text'
                                                                    class='form-control input-field'
                                                                    id='name-{{$user->id}}'
                                                                    value="{{$user->name}}"
                                                                    placeholder='Nhập họ tên'
                                                                    name='name' data-require='Mời nhập tên'
                                                                />
                                                                @error('name')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class='mb-3'>
                                                                <label
                                                                    class='form-label'
                                                                    for='basic-default-company'
                                                                >Email</label>
                                                                <input
                                                                    type='email'
                                                                    class='form-control input-field'
                                                                    id='email-{{$user->id}}'
                                                                    value="{{$user->email}}"
                                                                    placeholder='Nhập Email'
                                                                    name='email' data-require='Mời nhập email'
                                                                />
                                                                @error('email')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class='mb-3'>
                                                                <label
                                                                    class='form-label'
                                                                    for='basic-default-email'
                                                                >Mật khẩu</label>
                                                                    <input
                                                                        type='password'
                                                                        id='password-{{$user->id}}'
                                                                        class='form-control input-field'
                                                                        placeholder='Nhập mật khẩu'
                                                                        name='password'
                                                                        value=""
                                                                    />
                                                            </div>
                                                            <div class='mb-3 d-flex justify-content-between'>
                                                                <div class='mb-3 me-3'>
                                                                    <label
                                                                        class='form-label'
                                                                        for='basic-default-email'
                                                                    >Cấp tài khoản</label>
                                                                        <input
                                                                            type='number'
                                                                            id='level-{{$user->id}}'
                                                                            value="{{$user->level}}"
                                                                            class='form-control'
                                                                            min='0'
                                                                            name='level'
                                                                        />
                                                                    @error('level')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                                <div class='mb-3 me-3'>
                                                                    <label
                                                                        class='form-label'
                                                                        for='basic-default-email'
                                                                    >Chức danh</label>
                                                                        <input
                                                                            type='text'
                                                                            id='role-{{$user->id}}'
                                                                            value="{{$user->role}}"
                                                                            class='form-control input-field'
                                                                            placeholder="Nhập chức danh"
                                                                            min='0'
                                                                            name='role' data-require='Mời nhập quyền'
                                                                        />
                                                                        @error('role')
                                                                                <div class="text-danger">{{ $message }}</div>
                                                                        @enderror
                                                                </div>
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
                                        {{ $users->links() }}
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