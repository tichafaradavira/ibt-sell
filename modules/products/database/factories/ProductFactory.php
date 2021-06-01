<?php
namespace Modules\Products\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Products\Models\Product;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->lastName,
            'buying_price' => $this->faker->numberBetween(10,50),
            'selling_price' =>  $this->faker->numberBetween(50,100),
            'quantity' =>  $this->faker->numberBetween(10,100),
        ];
    }
}

