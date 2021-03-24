<?php

namespace App\Http\Middleware;

use App\Models\User;
use App\Resources\Woocommerce\Woocommerce;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;

class WoocommerceWebhook
{
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


//        if (!$this->hasValidSignature($request)) {
//            return \response()->json([
//                'error' => 'Webhook-signature does not match'
//            ], Response::HTTP_UNAUTHORIZED);
//        }

        if (!$this->hasValidToken($request)) {
            return \response()->json([
                'error' => 'Unauthenticated.'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }

    public function hasValidToken(Request $request): bool
    {
        $userIDEncrypted = $request->query('usr');
        $userExist = User::find(Crypt::decrypt($userIDEncrypted));

        if (!$userIDEncrypted || !$userExist) {
            return false;
        }

        Auth::loginUsingId(1);
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
                env('WEBHOOK_KEY_SECRET'),
                true
            )
        );
    }
}
