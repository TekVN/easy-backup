<?php

use App\Account\Services\AccountCreator;
use Illuminate\Foundation\Testing\RefreshDatabase;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

uses(RefreshDatabase::class);

dataset('demo_user', [
    fn () => (new AccountCreator())->create([
        'name' => 'User 1',
        'email' => 'user1@example.com',
        'password' => 'password',
    ]),
]);

it('returns a unauthenticated response if id invalid', function () {
    $response = get('/api/v1/accounts/id/profile', [
        'Accept' => 'application/json',
    ]);

    $response->assertUnauthorized();
})->with('demo_user');

it('returns a not found response if id invalid and authenticated', function ($actual) {
    actingAs($actual);

    $response = get('/api/v1/accounts/id/profile', [
        'Accept' => 'application/json',
    ]);

    $response->assertNotFound();
})->with('demo_user');

it('returns a not found response if id equal me but unauthenticated', function () {
    $response = get('/api/v1/accounts/me/profile', [
        'Accept' => 'application/json',
    ]);

    $response->assertUnauthorized();
})->with('demo_user');

it('returns a success response if id equal me and authenticated', function ($actual) {
    actingAs($actual);

    $response = get('/api/v1/accounts/me/profile', [
        'Accept' => 'application/json',
    ]);

    expect($response)->assertSuccessful()
        ->and($response->json())->toMatchArray([
            'id' => $actual->id,
            'name' => $actual->name,
            'email' => $actual->email,
        ])->and($response->json('password'))->toBeEmpty();
})->with('demo_user');
