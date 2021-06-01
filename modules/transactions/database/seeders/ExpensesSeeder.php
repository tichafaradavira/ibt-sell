<?php

namespace Modules\Transactions\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Customers\Models\Customer;
use Modules\Transactions\Models\Expense;
use Modules\Users\Models\User;

class ExpensesSeeder extends Seeder
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
            $customers = Customer::query()->where('user_id', $user->id)
                ->get();

            Expense::factory()
                ->count(10)
                ->create([
                    'user_id' => $user->id,
                ]);
        }

    }
}
