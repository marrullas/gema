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


    protected $fillable = ['title', 'start', 'all_day', 'end', 'user_id', 'ficha_id', 'descripcion'];


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
                ->select(['title', 'all_day', 'start', 'end', 'id'])
                ->get();
        } else {
            $eventos = Evento::where('user_id', $userId)
                ->select(['title', 'all_day', 'start', 'end', 'id'])
                ->get();

        }

        foreach ($eventos as $evento) {
            $events[] = \Calendar::event(
                $evento['title'], //event title
                $evento['all_day'], //full day event?
                $evento['start'], //start time (you can also use Carbon instead of DateTime)
                $evento['end'], //end time (you can also use Carbon instead of DateTime)
                $evento['id']
            );


        }
        return $events;
    }

    public static function getCalendar($user=null, $userCalendar = null)
    {

        $events = Evento::getArrayEventos($user,$userCalendar);



        $calendar = \Calendar::addEvents($events)  //add an array with addEvents
        ->setOptions([ //set fullcalendar options
            //'firstDay' => 1,
            'lang' => 'es',
            'selectable'=> 'true',
        ])->setCallbacks([ //set fullcalendar callback options (will not be JSON encoded)
            'viewRender' => 'function() { console.log("Callbacks!");}',
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

                        window.location.href = url+'/'+calEvent.id;

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
        return $this->belongsTo('\app\Ficha');
    }



}