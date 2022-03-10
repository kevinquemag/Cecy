<?php

namespace Database\Seeders\Develop\Cecy;

use App\Models\Authentication\User;
use App\Models\Cecy\Catalogue;
use App\Models\Cecy\DetailPlanification;
use App\Models\Cecy\Participant;
use App\Models\Cecy\Registration;
use App\Models\Cecy\RegistrationRequirement;
use Faker\Factory;
use Illuminate\Database\Seeder;

class RegistrationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createRegistrationsCatalogue();
        $this->createRegistrations();
    }

    public function createRegistrationsCatalogue()
    {
        //Campos que son de catalogo
        //type_id
        //state_id
        //state_course_id

        $catalogue = json_decode(file_get_contents(storage_path() . "/catalogue.json"), true);

        //type_id
        Catalogue::factory(10)->sequence(
            [
                'code' => $catalogue['registration']['special'],
                'name' => 'Especial',
                'type' => $catalogue['registration']['type'],
                'description' => 'Cuando el tipo de registro es especial'
            ],
            [
                'code' => $catalogue['registration']['ordinary'],
                'name' => 'Ordinaria',
                'type' => $catalogue['registration']['type'],
                'description' => 'Cuando el tipo de registro es Ordinaria'
            ],
            [
                'code' => $catalogue['registration']['extraordinary'],
                'name' => 'Extraordinaria',
                'type' => $catalogue['registration']['type'],
                'description' => 'Cuando el tipo de registro es Extraordinaria'
            ],
            [
                'code' => $catalogue['registration_state']['signed_up'],
                'name' => 'Inscrito',
                'type' => $catalogue['registration_state']['type'],
                'description' => 'Cuando el registro se encuentra en estado Inscrito  '
            ],
            [
                'code' => $catalogue['registration_state']['registered'],
                'name' => 'Matriculado',
                'type' => $catalogue['registration_state']['type'],
                'description' => 'Cuando el registro se encuentra en estado Matriculado'
            ],
            [
                'code' => $catalogue['registration_state']['rectified'],
                'name' => 'Rectificado',
                'type' => $catalogue['registration_state']['type'],
                'description' => 'Cuando el registro se encuentra en estado Rectificado'
            ],
            [
                'code' => $catalogue['registration_state']['cancelled'],
                'name' => 'Cancelado',
                'type' => $catalogue['registration_state']['type'],
                'description' => 'Cuando el registro se encuentra en estado Cancelado'
            ],
            [
                'code' => $catalogue['registration_state']['in_review'],
                'name' => 'En revisión',
                'type' => $catalogue['registration_state']['type'],
                'description' => 'Cuando el registro se encuentra en estado en revisión'
            ],
            [
                'code' => $catalogue['state_course']['not_approved'],
                'name' => 'No aprobado',
                'type' => $catalogue['state_course']['type'],
                'description' => 'Cuando el estudiante registrado no ha aprobado'
            ],
            [
                'code' => $catalogue['state_course']['approved'],
                'name' => 'Aprobado',
                'type' => $catalogue['state_course']['type'],
                'description' => 'Cuando el estudiante registrado ha aprobado'
            ]
        )->create();
    }
    public function createRegistrations()
    {
        $faker = Factory::create();

        $detailPlanifications =  DetailPlanification::all();
        $states = Catalogue::where('type', 'REGISTRATION_STATE')->get();
        $states_course = Catalogue::where('type', 'STATE_COURSE')->get();
        $types = Catalogue::where('type', 'REGISTRATION')->get();
        $participants = Participant::get();
        $iterador = 1;

        foreach ($detailPlanifications as $detailPlanification) {
            for ($i = 0; $i <= 4; $i++) {
                $participant =  $faker->randomElement($participants);
                Registration::factory()->create(
                    [
                        'detail_planification_id' => $detailPlanification,
                        'participant_id' => $participant,
                        'state_id' =>  $faker->randomElement($states),
                        'state_course_id' => $faker->randomElement($states_course),
                        'type_id' => $faker->randomElement($types),
                        'type_participant_id' => $participant->type()->first(),
                        'final_grade' => $faker->numberBetween(50, 100),
                        'grade1' => $faker->numberBetween(50, 100),
                        'grade2' => $faker->numberBetween(50, 100),
                        'number' => $faker->numberBetween(1, 3),
                        'observations' => $faker->sentences(3),
                        'registered_at' => $faker->date()
                    ]
                );
                $iterador = $iterador + 1;
            }
        }
    }
}
