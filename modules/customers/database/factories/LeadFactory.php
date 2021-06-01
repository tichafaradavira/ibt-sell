<?php
namespace Modules\Customers\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Customers\Models\Customer;
use Modules\Customers\Models\Lead;

class LeadFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Lead::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'full_name' => $this->faker->name,
            'description' => $this->faker->paragraph,
            'phone' => $this->faker->phoneNumber,
            'email' =>  $this->faker->email,
            'street_address' =>  $this->faker->streetAddress,
            'suburb' =>  $this->faker->countryCode,
            'city' =>  $this->faker->city,
            'country' =>  $this->faker->country,
            'zip_code' =>  $this->faker->postcode,
        ];
    }
}

