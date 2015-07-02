<?php namespace App\Console;

use App\Mensaje;
use App\User;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;


class Kernel extends ConsoleKernel {

	/**
	 * The Artisan commands provided by your application.
	 *
	 * @var array
	 */
	protected $commands = [
		'App\Console\Commands\Inspire',
	];

	/**
	 * Define the application's command schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
	 * @return void
	 */
	protected function schedule(Schedule $schedule)
	{
		$schedule->command('inspire')
				 ->hourly();
        //$schedule->call('MailController@SendMessage')->everyMinute();
        //enviar notificación de mensajes


        $schedule->call(function(){
            $mensajes = Mensaje::where('sendmail','=','false')->get();
            foreach($mensajes as $mensaje) {
                $receptor = User::findOrFail($mensaje->user_id);
                $user = User::findOrFail($mensaje->destinatario);
                $link = "<br>";
                $link .="<div class=".'alert alert-success'." role=".'alert'.">";
                $link .= "<a href='".route('message.show',$mensaje)."'>";
                $link .= " Ir al mensaje </a>";
                $link .= "</div>";
                //dd($link);
                //se envia el array y la vista lo recibe en llaves individuales {{ $email }} , {{ $subject }}...
                \Mail::send('emails.message',
                    [
                        'user' => $user,
                        'email' => $user->email2,
                        'subject' => 'Notificación de mensaje',
                        'body' => $mensaje->contenido,
                        'receptor' => $receptor,
                        'link' => $link
                    ],
                    function ($message) use ($user,$receptor,$mensaje) {
                    //remitente
                    $message->from($user->email2, $user->full_name);

                    //asunto
                    /*            if(!Auth::check())
                                    $message->subject($request->subject);
                                else*/
                    $message->subject($mensaje->titulo); //marco el mensaje como feedback


                    //receptor
                    $email = $receptor->email2;
                    $contacto = $receptor->full_name;

                    //$message->to(env('CONTACT_MAIL'), env('CONTACT_NAME'));
                    $message->to($email, $contacto);

                });
                $mensaje->sendmail = true;
                $mensaje->save();
            }

        })->everyMinute();

	}

}
