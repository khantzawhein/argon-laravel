<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => Hash::make('password'), // password
            'remember_token' => Str::random(10),
        ];
    }

    public function superAdmin()
    {
        return $this->state(function (array $attrs) {
            return [
                'email' => 'admin@argon.test',
                'password' => Hash::make('password'),
            ];
        });
    }

    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            $user->assignRole('super_admin');
        });
    }
}
