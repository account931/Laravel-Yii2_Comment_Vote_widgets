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
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
        ],
		
		//my custom middleware that enable Session, used in /routes/api.php in Captcha_Vue_2022 Rest Api Endpoint.
		//As Api routes does not use/see session, (as 'middleware' => 'api' by default does not include '\Illuminate\Session\Middleware\StartSession::class' in /app/Http/Kernel.php), you need to add it manually in /routes/api.php => 'middleware' => 'myCustomSessionsX'
		'myCustomSessionsX' => [
            \Illuminate\Session\Middleware\StartSession::class,
        ],
		
		//my custom middleware that enable CSRF check, used in /routes/api.php in Captcha_Vue_2022 Rest Api Endpoint. //DOES NOT WORK CORRECTLY, requeires csrf but issue a mistake even if csrf is passed in ajax
		'myCustomCSRF' => [
            \App\Http\Middleware\VerifyCsrfToken::class,
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
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
		
		'role' => \Zizaco\Entrust\Middleware\EntrustRole::class,  //my
        'permission' => \Zizaco\Entrust\Middleware\EntrustPermission::class, //my
        'ability' => \Zizaco\Entrust\Middleware\EntrustAbility::class, //my
    ];
}
