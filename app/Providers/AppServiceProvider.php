<?php namespace App\Providers;

use App\Services\isWeekend;
use App\Services\ValidarHoras;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
        $this->app->validator->resolver(function($translator, $data, $rules, $messages)
        {
            return new ValidarHoras($translator, $data, $rules, $messages);
        });


	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);
	}

    protected function registerValidationRules(Factory $validator)
    {
        $validator->extend('zip', 'Gvt\Support\Validators\GvtRuleValidator@validateZip');
        $validator->extend('state', 'Gvt\Support\Validators\GvtRuleValidator@validateStateCode');
        $validator->extend('phone', 'Gvt\Support\Validators\GvtRuleValidator@validatePhone');
        $validator->extend('county', 'Gvt\Support\Validators\GvtRuleValidator@validateCounty');
        $validator->extend('party', 'Gvt\Support\Validators\GvtRuleValidator@validateParty');
        $validator->extend('ballot_style', 'Gvt\Support\Validators\GvtRuleValidator@validateBallotStyle');
    }

}
