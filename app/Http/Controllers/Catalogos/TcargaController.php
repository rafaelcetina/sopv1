<?php

namespace App\Http\Controllers\Catalogos;

use Illuminate\Http\Request;
use App\sop_Tcarga;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class TcargaController extends Controller{

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
        return view('cat.index',['table' => 'tcargas']);
    }

    public function anyData(){
	    return Datatables::of(sop_Tcarga::query())
            ->addColumn('action', function ($tcargas) {
                return '<a data-toggle="site-sidebar" href="javascript:;" data-url="tcargas/update/'.$tcargas->TCAR_ID.'" class="btn btn-xs btn-success"><i class="icon md-edit"></i></a>
                    <a href="#" data-id="'.$tcargas->TCAR_ID.'" class="btn btn-xs btn-danger delete"><i class="icon md-delete"></i></a>';
            })
            ->make(true);
    }

    public function getCreate(){

        $data = [
            'table' => 'tcargas',
                ];
        return view('tcargas.create', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function postCreate(){
        $messages = [
            'TCAR_NOMBRE.unique'  => 'El nombre ya está en uso',
            'TCAR_NOMBRE.required'  => 'El nombre es requerido',
            'TCAR_SECTOR.required' => 'El sector es requerido',
        ];

        $validator = Validator::make(Input::all(), [
            "TCAR_NOMBRE"       => "required|unique:SOP_TCARGAS",
            "TCAR_SECTOR"       => "required:SOP_TCARGAS",
        ], $messages);


        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            );
        }

        $Tcarga = new sop_Tcarga();
        $Tcarga->TCAR_NOMBRE = Input::get('TCAR_NOMBRE');
        $Tcarga->TCAR_SECTOR = Input::get('TCAR_SECTOR');
        $Tcarga->save();
        
        return ['aviso' => 'success'];
    }

    public function getUpdate($id){
        $tcarga = sop_Tcarga::find($id);
        $data = [
            'tcarga' => $tcarga,
                ];
        return view('tcargas.update', $data);
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
