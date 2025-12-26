<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserAuthService
{
    public function createUser(array $data)
    {
        // Validate that either email or phone is provided
        if (empty($data['email']) && empty($data['phone'])) {
            throw new \Exception('Either email or phone must be provided.');
        }

        // Check if user already exists
        $existingUser = User::where('email', $data['email'] ?? null)
                            ->orWhere('phone', $data['phone'] ?? null)
                            ->first();

        if ($existingUser) {
            throw new \Exception('User already exists with this email or phone.');
        }

        // Create user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'password' => Hash::make($data['password']),
            'role' => 'user',
            'referral_code' => Str::random(8),
        ]);

        return $user;
    }

    public function authenticateUser($identifier, $password)
    {
        // Find user by email or phone
        $user = User::where('email', $identifier)
                    ->orWhere('phone', $identifier)
                    ->first();

        if (!$user || !Hash::check($password, $user->password)) {
            throw new \Exception('Invalid credentials.');
        }

        return $user;
    }
}
