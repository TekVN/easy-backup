<?php

namespace App\Tenancy\Models;

use Database\Factories\DomainFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Stancl\Tenancy\Database\Models\Domain as BaseDomain;

class Domain extends BaseDomain
{
    use HasFactory;

    /**
     * Create a new factory instance for the model.
     *
     * @return Factory<Domain>
     */
    protected static function newFactory(): Factory
    {
        return new DomainFactory();
    }
}
