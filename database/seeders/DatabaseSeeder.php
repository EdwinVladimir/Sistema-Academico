<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use function Ramsey\Uuid\v1;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class );
         $this->call(AlumnoSeeder::class );
        $this->call(AulaSeeder::class );
        $this->call(CursoSeeder::class );
        $this->call(EjecursoSeeder::class );
        $this->call(EspecialidadSeeder::class );
        $this->call(MateriaSeeder::class );
        $this->call(ModalidadcursoSeeder::class );
        $this->call(PeriodoSeeder::class );
        $this->call(PlanestudioSeeder::class );
        $this->call(RepartoSeeder::class );
        $this->call(SeccionSeeder::class );
        $this->call(TipocursoSeeder::class );
        $this->call(TipogradoSeeder::class );
        $this->call(TiposangreSeeder::class );
        $this->call(RoleSeeder::class );
    }
}
