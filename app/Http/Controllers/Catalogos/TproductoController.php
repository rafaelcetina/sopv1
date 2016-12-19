<?php

namespace App\Http\Controllers\Catalogos;

use App\Sop_tproducto;
use App\Sop_tcarga;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class TproductoController extends Controller{

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
            return view('cat.content',['table' => 'tproductos', 'ajax' => 1]);
        } else {
            return view('cat.index',['table' => 'tproductos']);
           // return view('home');
        }
    }

    public function anyData(){

	    $tproductos = Sop_tproducto::leftJoin('SOP_TCARGAS', 'SOP_TPRODUCTOS.TPRO_TCAR_ID', '=', 'SOP_TCARGAS.TCAR_ID')
            ->select('SOP_TPRODUCTOS.*', 'SOP_TCARGAS.TCAR_NOMBRE');
            
        return Datatables::of($tproductos)

            ->addColumn('action', function ($tpro) {
                return '<a data-toggle="site-sidebar" href="javascript:;" data-url="tproductos/update/'.$tpro->TPRO_ID.'" class="btn btn-sm btn-pure btn-icon"><i class="icon md-edit"></i></a>
                <a href="#" data-id="'.$tpro->TPRO_ID.'" class="btn btn-sm btn-pure btn-icon delete"><i class="icon md-delete"></i></a>';
            })
            ->make(true);
    }

    public function getCreate(){

        $data = [
            'table' => 'tproductos',
            'opcion' => 'null',
            'tcargas' => Sop_tcarga::lists('TCAR_NOMBRE', 'TCAR_ID'),
                ];

        return view('tproductos.create', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function postCreate(){
        $messages = [
            'TPRO_NOMBRE.unique'  => 'El nombre ya está en uso',
            'TPRO_NOMBRE.required'  => 'El nombre es requerido',
            'TPRO_UNIDAD.required' => 'La unidad es requerida',
        ];

        $validator = Validator::make(Input::all(), [
            "TPRO_NOMBRE"       => "required|unique:SOP_TPRODUCTOS",
            "TPRO_UNIDAD"       => "required:SOP_TPRODUCTOS",
        ], $messages);


        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            );
        }

        $Tproducto = new Sop_tproducto();
        $Tproducto->TPRO_NOMBRE = Input::get('TPRO_NOMBRE');
        $Tproducto->TPRO_UNIDAD = Input::get('TPRO_UNIDAD');
        $Tproducto->TPRO_TCAR_ID = Input::get('TPRO_TCAR_ID');
        $Tproducto->save();
        
        return ['aviso' => 'success'];
    }

    public function getUpdate($id){
        $tproducto = Sop_tproducto::find($id);
        $data = [
            'opcion' => $tproducto->TPRO_TCAR_ID,
            'tproducto' => $tproducto,
            'tcargas' => Sop_tcarga::lists('TCAR_NOMBRE', 'TCAR_ID'),
                ];
        return view('tproductos.update', $data);
    }


    public function postUpdate($id){
        $messages = [
            'TPRO_NOMBRE.unique'  => 'El nombre ya está en uso',
        ];

        $Tproducto = Sop_tproducto::find($id);
       
        $rules = ["TPRO_UNIDAD" => "required"];

        if ($Tproducto->TPRO_NOMBRE != Input::get('TPRO_NOMBRE')){

            $rules += ['TPRO_NOMBRE' => 'required|unique:SOP_TPRODUCTOS'];
        }


        $validator = Validator::make(Input::all(), $rules, $messages);
        
        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            );
        }
        
        $Tproducto->TPRO_NOMBRE = Input::get('TPRO_NOMBRE');
        $Tproducto->TPRO_UNIDAD = Input::get('TPRO_UNIDAD');
        $Tproducto->TPRO_TCAR_ID = Input::get('TPRO_TCAR_ID');
        $Tproducto->save();

        return ['aviso' => 'finish'];
    }

    public function postDelete(){
        $id = Input::get('id');
        Sop_tcarga::destroy($id);
    }
}
