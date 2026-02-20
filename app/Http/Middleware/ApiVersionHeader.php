<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class ApiVersionHeader
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $response->headers->set('x-api-version', 'v1');
        return $response;
    }
}
