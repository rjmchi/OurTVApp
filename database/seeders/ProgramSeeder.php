<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Program;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Program::create(['program'=>'Smash', 'episode'=>6, 'season'=>1, 'app'=>'NBC']);

        Program::create(['program'=>'This is Us', 'episode'=>3, 'season'=>4, 'app'=>'Stremio']);
        
    }
}
