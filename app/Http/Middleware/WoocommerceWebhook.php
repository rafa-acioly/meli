<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WoocommerceWebhook
{
    const KEY_SECRET = 'secret';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->hasHeader('x-wc-webhook-signature')) {
            return response()->json([
                'error' => 'missing "x-wc-webhook-signature" header'
            ], 401);
        }

        if (!$this->hasValidSignature($request)) {
            return response()->json([
                'error' => 'webhook-signature does not match'
            ], 401);
        }

        return $next($request);
    }

    public function hasValidSignature(Request $request): bool
    {
        $signature = $request->header('x-wc-webhook-signature');
        $payload = $request->all();

        $hmac = base64_encode(hash_hmac('sha256', $payload, self::KEY_SECRET, true));

        return Str::is($hmac, $signature);
    }
}
