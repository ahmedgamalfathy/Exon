<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Return422ResponseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // إذا كانت الحالة 422، يمكن تعديل الاستجابة هنا
        if ($response->getStatusCode() == 422) {
            return response()->json([
                "status" => 422,
                "errors" => $response->original['errors'], // أخطاء التحقق المالية
            ], 422);
        }

        return $response;  
    }
}
