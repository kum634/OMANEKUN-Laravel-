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

class connect_controller extends common_controller
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


  /*

	今週の依頼内容の取得

	*/
  public function get_weekly_requests()
  {

    $uid = auth()->user()->id;
    $obj = DB::table('requests')
    ->where('UID', $uid)
    ->where('visible', 1)
    ->whereRaw("yearweek(`storage_date`) = yearweek(curdate())")
    ->orWhereRaw("yearweek(`storage_date`) = yearweek(curdate())")
    ->WhereRaw("UID = '{auth()->user()->id}'")
    ->orderBy('retrieval_date', 'asc')
    ->get();

    return $obj;

  }


  /*

	依頼内容の取得

	*/
  public function get_requests($arr = false, $mode = false)
  {
    Log::debug(print_r($arr, true).__FILE__.__LINE__);
    Log::debug(print_r($mode, true).__FILE__.__LINE__);

    try {
    $uid = auth()->user()->id;
    //検索結果を取得
        $obj = DB::table('requests');
        $obj->where('UID', $uid);
        $obj->where('visible', 1);
        if ( !empty($arr['storage_date_y']) && !empty($arr['storage_date_m']) && !empty($arr['storage_date_d']) )  {
          $storage_date = $arr['storage_date_y']."-".$arr['storage_date_m']."-".$arr['storage_date_d'];
          $obj->where('storage_date',"{$storage_date}");
        }elseif( !empty($arr['storage_date_y']) && !empty($arr['storage_date_m']) && empty($arr['storage_date_d']) ){
          $storage_date = $arr['storage_date_y']."-".$arr['storage_date_m']."-";
          $obj->where('storage_date','LIKE',"{$storage_date}%");
        }elseif( !empty($arr['storage_date_y']) && empty($arr['storage_date_m']) && empty($arr['storage_date_d']) ){
          $storage_date = $arr['storage_date_y']."-";
          $obj->where('storage_date','LIKE',"{$storage_date}%");
        }elseif( empty($arr['storage_date_y']) && !empty($arr['storage_date_m']) && !empty($arr['storage_date_d']) ){
          $storage_date = "-".$arr['storage_date_m']."-".$arr['storage_date_d'];
          $obj->where('storage_date','LIKE',"%{$storage_date}");
        }elseif( empty($arr['storage_date_y']) && !empty($arr['storage_date_m']) && empty($arr['storage_date_d']) ){
          $storage_date = "-".$arr['storage_date_m']."-";
          $obj->where('storage_date','LIKE',"%{$storage_date}%");
        }
        if ( !empty($arr['retrieval_date_y']) && !empty($arr['retrieval_date_m']) && !empty($arr['retrieval_date_d']) )  {
          $retrieval_date = $arr['retrieval_date_y']."-".$arr['retrieval_date_m']."-".$arr['retrieval_date_d'];
          $obj->where('retrieval_date',"{$retrieval_date}");
        }elseif( !empty($arr['retrieval_date_y']) && !empty($arr['retrieval_date_m']) && empty($arr['retrieval_date_d']) ){
          $retrieval_date = $arr['retrieval_date_y']."-".$arr['retrieval_date_m']."-";
          $obj->where('retrieval_date','LIKE',"{$retrieval_date}%");
        }elseif( !empty($arr['retrieval_date_y']) && empty($arr['retrieval_date_m']) && empty($arr['retrieval_date_d']) ){
          $retrieval_date = $arr['retrieval_date_y']."-";
          $obj->where('retrieval_date','LIKE',"{$retrieval_date}%");
        }elseif( empty($arr['retrieval_date_y']) && !empty($arr['retrieval_date_m']) && !empty($arr['retrieval_date_d']) ){
          $retrieval_date = "-".$arr['retrieval_date_m']."-".$arr['retrieval_date_d'];
          $obj->where('retrieval_date','LIKE',"%{$retrieval_date}");
        }elseif( empty($arr['retrieval_date_y']) && !empty($arr['retrieval_date_m']) && empty($arr['retrieval_date_d']) ){
          $retrieval_date = "-".$arr['retrieval_date_m']."-";
          $obj->where('retrieval_date','LIKE',"%{$retrieval_date}%");
        }
        // var_dump($obj->toSql());
        // exit;

        if ( !empty($arr['last_name']) ) $obj->where('last_name',"{$arr['last_name']}");
        if ( !empty($arr['first_name']) ) $obj->where('first_name',"{$arr['first_name']}");
        if ( !empty($arr['tel']) ) $obj->where('tel',"{$arr['tel']}");
        if ( !empty($arr['mailaddress']) ) $obj->where('mailaddress',"{$arr['mailaddress']}");
        if ( !empty($arr['car_name']) ) $obj->where('car_name',"{$arr['car_name']}");
        if ( !empty($arr['last_name']) ) $obj->where('last_name',"{$arr['last_name']}");
        if ( !empty($arr['license']) ) $obj->where('last_name',"{$arr['last_name']}");

        if ( !empty($arr['inspection_date_y']) && !empty($arr['inspection_date_m']) && !empty($arr['inspection_date_d']) )  {
          $inspection_date = $arr['inspection_date_y']."-".$arr['inspection_date_m']."-".$arr['inspection_date_d'];
          $obj->where('inspection_date',"{$inspection_date}");
        }elseif( !empty($arr['inspection_date_y']) && !empty($arr['inspection_date_m']) && empty($arr['inspection_date_d']) ){
          $inspection_date = $arr['inspection_date_y']."-".$arr['inspection_date_m']."-";
          $obj->where('inspection_date','LIKE',"{$inspection_date}%");
        }elseif( !empty($arr['inspection_date_y']) && empty($arr['inspection_date_m']) && empty($arr['inspection_date_d']) ){
          $inspection_date = $arr['inspection_date_y']."-";
          $obj->where('inspection_date','LIKE',"{$inspection_date}%");
        }elseif( empty($arr['inspection_date_y']) && !empty($arr['inspection_date_m']) && !empty($arr['inspection_date_d']) ){
          $inspection_date = "-".$arr['inspection_date_m']."-".$arr['inspection_date_d'];
          $obj->where('inspection_date','LIKE',"%{$inspection_date}");
        }elseif( empty($arr['inspection_date_y']) && !empty($arr['inspection_date_m']) && empty($arr['inspection_date_d']) ){
          $inspection_date = "-".$arr['inspection_date_m']."-";
          $obj->where('inspection_date','LIKE',"%{$inspection_date}%");
        }
        if (!empty($arr['maintenance_type'])) {
          foreach($arr['maintenance_type'] as $value){
            $obj->where('maintenance_type','LIKE',"%{$value}%");
          }
        }
        if (!empty($arr['maintenance_detail'])) $obj->where('maintenance_detail','LIKE',"%{$arr['maintenance_detail']}%");
        if (!empty($arr['wash'])) $obj->where('wash',"{$arr['wash']}");
        if (!empty($arr['clean'])) $obj->where('clean',"{$arr['clean']}");
        if (!empty($arr['notices'])) {
          foreach($arr['notices'] as $value){
            $obj->where('notices','LIKE',"%{$arr['value']}%");
          }
        }
        if (!empty($arr['notices_detail'])) $obj->where('notices_detail','LIKE',"%{$arr['notices_detail']}%");

        $obj->orderBy('retrieval_date', 'desc');
        Log::debug($obj->toSql()."\n".__FILE__.__LINE__);
        $obj = $obj->get();
        Log::debug(print_r($obj, true).__FILE__.__LINE__);


      } catch(\Exception $e) {

        return 0;
      }

      return $obj;
  }


  /*

	依頼内容の登録

	*/
  public function add_requests($arr)
  {

    Log::debug(print_r($arr, true).__FILE__.__LINE__);
    try {
      // データを挿入
      DB::table('requests')
      ->insertGetId([
        'ID' => NULL,
        'UID' => auth()->user()->id,
        'visible' => 1,
        'storage_date' => $arr['storage_date'],
        'retrieval_date' => $arr['retrieval_date'],
        'last_name' => $arr['last_name'],
        'first_name' => $arr['first_name'],
        'tel' => $arr['tel'],
        'mailaddress' => $arr['mailaddress'],
        'car_name' => $arr['car_name'],
        'model' => $arr['model'],
        'license' => $arr['license'],
        'inspection_date' => $arr['inspection_date'],
        'maintenance_type' => $arr['maintenance_type'],
        'maintenance_detail' => $arr['maintenance_detail'],
        'wash' => $arr['wash'],
        'clean' => $arr['clean'],
        'notices' => $arr['notices'],
        'notices_detail' => $arr['notices_detail']
      ]);

      } catch(\Exception $e) {

        return 0;
      }
      return 1;
  }


  /*

	依頼内容の更新

	*/
  public function edit_requests($arr)
  {
    try {
    // データを挿入
    DB::table('requests')
    ->where('ID', $arr['ID'])
    ->update([
      'visible' => 1,
      'storage_date' => $arr['storage_date'],
      'retrieval_date' => $arr['retrieval_date'],
      'last_name' => $arr['last_name'],
      'first_name' => $arr['first_name'],
      'tel' => $arr['tel'],
      'mailaddress' => $arr['mailaddress'],
      'car_name' => $arr['car_name'],
      'model' => $arr['model'],
      'license' => $arr['license'],
      'inspection_date' => $arr['inspection_date'],
      'maintenance_type' => $arr['maintenance_type'],
      'maintenance_detail' => $arr['maintenance_detail'],
      'wash' => $arr['wash'],
      'clean' => $arr['clean'],
      'notices' => $arr['notices'],
      'notices_detail' => $arr['notices_detail']
    ]);

    } catch(\Exception $e) {
      
      return 0;
    }
    return 1;

  }


  /*

	依頼内容の削除

	*/
  public function del_requests($ID)
  {

    try {
      DB::table('requests')
      ->where('ID', $ID)
      ->update(['visible' => 0]);
    } catch(\Exception $e) {
      return 0;
    }
    return 1;

  }


  /*

	CSVのエキスポート

	*/
  public function export_csv()
  {
    try {
      $uid = auth()->user()->id;
      $user_name = auth()->user()->name;
      Log::debug(print_r($uid, true).__FILE__.__LINE__);
      Log::debug(print_r($user_name, true).__FILE__.__LINE__);
      // 出力項目定義
      $csvlist = $this->csvcolmns();
      Log::debug(print_r($csvlist, true).__FILE__.__LINE__);
      // ファイル名
      $current = time();
      Log::debug(print_r($current, true).__FILE__.__LINE__);
      date_default_timezone_set("Asia/Tokyo");
      $time = date("YmdHi", $current);
      Log::debug(print_r($time, true).__FILE__.__LINE__);
      $filename = $time."_".$user_name.".csv";
      Log::debug(print_r($filename, true).__FILE__.__LINE__);
      // 仮ファイルOpen
      $stream = fopen('php://temp', 'r+b');
      Log::debug(print_r($stream, true).__FILE__.__LINE__);

      // *** ヘッダ行 ***
      // $output = array();
      // foreach($csvlist as $key => $value){
      //   $output[] = $value;
      // }
      // //CSVファイルを出力
      // fputcsv($stream, $output);


      // *** データ行 ***
      $blocksize = 100; // QUERYする単位
      for($i=0 ; true ; $i++) {
        $mr_data = Requests::where('UID',"{$uid}");
        $mr_data->orderBy('retrieval_date', 'desc');
        $mr_data->skip($i * $blocksize); // 取得開始位置
        $mr_data->take($blocksize); // 取得件数を指定
        $lists = $mr_data->get();
        // レコードあるか？
        if ($lists->count() == 0) {
          break;
        }
        foreach ($lists as $list) {
          $output = array();
          foreach ($csvlist as $key => $value) {
            $output[] = str_replace(array("\r\n", "\r", "\n"), '', $list->$key);
          }
          // CSVファイルを出力
          fputcsv($stream, $output);
        }
      }

      // ポインタの先頭へ
      rewind($stream);
      // 改行変換
      $csv = str_replace(PHP_EOL, "\r\n", stream_get_contents($stream));
      Log::debug(print_r($csv, true).__FILE__.__LINE__);
      // 文字コード変換
      $csv = mb_convert_encoding($csv, 'SJIS-win', 'UTF-8');
      Log::debug(print_r($csv, true).__FILE__.__LINE__);
      // header
      $headers = array(
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="'.$filename.'"',
      );
      Log::debug(print_r($headers, true).__FILE__.__LINE__);
      // return \Response::make($csv, 200, $headers);
    } catch(\Exception $e) {
      return 0;
    }
    return array($csv, $headers);
  }

  /*

	CSVのインポート

	*/
  public function import_csv($file_path)
  {
    try {
      $uid = auth()->user()->id;
      Log::debug(print_r($uid, true).__FILE__.__LINE__);

      // CSV取得
      $file = new \SplFileObject($file_path);
      Log::debug(print_r($file, true).__FILE__.__LINE__);

      $file->setFlags(
        \SplFileObject::READ_CSV |// CSVとして行を読み込み
        \SplFileObject::READ_AHEAD |// 先読み／巻き戻しで読み込み
        \SplFileObject::SKIP_EMPTY |// 空行を読み飛ばす
        \SplFileObject::DROP_NEW_LINE// 行末の改行を読み飛ばす
      );
      // 一行ずつ処理
      foreach($file as $line) {
        $storage_date = mb_convert_encoding($line[0], 'UTF-8', 'SJIS');
        $retrieval_date = mb_convert_encoding($line[1], 'UTF-8', 'SJIS');
        $last_name = mb_convert_encoding( $line[2], 'UTF-8', 'SJIS');
        $first_name = mb_convert_encoding( $line[3], 'UTF-8', 'SJIS');
        $tel = mb_convert_encoding( $line[4], 'UTF-8', 'SJIS');
        $mailaddress = mb_convert_encoding( $line[5], 'UTF-8', 'SJIS');
        $car_name = mb_convert_encoding( $line[6], 'UTF-8', 'SJIS');
        $model = mb_convert_encoding( $line[7], 'UTF-8', 'SJIS');
        $license = mb_convert_encoding( $line[8], 'UTF-8', 'SJIS');
        $inspection_date = mb_convert_encoding($line[9], 'UTF-8', 'SJIS');
        $maintenance_type = mb_convert_encoding( $line[10], 'UTF-8', 'SJIS');
        $maintenance_detail = mb_convert_encoding( $line[11], 'UTF-8', 'SJIS');
        $wash = mb_convert_encoding( $line[12], 'UTF-8', 'SJIS');
        $clean = mb_convert_encoding( $line[13], 'UTF-8', 'SJIS');
        $notices = mb_convert_encoding( $line[14], 'UTF-8', 'SJIS');
        $notices_detail = mb_convert_encoding( $line[15], 'UTF-8', 'SJIS');

        $storage_date = $this->date_check($storage_date);
        $retrieval_date = $this->date_check($retrieval_date);
        $inspection_date = $this->date_check($inspection_date);

        // var_dump($retrieval_date);
        // exit;



        DB::table('requests')
        ->insertGetId(
          ['ID' => NULL,
          'visible' => 1,
          'storage_date' => $storage_date,
          'retrieval_date' => $retrieval_date,
          'last_name' => $last_name,
          'first_name' => $first_name,
          'tel' => $tel,
          'mailaddress' => $mailaddress,
          'car_name' => $car_name,
          'model' => $model,
          'license' => $license,
          'inspection_date' => $inspection_date,
          'maintenance_type' => $maintenance_type,
          'maintenance_detail' => $maintenance_detail,
          'wash' => $wash,
          'clean' => $clean,
          'notices' => $notices,
          'notices_detail' => $notices_detail
          ,'UID' => $uid
        ]);
      }
    } catch(\Exception $e) {
      var_dump($e->getMessage());
      exit;
        return 0;
    }
    return 1;


  }


  /*

	CSV取得カラムの記述

	*/
  public function csvcolmns()
  {

    $csvlist = array(
      'storage_date' => '入庫日',
      'retrieval_date' => '納車予定日',
      'last_name' => 'お客様氏名(姓)',
      'first_name' => 'お客様氏名(名)',
      'tel' => '電話番号',
      'mailaddress' => 'メールアドレス',
      'car_name' => '車種名',
      'model' => '型式',
      'license' => '登録番号',
      'inspection_date' => '車検証の有効期限',
      'maintenance_type' => '整備の種類',
      'maintenance_detail' => '整備内容',
      'wash' => '洗車の有無',
      'clean' => '車内清掃の有無',
      'notices' => '特記事項',
      'notices_detail' => '特記事項詳細'
    );
    return $csvlist;

  }

}
