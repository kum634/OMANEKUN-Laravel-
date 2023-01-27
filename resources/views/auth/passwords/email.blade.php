<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  @include('parts.user_head')
  <title>パスワードの変更</title>
</head>
<body class="text-center">
  @include('parts.user_header')
  <main>
    <h2 class="font-weight-normal">パスワードの変更</h2>
    <div class="form_login_area">
      @if (session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
      @endif
      <form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          @if ($errors->has('email'))
          <span class="help-block">
            <strong style="color:#CC0003;">{{ $errors->first('email') }}</strong>
          </span>
          @endif
          <p class="mb-1 text-left">メールアドレス</p>
          <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
        </div>
        <div class="form-group mb-0">
          <button type="submit" class="btn btn-lg btn-success">
            パスワード再設定メールを送信
          </button>
        </div>
      </form>
    </div>
  </main>
  @include('parts.footer')
  @include('parts.js')
</body>
</html>
