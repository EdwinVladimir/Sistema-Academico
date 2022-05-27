<?php

namespace Database\Factories;

use App\Models\Matricula;
use Illuminate\Database\Eloquent\Factories\Factory;

class MatriculaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Matricula::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'alumno_id' => $this->faker->unixTime($max = 'now'),
            'periodo_id' => $this->faker->unixTime($max = 'now'),
            'curso_id' => $this->faker->postcode,
            'seccion_id' => $this->faker->postcode,
            'feins_matri' => $this->faker->unixTime($max = 'now'),
        ];
    }
}
