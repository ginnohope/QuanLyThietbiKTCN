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
                                        <button type="button" data-id="" class="btn btn-primary me-2 px-2 py-1 fw-bolder" data-toggle="modal" data-target="#createproduct">Thêm mới</button>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <form method="GET" action="{{route('productSearch')}}">
                                        <div class="d-flex jmb-10">
                                            <div class="col-sm-4">
                                                <input type="text" name="search" class="form-control" id="searchInput" placeholder="Nhập tên sản phẩm hoặc mã">
                                            </div>
                                            <div class="d-flex">
                                                <button type="submit" class="btn btn-primary mr-2">Tìm kiếm</button>
                                                <button type="button" class="btn btn-secondary ml-2" onclick="reset()"><i class="fa-solid fa-rotate-right"></i> Reset</button>
                                            </div>
                                        </form>    
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="deleteModalAll" tabindex="-1" aria-labelledby="deleteModalAllLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="deleteModalLabel">Bạn có chắc chắn xóa tất cả bản ghi không ?</h1>
                                        </div>
                                        <form action="{{route('deleteAllProducts')}}" method="post" class="modal-footer">
                                            @csrf
                                            <button class="delete-forever btn btn-danger fw-bolder">Xóa</button>
                                            <button type="button" class="btn btn-secondary fw-bolder" data-dismiss="modal">Đóng</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- modal create --}}
                            <div class="modal fade" id="createproduct" tabindex="-1" aria-labelledby="createproductLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h3 class="modal-title fs-5" id="createproductLabel">Thêm mới sản phẩm</h3>
                                        </div>
                                        <div class="card-body">
                                            <form id="form_product_store" class="form-create" method='POST' action='{{route('products.store')}}' enctype="multipart/form-data">
                                                @csrf
                                                <div class='mb-3'>
                                                    <label
                                                        class='form-label'
                                                        for='basic-default-fullname'
                                                    >Tên sản phẩm</label>
                                                    <input
                                                        type='text'
                                                        class='form-control input-field'
                                                        id='name_store'
                                                        placeholder='Nhập tên sản phẩm'
                                                        name='name' data-require='Mời nhập tên sản phẩm'
                                                    />
                                                    @error('name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class='mb-3'>
                                                    <label
                                                        class='form-label'
                                                        for='basic-default-company'
                                                    >Mã sản phẩm</label>
                                                    <input
                                                        type='text'
                                                        class='form-control input-field'
                                                        id='code_store'
                                                        placeholder='Nhập mã sản phẩm'
                                                        name='code' data-require='Mời nhập code'
                                                    />
                                                    @error('code')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class='mb-3'>
                                                    <label
                                                        class='form-label'
                                                        for='basic-default-company'
                                                    >Giá tiền</label>
                                                    <input
                                                        type='text'
                                                        class='form-control input-field'
                                                        id='price_store'
                                                        placeholder='Nhập giá tiền'
                                                        name='price' data-require='Mời nhập giá tiền'
                                                    />
                                                    @error('price')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group mb-3">
                                                    <label class='form-label'
                                                           for='basic-default-email'>Loại sản phẩm</label>
                                                    <select name="cate_id" class="form-control" id="cate_id">
                                                        <option value="">Chọn Loại</option>
                                                        @foreach($cates as $cate)
                                                            <option value="{{ $cate->id }}">{{ $cate->c_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class='mb-3'>
                                                    <label
                                                        class='form-label'
                                                        for='basic-default-company'
                                                    >Hình ảnh</label>
                                                    <div id="image-gallery">
                                                        <input type="file" name="images" class="file-input" id="file-input-form_product_store" multiple onchange="previewImages(event, 'form_productAdmin_store')">
                                                        <div id="image-preview"></div>
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
                                            <th>Hình ảnh</th>
                                            <th>Mã sản phẩm</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Danh mục</th>
                                            <th>Giá</th>
                                            <th style="width:150px"></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 1 ?>
                                        @foreach($products as $product)
                                            <tr class="odd">
                                                <td><?php  echo $i++?></td>
                                                <td>
                                                    <img width="100" src="{{ asset('storage/images/products/'. $product->p_image) }}" alt="Avatar">
                                                </td>
                                                <td>{{$product->p_code}}</td>
                                                <td>{{$product->p_name}}</td>
                                                <td>{{$product->category->c_name}}</td>
                                                <td>{!! number_format($product->p_price,0,",",".") !!} vnđ</td>
                                               
                                                <td>
                                                    <button type="button" data-id="{{$product->id}}" class="btn btn-edit btn-info btnEditproduct px-2 py-1 fw-bolder" data-toggle="modal" data-target="#editproduct{{$product->id}}"><i class="fa-solid fa-pen-to-square"></i></button>
                                                    <button type="button" data-url="/admin/products/{{$product->id}}" data-id="{{$product->id}}" class="btn btn-danger btnDeleteAsk px-2 py-1 fw-bolder" data-toggle="modal" data-target="#deleteModal{{$product->id}}"><i class="fa-solid fa-trash"></i></button>
                                                </td>

                                                {{-- Modal Delete --}}
                                                <div class="modal fade" id="deleteModal{{$product->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h4 class="modal-title fs-5" id="deleteModalLabel">Bạn có chắc chắn xóa bản ghi này vĩnh viễn không ?</h4>
                                                            </div>
                                                            <ul>
                                                                <li><strong>Mã sản phẩm: </strong>{{$product->p_code}}</li>
                                                                <li><strong>Tên sản phẩm: </strong>{{$product->p_name}}</li>
                                                                <li><strong>Thuộc loại: </strong>{{$product->category->c_name}}</li>
                                                            </ul>
                                                            <div class="modal-footer">
                                                                <form action="{{ route('products.destroy', ['product' => $product]) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="delete-forever btn btn-danger" data-id="{{ $product->id }}">Xóa</button>
                        
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
                                    @foreach($products as $product)
                                        <div class="modal fade" id="editproduct{{$product->id}}" tabindex="-1" aria-labelledby="editproduct{{$product->id}}Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="createproductLabel">Chỉnh sửa sản phẩm</h1>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="error">
                                                            @include('admin.error')
                                                        </div>
                                                        <form id="form_products_update-{{$product->id}}" data-id="{{$product->id}}" class="form-product form-edit" method='POST' action='{{route('products.update', ['product' => $product])}}' enctype="multipart/form-data">
                                                            @method('PATCH')
                                                            @csrf
                                                            <div class='mb-3'>
                                                                <label
                                                                    class='form-label'
                                                                    for='basic-default-fullname'
                                                                >Tên sản phẩm</label>
                                                                <input
                                                                    type='text'
                                                                    class='form-control input-field'
                                                                    id='name_update-{{$product->id}}'
                                                                    placeholder='Input Name'
                                                                    name='name' data-require='Mời nhập tên sản phẩm'
                                                                    value="{{$product->p_name}}"
                                                                />
                                                            </div>
                                                            <div class='mb-3'>
                                                                <label
                                                                    class='form-label'
                                                                    for='basic-default-company'
                                                                >code</label>
                                                                <input
                                                                    type='text'
                                                                    class='form-control input-field'
                                                                    id='code_update-{{$product->id}}'
                                                                    placeholder='Input code'
                                                                    name='code' data-require='Mời nhập code'
                                                                    value="{{$product->p_code}}"
                                                                />
                                                            </div>
                                                            <div class='mb-3'>
                                                                <label
                                                                    class='form-label'
                                                                    for='basic-default-company'
                                                                >Giá tiền</label>
                                                                <input
                                                                    type='text'
                                                                    class='form-control input-field'
                                                                    id='price_update-{{$product->id}}'
                                                                    placeholder='Input price'
                                                                    name='price' data-require='Mời nhập giá tiền'
                                                                    value="{{$product->p_price}}"
                                                                />
                                                            </div>
                                                            {{-- <div class='mb-3'>
                                                                <label
                                                                    class='form-label'
                                                                    for='basic-default-company'
                                                                ></label>
                                                                <input
                                                                    type='hidden'
                                                                    class='form-control input-field'
                                                                    id='user_update-{{$product->id}}'
                                                                    placeholder='Input user'
                                                                    name='user_id'
                                                                    value='{{auth()->id()}}'
                                                                />
                                                            </div> --}}
                                                            <div class="form-group mb-3">
                                                                <label class='form-label'
                                                                       for='basic-default-email'>Loại sản phẩm</label>
                                                                <select name="cate_id" class="form-control" id="cate_id">
                                                                  @if($product->p_category_id != null)
                                                                    <option value="{{ $product->category->id }}">{{ $product->category->c_name }}</option>
                                                                  @else
                                                                    <option value="">Chọn Loại</option>
                                                                  @endif
                                                                    @foreach($cates as $cate)
                                                                        <option value="{{ $cate->id }}">{{ $cate->c_name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class='mb-3'>
                                                                <label
                                                                    class='form-label'
                                                                    for='basic-default-company'
                                                                >Hình ảnh</label>
                                                                <div id="image-gallery">
                                                                    <input type="file" name="images" class="file-input" id="file-input-form_product_update" multiple onchange="previewImages(event, 'form_product_store')">
                                                                    <div id="image-preview"></div>
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
                                        {{ $products->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
@endsection