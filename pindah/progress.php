<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class progress extends Model
{
  public $timestamps = false;

  protected $table = "progress";
  protected $primarykey = 'id_progress';
  protected $fillable = ['id_project','tanggal','keterangan','foto'];
}
