<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlargenosProductos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alargeno_productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('alargeno_id');
            $table->unsignedBigInteger('productos_id');
            $table->foreign('alargeno_id')->references('id')->on('alargenos')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreign('productos_id')->references('id')->on('productos')->onDelete('CASCADE')->onUpdate('CASCADE');
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
        //
    }
}
