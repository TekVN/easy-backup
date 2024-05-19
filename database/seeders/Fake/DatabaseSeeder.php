<?php

namespace Database\Seeders\Fake;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Tenancy\Models\Domain;
use App\Tenancy\Models\Tenant;
use Database\Seeders\Tenants\DatabaseSeeder as DatabaseTenantSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $domain = Domain::factory()->for(Tenant::factory())->create([
            'domain' => 'demo.'.config('app.domain', 'easy-backup.test'),
        ]);

        $this->call([
            AccountSeeder::class,
        ]);

        $this->call(class: DatabaseTenantSeeder::class, parameters: ['tenant' => $domain->tenant]);
    }
}
