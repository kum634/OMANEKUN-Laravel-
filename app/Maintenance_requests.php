<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//論理削除
// use Illuminate\Database\Eloquent\SoftDeletes;

class Maintenance_requests extends Model
{
  protected $table = 'maintenance_request_table';
  protected $primaryKey = 'ID';
  //ＩＮＳＥＲＴ実行を阻害するため、タイムスタンプを無効化
  public $timestamps = false;

  //論理削除をＯＮ
  // use SoftDeletes;
  // protected $dates = ['deleted_at'];
}
