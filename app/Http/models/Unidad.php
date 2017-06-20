<?php

namespace App\Http\models;

use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
  public $timestamps = false;
  protected $connection = 'mysql';
  protected $primaryKey ='Uni_clave';
  protected $table = 'Unidad';
}
