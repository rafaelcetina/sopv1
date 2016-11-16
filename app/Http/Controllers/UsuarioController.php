<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Yajra\Datatables\Datatables;

class UsuarioController extends Controller{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex(){
        return view('usuarios.index');
    }

    public function getActivar($id){
        return view('usuarios.activar', ['usuario' => User::find($id)]);
    }

    public function postActivar($id){
        
        $Usuario = User::find($id);
        
        $Usuario->active = Input::get('active');
        $Usuario->save();

        return ['aviso' => 'finish'];
    }

    public function anyData(){
    		$usuarios = User::leftJoin('tipo_usuarios', 'users.id_tipo_usuario', '=', 'tipo_usuarios.id')
    		->select('users.*', 'tipo_usuarios.tipo');
	    	
	    return Datatables::of($usuarios)

        ->addColumn('action', function ($user) {
                return '
                    <a data-toggle="site-sidebar" href="javascript:;" data-url="usuarios/activar/'.$user->id.'" class="btn btn-sm btn-pure btn-icon"><i class="icon md-check"></i></a>
                    <a data-toggle="site-sidebar" href="javascript:;" data-url="user/update/'.$user->id.'" class="btn btn-sm btn-pure btn-icon"><i class="icon md-edit"></i></a>
                    <a href="#" data-id="'.$user->id.'" class="btn btn-sm btn-pure btn-icon delete"><i class="icon md-delete"></i></a>';
            })
            ->make(true);
    }

}