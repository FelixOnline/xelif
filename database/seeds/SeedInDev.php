<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeedInDev extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        // Add a default news and about sections
        DB::table('sections')->insert([
            ['title' => 'News'],
            ['title' => 'About']
        ]);

        // Add a 10000th issue so we ca see home page
        DB::table('issues')->insert([
            ['issue' => 10000, 'published' => 1, 'position' => 1]
        ]);

        // Next, insert default settings (dumped)
        // NOTE: These may change, do not use to recreate prod!
        DB::unprepared(file_get_contents(app_path()."/../database/seeds/xelif_default.sql"));

    }
}
