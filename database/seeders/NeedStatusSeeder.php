<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\NeedStatus;

class NeedStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            ['title' => 'Pending', 'description' => 'Status for pending needs'],
            ['title' => 'In Processing', 'description' => 'Status for needs in processing'],
            ['title' => 'Argument', 'description' => 'Status for needs under argument'],
            ['title' => 'Archived', 'description' => 'Status for archived needs'],
            ['title' => 'Declined', 'description' => 'Status for declined needs'],
        ];

        foreach ($statuses as $status) {
            NeedStatus::create($status);
        }
    }
}