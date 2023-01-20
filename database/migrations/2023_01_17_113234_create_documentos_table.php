<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->text('nro_documento');
            $table->unsignedBigInteger('mesa_id');
            $table->unsignedBigInteger('negocio_id');
            $table->text('tipo');
            $table->text('estado');
            $table->text('sub_total');
            $table->text('total');
            $table->foreign('mesa_id')->references('id')->on('mesas')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('negocio_id')->references('id')->on('negocios')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('documentos');
    }
}
