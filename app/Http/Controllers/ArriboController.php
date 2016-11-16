<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\sop_Tipo_buque;
use App\sop_Buque;
use App\sop_Tipo_trafico;
use App\sop_Puerto;
use App\sop_Muelle;

class ArriboController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex()
    {
        return view('home');
    }

    public function getMuelles(Request $request, $id){
        if ($request->ajax()) {
            $muelles = sop_Muelle::muelles($id);
            return response()->json($muelles);
        }
    }

    public function getBuques(Request $request, $id){
        if ($request->ajax()) {
            $buques = sop_Buque::buques($id);
            return response()->json($buques);
        }
    }


    public function getNuevo(){
        
        $puertos = sop_Puerto::lists('PUER_NOMBRE','PUER_ID');
        $puertos->prepend(' -- Seleccione una Opción -- ', 0);

        $types = sop_Tipo_buque::lists('TIBU_NOMBRE','TIBU_ID');
        $types->prepend(' -- Seleccione una Opción -- ', 0);
        
        $data = [
            'opcion' => 'null',
            'types' => $types,
            //'buques' => $buques,
            'trafico' => sop_Tipo_trafico::lists('TTRA_NOMBRE', 'TTRA_CLAVE'),
            'puertos' => $puertos,
            //'puertos' => sop_Puerto::lists('PUER_NOMBRE','PUER_ID'),
            //'muelles' => sop_Muelle::lists('MUEL_NOMBRE', 'MUEL_ID'),
                ];

        return view('arribos/nuevo', $data);
    }

    public function postNuevo()
    {
        $validator = Validator::make(Input::all(), [
            "SARR_BUQUE_ID"  => "required|unique:SOP_SOLICITUDES_ARRIBOS",

        ]);
        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            );
        }
        dd(Input::all());

        $Sarr = new sop_Puerto();
        $Sarr->SARR_BUQUE_ID = Input::get('BUQUE_ID');
        $Sarr->SARR_NOMBRE = Input::get('SARR_NOMBRE');
        $Sarr->SARR_NOMBRELARGO = Input::get('SARR_NOMBRELARGO');
        $Sarr->SARR_CALADO = Input::get('SARR_CALADO');
        $Sarr->SARR_LONGITUD = Input::get('SARR_LONGITUD');
        $Sarr->SARR_DESCRIP = Input::get('SARR_DESCRIP');
        $Sarr->SARR_TERMINAL = Input::get('SARR_TERMINAL');
        $Sarr->save();
        
        return ['aviso' => 'success'];
    }
}
