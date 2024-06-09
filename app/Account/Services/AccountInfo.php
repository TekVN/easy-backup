<?php

namespace App\Account\Services;

use App\Models\User;

class AccountInfo
{
    public function profile(mixed $userId): User
    {
        /**
         * @var User
         */
        return User::findOrFail($userId);
    }
}
