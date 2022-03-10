<?php

namespace Database\Factories\Cecy;

use App\Models\Cecy\Registration;
use App\Models\Cecy\RegistrationRequirement;
use App\Models\Cecy\Requirement;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegistrationRequerimentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RegistrationRequirement::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [];
    }
}
