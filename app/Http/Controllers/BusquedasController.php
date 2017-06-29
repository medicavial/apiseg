<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input;
use App\Http\models\Usuario;
use App\Http\models\Unidad;
use App\Http\models\AutorizacionMedica;
use App\Http\models\PUAutorizacionesMedicas;
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

    public function getAutMV($fechaIni, $fechaFin)
    {           

        $listadoMV= AutorizacionMedica::whereBetween('AUM_fechaReg',[$fechaIni, $fechaFin.' 23:59:59']) 
                ->join('MovimientoAut', 'AutorizacionMedica.AUM_clave', '=', 'MovimientoAut.AUM_clave') 
                ->join('TipoMovimiento', 'MovimientoAut.TIM_claveint', '=', 'TipoMovimiento.TIM_claveint') 

                ->select('AUM_folioMV as FOLIO', 'AUM_lesionado AS LESIONADO', 'AUM_fechaReg AS FECHAREG', 'TIM_nombre AS MOVIMIENTO',
                    DB::raw("CONCAT(AutorizacionMedica.AUM_clave,'-',MovimientoAut.TIM_claveint) as AUT"), DB::raw( "'PAQUETE' AS 'TIPO'"))                                     
                ->get();
        $listadoZima= PUAutorizacionesMedicas::whereBetween('Aut_fecreg',[$fechaIni, $fechaFin.' 23:59:59'])
                    ->join('PURegistro', 'PUAutorizacionesMedicas.REG_folio', '=', 'PURegistro.REG_folio') 
                    ->join('PUTipoAutorizacion','PUAutorizacionesMedicas.TipAut_clave','=','PUTipoAutorizacion.TipAut_clave')
                    ->select('PUAutorizacionesMedicas.REG_folio as FOLIO', 'REG_nombrecompleto AS LESIONADO', 'Aut_fecreg AS FECHAREG', 'TipAut_nombre AS MOVIMIENTO', 'Aut_clave AS AUT', DB::raw("'INSUMOS' AS 'TIPO'"))
                    ->get();
        $arryaListoMV   = json_decode($listadoMV);
        $arryaListoZima = json_decode($listadoZima);

        $autorizaciones = array_merge($arryaListoMV,$arryaListoZima);

        $autorizacionesJson = json_encode($autorizaciones);

        return $autorizacionesJson;
    }

    public function getAutZima()
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
