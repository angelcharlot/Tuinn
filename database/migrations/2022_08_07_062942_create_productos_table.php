<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario');
            $table->unsignedBigInteger('id_categoria');
            $table->string('name', 100);
            $table->text('descrip', 100)->nullable();
            $table->text('descrip2', 100)->nullable();
            $table->text('descrip3', 100)->nullable();
            $table->integer('peso')->nullable();
            $table->char('unidad_medida')->nullable();
            $table->char('volumen')->nullable();
            $table->decimal('precio_compra', 8, 2)->nullnable();
            $table->decimal('precio_venta', 8, 2);
            $table->foreign('id_usuario')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_categoria')->references('id')->on('categorias')->onDelete('cascade');
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
        Schema::dropIfExists('productos');
    }
}
