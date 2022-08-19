<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'  => $this->faker->unique()->domainName,
            'sku'   => $this->faker->ean13,
            'price' => $this->faker->randomNumber(2)
        ];
    }
}
