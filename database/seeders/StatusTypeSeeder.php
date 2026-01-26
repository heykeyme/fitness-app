<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\StatusType; // <--- THIS IS THE MISSING PIECE

class StatusTypeSeeder extends Seeder
{
    public function run()
    {
        // Now PHP knows to look in App\Models\StatusType
        StatusType::create(['name' => 'Active']);
        StatusType::create(['name' => 'Expired']);
        StatusType::create(['name' => 'Cancelled']);
    }
}