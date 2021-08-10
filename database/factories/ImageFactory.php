<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Image;
use App\Models\User;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'       =>  $this->faker->NumberBetween(1, 10),
            'image_path'    =>  $this->faker->imageUrl($width = 640, $height = 480),
            'description'   =>  $this->faker->text($maxNbChars = 50)
        ];
       
    }
}
