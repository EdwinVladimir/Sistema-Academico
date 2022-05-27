<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnos', function (Blueprint $table) {
            $table->id();
            $table->string("dni_al");
            $table->string("nom_al");
            $table->string("ape_al");
            $table->string("lnac_al");
            $table->date("fnac_al");
     

            
            $table->unsignedBigInteger("tiposangre_id");
            $table->unsignedBigInteger("tipogrado_id");
            $table->unsignedBigInteger("especialidad_id");      
            $table->unsignedBigInteger('reparto_id');
            //$table->unsignedBigInteger("user_id");

            //$table->foreign("user_id")
            //->references("id")->on("users");
           
            $table->foreign("especialidad_id")
            ->references("id")->on("especialidads");
            
            $table->foreign("tiposangre_id")
            ->references("id")->on("tiposangres");

            $table->foreign("tipogrado_id")
            ->references("id")->on("tipogrados");
                     
            $table->foreign("reparto_id")
            ->references("id")->on("repartos");
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
        Schema::dropIfExists('alumnos');
    }
}
