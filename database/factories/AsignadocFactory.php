<?php

namespace Database\Factories;

use App\Models\Horario;
use Illuminate\Database\Eloquent\Factories\Factory;

class AsignadocFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Asignadoc::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'docente_id' => $this->faker->unixTime($max = 'now'),
            'periodo_id' => $this->faker->postcode,
            'aula_id' => $this->faker->postcode,
            'periodo_id' => $this->faker->postcode,
            'materia_id' => $this->faker->postcode,
            'dia_hor' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'inic_hor' => $this->faker->time($format = 'H:i:s', $max = 'now'),
            'ter_hor' => $this->faker->time($format = 'H:i:s', $max = 'now')
        ];
    }
}

