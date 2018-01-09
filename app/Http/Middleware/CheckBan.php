<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Models\User;
use DB;
use Carbon\Carbon;

class CheckBan
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
        if (Auth::check()) {
            if (User::CheckBan()) {
                $bandata = DB::table('banneds')->where('user_id', '=', Auth::id())->where('lifted', '=', Null)->where('expires', '>=', Carbon::now())->first();
                return response()->view('banned', ['bandata' => $bandata]);
            }
        }
        return $next($request);
    }
}
