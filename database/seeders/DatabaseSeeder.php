<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use App\Models\Niveau;
use App\Models\Program;
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
        Admin::factory(1)->create([
            'email' => 'admin@admin.com',
            'is_admin' => true
        ]);
        Admin::factory(1)->create([
            'email' => 'admin1@admin.com',
        ]);
            
        $programs = [
            'CI-CP'     => ['CI', 'CP'],
            'CE1-CE2'   => ['CE1', 'CE2'],
            'CM1-CM2'   => ['CM1', 'CM2']
            // 'program'     => ['niveaux', 'niveaux'],
        ];

        $matieres = [
            'CI-CP' => [
                'default' => 'matiere1',
                'domain2' => 'matiere2',
                'domain4' => [
                    'subdomain1' => ['matiere4', 'matiere5'],
                    'subdomain2' => ['matiere6', 'matiere8'],
                ],
                'domain5' => 'matiere6',
                'domain6' => 'matiere7',
            ],
            'CE1-CE2' => [
                'CE1', 'CE2',
            ],
            'CM1-CM2' => [
                'CM1', 'CM2',
            ]
        ];
        
        $profs = [];
        $profs = User::factory(11)->create();
        $prof[] = User::factory(1)->create([
            'email' => 'user@user.com',
        ]);
        $x = 0;

        foreach($programs as $p => $niveaux){
            $program = Program::create([
                'libele' => $p,
            ]);

            foreach($niveaux as $k => $niveau){
                $n = Niveau::create([
                    'libele' => $niveau,
                    'program_id' => $program->id,
                ]);

                $cls = $n->classes()->createMany([
                    ['libele' => $n->libele . ' A', 'user_id' => ++$x],
                    ['libele' => $n->libele . ' B', 'user_id' => ++$x],
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
}
