<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $plans = [
            [
                'name' => 'Basic Plan', 
                'slug' => 'basic-plan', 
                'stripe_plan' => 'price_xxxx', // Plan ID
                'price' => 15, 
                'description' => 'Basic Plan'
            ],
            [
                'name' => 'Advance Plan', 
                'slug' => 'advance-plan', 
                'stripe_plan' => 'price_xxxx', // Plan ID
                'price' => 25, 
                'description' => 'Advance Plan'
            ]
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}
