<?php

namespace App\Account\Services;

use App\Models\User;
use Illuminate\Support\Arr;

class AccountCreator
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function create(array $data): User
    {
        return User::query()->create(Arr::only($data, [
            'name',
            'email',
            'password',
        ]));
    }
}
