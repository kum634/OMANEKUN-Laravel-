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


// ini_set("memory_limit", "512M");

class common_controller extends Controller
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
    if(!auth()->check()) return redirect('login');
  }

  /**
  * Show the application dashboard.
  *
  * @return \Illuminate\Http\Response
  */


  public function bs_alert($str, $judgment = '', $error_code = '')
  {
    Log::debug(print_r($str, true).__FILE__.__LINE__);
    Log::debug(print_r($judgment, true).__FILE__.__LINE__);
    Log::debug(print_r($error_code, true).__FILE__.__LINE__);

    $html_class = '';
    if ($judgment == true) $html_class = 'alert-success';
    if ($judgment == false) {
      $html_class = 'alert-warning';
      if ($error_code != '') $error_code = '<br>'.$error_code;
    }
    Log::debug(print_r($html_class, true).__FILE__.__LINE__);

    return '<div class="alert '.$html_class.'">'.$str.$error_code.'</div>';

  }


  /*

  トークン生成

  */
  public function gen_token()
  {

    $token = base64_encode(uniqid(date(YmdHis).$_SERVER['HTTP_USER_AGENT']));
    Log::debug(print_r($token, true).__FILE__.__LINE__);
    return $token;

  }

  /*

  dateチェック

  */
  public function date_check($str = null)
  {

    $date = date('Y-m-d',strtotime($str));
    if ($date == '1970-01-01') $date = null;
    return $date;

  }

  /*

  トークンの削除

  */
  public function del_token()
  {


  }

  /*

  ユーザー情報の抹消

  */
  public function del_user()
  {

    try {
      $uid = auth()->user()->id;
      Log::debug(print_r($uid, true).__FILE__.__LINE__);

      
      //データを物理削除
      $delete_data = Requests::where('UID',"{$uid}");
      $delete_data->forceDelete();
    } catch (PDOException $e) {
      return 0;
    }
    return 1;

  }

  /*

  ユーザーの依頼データの抹消

  */
  public function del_all_Requests()
  {

    try {
      $uid = auth()->user()->id;
      Log::debug(print_r($uid, true).__FILE__.__LINE__);

      //ユーザー情報削除
      $user = Auth::user();
      Auth::logout();
      $user->delete();
    } catch (PDOException $e) {
      return 0;
    }
    return 1;

  }

}
