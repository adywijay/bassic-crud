<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nik');
            $table->string('nama_karyawan');
            $table->string('email');
            $table->unsignedBigInteger('kandidat_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('jabatan_id');
            $table->unsignedBigInteger('role_id');
            $table->year('year_of_join');
            $table->year('year_of_out')->default(2011);
            $table->dateTime('date_of_join');
            $table->dateTime('date_of_out')->default('2011-11-09 14:34:12');
            $table->enum('status', ['Active', 'Inactive'])->default('Inactive');
            $table->timestamps();

            $table->foreign('kandidat_id')->references('id')->on('kandidats')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('jabatan_id')->references('id')->on('jabatans')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('karyawans');
    }
}