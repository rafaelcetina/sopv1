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
  


    public function getSolicitudes(){
        $data = ['table'=>'solicitudes'];
        return view('control_arribos/solicitudes',$data);
    }

    public function anyData(){
        $solicitudes = sop_Solicitudes_arribo::leftJoin('SOP_BUQUES', 'SOP_BUQUES.BUQU_ID', '=', 'SOP_SOLICITUDES_ARRIBOS.SARR_BUQUE_ID')
            ->leftJoin('SOP_PUERTOS', 'SOP_SOLICITUDES_ARRIBOS.SARR_PUERTO_ID', '=', 'SOP_PUERTOS.PUER_ID')
            ->leftJoin('SOP_MUELLES', 'SOP_SOLICITUDES_ARRIBOS.SARR_MUELLE_ID', '=', 'SOP_MUELLES.MUEL_ID')
            //->where('SARR_USER_ID', '=', Auth::user()->id)
            ->select('SOP_SOLICITUDES_ARRIBOS.*', 'SOP_BUQUES.BUQU_NOMBRE', 'SOP_PUERTOS.PUER_NOMBRE', 'SOP_MUELLES.MUEL_NOMBRE');
            
        return Datatables::of($solicitudes)

        ->addColumn('action', function ($sol) {
                return '
                    <a data-toggle="site-sidebar" href="javascript:;" data-url="solicitudes/update/'.$sol->SARR_ID.'" class="btn btn-sm btn-pure btn-icon"><i class="icon md-edit"></i></a>
                    <a href="#" data-id="'.$sol->SARR_ID.'" class="btn btn-sm btn-pure btn-icon delete"><i class="icon md-delete"></i></a>';
            })
            ->make(true);
    }

}
