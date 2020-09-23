<?php

namespace App\Http\Middleware;

use App\Resources\Woocommerce;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class WoocommerceWebhook
{

    protected const KEY_SECRET = 'secret';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->hasHeader(Woocommerce::SIGNATURE_HEADER_KEY)) {
            return \response()->json([
                'error' => 'Missing "x-wc-webhook-signature" header'
            ], Response::HTTP_UNAUTHORIZED);
        }

        if (!$this->hasValidSignature($request)) {
            return \response()->json([
                'error' => 'Webhook-signature does not match'
            ], Response::HTTP_UNAUTHORIZED);
        }

        if (!$this->hasValidToken($request)) {
            return \response()->json([
                'error' => 'Unauthenticated.'
            ], Response::HTTP_UNAUTHORIZED);
        }

        /**
         * Adds the authorization key on the request to the next middleware (sanctum)
         * be able authenticate the user properly.
         *
         * Woocommerce does not allow users to add custom headers on the webhook request,
         * the only solution to authenticate a user were add the token on the query string,
         * retrieve it and add to the header our self, this way the next middleware
         * can handle the authentication without trouble.
         */
        $request->headers->set('Authorization', 'Bearer ' . $request->query('token'));

        return $next($request);
    }

    public function hasValidToken(Request $request): bool
    {
        $userToken = $request->query('token');
        $tokenExists = PersonalAccessToken::findToken($userToken);

        if (!$userToken || !$tokenExists->exists) {
            return false;
        }

        return true;
    }

    public function hasValidSignature(Request $request): bool
    {
        return Str::is(
            $this->buildSignature($request),
            $request->header(Woocommerce::SIGNATURE_HEADER_KEY)
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
