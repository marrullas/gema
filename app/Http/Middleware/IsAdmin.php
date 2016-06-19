<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Session;

class IsAdmin {
    /**
     * @var Guard
     */
    private $auth;

    function __construct(Guard $auth)
    {
        // TODO: Implement __construct() method.
        $this->auth = $auth;
    }


    /**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{

        if(!($this->auth->user()->isAdmin() || $this->auth->user()->isAuditor()))
        {
            $this->auth->logout();
            if ($request->ajax())
            {
                return response('Unauthorized.', 401);
            }
            else
            {
                Session::flash('message','Por favor ingrese con un usuario valido para la acción');
                return redirect()->to('auth/login');
            }
        }

		return $next($request);
	}

}
