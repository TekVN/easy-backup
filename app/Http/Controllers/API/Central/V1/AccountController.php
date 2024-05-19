<?php

namespace App\Http\Controllers\API\Central\V1;

use App\Account\FormRequests\AccountCreateRequest;
use App\Account\FormRequests\AccountLoginRequest;
use App\Account\FormRequests\AccountLogoutRequest;
use App\Account\Resources\NewAccessTokenResource;
use App\Account\Services\AccountCreator;
use App\Account\Services\AccountLogin;
use App\Account\Services\AccountLogout;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class AccountController extends Controller
{
    /**
     * Tạo tài khoản mới
     */
    public function create(AccountCreateRequest $request, AccountCreator $accountCreator): JsonResponse
    {
        $accountCreator->create($request->validated());

        return response()->json(status: Response::HTTP_CREATED);
    }

    /**
     * Đăng nhập tài khoản
     */
    public function login(AccountLoginRequest $request, AccountLogin $accountLogin): Responsable
    {
        // @phpstan-ignore argument.type
        $newAccessToken = $accountLogin->loginByEmail($request->validated());

        if (! $newAccessToken) {
            throw ValidationException::withMessages([
                'login_id' => __('auth.failed'),
            ]);
        }

        return NewAccessTokenResource::make($newAccessToken);
    }

    /**
     * Đăng xuất tài khoản
     */
    public function logout(AccountLogoutRequest $request, AccountLogout $accountLogout): JsonResponse
    {
        /**
         * @var User $user
         */
        $user = $request->user();
        if ($request->boolean('all_device')) {
            $accountLogout->logoutAllDevice($user);
        } elseif ($request->boolean('current_device')) {
            $accountLogout->logoutCurrentDevice($user);
        } else {
            $accountLogout->logoutCurrentSession($user);
        }

        return response()->json();
    }
}
