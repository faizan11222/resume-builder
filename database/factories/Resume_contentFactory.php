<?php

namespace Database\Factories;

use App\Models\Resume_content;
use Illuminate\Database\Eloquent\Factories\Factory;

class Resume_contentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Resume_content::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'resume_id' => mt_rand(1,15),
            'job_title' => $this->faker->jobTitle(),
            'photo' => 'profile.jpg'
        ];
    }
}
