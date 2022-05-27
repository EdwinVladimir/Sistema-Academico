<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->string("cod_cur");
            $table->string("nom_cur");
            $table->string("narea_cur");
            $table->integer("nhor_cur");
            
            $table->unsignedBigInteger("ejecurso_id");
            $table->unsignedBigInteger("tipocurso_id");

            $table->foreign("ejecurso_id")
            ->references("id")->on("ejecursos");
            
            $table->foreign("tipocurso_id")
            ->references("id")->on("tipocursos");


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
        Schema::dropIfExists('cursos');
    }
}
