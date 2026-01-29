    <div class="modal fade" id="modal-search" wire:ignore.self tabindex="-1" role="dialog" aria-labelledby="label-search" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="label-search">詳細検索</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div>
                        {{-- 検索フォーム --}}
                        <div class="form_area">
                            <form wire:submit.prevent="search">
                                <dl>
                                    <dt>入庫日：</dt>
                                    <dd>
                                        <select class="" wire:model="form.storage_date_y">
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
                                        </select><span> 年</span>
                                        <select class="" wire:model="form.storage_date_m">
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
                                        </select><span> 月</span>
                                        <select class="" wire:model="form.storage_date_d">
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
                                        </select><span> 日</span>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>納車予定日：</dt>
                                    <dd>
                                        <select class="" wire:model="form.retrieval_date_y">
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
                                        </select><span> 年</span>
                                        <select class="" wire:model="form.retrieval_date_m">
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
                                        </select><span> 月</span>
                                        <select class="" wire:model="form.retrieval_date_d">
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
                                        </select><span> 日</span>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>お客様氏名：</dt>
                                    <dd>
                                        <input class="text_area mb-2" type="text" wire:model="form.last_name" placeholder="姓" />
                                        <input class="text_area" type="text" wire:model="form.first_name" placeholder="名" />
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>電話番号：</dt>
                                    <dd><input class="text_area" type="tel" wire:model="form.tel" placeholder="" /></dd>
                                </dl>
                                <dl>
                                    <dt>メールアドレス：</dt>
                                    <dd><input class="text_area" type="email" wire:model="form.mailaddress" placeholder="" /></dd>
                                </dl>
                                <dl>
                                    <dt>車種名：</dt>
                                    <dd><input class="text_area" type="text" wire:model="form.car_name" placeholder="" /></dd>
                                </dl>
                                <dl>
                                    <dt>型式：</dt>
                                    <dd><input class="text_area" type="text" wire:model="form.model" placeholder="" /></dd>
                                </dl>
                                <dl>
                                    <dt>登録番号：</dt>
                                    <dd><input class="text_area" type="text" wire:model="form.license" placeholder="" /></dd>
                                </dl>
                                <dl>
                                    <dt>車検証の有効期限：</dt>
                                    <dd>
                                        <select class="inspection_date_y" wire:model="form.inspection_date_y">
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
                                        </select><span> 年</span>
                                        <select class="inspection_date_m" wire:model="form.inspection_date_m">
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
                                        </select><span> 月</span>
                                        <select class="inspection_date_d" wire:model="form.inspection_date_d">
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
                                        </select><span> 日</span>
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>整備の種類：</dt>
                                    <dd>
                                        故障修理 <input class="check_area" type="checkbox" wire:model="form.maintenance_type" value="故障修理" />
                                        <br />
                                        部品(交換・取付・取外し) <input class="check_area" type="checkbox" wire:model="form.maintenance_type" value="部品(交換・取付・取外し)" />
                                        <br />
                                        点検 <input class="check_area" type="checkbox" wire:model="form.maintenance_type" value="点検" />
                                        <br />
                                        車検 <input class="check_area" type="checkbox" wire:model="form.maintenance_type" value="車検" />
                                        <br />
                                        メンテナンス <input class="check_area" type="checkbox" wire:model="form.maintenance_type" value="メンテナンス" />
                                        <br />
                                        板金塗装 <input class="check_area" type="checkbox" wire:model="form.maintenance_type" value="板金塗装" />
                                        <br />
                                        その他 <input class="check_area" type="checkbox" wire:model="form.maintenance_type" value="その他" />
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>整備内容：</dt>
                                    <dd><textarea class="" wire:model="form.maintenance_detail" rows="10"></textarea></dd>
                                </dl>
                                <dl>
                                    <dt>洗車の有無：</dt>
                                    <dd>
                                        有 <input class="check_area" type="radio" wire:model="form.wash" value="有" />
                                        <br />
                                        無 <input class="check_area" type="radio" wire:model="form.wash" value="無" />
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>車内清掃の有無：</dt>
                                    <dd>
                                        有 <input class="check_area" type="radio" wire:model="form.clean" value="有" />
                                        <br />
                                        無 <input class="check_area" type="radio" wire:model="form.clean" value="無" />
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>特記事項：</dt>
                                    <dd>
                                        部品破損要注意 <input class="" type="checkbox" wire:model="form.notices" value="部品破損要注意" />
                                        <br />
                                        作業傷要注意 <input class="" type="checkbox" wire:model="form.notices" value="作業傷要注意" />
                                        <br />
                                        入念洗車 <input class="" type="checkbox" wire:model="form.notices" value="入念洗車" />
                                        <br />
                                        洗車機禁止 <input class="" type="checkbox" wire:model="form.notices" value="洗車機禁止" />
                                        <br />
                                        窓拭き禁止 <input class="" type="checkbox" wire:model="form.notices" value="窓拭き禁止" />
                                        <br />
                                        車内ゴミ撤去禁止 <input class="" type="checkbox" wire:model="form.notices" value="車内ゴミ撤去禁止" />
                                        <br />
                                        納車日厳守 <input class="" type="checkbox" wire:model="form.notices" value="納車日厳守" />
                                        <br />
                                        取外し部品返却必須 <input class="" type="checkbox" wire:model="form.notices" value="取外し部品返却必須" />
                                        <br />
                                        その他 <input class="" type="checkbox" wire:model="form.notices" value="その他" />
                                    </dd>
                                </dl>
                                <dl>
                                    <dt>特記事項詳細：</dt>
                                    <dd><textarea class="" wire:model="form.notices_detail" rows="10"></textarea></dd>
                                </dl>
                                <div class="text-center mt-5">
                                    <button type="button" wire:click="search" class="btn btn-lg btn-success">検索</button>
                                    <button type="button" wire:click="clear" class="btn btn-lg btn-secondary">リセット</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('close-search-modal', function () {
        $('#modal-search').modal('hide');
    });
    </script>

