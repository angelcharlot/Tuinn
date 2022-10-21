<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComandaProductoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comanda_productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('productos_id');
            $table->unsignedBigInteger('comanda_id');
            $table->string('presentacion');
            $table->double('precio_uni', 8, 2);
            $table->integer('cantidad');
            $table->double('precio_total', 8, 2);
            $table->text('comentario');
            $table->foreign('productos_id')->references('id')->on('productos')->onDelete('cascade');
            $table->foreign('comanda_id')->references('id')->on('comandas')->onDelete('cascade');
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
        Schema::dropIfExists('comanda_producto');
    }
}
