<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { {
            User::create([
                'username' => 'Flipper',
                'name' => 'Elio',
                'surname' => 'Sanfratello',
                'email' => 'elio.sanfratello@gmail.com',
                'city' => 'Palermo',
                'date_of_submission' => now()->format('Y-m-d'),
                'activationStatus' => true
            ]);

            User::create([
                'username' => 'Mayer',
                'name' => 'Daniele',
                'surname' => 'Mayer',
                'email' => 'daniele.mayer@gmail.com',
                'city' => 'Palermo',
                'date_of_submission' => now()->format('Y-m-d'),
                'activationStatus' => true
            ]);

            User::create([
                'username' => 'Maurizio',
                'name' => 'Maurilio',
                'surname' => 'Contorno',
                'email' => 'maurilio.contorno@gmail.com',
                'city' => 'Palermo',
                'date_of_submission' => now()->format('Y-m-d'),
                'activationStatus' => false
            ]);

            User::create([
                'username' => 'Leo',
                'name' => 'Leopold',
                'surname' => 'Cusenza',
                'email' => 'leo.cusenza@gmail.com',
                'city' => 'Palermo',
                'date_of_submission' => now()->format('Y-m-d'),
                'activationStatus' => true
            ]);
        }
    }
}
