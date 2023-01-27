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
        <button type="button" class="btn btn-success" data-toggle="modal" data-title="詳細検索" data-mode="search" data-action="{{ url('/history/search') }}" data-target="#modal-form"><i class="fas fa-search"></i> 詳細検索</button>
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
