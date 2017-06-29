<?php

namespace App\Http\models;

use Illuminate\Database\Eloquent\Model;

class PUAutorizacionesMedicas extends Model
{
  public $timestamps = false;
  protected $connection = 'mysql1';
  protected $primaryKey ='Aut_clave';
  protected $table = 'PUAutorizacionesMedicas';
}