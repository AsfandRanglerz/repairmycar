<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ChildCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'subcategory_id' => rand(1, 20),
            'name' => $this->faker->text(10),
            'slug' => $this->faker->text(10),
        ];
    }
}
