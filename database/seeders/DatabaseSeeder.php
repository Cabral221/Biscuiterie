<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Niveau;
use App\Models\Program;
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
        $this->call(CountriesSeeder::class);
        $this->call(QualificationSeeder::class);


        Admin::factory(1)->create([
            'full_name' => 'Amadou Ndao',
            'phone' => 774285785,
            'email' => 'admin@empro.com',
            'is_admin' => true
        ]);
        Admin::factory(1)->create([
            'full_name' => 'Khadidiatou Badji',
            'phone' => 775579933,
            'email' => 'kadidiatoubadji397@gmail.com',
            'is_admin' => true
        ]);
        Admin::factory(1)->create([
            'full_name' => 'Dadouda Diatta',
            'phone' => 775603563,
            'email' => 'diattadaoudasane@gmail.com',
            'is_admin' => true
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
                    'Écrituree'                     => 10,
                    'Copie'                         => 5,
                    'Auto Dictée'                   => 10,
                    'Production d\'Ecrits'          => 10,
                    'Principe Alphabétique'         => 10,
                    'Correspondance Grapho'         => 10,
                    'Déchiffrage de mots'           => 10,
                    'Vocabulaire'                   => 10,
                    'Compréhension en Lecture'      => 10,
                    'Fluidité'                      => 10,
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
                    'Education Religieuse'          => 10,
                ],
                'default' => [
                    'Recit / Chant'                 => 10,
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
                    'Dictée'                        => 0,
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
                    'Education Religieuse'          => 10,
                ],
                'default' => [
                    'Recit / Chant'                 => 10,
                    'Arabe'                         => 10,
                ],
            ],
            'CM1-CM2' => [
                'Langues et communication' => [
                    'Ressources'                    => 40,
                    'Compétence'                    => 60,
                ],
                'Maths' => [
                    'Ressources'                    => 40,
                    'Compétence'                    => 60,
                ],
                'Découverte du monde' => [
                   'Ressources'                     => 24,
                    'Compétence'                    => 16,
                ],
                'Education au developpelment durable' => [
                    'Ressources'                     => 24,
                    'Compétence'                    => 16,
                ],
                'Education artistique' => [
                    'Arts Plastiques'               => 10,
                ],
                'default' => [
                    'Arabe'                         => 10,
                ],
            ]
        ];

        // $profs = [];
        // $profs = User::factory(11)->create();
        // $profs[] = User::factory(1)->create([
        //     'email' => 'user@user.com',
        // ]);
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

                // $cls = $n->classes()->createMany([
                //     ['libele' => $n->libele . ' A', 'user_id' => ++$x],
                //     ['libele' => $n->libele . ' B', 'user_id' => ++$x],
                // ]);
                // foreach ($cls as  $cl) {
                //     $students = Student::factory(20)->make();
                //     foreach ($students as $student) {
                //         // $cl->students()->create($student);
                //         $student->classe_id = $cl->id;
                //         Student::create($student->getAttributes());
                //     }
                // }
            }
        }

        // Seed des notes fictives
        // $notes = Note::all();
        // foreach($notes as $note){
        //     $note->update([
        //         'note1' => rand(1, 10),
        //         'note2' => rand(1, 10),
        //         'note3' => rand(1, 10),
        //     ]);
        // }

    }
}
