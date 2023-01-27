<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// データベース
use Illuminate\Support\Facades\DB;
// Eloquent
use App\Models\Requests;
// 認証
use Illuminate\Support\Facades\Auth;
//現在のパスワードをチェックする
use Illuminate\Support\Facades\Hash;
// デバッグ
use Log;


class view_controller extends page_controller
{

  /**
  * Create a new controller instance.
  *
  * @return void
  */



  public function __construct()
  {

    $this->middleware('auth');
    //ログインしていなければログイン画面にリダイレクトする。
    // if(!auth()->check()) return redirect('login');

  }

  /**
  * Show the application dashboard.
  *
  * @return \Illuminate\Http\Response
  */

  public function index()
  {

    //取得結果を返す
    $view = view('index');
    $view->week = $this->get_this_week();
    Log::debug(print_r($view->week, true).__FILE__.__LINE__);

    $obj = $this->get_weekly_requests();
    Log::debug(print_r($obj, true).__FILE__.__LINE__);

    $tbl = $this->create_requests_table($obj);
    Log::debug(print_r($tbl, true).__FILE__.__LINE__);

    $view->tbl = $tbl;

    return $view;

  }

  public function history()
  {

    //画面を表示

    $obj = $this->get_requests();
    $tbl = $this->create_requests_table($obj);
    Log::debug(print_r($obj, true).__FILE__.__LINE__);
    Log::debug(print_r($tbl, true).__FILE__.__LINE__);

    $view = view('history');
    $view->tbl = $tbl;

    $view->dbg = '';

    return $view;

  }

  /*

  作業指示書の印刷

  */

  public function print()
  {

    //画面を表示
    $view = view('print');
    return $view;

  }

  public function import()
  {

    //画面を表示
    $view = view('import');
    return $view;

  }

  public function export()
  {

    //画面を表示
    $view = view('export');
    return $view;

  }

  public function withdrawal()
  {

    //画面を表示
    $view = view('withdrawal');
    return $view;

  }

}
