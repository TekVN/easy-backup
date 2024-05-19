<?php

namespace App\Account\FormRequests;

use Illuminate\Foundation\Http\FormRequest;

class AccountLogoutRequest extends FormRequest
{
    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'all_device' => ['nullable', 'boolean'],
        ];
    }
}
