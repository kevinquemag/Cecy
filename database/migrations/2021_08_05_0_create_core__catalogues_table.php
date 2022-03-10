<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoreCataloguesTable extends Migration
{
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_CORE'))->create('catalogues', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('parent_id')
                ->nullable()
                ->comment('Un catalogo puede tener catalogos hijos')
                ->constrained('core.catalogues');

            $table->string('code')
                ->comment('No debe ser modificado una vez que se lo crea');

            $table->text('color')
                ->comment('color en hexadecimal')
                ->default('#9c9c9c');

            $table->text('description')
                ->nullable();

            $table->string('icon')
                ->nullable()
                ->comment('Icono de la libreria que se usa en el frontend');

            $table->text('name');

            $table->string('type')
                ->comment('Para categorizar los catalogos');
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_CORE'))->dropIfExists('catalogues');
    }
}
