<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Emport;
use App\Models\Item;
use App\Models\Supplier;

class EmportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Emport::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'item_id' => Item::factory(),
            'supplier_id' => Supplier::factory(),
            'qty' => $this->faker->numberBetween(1, 10),
            'date' => $this->faker->date('y-m-d'),

        ];
    }
}
