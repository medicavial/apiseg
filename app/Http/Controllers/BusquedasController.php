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
use App\Http\models\RegistroOportunidades;
class BusquedasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getAutorizaciones()
    {

      
     $listadoMV= AutorizacionMedica::whereBetween('AUM_fechaReg',[$fechaIni, $fechaFin.' 23:59:59']) 
                ->join('MovimientoAut', 'AutorizacionMedica.AUM_clave', '=', 'MovimientoAut.AUM_clave') 
                ->join('TipoMovimiento', 'MovimientoAut.TIM_claveint', '=', 'TipoMovimiento.TIM_claveint')
                ->join('Expediente','AutorizacionMedica.AUM_folioMV','=', 'Expediente.Exp_folio')
                ->join('Unidad','Expediente.Uni_clave','=','Unidad.Uni_clave')
                ->join('Compania','Expediente.Cia_clave','=','Compania.Cia_clave') 
                ->join('Producto','Expediente.Pro_clave','=','Producto.Pro_clave')
                ->select('AUM_folioMV as FOLIO', 'AUM_lesionado AS LESIONADO', 'AUM_fechaReg AS FECHAREG', 'TIM_nombre AS MOVIMIENTO',
                    DB::raw("CONCAT(AutorizacionMedica.AUM_clave,'-',MovimientoAut.TIM_claveint) as AUT"),'AUM_diagnostico AS DIAG','MOA_texto as OBS','Uni_nombrecorto as UNIDAD','Cia_nombrecorto as ASEG','Expediente.Cia_clave AS CIACLAVE','MOA_estimacionActual AS ESTIMACION','Exp_telefono as TEL','Pro_img AS IMG', DB::raw( "'PAQUETE' AS 'TIPO'"))                                     
                ->get();
        $listadoZima= PUAutorizacionesMedicas::whereBetween('Aut_fecreg',[$fechaIni, $fechaFin.' 23:59:59'])
                    ->join('PURegistro', 'PUAutorizacionesMedicas.REG_folio', '=', 'PURegistro.REG_folio') 
                    ->join('PUTipoAutorizacion','PUAutorizacionesMedicas.TipAut_clave','=','PUTipoAutorizacion.TipAut_clave')
                    ->select('PUAutorizacionesMedicas.REG_folio as FOLIO', 'REG_nombrecompleto AS LESIONADO', 'Aut_fecreg AS FECHAREG', 'TipAut_nombre AS MOVIMIENTO', 'Aut_clave AS AUT','Aut_dx AS DIAG','Aut_obs AS OBS' , DB::raw("'INSUMOS' AS 'TIPO'"))
                    ->get();
        $arryaListoMV   = json_decode($listadoMV);
        $arryaListoZima = json_decode($listadoZima);

        $autorizaciones = array_merge($arryaListoMV,$arryaListoZima);

        $autorizacionesJson = json_encode($autorizaciones);

        return $autorizacionesJson;
       
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
                ->join('Expediente','AutorizacionMedica.AUM_folioMV','=', 'Expediente.Exp_folio')
                ->join('Unidad','Expediente.Uni_clave','=','Unidad.Uni_clave')
                ->join('Compania','Expediente.Cia_clave','=','Compania.Cia_clave') 
                ->join('Producto','Expediente.Pro_clave','=','Producto.Pro_clave')
                ->select('AUM_folioMV as FOLIO', 'AUM_lesionado AS LESIONADO', 'AUM_fechaReg AS FECHAREG', 'TIM_nombre AS MOVIMIENTO','MovimientoAut.TIM_claveint as CVE_MOVIMIENTO',
                    DB::raw("CONCAT(AutorizacionMedica.AUM_clave,'-',MovimientoAut.TIM_claveint) as AUT"),'AUM_diagnostico AS DIAG','MOA_texto as OBS','Uni_nombrecorto as UNIDAD','Cia_nombrecorto as ASEG','Expediente.Cia_clave AS CIACLAVE','MOA_estimacionActual AS ESTIMACION','Exp_telefono as TEL','Pro_img AS IMG', DB::raw( "'PAQUETE' AS 'TIPO'"))                                     
                ->get();
        $listadoZima= PUAutorizacionesMedicas::whereBetween('Aut_fecreg',[$fechaIni, $fechaFin.' 23:59:59'])
                    ->join('PURegistro', 'PUAutorizacionesMedicas.REG_folio', '=', 'PURegistro.REG_folio') 
                    ->join('PUTipoAutorizacion','PUAutorizacionesMedicas.TipAut_clave','=','PUTipoAutorizacion.TipAut_clave')
                    ->select('PUAutorizacionesMedicas.REG_folio as FOLIO', 'REG_nombrecompleto AS LESIONADO', 'Aut_fecreg AS FECHAREG', 'TipAut_nombre AS MOVIMIENTO', 'Aut_clave AS AUT','Aut_dx AS DIAG','Aut_obs AS OBS', 'PUTipoAutorizacion.TipAut_clave AS CVE_MOVIMIENTO', DB::raw("'INSUMOS' AS 'TIPO'"))
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

    public function DetalleAutorizacion($aut, $tipo)
    {        

       if($tipo=='PAQUETE')
       {
            return 'MEDICAVIAL';
       }else
       {
            return 'ZIMA';
       }
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

    public function posicion()
    {
      
        return DB::select("SELECT id, opcion FROM PosicionAcc WHERE id IN (1,2,3,4,5)");
    }

    public function buscatipoDifusion()
    {
      
        return DB::select("SELECT TPD_id AS id, TDP_nombre AS nombre FROM TipoDifucion WHERE TDP_activo = 1");
    }

    public function listadoOportunidades()
    {
      
        return DB::select("SELECT Cia_nombrecorto as cliente, Uni_nombrecorto as unidad, EXP_folio as folioMV, 
                                   RGO_nombre as lesionado, RGO_fechaRep as fechaReporte, RGO_folio as folioOP, if(RGO_notifica = 1, 'SI','NO') as notifica,
                                   if(RGO_estatus = 1, 'Abierto' ,'Cerrado') as estatus    
                            FROM RegistroOportunidades
                            INNER JOIN Unidad ON RegistroOportunidades.Uni_clave = Unidad.Uni_clave
                            INNER JOIN Compania ON RegistroOportunidades.Cia_clave = Compania.Cia_clave
                            INNER JOIN TipoDifucion ON RegistroOportunidades.RGO_tipo = TipoDifucion.TPD_id
                            WHERE  RGO_estatus = 1
                            limit 100");
    }

    public function buscaOportunidades()
    {

        $fechaIni = Input::get('fechaini');
        $fechaFin = Input::get('fechafin');
        $unidad   = Input::get('unidad');

        if ($unidad == '') {


            return DB::select("SELECT Cia_nombrecorto as cliente, Uni_nombrecorto as unidad, EXP_folio as folioMV, 
                           RGO_nombre as lesionado, RGO_fechaRep as fechaReporte, RGO_folio as folioOP, if(RGO_notifica = 1, 'SI','NO') as notifica,    
                           if(RGO_estatus = 1, 'Abierto' ,'Cerrado') as estatus
                           FROM RegistroOportunidades
                    INNER JOIN Unidad ON RegistroOportunidades.Uni_clave = Unidad.Uni_clave
                    INNER JOIN Compania ON RegistroOportunidades.Cia_clave = Compania.Cia_clave
                    INNER JOIN TipoDifucion ON RegistroOportunidades.RGO_tipo = TipoDifucion.TPD_id
                    WHERE RGO_estatus = 1");
            # code...
        }else{
      
            return DB::select("SELECT Cia_nombrecorto as cliente, Uni_nombrecorto as unidad, EXP_folio as folioMV, 
                                   RGO_nombre as lesionado, RGO_fechaRep as fechaReporte, RGO_folio as folioOP, if(RGO_notifica = 1, 'SI','NO') as notifica,    
                                   if(RGO_estatus = 1, 'Abierto' ,'Cerrado') as estatus
                                   FROM RegistroOportunidades
                            INNER JOIN Unidad ON RegistroOportunidades.Uni_clave = Unidad.Uni_clave
                            INNER JOIN Compania ON RegistroOportunidades.Cia_clave = Compania.Cia_clave
                            INNER JOIN TipoDifucion ON RegistroOportunidades.RGO_tipo = TipoDifucion.TPD_id
                            WHERE RGO_fechaRep BETWEEN '$fechaIni' and '$fechaFin 23:59:59' and RegistroOportunidades.Uni_clave = $unidad and RGO_estatus = 1");
        }
    }


    public function detalleOportunidad($folio)
    {
      
        return DB::select("SELECT Cia_nombrecorto as cliente, Uni_nombrecorto as unidad, EXP_folio as folioMV, 
                                         RGO_nombre as lesionado, RGO_fechaRep as fechaReporte, RGO_folio as folioOP, if(RGO_notifica = 1, 'SI','NO') as notifica,    
                                         if(RGO_estatus = 1, 'Abierto' ,'Cerrado') as estatus, Usu_nombre as usuario,
                                         RGO_observaciones as notas
                                         FROM RegistroOportunidades
                            INNER JOIN Unidad ON RegistroOportunidades.Uni_clave = Unidad.Uni_clave
                            INNER JOIN Compania ON RegistroOportunidades.Cia_clave = Compania.Cia_clave
                            INNER JOIN TipoDifucion ON RegistroOportunidades.RGO_tipo = TipoDifucion.TPD_id
                            INNER JOIN Usuario ON RegistroOportunidades.USU_registro = Usuario.Usu_login
                            WHERE RGO_folio = '$folio'");
    }

    public function cerrarAP($folio)
    {

        $actualiza = DB::table('RegistroOportunidades')->where('RGO_folio', $folio)
                                                       ->update(array('RGO_estatus' => 0));


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
