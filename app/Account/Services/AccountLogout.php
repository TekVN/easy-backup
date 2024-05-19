<?php

namespace App\Account\Services;

use App\Models\PersonalAccessToken;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AccountLogout
{
    /**
     * Đăng xuất khỏi các thiết bị
     */
    public function logoutAllDevice(User|string $user): void
    {
        $user = $this->resolveUser($user);
        $user->tokens()->delete();
    }

    public function logoutCurrentDevice(User|string $user): void
    {
        $this->logoutCurrentSession($user);
        Auth::logoutCurrentDevice();
    }

    public function logoutCurrentSession(User|string $user): void
    {
        $user = $this->resolveUser($user);
        /**
         * @var PersonalAccessToken|null $token
         */
        $token = $user->currentAccessToken();
        $token?->delete();
    }

    private function resolveUser(User|string $user): User
    {
        if ($user instanceof User) {
            return $user;
        }

        return User::findOrFail($user);
    }
}
