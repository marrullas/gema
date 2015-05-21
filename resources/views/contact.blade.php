<html>
<head>
    <title>GEMA Gestión Misional</title>

    {!!Html::style('/css/assets/css/bootstrap.css')!!}

    <link href='//fonts.googleapis.com/css?family=Lato:100' rel='stylesheet' type='text/css'>

    <style>
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
<body>
<div class="container">
    <div class="content">
        <div class="quote">GEMA</div>
        {{--<div class="quote">{{ 'Gestión Misional Articualción' }}</div>--}}

        <div class="row">
            <a class="btn btn-default" href="{{ url('/home') }}">Inicio</a>
            <a class="btn btn-info" href="{{ url('#') }}">Información</a>
            <a class="btn btn-info" href="{{ url('/contact') }}">Contacto</a>
            <fieldset>
                   <div class="panel panel-primary">
                         <div class="panel-title"><b>Forumulario de contacto</b></div>
                         <div class="panel-body ">
                               {!! Form::open(['route' => 'send', 'method' => 'post']) !!}
                                @include('partials.fieldscontacto')
                               {!! Form::close() !!}
                             </div>
                       </div>
                </fieldset>
                </div>
       </div>
</div>


</body>
</html>