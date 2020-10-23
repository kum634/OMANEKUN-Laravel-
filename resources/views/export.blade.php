<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/temp.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  @include('parts.head')
  <title>エキスポート</title>
</head>
<body>
  @include('parts.header')
  @include('parts.side_menu')
  @include('parts.login_info')
  <!-- InstanceBeginEditable name="メインコンテンツ" -->
  <h1>エキスポート</h1>
  @if(session('error_message'))
  <div class="alert alert-warning">{{session('error_message')}}</div>
  @endif
  <form class="form-reauth mt-5" action="{{ url('export_judgment') }}" method="get">
    <dl>
      <dt>パスワードを入力してください。</dt>
      <dd><input type="password" name="password" value=""/></dd>
    </dl>
    <input class="small_btn" type="submit" name="submit" id="submit" value="エキスポート"/>
  </form>
  <!-- InstanceEndEditable -->
  @include('parts.footer')
  @include('parts.js')
</body>
<!-- InstanceEnd --></html>
