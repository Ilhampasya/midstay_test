<?php

namespace Database\Factories;

use App\Models\Flat;
use App\Models\Neighborhood;
use Illuminate\Database\Eloquent\Factories\Factory;

class FlatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Flat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->streetName(),
            'location' => $this->faker->streetAddress(),
            'neighborhood_id' => function () {
                Neighborhood::factory()->create()->id;
            }
        ];
    }
}
