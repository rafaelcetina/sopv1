<?php

namespace App\Http\Controllers\Catalogos;

use Illuminate\Http\Request;
use App\sop_Buque;
use App\sop_Tipo_buque;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class BuqueController extends Controller{

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
            return view('cat.content',['table' => 'buques']);
        } else {
            return view('cat.index',['table' => 'buques']);
           // return view('home');
        }
    }

    public function getBandera($ban){
        return view('buques.bandera', ['bandera'=> $ban]);
    }

    public function anyData(){
	    $buques = sop_Buque::leftJoin('SOP_TIPO_BUQUES', 'SOP_BUQUES.BUQU_TIPO_BUQUE', '=', 'SOP_TIPO_BUQUES.TIBU_ID')
            ->leftJoin('SOP_PAISES', 'SOP_BUQUES.BUQU_BANDERA', '=', 'SOP_PAISES.PAIS_ID')
            ->select('SOP_BUQUES.*', 'SOP_TIPO_BUQUES.TIBU_NOMBRE', 'SOP_PAISES.PAIS_BANDERA');
            
        return Datatables::of($buques)

        // ->editColumn('BUQU_BANDERA', function($buq){
        //     return '<img src="buques/bandera/'.$buq->PAIS_BANDERA.'" />';
        // })


        ->addColumn('action', function ($buq) {
            return '<a data-toggle="site-sidebar" href="javascript:;" data-url="buques/update/'.$buq->BUQU_ID.'" class="btn btn-sm btn-pure btn-icon"><i class="icon md-edit"></i></a>
                <a href="#" data-id="'.$buq->BUQU_ID.'" class="btn btn-sm btn-pure btn-icon delete"><i class="icon md-delete"></i></a>';
            })

        
            ->make(true);
    }

    public function getCreate(){

        $data = [
            'table' => 'buques',
            'opcion' => 'null',
            'types' => sop_Tipo_buque::lists('TIBU_NOMBRE', 'TIBU_ID'),
                ];
        return view('buques.create', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function postCreate(){
        $messages = [
            'BUQU_NOMBRE.unique'  => 'El nombre ya está en uso',
            'BUQU_MATRICULA.unique' => 'La matricula debe ser única',
        ];

        $validator = Validator::make(Input::all(), [
            "BUQU_NOMBRE"       => "required|unique:SOP_BUQUES",
            "BUQU_MATRICULA"    => "required|unique:SOP_BUQUES",

        ], $messages);


        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            );
        }

        $Buque = new sop_Buque();
        $Buque->BUQU_TIPO_BUQUE = Input::get('BUQU_TIPO_BUQUE');
        $Buque->BUQU_NOMBRE = Input::get('BUQU_NOMBRE');
        $Buque->BUQU_BANDERA = Input::get('BUQU_BANDERA');
        $Buque->BUQU_MATRICULA = Input::get('BUQU_MATRICULA');
        $Buque->save();
        
        return ['aviso' => 'success'];
    }

    public function getUpdate($id){
        $buque = sop_Buque::find($id);
        $data = [
            'opcion' => $buque->BUQU_TIPO_BUQUE,
            'buque' => $buque,
            'types' => sop_Tipo_buque::lists('TIBU_NOMBRE', 'TIBU_ID'),
                ];
        return view('buques.update', $data);
    }


    public function postUpdate($id){
        $messages = [
            'BUQU_NOMBRE.unique'  => 'El nombre ya está en uso',
            'BUQU_MATRICULA.unique' => 'La matricula debe ser única',
            'BUQU_BANDERA.required' => 'La bandera no está espeficada'
        ];

        $Buque = sop_Buque::find($id);
       
        $rules = ["BUQU_BANDERA" => "required"];

        if ($Buque->BUQU_NOMBRE != Input::get('BUQU_NOMBRE')){

            $rules += ['BUQU_NOMBRE' => 'required|unique:SOP_BUQUES'];
        }

        if ($Buque->BUQU_MATRICULA != Input::get('BUQU_MATRICULA')){

            $rules += ['BUQU_MATRICULA' => 'required|unique:SOP_BUQUES'];
        }

        $validator = Validator::make(Input::all(), $rules, $messages);
        
        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            );
        }
        
        $Buque->BUQU_TIPO_BUQUE = Input::get('BUQU_TIPO_BUQUE');
        $Buque->BUQU_NOMBRE = Input::get('BUQU_NOMBRE');
        $Buque->BUQU_BANDERA = Input::get('BUQU_BANDERA');
        $Buque->BUQU_MATRICULA = Input::get('BUQU_MATRICULA');
        $Buque->save();

        return ['aviso' => 'finish'];
    }

    public function postDelete(){
        $id = Input::get('id');
        sop_Buque::destroy($id);
    }
}
