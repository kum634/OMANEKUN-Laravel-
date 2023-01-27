<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  @include('parts.user_head')
  <title>ユーザー登録</title>
</head>
<body class="text-center">
  @include('parts.user_header')
  @if(session('message'))
  <div class="alert alert-success">{{session('message')}}</div>
  @endif
  <main>
    <h2 class="font-weight-normal">ユーザー登録</h2>
    <div class="form_login_area">
      <form class="form-signin" action="{{ route('register') }}" id="form-signin" name="form-signin" method="post">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
          <p class="mb-1 text-left">ユーザー名</p>
          <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
          @if ($errors->has('name'))
          <span style="color:#CC0003;" class="help-block">
            <strong style="color:#CC0003;">{{ $errors->first('name') }}</strong>
          </span>
          @endif
        </div>
        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
          <p class="mb-1 text-left">メールアドレス</p>
          <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
          @if ($errors->has('email'))
          <span style="color:#CC0003;" class="help-block">
            <strong style="color:#CC0003;">{{ $errors->first('email') }}</strong>
          </span>
          @endif
        </div>
        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
          <p class="mb-1 text-left">パスワード</p>
          <input id="password" type="password" class="form-control" name="password" required>
          @if ($errors->has('password'))
          <span style="color:#CC0003;" class="help-block">
            <strong style="color:#CC0003;">{{ $errors->first('password') }}</strong>
          </span>
          @endif
        </div>
        <div class="form-group">
          <p class="mb-1 text-left">パスワード(確認)</p>
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>
        <div class="form-group">
          <button class="btn btn-lg btn-success" type="submit">登録</button>
        </div>
        <p class="mb-0">ユーザー登録済みの方またはゲスト様は<a href="login">コチラ</a></p>
      </form>
    </div>
  </main>
  @include('parts.footer')
  @include('parts.js')
</body>
</html>
