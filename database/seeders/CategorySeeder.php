<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->insert([
            'name_category' => 'Kursi',
            'created_at' => now(),
        ],
        [
            'name_category' => 'Meja',
            'created_at' => now()
        ],[
            'name_category' => 'Lemari',
            'created_at' => now(),
    ]);
    }
}
