<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input;
use App\Http\models\Usuario;
class ProcesoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function insertCita()
    {

       $confirmadoLes = Input::get('confirmadoLes');
       $confirmadoPro = Input::get('confirmadoPro');
       $fecha = Input::get('fecha');
       $hora = Input::get('hora');
       $notas = Input::get('notas');
       $proveedor = Input::get('proveedor');
       $referencia = Input::get('referencia');
      //   //return view('welcome');
      //
     
      return $proveedor;
       //return DB::select("select * from Usuario where Usu_login='".$usuario."' and Usu_pwd='".md5($password)."'");
    }

    public function subirDocumentos($unidad, $fecha)
    {

      $input = Input::all();
      //$nombre = $file->getClientOriginalName();      

      for ($i=0; $i < count($input)-1 ; $i++) { 
      $file= $input['file'.$i];
      
      $nombre = $file->getClientOriginalName();          
      $nombreArc = 'ACUSE_'.$unidad.'_'.$fecha.'-'.$i;
      $extension = $file->getClientOriginalExtension();
      $file->move("imgs",$nombreArc.".".$extension);    
        
    }
     
      return 'exito';
       //return DB::select("select * from Usuario where Usu_login='".$usuario."' and Usu_pwd='".md5($password)."'");
    }

    
}
