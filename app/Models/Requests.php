<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
//論理削除
// use Illuminate\Database\Eloquent\SoftDeletes;

class Requests extends Model
{
  protected $table = 'requests';
  protected $primaryKey = 'ID';
  //ＩＮＳＥＲＴ実行を阻害するため、タイムスタンプを無効化
  public $timestamps = false;

  //論理削除をＯＮ
  // use SoftDeletes;
  // protected $dates = ['deleted_at'];
}
