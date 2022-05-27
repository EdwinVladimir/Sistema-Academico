<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluacions', function (Blueprint $table) {
            $table->id();
            $table->date("fecreg_eval");
            $table->integer("nota_deteva");

            $table->unsignedBigInteger("alumno_id");
            $table->unsignedBigInteger("periodo_id");         
            $table->unsignedBigInteger('materia_id');
            $table->unsignedBigInteger('detalplaneva_id');
                      
            $table->foreign("alumno_id")
            ->references("id")->on("alumnos");
            
            $table->foreign("periodo_id")
            ->references("id")->on("periodos");

            $table->foreign("materia_id")
            ->references("id")->on("materias");
            
            $table->foreign("detalplaneva_id")
            ->references("id")->on("detalplanevas");


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
        Schema::dropIfExists('evaluacions');
    }
}
