<?php

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
        $this->call(ConfigSeeder::class);
        $this->call(HouseSeeder::class);
        $this->call(PaymentStatusSeeder::class);
        $this->call(PaymentTypeSeeder::class);
    }
}
