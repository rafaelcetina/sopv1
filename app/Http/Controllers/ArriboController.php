<?php

namespace App\Http\Controllers;

use Mail;
use Crypt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Sop_tipo_buque;
use App\Sop_buque;
use App\Sop_tipo_trafico;
use App\Sop_puerto;
use App\Sop_muelle;
use App\Sop_tcarga;
use App\Sop_tproducto;
use App\Sop_solicitudes_arribo;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;

/**
 * Class ArriboController
 * @package App\Http\Controllers
 */
class ArriboController extends Controller
{


    /**
     * ArriboController constructor .
     */
    public function __construct()
    {
        /**
         * Valida inicio de sesión existencia
         */
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Vista home
     */
    public function getIndex()
    {
        return view('home');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * lista de muelles por id de puerto
     */
    public function getMuelles(Request $request, $id){
        if ($request->ajax()) {
            $muelles = Sop_muelle::muelles($id);
            return response()->json($muelles);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * lista de buques por id de tipo de buque
     */
    public function getBuques(Request $request, $id){
        if ($request->ajax()) {
            $buques = Sop_buque::buques($id);
            return response()->json($buques);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * lista de productos por id de tipo de producto
     */
    public function getTproductos(Request $request, $id){
        if ($request->ajax()) {
            $tproductos = Sop_tproducto::tproductos($id);
            return response()->json($tproductos);
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * tipo de unidad por id de producto
     */
    public function getUnidad(Request $request, $id){
        if ($request->ajax()) {
            $tproducto = Sop_tproducto::tproducto_uni($id);
            return response()->json($tproducto);
        }
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * vista de nuevo arribo
     */
    public function getNuevo(){
        
        $puertos = Sop_puerto::lists('PUER_NOMBRE','PUER_ID');
        $puertos->prepend(' -- Seleccione una Opción -- ', '');

        $types = Sop_tipo_buque::leftJoin('SOP_TBUQUES_USUARIOS', 'TBUS_TIBU_ID', '=', 'TIBU_ID')
        /**
         * Filtro solo los tipos de buques asignados al usuario
         */
        ->where('TBUS_USUA_ID', '=', Auth::user()->id)
        ->lists('TIBU_NOMBRE','TIBU_ID');
        $types->prepend(' -- Seleccione una Opción -- ', '');

        $tcargas = Sop_tcarga::lists('TCAR_NOMBRE','TCAR_ID');
        $tcargas->prepend(' -- Seleccione una Opción -- ', '');
        
        $data = [

            'opcion' => 'null',
            'types' => $types,
            'trafico' => Sop_tipo_trafico::lists('TTRA_NOMBRE', 'TTRA_CLAVE'),
            'puertos' => $puertos,
            'tcargas' => $tcargas,
                ];

        /**
         * Si la petición es por ajax, retorna la vista solo del contenedor
         * Sino, devuelve la vista completa.
         */
        if(\Request::ajax()) {
            $data['ajax'] = 1;
           return view('arribos/content_nuevo', $data);
        } else {
            return view('arribos/nuevo', $data);
        }    
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * vista de la lista de solicitudes obtenidas por el id del usuario con sesión iniciada
     */
    public function getSolicitudes(){
        $data = ['user_id' => Auth::user()->id, 'table'=>'solicitudes'];
        /**
         * Si la petición es por ajax, retorna la vista solo del contenedor
         * Sino, devuelve la vista completa.
         */
        if(\Request::ajax()) {
            $data = ['user_id' => Auth::user()->id, 'table'=>'solicitudes', 'ajax'=>1];
           return view('arribos/content_solicitudes', $data);
        } else {
            return view('arribos/solicitudes',$data);
        }   
    }

    
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * vista de historico de arribos
     */
    public function getHistorico(){
        $data = ['user_id' => Auth::user()->id, 'table'=>'historico'];
        /**
         * Si la petición es por ajax, retorna la vista solo del contenedor
         * Sino, devuelve la vista completa.
         */
        if(\Request::ajax()) {
            $data['ajax']=1;
            return view('arribos/content_solicitudes', $data);
        } else {
            return view('arribos/solicitudes',$data);
        }   
    }

    /**
     * @param int $status
     * @return mixed
     * datos para llenar el datatable
     */
    public function anyData($status=1){
        $solicitudes = Sop_solicitudes_arribo::leftJoin('SOP_BUQUES', 'SOP_BUQUES.BUQU_ID', '=', 'SOP_SOLICITUDES_ARRIBOS.SARR_BUQUE_ID')
            ->leftJoin('SOP_PUERTOS', 'SOP_SOLICITUDES_ARRIBOS.SARR_PUERTO_ID', '=', 'SOP_PUERTOS.PUER_ID')
            ->leftJoin('SOP_MUELLES', 'SOP_SOLICITUDES_ARRIBOS.SARR_MUELLE_ID', '=', 'SOP_MUELLES.MUEL_ID')
            ->where([['SARR_USER_ID', '=', Auth::user()->id],['SARR_STATUS','=',$status],])
            ->select('SOP_SOLICITUDES_ARRIBOS.*', 'SOP_BUQUES.BUQU_NOMBRE', 'SOP_PUERTOS.PUER_NOMBRE', 'SOP_MUELLES.MUEL_NOMBRE');
            
        return Datatables::of($solicitudes)

        ->addColumn('action', function ($sol) {
                return 
                '
                <a data-toggle="site-sidebar" href="javascript:;" data-url="solicitudes/update/'.$sol->SARR_ID.'" class="btn btn-sm btn-pure btn-icon"><i class="icon md-edit"></i></a>
                <a href="#" data-id="'.$sol->SARR_ID.'" class="btn btn-sm btn-pure btn-icon delete"><i class="icon md-delete"></i></a>';
            })
            ->make(true);
    }

    /**
     * @return array
     * procesa la solicitud y devuelve el folio de solicitud
     */
    public function postNuevo(){
        $messages = [
            'SARR_MUELLE_ID.unique'  => 'EL MUELLE ESTA OCUPADO',
            
        ];

        $validator = Validator::make(Input::all(), [
            "SARR_FOLIO"  => "unique:SOP_SOLICITUDES_ARRIBOS",
            "SARR_BUQUE_ID"  => "required",
            "SARR_MUELLE_ID"  => "required",

        ], $messages);
        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            );
        }
        
        $Sarr = new Sop_solicitudes_arribo();
        $Sarr->SARR_BUQUE_ID        = Input::get('SARR_BUQUE_ID');
        $Sarr->SARR_USER_ID         = Auth::user()->id;
        $Sarr->SARR_TRAFICO_CLAVE   = Input::get('SARR_TRAFICO_CLAVE');
        $Sarr->SARR_ACTIVIDADES     = Input::get('SARR_ACTIVIDADES');
        $Sarr->SARR_ETA             = Input::get('SARR_ETA');
        $Sarr->SARR_ETB             = Input::get('SARR_ETB');
        $Sarr->SARR_ETD             = Input::get('SARR_ETD');
        $Sarr->SARR_CALADA_POPA     = Input::get('SARR_CALADA_POPA');
        $Sarr->SARR_CALADA_PROA     = Input::get('SARR_CALADA_PROA');
        $Sarr->SARR_PUERTO_ID       = Input::get('SARR_PUERTO_ID');
        $Sarr->SARR_MUELLE_ID       = Input::get('SARR_MUELLE_ID');
        $Sarr->SARR_DESTINO         = Input::get('SARR_DESTINO');
        $Sarr->SARR_OPERADORA       = Input::get('SARR_OPERADORA');
        $Sarr->SARR_OBSERVACIONES   = Input::get('SARR_OBSERVACIONES');
        $Sarr->SARR_HISTORIAL_PUERTOS = Input::get('SARR_HISTORIAL_PUERTOS');
        $Sarr->SARR_CREW_LIST       = Input::get('SARR_CREW_LIST');
        $Sarr->SARR_STATUS          = 1;

        /**
         * Generar Folio
         * API-QROO-[ID_BUQUE]-[ETA]
         */
        $fecha = Input::get('SARR_ETA');
        $chars = array("/", " ", ":");
        $folio = 'API-QROO-'.Input::get('SARR_BUQUE_ID').'-'.str_replace($chars,"",$fecha);
        
        $Sarr->SARR_FOLIO = $folio;

        $valido = $this->validacion(Input::get('SARR_MUELLE_ID'), Input::get('SARR_ETA'), Input::get('SARR_ETD'));

        if($valido=="ok"){
            //return ['error' =>false];
        }else{
            return ['error' =>$valido];
            //die();
        }
        
        $Sarr->save();

        $data = $this->getDatos($folio);
        $date = date('d/m/Y');
        $invoice = Crypt::encrypt(Crypt::encrypt($folio));
        
        $data['date'] = $date;
        $data['invoice'] = $invoice;
        $data['procedencia'] = 'No especificado';
        $data['tel'] = 'No especificado';
        $data['folio'] = $folio;

        $view = view('pdf.sarr', $data)->render();
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        $data =  [
            'email'     => 'rafael.cetina@hotmail.com' ,
            'subject'   => 'Solicitud de arribo',
            'body'      => 'Confirmación de solicitud de arribo - APIQROO <br> Folio: '.$folio,
            'nombre' => Auth::user()->nombre,
            'pdf' => $pdf
        ];


        Mail::send('pdf.sarr_email', $data, function ($m) use ($data) {
            $m->from('rdzul3@apiqroo.com.mx', 'SOP');
            $m->attachData($data['pdf']->output(), 'Solicitud de arribo.pdf');
            $m->to($data['email'], $data["nombre"])->subject($data['subject']);
        });

        return ['Folio' => $folio];
    }

    /**
     * @param $folio
     * @return mixed
     * devuel
     */
     public function getDatos($folio) {
        $data = Sop_solicitudes_arribo::leftJoin('SOP_BUQUES', 'BUQU_ID', '=', 'SARR_BUQUE_ID')
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

    /**
    * Validación de muelle disponible
    * Parametros $muelle, $eta, $etd
    * devuelve 'ok' si el el muelle esta disponible para la fecha y hora solicitada
    * devuelve un mesaje de error si no se encuentra disponible el muelle
    *
    **/
    public function validacion($muelle, $eta, $etd) {

        $data = Sop_solicitudes_arribo::where([['SARR_MUELLE_ID', '=', $muelle], ['SARR_STATUS', '=', 1],])
        ->select('SOP_SOLICITUDES_ARRIBOS.*')
        ->orderBy('SARR_ETA', 'desc')
        ->get();
        foreach ($data as $solicitud) {
            
            $eta1 = strtotime($solicitud->SARR_ETA); 
            $etd1 = strtotime($solicitud->SARR_ETD);
            $eta2 = strtotime($eta);
            $etd2 = strtotime($etd);

            if($eta1 > $etd2){
                // Válido
            }else{
                //echo "eta1 es menor que etd2, Barco1 llegará antes de que Barco2 se valla... <br>";
                if($etd1 < $eta2){
                    // Válido
                }else{
                    //echo "etd1 es mayor que eta2, Barco1, se ira después de que Barco2 llegue...<br>";
                    $error = "Solicitud no válida, Su embarcación no puede arribar al muelle seleccionado en el horario especificado";
                    return $error; // Solicitud NO válida
                }
                return "ok"; // Solicitud válida
            } // end else
        } // end Foreach
        return "ok";
    } // end function validación
}
