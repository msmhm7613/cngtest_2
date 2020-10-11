<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class ShowVersion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        date_default_timezone_set('Asia/Tehran');
        $gitBasePath = base_path('.git'); // e.g in laravel: base_path().'/.git';

        $gitStr = file_get_contents($gitBasePath . '/HEAD');
        $gitBranchName = rtrim(preg_replace("/(.*?\/){2}/", '', $gitStr));
        $gitPathBranch = $gitBasePath . '/refs/heads/' . $gitBranchName;
        $gitHash = file_get_contents($gitPathBranch);
        $gitDate = date(DATE_ATOM, filemtime($gitPathBranch));
        $gitDate = strtotime($gitDate);
        $gitDate = Jalalian::forge($gitDate)->format('%A, %d %B %y - %H:%I:%S');

        view()->share('Version',[$gitBranchName,$gitDate,Jalalian::now()]);
        return $next($request);
    }
}
