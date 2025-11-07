<?php

namespace App\Http\Middleware;

use App\Helpers\EncryptionHelper;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Symfony\Component\HttpFoundation\Response;

class DecodeRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $request->whenHas('f', function ($parameter) use ($request) {
            $request->offsetUnset('f');
            if (! empty($inputs = EncryptionHelper::decrypt($parameter))) {
                Arr::map($inputs, function ($value, $key) use ($request) {
                    $request->merge([$key => $value]);
                });
            }
        });


        return $next($request);
    }
}
