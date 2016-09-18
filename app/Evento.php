<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use MaddHatter\LaravelFullcalendar\Event as Event;
use Illuminate\Support\Facades\URL;

//class Evento extends Eloquent implements Event
class Evento extends Model implements Event

{
    protected $table = 'eventos';

    protected $dates = ['start', 'end'];


    protected $fillable = ['title', 'start', 'all_day', 'end', 'user_id', 'ficha_id', 'descripcion','nombre_ficha','horas','actividad'];


    public function setStartAttribute($value)
    {

        $fecha =  \Carbon\carbon::createFromFormat('d/m/Y H:i',$value);
        //dd($fecha);
        //dd(Carbon::parse($value)->format('m/d/Y H:i'));
        //$this->attributes['start'] = new \DateTime($value);
        $this->attributes['start'] = $fecha;
        //$this->attributes['start'] = Carbon::parse($value)->format('m/d/Y H:i');
    }


    /**
     * retorna fecha con parametros correctos
     * @param $value
     */
    public function setEndAttribute($value)
    {
        $fecha =  \Carbon\carbon::createFromFormat('d/m/Y H:i',$value);
        $this->attributes['end'] = $fecha;
        //$this->attributes['end'] = new \DateTime($value);
        //$this->attributes['end'] = Carbon::parse($value)->format('m/d/Y H:i');
    }

    /**
     * id del evento
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the event's title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Is it an all day event?
     *
     * @return bool
     */
    public function isAllDay()
    {
        return (bool)$this->all_day;
    }

    /**
     * Get the start time
     *
     * @return DateTime
     */
    public function getStart()
    {
        //return $this->start;
        return Carbon::parse($this->start)->format('d/m/Y');

    }

    /**
     * Get the end time
     *
     * @return DateTime
     */
    public function getEnd()
    {
        return $this->end;
    }

    public function getNombreFicha()
    {
        $this->ficha->codigo;
    }

    public function getHoraEventosAttribute()
    {
        //$this->ficha->horas;
        //dd($this);
        return $this->horas;

    }
    public function getHorasFichamesAttribute($mes = null)
    {
        if(empty($mes))
            $mes = Carbon::now()->startOfMonth();

        $horas = Evento::selectRaw('sum(horas) as horas')
            ->where('start', '>=', $mes)//acumla solamente lo de este mes
            ->where('ficha_id','=',$this->ficha_id)
            ->where('user_id','=',$this->user_id)
            ->groupBy('ficha_id')
            ->get();



        return $horas->first()->horas;
        //dd($horas->first()->horas);

    }


    /**
     *
     * retorna array con los eventos de un usuario
     * @param null $user usuario activo
     * @param null $userCalendar codigo del usuario a consultar eventos
     * @return array
     */
    public static function getArrayEventos($user = null, $userCalendar = null)
    {
        $userId = $user->id;
        $usertype = $user->type;
        $events = [];
        $tipoadmin = array('admin' => 'administrador', 'lider' => 'lider'); //si es admin o lider puede ver cualquier calendario
        if (isset($tipoadmin[$usertype]) && !empty($userCalendar)) {
            // ojo se debio invertir los datos de title y actividad para poder cargar los eventos en el objeto del calendario
            // solo porque el componente pide el nombre tal cual y el campo title es la llave foranea de tipoactividad.
            $eventos = Evento::where('eventos.user_id', $userCalendar)
                ->join('fichas','eventos.ficha_id','=','fichas.id')
                ->join('ies','ies.id','=','fichas.ie_id')
                ->select(['actividad as title', 'all_day', 'start', 'end', 'eventos.id','title as actividad','descripcion','fichas.codigo','ies.nombre'])
                ->get();
            //dd($eventos->all());
        } else {
            $eventos = Evento::where('eventos.user_id', $userId)
                //->with('ficha')
                //->select(['actividad as title', 'all_day', 'start', 'end', 'id','title as actividad'])
                ->join('fichas','eventos.ficha_id','=','fichas.id')
                ->join('ies','ies.id','=','fichas.ie_id')
                ->select(['actividad as title', 'all_day', 'start', 'end', 'eventos.id','title as actividad','descripcion','fichas.codigo','ies.nombre'])
                ->get();

        }

        if($eventos->count() >= 1) {
            foreach ($eventos as $evento) {
                //dd($evento->all());
                $all_day = true;
                if($evento['all_day']==0)
                    $all_day=false;

                $event = \Calendar::event(
                    $evento['title'], //event title
                    $evento['allday']=$all_day, //full day event?
                    $evento['start'], //start time (you can also use Carbon instead of DateTime)
                    $evento['end'] //end time (you can also use Carbon instead of DateTime)
                    //$evento['id']
                );
                //dd($event);
                //se busca el color del tipo de actividad (revisar para traer directamente el color desde  la relacion)
                $color = Tipoactividad::find($evento->actividad)->color;
                //dd($color);
                //$calendar = \Calendar::addEvent($event, ['color' => $color,'data-toggle'=>'tooltip','data-placement'=>'top','title'=>'Tooltip on top']);
                $tooltip = "<div class='tooltiptext'>
                            <dl>
                            <dt>Ficha :</dt><dd>".$evento['codigo'] . "</dd>
                            <dt>IE :</dt><dd>".$evento['nombre'] . "</dd>
                            <dt>Actividad :</dt><dd>".trim($evento['title']) . "</dd>
                            <dt>Objetivo :</dt><dd>".strip_tags($evento['descripcion']) . "</dd>
                            </dl>
                            </div>";
                $calendar = \Calendar::addEvent($event, ['color' => $color,'description'=>$tooltip,'id'=>$evento['id']]);
                //$calendar = \Calendar::addEvent($event);


            }
        }
        else
            $calendar  =  \Calendar::addEvents($events);
        //return $events;
        return $calendar;
    }

    public static function getCalendar($user=null, $userCalendar = null)
    {
        //dd('prueba');
        //$events = Evento::getArrayEventos($user,$userCalendar);
        $calendar = Evento::getArrayEventos($user,$userCalendar);
        //dd($events);

        //$calendar = \Calendar::addEvents($events);  //add an array with addEvents
        //$calendar->addEvent($pruebaevento,['color'=>'#800']);
        $calendar->setOptions([ //set fullcalendar options
            //'firstDay' => 1,
            'lang' => 'es',
            'selectable'=> true,
            //'weekends'=>false,
            //'hiddenDays'=>[0],
        ])->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
            'viewRender' => 'function() {


                        $(\'[data-toggle="tooltip"]\').tooltip()
                        $("#myModal").on("hidden.bs.modal", function (e) {
                            // do something...
                            //alert("cerro modal");
                                $("#actividad").text(" ");
                                $("#ficha").text(" ");
                                $("#ciudad").text(" ");
                                $("#ie").text(" ");
                                $("#horas").text(" ");
                                $("#hora_ini").text(" ");
                                $("#hora_fin").text(" ");
                        });
                        }


                        ',
            'select' => 'function(start, end, date) {
                        var myCal = $("#calendar-'.\Calendar::getId().'");
                        myCal.fullCalendar("gotoDate",start);
                        $("#datetimepicker1").data("DateTimePicker").date(moment(start).format("DD/MM/YYYY hh:mm P"));
                         $("#datetimepicker2").data("DateTimePicker").date(moment(start).format("DD/MM/YYYY hh:mm P"));
                         $("#calendar").fullCalendar("option", "weekends", false);


                        }',
            'dayClick'=> "function(date, allDay, jsEvent, view) {

                        $(this).parent().siblings().removeClass('week-highlight');
                        $(this).parent().addClass('week-highlight')

                        }",
            'eventClick'=>" function(calEvent,jsEvent,view){

                        var url = '".Url::to('eventos/edit',['id'=>''])."';
                        var idEvento = calEvent.id;
                        var urleditar = url+'/'+calEvent.id;
                        $('#editarEvento').attr('href', urleditar);

                        //window.location.href = url+'/'+calEvent.id;

                        $.ajax({
                                type: 'GET',
                                url: '/eventos/show/'+idEvento,
                                //data: { id: idEvento }
                            }).done(function( msg ) {
                                var id = msg;
                                //console.log(id);
                                //alert( 'the messageis ' +  id.ficha.ie.ciudad.nombre);
                                $('#actividad').text(id.actividad);
                                $('#ficha').text(id.ficha.codigo);
                                /*$('#horas').text(id.horas);*/
                                $('#horas').text('...');
                                $('#ciudad').text(id.ficha.ie.ciudad.nombre);
                                $('#ie').text(id.ficha.ie.nombre);
                                var fDate = new Date(id.start)
                                $('#hora_ini').text(GetTime(fDate));
                                var fDate = new Date(id.end)
                                $('#hora_fin').text(GetTime(fDate));
                                var html = id.descripcion;
                                $('#DetActividad').text($(html).text().substring(0, 50)+'...');
                                $('#myModal').modal('show');

                            });


            }",
            'eventRender'=> "function(event, element) {
        //element.attr('title', event.tooltip);
        element.qtip({
            content: event.description
        });
        }"



        ]);

        //dd($calendar);

        return $calendar;
    }


    public function user()
    {
        return $this->belongsTo('\App\User');
    }

    public function ficha()
    {
        return $this->belongsTo('\App\Ficha');
    }

    public function ie()
    {
        return $this->belongsTo('\App\Ie');
    }

    public function tipoactividad()
    {
        return $this->belongsTo('\App\Tipoactividad','title','id');
    }

    public static function fichasAsignadas($userId=null)
    {
        $fichasasignadas = Evento::with('ficha','ficha.ie','ficha.ie.ciudad','ficha.programa')
            //->join('fichas','fichas.id','=','eventos.ficha_id')
            ->where('eventos.user_id',$userId)
            ->where('eventos.start', '>=', Carbon::now()->startOfMonth())
            //->groupBy('ficha_id')
            ->orderBy('eventos.start','')
            ->get();
        return $fichasasignadas;
    }

    public static function actividadesxmes($userId=null,$fechas = null)
    {

        if(empty($fechas))
        {
            //$mes = Carbon::now();
            $rango["fecha_ini"] = Carbon::now()->startOfMonth();
            $rango["fecha_fin"]=Carbon::now()->endOfMonth();
        }
        else
        {
            $rango = array('fecha_ini'=>Carbon::createFromFormat('d/m/Y', $fechas[0])->toDateTimeString(),'fecha_fin'=>Carbon::createFromFormat('d/m/Y', $fechas[1])->toDateTimeString());
        }

        //dd($rango);

        $actividades = Evento::with('ficha','ficha.ie','ficha.ie.ciudad','ficha.programa')
            ->join('fichas','fichas.id','=','eventos.ficha_id')
            ->select(DB::raw('*,sum(eventos.horas) as horas'))
            ->where('eventos.user_id',$userId)
            ->WhereBetween('eventos.start', [$rango['fecha_ini'],$rango['fecha_fin']])
            ->groupBy('actividad','fichas.codigo')
            ->orderBy('fichas.codigo','actividad')
            ->get();

       // dd($actividades);
        return $actividades;
    }
    public static function actividadesxmestotal($userId=null,$fechas = null)
    {

        if(empty($fechas))
        {
            //$mes = Carbon::now();
            $rango["fecha_ini"] = Carbon::now()->startOfMonth();
            $rango["fecha_fin"]=Carbon::now()->endOfMonth();
        }
        else
        {

            $rango = array('fecha_ini'=>Carbon::createFromFormat('d/m/Y', $fechas[0])->toDateTimeString(),'fecha_fin'=>Carbon::createFromFormat('d/m/Y', $fechas[1])->toDateTimeString());
        }

        //dd($rango);

        $actividades = Evento::with('ficha','ficha.ie','ficha.ie.ciudad','ficha.programa')
            //->join('fichas','fichas.id','=','eventos.ficha_id')
            ->select(DB::raw('*,sum(eventos.horas) as horas'))
            ->where('eventos.user_id',$userId)
            ->WhereBetween('eventos.start', [$rango['fecha_ini'],$rango['fecha_fin']])
            ->groupBy('actividad')
            ->orderBy('actividad')
            ->get();

        // dd($actividades);
        return $actividades;
    }

    public static function HorasAcumuladas($userID, $fechas=null)
    {
        //dd($fechas);

        $rango = array('fecha_ini'=>Carbon::createFromFormat('d/m/Y', $fechas[0])->toDateTimeString(),'fecha_fin'=>Carbon::createFromFormat('d/m/Y', $fechas[1])->toDateTimeString());
        //dd($rango);
        $horas = Evento::selectRaw('sum(horas) as horas')
            //->where('start', '>=', Carbon::now()->startOfMonth())//acumla solamente lo de este mes
            ->where('user_id','=',$userID)
            ->WhereBetween('start',[$rango['fecha_ini'],$rango['fecha_fin']])
            ->groupBy('user_id')
            ->get();
        return $horas;
    }
}