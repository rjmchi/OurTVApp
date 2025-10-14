<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Program;
use Illuminate\Support\Facades\File;


class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonPath = database_path('programs.json');

        // Check if file exists
        if (!File::exists($jsonPath)) {
            $this->command->error("JSON file not found at: {$jsonPath}");
            return;
        }

        // Read and decode JSON file
        $jsonData = File::get($jsonPath);
        $data = json_decode($jsonData, true);

        // Check for JSON errors
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->command->error('Error decoding JSON: ' . json_last_error_msg());
            return;
        }

        // Insert data
        foreach ($data as $item) {
            Program::create($item);
        }

        $this->command->info('Successfully seeded ' . count($data) . ' records!');
    }
}
