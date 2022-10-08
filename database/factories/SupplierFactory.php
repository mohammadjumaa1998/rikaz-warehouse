<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SupplierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Supplier::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'phone' => $this->faker->phoneNumber,
            'block' => $this->faker->boolean,
            'password' => Hash::make('12345678'),
            'user_id' =>$this->faker->unique()->numberBetween(16, 30)

        ];
    }
}
