<?php

namespace Modules\Products\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Products\Models\Product;
use Modules\Users\Models\User;

class ProductsSeeder extends Seeder
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
            Product::factory()
                ->count(5)
                ->create([
                    'user_id' => $user->id
                ]);
        }

    }
}
