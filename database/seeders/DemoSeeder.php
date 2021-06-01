<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Customers\Database\Seeders\CustomersSeeder;
use Modules\Customers\Database\Seeders\InvoicesSeeder;
use Modules\Products\Database\Seeders\ProductsSeeder;
use Modules\Transactions\Database\Seeders\TransactionsSeeder;
use Modules\Users\Database\Seeders\UsersSeeder;

class DemoSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(UsersSeeder::class);
        $this->call(CustomersSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(TransactionsSeeder::class);
        $this->call(InvoicesSeeder::class);
    }
}
