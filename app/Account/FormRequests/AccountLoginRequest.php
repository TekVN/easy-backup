<?php

namespace App\Account\FormRequests;

use Illuminate\Foundation\Http\FormRequest;

class AccountLoginRequest extends FormRequest
{
    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'login_id' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'max:255'],
        ];
    }
}
