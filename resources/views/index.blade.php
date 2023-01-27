<!DOCTYPE html>
<html lang="en">
  <head>
    @include('parts.head')
    <title>週間作業予定</title>
  </head>
  <body>
    @include('parts.header')
    @include('parts.side_menu')
    @include('parts.login_info')
    <h1>今週( {{ $week['start_date'] }} - {{ $week['end_date'] }} )の作業予定</h1>
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
    <div class="container">
      <div class="btn_area">
        <button type="button" class="btn btn-success" data-toggle="modal" data-title="新規登録" data-mode="add" data-action="{{ url('/add') }}" data-target="#modal-form"><i class="fas fa-plus"></i> 新規登録</button>
      </div>
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
      <div class="result">
      <?= $tbl ?>
      </div>
    </div>
    @include('parts.footer')
    @include('parts.js')
  </body>
</html>
