<?php

namespace App\Http\models;

use Illuminate\Database\Eloquent\Model;

class RegistroOportunidades extends Model
{
  public $timestamps = false;
  protected $connection = 'mysql';
  protected $primaryKey ='RGO_id';
  protected $table = 'RegistroOportunidades';
}
