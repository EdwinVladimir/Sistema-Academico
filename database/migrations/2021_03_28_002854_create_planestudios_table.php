<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanestudiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('planestudios', function (Blueprint $table) {
            $table->id();
            $table->string("tit_pla");
            $table->string("descrip_pla");
            $table->longText("archi_pla");      
            
            $table->unsignedBigInteger("curso_id")->nullable();

            $table->foreign("curso_id")
            ->references("id")->on("cursos")
            ->onDelete("set null");

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
        Schema::dropIfExists('planestudios');
    }
}
