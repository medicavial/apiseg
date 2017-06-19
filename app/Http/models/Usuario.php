<?php

namespace App\Http\models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
  public $timestamps = false;
  protected $connection = 'mysql';
  protected $primaryKey ='Usu_login';
  protected $table = 'Usuario';
}
