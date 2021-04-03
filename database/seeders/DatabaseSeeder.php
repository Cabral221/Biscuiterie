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
                'Langues et communication' => [
                    'Principe Alphabétique'         => 5,
                    'Conscience phonétique'         => 5,
                    'Dichiffache mots / non mots'   => 5,
                    'Fluidité'                      => 5,
                    'Production d\'Ecrits'          => 5,
                    'T.S.Q'                         => 5,
                    'Dictée'                        => 5,
                    'Lecture Compréhension'         => 5,
                ],
                'Maths' => [
                    'Act. numériques'               => 10,
                    'Act. Géométriques'             => 10,
                    'Act. de mesures'               => 10,
                    'Résolution de Probléme'        => 10,
                ],
                'ESVS' => [
                    'EDD' => [
                        'IST'                       => 10,
                        'Histoire'                  => 10,
                        'Géographie'                => 10,
                    ],
                    'DD' => [
                        'Vivre Ensemble'            => 10,
                        'Vivre ds son milieu'       => 10,
                    ],
                ],
                'EPSA' => [
                    'Arts Plastiques'               => 10,
                    'Recit / Chant'                 => 10,
                ],
                'default' => [
                    'Education Religieuse'          => 10,
                    'Arabe'                         => 10,
                ],
            ],
            'CE1-CE2' => [
                'Langues et communication' => [
                    'Principe Alphabétique'         => 10,
                    'Conscience phonétique'         => 10,
                    'Dichiffache mots / non mots'   => 10,
                    'Fluidité'                      => 10,
                    'Production d\'Ecrits'          => 10,
                    'T.S.Q'                         => 10,
                    'Dictée'                        => 10,
                    'Lecture Compréhension'         => 10,
                ],
                'Maths' => [
                    'Act. numériques'               => 10,
                    'Act. Géométriques'             => 10,
                    'Act. de mesures'               => 10,
                    'Résolution de Probléme'        => 10,
                ],
                'ESVS' => [
                    'EDD' => [
                        'IST'                       => 10,
                        'Histoire'                  => 10,
                        'Géographie'                => 10,
                    ],
                    'DD' => [
                        'Vivre Ensemble'            => 10,
                        'Vivre ds son milieu'       => 10,
                    ],
                ],
                'EPSA' => [
                    'Arts Plastiques'               => 10,
                    'Recit / Chant'                 => 10, 
                ],
                'default' => [
                    'Education Religieuse'          => 10,
                    'Arabe'                         => 10,
                ],
            ],
            'CM1-CM2' => [
                'Langues et communication' => [
                    'Principe Alphabétique'         => 10,
                    'Conscience phonétique'         => 10,
                    'Dichiffache mots / non mots'   => 10,
                    'Fluidité'                      => 10,
                    'Production d\'Ecrits'          => 10,
                    'T.S.Q'                         => 10,
                    'Dictée'                        => 10,
                    'Lecture Compréhension'         => 10,
                ],
                'Maths' => [
                    'Act. numériques'               => 10,
                    'Act. Géométriques'             => 10,
                    'Act. de mesures'               => 10,
                    'Résolution de Probléme'        => 10,
                ],
                'ESVS' => [
                    'EDD' => [
                        'IST'                       => 10,
                        'Histoire'                  => 10,
                        'Géographie'                => 10,
                    ],
                    'DD' => [
                        'Vivre Ensemble'            => 10,
                        'Vivre ds son milieu'       => 10,
                    ],
                ],
                'EPSA' => [
                    'Arts Plastiques'               => 10,
                    'Recit / Chant'                 => 10,
                ],
                'default' => [
                    'Education Religieuse'          => 10,
                    'Arabe'                         => 10,
                ],
            ]
        ];
        
        // $profs = [];
        $profs = User::factory(11)->create();
        $profs[] = User::factory(1)->create([
            'email' => 'user@user.com',
        ]);
        $x = 0;

        foreach($programs as $p => $niveaux){
            $program = Program::create([
                'libele' => $p,
            ]);

            // On charge les domaines, sous-domaine et leurs matieres pour ce programme
            foreach ($matieres[$p] as $domain => $value) {
                $domain = $program->domains()->create(['libele' => $domain,]);

                foreach($value as $lOrM => $v) {
                    if (is_array($v)) {
                        // C'est un sous domain
                        $subdomain = $domain->sub_domains()->create(['libele' => $lOrM]);
                        foreach($v as $a => $d){
                            $subdomain->activities()->create(['libele' => $a, 'dividente' => $d]);
                        }
                    }else {
                        // C'est une matiere
                        $domain->activities()->create(['libele' => $lOrM, 'dividente' => $v]);
                    }
                }
            }

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
                        // $cl->students()->create($student);
                        $student->classe_id = $cl->id;
                        Student::create($student->getAttributes());
                    }
                }
            }
        }

    }
}
