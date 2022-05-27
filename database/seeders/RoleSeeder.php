<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //ROLES
        $rolead = Role::create(['name' => 'Administrador']);
        $rolete = Role::create(['name' => 'Técnico']);
        $roledo = Role::create(['name' => 'Docente']);
        $roleal = Role::create(['name' => 'Alumno']);

        //PERMISOs
        Permission::create(['name' => 'estudiantes'])->syncRoles([$rolead, $rolete, $roledo, $roleal]);
        Permission::create(['name' => 'docentes'])->syncRoles([$rolead, $rolete, $roledo, $roleal]);
        Permission::create(['name' => 'matriculacion'])->syncRoles([$rolead, $rolete, $roledo, $roleal]);
        Permission::create(['name' => 'actividades'])->syncRoles([$rolead, $rolete, $roledo, $roleal]);
        Permission::create(['name' => 'modalidad'])->syncRoles([$rolead, $rolete, $roledo, $roleal]);
        Permission::create(['name' => 'aula'])->syncRoles([$rolead, $rolete, $roledo, $roleal]);
        Permission::create(['name' => 'seccion'])->syncRoles([$rolead, $rolete, $roledo, $roleal]);
        Permission::create(['name' => 'cursos'])->syncRoles([$rolead, $rolete, $roledo, $roleal]);
        Permission::create(['name' => 'modulos'])->syncRoles([$rolead, $rolete, $roledo, $roleal]);
        Permission::create(['name' => 'materias'])->syncRoles([$rolead, $rolete, $roledo, $roleal]);
        Permission::create(['name' => 'periodos'])->syncRoles([$rolead, $rolete, $roledo, $roleal]);
        Permission::create(['name' => 'planes'])->syncRoles([$rolead, $rolete, $roledo, $roleal]);
        Permission::create(['name' => 'horarios'])->syncRoles([$rolead, $rolete, $roledo, $roleal]);
        Permission::create(['name' => 'general'])->syncRoles([$rolead, $rolete, $roledo, $roleal]);
        Permission::create(['name' => 'calificaciones'])->syncRoles([$rolead, $rolete, $roledo, $roleal]);
        Permission::create(['name' => 'analisisdatos'])->syncRoles([$rolead, $rolete, $roledo, $roleal]);
        Permission::create(['name' => 'reparto'])->syncRoles([$rolead, $rolete, $roledo, $roleal]);
        Permission::create(['name' => 'especialidad'])->syncRoles([$rolead, $rolete, $roledo, $roleal]);
        Permission::create(['name' => 'tipogrado'])->syncRoles([$rolead, $rolete, $roledo, $roleal]);
        Permission::create(['name' => 'tipocurso'])->syncRoles([$rolead, $rolete, $roledo, $roleal]);
        Permission::create(['name' => 'ejecurso'])->syncRoles([$rolead, $rolete, $roledo, $roleal]);
        Permission::create(['name' => 'tiposangre'])->syncRoles([$rolead, $rolete, $roledo, $roleal]);
        Permission::create(['name' => 'perfil'])->syncRoles([$rolead, $rolete, $roledo, $roleal]);
        Permission::create(['name' => 'password'])->syncRoles([$rolead, $rolete, $roledo, $roleal]);
        Permission::create(['name' => 'roles'])->syncRoles([$rolead, $rolete, $roledo, $roleal]);

    }
}
