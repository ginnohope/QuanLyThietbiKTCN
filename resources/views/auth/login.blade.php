<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.head')
</head>
<body class="hold-transition login-page">
<div class="login-box w-500">
  <div class="login-logo">
    <div class="">
      <img style="" width="200px" src="storage/images/DHV/logoDHV.png" alt="">
    </div>
    <div class="">
    <a href="#"><b>Quản lý thiết bị phòng máy viện Kỹ thuật-công nghệ</b></a>

    </div>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"></p>
        {{-- @include('admin.error') --}}
        @if(session('error'))
            <div class="text-danger mb-4 fw-semibold">
                {{ session('error') }}
          </div>
        @endif
      <form action="{{route('loginForm')}}" method="post">
        @error ('email')
          <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        @error ('password')
          <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" name="remember" id="remember">
              <label for="remember">
                Ghi nhớ
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>
          </div>
          <!-- /.col -->
        </div>
        @csrf
      </form>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="{{route('forgetPassForm')}}">Quên mật khẩu ?</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
    @include('admin.footer')
</body>
</html>
