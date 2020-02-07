<?php

namespace Lextira\FormRequestSingleton;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\ServiceProvider;

class FormRequestServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->resolving(FormRequest::class, function ($request, Application $app) {

            // if the request is already bound, we don't need to do anything.
            if ($app->bound(get_class($request))) {
                return;
            }

            // but if not, we resolve a new FromRequest and register it as singleton.
            $this->resolveFormRequestAndRegisterAsSingleton($request, $app);
        });
    }

    /**
     * Resolve a new FormRequest instance and bind it as singleton.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Illuminate\Contracts\Foundation\Application $app
     * @throws
     */
    protected function resolveFormRequestAndRegisterAsSingleton(Request $request, Application $app)
    {
        $request = FormRequest::createFrom($app['request'], $request);

        $request->setContainer($app)->setRedirector($app->make(Redirector::class));

        if ($request instanceof ValidatesWhenResolved) {
            $request->validateResolved();
        }

        $app->singleton(get_class($request), function(Application $app) use ($request) {
            return $request;
        });
    }
}