<?php

namespace App\Account\Resources;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /**
         * @var User $resource
         */
        $resource = $this->resource;

        return [
            'id' => $resource->id,
            'name' => $resource->name,
            'email' => $resource->email,
        ];
    }
}
