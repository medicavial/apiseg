<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input;
use App\Http\models\Usuario;
use App\Http\models\Unidad;
use App\Http\models\Compania;
use App\Http\models\RegistroOportunidades;
class RegistroOportunidadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function insertaOportunidad()
    {
        $cliente   =  Input::get('cliente'); 
        $asegurado =  Input::get('asegurado');
        $domicilio =  Input::get('domicilio');
        $edad      =  Input::get('edad');
        $fechaReporte = Input::get('fechaReporte');
        $folio  = Input::get('folio');
        $folioMV = Input::get('folioMV');
        $grado = Input::get('grado');
        $inciso = Input::get('inciso');
        $lesionado = Input::get('lesionado');
        $medicoTratante = Input::get('medicoTratante');
        $motivo = Input::get('motivo');
        $nombreReporta = Input::get('nombreReporta');
        $notifica = Input::get('notifica');
        $observaciones = Input::get('observaciones');
        $poliza = Input::get('poliza');
        $posicion = Input::get('posicion');
        $riesgo = Input::get('riesgo');
        $tipo = Input::get('tipo');
        $unidad = Input::get('unidad');
        $usuario = Input::get('usuario');

        //// Se forma el folio de Oportunidad, obteniendo las primeras 3 letras de la compania

        $compania = Compania::find($cliente)->Cia_nombrecorto;
        $max      = DB::table('RegistroOportunidades')->max('RGO_id');
        $primeras = substr($compania, 0, 3);

        $cadena = $primeras."O".date('ym');
        $numero = str_pad($max,  3, "0",STR_PAD_LEFT); 
        $folioO = $cadena.$numero;



        $oportunidades = new RegistroOportunidades;

        $oportunidades->RGO_folio = $folioO;
        $oportunidades->Cia_clave = $cliente;
        $oportunidades->Uni_clave = $unidad;
        $oportunidades->RGO_fechaRep = $fechaReporte;
        $oportunidades->RGO_poliza = $poliza;
        $oportunidades->RGO_inciso = $inciso;
        $oportunidades->RGO_grado = $grado;
        $oportunidades->RGO_asegurado = $asegurado;
        $oportunidades->RGO_notifica = $notifica;
        $oportunidades->RGO_tipo = $tipo;
        $oportunidades->EXP_folio = $folioMV;
        $oportunidades->RGO_nombre = $lesionado;
        $oportunidades->RGO_edad = $edad;
        $oportunidades->RGO_domicilio = $domicilio;
        $oportunidades->RGO_riesgo = $riesgo;
        $oportunidades->RGO_posicion = $posicion;
        $oportunidades->RGO_medicotratante = $medicoTratante;
        $oportunidades->RGO_motivo = $motivo;
        $oportunidades->RGO_observaciones = $observaciones;
        $oportunidades->RGO_nombreReporta = $nombreReporta;
        $oportunidades->USU_registro = $usuario;
        $oportunidades->RGO_fechaReg = date('y-m-d H:i:s');
        $oportunidades->RGO_recepcion = $tipo;
        $oportunidades->RGO_estatus = 1;

        $oportunidades->save();

    }



}
