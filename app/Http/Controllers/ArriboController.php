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
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

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
        $puertos->prepend(' -- Seleccione una Opción -- ', '');

        $types = sop_Tipo_buque::lists('TIBU_NOMBRE','TIBU_ID');
        $types->prepend(' -- Seleccione una Opción -- ', '');
        
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


    public function getSolicitudes(){
        $data = ['user_id' => Auth::user()->id, 'table'=>'solicitudes'];
        return view('arribos/solicitudes',$data);
    }

    public function anyData(){
        $solicitudes = sop_Solicitudes_arribo::leftJoin('SOP_BUQUES', 'SOP_BUQUES.BUQU_ID', '=', 'SOP_SOLICITUDES_ARRIBOS.SARR_BUQUE_ID')
            ->leftJoin('SOP_PUERTOS', 'SOP_SOLICITUDES_ARRIBOS.SARR_PUERTO_ID', '=', 'SOP_PUERTOS.PUER_ID')
            ->leftJoin('SOP_MUELLES', 'SOP_SOLICITUDES_ARRIBOS.SARR_MUELLE_ID', '=', 'SOP_MUELLES.MUEL_ID')
            ->where('SARR_USER_ID', '=', Auth::user()->id)
            ->select('SOP_SOLICITUDES_ARRIBOS.*', 'SOP_BUQUES.BUQU_NOMBRE', 'SOP_PUERTOS.PUER_NOMBRE', 'SOP_MUELLES.MUEL_NOMBRE');
            
        return Datatables::of($solicitudes)

        ->addColumn('action', function ($sol) {
                return '
                    <a data-toggle="site-sidebar" href="javascript:;" data-url="solicitudes/update/'.$sol->SARR_ID.'" class="btn btn-sm btn-pure btn-icon"><i class="icon md-edit"></i></a>
                    <a href="#" data-id="'.$sol->SARR_ID.'" class="btn btn-sm btn-pure btn-icon delete"><i class="icon md-delete"></i></a>';
            })
            ->make(true);
    }

    public function postNuevo()
    {
        $validator = Validator::make(Input::all(), [
            "SARR_BUQUE_VIAJE"  => "required|unique:SOP_SOLICITUDES_ARRIBOS",
            "SARR_BUQUE_ID"  => "required",

        ]);
        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            );
        }
        
        //dd(Input::all());
        

        $Sarr = new sop_Solicitudes_arribo();
        $Sarr->SARR_BUQUE_ID        = Input::get('SARR_BUQUE_ID');
        $Sarr->SARR_USER_ID         = Auth::user()->id;
        $Sarr->SARR_BUQUE_VIAJE     = Input::get('SARR_BUQUE_VIAJE');
        $Sarr->SARR_TRAFICO_CLAVE   = Input::get('SARR_TRAFICO_CLAVE');
        $Sarr->SARR_ACTIVIDADES     = Input::get('SARR_ACTIVIDADES');
        $Sarr->SARR_ETA             = Input::get('SARR_ETA');
        $Sarr->SARR_ETB             = Input::get('SARR_ETB');
        $Sarr->SARR_ETD             = Input::get('SARR_ETD');
        $Sarr->SARR_BANDA_ATRAQUE   = Input::get('SARR_BANDA_ATRAQUE');
        $Sarr->SARR_CALADA_POPA     = Input::get('SARR_CALADA_POPA');
        $Sarr->SARR_CALADA_PROA     = Input::get('SARR_CALADA_PROA');
        $Sarr->SARR_PUERTO_ID       = Input::get('SARR_PUERTO_ID');
        $Sarr->SARR_MUELLE_ID       = Input::get('SARR_MUELLE_ID');
        $Sarr->SARR_DESTINO         = Input::get('SARR_DESTINO');
        $Sarr->SARR_OPERADORA       = Input::get('SARR_OPERADORA');
        $Sarr->SARR_OBSERVACIONES   = Input::get('SARR_OBSERVACIONES');
        $Sarr->SARR_HISTORIAL_PUERTOS = Input::get('SARR_HISTORIAL_PUERTOS');
        $Sarr->SARR_CREW_LIST       = Input::get('SARR_CREW_LIST');
    
        
        $Sarr->save();
        
        return ['aviso' => 'success'];
    }
}
