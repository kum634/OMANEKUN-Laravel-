<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/temp.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  @include('parts.head')
  <title>削除の確認</title>
</head>
<body>
  @include('parts.header')
  @include('parts.side_menu')
  @include('parts.login_info')
  <!-- InstanceBeginEditable name="メインコンテンツ" -->
  <h1>削除の確認</h1>
  <div class="result">
    <table class="input_area" style="margin-bottom:16px;"  border="1" width="90%">
      <tr style="display:none;">
        <th>ID</th><th>{{$ID}}</th>
      </tr>
      <tr>
        <td>入庫日</td><td>{{$nyuko_bi}}</td>
      </tr>
      <tr>
        <td>返却予定日</td><td>{{$nousya_yoteibi}}</td>
      </tr>
      <tr>
        <td>お客様氏名</td><td>{{$sei}}{{$mei}}</td>
      </tr>
      <tr>
        <td>電話番号</td><td>{{$tel}}</td>
      </tr>
      <tr>
        <td>メールアドレス</td><td>{{$mail}}</td>
      </tr>
      <tr>
        <td>車種名</td><td>{{$car_name}}</td>
      </tr>
      <tr>
        <td>型式</td><td>{{$katasiki}}</td>
      </tr>
      <tr>
        <td>登録番号</td><td>{{$tourokubangou}}</td>
      </tr>
      <tr>
        <td>車検証の有効期限</td><td>{{$syakenmanryou_bi}}</td>
      </tr>
      <tr>
        <td>整備の種類</td><td>{{$seibi_syurui}}</td>
      </tr>
      <tr>
        <td>整備内容</td><td>{{$seibi_naiyou}}</td>
      </tr>
      <tr>
        <td>洗車の有無</td><td>{{$sensya}}</td>
      </tr>
      <tr>
        <td>車内清掃の有無</td><td>{{$syanaiseisou}}</td>
      </tr>
      <tr>
        <td>特記事項</td><td>{{$tokki_zikou}}</td>
      </tr>
      <tr>
        <td>特記事項詳細</td><td>{{$tokki_zikou_syousai}}</td>
      </tr>
    </table>
    <div class="btn_area">
      <form id="form{{$ID}}" name="form{{$ID}}" action="{{ url('delete') }}" method="get"  onsubmit="return confirm('本当に削除してよろしいですか？')">
        <input style="display:none;" name="ID" value="{{$ID}}"/>
        <input class="small_btn" type="submit" name="submit_{{$ID}}" id="submit_{{$ID}}" value="削除" />
      </form>
    </div>
  </div>
  <!-- InstanceEndEditable -->
  @include('parts.footer')
  @include('parts.js')
</body>
<!-- InstanceEnd --></html>
