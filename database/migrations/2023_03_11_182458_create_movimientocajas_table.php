<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovimientocajasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movimientocajas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('apertura_de_cajas_id');
            $table->foreign('apertura_de_cajas_id')->references('id')->on('apertura_de_cajas');
            $table->string('tipo_movimiento');
            $table->decimal('monto', 10, 2);
            $table->text('observaciones')->nullable();
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
        Schema::dropIfExists('movimientocajas');
    }
}
