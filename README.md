# laravel-formrequest-singleton
Use Laravel's excellent FormRequest as Singleton

## Installation

*   run `composer require lextira/laravel-formrequest-singleton`
*   open `config/app.php` in your project
*   replace `Illuminate\Foundation\Providers\FoundationServiceProvider::class`  
    with `Lextira\FormRequestSingleton\FoundationServiceProvider::class`
*   done!

## Usage

All classes, which extend `Illuminate\Foundation\Http\FormRequest` are now instantiated as singleton.

This brings the following benefits:
*   Changes done to the request by `prepareForValidation()` are applied only once,
    even if the FormRequest is used multiple times.
*   The request validation is run only once, therefore especially database queries run only once.