<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FuelConsumptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fuel_consumptions')->insert([
            ['date' => '2022-10-10', 'distance' => 86801, 'money' => 4472, 'refueling_amount' => 26.00, 'fuel_price' => 172 ,'fuel_consumption' => null, 'account_id' => '1'],
            ['date' => '2022-10-17', 'distance' => 87129, 'money' => 3393, 'refueling_amount' => 19.60, 'fuel_price' => 173 ,'fuel_consumption' => 16.7, 'account_id' => '1'],
            ['date' => '2022-10-31', 'distance' => 87567, 'money' => 4425, 'refueling_amount' => 25.00, 'fuel_price' => 177 ,'fuel_consumption' => 17.5, 'account_id' => '1'],
            ['date' => '2022-11-12', 'distance' => 87850, 'money' => 2702, 'refueling_amount' => 16.89, 'fuel_price' => 160 ,'fuel_consumption' => 16.8, 'account_id' => '1'],
            ['date' => '2022-11-20', 'distance' => 88272, 'money' => 3752, 'refueling_amount' => 23.45, 'fuel_price' => 160 ,'fuel_consumption' => 18.0, 'account_id' => '1'],
            ['date' => '2022-12-14', 'distance' => 88661, 'money' => 4027, 'refueling_amount' => 25.01, 'fuel_price' => 161 ,'fuel_consumption' => 15.6, 'account_id' => '1'],
            ['date' => '2023-01-22', 'distance' => 89256, 'money' => 6176, 'refueling_amount' => 38.60, 'fuel_price' => 160 ,'fuel_consumption' => 15.4, 'account_id' => '1'],
        ]);
    }
}
