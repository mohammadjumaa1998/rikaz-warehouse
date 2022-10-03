<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Group;
use App\Models\Item;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'code' => $this->faker->word,
            'min' => $this->faker->numberBetween(-10000, 10000),
            'qty' => $this->faker->numberBetween(-10000, 10000),
            'price' => $this->faker->numberBetween(1, 10000),
            'active' => $this->faker->boolean,
            'image' => $this->faker->word,
            'group_id' => Group::factory(),
        ];
    }
}
