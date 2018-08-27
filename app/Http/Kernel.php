<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\VerifyUserRoleValidity::class,
        ],
        
        'direction' => [
            \App\Http\Middleware\VerifyIfDirecteurUser::class,
            \App\Http\Middleware\VerifyIfFondateurUser::class,
        ],

        'admin' => [

        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth'                  =>  \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.role'             =>  \App\Http\Middleware\CheckRole::class,
        'auth.basic'            =>  \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.admin'            =>  \App\Http\Middleware\VerifyIfAdministratorUser::class,
        'auth.censeur'          =>  \App\Http\Middleware\VerifyIfCenseurUser::class,
        'auth.directeur'        =>  \App\Http\Middleware\VerifyIfDirecteurUser::class,
        'auth.fondateur'        =>  \App\Http\Middleware\VerifyIfFondateurUser::class,
        'auth.comptable'        =>  \App\Http\Middleware\VerifyIfComptableUser::class,

        'auth.secretaire'       =>  \App\Http\Middleware\VerifyIfSecretaireUser::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
    ];
}
