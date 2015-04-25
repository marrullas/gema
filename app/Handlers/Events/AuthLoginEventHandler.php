<?php namespace App\Handlers\Events;


use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use App\Events;
use App\User;
use Illuminate\Support\Facades\Auth;

class AuthLoginEventHandler {

	/**
	 * Create the event handler.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

/*	/**
	 * Handle the event.
	 *
	 * @param  Events  $event
	 * @return void
	 */
    public function handle(User $user, $remember)
    {

        //Actualizacion de ultima fecha de ingreso
                Auth::user()->last_login = new \DateTime();
                Auth::user()->save();

    }

/*    public function handle(Events $event)
    {
        //

        dd('validando el login');
    }

    */

}
