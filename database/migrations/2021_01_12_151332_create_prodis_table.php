<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prodis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('idJurusan');
            $table->index('idJurusan');
            $table->foreign('idJurusan')->references('id')->on('jurusans')->onDelete('cascade');
            $table->string('name');
            $table->string('code');
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
        Schema::dropIfExists('prodis', function (Blueprint $table) {
            $table->dropForeign('prodis_idJurusan_foreign');
            $table->dropIndex('prodis_idJurusan_index');
        });
    }
}
