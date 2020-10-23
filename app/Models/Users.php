<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
  use SoftDeletes;

  protected $table = 'users';
  protected $dates = ['deleted_at'];
}
