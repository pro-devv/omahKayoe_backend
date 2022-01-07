<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryBlog extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category_blog')->insert([
            'name_blog' => 'Pertanian',
            'created_at' => now(),
        ]);
    }
}
