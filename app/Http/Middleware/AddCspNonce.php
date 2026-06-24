<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Vite;

class AddCspNonce
{
    public function handle(Request $request, Closure $next)
    {
        $nonce = Vite::useCspNonce();

        $response = $next($request);

        $response->headers->set(
            'Content-Security-Policy',
            "default-src 'self'; " .
            "script-src 'self' 'nonce-{$nonce}'; " .
            "style-src 'self' 'unsafe-inline'; " .   // inline style จำเป็นสำหรับ TipTap
            "font-src 'self'; " .
            "img-src 'self' data: blob:; " .
            "connect-src 'self'; " .
            "frame-src 'self'; " .                    // สำหรับ PDF เปิดใน iframe (ถ้ามี)
            "frame-ancestors 'none'; " .
            "base-uri 'self'; " .
            "form-action 'self';"
        );

        return $response;
    }
}