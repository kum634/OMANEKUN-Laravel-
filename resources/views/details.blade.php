<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/temp.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  @include('parts.head')
  <title>依頼内容の詳細</title>
</head>
<body>
  @include('parts.header')
  @include('parts.side_menu')
  @include('parts.login_info')
  <!-- InstanceBeginEditable name="メインコンテンツ" -->
  <h1>依頼内容の詳細</h1>
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
      <form id="form{{$ID}}" name="form{{$ID}}" action="{{ url('print') }}" target="_blank" method="get">
        <input style="display:none;" name="ID" value="{{$ID}}"/>
        <input style="display:none;" name="nyuko_bi" value="{{$nyuko_bi}}"/>
        <input style="display:none;" name="nousya_yoteibi" value="{{$nousya_yoteibi}}"/>
        <input style="display:none;" name="sei" value="{{$sei}}"/>
        <input style="display:none;" name="mei" value="{{$mei}}"/>
        <input style="display:none;" name="tel" value="{{$tel}}"/>
        <input style="display:none;" name="mail" value="{{$mail}}"/>
        <input style="display:none;" name="car_name" value="{{$car_name}}"/>
        <input style="display:none;" name="katasiki" value="{{$katasiki}}"/>
        <input style="display:none;" name="tourokubangou" value="{{$tourokubangou}}"/>
        <input style="display:none;" name="syakenmanryou_bi" value="{{$syakenmanryou_bi}}"/>
        <input style="display:none;" name="seibi_syurui" value="{{$seibi_syurui}}"/>
        <input style="display:none;" name="seibi_naiyou" value="{{$seibi_naiyou}}"/>
        <input style="display:none;" name="sensya" value="{{$sensya}}"/>
        <input style="display:none;" name="syanaiseisou" value="{{$syanaiseisou}}"/>
        <input style="display:none;" name="tokki_zikou" value="{{$tokki_zikou}}"/>
        <input style="display:none;" name="tokki_zikou_syousai" value="{{$tokki_zikou_syousai}}"/>
        <input class="small_btn" type="submit" name="submit_{{$ID}}" id="submit_{{$ID}}" value="作業指示書を印刷" />
      </form>
    </div>
  </div>
  <!-- InstanceEndEditable -->
  @include('parts.footer')
  @include('parts.js')
</body>
<!-- InstanceEnd --></html>
