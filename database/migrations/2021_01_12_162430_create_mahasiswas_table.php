<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMahasiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idSemester');
            $table->index('idSemester');
            $table->foreign('idSemester')->references('id')->on('semesters')->onDelete('cascade');
            $table->string('name');
            $table->string('email');
            $table->string('npm');
            $table->string('gender');
            $table->string('yearGeneration');
            $table->string('yearGraduation');
            $table->string('class');
            $table->string('numberAbsen');
            $table->unsignedInteger('hits');
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
        Schema::dropIfExists('mahasiswas', function (Blueprint $table) {
            $table->dropForeign('mahasiswas_idSemester_foreign');
            $table->dropIndex('mahasiswas_idSemester_index');
        });
    }
}
