<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNegociosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('negocios', function (Blueprint $table) {
            $table->id();

            $table->string('name',200)->nullable();
            $table->string('direccion',500)->nullable();
            $table->text('denominacion_social')->nullable();
            $table->string('nif',50)->nullable();
            $table->decimal('iva', 5, 2)->nullable()->default(10.00);
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
        Schema::dropIfExists('negocios');
    }
}
