@extends('layout.layout')
@section('content')

  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Thay đổi mật khẩu</p>
        <form action="{{ route('reset') }}" method="post">
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="input-group mb-3">
                @error('email')
                    <div>{{ $message }}</div>
                @enderror
              <input type="email" class="form-control" value="{{ $email }}" name="email" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
                @error('password')
                    <div>{{ $message }}</div>
                @enderror
              <input type="password" class="form-control" value="Mật khẩu mới" name="password" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>

            <div class="input-group mb-3">
              <input type="password" class="form-control" value="Nhập lại mật khẩu" name="password_confirmation" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Đặt lại mật khẩu</button>
              </div>
            </div>
            @csrf
          </form>
    </div>
  </div>
</div>
@endsection
