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
use App\sop_Solicitudes_arribo;
use App\sop_Tproducto;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

class ControlArriboController extends Controller
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
  
    public function getTproductos(Request $request, $id){
        if ($request->ajax()) {
            $tproductos = sop_Tproducto::tproductos($id);
            return response()->json($tproductos);
        }
    }

    public function getUnidad(Request $request, $id){
        if ($request->ajax()) {
            $tproducto = sop_Tproducto::tproducto_uni($id);
            return response()->json($tproducto);
        }
    }

    public function getSolicitudes(){
        
        if(\Request::ajax()) {
            return view('control_arribos/content',['table' => 'solicitudes', 'ajax'=> 1]);
        } else {
            return view('control_arribos/solicitudes',['table'=>'solicitudes']);
        }
    }


    public function getProgramados(){
        
        if(\Request::ajax()) {
            return view('control_arribos/content_programados',['table' => 'programados', 'ajax'=> 1]);
        } else {
            return view('control_arribos/programados',['table'=>'programados']);
        }
    }


    public function getProgramar($folio){

        $data = $this->getDatos($folio);
        $data['table'] = 'programar';

        if(\Request::ajax()) {
            $data['ajax']=1;
            return view('control_arribos/content_programar',$data);
        } else {
            return view('control_arribos/programar',$data);
        }
    }

    public function postAprobar(){
        
        $id = Input::get('id');
        $solicitud = sop_Solicitudes_arribo::where('SARR_FOLIO', $id)->first();
        $solicitud->SARR_STATUS = 2;
        $solicitud->save();

        return ['aviso' => 'finish!'];
    }


    public function anyData($status=1){
        $solicitudes = sop_Solicitudes_arribo::leftJoin('SOP_BUQUES', 'SOP_BUQUES.BUQU_ID', '=', 'SOP_SOLICITUDES_ARRIBOS.SARR_BUQUE_ID')
            ->leftJoin('SOP_PUERTOS', 'SOP_SOLICITUDES_ARRIBOS.SARR_PUERTO_ID', '=', 'SOP_PUERTOS.PUER_ID')
            ->leftJoin('SOP_MUELLES', 'SOP_SOLICITUDES_ARRIBOS.SARR_MUELLE_ID', '=', 'SOP_MUELLES.MUEL_ID')
            ->where('SARR_STATUS', '=', $status)
            ->select('SOP_SOLICITUDES_ARRIBOS.*', 'SOP_BUQUES.BUQU_NOMBRE', 'SOP_PUERTOS.PUER_NOMBRE', 'SOP_MUELLES.MUEL_NOMBRE');
            
        return Datatables::of($solicitudes)

        ->addColumn('action', function ($sol) {
                return '
                <a data-toggle="site-sidebar" href="javascript:;" data-url="../cargas/cargas/'.$sol->SARR_ID.'" class="btn btn-sm btn-pure btn-icon"><i class="icon md-boat"></i></a>

                <a data-toggle="site-sidebar" href="javascript:;" data-url="solicitudes/update/'.$sol->SARR_ID.'" class="btn btn-sm btn-pure btn-icon"><i class="icon md-edit"></i></a>
                <a href="#" data-id="'.$sol->SARR_ID.'" class="btn btn-sm btn-pure btn-icon delete"><i class="icon md-delete"></i></a>';
            })
            ->make(true);
    }

    /**
    ** @param $folio
    ** @return Datos de la solicitud de arribo con respecto al @folio proporcionado
    **/
    public function getDatos($folio) {
        $data = sop_Solicitudes_arribo::leftJoin('SOP_BUQUES', 'BUQU_ID', '=', 'SARR_BUQUE_ID')            
            ->leftJoin('SOP_PUERTOS', 'SARR_PUERTO_ID', '=', 'PUER_ID')
            ->leftJoin('SOP_MUELLES', 'SARR_MUELLE_ID', '=', 'MUEL_ID')
            ->leftJoin('SOP_TIPO_BUQUES', 'TIBU_ID', '=', 'BUQU_TIPO_BUQUE')
            ->leftJoin('SOP_PAISES', 'BUQU_BANDERA', '=', 'PAIS_ID')
            ->leftJoin('users', 'users.id', '=', 'SARR_USER_ID')
            ->where('SARR_FOLIO', '=', $folio)

            ->select('SOP_SOLICITUDES_ARRIBOS.*', 'SOP_BUQUES.*',
                'SOP_PUERTOS.*', 'SOP_PAISES.PAIS_NOMBRE', 'SOP_TIPO_BUQUES.TIBU_NOMBRE', 'users.*',
                'SOP_MUELLES.MUEL_NOMBRE', 'SOP_PUERTOS.PUER_NOMBRE'
                )->first();

        return $data;
    }

}
