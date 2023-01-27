<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  @include('parts.user_head')
  <title>ログイン</title>
</head>
<body class="text-center">
  @include('parts.user_header')
  <main>
    <h2 class="font-weight-normal">ログイン</h2>
    <div class="form_login_area">
      <form class="form-signin" action="{{ route('login') }}" id="form-signin" name="form-signin" method="post">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          <p class="mb-1 text-left"> ユーザー名（テスト用ユーザー名 : guest）</p>
          <input id="name" type="text" class="form-control" name="name" value="guest" required autofocus>
          @if ($errors->has('name'))
          <span class="help-block">
            <strong style="color:#CC0003;">{{ $errors->first('name') }}</strong>
          </span>
          @endif
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <p class="mb-1 text-left">パスワード（テスト用パスワード : guest2020）</p>
          <input id="password" type="password" class="form-control" name="password" value="guest2020"required>
          @if ($errors->has('password'))
          <span class="help-block">
            <strong style="color:#CC0003;">{{ $errors->first('password') }}</strong>
          </span>
          @endif
        </div>
        <div class="form-group mb-0 checkbox">
          <label class="mb-0">
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> 自動ログイン
          </label>
        </div>
        <div class="form-group">
          <button class="btn btn-lg btn-success" type="submit">ログイン</button>
        </div>
        <p class="mb-0">パスワードを忘れた方は<a href="{{ route('password.request') }}">コチラ</a></p>
        <p class="mb-0">ユーザー登録を御希望の方は<a href="register">コチラ</a></p>
      </form>
    </div>
  </main>
  @include('parts.footer')
  @include('parts.js')
</body>
</html>
