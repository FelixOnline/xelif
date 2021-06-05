<?php

namespace Database\Factories;

use App\Models\Issue;
use Illuminate\Database\Eloquent\Factories\Factory;

class IssueFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Issue::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'issue' => $this->faker->numberBetween(0, 9999),
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
