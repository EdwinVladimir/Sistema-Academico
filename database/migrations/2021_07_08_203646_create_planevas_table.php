<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanevasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planevas', function (Blueprint $table) {
            $table->id();
            $table->date("fecent_plaeva");
     

            
            $table->unsignedBigInteger("docente_id");
            $table->unsignedBigInteger("periodo_id");         
            $table->unsignedBigInteger('materia_id');
                      
            $table->foreign("docente_id")
            ->references("id")->on("docentes");
            
            $table->foreign("periodo_id")
            ->references("id")->on("periodos");

            $table->foreign("materia_id")
            ->references("id")->on("materias");

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
        Schema::dropIfExists('planevas');
    }
}
