<?php

use App\Account\Services\AccountCreator;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('Cannot create if data missing password', function () {
    $accountService = new AccountCreator();

    $accountService->create([
        'name' => 'DNT',
        'email' => 'example@gmail.com',
    ]);
})->throws(QueryException::class);

test('Cannot create if data missing email', function () {
    $accountService = new AccountCreator();

    $accountService->create([
        'name' => 'DNT',
        'password' => 'password',
    ]);
})->throws(QueryException::class);

test('Cannot create if data missing name', function () {
    $accountService = new AccountCreator();

    $accountService->create([
        'email' => 'example@gmail.com',
        'password' => 'password',
    ]);
})->throws(QueryException::class);
