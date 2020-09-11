<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class RefreshToken
{
    public function handle($request, Closure $next, $guard = null)
    {

        $response = $next($request);

        $user = Auth::guard('api')->user();
        if (empty($user)) {
            return $response;
        }
        $currentToken = $user->token();
        if (empty($currentToken)) {
            return $response;
        }
        $expiresAt = $currentToken->expires_at;
        $now = \Carbon\Carbon::now();
        $diff = $expiresAt->diffInHours($now);
        if ($diff > 24) {
            return $response;
        }
        $content = $response->content();
        $contentArray = json_decode($content, true);
        if (!isset($contentArray['refresh_token'])) {
            $accessToken = $user->createToken('API')->accessToken;
            $contentArray['refresh_token'] = $accessToken;
            $content = json_encode($contentArray);
            $response->setContent($content);
        }
        return $response;
    }
}
