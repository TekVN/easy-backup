<?php

use App\Account\Services\AccountCreator;
use App\Account\Services\AccountInfo;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

dataset('demo_user', [
    fn () => (new AccountCreator())->create([
        'name' => 'User 1',
        'email' => 'user1@example.com',
        'password' => 'password',
    ]),
]);

test('Throw exception if user not found', function () {
    $accountInfo = new AccountInfo();

    $accountInfo->profile('id_not_exists');
})->throws(ModelNotFoundException::class);

test('Check info account', function ($actual) {
    $accountInfo = new AccountInfo();

    $user = $accountInfo->profile($actual->id);

    expect($user)->toBeInstanceOf(User::class)
        ->and($user->id)->toEqual($actual->id)
        ->and($user->name)->toEqual($actual->name)
        ->and($user->email)->toEqual($actual->email);
    // TODO: check more info account
})->with('demo_user');
