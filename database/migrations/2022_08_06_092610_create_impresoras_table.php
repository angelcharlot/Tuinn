<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImpresorasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('impresoras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('negocio_id')->nullable();
            $table->foreign('negocio_id')->references('id')->on('negocios');
            $table->text('name');
            $table->text('tipo');
            $table->boolean('default')->nullable()->default(0);;
            $table->text('cam1')->nullable();
            $table->text('cam2')->nullable();
            $table->text('cam3')->nullable();
            $table->text('interface');
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
        Schema::dropIfExists('impresoras');
    }
}
