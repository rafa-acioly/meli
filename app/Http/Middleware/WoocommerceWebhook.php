<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Str;

class WoocommerceWebhook
{
    const KEY_SECRET = 'secret';
    const SIGNATURE_HEADER_KEY = 'x-wc-webhook-signature';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->hasHeader(self::SIGNATURE_HEADER_KEY)) {
            abort(Response::HTTP_UNAUTHORIZED, 'missing "x-wc-webhook-signature" header');
        }

        if (!$this->hasValidSignature($request)) {
            abort(Response::HTTP_UNAUTHORIZED, 'webhook-signature does not match');
        }

        return $next($request);
    }

    public function hasValidSignature(Request $request): bool
    {
        return Str::is(
            $this->buildSignature($request),
            $request->header(self::SIGNATURE_HEADER_KEY)
        );
    }

    public function buildSignature(Request $request)
    {
        return base64_encode(
            hash_hmac(
                'sha256',
                $request->getContent(),
                self::KEY_SECRET,
                true
            )
        );
    }
}
