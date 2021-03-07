<?php

namespace Database\Seeders;

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
        $this->call(Website_InfoSeeder::class);
        $this->call(Contact_UsSeeder::class);
        $this->call(CategorySeeder::class);
    }
}
