<?php

namespace App\Http\Middleware;

use Log;
use Closure;
use Exception;

require_once app_path() . '/Helpers/basic.php';


class SessionCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {

            // Getting session data
            $sessionData = session(str_replace(".", "_", $request->ip()) . config('app.name'));

            // Checking if session has valid data
            if (!isEmpty($sessionData) && array_key_exists('adminID', $sessionData) && !isEmpty($sessionData['adminID'])) {
                $request->adminData = $sessionData;
                return redirect()->route('vDashboard');
            } else {
                return $next($request);
            }
        } catch (Exception $e) {
            Log::error($e);
        }
    }
}
