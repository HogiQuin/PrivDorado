<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_statuses')->insert([
            'name' => 'A',
            'description' => 'Aprobado'
        ]);

        DB::table('payment_statuses')->insert([
            'name' => 'PA',
            'description' => 'Pendiente de Aprobar'
        ]);
    }
}
