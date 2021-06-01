<?php

namespace Modules\Customers\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Modules\Customers\Models\Customer;
use Modules\Customers\Models\Invoice;
use Modules\Customers\Models\Lead;
use Modules\Customers\Models\Quotation;
use Modules\Products\Models\Product;
use Modules\Users\Models\User;

class InvoicesSeeder extends Seeder
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
            if (sizeof($customers)) {
                $customer = $customers->random();

                //paid
                Invoice::factory()
                    ->count(5)
                    ->create([
                        'user_id' => $user->id,
                        'customer_id' => $customer->id,
                        'paid_at' => Carbon::now()
                    ]);

                //overdue
                Invoice::factory()
                    ->count(5)
                    ->create([
                        'user_id' => $user->id,
                        'customer_id' => $customer->id,
                        'due_at' => Carbon::now()->subMonths(2)
                    ]);

                //peinding
                Invoice::factory()
                    ->count(5)
                    ->create([
                        'user_id' => $user->id,
                        'customer_id' => $customer->id,
                    ]);
                Quotation::factory()
                    ->count(5)
                    ->create([
                        'user_id' => $user->id,
                        'customer_id' => $customer->id
                    ]);
            }
            $leads = Lead::query()->where('user_id', $user->id)->get();
            if (sizeof($leads)) {
                $lead = $leads->random();

                Quotation::factory()
                    ->count(5)
                    ->create([
                        'user_id' => $user->id,
                        'lead_id' => $lead->id
                    ]);
            }

        }
    }
}
