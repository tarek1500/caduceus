<?php

namespace App\Http\Middleware;

use Closure;

class Authorization
{
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @param  int  $type
	 * @return mixed
	 */
	public function handle($request, Closure $next, int $type)
	{
		if ($request->user()->type === $type)
			return $next($request);

		abort('403');
	}
}