<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\sop_Tcarga;

use App\sop_Cargas_arribo;

use Yajra\Datatables\Datatables;

class CargaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(){
        return view('home');
    }

    public function getNuevo(){

        $tcargas = sop_Tcarga::lists('TCAR_NOMBRE','TCAR_ID');
        $tcargas->prepend(' -- Seleccione una Opción -- ', '');
        
        $data = [
            'opcion' => 'null',
            'tcargas' => $tcargas,
            ];
            
        return view('arribos/form_cargas', $data);
        
    }


    public function postNuevo(Request $request){
        
        //dd(Input::all());
        $solicitud_id_tmp = $request->session()->get('solicitud_id_tmp');
        
        $messages = [
            'CARR_TCARGA_ID.required'  => 'El tipo de carga es requerido',
        ];

        $validator = Validator::make(Input::all(), [
            "CARR_TCARGA_ID"  => "required",

        ], $messages);
        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            );
        }

        $Carr = new sop_Cargas_arribo();
        $Carr->CARR_TRAFICO_CLAVE   = Input::get('CARR_TRAFICO_CLAVE');
        $Carr->CARR_PELIGRO = 0;
        if(Input::get('CARR_PELIGRO')!='')
            $Carr->CARR_PELIGRO         = 1;
        $Carr->CARR_TCARGA_ID       = Input::get('CARR_TCARGA_ID');
        $Carr->CARR_TPRODUCTO_ID    = Input::get('CARR_TPRODUCTO_ID');
        $Carr->CARR_UNIDAD          = Input::get('CARR_UNIDAD');
        $Carr->CARR_SARR_ID         = $solicitud_id_tmp;
        
        
        $Carr->save();
        
        return ['aviso' => 'success'];
    }


    public function anyData(Request $request){

        $solicitud_id_tmp = $request->session()->get('solicitud_id_tmp');

        $cargas = sop_Cargas_arribo::leftJoin('SOP_TCARGAS', 'SOP_TCARGAS.TCAR_ID', '=', 'SOP_CARGAS_ARRIBOS.CARR_TCARGA_ID')
            ->leftJoin('SOP_TPRODUCTOS', 'SOP_TPRODUCTOS.TPRO_ID','=','SOP_CARGAS_ARRIBOS.CARR_TPRODUCTO_ID')
            ->where('CARR_SARR_ID', '=', $solicitud_id_tmp)
            ->select('SOP_CARGAS_ARRIBOS.*', 'SOP_TCARGAS.TCAR_NOMBRE', 'SOP_TPRODUCTOS.TPRO_NOMBRE', 'SOP_TPRODUCTOS.TPRO_UNIDAD');
            
        return Datatables::of($cargas)

            ->addColumn('action', function ($cargas) {
                return '<a data-toggle="site-sidebar" href="javascript:;" data-url="cargas/update/'.$cargas->CARR_ID.'" class="btn btn-sm btn-pure btn-icon"><i class="icon md-edit"></i></a>
                <a href="#" data-id="'.$cargas->CARR_ID.'" class="btn btn-sm btn-pure btn-icon delete"><i class="icon md-delete"></i></a>';
            })
            ->make(true);
    }

    public function postDelete(){
        $id = Input::get('id');
        sop_Cargas_arribo::destroy($id);
    }
}