<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// データベース
use Illuminate\Support\Facades\DB;
// Eloquent
use App\Maintenance_requests;
// 認証
use Illuminate\Support\Facades\Auth;
//現在のパスワードをチェックする
use Illuminate\Support\Facades\Hash;
// デバッグ
use Log;

class omanekun_controller extends Controller
{

  /**
  * Create a new controller instance.
  *
  * @return void
  */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
  * Show the application dashboard.
  *
  * @return \Illuminate\Http\Response
  */

  public function index(){

    //ログインしていなければログイン画面にリダイレクトする。
    if(!auth()->check()){
      return redirect('login');
    }


    //ユーザーIDを取得
    $user = auth()->user();
    $identify_ID = $user->id;

    //日本時間を取得
    date_default_timezone_set('Asia/Tokyo');
    //今日の曜日を取得
    $weekNo = date('w', strtotime('today'));
    //今週の週初めの年月日を取得
    $startDate = date('m/d', strtotime("-{$weekNo} day", strtotime('today')));
    //今週の週終わりの年月日を取得
    $daysLeft = 6 - $weekNo;
    $endDate = date('m/d', strtotime("+{$daysLeft} day", strtotime('today')));

    //結果を取得
    $mr_data = DB::table('maintenance_request_table')
    ->whereRaw("yearweek(`nyuko_bi`) = yearweek(curdate())")
    ->orWhereRaw("yearweek(`nyuko_bi`) = yearweek(curdate())")
    ->WhereRaw("identify_ID = '{$identify_ID}'")
    ->orderBy('nousya_yoteibi', 'asc')
    ->get();

    //取得結果を返す
    $view = view('index');
    $view->startDate = $startDate;
    $view->endDate = $endDate;
    $view->mr_data = $mr_data;
    $view->mr_count = $mr_data->count();;
    return $view;

  }


  public function input() {

    //ログインしていなければログイン画面にリダイレクトする。
    if(!auth()->check()){
      return redirect('login');
    }
    //ユーザーIDを取得
    $user = auth()->user();
    $identify_ID = $user->id;
    //画面を表示
    $view = view('input');
    return $view;

  }


  public function data_Register(Request $request) {

    //ログインしていなければログイン画面にリダイレクトする。
    if(!auth()->check()){
      return redirect('login');
    }
    //ユーザーIDを取得
    $user = auth()->user();
    $identify_ID = $user->id;
    //入力した値を受け取る
    $nyuko_bi_y = htmlspecialchars( $request->input('nyuko_bi_y'), ENT_QUOTES );
    $nyuko_bi_m = htmlspecialchars( $request->input('nyuko_bi_m'), ENT_QUOTES );
    $nyuko_bi_d = htmlspecialchars( $request->input('nyuko_bi_d'), ENT_QUOTES );
    $nyuko_bi = $nyuko_bi_y."-".$nyuko_bi_m."-".$nyuko_bi_d;
    $nousya_yoteibi_y = htmlspecialchars( $request->input('nousya_yoteibi_y'), ENT_QUOTES );
    $nousya_yoteibi_m = htmlspecialchars( $request->input('nousya_yoteibi_m'), ENT_QUOTES );
    $nousya_yoteibi_d = htmlspecialchars( $request->input('nousya_yoteibi_d'), ENT_QUOTES );
    $nousya_yoteibi = $nousya_yoteibi_y."-".$nousya_yoteibi_m."-".$nousya_yoteibi_d;
    $sei = htmlspecialchars( $request->input('sei'), ENT_QUOTES );
    $mei = htmlspecialchars( $request->input('mei'), ENT_QUOTES );
    $tel = htmlspecialchars( $request->input('tel'), ENT_QUOTES );
    $mail = htmlspecialchars( $request->input('mail'), ENT_QUOTES );
    $car_name = htmlspecialchars( $request->input('car_name'), ENT_QUOTES );
    $katasiki = htmlspecialchars( $request->input('katasiki'), ENT_QUOTES );
    $tourokubangou = htmlspecialchars( $request->input('tourokubangou'), ENT_QUOTES );
    $syakenmanryou_bi_y = htmlspecialchars( $request->input('syakenmanryou_bi_y'), ENT_QUOTES );
    $syakenmanryou_bi_m = htmlspecialchars( $request->input('syakenmanryou_bi_m'), ENT_QUOTES );
    $syakenmanryou_bi_d = htmlspecialchars( $request->input('syakenmanryou_bi_d'), ENT_QUOTES );
    $syakenmanryou_bi = $syakenmanryou_bi_y."-".$syakenmanryou_bi_m."-".$syakenmanryou_bi_d;
    $seibi_syurui = $request->input('seibi_syurui');
    if(!empty($seibi_syurui)){
      $seibi_syurui = implode( '、', $seibi_syurui );
      $seibi_syurui = htmlspecialchars( $seibi_syurui, ENT_QUOTES );
    }else {
      $seibi_syurui = htmlspecialchars( $seibi_syurui, ENT_QUOTES );
    }
    $seibi_naiyou = htmlspecialchars( $request->input('seibi_naiyou'), ENT_QUOTES );
    $sensya = htmlspecialchars( $request->input('sensya'), ENT_QUOTES );
    $syanaiseisou = htmlspecialchars( $request->input('syanaiseisou'), ENT_QUOTES );
    $tokki_zikou = $request->input('tokki_zikou');
    if(!empty($tokki_zikou)){
      $tokki_zikou = implode( '、', $tokki_zikou );
      $tokki_zikou = htmlspecialchars( $tokki_zikou, ENT_QUOTES );
    }else {
      $tokki_zikou = htmlspecialchars( $tokki_zikou, ENT_QUOTES );
    }
    $tokki_zikou_syousai = htmlspecialchars( $request->input('tokki_zikou_syousai'), ENT_QUOTES );
    // データを挿入
    DB::table('maintenance_request_table')
    ->insertGetId(
      ['ID' => 'NULL',
      'nyuko_bi' => $nyuko_bi,
      'nousya_yoteibi' => $nousya_yoteibi,
      'sei' => $sei,
      'mei' => $mei,
      'tel' => $tel,
      'mail' => $mail,
      'car_name' => $car_name,
      'katasiki' => $katasiki,
      'tourokubangou' => $tourokubangou,
      'syakenmanryou_bi' => $syakenmanryou_bi,
      'seibi_syurui' => $seibi_syurui,
      'seibi_naiyou' => $seibi_naiyou,
      'sensya' => $sensya,
      'syanaiseisou' => $syanaiseisou,
      'tokki_zikou' => $tokki_zikou,
      'tokki_zikou_syousai' => $tokki_zikou_syousai,
      'identify_ID' => $identify_ID ]);
      return redirect("input")->with('message','データの登録に成功しました。');

    }

    public function seach_display() {

      //ログインしていなければログイン画面にリダイレクトする。
      if(!auth()->check()){
        return redirect('login');
      }
      //ユーザーIDを取得
      $user = auth()->user();
      $identify_ID = $user->id;
      //検索結果表示の初期値を設定
      $mr_count = "初期値";
      //画面を表示
      $view = view('seach_display');
      $view->mr_count = $mr_count;
      return $view;

    }

    public function seach_result(Request $request) {

      //ログインしていなければログイン画面にリダイレクトする。
      if(!auth()->check()){
        return redirect('login');
      }
      //ユーザーIDを取得
      $user = auth()->user();
      $identify_ID = $user->id;
      //入力した値を受け取る
      $nyuko_bi_y = htmlspecialchars( $request->input('nyuko_bi_y'), ENT_QUOTES );
      $nyuko_bi_m = htmlspecialchars( $request->input('nyuko_bi_m'), ENT_QUOTES );
      $nyuko_bi_d = htmlspecialchars( $request->input('nyuko_bi_d'), ENT_QUOTES );
      $nousya_yoteibi_y = htmlspecialchars( $request->input('nousya_yoteibi_y'), ENT_QUOTES );
      $nousya_yoteibi_m = htmlspecialchars( $request->input('nousya_yoteibi_m'), ENT_QUOTES );
      $nousya_yoteibi_d = htmlspecialchars( $request->input('nousya_yoteibi_d'), ENT_QUOTES );
      $sei = htmlspecialchars($request->input('sei'), ENT_QUOTES ) ;
      $mei = htmlspecialchars($request->input('mei'), ENT_QUOTES ) ;
      $tel = htmlspecialchars($request->input('tel'), ENT_QUOTES ) ;
      $mail = htmlspecialchars($request->input('mail'), ENT_QUOTES ) ;
      $car_name = htmlspecialchars($request->input('car_name'), ENT_QUOTES ) ;
      $katasiki = htmlspecialchars($request->input('katasiki'), ENT_QUOTES ) ;
      $tourokubangou = htmlspecialchars($request->input('tourokubangou'), ENT_QUOTES ) ;
      $syakenmanryou_bi_y = htmlspecialchars( $request->input('syakenmanryou_bi_y'), ENT_QUOTES );
      $syakenmanryou_bi_m = htmlspecialchars( $request->input('syakenmanryou_bi_m'), ENT_QUOTES );
      $syakenmanryou_bi_d = htmlspecialchars( $request->input('syakenmanryou_bi_d'), ENT_QUOTES );
      $seibi_syurui = $request->input('seibi_syurui') ;
      $seibi_naiyou = htmlspecialchars($request->input('seibi_naiyou'), ENT_QUOTES ) ;
      $sensya = htmlspecialchars($request->input('sensya'), ENT_QUOTES ) ;
      $syanaiseisou = htmlspecialchars($request->input('syanaiseisou'), ENT_QUOTES ) ;
      $tokki_zikou = $request->input('tokki_zikou') ;
      $tokki_zikou_syousai = htmlspecialchars($request->input('tokki_zikou_syousai'), ENT_QUOTES ) ;
      //検索結果を取得
      $mr_data = Maintenance_requests::where('identify_ID',"{$identify_ID}");

      if ( !empty($nyuko_bi_y) && !empty($nyuko_bi_m) && !empty($nyuko_bi_d) )  {
        $nyuko_bi = $nyuko_bi_y."-".$nyuko_bi_m."-".$nyuko_bi_d;
        $mr_data->where('nyuko_bi',"{$nyuko_bi}");
      }elseif( !empty($nyuko_bi_y) && !empty($nyuko_bi_m) && empty($nyuko_bi_d) ){
        $nyuko_bi = $nyuko_bi_y."-".$nyuko_bi_m."-";
        $mr_data->where('nyuko_bi','LIKE',"{$nyuko_bi}%");
      }elseif( !empty($nyuko_bi_y) && empty($nyuko_bi_m) && empty($nyuko_bi_d) ){
        $nyuko_bi = $nyuko_bi_y."-";
        $mr_data->where('nyuko_bi','LIKE',"{$nyuko_bi}%");
      }elseif( empty($nyuko_bi_y) && !empty($nyuko_bi_m) && !empty($nyuko_bi_d) ){
        $nyuko_bi = "-".$nyuko_bi_m."-".$nyuko_bi_d;
        $mr_data->where('nyuko_bi','LIKE',"%{$nyuko_bi}");
      }elseif( empty($nyuko_bi_y) && empty($nyuko_bi_m) && !empty($nyuko_bi_d) ){
        $nyuko_bi = "-".$nyuko_bi_d;
        $query_count .= " AND nyuko_bi like '%{$nyuko_bi}' " ;
        $mr_data->where('nyuko_bi','LIKE',"%{$nyuko_bi}");
      }elseif( !empty($nyuko_bi_y) && empty($nyuko_bi_m) && !empty($nyuko_bi_d) ){
        $nyuko_bi_l = $nyuko_bi_y."-";
        $nyuko_bi_r = "-".$nyuko_bi_d;
        $mr_data->where('nyuko_bi','LIKE',"{$nyuko_bi_l}%");
        $mr_data->where('nyuko_bi','LIKE',"%{$nyuko_bi_r}");
      }elseif( empty($nyuko_bi_y) && !empty($nyuko_bi_m) && empty($nyuko_bi_d) ){
        $nyuko_bi = "-".$nyuko_bi_m."-";
        $mr_data->where('nyuko_bi','LIKE',"%{$nyuko_bi}%");
      }
      if ( !empty($nousya_yoteibi_y) && !empty($nousya_yoteibi_m) && !empty($nousya_yoteibi_d) )  {
        $nousya_yoteibi = $nousya_yoteibi_y."-".$nousya_yoteibi_m."-".$nousya_yoteibi_d;
        $mr_data->where('nousya_yoteibi',"{$nousya_yoteibi}");
      }elseif( !empty($nousya_yoteibi_y) && !empty($nousya_yoteibi_m) && empty($nousya_yoteibi_d) ){
        $nousya_yoteibi = $nousya_yoteibi_y."-".$nousya_yoteibi_m."-";
        $mr_data->where('nousya_yoteibi','LIKE',"{$nousya_yoteibi}%");
      }elseif( !empty($nousya_yoteibi_y) && empty($nousya_yoteibi_m) && empty($nousya_yoteibi_d) ){
        $nousya_yoteibi = $nousya_yoteibi_y."-";
        $mr_data->where('nousya_yoteibi','LIKE',"{$nousya_yoteibi}%");
      }elseif( empty($nousya_yoteibi_y) && !empty($nousya_yoteibi_m) && !empty($nousya_yoteibi_d) ){
        $nousya_yoteibi = "-".$nousya_yoteibi_m."-".$nousya_yoteibi_d;
        $mr_data->where('nousya_yoteibi','LIKE',"%{$nousya_yoteibi}");
      }elseif( empty($nousya_yoteibi_y) && empty($nousya_yoteibi_m) && !empty($nousya_yoteibi_d) ){
        $nousya_yoteibi = "-".$nousya_yoteibi_d;
        $mr_data->where('nousya_yoteibi','LIKE',"%{$nousya_yoteibi}");
      }elseif( !empty($nousya_yoteibi_y) && empty($nousya_yoteibi_m) && !empty($nousya_yoteibi_d) ){
        $nousya_yoteibi_l = $nousya_yoteibi_y."-";
        $nousya_yoteibi_r = "-".$nousya_yoteibi_d;
        $mr_data->where('nousya_yoteibi','LIKE',"{$nousya_yoteibi}%");
        $mr_data->where('nousya_yoteibi','LIKE',"%{$nousya_yoteibi}");
      }elseif( empty($nousya_yoteibi_y) && !empty($nousya_yoteibi_m) && empty($nousya_yoteibi_d) ){
        $nousya_yoteibi = "-".$nousya_yoteibi_m."-";
        $mr_data->where('nousya_yoteibi','LIKE',"%{$nousya_yoteibi}%");
      }
      if ( $sei != "" ) {
        $mr_data->where('sei',"{$sei}");
      }
      if ( $mei != "" ) {
        $mr_data->where('mei',"{$mei}");
      }
      if ( $tel != "" ) {
        $mr_data->where('tel',"{$tel}");
      }
      if ( $mail != "" ) {
        $mr_data->where('mail',"{$mail}");
      }
      if ( $car_name != "" ) {
        $mr_data->where('car_name',"{$car_name}");
      }
      if ( $katasiki != "" ) {
        $mr_data->where('sei',"{$sei}");
      }
      if ( $tourokubangou != "" ) {
        $mr_data->where('sei',"{$sei}");
      }
      if ( !empty($syakenmanryou_bi_y) && !empty($syakenmanryou_bi_m) && !empty($syakenmanryou_bi_d) )  {
        $syakenmanryou_bi = $syakenmanryou_bi_y."-".$syakenmanryou_bi_m."-".$syakenmanryou_bi_d;
        $mr_data->where('syakenmanryou_bi',"{$syakenmanryou_bi}");
      }elseif( !empty($syakenmanryou_bi_y) && !empty($syakenmanryou_bi_m) && empty($syakenmanryou_bi_d) ){
        $syakenmanryou_bi = $syakenmanryou_bi_y."-".$syakenmanryou_bi_m."-";
        $mr_data->where('syakenmanryou_bi','LIKE',"{$syakenmanryou_bi}%");
      }elseif( !empty($syakenmanryou_bi_y) && empty($syakenmanryou_bi_m) && empty($syakenmanryou_bi_d) ){
        $syakenmanryou_bi = $syakenmanryou_bi_y."-";
        $mr_data->where('syakenmanryou_bi','LIKE',"{$syakenmanryou_bi}%");
      }elseif( empty($syakenmanryou_bi_y) && !empty($syakenmanryou_bi_m) && !empty($syakenmanryou_bi_d) ){
        $syakenmanryou_bi = "-".$syakenmanryou_bi_m."-".$syakenmanryou_bi_d;
        $mr_data->where('syakenmanryou_bi','LIKE',"%{$syakenmanryou_bi}");
      }elseif( empty($syakenmanryou_bi_y) && empty($syakenmanryou_bi_m) && !empty($syakenmanryou_bi_d) ){
        $syakenmanryou_bi = "-".$syakenmanryou_bi_d;
        $mr_data->where('syakenmanryou_bi','LIKE',"%{$syakenmanryou_bi}");
      }elseif( !empty($syakenmanryou_bi_y) && empty($syakenmanryou_bi_m) && !empty($syakenmanryou_bi_d) ){
        $syakenmanryou_bi_l = $syakenmanryou_bi_y."-";
        $syakenmanryou_bi_r = "-".$syakenmanryou_bi_d;
        $mr_data->where('syakenmanryou_bi','LIKE',"{$syakenmanryou_bi}%");
        $mr_data->where('syakenmanryou_bi','LIKE',"%{$syakenmanryou_bi}");
      }elseif( empty($syakenmanryou_bi_y) && !empty($syakenmanryou_bi_m) && empty($syakenmanryou_bi_d) ){
        $syakenmanryou_bi = "-".$syakenmanryou_bi_m."-";
        $mr_data->where('syakenmanryou_bi','LIKE',"%{$syakenmanryou_bi}%");
      }
      if (!empty($seibi_syurui)) {
        foreach($seibi_syurui as $value){
          $mr_data->where('syakenmanryou_bi','LIKE',"%{$value}%");
        }
      }
      if ( $seibi_naiyou != "" ) {
        $mr_data->where('seibi_naiyou','LIKE',"%{$seibi_naiyou}%");
      }
      if ( $sensya != "" ) {
        $mr_data->where('sensya',"{$sensya}");
      }
      if ( $syanaiseisou != "" ) {
        $mr_data->where('syanaiseisou',"{$syanaiseisou}");
      }
      if ( !empty($tokki_zikou)) {
        foreach($tokki_zikou as $value){
          $mr_data->where('tokki_zikou','LIKE',"%{$value}%");
        }
      }
      if ( $tokki_zikou_syousai != "" ) {
        $mr_data->where('tokki_zikou_syousai','LIKE',"%{$tokki_zikou_syousai}%");
      }
      $mr_data->orderBy('nousya_yoteibi', 'desc');
      $mr_data = $mr_data->get();
      $view = view('seach_display');
      $view->mr_data = $mr_data;
      $view->mr_count = $mr_data->count();
      return $view;

    }

    public function details(Request $request) {

      //ログインしていなければログイン画面にリダイレクトする。
      if(!auth()->check()){
        return redirect('login');
      }
      //ユーザーIDを取得
      $user = auth()->user();
      $identify_ID = $user->id;
      //入力した値を受け取り、画面を表示
      $view = view('details');
      $view->ID = htmlspecialchars( $request->input('ID'), ENT_QUOTES );
      $view->nyuko_bi = htmlspecialchars( $request->input('nyuko_bi'), ENT_QUOTES );
      $view->nousya_yoteibi = htmlspecialchars( $request->input('nousya_yoteibi'), ENT_QUOTES );
      $view->sei = htmlspecialchars($request->input('sei'), ENT_QUOTES ) ;
      $view->mei = htmlspecialchars($request->input('mei'), ENT_QUOTES ) ;
      $view->tel = htmlspecialchars($request->input('tel'), ENT_QUOTES ) ;
      $view->mail = htmlspecialchars($request->input('mail'), ENT_QUOTES ) ;
      $view->car_name = htmlspecialchars($request->input('car_name'), ENT_QUOTES ) ;
      $view->katasiki = htmlspecialchars($request->input('katasiki'), ENT_QUOTES ) ;
      $view->tourokubangou = htmlspecialchars($request->input('tourokubangou'), ENT_QUOTES ) ;
      $view->syakenmanryou_bi = htmlspecialchars( $request->input('syakenmanryou_bi'), ENT_QUOTES );
      $view->seibi_syurui = $request->input('seibi_syurui') ;
      $view->seibi_naiyou = htmlspecialchars($request->input('seibi_naiyou'), ENT_QUOTES ) ;
      $view->sensya = htmlspecialchars($request->input('sensya'), ENT_QUOTES ) ;
      $view->syanaiseisou = htmlspecialchars($request->input('syanaiseisou'), ENT_QUOTES ) ;
      $view->tokki_zikou = $request->input('tokki_zikou') ;
      $view->tokki_zikou_syousai = htmlspecialchars($request->input('tokki_zikou_syousai'), ENT_QUOTES ) ;
      return $view;

    }

    public function print(Request $request) {

      //ログインしていなければログイン画面にリダイレクトする。
      if(!auth()->check()){
        return redirect('login');
      }
      //ユーザーIDを取得
      $user = auth()->user();
      $identify_ID = $user->id;
      //画面を表示
      $view = view('print');
      $nyuko_bi = htmlspecialchars( $request->input('nyuko_bi'), ENT_QUOTES );
      $nyuko_bi = explode( '-', $nyuko_bi );
      $view->nyuko_bi_y = $nyuko_bi[0];
      $view->nyuko_bi_m = $nyuko_bi[1];
      $view->nyuko_bi_d = $nyuko_bi[2];
      $nousya_yoteibi = htmlspecialchars( $request->input('nousya_yoteibi'), ENT_QUOTES );
      $nousya_yoteibi = explode( '-', $nousya_yoteibi );
      $view->nousya_yoteibi_y = $nousya_yoteibi[0];
      $view->nousya_yoteibi_m = $nousya_yoteibi[1];
      $view->nousya_yoteibi_d = $nousya_yoteibi[2];
      $view->sei = htmlspecialchars($request->input('sei'), ENT_QUOTES ) ;
      $view->mei = htmlspecialchars($request->input('mei'), ENT_QUOTES ) ;
      $view->tel = htmlspecialchars($request->input('tel'), ENT_QUOTES ) ;
      $view->mail = htmlspecialchars($request->input('mail'), ENT_QUOTES ) ;
      $view->car_name = htmlspecialchars($request->input('car_name'), ENT_QUOTES ) ;
      $view->katasiki = htmlspecialchars($request->input('katasiki'), ENT_QUOTES ) ;
      $view->tourokubangou = htmlspecialchars($request->input('tourokubangou'), ENT_QUOTES ) ;
      $syakenmanryou_bi = htmlspecialchars( $request->input('syakenmanryou_bi'), ENT_QUOTES );
      $syakenmanryou_bi = explode( '-', $syakenmanryou_bi );
      $view->syakenmanryou_bi_y = $syakenmanryou_bi[0];
      $view->syakenmanryou_bi_m = $syakenmanryou_bi[1];
      $view->syakenmanryou_bi_d = $syakenmanryou_bi[2];
      $view->seibi_syurui = htmlspecialchars($request->input('seibi_syurui'), ENT_QUOTES ) ;
      $view->seibi_naiyou = htmlspecialchars($request->input('seibi_naiyou'), ENT_QUOTES ) ;
      $view->sensya = htmlspecialchars($request->input('sensya'), ENT_QUOTES ) ;
      $view->syanaiseisou = htmlspecialchars($request->input('syanaiseisou'), ENT_QUOTES ) ;
      $view->tokki_zikou = $request->input('tokki_zikou') ;
      $view->tokki_zikou_syousai = htmlspecialchars($request->input('tokki_zikou_syousai'), ENT_QUOTES ) ;
      return $view;

    }

    public function delete_details(Request $request) {

      //ログインしていなければログイン画面にリダイレクトする。
      if(!auth()->check()){
        return redirect('login');
      }
      //ユーザーIDを取得
      $user = auth()->user();
      $identify_ID = $user->id;
      //入力した値を受け取り、画面を表示
      $view = view('delete_details');
      $view->ID = htmlspecialchars( $request->input('ID'), ENT_QUOTES );
      $view->nyuko_bi = htmlspecialchars( $request->input('nyuko_bi'), ENT_QUOTES );
      $view->nousya_yoteibi = htmlspecialchars( $request->input('nousya_yoteibi'), ENT_QUOTES );
      $view->sei = htmlspecialchars($request->input('sei'), ENT_QUOTES ) ;
      $view->mei = htmlspecialchars($request->input('mei'), ENT_QUOTES ) ;
      $view->tel = htmlspecialchars($request->input('tel'), ENT_QUOTES ) ;
      $view->mail = htmlspecialchars($request->input('mail'), ENT_QUOTES ) ;
      $view->car_name = htmlspecialchars($request->input('car_name'), ENT_QUOTES ) ;
      $view->katasiki = htmlspecialchars($request->input('katasiki'), ENT_QUOTES ) ;
      $view->tourokubangou = htmlspecialchars($request->input('tourokubangou'), ENT_QUOTES ) ;
      $view->syakenmanryou_bi = htmlspecialchars( $request->input('syakenmanryou_bi'), ENT_QUOTES );
      $view->seibi_syurui = $request->input('seibi_syurui') ;
      $view->seibi_naiyou = htmlspecialchars($request->input('seibi_naiyou'), ENT_QUOTES ) ;
      $view->sensya = htmlspecialchars($request->input('sensya'), ENT_QUOTES ) ;
      $view->syanaiseisou = htmlspecialchars($request->input('syanaiseisou'), ENT_QUOTES ) ;
      $view->tokki_zikou = $request->input('tokki_zikou') ;
      $view->tokki_zikou_syousai = htmlspecialchars($request->input('tokki_zikou_syousai'), ENT_QUOTES ) ;
      return $view;

    }

    public function delete_seach_display() {

      //ログインしていなければログイン画面にリダイレクトする。
      if(!auth()->check()){
        return redirect('login');
      }
      //ユーザーIDを取得
      $user = auth()->user();
      $identify_ID = $user->id;
      //検索結果表示の初期値を設定
      $mr_count = "初期値";
      //画面を表示
      $view = view('delete_seach_display');
      $view->mr_count = $mr_count;
      return $view;

    }

    public function delete_seach_result(Request $request) {

      //ログインしていなければログイン画面にリダイレクトする。
      if(!auth()->check()){
        return redirect('login');
      }
      //ユーザーIDを取得
      $user = auth()->user();
      $identify_ID = $user->id;
      //入力した値を受け取る
      $nyuko_bi_y = htmlspecialchars( $request->input('nyuko_bi_y'), ENT_QUOTES );
      $nyuko_bi_m = htmlspecialchars( $request->input('nyuko_bi_m'), ENT_QUOTES );
      $nyuko_bi_d = htmlspecialchars( $request->input('nyuko_bi_d'), ENT_QUOTES );
      $nousya_yoteibi_y = htmlspecialchars( $request->input('nousya_yoteibi_y'), ENT_QUOTES );
      $nousya_yoteibi_m = htmlspecialchars( $request->input('nousya_yoteibi_m'), ENT_QUOTES );
      $nousya_yoteibi_d = htmlspecialchars( $request->input('nousya_yoteibi_d'), ENT_QUOTES );
      $sei = htmlspecialchars($request->input('sei'), ENT_QUOTES ) ;
      $mei = htmlspecialchars($request->input('mei'), ENT_QUOTES ) ;
      $tel = htmlspecialchars($request->input('tel'), ENT_QUOTES ) ;
      $mail = htmlspecialchars($request->input('mail'), ENT_QUOTES ) ;
      $car_name = htmlspecialchars($request->input('car_name'), ENT_QUOTES ) ;
      $katasiki = htmlspecialchars($request->input('katasiki'), ENT_QUOTES ) ;
      $tourokubangou = htmlspecialchars($request->input('tourokubangou'), ENT_QUOTES ) ;
      $syakenmanryou_bi_y = htmlspecialchars( $request->input('syakenmanryou_bi_y'), ENT_QUOTES );
      $syakenmanryou_bi_m = htmlspecialchars( $request->input('syakenmanryou_bi_m'), ENT_QUOTES );
      $syakenmanryou_bi_d = htmlspecialchars( $request->input('syakenmanryou_bi_d'), ENT_QUOTES );
      $seibi_syurui = $request->input('seibi_syurui') ;
      $seibi_naiyou = htmlspecialchars($request->input('seibi_naiyou'), ENT_QUOTES ) ;
      $sensya = htmlspecialchars($request->input('sensya'), ENT_QUOTES ) ;
      $syanaiseisou = htmlspecialchars($request->input('syanaiseisou'), ENT_QUOTES ) ;
      $tokki_zikou = $request->input('tokki_zikou') ;
      $tokki_zikou_syousai = htmlspecialchars($request->input('tokki_zikou_syousai'), ENT_QUOTES ) ;
      //検索結果を取得
      $mr_data = Maintenance_requests::where('identify_ID',"{$identify_ID}");

      if ( !empty($nyuko_bi_y) && !empty($nyuko_bi_m) && !empty($nyuko_bi_d) )  {
        $nyuko_bi = $nyuko_bi_y."-".$nyuko_bi_m."-".$nyuko_bi_d;
        $mr_data->where('nyuko_bi',"{$nyuko_bi}");
      }elseif( !empty($nyuko_bi_y) && !empty($nyuko_bi_m) && empty($nyuko_bi_d) ){
        $nyuko_bi = $nyuko_bi_y."-".$nyuko_bi_m."-";
        $mr_data->where('nyuko_bi','LIKE',"{$nyuko_bi}%");
      }elseif( !empty($nyuko_bi_y) && empty($nyuko_bi_m) && empty($nyuko_bi_d) ){
        $nyuko_bi = $nyuko_bi_y."-";
        $mr_data->where('nyuko_bi','LIKE',"{$nyuko_bi}%");
      }elseif( empty($nyuko_bi_y) && !empty($nyuko_bi_m) && !empty($nyuko_bi_d) ){
        $nyuko_bi = "-".$nyuko_bi_m."-".$nyuko_bi_d;
        $mr_data->where('nyuko_bi','LIKE',"%{$nyuko_bi}");
      }elseif( empty($nyuko_bi_y) && empty($nyuko_bi_m) && !empty($nyuko_bi_d) ){
        $nyuko_bi = "-".$nyuko_bi_d;
        $query_count .= " AND nyuko_bi like '%{$nyuko_bi}' " ;
        $mr_data->where('nyuko_bi','LIKE',"%{$nyuko_bi}");
      }elseif( !empty($nyuko_bi_y) && empty($nyuko_bi_m) && !empty($nyuko_bi_d) ){
        $nyuko_bi_l = $nyuko_bi_y."-";
        $nyuko_bi_r = "-".$nyuko_bi_d;
        $mr_data->where('nyuko_bi','LIKE',"{$nyuko_bi_l}%");
        $mr_data->where('nyuko_bi','LIKE',"%{$nyuko_bi_r}");
      }elseif( empty($nyuko_bi_y) && !empty($nyuko_bi_m) && empty($nyuko_bi_d) ){
        $nyuko_bi = "-".$nyuko_bi_m."-";
        $mr_data->where('nyuko_bi','LIKE',"%{$nyuko_bi}%");
      }
      if ( !empty($nousya_yoteibi_y) && !empty($nousya_yoteibi_m) && !empty($nousya_yoteibi_d) )  {
        $nousya_yoteibi = $nousya_yoteibi_y."-".$nousya_yoteibi_m."-".$nousya_yoteibi_d;
        $mr_data->where('nousya_yoteibi',"{$nousya_yoteibi}");
      }elseif( !empty($nousya_yoteibi_y) && !empty($nousya_yoteibi_m) && empty($nousya_yoteibi_d) ){
        $nousya_yoteibi = $nousya_yoteibi_y."-".$nousya_yoteibi_m."-";
        $mr_data->where('nousya_yoteibi','LIKE',"{$nousya_yoteibi}%");
      }elseif( !empty($nousya_yoteibi_y) && empty($nousya_yoteibi_m) && empty($nousya_yoteibi_d) ){
        $nousya_yoteibi = $nousya_yoteibi_y."-";
        $mr_data->where('nousya_yoteibi','LIKE',"{$nousya_yoteibi}%");
      }elseif( empty($nousya_yoteibi_y) && !empty($nousya_yoteibi_m) && !empty($nousya_yoteibi_d) ){
        $nousya_yoteibi = "-".$nousya_yoteibi_m."-".$nousya_yoteibi_d;
        $mr_data->where('nousya_yoteibi','LIKE',"%{$nousya_yoteibi}");
      }elseif( empty($nousya_yoteibi_y) && empty($nousya_yoteibi_m) && !empty($nousya_yoteibi_d) ){
        $nousya_yoteibi = "-".$nousya_yoteibi_d;
        $mr_data->where('nousya_yoteibi','LIKE',"%{$nousya_yoteibi}");
      }elseif( !empty($nousya_yoteibi_y) && empty($nousya_yoteibi_m) && !empty($nousya_yoteibi_d) ){
        $nousya_yoteibi_l = $nousya_yoteibi_y."-";
        $nousya_yoteibi_r = "-".$nousya_yoteibi_d;
        $mr_data->where('nousya_yoteibi','LIKE',"{$nousya_yoteibi}%");
        $mr_data->where('nousya_yoteibi','LIKE',"%{$nousya_yoteibi}");
      }elseif( empty($nousya_yoteibi_y) && !empty($nousya_yoteibi_m) && empty($nousya_yoteibi_d) ){
        $nousya_yoteibi = "-".$nousya_yoteibi_m."-";
        $mr_data->where('nousya_yoteibi','LIKE',"%{$nousya_yoteibi}%");
      }
      if ( $sei != "" ) {
        $mr_data->where('sei',"{$sei}");
      }
      if ( $mei != "" ) {
        $mr_data->where('mei',"{$mei}");
      }
      if ( $tel != "" ) {
        $mr_data->where('tel',"{$tel}");
      }
      if ( $mail != "" ) {
        $mr_data->where('mail',"{$mail}");
      }
      if ( $car_name != "" ) {
        $mr_data->where('car_name',"{$car_name}");
      }
      if ( $katasiki != "" ) {
        $mr_data->where('sei',"{$sei}");
      }
      if ( $tourokubangou != "" ) {
        $mr_data->where('sei',"{$sei}");
      }
      if ( !empty($syakenmanryou_bi_y) && !empty($syakenmanryou_bi_m) && !empty($syakenmanryou_bi_d) )  {
        $syakenmanryou_bi = $syakenmanryou_bi_y."-".$syakenmanryou_bi_m."-".$syakenmanryou_bi_d;
        $mr_data->where('syakenmanryou_bi',"{$syakenmanryou_bi}");
      }elseif( !empty($syakenmanryou_bi_y) && !empty($syakenmanryou_bi_m) && empty($syakenmanryou_bi_d) ){
        $syakenmanryou_bi = $syakenmanryou_bi_y."-".$syakenmanryou_bi_m."-";
        $mr_data->where('syakenmanryou_bi','LIKE',"{$syakenmanryou_bi}%");
      }elseif( !empty($syakenmanryou_bi_y) && empty($syakenmanryou_bi_m) && empty($syakenmanryou_bi_d) ){
        $syakenmanryou_bi = $syakenmanryou_bi_y."-";
        $mr_data->where('syakenmanryou_bi','LIKE',"{$syakenmanryou_bi}%");
      }elseif( empty($syakenmanryou_bi_y) && !empty($syakenmanryou_bi_m) && !empty($syakenmanryou_bi_d) ){
        $syakenmanryou_bi = "-".$syakenmanryou_bi_m."-".$syakenmanryou_bi_d;
        $mr_data->where('syakenmanryou_bi','LIKE',"%{$syakenmanryou_bi}");
      }elseif( empty($syakenmanryou_bi_y) && empty($syakenmanryou_bi_m) && !empty($syakenmanryou_bi_d) ){
        $syakenmanryou_bi = "-".$syakenmanryou_bi_d;
        $mr_data->where('syakenmanryou_bi','LIKE',"%{$syakenmanryou_bi}");
      }elseif( !empty($syakenmanryou_bi_y) && empty($syakenmanryou_bi_m) && !empty($syakenmanryou_bi_d) ){
        $syakenmanryou_bi_l = $syakenmanryou_bi_y."-";
        $syakenmanryou_bi_r = "-".$syakenmanryou_bi_d;
        $mr_data->where('syakenmanryou_bi','LIKE',"{$syakenmanryou_bi}%");
        $mr_data->where('syakenmanryou_bi','LIKE',"%{$syakenmanryou_bi}");
      }elseif( empty($syakenmanryou_bi_y) && !empty($syakenmanryou_bi_m) && empty($syakenmanryou_bi_d) ){
        $syakenmanryou_bi = "-".$syakenmanryou_bi_m."-";
        $mr_data->where('syakenmanryou_bi','LIKE',"%{$syakenmanryou_bi}%");
      }
      if (!empty($seibi_syurui)) {
        foreach($seibi_syurui as $value){
          $mr_data->where('syakenmanryou_bi','LIKE',"%{$value}%");
        }
      }
      if ( $seibi_naiyou != "" ) {
        $mr_data->where('seibi_naiyou','LIKE',"%{$seibi_naiyou}%");
      }
      if ( $sensya != "" ) {
        $mr_data->where('sensya',"{$sensya}");
      }
      if ( $syanaiseisou != "" ) {
        $mr_data->where('syanaiseisou',"{$syanaiseisou}");
      }
      if ( !empty($tokki_zikou)) {
        foreach($tokki_zikou as $value){
          $mr_data->where('tokki_zikou','LIKE',"%{$value}%");
        }
      }
      if ( $tokki_zikou_syousai != "" ) {
        $mr_data->where('tokki_zikou_syousai','LIKE',"%{$tokki_zikou_syousai}%");
      }
      $mr_data->orderBy('nousya_yoteibi', 'desc');
      $mr_data = $mr_data->get();
      $view = view('delete_seach_display');
      $view->mr_data = $mr_data;
      $view->mr_count = $mr_data->count();
      return $view;

    }

    public function delete(Request $request){

      //ログインしていなければログイン画面にリダイレクトする。
      if(!auth()->check()){
        return redirect('login');
      }
      //ユーザーIDを取得
      $user = auth()->user();
      $identify_ID = $user->id;

      $ID = htmlspecialchars($request->input('ID'), ENT_QUOTES ) ;
      //データを物理削除
      $delete_data = Maintenance_requests::where('identify_ID',"{$identify_ID}");
      $delete_data->where('ID',"{$ID}");
      $delete_data->forceDelete();
      //delete_seach_displayへリダイレクト
      return redirect("delete_seach_display")->with('message','データの削除に成功しました。');

    }

    public function import() {

      //ログインしていなければログイン画面にリダイレクトする。
      if(!auth()->check()){
        return redirect('login');
      }
      //ユーザーIDを取得
      $user = auth()->user();
      $identify_ID = $user->id;
      //画面を表示
      $view = view('import');
      $view->dentify_ID = $identify_ID;
      return $view;

    }

    public function import_judgment(Request $request) {

      //ログインしていなければログイン画面にリダイレクトする。
      if(!auth()->check()){
        return redirect('login');
      }
      //ユーザーIDを取得
      $user = auth()->user();
      $identify_ID = $user->id;
      if (!Hash::check($request->input('password'), $user->password)) {
        return redirect("import")->with('error_message','パスワードが間違っています。');
      }
      if (!$request->hasFile('csvfile')) {
        return redirect('import')->with('error_message', 'ファイルが選択されていません。');
      }
      $file_name = $_FILES["csvfile"]["name"];
      if (pathinfo($file_name, PATHINFO_EXTENSION) != 'csv') {
        return redirect('import')->with('error_message',  'CSVファイルのみ対応しています。');
      }
      // アップロードファイルのファイルパスを取得
      $file_path = $request->file('csvfile')->path();
      // CSV取得
      $file = new \SplFileObject($file_path);
      $file->setFlags(
        \SplFileObject::READ_CSV |// CSVとして行を読み込み
        \SplFileObject::READ_AHEAD |// 先読み／巻き戻しで読み込み
        \SplFileObject::SKIP_EMPTY |// 空行を読み飛ばす
        \SplFileObject::DROP_NEW_LINE// 行末の改行を読み飛ばす
      );
      // 一行ずつ処理
      foreach($file as $line) {
        $nyuko_bi = mb_convert_encoding( $line[0], 'UTF-8', 'SJIS');
        $nousya_yoteibi = mb_convert_encoding( $line[1], 'UTF-8', 'SJIS');
        $sei = mb_convert_encoding( $line[2], 'UTF-8', 'SJIS');
        $mei = mb_convert_encoding( $line[3], 'UTF-8', 'SJIS');
        $tel = mb_convert_encoding( $line[4], 'UTF-8', 'SJIS');
        $mail = mb_convert_encoding( $line[5], 'UTF-8', 'SJIS');
        $car_name = mb_convert_encoding( $line[6], 'UTF-8', 'SJIS');
        $katasiki = mb_convert_encoding( $line[7], 'UTF-8', 'SJIS');
        $tourokubangou = mb_convert_encoding( $line[8], 'UTF-8', 'SJIS');
        $syakenmanryou_bi = mb_convert_encoding( $line[9], 'UTF-8', 'SJIS');
        $seibi_syurui = mb_convert_encoding( $line[10], 'UTF-8', 'SJIS');
        $seibi_naiyou = mb_convert_encoding( $line[11], 'UTF-8', 'SJIS');
        $sensya = mb_convert_encoding( $line[12], 'UTF-8', 'SJIS');
        $syanaiseisou = mb_convert_encoding( $line[13], 'UTF-8', 'SJIS');
        $tokki_zikou = mb_convert_encoding( $line[14], 'UTF-8', 'SJIS');
        $tokki_zikou_syousai = mb_convert_encoding( $line[15], 'UTF-8', 'SJIS');
        DB::table('maintenance_request_table')
        ->insertGetId(
          ['ID' => 'NULL',
          'nyuko_bi' => $nyuko_bi,
          'nousya_yoteibi' => $nousya_yoteibi,
          'sei' => $sei,
          'mei' => $mei,
          'tel' => $tel,
          'mail' => $mail,
          'car_name' => $car_name,
          'katasiki' => $katasiki,
          'tourokubangou' => $tourokubangou,
          'syakenmanryou_bi' => $syakenmanryou_bi,
          'seibi_syurui' => $seibi_syurui,
          'seibi_naiyou' => $seibi_naiyou,
          'sensya' => $sensya,
          'syanaiseisou' => $syanaiseisou,
          'tokki_zikou' => $tokki_zikou,
          'tokki_zikou_syousai' => $tokki_zikou_syousai
          ,'identify_ID' => $identify_ID
        ]);
      }
      return redirect("import")->with('message','インポートに成功しました。');

    }

    private function csvcolmns() {

      $csvlist = array(
        // 'ID' => 'ID',
        'nyuko_bi' => '入庫日',
        'nousya_yoteibi' => '納車予定日',
        'sei' => 'お客様氏名(姓)',
        'mei' => 'お客様氏名(名)',
        'tel' => '電話番号',
        'mail' => 'メールアドレス',
        'car_name' => '車種名',
        'katasiki' => '型式',
        'tourokubangou' => '登録番号',
        'syakenmanryou_bi' => '車検証の有効期限',
        'seibi_syurui' => '整備の種類',
        'seibi_naiyou' => '整備内容',
        'sensya' => '洗車の有無',
        'syanaiseisou' => '車内清掃の有無',
        'tokki_zikou' => '特記事項',
        'tokki_zikou_syousai' => '特記事項詳細',
        // 'identify_ID' => '識別ID',
      );
      return $csvlist;

    }

    public function export() {

      //ログインしていなければログイン画面にリダイレクトする。
      if(!auth()->check()){
        return redirect('login');
      }
      //ユーザーIDを取得
      $user = auth()->user();
      $identify_ID = $user->id;
      //画面を表示
      $view = view('export');
      $view->dentify_ID = $identify_ID;
      return $view;

    }

    public function export_judgment(Request $request) {

      //ログインしていなければログイン画面にリダイレクトする。
      if(!auth()->check()){
        return redirect('login');
      }
      //ユーザーIDを取得
      $user = auth()->user();
      $identify_ID = $user->id;

      if (!Hash::check($request->input('password'), $user->password)) {
        return redirect("export")->with('error_message','パスワードが間違っています。');
      }

      // 出力項目定義
      $csvlist = $this->csvcolmns();
      // ファイル名
      $current = time();
      date_default_timezone_set("Asia/Tokyo");
      $time = date("YmdHi", $current);
      $filename = $time."_".$user->name.".csv";
      // 仮ファイルOpen
      $stream = fopen('php://temp', 'r+b');
      // *** ヘッダ行 ***
      // $output = array();
      // foreach($csvlist as $key => $value){
      //   $output[] = $value;
      // }
      //CSVファイルを出力
      // fputcsv($stream, $output);
      // *** データ行 ***
      $blocksize = 100; // QUERYする単位
      for($i=0 ; true ; $i++) {
        $mr_data = Maintenance_requests::where('identify_ID',"{$identify_ID}");
        $mr_data->orderBy('nousya_yoteibi', 'desc');
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
      // 文字コード変換
      $csv = mb_convert_encoding($csv, 'SJIS-win', 'UTF-8');
      // header
      $headers = array(
        'Content-Type' => 'text/csv',
        'Content-Disposition' => 'attachment; filename="'.$filename.'"',
      );
      return \Response::make($csv, 200, $headers);

    }

    public function withdrawal(){

      //ログインしていなければログイン画面にリダイレクトする。
      if(!auth()->check()){
        return redirect('login');
      }
      //ユーザーIDを取得
      $user = auth()->user();
      $identify_ID = $user->id;
      //画面を表示
      $view = view('withdrawal');
      $view->dentify_ID = $identify_ID;
      return $view;

    }

    public function withdrawal_judgment(Request $request) {

      //ログインしていなければログイン画面にリダイレクトする。
      if(!auth()->check()){
        return redirect('login');
      }
      //ユーザーIDを取得
      $user = auth()->user();
      $identify_ID = $user->id;
      if (!Hash::check($request->input('password'), $user->password)) {
        //退会画面へリダイレクト
        return redirect("withdrawal")->with('error_message','パスワードが間違っています。');
      }
      if ($user->name == "guest" && $user->email == "guest@hogehoge.com") {
        //退会画面へリダイレクト
        return redirect("withdrawal")->with('error_message','テスト用ユーザー情報は削除できません。');
      }
      //データを物理削除
      $delete_data = Maintenance_requests::where('identify_ID',"{$identify_ID}");
      $delete_data->forceDelete();
      //ログアウト後、ユーザー情報削除
      $user = Auth::user();
      Auth::logout();
      $user->delete();
      return redirect("register")->with('message','ご利用ありがとうございました。');
    }

  }
