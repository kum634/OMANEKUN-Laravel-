<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/temp.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  @include('parts.head')
  <title>インポート</title>
</head>
<body>
  @include('parts.header')
  @include('parts.side_menu')
  @include('parts.login_info')
  <!-- InstanceBeginEditable name="メインコンテンツ" -->
  <h1>インポート</h1>
  @if(session('message'))
  <div class="alert alert-success">{{session('message')}}</div>
  @endif
  @if(session('error_message'))
  <div class="alert alert-warning">{{session('error_message')}}</div>
  @endif
  <form class="form-reauth mt-5" action="{{ url('import_judgment') }}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }}
    <dl>
      <dt>ファイル（.csv）</dt>
      <dd>
        <label class="submit_file" for="csvfile">
          ＋ファイルを選択<input type="file" name="csvfile" style="display:none;" id="csvfile"  onchange="file_select(this);"/>
        </label>
        <p id="name"></p>
      </dd>
    </dl>
    <dl>
      <dt>パスワードを入力してください。</dt>
      <dd><input type="password" name="password" value=""/></dd>
    </dl>
    <input class="small_btn" type="submit" name="submit" id="submit" value="インポート"/>
  </form>
  <script type="text/javascript">
  function file_select() {
    var input = document.querySelector('#csvfile').files[0];
    document.querySelector('#name').innerHTML = input.name;
  }
  </script>
  <!-- InstanceEndEditable -->
  @include('parts.footer')
  @include('parts.js')
</body>
<!-- InstanceEnd --></html>
