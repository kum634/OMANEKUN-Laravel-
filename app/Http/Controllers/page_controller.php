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

class page_controller extends connect_controller
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

  	今週の開始日と終了日の取得

  	*/

    public function get_this_week()
    {

      //日本時間を取得
      date_default_timezone_set('Asia/Tokyo');
      //今日の曜日を取得
      $weekNo = date('w', strtotime('today'));
      Log::debug(print_r($weekNo, true).__FILE__.__LINE__);

      //今週の週初めの年月日を取得
      $start_date = date('m/d', strtotime("-{$weekNo} day", strtotime('today')));
      Log::debug(print_r($start_date, true).__FILE__.__LINE__);

      //今週の週終わりの年月日を取得
      $daysLeft = 6 - $weekNo;
      Log::debug(print_r($daysLeft, true).__FILE__.__LINE__);

      $end_date = date('m/d', strtotime("+{$daysLeft} day", strtotime('today')));
      Log::debug(print_r($end_date, true).__FILE__.__LINE__);

      $week = array(
  			'start_date' => $start_date,
  			'end_date' => $end_date
  		);
      Log::debug(print_r($week, true).__FILE__.__LINE__);

  		return $week;

    }


  	/*

  	テーブルの作成

  	*/

  	public function create_requests_table($obj, $alert = false)
    {

      $tbl = '';
      // var_dump($obj);
      // exit;
  		$cnt = $obj->count();
      Log::debug(print_r($cnt, true).__FILE__.__LINE__);

  		if (!$cnt || $cnt <= 0) {
  			if ($alert !== false) $tbl.=  "<script type='text/javascript'>alert('一致するデータがありませんでした。');</script>";
  			$tbl.=  '<div class="result_title"><h2>一致する整備依頼がありません。</h2></div>';
  			return $tbl;
  		}

  		if ($alert !== false) $tbl.=  '<script type="text/javascript">alert("'.$cnt.' 件該当しました。");</script>';
  		$tbl.=  '<div class="result_title"><h2>該当件数 '.$cnt.' 件</h2></div>';
  		$tbl.=  '<table style="width: 90%;font-size: 90%;" id="datatable-example" class="nowrap table table-striped text-left">';
  		$tbl.=  ' <thead class="thead-dark">';
  		$tbl.=  '  <tr>';
  		$tbl.=  '	  <th scope="col">入庫日</th><th>納車予定日</th>';
  		$tbl.=  '	  <th scope="col">お客様氏名</th><th>車種名</th>';
  		$tbl.=  '	  <th scope="col">型式</th><th>登録番号</th>';
  		$tbl.=  '	  <th scope="col">整備の種類</th>';
  		$tbl.=  '	  <th scope="col"></th>';
  		$tbl.=  '  </tr>';
  		$tbl.=  ' </thead>';
  		$tbl.=  '<tbody>';

  		foreach ($obj as $requests) {
  			if ($requests->tel == "0") $requests->tel = '';
  			if ($requests->retrieval_date == "0000-00-00") $requests->retrieval_date = '';
  			if ($requests->inspection_date == "0000-00-00") $requests->inspection_date = '';

  			$tbl.=  ' <tr>';
  			$tbl.=  '	 <td>'.$requests->storage_date.'</td>';
  			$tbl.=  '	 <td>'.$requests->retrieval_date.'</td>';
  			$tbl.=  '	 <td>'.$requests->last_name.' '.$requests->first_name.'</td>';
  			$tbl.=  '	 <td>'.$requests->car_name.'</td>';
  			$tbl.=  '	 <td>'.$requests->model.'</td>';
  			$tbl.=  '	 <td>'.$requests->license.'</td>';
  			$tbl.=  '	 <td>'.$requests->maintenance_type.'</td>';
  			$tbl.=  '	 <td>';
  			$tbl.=  '			<button
  										data-id="'.$requests->ID.'" data-storage_date="'.$requests->storage_date.'" data-retrieval_date="'.$requests->retrieval_date.'"
  										data-last_name="'.$requests->last_name.'" data-first_name="'.$requests->first_name.'" data-tel="'.$requests->tel.'" data-mailaddress="'.$requests->mailaddress.'"
  										data-car_name="'.$requests->car_name.'" data-model="'.$requests->model.'" data-license="'.$requests->license.'"
  										data-inspection_date="'.$requests->inspection_date.'" data-maintenance_type="'.$requests->maintenance_type.'" data-maintenance_detail="'.$requests->maintenance_detail.'"
  										data-wash="'.$requests->wash.'" data-clean="'.$requests->clean.'" data-notices="'.$requests->notices.'" data-notices="'.$requests->notices.'" data-notices_detail="'.$requests->notices_detail.'"
  									class="btn btn-lg btn-success" data-toggle="modal" data-mode="detail" data-action="'.url("/edit").'" data-target="#modal-detail">詳細</button>';
  			$tbl.=  '			<button type="button" class="del btn btn-lg btn-success" data-id="'.$requests->ID.'">削除</button>';
  			$tbl.=  '	 </td>';
  			$tbl.=  "  </tr>\n";
  		}

  		$tbl.=  " </tbody>\n";
  		$tbl.=  "</table>\n" ;

  		foreach ($obj as $requests) {
  			$tbl.=  '<div class="modal fade" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="label1" aria-hidden="true">';
  			$tbl.=  '  <div class="modal-dialog" role="document">';
  			$tbl.=  '    <div class="modal-content">';
  			$tbl.=  '      <div class="modal-header">';
  			$tbl.=  '        <h5 class="modal-title" id="label1"></h5>';
  			$tbl.=  '        <button type="button" class="close" data-dismiss="modal" aria-label="Close">';
  			$tbl.=  '          <span aria-hidden="true">&times;</span>';
  			$tbl.=  '        </button>';
  			$tbl.=  '      </div>';
  			$tbl.=  view('parts.detail');
  			$tbl.=  view('parts.form');
  			$tbl.=  '    </div>';
  			$tbl.=  '  </div>';
  			$tbl.=  '</div>';
  		}
      return $tbl;
  	}

  	/*

  	データの集約

  	*/

  	public function data_ag($request, $insert = false) {

  		Log::debug(print_r($insert, true).__FILE__.__LINE__);
  		if ($insert === true) {
  			$notices = implode( ',', (array)$request->input('notices') );
        Log::debug(print_r($notices, true).__FILE__.__LINE__);
  			$maintenance_type = implode( ',', (array)$request->input('maintenance_type') );
        Log::debug(print_r($maintenance_type, true).__FILE__.__LINE__);
  		} else {
  			$notices = $request->input('notices');
        Log::debug(print_r($notices, true).__FILE__.__LINE__);
  			$maintenance_type = $request->input('maintenance_type');
        Log::debug(print_r($maintenance_type, true).__FILE__.__LINE__);
  		}
  		$arr = array(
  			'storage_date_y' => htmlspecialchars( $request->input('storage_date_y'), ENT_QUOTES ),
  			'storage_date_m' => htmlspecialchars( $request->input('storage_date_m'), ENT_QUOTES ),
  			'storage_date_d' => htmlspecialchars( $request->input('storage_date_d'), ENT_QUOTES ),
  			'retrieval_date_y' => htmlspecialchars( $request->input('retrieval_date_y'), ENT_QUOTES ),
  			'retrieval_date_m' => htmlspecialchars( $request->input('retrieval_date_m'), ENT_QUOTES ),
  			'retrieval_date_d' => htmlspecialchars( $request->input('retrieval_date_d'), ENT_QUOTES ),
  			'last_name' => htmlspecialchars($request->input('last_name'), ENT_QUOTES ),
  			'first_name' => htmlspecialchars($request->input('first_name'), ENT_QUOTES ),
  			'tel' => htmlspecialchars($request->input('tel'), ENT_QUOTES ),
  			'mailaddress' => htmlspecialchars($request->input('mailaddress'), ENT_QUOTES ),
  			'car_name' => htmlspecialchars($request->input('car_name'), ENT_QUOTES ),
  			'model' => htmlspecialchars($request->input('model'), ENT_QUOTES ),
  			'license' => htmlspecialchars($request->input('license'), ENT_QUOTES ),
  			'inspection_date_y' => htmlspecialchars( $request->input('inspection_date_y'), ENT_QUOTES ),
  			'inspection_date_m' => htmlspecialchars( $request->input('inspection_date_m'), ENT_QUOTES ),
  			'inspection_date_d' => htmlspecialchars( $request->input('inspection_date_d'), ENT_QUOTES ),
  			'maintenance_type' => $maintenance_type,
  			'maintenance_detail' => htmlspecialchars($request->input('maintenance_detail'), ENT_QUOTES ),
  			'wash' => htmlspecialchars($request->input('wash'), ENT_QUOTES ),
  			'clean' => htmlspecialchars($request->input('clean'), ENT_QUOTES ),
  			'notices' => $notices,
  			'notices_detail' => htmlspecialchars($request->input('notices_detail'), ENT_QUOTES )
  		);

  		$arr +=  array('storage_date' => $arr[ "storage_date_y" ].'-'.$arr[ "storage_date_m" ].'-'.$arr[ "storage_date_d" ]);
  		$arr +=  array('inspection_date' => $arr[ "inspection_date_y" ].'-'.$arr[ "inspection_date_m" ].'-'.$arr[ "inspection_date_d" ]);
  		$arr +=  array('retrieval_date' => $arr[ "retrieval_date_y" ].'-'.$arr[ "retrieval_date_m" ].'-'.$arr[ "retrieval_date_d" ]);

  		if ($arr['storage_date'] == '--') $arr['storage_date'] =  date("Y").'-'.date("m").'-'.date("d");
  		if ($arr['inspection_date'] == '--') $arr['inspection_date'] =  null;
  		if ($arr['retrieval_date'] == '--') $arr['retrieval_date'] =  null;

  		if ($request->input('mode') == 'edit' && !empty($request->input('id')) ) $arr +=  array('ID' => $request->input('id'));

      Log::debug(print_r($arr, true).__FILE__.__LINE__);
  		return $arr;
  	}

    /*

  	検索によって得られた作業内容を出力

  	*/

		public function search_requests(Request $request)
    {

			$data = $this->data_ag($request);
      Log::debug(print_r($data, true).__FILE__.__LINE__);

	    if (!is_array($data)) return redirect("/history")->with('message', '不具合が発生しました。');
			$obj = $this->get_requests($data);
      Log::debug(print_r($obj, true).__FILE__.__LINE__);

      if (is_int($obj) && $obj == 0) return redirect("/history")->with('message', '検索に失敗しました。');
	    $tbl = $this->create_requests_table($obj);
      Log::debug(print_r($tbl, true).__FILE__.__LINE__);

      $view = view('history');
      $view->tbl = $tbl;
      $view->dbg = $obj;
      return $view;

		}

    /*

  	データベースへの挿入

  	*/

		public function reg_requests(Request $request)
    {
      $mode = $request->input('mode');
      Log::debug(print_r($mode, true).__FILE__.__LINE__);

			$data = $this->data_ag($request, true);
      Log::debug(print_r($data, true).__FILE__.__LINE__);

      if ( is_array($data) && $mode == 'add' ) {

        $res = $this->add_requests($data);
        Log::debug(print_r($res, true).__FILE__.__LINE__);

        if ($res == 1) $bs_alert = '登録に成功しました。';
        else $bs_alert = '登録に失敗しました。';

      } elseif ( is_array($data) && $mode == 'edit' ) {

        $res = $this->edit_requests($data);
        Log::debug(print_r($res, true).__FILE__.__LINE__);

        if ($res == 1) $bs_alert = '更新に成功しました。';
        else $bs_alert = '更新に失敗しました。';

      }

      Log::debug(print_r($bs_alert, true).__FILE__.__LINE__);

      return back()->withInput()->with('message', $bs_alert);
      // return redirect("/history")->with('message', $bs_alert);

		}

    /*

  	CSVの処理

  	*/

		public function csv_use(Request $request)
    {
      $password = auth()->user()->password;
      Log::debug(print_r($password, true).__FILE__.__LINE__);
      Log::debug(print_r($request->input('password'), true).__FILE__.__LINE__);
      Log::debug(print_r($request->input('csv_mode'), true).__FILE__.__LINE__);

      if ($request->input('password') == '') {
        if ($request->input('csv_mode') == 'ex') {
          return redirect("export")->with('error_message','パスワードを入力してください。');
        }
        if ($request->input('csv_mode') == 'im') {
          return redirect("import")->with('error_message','パスワードを入力してください。');
        }
      }
      if (!Hash::check($request->input('password'), $password)) {
        if ($request->input('csv_mode') == 'ex') {
          return redirect("export")->with('error_message','パスワードが間違っています。');
        }
        if ($request->input('csv_mode') == 'im') {
          return redirect("import")->with('error_message','パスワードが間違っています。');
        }
      }

      if ($request->input('csv_mode') == 'ex') {

        $data = $this->export_csv();
        Log::debug(print_r($data, true).__FILE__.__LINE__);

        if ($data == 0) return redirect("export")->with('error_message', 'エキスポートに失敗しました。');
        return \Response::make($data[0], 200, $data[1]);
      }
      if ($request->input('csv_mode') == 'im') {

        $this->csvfile_check($request);

        // アップロードファイルのファイルパスを取得
        $file_path = $request->file('csvfile')->path();
        Log::debug(print_r($file_path, true).__FILE__.__LINE__);

        $res = $this->import_csv($file_path);
        Log::debug(print_r($res, true).__FILE__.__LINE__);

        if ($res == 1) return redirect("import")->with('message','インポートに成功しました。');
        else return redirect('import')->with('error_message', 'インポートに失敗しました。');

      }


		}

		/*

		アップロードしたCSVファイルの判定

		*/

		public function csvfile_check($request)
    {
      Log::debug(print_r($request->hasFile('csvfile'), true).__FILE__.__LINE__);
      if (!$request->hasFile('csvfile')) {
        return redirect('import')->with('error_message', 'ファイルが選択されていません。');
      }

      $file_name = $_FILES["csvfile"]["name"];
      Log::debug(print_r($file_name, true).__FILE__.__LINE__);

      if (pathinfo($file_name, PATHINFO_EXTENSION) != 'csv') {
        return redirect('import')->with('error_message',  'CSVファイルのみ対応しています。');
      }
		}

    /*

  	ajax処理

  	*/

		public function ajax(Request $request)
    {

      if ($request->input('ajax_mode') == 'del') {

        $res = $this->del_requests($request->input('id'));
        $data = array(
          'res' => $res,
          'ajax_mode' => $request->input('ajax_mode')
        );
        return $data;
      }

		}

    /*

  	退会

  	*/

    public function erasure(Request $request) {

      $user_name = auth()->user()->name;
      $password = auth()->user()->password;
      $email = auth()->user()->email;
      Log::debug(print_r($user_name, true).__FILE__.__LINE__);
      Log::debug(print_r($password, true).__FILE__.__LINE__);
      Log::debug(print_r($email, true).__FILE__.__LINE__);
      Log::debug(print_r($request->input('password'), true).__FILE__.__LINE__);

      if ($request->input('password') == '') {
        //退会画面へリダイレクト
        return redirect("withdrawal")->with('error_message','パスワードを入力してください。');
      }
      if ($user_name == "guest" && $email == "u.kei0424@gmail.com") {
        //退会画面へリダイレクト
        return redirect("withdrawal")->with('error_message','テスト用ユーザー情報は削除できません。');
      }
      if (!Hash::check($request->input('password'), $password)) {
        //退会画面へリダイレクト
        return redirect("withdrawal")->with('error_message','パスワードが間違っています。');
      }

      if ($this->del_user() == 0) {
        return redirect("withdrawal")->with('error_message','退会処理に失敗しました。');
      }
      if ($this->del_all_Requests() == 0) {
        return redirect("withdrawal")->with('error_message','退会処理に失敗しました。');
      }

      return redirect("register")->with('message','ご利用ありがとうございました。');
    }

}
