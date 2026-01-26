<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MembershipPlan;

class MembershipPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MembershipPlan::create([
            'plan_name' => 'Starter Monthly',
            'price' => 50.00,
            'duration_days' => 30
        ]);
        MembershipPlan::create([
            'plan_name' => 'Pro Yearly',
            'price' => 500.00,
            'duration_days' => 365
        ]);
    }
}
