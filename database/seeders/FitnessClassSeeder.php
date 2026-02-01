<?php

namespace Database\Seeders;

use App\Models\FitnessClass;
use Illuminate\Database\Seeder;

class FitnessClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        FitnessClass::create([
            'name' => 'Yoga',
            'description' => 'A relaxing yoga class.',
            'date' => '2026-02-10',
            'time' => '18:00:00',
        ]);

        FitnessClass::create([
            'name' => 'Pilates',
            'description' => 'A core-strengthening pilates class.',
            'date' => '2026-02-12',
            'time' => '19:00:00',
        ]);

        FitnessClass::create([
            'name' => 'Zumba',
            'description' => 'A fun and energetic zumba class.',
            'date' => '2026-02-14',
            'time' => '17:00:00',
        ]);
    }
}
