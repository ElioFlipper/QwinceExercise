<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subscription::create([
            'name' => 'Netflix semestrale',
            'slug' => 'netflix-6-2024',
            'duration' => 6,
            'startingDate' => '2024-01-01',
            'endingDate' => '2024-06-30',
        ]);

        Subscription::create([
            'name' => 'Amazon annuale',
            'slug' => 'amazon-12-2024',
            'duration' => 12,
            'startingDate' => '2024-01-01',
            'endingDate' => '2024-12-31',
        ]);

        Subscription::create([
            'name' => 'Amazon trimestrale',
            'slug' => 'amazon-6-2024',
            'duration' => 6,
            'startingDate' => '2024-01-01',
            'endingDate' => '2024-06-30',
        ]);

        Subscription::create([
            'name' => 'Paramount trimestrale',
            'slug' => 'paramount-3-2024',
            'duration' => 3,
            'startingDate' => '2024-01-01',
            'endingDate' => '2024-03-31',
        ]);

    }
}
