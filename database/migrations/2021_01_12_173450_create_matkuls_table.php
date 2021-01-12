<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatkulsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matkuls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idSemester');
            $table->index('idSemester');
            $table->foreign('idSemester')->references('id')->on('semesters')->onDelete('cascade');
            $table->string('name');
            $table->string('code');
            $table->string('sessionExam');
            $table->string('sksNumber');
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
        Schema::dropIfExists('matkuls', function (Blueprint $table) {
            $table->dropForeign('matkuls_idSemester_foreign');
            $table->dropIndex('matkuls_idSemester_index');
        });
    }
}
