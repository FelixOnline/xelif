<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Issue;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'headline' => $this->faker->text(100),
            'lede' => $this->faker->text
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
