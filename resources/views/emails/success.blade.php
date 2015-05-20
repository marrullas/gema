<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>GEMA</title>
    {!!Html::style('/css/assets/css/bootstrap.css')!!}
    <style type="text/css">

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 90%;
            color: #748289;
            display: table;
            font-weight: 100;
            font-family: 'Lato';
        }

        .container {
            text-align: center;
            display: table-cell;
            vertical-align: middle;
        }

        .content {
            text-align: center;
            display: inline-block;
        }

        .title {
            font-size: 96px;
            margin-bottom: 40px;
        }

        .quote {
            font-size: 24px;
        }

    </style>
</head>
<body itemscope itemtype="http://schema.org/EmailMessage" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6; background: #f6f6f6; margin: 0;">
<div class="container">
    <div class="content">
        <div class="quote">GEMA</div>
        {{--<div class="quote">{{ 'Gestión Misional Articualción' }}</div>--}}

        <div class="row">
            <a class="btn btn-default" href="{{ url('/home') }}">Inicio</a>
            <a class="btn btn-info" href="{{ url('#') }}">Información</a>
            <a class="btn btn-info" href="{{ url('/contact') }}">Contacto</a>

                           <div class="panel panel-primary">
                                 <div class="panel-title"><b>Resultado del envio</b></div>
                                 <div class="panel-body ">
                        <h4>Tu mensaje ha sido enviado, pronto responderemos a tu solicitud.</h4>
                    </div>
                    <div class="panel-footer">
                        <a href="{{ route('contact') }}" class="btn btn-primary btn-xs">Volver</a>
                    </div>
                                     </div>
                               </div>

                    </div>
           </div>
</div>
</body>
</html>

