<?php

namespace Database\Factories;

use App\Models\Resume;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResumeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Resume::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => mt_rand(1,5),
            'title' => $this->faker->sentence(2),
            'img' => 'cv-1.jpg',
            'slug' => uniqid(),
            'theme' =>  $this->faker->colorName(),
        ];
    }
}
