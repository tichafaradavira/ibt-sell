<?php

namespace Modules\Customers\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Customers\Models\Customer;
use Modules\Customers\Models\Lead;
use Modules\Users\Models\User;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $users = User::query()->where('is_admin', false)->get();

        foreach ($users as $user) {
            Customer::factory()
                ->count(5)
                ->create([
                    'user_id' => $user->id
                ]);

            Lead::factory()
                ->count(5)
                ->create([
                    'user_id' => $user->id
                ]);
        }
    }
}
