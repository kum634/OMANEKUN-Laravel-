<!DOCTYPE html>
<html lang="en">
  <head>
    @include('parts.head')
    <title>エキスポート</title>
  </head>
  <body>
    @include('parts.header')
    @include('parts.side_menu')
    @include('parts.login_info')
    <h1>エキスポート</h1>
    @if(session('error_message'))
    <div class="alert alert-warning">{{session('error_message')}}</div>
    @endif
    <form class="form-reauth mt-5" action="{{ url('csv') }}" method="post">
      {{ csrf_field() }}
      <dl>
        <dt>パスワードを入力してください。</dt>
        <dd><input type="password" name="password" value=""/></dd>
      </dl>
      <input type="hidden" name="csv_mode" value="ex"/>
      <div class="text-center mt-5">
        <button id="sub" class="btn btn-lg btn-success">エキスポート</button>
      </div>
    </form>
    @include('parts.footer')
    @include('parts.js')
  </body>
</html>
