<?php

namespace Database\Factories;

use App\Models\Section;
use Illuminate\Database\Eloquent\Factories\Factory;

class SectionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Section::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'published' => true,
            'title' => $this->faker->text(10),
            'description' => $this->faker->text(20),
            'current' => true,
            'email' => $this->faker->email,
            'colour' => $this->faker->hexColor
        ];
    }

    public function published(bool $status)
    {
        return $this->state(function (array $attributes) use ($status) {
            return [
                'published' => $status,
            ];
        });
    }
}
