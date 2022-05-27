<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('docentes', function (Blueprint $table) {
            $table->id();
            $table->string("dni_doc");
            $table->string("nom_doc", 45);
            $table->string("ape_doc", 45);
            $table->string("instt_docp");
            $table->string("cobt_doc");
            $table->string("lnac_doc");
            $table->date("fnac_doc");
     

            
            $table->unsignedBigInteger("tiposangre_id");
            $table->unsignedBigInteger("tipogrado_id");
            $table->unsignedBigInteger("especialidad_id");         
            $table->unsignedBigInteger('reparto_id');
            //$table->unsignedBigInteger("user_id");

            //$table->foreign("user_id")
            //->references("id")->on("users");
                      
            $table->foreign("tiposangre_id")
            ->references("id")->on("tiposangres");

            $table->foreign("tipogrado_id")
            ->references("id")->on("tipogrados");
            
            $table->foreign("especialidad_id")
            ->references("id")->on("especialidads");

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
        Schema::dropIfExists('docentes');
    }
}
