<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/temp.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  @include('parts.head')
  <title>オーマネ君-整備依頼管理-</title>
</head>
<body>
  @include('parts.header')
  @include('parts.side_menu')
  @include('parts.login_info')
  <h1>今週( {{$startDate}} - {{$endDate}} )の作業予定</h1>
  <div class="result">
    @if($mr_count == 0)
    <div class='result_title'><h2>今週の作業予定はありません。</h2></div>
    @else
    <div class='result_title'><h2>今週の作業予定 {{$mr_count}} 件</h2></div>
    <table class="seach_result">
      <tr><th style="display:none;">ID</th><th>入庫日</th><th>納車予定日</th><th>お客様氏名</th><th>車種名</th><th>型式</th><th>登録番号</th><th>整備の種類</th><th></th></tr>
      <tr>
        @foreach ($mr_data as $maintenance_request_table)
        <td style="display:none;">{{ $maintenance_request_table->ID }}</td>
        <td>{{ $maintenance_request_table->nyuko_bi }}</td>
        <td>{{ $maintenance_request_table->nousya_yoteibi }}</td>
        <td>{{ $maintenance_request_table->sei }}{{ $maintenance_request_table->mei }}</td>
        <td>{{ $maintenance_request_table->car_name }}</td>
        <td>{{ $maintenance_request_table->katasiki }}</td>
        <td>{{ $maintenance_request_table->tourokubangou }}</td>
        <td>{{ $maintenance_request_table->seibi_syurui }}</td>
        <td>
          <form action="{{ url('details') }}" method="get" name="form{{ $maintenance_request_table->ID }}" id="form{{ $maintenance_request_table->ID }}">
            <input style="display:none;" name="ID" value="{{ $maintenance_request_table->ID }}"/>
            <input style="display:none;" name="nyuko_bi" value="{{ $maintenance_request_table->nyuko_bi }}"/>
            <input style="display:none;" name="nousya_yoteibi" value="{{ $maintenance_request_table->nousya_yoteibi }}"/>
            <input style="display:none;" name="sei" value="{{ $maintenance_request_table->sei }}"/>
            <input style="display:none;" name="mei" value="{{ $maintenance_request_table->mei }}"/>
            <input style="display:none;" name="tel" value="{{ $maintenance_request_table->tel }}"/>
            <input style="display:none;" name="mail" value="{{ $maintenance_request_table->mail }}"/>
            <input style="display:none;" name="car_name" value="{{ $maintenance_request_table->car_name }}"/>
            <input style="display:none;" name="katasiki" value="{{ $maintenance_request_table->katasiki }}"/>
            <input style="display:none;" name="tourokubangou" value="{{ $maintenance_request_table->tourokubangou }}"/>
            <input style="display:none;" name="syakenmanryou_bi" value="{{ $maintenance_request_table->syakenmanryou_bi }}"/>
            <input style="display:none;" name="seibi_syurui" value="{{ $maintenance_request_table->seibi_syurui }}"/>
            <input style="display:none;" name="seibi_naiyou" value="{{ $maintenance_request_table->seibi_naiyou }}"/>
            <input style="display:none;" name="sensya" value="{{ $maintenance_request_table->sensya }}"/>
            <input style="display:none;" name="syanaiseisou" value="{{ $maintenance_request_table->syanaiseisou }}"/>
            <input style="display:none;" name="tokki_zikou" value="{{ $maintenance_request_table->tokki_zikou }}"/>
            <input style="display:none;" name="tokki_zikou_syousai" value="{{ $maintenance_request_table->tokki_zikou_syousai }}"/>
            <input class="small_btn" type="submit" name="submit_{{ $maintenance_request_table->ID }}" id="submit_{{ $maintenance_request_table->ID }}" value="詳細を表示"/>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
    @endif
  </div>
  <!-- InstanceBeginEditable name="メインコンテンツ" -->
  <!-- InstanceEndEditable -->
  @include('parts.footer')
  @include('parts.js')
</body>
<!-- InstanceEnd --></html>
