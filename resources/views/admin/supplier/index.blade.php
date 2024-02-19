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
                                        <button type="button" data-id="" class="btn btn-primary me-2 px-2 py-1 fw-bolder" data-toggle="modal" data-target="#createsupplier">Thêm mới</button>
                                        {{-- <button type="button"class="btn btn-danger me-2 px-2 py-1 fw-bolder" data-toggle="modal" data-target="#deleteModalAll">Xóa tất cả</button> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="deleteModalAll" tabindex="-1" aria-labelledby="deleteModalAllLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title fs-5" id="deleteModalLabel">Bạn có chắc chắn xóa tất cả bản ghi không ?</h4>
                                        </div>

                                        <form action="{{route('deleteAllSuppliers')}}" method="post" class="modal-footer">
                                            @csrf
                                            <button class="delete-forever btn btn-danger fw-bolder">Xóa</button>
                                            <button type="button" class="btn btn-secondary fw-bolder" data-dismiss="modal">Đóng</button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="createsupplier" tabindex="-1" aria-labelledby="createsupplierLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title fs-5" id="createsupplierLabel">Thêm mới nhà cung cấp</h4>
                                        </div>
                                        <div class="card-body">
                                            {{-- <div class="error">
                                                @include('admin.error')
                                            </div> --}}
                                            <form id="form_supplierAdmin_store" class="form-create" method='POST' action='{{route('suppliers.store')}}' enctype="multipart/form-data">
                                                @csrf
                                                <div class='mb-3'>
                                                    <label
                                                        class='form-label'
                                                        for='basic-default-fullname'
                                                    >Tên nhà cung cấp</label>
                                                    <input
                                                        type='text'
                                                        class='form-control input-field'
                                                        id='name_store'
                                                        placeholder='Nhập tên nhà cung cấp'
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
                                                        id='email_store'
                                                        placeholder='Nhập email'
                                                        name='email' data-require='Mời nhập email'
                                                    />
                                                    @error('email')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class='mb-3 d-flex justify-content-between'>
                                                    <div class='mb-3 ms-2'>
                                                        <label
                                                            class='form-label'
                                                            for='basic-default-company'
                                                        >Điện thoại</label>
                                                        <input
                                                            type='text'
                                                            class='form-control input-field'
                                                            id='phone_store'
                                                            placeholder='Nhập số điện thoại'
                                                            name='phone' data-require='Mời nhập só điện thoại'
                                                        />
                                                        @error('phone')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                    <div class='mb-3 ms-2'>
                                                        <label
                                                            class='form-label'
                                                            for='basic-default-company'
                                                        >Mã thuế</label>
                                                        <input
                                                            type='text'
                                                            class='form-control input-field'
                                                            id='tax_store'
                                                            placeholder='Input tax'
                                                            name='tax' data-require='Mời nhập mã thuế'
                                                        />
                                                        @error('tax')
                                                            <div class="text-danger">{{ $message }}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class='mb-3'>
                                                    <label
                                                        class='form-label'
                                                        for='basic-default-company'
                                                    >Địa chỉ</label>
                                                    <input
                                                        type='text'
                                                        class='form-control input-field'
                                                        id='address_store'
                                                        placeholder='Input address'
                                                        name='address' data-require='Mời nhập address'
                                                    />
                                                    @error('address')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class='mb-3'>
                                                    <label
                                                        class='form-label'
                                                        for='basic-default-company'
                                                    >Logo</label>
                                                    <div id="image-gallery">
                                                        <input type="file" name="logo" class="file-input" id="file-input-form_supplierAdmin_store" multiple onchange="previewImages(event, 'form_supplierAdmin_store')">
                                                        <div id="image-preview"></div>
                                                    </div>
                                                </div>
                                                <div class='mb-3 d-flex justify-content-between'>
                                                    <div class='mb-3 me-2'>
                                                        <label
                                                            class='form-label'
                                                            for='basic-default-company'
                                                        >Số tài khoản</label>
                                                        <input
                                                            type='text'
                                                            class='form-control input-field'
                                                            id='Account-number_store'
                                                            placeholder='Nhập số tài khoản'
                                                            name='accountNumber'
                                                        />
                                                    </div>
                                                    <div class='mb-3 me-2'>
                                                        <label
                                                            class='form-label'
                                                            for='basic-default-company'
                                                        >Ngân hàng</label>
                                                        <input
                                                            type='text'
                                                            class='form-control input-field'
                                                            id='bank_store'
                                                            placeholder='Nhập tên ngân hàng'
                                                            name='nameBank'
                                                        />
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
                                            <th>Logo</th>
                                            <th>Tên nhà cung cấp</th>
                                            <th>Email</th>
                                            <th>Số điện thoại</th>
                                            <th>Mã thuế</th>
                                            <th>Địa chỉ</th>
                                            <th style="width:100px"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1 ?>
                                        @foreach($suppliers as $supplier)
                                            <tr class="odd">
                                                <td><?php echo $i++?></td>
                                                <td>
                                                    <img width="100" src="{{ asset('storage/images/logos/'. $supplier->s_logo) }}" alt="Avatar">
                                                </td>
                                                <td>{{$supplier->s_name}}</td>
                                                <td>{{$supplier->s_email}}</td>
                                                <td>{{$supplier->s_phone}}</td>
                                                <td>{{$supplier->s_tax}}</td>
                                                <td>{{$supplier->s_address}}</td>
                                                <td>
                                                    <button type="button" data-id="{{$supplier->id}}" class="btn btn-edit btn-info btnEditsupplier px-2 py-1 fw-bolder" data-toggle="modal" data-target="#editsupplier{{$supplier->id}}"><i class="fa-solid fa-pen-to-square"></i></button>
                                                    <button type="button" data-url="/admin/suppliers/{{$supplier->id}}" data-id="{{$supplier->id}}" class="btn btn-danger btnDeleteAsk px-2 py-1 fw-bolder" data-toggle="modal" data-target="#deleteModal{{$supplier->id}}"><i class="fa-solid fa-trash"></i></button>
                                                </td>

                                                {{-- Modal Delete --}}
                                                <div class="modal fade" id="deleteModal{{$supplier->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title fs-5" id="deleteModalLabel">Bạn có chắc chắn xóa bản ghi này vĩnh viễn không ?</h4>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <ul>
                                                                    <li><strong>Tên nhà cung cấp:</strong> {{$supplier->s_name}}</li>
                                                                    <li><strong>Email:</strong> {{$supplier->s_email}}</li>
                                                                    <li><strong>Số điện thoại</strong> {{$supplier->s_phone}}</li>
                                                                </ul>
                                                                <form action="{{ route('suppliers.destroy', ['supplier' => $supplier]) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="delete-forever btn btn-danger" data-id="{{ $supplier->id }}">Xóa</button>
                        
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
                                    @foreach($suppliers as $supplier)
                                        <div class="modal fade" id="editsupplier{{$supplier->id}}" tabindex="-1" aria-labelledby="editsupplier{{$supplier->id}}Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h3 class="modal-title fs-5" id="createsupplierLabel">Chỉnh sửa nhà cung cấp</h3>
                                                    </div>
                                                    <div class="card-body">
                                                        <form id="form_suppliers_update-{{$supplier->id}}" data-id="{{$supplier->id}}" class="form-supplier form-edit" method='POST' action='{{route('suppliers.update', ['supplier' => $supplier])}}' enctype="multipart/form-data">
                                                            @method('PATCH')
                                                            @csrf
                                                            <div class='mb-3'>
                                                                <label
                                                                    class='form-label'
                                                                    for='basic-default-fullname'
                                                                >Tên nhà cung cấp</label>
                                                                <input
                                                                    type='text'
                                                                    class='form-control input-field'
                                                                    id='name_edit-{{$supplier->id}}'
                                                                    placeholder='Nhập tên nhà cung cấp'
                                                                    name='name' data-require='Mời nhập tên'
                                                                    value="{{$supplier->s_name}}"
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
                                                                    id='email_edit-{{$supplier->id}}'
                                                                    placeholder='Nhập email'
                                                                    name='email' data-require='Mời nhập email'
                                                                    value="{{$supplier->s_email}}"
                                                                />
                                                                @error('email')
                                                                    <div class="text-danger">{{ $message }}</div>
                                                                @enderror
                                                            </div>
                                                            <div class='mb-3 d-flex justify-content-between'>
                                                                <div class='mb-3 ms-2'>
                                                                    <label
                                                                        class='form-label'
                                                                        for='basic-default-company'
                                                                    >Điện thoại</label>
                                                                    <input
                                                                        type='text'
                                                                        class='form-control input-field'
                                                                        id='phone_edit-{{$supplier->id}}'
                                                                        placeholder='Nhập số điện thoại'
                                                                        name='phone' data-require='Mời nhập só điện thoại'
                                                                        value="{{$supplier->s_phone}}"
                                                                    />
                                                                    @error('phone')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror   
                                                                </div>
                                                                <div class='mb-3 ms-2'>
                                                                    <label
                                                                        class='form-label'
                                                                        for='basic-default-company'
                                                                    >Mã thuế</label>
                                                                    <input
                                                                        type='text'
                                                                        class='form-control input-field'
                                                                        id='tax_edit-{{$supplier->id}}'
                                                                        placeholder='Nhập mã thuế'
                                                                        name='tax' data-require='Mời nhập mã thuế'
                                                                        value="{{$supplier->s_tax}}"
                                                                    />
                                                                    @error('tax')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class='mb-3'>
                                                                <label
                                                                    class='form-label'
                                                                    for='basic-default-company'
                                                                >Địa chỉ</label>
                                                                <input
                                                                    type='text'
                                                                    class='form-control input-field'
                                                                    id='address_edit-{{$supplier->id}}'
                                                                    placeholder='Input address'
                                                                    name='address' data-require='Mời nhập address'
                                                                    value="{{$supplier->s_address}}"
                                                                />
                                                                @error('address')
                                                                        <div class="text-danger">{{ $message }}</div>
                                                                    @enderror
                                                            </div>
                                                            <div class='mb-3'>
                                                                <label
                                                                    class='form-label'
                                                                    for='basic-default-company'
                                                                >Logo</label>
                                                                <div id="image-gallery">
                                                                    <input type="file" name="logo" class="file-input" id="file-input-form_supplierAdmin_store" multiple onchange="previewImages(event, {{$supplier->id}})">
                                                                    <div class="image-preview" id="image-preview-{{$supplier->id}}"></div>
                                                                </div>
                                                            </div>
                                                            <div class='mb-3 d-flex justify-content-between'>
                                                                <div class='mb-3'>
                                                                    <label
                                                                        class='form-label'
                                                                        for='basic-default-company'
                                                                    >Số tài khoản</label>
                                                                    <input
                                                                        type='text'
                                                                        class='form-control input-field'
                                                                        id='Account-number_edit-{{$supplier->id}}'
                                                                        placeholder='Nhập số tài khoản'
                                                                        name='accountNumber'
                                                                        value="{{$supplier->s_acc_number}}"
                                                                    />
                                                                </div>
                                                                <div class='mb-3'>
                                                                    <label
                                                                        class='form-label'
                                                                        for='basic-default-company'
                                                                    >Ngân hàng</label>
                                                                    <input
                                                                        type='text'
                                                                        class='form-control input-field'
                                                                        id='bank_edit-{{$supplier->id}}'
                                                                        placeholder='Nhập tên tài khoản'
                                                                        name='nameBank'
                                                                        value="{{$supplier->s_name_bank}}"
                                                                    />
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                        <div class="col-sm-12 col-md-6 m-0">
                                                                        <button type='submit' class='btn btn-block btn-success'>Chỉnh sửa</button>
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
                                        {{ $suppliers->links() }}
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