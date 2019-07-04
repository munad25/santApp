<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class client extends Model
{
  public $timestamps = false;

  protected $table = "client";
  protected $primarykey = 'id_client';
  protected $fillable = ['nama_client','jenis_client'];
}
