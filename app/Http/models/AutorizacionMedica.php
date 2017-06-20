<?php

namespace App\Http\models;

use Illuminate\Database\Eloquent\Model;

class AutorizacionMedica extends Model
{
  public $timestamps = false;
  protected $connection = 'mysql';
  protected $primaryKey ='AUM_clave';
  protected $table = 'AutorizacionMedica';
}