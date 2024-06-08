<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Arr;

use function Pest\Laravel\{post};

uses(RefreshDatabase::class);

dataset('email_invalid', [
    '',
    null,
    'a',
    '123',
    '123@gmail',
    'tekvn@',
    'tekvnexample.com',
    'tekvn@@example.com',
    'exampl..e@@gmail.com',
    'exampl#e@@gmail.com',
    'exampl$e@@gmail.com',
]);

dataset('name_invalid', [
    '',
    null,
    str_pad('a', 256, 'a'),
]);

it('returns a bad response if email invalid', function ($email) {
    $response = post('/api/v1/accounts/create', [
        'name' => 'DNT',
        'email' => $email,
        'password' => 'password',
    ]);

    $response->assertUnprocessable();
})->with('email_invalid');

it('returns a bad response if name invalid', function ($name) {
    $response = post('/api/v1/accounts/create', [
        'name' => $name,
        'email' => 'example@gmail.com',
        'password' => 'password',
    ]);

    $response->assertUnprocessable();
})->with('name_invalid');

it('returns a success response if valid data', function () {
    $response = post('/api/v1/accounts/create', $data = [
        'name' => 'DNT',
        'email' => 'example@gmail.com',
        'password' => 'password',
    ]);

    expect($response)->assertSuccessful()
        ->and($response->json())->toBeArray()->toMatchArray(Arr::only($data, ['name', 'email']))
        ->and($response->json('password'))->toBeEmpty();
});
