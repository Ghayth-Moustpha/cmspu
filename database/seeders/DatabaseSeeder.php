<?php 
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\NeedStatusSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(NeedStatusSeeder::class);

        // Add more seeder calls if needed

    }
}