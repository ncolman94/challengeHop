<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        'api/starships/*/inventory',
        'api/starships/*/inventory/increment',
        'api/starships/*/inventory/decrement',
        'api/vehicles/*/inventory',
        'api/vehicles/*/inventory/increment',
        'api/vehicles/*/inventory/decrement',
    ];
}