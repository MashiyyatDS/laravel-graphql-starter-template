<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Guest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

final class LoginGuest
{
    /**
     * @param  null  $_
     * @param  array{}  $args
     */
    public function __invoke($_, array $args)
    {
        $guest = Guest::where('email', $args['email'])->first();

        if (!$guest || !Hash::check($args['password'], $guest->password)) {
            throw ValidationException::withMessages([
                'Invalid Credentials' => ['The provided credentials are incorrect.'],
            ]);
        }

        $guest->tokens()->delete();

        return [
            'guest' => $guest,
            'token' => $guest->createToken('guest-token', ['access:guest'])->plainTextToken
        ];
    }
}
