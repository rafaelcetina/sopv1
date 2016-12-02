<?php

namespace App\Http\Controllers;
use Mail;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\sop_Solicitudes_arribo;

class PdfController extends Controller
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
    public function getIndex($folio){
        $data = $this->getData($folio);
        $date = date('d/m/Y');
        $invoice = "API-".md5(date('d/m/Y')).sha1($folio);
        
        $data['date'] = $date;
        $data['invoice'] = $invoice;
        $data['procedencia'] = 'No especificado';
        $data['tel'] = 'No especificado';
        $data['folio'] = $folio;

        // $view =  \View::make('pdf.sarr', compact('data', 'date', 'invoice'))->render();
        //var_dump($data);
        $view = view('pdf.sarr', $data)->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);

        
        //$pdf->save('../storage/pdf/sarr-'.$folio.'.pdf');
        return $pdf->stream('invoice');
        //return $pdf->download('invoice');
    }

     public function getData($folio) {
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


    public function getSend(){
        $data =  [
            'email'      => 'rafael.cetina@hotmail.com' ,
            'subject'   => 'Solicitud de arribo',
            'body'   => 'Confirmación de solicitud de arribo - APIQROO',
            'nombre' => 'Rodolfo'
        ];
        Mail::send('pdf.sarr_email', $data, function ($m) use ($data) {
            $m->from('rdzul@apiqroo.com.mx', 'SOP');

            $m->to($data['email'], $data["nombre"])->subject('Your Reminder!');
        });
    
        return view('pdf.success',$data);
    }


    public function getSend2(){
        $data =  [
            'email'      => 'rafael.cetina@hotmail.com' ,
            'subject'   => 'Solicitud de arribo',
            'body'   => 'Confirmación de solicitud de arribo - APIQROO',
            'nombre' => 'Rodolfo'
        ];
    
        return view('pdf.sarr_email',$data);
    }
}
