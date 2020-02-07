<?php

namespace Lextira\FormRequestSingleton;

use Illuminate\Foundation\Providers\FoundationServiceProvider as IlluminateFoundationServiceProvider;

class FoundationServiceProvider extends IlluminateFoundationServiceProvider
{
    /**
     * The provider class names.
     *
     * @var array
     */
    protected $providers = [
        FormRequestServiceProvider::class,
    ];
}