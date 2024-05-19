<?php

namespace Database\Seeders\Tenants;

use App\Models\User;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createAdminAccount();
    }

    /**
     * Tạo tài khoản admin
     * Tài khoản chịu trách nhiệm quản lý của tenant
     */
    private function createAdminAccount(): void
    {
        User::factory()->create([
            'name' => 'Admin Tenant',
            'email' => 'admin@easy-backup.io',
            'password' => '12345678',
        ]);
    }
}
