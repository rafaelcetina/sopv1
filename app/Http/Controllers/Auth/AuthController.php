<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\tipo_usuario;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */
    
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data){
        return Validator::make($data, [
            'nombre' => 'required|max:255',
            'usuario' => 'required|max:255|unique:users',
            'email' => 'required|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data){
        return User::create([
            'id_tipo_usuario' => $data['id_tipo_usuario'],
            'usuario' => $data['usuario'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'nombre' => $data['nombre'],
            'nombrecorto' => $data['nombrecorto'],
            'empresa' => $data['empresa'],
            'domicilio' => $data['domicilio'],
            'rfc' => $data['rfc']

        ]);
    }


    public function showRegistrationForm()
    {
        if (property_exists($this, 'registerView')) {
            return view($this->registerView);
        }
        
        $data = [
            'types' => tipo_usuario::lists('tipo', 'id'),
            'opcion' => 'null',
                ];

        return view('auth.register',$data);
    }


    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function register(Request $request)
    {
        $validator = $this->validator($request->all());
        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $this->create($request->all());
        return redirect($this->redirectPath());
    }


   protected function loginUsername()
   {
       return property_exists($this, 'username') ? $this->username : 'usuario';
   }

   protected function getCredentials(Request $request)
    {
        $credentials =  $request->only($this->loginUsername(), 'password');
        $credentials = array_add($credentials,'active',1);
        return $credentials;
    }

}
