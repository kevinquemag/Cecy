<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCecyDetailPlanificationsTable extends Migration
{
    public function up()
    {
        Schema::connection(env('DB_CONNECTION_CECY'))->create('detail_planifications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('classroom_id')
                ->nullable()
                ->comment('Id aula')
                ->constrained('cecy.classrooms');

            // Pendiente de revisar, para mejor crear una tabla de horarios
            // Faltan ejemplos -2
            $table->foreignId('day_id')
                ->nullable()
                ->comment('Id día')
                ->constrained('cecy.catalogues');

            $table->foreignId('parallel_id')
                ->comment('A,B,C,D')
                ->constrained('cecy.catalogues');

            $table->foreignId('planification_id')
                ->nullable()
                ->comment('Id planificación')
                ->constrained('cecy.planifications');

            $table->foreignId('workday_id')
                ->nullable()
                ->comment('Jornada laboral como matutino, vespertino o nocturno')
                ->constrained('cecy.catalogues');

            $table->foreignId('state_id')
                ->comment('Si el paralelo esta: Proceso, culminado, Aprobado, Por aprobar')
                ->constrained('cecy.catalogues');

            $table->time('ended_time')
                ->nullable()
                ->comment('Hora de finalización de clases');

            $table->text('observations')
                ->nullable()
                ->comment('Observaciones necesaria si las horas de duración de curso no son alcanzadas por las horas de clase');

            $table->date('plan_ended_at')
                ->nullable()
                ->comment('Fecha final real de la planificación (que puede variar a la planificación)');

            $table->integer('registrations_left')
                ->nullable()
                ->comment('Capacidad restante del paralelo');

            $table->time('started_time')
                ->nullable()
                ->comment('Hora de inicio de clases');
        });
    }

    public function down()
    {
        Schema::connection(env('DB_CONNECTION_CECY'))->dropIfExists('detail_planifications');
    }
}
