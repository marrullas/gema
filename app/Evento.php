<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Model;
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
        $this->attributes['start'] = new \DateTime($value);
    }

    /*public function setAllDayAttribute($value)
    {
        if(!empty($value))
            dd($value);
        else
            dd('sin dato');
    }*/

    /**
     * retorna fecha con parametros correctos
     * @param $value
     */
    public function setEndAttribute($value)
    {
        $this->attributes['end'] = new \DateTime($value);
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
        return $this->start;
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

    public function getHoras()
    {
        $this->ficha->horas;
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

            $eventos = Evento::where('user_id', $userCalendar)
                //->with('tipoactividad')
                ->select(['actividad as title', 'all_day', 'start', 'end', 'id'])
                ->get();
            //dd($eventos->first()->tipoactividad()->first()->nombre);
        } else {
            $eventos = Evento::where('user_id', $userId)
                ->select(['actividad as title', 'all_day', 'start', 'end', 'id'])
                ->get();

        }

        //$calendar  =  new \Calendar();

/*        foreach ($eventos as $evento) {
            $events[] = \Calendar::event(
                $evento['title'], //event title
                $evento['all_day'], //full day event?
                $evento['start'], //start time (you can also use Carbon instead of DateTime)
                $evento['end'], //end time (you can also use Carbon instead of DateTime)
                $evento['id']
            );*/
                foreach ($eventos as $evento) {
                    //dd($evento->all());
                    $event = \Calendar::event(
                        $evento['title'], //event title
                        $evento['all_day'], //full day event?
                        $evento['start'], //start time (you can also use Carbon instead of DateTime)
                        $evento['end'], //end time (you can also use Carbon instead of DateTime)
                        $evento['id']
                    );

            if($evento['id']== 4)
                $calendar = \Calendar::addEvent($event,['color'=>'#800']);
            else
            $calendar = \Calendar::addEvent($event);


        }
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
            'selectable'=> 'true',
        ])->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
            'viewRender' => 'function() { console.log("Callbacks!");
                        $("#myModal").on("hidden.bs.modal", function (e) {
                            // do something...
                            //alert("cerro modal");
                                $("#actividad").text(" ");
                                $("#ficha").text(" ");
                                $("#ciudad").text(" ");
                                $("#ie").text(" ");
                                $("#horas").text(" ");


                        });
                        }',
            'select' => 'function(start, end, date) {
                        var myCal = $("#calendar-'.\Calendar::getId().'");
                        myCal.fullCalendar("gotoDate",start);
                        $("#datetimepicker1").data("DateTimePicker").date(moment(start).format("MM/DD/YYYY hh:mm A"));
                         $("#datetimepicker2").data("DateTimePicker").date(moment(end).format("MM/DD/YYYY hh:mm A"));
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
                                //alert( 'the messageis ' +  id.tipoactividad.nombre);
                                $('#actividad').text(id.actividad);
                                $('#ficha').text(id.ficha.codigo);
                                $('#horas').text(id.horas);
                                $('#ciudad').text(id.ficha.ie.ciudad);
                                $('#ie').text(id.ficha.ie.nombre);


                                $('#myModal').modal('show');

                            });


            }"



        ]);

        //dd($calendar);

        return $calendar;
    }
    public static function getCalendar2($user=null, $userCalendar = null)
    {

        $events = Evento::getArrayEventos($user,$userCalendar);



        $calendar = \Calendar::addEvents($events)  //add an array with addEvents
        ->setOptions([ //set fullcalendar options
            //'firstDay' => 1,
            'lang' => 'es',
            'selectable'=> 'true',
        ])->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
            'viewRender' => 'function() { console.log("Callbacks!");
                        $("#myModal").on("hidden.bs.modal", function (e) {
                            // do something...
                            //alert("cerro modal");
                                $("#actividad").text("");
                                $("#ficha").text("");
                                $("#ciudad").text("");
                                $("#ie").text("");
                                $("#horas").text("");


                        });
                        }',
            'select' => 'function(start, end, date) {
                        var myCal = $("#calendar-'.\Calendar::getId().'");
                        myCal.fullCalendar("gotoDate",start);
                        $("#datetimepicker1").data("DateTimePicker").date(moment(start).format("MM/DD/YYYY hh:mm A"));
                         $("#datetimepicker2").data("DateTimePicker").date(moment(end).format("MM/DD/YYYY hh:mm A"));
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
                                alert( 'the messageis ' +  id.tipoactividad.nombre);
                                $('#actividad').text(id.tipoactividad.nombre);
                                $('#ficha').text(id.ficha.codigo);
                                $('#horas').text(id.horas);
                                $('#ciudad').text(id.ficha.ie.ciudad);
                                $('#ie').text(id.ficha.ie.nombre);


                                $('#myModal').modal('show');

                            });


            }"



        ]);

        //dd($calendar);

        return $calendar;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
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
        return $this->belongsTo('App\TipoActividad','title','id');
    }

}