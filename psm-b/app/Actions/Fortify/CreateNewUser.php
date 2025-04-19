<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        // Validate input
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'role_id' => ['required', 'integer', Rule::exists('roles', 'id')], // Accept 1, 2, or 3
            'ic_no' => 'required|string|max:12|unique:users',
            'position' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            'phone_no' => 'required|string|max:15',
        ])->validate();

        // Create user
        $user = User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'ic_no' => $input['ic_no'],
            'position' => $input['position'],
            'department' => $input['department'],
            'phone_no' => $input['phone_no'],
            'unit' => $input['unit'],
            'password' => Hash::make($input['password']),
        ]);

        // Assign selected role
        $user->roles()->attach($input['role_id']);

        return $user;
    }
}
