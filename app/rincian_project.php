<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rincian_project extends Model
{
  public $timestamps = false;

  protected $table = "rincian_project";
  protected $fillable = ['id_project','rincian_project','waktu_mulai','waktu_selesai','status_pengerjaan','keterangan'];
}
