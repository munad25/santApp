<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class negosiasi extends Model
{
  public $timestamps = false;

  protected $table = "negosiasi";
  protected $fillable = ['id_project','negosiator','id_client','harga_awal','harga_nego','status_nego'];
}
