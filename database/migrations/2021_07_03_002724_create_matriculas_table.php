<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatriculasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriculas', function (Blueprint $table) {
            $table->id();

            $table->date("feins_matri");

            $table->unsignedBigInteger("periodo_id");
            $table->unsignedBigInteger("alumno_id");
            $table->unsignedBigInteger("curso_id");
            $table->unsignedBigInteger("seccion_id");
            

            $table->foreign("periodo_id")
            ->references("id")->on("periodos");

            $table->foreign("alumno_id")
            ->references("id")->on("alumnos");
            
            $table->foreign("curso_id")
            ->references("id")->on("cursos");

            $table->foreign("seccion_id")
            ->references("id")->on("seccions");
           

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
        Schema::dropIfExists('matriculas');
    }
}
