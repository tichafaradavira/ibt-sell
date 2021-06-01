<?php
namespace Modules\Customers\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Customers\Models\Customer;
use Modules\Customers\Models\Invoice;

class InvoiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Invoice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number' => Str::random(5),
            'total_amount' =>  $this->faker->numberBetween(50,100),
            'discount' =>  $this->faker->numberBetween(5,10),
            'items' =>  $this->getItems(),
            'due_at' =>  Carbon::now()->addMonth(),
        ];
    }

    public function getItems(){
        $items = [];
        for($i=0;$i<5;$i++)
        {
            array_push($items,[
                'price' => $this->faker->numberBetween(5,15),
                'quantity' => $this->faker->numberBetween(1,5),
                'description' => $this->faker->sentence,
            ]);
        }
        return $items;
    }
}

