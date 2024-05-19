<?php

namespace App\Account\Events;

use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;

class LoginSuccess
{
    use Dispatchable;

    public function __construct(public readonly User $user)
    {
        //
    }
}
