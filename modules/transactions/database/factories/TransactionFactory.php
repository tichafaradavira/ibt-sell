<?php
namespace Modules\Transactions\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Transactions\Models\Transaction;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->lastName,
            'total_price' => $this->faker->numberBetween(10,50),
            'paid_price' =>  $this->faker->numberBetween(50,100),
            'discount' =>  $this->faker->numberBetween(10,15),
        ];
    }
}

