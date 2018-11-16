<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDetallesFactura extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('tb_cod_det_factura', function (Blueprint $table) {
            $table->integer('cod_detalle_factura');
            $table->integer('cod_cab_factura')->references('id')->on('tb_cod_cab_factura');
            $table->integer('cod_producto');
            $table->integer('cant_vendida');
            $table->string('descripcion');
            $table->float('precio');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::dropIfExists('tb_cod_det_factura');
    }
}
