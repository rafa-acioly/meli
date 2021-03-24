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

        if (!$this->canLoginUser($request)) {
            return \response()->json([
                'error' => 'Unauthenticated.'
            ], Response::HTTP_UNAUTHORIZED);
        }

        return $next($request);
    }

    public function canLoginUser(Request $request): bool
    {
        $userIDEncrypted = $request->query('user_id');
        $user = User::find(Crypt::decrypt($userIDEncrypted));

        if (!$userIDEncrypted || !$user) {
            return false;
        }

        Auth::login($user);
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
