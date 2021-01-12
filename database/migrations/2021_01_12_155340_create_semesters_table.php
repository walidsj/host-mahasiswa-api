<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemestersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idProdi');
            $table->index('idProdi');
            $table->foreign('idProdi')->references('id')->on('prodis')->onDelete('cascade');
            $table->string('name');
            $table->string('number');
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
        Schema::dropIfExists('semesters', function (Blueprint $table) {
            $table->dropForeign('semesters_idProdi_foreign');
            $table->dropIndex('semesters_idProdi_index');
        });
    }
}
