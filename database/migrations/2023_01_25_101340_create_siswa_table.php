<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswa', function ($collection) {
            $collection->index('name');
            $collection->unique('nim');
            $collection->string('gender');
            $collection->unsignedBigInteger('kelas_id');
            $collection->foreign('kelas_id')->references('id')->on('kelas');
            $collection->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswas');
    }
};
