<?php

namespace Database\Seeders\Tenants;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Tenancy\Models\Tenant;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(Tenant $tenant): void
    {
        $tenant->run(function (Tenant $tenant) {

            // Run seeder inside tenant
            $this->call([
                AccountSeeder::class,
            ]);
        });
    }
}
