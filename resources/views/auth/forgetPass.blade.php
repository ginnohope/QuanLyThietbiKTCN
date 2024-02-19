@extends('layout.layout')
@section('content')

  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Nhập Email</p>
        @error('email')
            <div>{{ $message }}</div>
        @enderror

        @if(Session::has('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        <form action="{{ route('forgetPassRequest') }}" method="post">
            <div class="input-group mb-3">
              <input type="email" class="form-control" value="{{old('email')}}" name="email" placeholder="Email" required>
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Gửi Email reset mật khẩu</button>
              </div>
            </div>
            @csrf
          </form>
    </div>
  </div>
</div>
@endsection
