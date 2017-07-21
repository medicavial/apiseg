<?php

namespace App\Http\models;

use Illuminate\Database\Eloquent\Model;

class Compania extends Model
{
  public $timestamps = false;
  protected $connection = 'mysql';
  protected $primaryKey = 'Cia_clave';
  protected $table = 'Compania';
}
