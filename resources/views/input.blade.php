<!DOCTYPE html>
<html lang="en"><!-- InstanceBegin template="/Templates/temp.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
  @include('parts.head')
  <title>依頼内容の登録</title>
</head>
<body>
  @include('parts.header')
  @include('parts.side_menu')
  @include('parts.login_info')
  <!-- InstanceBeginEditable name="メインコンテンツ" -->
  <h1>依頼内容の登録</h1>
  @if(session('message'))
  <div class="alert alert-success">{{session('message')}}</div>
  <!-- <script type='text/javascript'>alert('{{session('message')}}');</script> -->
  @endif
  <div class="form_area">
    <form id="form1" name="form1" method="get" action="{{ url('data_Register') }}">
      <table class="input_area" width="90%" border="1">
        <tbody>
          <tr>
            <td>入庫日：</td>
            <td>
              <select name="nyuko_bi_y" id="nyuko_bi_y" required>
                <option value="">-</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
                <option value="2028">2028</option>
                <option value="2029">2029</option>
              </select>年
              <select name="nyuko_bi_m" id="nyuko_bi_m" required>
                <option value="">-</option>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                <option value="05">05</option>
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                <option value="09">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
              </select>月
              <select name="nyuko_bi_d" id="nyuko_bi_d" required>
                <option value="">-</option>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                <option value="05">05</option>
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                <option value="09">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
              </select>日
            </td>
          </tr>
          <tr>
            <td>納車予定日：</td>
            <td><select name="nousya_yoteibi_y" id="nousya_yoteibi" required>
              <option value="">-</option>
              <option value="2020">2020</option>
              <option value="2021">2021</option>
              <option value="2022">2022</option>
              <option value="2023">2023</option>
              <option value="2024">2024</option>
              <option value="2025">2025</option>
              <option value="2026">2026</option>
              <option value="2027">2027</option>
              <option value="2028">2028</option>
              <option value="2029">2029</option>
            </select>年
            <select name="nousya_yoteibi_m" id="nousya_yoteibi" required>
              <option value="">-</option>
              <option value="01">01</option>
              <option value="02">02</option>
              <option value="03">03</option>
              <option value="04">04</option>
              <option value="05">05</option>
              <option value="06">06</option>
              <option value="07">07</option>
              <option value="08">08</option>
              <option value="09">09</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
            </select>月
            <select name="nousya_yoteibi_d" id="nousya_yoteibi" required>
              <option value="">-</option>
              <option value="01">01</option>
              <option value="02">02</option>
              <option value="03">03</option>
              <option value="04">04</option>
              <option value="05">05</option>
              <option value="06">06</option>
              <option value="07">07</option>
              <option value="08">08</option>
              <option value="09">09</option>
              <option value="10">10</option>
              <option value="11">11</option>
              <option value="12">12</option>
              <option value="13">13</option>
              <option value="14">14</option>
              <option value="15">15</option>
              <option value="16">16</option>
              <option value="17">17</option>
              <option value="18">18</option>
              <option value="19">19</option>
              <option value="20">20</option>
              <option value="21">21</option>
              <option value="22">22</option>
              <option value="23">23</option>
              <option value="24">24</option>
              <option value="25">25</option>
              <option value="26">26</option>
              <option value="27">27</option>
              <option value="28">28</option>
              <option value="29">29</option>
              <option value="30">30</option>
              <option value="31">31</option>
            </select>日</td>
          </tr>
          <tr>
            <td>お客様氏名：</td>
            <td><input class="text_area" type="text" name="sei" id="sei" placeholder="姓" />　<input class="text_area" type="text" name="mei" id="mei" placeholder="名" />　</td>
          </tr>
          <tr>
            <td>電話番号：</td>
            <td><input class="text_area" type="text" name="tel" id="tel" placeholder="" /></td>
          </tr>
          <tr>
            <td>メールアドレス：</td>
            <td><input class="text_area" type="text" name="mail" id="mail" placeholder="" /></td>
          </tr>
          <tr>
            <td>車種名：</td>
            <td><input class="text_area" type="text" name="car_name" id="car_name" placeholder="" />	</td>
          </tr>
          <tr>
            <td>型式：	</td>
            <td><input class="text_area" type="text" name="katasiki" id="katasiki" placeholder="" /></td>
          </tr>
          <tr>
            <td>登録番号：</td>
            <td><input class="text_area" type="text" name="tourokubangou" id="tourokubangou" placeholder="" /></td>
          </tr>
          <tr>
            <td>車検証の有効期限：</td>
            <td>
              <select name="syakenmanryou_bi_y" id="syakenmanryou_bi_y" required>
                <option value="">-</option>
                <option value="2020">2020</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
                <option value="2023">2023</option>
                <option value="2024">2024</option>
                <option value="2025">2025</option>
                <option value="2026">2026</option>
                <option value="2027">2027</option>
                <option value="2028">2028</option>
                <option value="2029">2029</option>
              </select>年
              <select name="syakenmanryou_bi_m" id="syakenmanryou_bi_m" required>
                <option value="">-</option>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                <option value="05">05</option>
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                <option value="09">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
              </select>月
              <select name="syakenmanryou_bi_d" id="syakenmanryou_bi_d" required>
                <option value="">-</option>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                <option value="05">05</option>
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                <option value="09">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
              </select>日
            </td>
          </tr>
          <tr>
            <td>整備の種類：</td>
            <td>
              故障修理 <input class="check_area" type="checkbox" name="seibi_syurui[]" id="seibi_syurui"  value="故障修理" />
              <br />
              部品(交換・取付・取外し) <input class="check_area" type="checkbox" name="seibi_syurui[]" id="seibi_syurui"  value="部品(交換・取付・取外し)" />
              <br />
              点検 <input class="check_area" type="checkbox" name="seibi_syurui[]" id="seibi_syurui"  value="点検" />
              <br />
              車検 <input class="check_area" type="checkbox" name="seibi_syurui[]" id="seibi_syurui"  value="車検" />
              <br />
              メンテナンス <input class="check_area" type="checkbox" name="seibi_syurui[]" id="seibi_syurui"  value="メンテナンス" />
              <br />
              板金塗装 <input class="check_area" type="checkbox" name="seibi_syurui[]" id="seibi_syurui"  value="板金塗装" />
              <br />
              その他 <input class="check_area" type="checkbox" name="seibi_syurui[]" id="seibi_syurui"  value="その他" />
            </td>
          </tr>
          <tr>
            <td>整備内容：</td>
            <td><textarea name="seibi_naiyou" rows="10" id="seibi_naiyou"></textarea></td>
          </tr>
          <tr>
            <td>洗車の有無：</td>
            <td>
              有 <input class="check_area" type="radio" name="sensya" id="sensya" placeholder="" value="有" />
              <br />
              無 <input class="check_area" type="radio" name="sensya" id="sensya" placeholder="" value="無" />
            </td>
          </tr>
          <tr>
            <td>車内清掃の有無：</td>
            <td>
              有 <input class="check_area" type="radio" name="syanaiseisou" id="syanaiseisou" placeholder="" value="有" />
              <br />
              無 <input class="check_area" type="radio" name="syanaiseisou" id="syanaiseisou" placeholder="" value="無" />
            </td>
          </tr>
          <tr>
            <td>特記事項：</td>
            <td>
              部品破損要注意 <input class="check_area" type="checkbox" name="tokki_zikou[]" id="tokki_zikou"  value="部品破損要注意" />
              <br />
              作業傷要注意 <input class="check_area" type="checkbox" name="tokki_zikou[]" id="tokki_zikou"  value="作業傷要注意" />
              <br />
              入念洗車 <input class="check_area" type="checkbox" name="tokki_zikou[]" id="tokki_zikou"  value="入念洗車" />
              <br />
              洗車機禁止 <input class="check_area" type="checkbox" name="tokki_zikou[]" id="tokki_zikou"  value="洗車機禁止" />
              <br />
              窓拭き禁止 <input class="check_area" type="checkbox" name="tokki_zikou[]" id="tokki_zikou"  value="窓拭き禁止" />
              <br />
              車内ゴミ撤去禁止 <input class="check_area" type="checkbox" name="tokki_zikou[]" id="tokki_zikou"  value="車内ゴミ撤去禁止" />
              <br />
              納車日厳守 <input class="check_area" type="checkbox" name="tokki_zikou[]" id="tokki_zikou"  value="納車日厳守" />
              <br />
              取外し部品返却必須 <input class="check_area" type="checkbox" name="tokki_zikou[]" id="tokki_zikou"  value="取外し部品返却必須" />
              <br />
              その他 <input class="check_area" type="checkbox" name="tokki_zikou[]" id="tokki_zikou" value="その他" />
            </td>
          </tr>
          <tr>
            <td>特記事項詳細：</td>
            <td><textarea name="tokki_zikou_syousai" rows="10" id="tokki_zikou_syousai"></textarea></td>
          </tr>
        </tbody>
      </table>
      <input class="small_btn" type="submit" name="submit" id="submit" value="上記の内容を登録" />
    </form>
  </div>
  <!-- InstanceEndEditable -->
  @include('parts.footer')
  @include('parts.js')
</body>
<!-- InstanceEnd --></html>
