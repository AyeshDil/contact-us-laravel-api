<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()
            ->count(10)
            ->hasReply(2)
            ->create();

        User::factory()
            ->count(5)
            ->hasReply(3)
            ->create();

        User::factory()
            ->count(2)
            ->hasReply(5)
            ->create();

        User::factory()
            ->count(1)
            ->hasReply(10)
            ->create();
    }
}
