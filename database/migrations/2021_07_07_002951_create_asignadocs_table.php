<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsignadocsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asignadocs', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("docente_id");
            $table->unsignedBigInteger("periodo_id");
            $table->unsignedBigInteger("seccion_id");
            $table->unsignedBigInteger("materia_id");
            $table->unsignedBigInteger("aula_id");

             $table->foreign("docente_id")
            ->references("id")->on("docentes");

            $table->foreign("periodo_id")
            ->references("id")->on("periodos");
            
            $table->foreign("seccion_id")
            ->references("id")->on("seccions");

            $table->foreign("materia_id")
            ->references("id")->on("materias");
            
            $table->foreign("aula_id")
            ->references("id")->on("aulas");


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('horarios');
    }
}
