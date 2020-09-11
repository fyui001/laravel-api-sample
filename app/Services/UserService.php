<?php

declare(strict_types=1);

namespace App\Services;

use App\Exceptions\ApiErrorException;
use App\Services\Service as AppService;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Laravel\Passport\Token;

class UserService extends AppService implements UserServiceInterface
{

    public function getUser(): array
    {

        $user = Auth::guard('api')->user();

        if (empty($user)) {
            return [];
        }
        return [
            'id' => $user->id,
            'user_id' => $user->user_id,
            'name' => $user->name,
        ];
    }

    public function login(Request $request): array
    {

        $credentials = $request->only('user_id', 'password');
        $credentials['del_flg'] = 0;

        if (!Auth::attempt($credentials)) {
            return [];
        }
        $user = User::where([
          ['user_id', $credentials['user_id']],
          ['del_flg', 0],
        ])->first();

        $accessToken = $user->createToken('API')->accessToken;

        return [
            'id' => $user->id,
            'user_id' => $user->user_id,
            'name' => $user->name,
            'access_token' => $accessToken,
        ];
    }

    public function logout(): bool
    {

        $user = Auth::user();
        if (empty($user)) {
            return false;
        }
        $userId = $user->id;
        Token::where('user_id', $userId)->delete();
        return true;
    }
}
