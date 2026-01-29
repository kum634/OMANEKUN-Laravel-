<!DOCTYPE html>
<html lang="en">
  <head>
    @include('parts.head')
    <title>依頼履歴</title>
  </head>
  <body>
    @include('parts.header')
    @include('parts.side_menu')
    @include('parts.login_info')
    <h1>依頼履歴</h1>
    @if(session('message') == '登録に成功しました。')
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    @if(session('message') == '登録に失敗しました。')
    <div class="alert alert-warning">{{ session('message') }}</div>
    @endif
    @if(session('message') == '更新に成功しました。')
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    @if(session('message') == '更新に失敗しました。')
    <div class="alert alert-warning">{{ session('message') }}</div>
    @endif
    @if(session('message') == '不具合が発生しました。')
    <div class="alert alert-warning">{{ session('message') }}</div>
    @endif
    @if(session('message') == '検索に失敗しました。')
    <div class="alert alert-warning">{{ session('message') }}</div>
    @endif
    <div class="container">
      <div class="btn_area">
        <button type="button" class="btn btn-success" data-toggle="modal" data-title="詳細検索" data-mode="search" data-target="#modal-search"><i class="fas fa-search"></i> 詳細検索</button>
        <button type="button" class="btn btn-success" data-toggle="modal" data-title="新規登録" data-mode="add" data-action="{{ url('/add') }}" data-target="#modal-form"><i class="fas fa-plus"></i> 新規登録</button>
      </div>

      {{-- 新規登録・編集モーダル（既存の処理を維持） --}}
      <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="label1"></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @include('parts.form')
          </div>
        </div>
      </div>
      {{-- 検索結果表示エリア（Livewire コンポーネント） --}}
      @livewire('history-search')
    </div>
    @include('parts.footer')
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-4.3.1.js') }}"></script>
    <script>
      function nl2br(str) {
        return str.replace(/\r?\n/g, '<br />');
      };

      /**
       * 新規登録フォームモーダル
       */
      $('#modal-form').on('show.bs.modal', function (event) {

        console.log(event);
        var modal_btn = $(event.relatedTarget);
        var modal = $(this);
        var mode = modal_btn.data('mode');
        var action = modal_btn.data('action');
        var modal_subbtn = $('#modal-form button#sub');
        var title = modal_btn.data('title');
        $('.modal-title').text(title);
        
        $(this).find('form').attr('action',action);
        if (mode == 'search') {

          var sel3 = $('form dd select:nth-of-type(3)');
          sel3.hide().next('span').hide();

          $('form dd select:nth-of-type(2)').on('change', function() {

            $(this).nextAll().val('');

            var sel_val = $(this).val();
            if (sel_val != '') $(this).next('span').nextAll().show();
            else $(this).next('span').nextAll().hide();
          });

        }

        modal.find('input[type="text"]').val('').end()
        .find('select').val('').end()
        .find('input[type="tel"]').val('').end()
        .find('input[type="email"]').val('').end()
        .find('input[type="radio"]').prop("checked", false).end()
        .find('input[type="checkbox"]').prop("checked", false).end();

        if (mode == 'add') modal_subbtn.text('登録');
        if (mode == 'search') modal_subbtn.text('検索');

        modal.find('form input[name="mode"]').val(mode);
      });

        /**
         * 依頼データ削除
         */
        function ajax(param) {
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
          url:"/ajax",
          type:"POST",
          data:param,
          dataType:"json",
          timeout:3000
        }).done(function(data) {
          alert('削除しました。');
          if (data['res'] == 1) {
            setTimeout(function(){
              location.href = location.href;
            },2000);
          }

        }).fail(function(data){
          alert('失敗');
          console.log("ajax通信に失敗しました");
          console.log("jqXHR          : " + jqXHR.status); // HTTPステータスが取得
          console.log("textStatus     : " + textStatus);    // タイムアウト、パースエラー
          console.log("errorThrown    : " + errorThrown.message); // 例外情報
          console.log("URL            : " + url);
        });
      }

      document.addEventListener('delete-request', (event) => {
        const data = event.detail;
        if (confirm('本当に削除しますか？') !== true) return;
        var id = data.id;
        var param = {
            id:id,
            ajax_mode:'del'
          }
        ajax(param);
      });

      /**
       * 詳細モーダル
       */
      document.addEventListener('open-detail-modal', () => {
          $('#modal-detail').modal('show');
      });

      document.addEventListener('DOMContentLoaded', () => {
        document.addEventListener('open-detail-modal', (event) => {
            const data = event.detail;
            var modal_btn = $(event.relatedTarget);
            var modal = $('#modal-detail');
            console.log(data);

            var action = data.action;
            var detail = modal.children('div.modal-dialog').children('div.modal-content').children('div.result');
            var edit_btn = $('button#edit');
            var prnt_btn = $('button#print');

            var edit_form = modal.children('div.modal-dialog').children('div.modal-content').children('div.form_area');
            var update_btn = edit_form.find('button#sub');

            $('.modal-title').text('詳細');

            modal.find('form').attr('action',action);

            edit_form.hide();
            detail.show();

            var id = data.id;
            var storage_date = data.storage_date;
            var retrieval_date = data.retrieval_date;
            var last_name = data.last_name;
            var first_name = data.first_name;
            var tel = data.tel;
            var mailaddress = data.mailaddress;
            var car_name = data.car_name;
            var model = data.model;
            var license = data.license;
            var inspection_date = data.inspection_date;
            var maintenance_type = data.maintenance_type;
            var maintenance_detail = data.maintenance_detail;
            var wash = data.wash;
            var clean = data.clean;
            var notices = data.notices;
            var notices_detail = data.notices_detail;
            
            //詳細表示

            modal.find('#storage_date').text(storage_date).end()
              .find('#retrieval_date').text(retrieval_date).end()
              .find('#cos_name').text(last_name + first_name).end()
              .find('#tel').text(tel).end()
              .find('#email').text(mailaddress).end()
              .find('#car_name').text(car_name).end()
              .find('#model').text(model).end()
              .find('#license').text(license).end()
              .find('#inspection_date').text(inspection_date).end()
              .find('#maintenance_type').text(maintenance_type).end()
              .find('#maintenance_detail').html(nl2br(maintenance_detail)).end()
              .find('#wash').text(wash).end()
              .find('#clean').text(clean).end()
              .find('#notices').text(notices).end()
              .find('#notices_detail').html(nl2br(notices_detail)).end();

            //編集

            edit_btn.on('click' , function() {

              $('.modal-title').text('編集');
              edit_form.show();
              detail.hide();
              var mode = $(this).data('mode');
              // alert(mode);
              update_btn.text('更新');
              modal.find('form input[name="mode"]').val(mode);
              modal.find('form input[name="id"]').val(id);

              storage_date = (String(storage_date)).split('-');
              retrieval_date = (String(retrieval_date)).split('-');
              inspection_date = (String(inspection_date)).split('-');
              wash = (String(wash)).split(',');
              clean = (String(clean)).split(',');
              maintenance_type = (String(maintenance_type)).split(',');
              notices = (String(notices)).split(',');

              modal
              .find('input[type="text"]').val('').end()
              .find('select').val('').end()
              .find('input[type="tel"]').val('').end()
              .find('input[type="email"]').val('').end()
              .find('input[type="radio"]').prop("checked", false).end()
              .find('input[type="checkbox"]').prop("checked", false).end();

                edit_form
                .find('select[name="storage_date_y"]').val(storage_date[0]).end()
                .find('form select[name="storage_date_m"]').val(storage_date[1]).end()
                .find('form select[name="storage_date_d"]').val(storage_date[2]).end()
                .find('form select[name="retrieval_date_y"]').val(retrieval_date[0]).end()
                .find('form select[name="retrieval_date_m"]').val(retrieval_date[1]).end()
                .find('form select[name="retrieval_date_d"]').val(retrieval_date[2]).end()
                .find('[name="last_name"]').val(last_name).end()
                .find('[name="first_name"]').val(first_name).end()
                .find('[name="tel"]').val(tel).end()
                .find('[name="mailaddress"]').val(mailaddress).end()
                .find('[name="car_name"]').val(car_name).end()
                .find('[name="model"]').val(model).end()
                .find('[name="license"]').val(license).end()
                .find('.inspection_date_y').val(inspection_date[0]).end()
                .find('.inspection_date_m').val(inspection_date[1]).end()
                .find('.inspection_date_d').val(inspection_date[2]).end()
                .find('[name="maintenance_type[]"]').val(maintenance_type).end()
                .find('[name="maintenance_detail"]').val(maintenance_detail).end()
                .find('[name="wash"]').val(wash).end()
                .find('[name="clean"]').val(clean).end()
                .find('[name="notices[]"]').val(notices).end()
                .find('[name="notices_detail"]').val(notices_detail).end();
            });

          $(document).off('click', '#modal-detail button#print');
          $(document).on('click', '#modal-detail button#print', function (e) {

            e.preventDefault();

            storage_date = (String(storage_date)).split('-');
            retrieval_date = (String(retrieval_date)).split('-');
            inspection_date = (String(inspection_date)).split('-');
            wash = (String(wash)).split(',');
            clean = (String(clean)).split(',');
            maintenance_type = (String(maintenance_type)).split(',');
            notices = (String(notices)).split(',');

            var print_page = '/history/print?';
            print_page += 'storage_date_y' + '=' + storage_date[0];
            print_page += '&storage_date_m' + '=' + storage_date[1];
            print_page += '&storage_date_d' + '=' + storage_date[2];
            print_page += '&retrieval_date_y' + '=' + retrieval_date[0];
            print_page += '&retrieval_date_m' + '=' + retrieval_date[1];
            print_page += '&retrieval_date_d' + '=' + retrieval_date[2];
            print_page += '&last_name' + '=' + last_name;
            print_page += '&first_name' + '=' + first_name;
            print_page += '&tel' + '=' + tel;
            print_page += '&mailaddress' + '=' + mailaddress;
            print_page += '&car_name' + '=' + car_name;
            print_page += '&model' + '=' + model;
            print_page += '&license' + '=' + license;
            print_page += '&inspection_date_y' + '=' + inspection_date[0];
            print_page += '&inspection_date_m' + '=' + inspection_date[1];
            print_page += '&inspection_date_d' + '=' + inspection_date[2];
            print_page += '&maintenance_type' + '=' + maintenance_type;
            print_page += '&maintenance_detail' + '=' + nl2br(maintenance_detail);
            print_page += '&wash' + '=' + wash;
            print_page += '&clean' + '=' + clean;
            print_page += '&notices' + '=' + notices;
            print_page += '&notices_detail' + '=' + nl2br(notices_detail);

            location.href = print_page;
          });
        });
      });
    </script>
  </body>
</html>
