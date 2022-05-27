<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursoMateriaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('curso_materia', function (Blueprint $table) {
            $table->unsignedBigInteger("materia_id");

            $table->foreign('materia_id')->references('id')->on('materias')->onDelete('cascade');
            
            $table->unsignedBigInteger("curso_id");         
            
            $table->foreign('curso_id')->references('id')->on('cursos')->onDelete('cascade');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('curso_materia');
    }
}
