<?php

namespace App\Account\FormRequests;

use Illuminate\Foundation\Http\FormRequest;

class AccountCreateRequest extends FormRequest
{
    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email:strict', 'max:255', 'unique:App\Models\User,email'],
            'password' => ['required', 'string', 'min:3', 'max:255'],
        ];
    }
}
