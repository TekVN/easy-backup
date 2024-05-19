<?php

namespace App\Http\Controllers\API\Central\V1;

use App\Account\FormRequests\AccountCreateRequest;
use App\Account\Services\AccountCreator;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

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
}
