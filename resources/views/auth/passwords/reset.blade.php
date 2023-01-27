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
      <form class="form-signin" method="POST" action="{{ route('password.request') }}">
        {{ csrf_field() }}
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <p class="mb-1 text-left">メールアドレス</p>
          <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus>
          @if ($errors->has('email'))
          <span class="help-block">
            <strong style="color:#CC0003;">{{ $errors->first('email') }}</strong>
          </span>
          @endif
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <p class="mb-1 text-left">新規パスワード</p>
          <input id="password" type="password" class="form-control" name="password" required>
          @if ($errors->has('password'))
          <span class="help-block">
            <strong style="color:#CC0003;">{{ $errors->first('password') }}</strong>
          </span>
          @endif
        </div>
        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
          <p class="mb-1 text-left">新規パスワード（確認）</p>
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
          @if ($errors->has('password_confirmation'))
          <span class="help-block">
            <strong style="color:#CC0003;">{{ $errors->first('password_confirmation') }}</strong>
          </span>
          @endif
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-lg btn-success">
            変更する
          </button>
        </div>
      </form>
    </div>
  </main>
  @include('parts.footer')
  @include('parts.js')
</body>
</html>
