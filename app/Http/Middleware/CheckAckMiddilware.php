<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
use App\Models\Acknowladge\WeeklyCovid;

class CheckAckMiddilware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        $userData = session("userDetails");
        $dayOfWeek = Carbon::now()->dayOfWeek;
        $currentMondayDate = ($dayOfWeek == Carbon::SUNDAY)
            ? Carbon::now()->subWeek()->startOfWeek()
            : Carbon::now()->startOfWeek();
        $employeeID = $userData[0]['EmployeeID'];
        $covidForms = WeeklyCovid::select('createdOn')
            ->where('EmployeeID', $employeeID)
            ->whereDate('createdOn', '>=', $currentMondayDate)
            ->whereDate('createdOn', '<=', Carbon::now())
            ->get();

        if ($covidForms->count() < 1) {
            return redirect()->route('covidAck');
        } else {
            return $next($request);
        }
    }
}
