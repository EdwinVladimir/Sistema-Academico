<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetalplanevasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalplanevas', function (Blueprint $table) {
            $table->id();

            $table->string("tipoact_acti");
            $table->string("descrip_detac");
            $table->integer("poreva_detac");
            
            $table->unsignedBigInteger("planeva_id");

            $table->foreign("planeva_id")
            ->references("id")->on("planevas");
                               
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
        Schema::dropIfExists('detalplanevas');
    }
}
