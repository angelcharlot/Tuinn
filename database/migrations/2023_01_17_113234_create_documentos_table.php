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
            $table->text('nro_documento')->nullable();
            $table->text('nro_documento_afecta')->nullable();
            $table->unsignedBigInteger('mesa_id')->nullable();;
            $table->unsignedBigInteger('negocio_id');
            $table->text('tipo');
            $table->text('estado');
            $table->decimal('sub_total',8,2);
            $table->char('nro_serie',100)->nullable();
            $table->decimal('total',8,2);
            $table->text('cam1')->nullable();
            $table->text('cam2')->nullable();
            $table->text('cam3')->nullable();
            $table->text('cam4')->nullable();
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
