<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('prices')->insert([
            ['regular' => '163.5', 'high_octane' => '174.4', 'diesel' => '142.6', 'kerosene' => '1,895.2', 'date' => '2023年1月22日（日）時点の平均価格'],
            ['regular' => '163.7', 'high_octane' => '174.5', 'diesel' => '142.7', 'kerosene' => '1,897.1', 'date' => '2023年1月23日（月）時点の平均価格'],
            ['regular' => '163.7', 'high_octane' => '174.6', 'diesel' => '142.7', 'kerosene' => '1,897.9', 'date' => '2023年1月24日（火）時点の平均価格'],
            ['regular' => '163.8', 'high_octane' => '174.7', 'diesel' => '142.9', 'kerosene' => '1,898.1', 'date' => '2023年1月25日（水）時点の平均価格'],
            ['regular' => '163.8', 'high_octane' => '174.8', 'diesel' => '143.0', 'kerosene' => '1,900.5', 'date' => '2023年1月26日（木）時点の平均価格'],
            ['regular' => '163.9', 'high_octane' => '174.8', 'diesel' => '143.1', 'kerosene' => '1,899.7', 'date' => '2023年1月27日（金）時点の平均価格'],
            ['regular' => '163.8', 'high_octane' => '174.7', 'diesel' => '143.2', 'kerosene' => '1,899.8', 'date' => '2023年1月28日（土）時点の平均価格'],
            ['regular' => '163.6', 'high_octane' => '174.5', 'diesel' => '142.9', 'kerosene' => '1,897.7', 'date' => '2023年1月29日（日）時点の平均価格'],
            ['regular' => '163.6', 'high_octane' => '174.7', 'diesel' => '143.0', 'kerosene' => '1,898.2', 'date' => '2023年1月30日（月）時点の平均価格'],
        ]);
    }
}
