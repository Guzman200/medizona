<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Genero;
use App\Models\Item;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        
        $this->call(UserSeeder::class);
        Customer::factory(10)->create();
        Item::factory(50)->create();
    }
}
