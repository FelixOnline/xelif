<?php

namespace Database\Factories\A17\Twill\Models;

use A17\Twill\Models\Feature;
use Illuminate\Database\Eloquent\Factories\Factory;

class FeatureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Feature::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'bucket_key' => 'featured',
            'position' => 0,
        ];
    }
}
