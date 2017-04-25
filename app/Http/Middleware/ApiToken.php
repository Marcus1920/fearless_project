<?php
namespace App\Http\Middleware;
use App\User;
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\App;
class ApiToken
{
    protected $auth;
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }
    public function handle($request, Closure $next)
    {

        if($request->input('api_token') && $this->hasMatchingToken($request->input('api_token'))) {

            return $next($request);
        }
        /**
         * This assumes it is behind auth at all times
         * so if the above fails we then let auth manage it
         */
        if ($this->auth->guest()) {
            if ($request->ajax()) {
                return response('Unauthorized.', 401);
            } else {
                return redirect()->guest('auth/login');
            }
        }
        return $next($request);
    }
    /**
     * Laravel 5.2 uses vendor/laravel/framework/src/Illuminate/Auth/TokenGuard.php:66 and then
     * vendor/laravel/framework/src/Illuminate/Auth/EloquentUserProvider.php:87 to get
     * a user based on the password
     *
     * @NOTE
     * We can load the user if we want to manage scopes/roles etc but right now it is
     * just pass fail
     */
    public function hasMatchingToken($token)
    {
        if($user = User::where('api_token', $token)->first())
            return true;
    }
}