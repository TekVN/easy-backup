<?php

namespace App\Account\Services;

use App\Account\Events\LoginSuccess;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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

        $user = User::query()->where('email', $data->get('login_id'))->first();
        if (empty($user)) {
            return false;
        }
        if (! Hash::check($data->get('password', ''), $user->password)) {
            return false;
        }

        LoginSuccess::dispatch($user);

        return $user->createToken($data->get('token_name', 'default'));
    }
}
