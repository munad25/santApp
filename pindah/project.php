<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class project extends Model
{
  public $timestamps = false;

  protected $table = "project";
  protected $primarykey = 'id_project';
  protected $fillable = ['jenis_project','id_client','seen'];
}
