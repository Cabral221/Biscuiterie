<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Niveau;
use App\Models\Student;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(1)->create([
            'email' => 'user@user.com',
        ]);
        Admin::factory(1)->create([
            'email' => 'admin@admin.com',
            'is_admin' => true
        ]);
        Admin::factory(1)->create([
            'email' => 'admin1@admin.com',
        ]);
        Admin::factory(20)->create();

        $niveaux = ['CI','CP','CE1','CE2','CM1','CM2'];
        foreach($niveaux as $k => $niveau){
            $n = Niveau::create(['libele' => $niveau]);
            $cls = $n->classes()->createMany([
                ['libele' => $n->libele . ' A'],
                ['libele' => $n->libele . ' B'],
            ]);
            foreach ($cls as  $cl) {
                $students = Student::factory(20)->make();
                foreach ($students as $student) {
                    $cl->students()->save($student);
                }
            }
        }
    }
}
