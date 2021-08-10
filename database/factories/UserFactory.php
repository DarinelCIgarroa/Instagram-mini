<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
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
            'role'      =>  $this->faker->randomElement(['User', 'socio']),
            'name'      =>  $this->faker->name,
            'surname'   =>  $this->faker->lastName,
            'nick'      =>  $this->faker->UserName,
            'email'     =>  $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password'  => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'image'     =>  $this->faker->imageUrl($width = 640, $height = 480),
            'remember_token' => Str::random(10),
        ];
    }
}
