<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyStatusOrderEnum extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("ALTER TABLE `orders` CHANGE `status` `status` ENUM('Iniciando', 'Procesando', 'Validada', 'Finalizada', 'Cancelada');");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE `orders` CHANGE `status` `status` ENUM('Iniciando', 'Procesando', 'Finalizada', 'Cancelada');");
    }
}
