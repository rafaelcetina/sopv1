<?php

namespace App\Http\Controllers\Catalogos;

use App\sop_Puerto;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class PuertoController extends Controller{

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
            return view('cat.content',['table' => 'puertos', 'ajax' => 1]);
        } else {
            return view('cat.index',['table' => 'puertos']);
           // return view('home');
        }
    }

    public function anyData(){

        return Datatables::of(sop_Puerto::query())
            ->addColumn('action', function ($puerto) {
                return '<a data-toggle="site-sidebar" href="javascript:;" data-url="puertos/update/'.$puerto->PUER_ID.'" class="btn btn-sm btn-pure btn-icon"><i class="icon md-edit"></i></a>
                <a href="#" data-id="'.$puerto->PUER_ID.'" class="btn btn-sm btn-pure btn-icon delete"><i class="icon md-delete"></i></a>';
            })
            ->make(true);
    }


    public function getCreate(){
        return view('puertos.create', array('table' => 'puertos'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function postCreate(){
        $validator = Validator::make(Input::all(), [
            "PUER_NOMBRE"       => "required|unique:SOP_PUERTOS",

        ]);
        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            );
        }
        $Puerto = new sop_Puerto();
        $Puerto->MUEL_PUERTO = Input::get('MUEL_PUERTO');
        $Puerto->MUEL_NOMBRE = Input::get('MUEL_NOMBRE');
        $Puerto->MUEL_NOMBRELARGO = Input::get('MUEL_NOMBRELARGO');
        $Puerto->MUEL_CALADO = Input::get('MUEL_CALADO');
        $Puerto->MUEL_LONGITUD = Input::get('MUEL_LONGITUD');
        $Puerto->MUEL_DESCRIP = Input::get('MUEL_DESCRIP');
        $Puerto->MUEL_TERMINAL = Input::get('MUEL_TERMINAL');
        $Puerto->save();
        
        return ['aviso' => 'success'];
    }

    public function getUpdate($id){
        return view('muelles.update', ['muelle' => sop_Muelle::find($id)]);
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
