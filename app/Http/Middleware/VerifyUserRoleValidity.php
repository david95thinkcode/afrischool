<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\UserRole;

class VerifyUserRoleValidity
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
            // Set is_active property of an instance of UserModel if
            // today's date is greater than its desactivation_date attribute
            // and still actived
            
            if(Auth::check()) {
                $userRoles = UserRole::where([['user_id', Auth::user()->id]])->get();
                foreach ($userRoles as $key => $value) {
                    if ((Carbon::parse($value->desactivation_date)->lt(Carbon::today())) && ($value->is_active == true))
                    {
                        $desactivation = UserRole::where([
                            ['user_id', Auth::user()->id],
                            ['role_id', $value->role_id]
                        ])->update(['is_active' => false]);
                    }
                } 
            }
        }
        catch (\Exception $e) {
            // TODO: Store the exception inside DB
            // dd($e->getMessage());
        }
        finally {
            return $next($request);
        }

    }
}
