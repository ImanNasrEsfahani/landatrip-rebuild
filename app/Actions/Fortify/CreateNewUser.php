<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Fortify\Rules\Password;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param array $input
     *
     * @return User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'fname'    => ['required', 'string', 'max:255'],
            'lname'    => ['required', 'string', 'max:255'],
            'email'    => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            //'password' => [Rule::requiredIf(array_key_exists($input), 'string', new Password, 'confirmed'],
//            'role'     => ['required', 'max:255', 'in:user,teacher,agent'],
            'name'     => ['prohibited']
        ])->validate();


        $user = User::create([
            'fname'                    => $input['fname'],
            'lname'                    => $input['lname'],
            'email'                    => $input['email'],
            //'email_verified_at' => Carbon::now(),
            'password'                 => Hash::make($input['password']),
            'verification_code'        => rand(10, 100 . '2151'),
            'verification_code_expire' => Carbon::now()->addHour(3)
        ]);

        return $user;
    }
}
