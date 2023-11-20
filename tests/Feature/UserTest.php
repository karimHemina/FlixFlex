<?php

use App\Models\User;

it('Creates user successful', function () {
    $data = [
        'name'      => 'Karim HEMINA',
        'username'  => 'karim.swe',
        'password'  =>  '12345678',
    ];

    $this->post('api/v1/users', $data)
        ->assertCreated();

    unset($data['password']); //because it is hashed in the database
    $this->assertDatabaseHas('users', $data);
});

it('Login user successful', function () {
    $password = '123456';
    $user = User::factory(['password'   =>  $password])->create();

    $this->post('api/v1/users/login', [
        'username'  => $user->username,
        'password'  => $password,
    ])
        ->assertOk();
});

it('Cannot login user with wrong credentials', function () {
    $password = '123456';
    $user = User::factory(['password'   =>  $password])->create();

    $this->post('api/v1/users/login', [
        'username'  => $user->username,
        'password'  => $password . '0',
    ])
        ->assertUnauthorized();
});

it('Logouts user successful', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    $this->post('api/v1/users/logout')
        ->assertOk();
});

it('cannot logout unlogged user', function () {
    User::factory()->create();

    $this->post('api/v1/users/logout')
        ->assertUnauthorized();

});
