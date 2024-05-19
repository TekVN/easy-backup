<?php

namespace Database\Seeders\Fake;

use App\Models\User;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->createAdminMasterAccount();
    }

    /**
     * Tạo tài khoản admin master
     * Tài khoản chịu trách nhiệm quản lý tất cả các tenant
     */
    private function createAdminMasterAccount(): void
    {
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@easy-backup.io',
            'password' => '12345678',
        ]);
    }
}
