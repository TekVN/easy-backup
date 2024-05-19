<?php

namespace App\Account\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Fluent;
use Laravel\Sanctum\NewAccessToken;

class AccountLogin
{
    /**
     * @param  array{login_id:string,password:string}  $params
     */
    public function loginByEmail(array $params, ?string $guard = null): false|NewAccessToken
    {
        $data = new Fluent($params);

        $logged = Auth::guard($guard)->attempt([
            'email' => $data->get('login_id'),
            'password' => $data->get('password'),
        ]);
        if (! $logged) {
            return false;
        }
        /**
         * @var User $user
         */
        $user = Auth::guard($guard)->user();

        return $user->createToken($data->get('token_name', 'default'));
    }
}
