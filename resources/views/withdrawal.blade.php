<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/temp.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  @include('parts.head')
  <title>退会ページ</title>
</head>
<body>
  @include('parts.header')
  @include('parts.side_menu')
  @include('parts.login_info')
  <!-- InstanceBeginEditable name="メインコンテンツ" -->
  <h1>退会</h1>
  @if(session('error_message'))
  <div class="alert alert-warning">{{session('error_message')}}</div>
  @endif
  <form class="form-reauth mt-5" action="{{ url('withdrawal_judgment') }}" method="get"  onsubmit="return confirm('本当に退会しますか？')">
    <dl>
      <dt>パスワードを入力してください。</dt>
      <dd><input type="password" name="password" value=""/></dd>
    </dl>
    <input class="small_btn" type="submit" name="submit" id="submit" value="退会"/>
  </form>
  <!-- InstanceEndEditable -->
  @include('parts.footer')
  @include('parts.js')
</body>
<!-- InstanceEnd --></html>
