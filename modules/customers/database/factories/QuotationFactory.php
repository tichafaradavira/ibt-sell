<?php
namespace Modules\Customers\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Customers\Models\Customer;
use Modules\Customers\Models\Invoice;
use Modules\Customers\Models\Quotation;

class QuotationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Quotation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'number' => Str::random(5),
            'summary' =>  $this->faker->paragraph(5),
            'total_amount' =>  $this->faker->numberBetween(50,100),
            'discount' =>  $this->faker->numberBetween(5,10),
            'items' =>  resolve(InvoiceFactory::class)->getItems(),
            'expires_at' =>  Carbon::now()->addMonth(),
        ];
    }
}

