<?php

namespace Database\Seeders;

use App\Models\Guest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Guest::factory()
            ->count(10)
            ->hasMessages(2)
            ->create();

        Guest::factory()
            ->count(50)
            ->hasMessages(1)
            ->create();


    }
}
