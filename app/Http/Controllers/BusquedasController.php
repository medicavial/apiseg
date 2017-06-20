<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input;
use App\Http\models\Usuario;
use App\Http\models\Unidad;
class BusquedasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getAutorizaciones()
    {

      
      return 'hola mundo';
       
    }

    public function getUnidades()
    {
           
        return Unidad::where('Uni_activa','S')
                        ->select('Uni_clave as id','Uni_nombrecorto as nombre')
                        ->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        $usuario  =  Input::get('user'); 
        $password = Input::get('psw');         
        return DB::select("select * from Usuario where Usu_login='".$usuario."' and Usu_pwd='".md5($password)."'");//
    }

    public function cliente()
    {
      
        return DB::select("SELECT Cia_clave as id, Cia_nombrecorto as nombre FROM Compania WHERE Cia_activa = 'S'");//
    }


    public function riesgo()
    {
      
        return DB::select("SELECT RIE_clave as id, RIE_nombre as nombre FROM RiesgoAfectado WHERE RIE_activo = 'S'");//
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
