<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Program;


class ProgramSeeder extends Seeder
{
    public function run(): void
    {
        Program::factory()->count(10)->create();
    }
}
