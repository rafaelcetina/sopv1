<?php

namespace App\Http\Controllers;

use Mail;
use Crypt;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\sop_Tipo_buque;
use App\sop_Buque;
use App\sop_Tipo_trafico;
use App\sop_Puerto;
use App\sop_Muelle;
use App\sop_Tcarga;
use App\sop_Tproducto;
use App\sop_Solicitudes_arribo;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Storage;

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

    public function getTproductos(Request $request, $id){
        if ($request->ajax()) {
            $tproductos = sop_Tproducto::tproductos($id);
            return response()->json($tproductos);
        }
    }

    public function getUnidad(Request $request, $id){
        if ($request->ajax()) {
            $tproducto = sop_Tproducto::tproducto_uni($id);
            return response()->json($tproducto);
        }
    }


    public function getNuevo(Request $request){
        
        // if (!$request->session()->has('solicitud_id_tmp')) {
        //     Auth::user()->id;
        //     $solicitud_id_tmp = random_int(111, 999).Auth::user()->id;
        //     // Store a piece of data in the session...
        //     session(['solicitud_id_tmp' => $solicitud_id_tmp]);
        // }

        $solicitud_id_tmp = $request->session()->get('solicitud_id_tmp');
        
        $puertos = sop_Puerto::lists('PUER_NOMBRE','PUER_ID');
        $puertos->prepend(' -- Seleccione una Opción -- ', '');

        $types = sop_Tipo_buque::leftJoin('SOP_TBUQUES_USUARIOS', 'TBUS_TIBU_ID', '=', 'TIBU_ID')
        ->where('TBUS_USUA_ID', '=', Auth::user()->id)
        ->lists('TIBU_NOMBRE','TIBU_ID');
        $types->prepend(' -- Seleccione una Opción -- ', '');

        $tcargas = sop_Tcarga::lists('TCAR_NOMBRE','TCAR_ID');
        $tcargas->prepend(' -- Seleccione una Opción -- ', '');
        
        $data = [
            'opcion' => 'null',
            'types' => $types,
            'trafico' => sop_Tipo_trafico::lists('TTRA_NOMBRE', 'TTRA_CLAVE'),
            'puertos' => $puertos,
            'tcargas' => $tcargas,
                ];


        if(\Request::ajax()) {
            $data['ajax'] = 1;
           return view('arribos/content_nuevo', $data);
        } else {
            return view('arribos/nuevo', $data);
        }    
    }


    public function getSolicitudes(){
        $data = ['user_id' => Auth::user()->id, 'table'=>'solicitudes'];
        if(\Request::ajax()) {
            $data = ['user_id' => Auth::user()->id, 'table'=>'solicitudes', 'ajax'=>1];
           return view('arribos/content_solicitudes', $data);
        } else {
            return view('arribos/solicitudes',$data);
        }   
    }

    public function anyData(){
        $solicitudes = sop_Solicitudes_arribo::leftJoin('SOP_BUQUES', 'SOP_BUQUES.BUQU_ID', '=', 'SOP_SOLICITUDES_ARRIBOS.SARR_BUQUE_ID')
            ->leftJoin('SOP_PUERTOS', 'SOP_SOLICITUDES_ARRIBOS.SARR_PUERTO_ID', '=', 'SOP_PUERTOS.PUER_ID')
            ->leftJoin('SOP_MUELLES', 'SOP_SOLICITUDES_ARRIBOS.SARR_MUELLE_ID', '=', 'SOP_MUELLES.MUEL_ID')
            ->where('SARR_USER_ID', '=', Auth::user()->id)
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

    public function postNuevo(){
        $messages = [
            'SARR_MUELLE_ID.unique'  => 'EL MUELLE ESTA OCUPADO',
            
        ];

        $validator = Validator::make(Input::all(), [
            "SARR_FOLIO"  => "unique:SOP_SOLICITUDES_ARRIBOS",
            "SARR_BUQUE_ID"  => "required",
            "SARR_MUELLE_ID"  => "required|unique:SOP_SOLICITUDES_ARRIBOS",

        ], $messages);
        if ($validator->fails()) {
            return array(
                'fail' => true,
                'errors' => $validator->getMessageBag()->toArray()
            );
        }
        
        $Sarr = new sop_Solicitudes_arribo();
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

        // Generar Folio
        // API-QROO-BUQUE-ETA
        $fecha = Input::get('SARR_ETA');
        $chars = array("/", " ", ":");
        $folio = 'API-QROO-'.Input::get('SARR_BUQUE_ID').'-'.str_replace($chars,"",$fecha);
        
        $Sarr->SARR_FOLIO = $folio;


        
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
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        $data =  [
            'email'      => 'rafael.cetina@hotmail.com' ,
            'subject'   => 'Solicitud de arribo',
            'body'   => 'Confirmación de solicitud de arribo - APIQROO <br> Folio: '.$folio,
            'nombre' => Auth::user()->nombre,
            'pdf' => $pdf
        ];


        Mail::send('pdf.sarr_email', $data, function ($m) use ($data) {
            $m->from('rrdc123@gmail.com', 'SOP');
            $m->attachData($data['pdf']->output(), 'Solicitud de arribo.pdf');
            $m->to($data['email'], $data["nombre"])->subject($data['subject']);
        });

        return ['Folio' => $folio];
    }


    public function getPDF($folio){
        $data = $this->getDatos($folio);
        $date = date('d/m/Y');
        $invoice = "API-".md5(date('d/m/Y')).sha1($folio);
        
        $data['date'] = $date;
        $data['invoice'] = $invoice;
        $data['procedencia'] = 'No especificado';
        $data['tel'] = 'No especificado';
        $data['folio'] = $folio;

        $view = view('pdf.sarr', $data)->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        
        $pdf->save('../storage/pdf/sarr-'.$folio.'.pdf');
        
    }

     public function getDatos($folio) {
        $data = sop_Solicitudes_arribo::leftJoin('SOP_BUQUES', 'BUQU_ID', '=', 'SARR_BUQUE_ID')            
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
}
