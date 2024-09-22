<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactFormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contact_forms')->insert([
            ['name' => '山田花子', 'email' => 'example@gmail.com', 'subject' => '件名', 'message' => 'メッセージ内容'],
            ['name' => '佐藤一郎', 'email' => 'example@gmail.com', 'subject' => '件名', 'message' => 'メッセージ内容'],
            ['name' => '広島太郎', 'email' => 'example@gmail.com', 'subject' => '件名', 'message' => 'メッセージ内容']
        ]);
    }
}
