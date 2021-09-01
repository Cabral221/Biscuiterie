<?php

namespace Database\Seeders;

use App\Models\Qualification;
use Illuminate\Database\Seeder;

class QualificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Qualification::create(['libele' => 'CFEE', 'type' => 0]);
        Qualification::create(['libele' => 'BFEM', 'type' => 0]);
        Qualification::create(['libele' => 'BAC', 'type' => 0]);
        Qualification::create(['libele' => 'LICENCE', 'type' => 0]);
        Qualification::create(['libele' => 'MASTER', 'type' => 0]);


        Qualification::create(['libele' => 'CEAP', 'type' => 1]);
        Qualification::create(['libele' => 'CAP', 'type' => 1]);
    }
}
