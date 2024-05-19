<?php

namespace App\Tenancy\Utils;

use Illuminate\Support\Str;
use Stancl\Tenancy\Contracts\UniqueIdentifierGenerator;

class UlidGenerator implements UniqueIdentifierGenerator
{
    public static function generate(mixed $resource): string
    {
        return strtolower((string) Str::ulid());
    }
}
