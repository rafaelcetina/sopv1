<!DOCTYPE html>
<html lang="es">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Formato de Solicitud de Arribo</title>
    {!! Html::style('assets/css/pdf.css') !!}
  </head>
  <body>
    <main>
      <div class="header">
        <div class="logo2 left">
          <img class="logo" src="{{asset('assets/img/logo_sct.png')}}" alt="">
        </div>
        <div class="logo right">
          <img class="logo" src="{{asset('assets/img/logo_api.png')}}" alt="">
        </div>
        <div class="titulo">ADMINISTRACIÓN PORTUARIA INTEGRAL DE QUINTANA ROO S.A. DE C.V.</div>
        <div class="titulo">FORMATO DE SOLICITUD DE ESPACIO DE ATRAQUE O FONDEO</div>
        <div class="titulo">API-QROO-AF-02</div>
        <div class="titulo sub">Rev.1 Fecha 01/31/2016</div>
        <div class="date">FECHA: <span class="campo">{{ $date }}</span></div>
      </div>
      <div class="datos">
        <div class="label">Nombre de la embarcación: <span class="campo"> {{ str_pad($BUQU_NOMBRE, 65-sizeof($BUQU_NOMBRE), "_", STR_PAD_BOTH) }} </span> </div>
        <div class="label">Bandera: <span class="campo"> {{ str_pad($PAIS_NOMBRE, 30-sizeof($PAIS_NOMBRE), "_", STR_PAD_BOTH) }} </span> Tipo de embarcación: <span class="campo"> {{ str_pad($TIBU_NOMBRE, 32-sizeof($TIBU_NOMBRE), "_", STR_PAD_BOTH) }} </span> </div>
        
        <div class="label">Puerto Solicitado: <span class="campo"> {{ str_pad($PUER_NOMBRE, 30-sizeof($PUER_NOMBRE), "_", STR_PAD_BOTH) }} </span> Muelle Solicitado: <span class="campo"> {{ str_pad($MUEL_NOMBRE, 24-sizeof($MUEL_NOMBRE), "_", STR_PAD_BOTH) }} </span> </div>


        <div class="label">Procedencia: <span class="campo"> {{ str_pad($procedencia, 36-sizeof($procedencia), "_", STR_PAD_BOTH) }} </span> Destino: <span class="campo"> {{ str_pad($SARR_DESTINO, 35-sizeof($SARR_DESTINO), "_", STR_PAD_BOTH) }} </span> </div>
        <div class="label">Fecha y hora de Entrada al puerto: <span class="campo"> {{ str_pad($SARR_ETA, 61-sizeof($SARR_ETA), "_", STR_PAD_BOTH) }} </span> </div>
        <div class="label">Fecha y hora de Atraque al puerto: <span class="campo"> {{ str_pad($SARR_ETB, 61-sizeof($SARR_ETB), "_", STR_PAD_BOTH) }} </span></div>
        <div class="label">Fecha y hora de Salida del puerto: <span class="campo"> {{ str_pad($SARR_ETD, 62-sizeof($SARR_ETD), "_", STR_PAD_BOTH) }} </span></div>
        <div class="label">Tonelaje Bruto: <span class="campo"> {{ str_pad($BUQU_TRB, 30-sizeof($BUQU_TRB), "_", STR_PAD_BOTH) }} </span> Eslora: <span class="campo"> {{ str_pad($BUQU_ESLORA, 41-sizeof($BUQU_ESLORA), "_", STR_PAD_BOTH) }} </span></div>
        <div class="label">
        Calado Proa: <span class="campo"> {{ str_pad($SARR_CALADA_PROA, 15-sizeof($SARR_CALADA_PROA), "_", STR_PAD_BOTH) }} </span>
        Calado Popa: <span class="campo"> {{ str_pad($SARR_CALADA_POPA, 15-sizeof($SARR_CALADA_POPA), "_", STR_PAD_BOTH) }} </span>
        Manga: <span class="campo"> {{ str_pad($BUQU_MANGA, 31-sizeof($BUQU_MANGA), "_", STR_PAD_BOTH) }} </span></div>
      </div>
      <div class="nota">
        <p>Nota: lo anterior en base a lo dispuesto en el artículo 83 del capitulo II del reglamento de la ley de puertos; los armadores, navieros o sus agentes consignatarios deberan dar aviso, con cuando menos 48 horas de anticipación del arribo, a la capitania y a la administración portuaria integral.</p>
      </div>
      <div class="datos">
        <div class="titulo setenta">DATOS GENERALES DEL ARMADOR O PROPIETARIO DE LA EMBARCACIÓN A QUIEN SE FACTURARÁ</div>

        <div class="label">
          NOMBRE DEL REPRESENTANTE LEGAL O DUEÑO DE LA EMBARCACIÓN: 
          <span class="campo"> 
            {{ str_pad($nombre, 30-sizeof($nombre), "_", STR_PAD_BOTH) }}
          </span>
        </div>
        <div class="label">NOMBRE DE LA EMPRESA O NAVIERA: 
            <span class="campo"> 
              {{ str_pad($empresa, 61-sizeof($empresa), "_", STR_PAD_BOTH) }} 
            </span>
          </div>
        <div class="label">CIUDAD: 
          <span class="campo"> 
            {{ str_pad($domicilio, 50-sizeof($domicilio), "_", STR_PAD_BOTH) }} 
          </span> 
          RFC:
          <span class="campo">
            {{ str_pad($rfc, 33-sizeof($rfc), "_", STR_PAD_BOTH) }}
            </span>
          </div>
        <div class="label">TELÉFONO: <span class="campo">
        {{ str_pad($tel, 15-sizeof($tel), "_", STR_PAD_BOTH) }}
        </span>
         CORREO ELECTRÓNICO: 
        <span class="campo">
        {{ str_pad($email, 44-sizeof($email), "_", STR_PAD_BOTH) }}
        </span>
        </div>
        <div class="label">OPERACIONES A REALIZAR EN EL PUERTO: <span class="campo"> {{ str_pad(implode(", ", $SARR_ACTIVIDADES), 55-sizeof(implode(", ", $SARR_ACTIVIDADES)), "_", STR_PAD_BOTH) }}</span></div>
      </div>
      <div class="footer">
        <img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->merge(url('/assets/img/logo_api.png'), .2, true)->size(120)->generate($invoice  )) !!} ">
        <p>CADENA DE VALIDACIÓN: <span class="cadena"> {{ $invoice }} </span></p>
      </div>
    </main>
  </body>
</html>