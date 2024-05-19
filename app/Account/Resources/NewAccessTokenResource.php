<?php

namespace App\Account\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Laravel\Sanctum\NewAccessToken;

class NewAccessTokenResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /**
         * @var NewAccessToken $resource
         */
        $resource = $this->resource;

        return [
            'token' => $resource->plainTextToken,
            'access_token' => $resource->accessToken->only([
                'name',
                'abilities',
                'expires_at',
            ]),
        ];
    }
}
