<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetallesAsientosContablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detalles_asientos_contables', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('asiento_contable_id');
          $table->unsignedInteger('cuenta_id');
          $table->bigInteger('debe')->unsigned();
          $table->bigInteger('haber')->unsigned();
          $table->foreign('asiento_contable_id')->references('id')->on('asientos_contables')->onDelete('cascade');
          $table->foreign('cuenta_id')->references('id')->on('cuentas')->onDelete('cascade');
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
        Schema::dropIfExists('detalles_asientos_contables');
    }
}
