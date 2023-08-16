<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
        // $this->configureRateLimiting();

        // $this->routes(function () {
        //     Route::prefix('api')
        //         ->middleware('api')
        //         ->group(base_path('routes/api.php'));

        //     Route::middleware('web')
        //         ->group(base_path('routes/web.php'));
        // });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    
        RateLimiter::for('admin.admin_login', function (Request $request) {
            $key = 'admin_login.'.$request->ip();
            $max = 2; 
            $decay = 60;
            if(RateLimiter::toManyAttempts($key,$max)){
                return back()->with('message','Too Many Attempts.');
            }else{
                RateLimiter::hit($key, $decay);
            }
        });
        // RateLimiter::for('student', function (Request $request) {
        //     return Limit::perMinute(2)->response(Function(){
        //         return response("message','Too Many Attempts in student login.");
        //     });
        // });
        RateLimiter::for('login', function (Request $request) {
            $key = "login.".$request->ip();
            $max = 2; 
            $decay = 60;
            
            $retries = RateLimiter::retriesLeft($key, 2);
            if(RateLimiter::tooManyAttempts($key,$max)){
                $seconds = RateLimiter::availableIn($key);
                return back()->with('fail','Too Many Requests Please try again in '.$seconds.' Seconds');
            }else{
                RateLimiter::hit($key, $decay);
                // return'Wrong Credentials, You Have '.$retries.' Attempt Left';

            }
        });
    }
}
