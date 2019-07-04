<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loginModel extends Model
{
    protected $table = 'users';

    protected $fillable = ['id_user', 'username', 'password', 'level', 'id_client'];
}
