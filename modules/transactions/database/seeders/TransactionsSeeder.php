<?php

namespace Modules\Transactions\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Customers\Models\Customer;
use Modules\Products\Models\Product;
use Modules\Transactions\Models\Transaction;
use Modules\Users\Models\User;

class TransactionsSeeder extends Seeder
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

            $products = Product::query()->where('user_id', $user->id)
                ->get();

            $product_ids = $products->pluck('id');
            $item_ids = collect($product_ids)->random(3);
            $items = [];
            foreach ($item_ids as $item){
                $items[$item] = random_int(2,7);
            }

            $customer = $customers->random(1);

            Transaction::factory()
                ->count(5)
                ->create([
                    'user_id' => $user->id,
                    'items' => $items,
                    'customer_id' => $customer[0]->id
                ]);
        }

    }
}
