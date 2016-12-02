<?php

namespace App\Http\Controllers\Catalogos;

use Illuminate\Http\Request;
use App\sop_Muelle;
use App\sop_Puerto;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class MuelleController extends Controller{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getIndex(){
        if(\Request::ajax()) {
            return view('cat.content',['table' => 'muelles', 'ajax' => 1]);
        } else {
            return view('cat.index',['table' => 'muelles']);
           // return view('home');
        }
    }

    public function anyData(){

        $muelles = sop_Muelle::leftJoin('SOP_PUERTOS', 'SOP_MUELLES.MUEL_PUERTO', '=', 'SOP_PUERTOS.PUER_ID')
            ->select('SOP_MUELLES.*', 'SOP_PUERTOS.PUER_NOMBRE');
            
        return Datatables::of($muelles)

            ->addColumn('action', function ($mue) {
                return '<a data-toggle="site-sidebar" href="javascript:;" data-url="muelles/update/'.$mue->MUEL_ID.'" class="btn btn-sm btn-pure btn-icon"><i class="icon md-edit"></i></a>
                <a href="#" data-id="'.$mue->MUEL_ID.'" class="btn btn-sm btn-pure btn-icon delete"><i class="icon md-delete"></i></a>';
            })
            ->make(true);
    }


    public function getCreate(){
        $data = [
            'table' => 'muelles',
            'opcion' => 'null',
            'puertos' => sop_Puerto::lists('PUER_NOMBRE', 'PUER_ID'),
                ];

        return view('muelles.create', $data);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function postCreate(){
        $validator = Validator::make(Input::all(), [
            "MUEL_NOMBRE"       => "required|unique:SOP_MUELLES",

        ]);
        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            );
        }
        $Muelle = new sop_Muelle();
        $Muelle->MUEL_PUERTO = Input::get('MUEL_PUERTO');
        $Muelle->MUEL_NOMBRE = Input::get('MUEL_NOMBRE');
        $Muelle->MUEL_NOMBRELARGO = Input::get('MUEL_NOMBRELARGO');
        $Muelle->MUEL_CALADO = Input::get('MUEL_CALADO');
        $Muelle->MUEL_LONGITUD = Input::get('MUEL_LONGITUD');
        $Muelle->MUEL_DESCRIP = Input::get('MUEL_DESCRIP');
        $Muelle->MUEL_TERMINAL = Input::get('MUEL_TERMINAL');
        $Muelle->save();
        
        return ['aviso' => 'success'];
    }

    public function getUpdate($id){
        $muelle = sop_Muelle::find($id);
        $data = [
            'opcion' => $muelle->MUEL_PUERTO,
            'muelle' => $muelle,
            'puertos' => sop_Puerto::lists('PUER_NOMBRE', 'PUER_ID'),
                ];

        return view('muelles.update', $data);
    }

    public function postUpdate($id){   
        $messages = [
            'MUEL_NOMBRE.unique'  => 'El nombre ya está en uso',
        ];

        $Muelle = sop_Muelle::find($id);

        $rules =[];
        
        if ($Muelle->MUEL_NOMBRE != Input::get('MUEL_NOMBRE'))
            $rules += ['MUEL_NOMBRE' => 'required|unique:SOP_MUELLES'];

        $validator = Validator::make(Input::all(), $rules, $messages);

        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            );
        }

        $Muelle->MUEL_PUERTO = Input::get('MUEL_PUERTO');
        $Muelle->MUEL_NOMBRE = Input::get('MUEL_NOMBRE');
        $Muelle->MUEL_NOMBRELARGO = Input::get('MUEL_NOMBRELARGO');
        $Muelle->MUEL_CALADO = Input::get('MUEL_CALADO');
        $Muelle->MUEL_LONGITUD = Input::get('MUEL_LONGITUD');
        $Muelle->MUEL_DESCRIP = Input::get('MUEL_DESCRIP');
        $Muelle->MUEL_TERMINAL = Input::get('MUEL_TERMINAL');
        $Muelle->save();
        
        return ['aviso' => 'success'];
    }

    public function postDelete(){
        $id = Input::get('id');
        sop_Muelle::destroy($id);
    }
}
