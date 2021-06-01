<?php
namespace Modules\Users\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Users\Models\User;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->name,
            'last_name' => $this->faker->lastName,
            'company_name' => $this->faker->company,
            'password' =>  Hash::make('test12345'),
            'country' =>  'South Africa',
            'language' => $this->faker->languageCode,
            'phone_number' => $this->faker->phoneNumber,
            'email_verified_at' => Carbon::now(),
            'suspended_at' => null,
            'remember_token' => Str::random(10),
        ];
    }
}

