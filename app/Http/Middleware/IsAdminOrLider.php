<?php namespace App\Http\Middleware;

use Closure;


class IsAdminOrLider {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        if($this->auth->user()->type != 'admin' || $this->auth->user()->type != 'lider')
        {
            $this->auth->user()->logout();

            if ($request->ajax())
            {
                return response('Unauthorized.', 401);
            }
            else
            {
                return redirect()->to('auth/login');
            }
        }

        return $next($request);
	}

}
