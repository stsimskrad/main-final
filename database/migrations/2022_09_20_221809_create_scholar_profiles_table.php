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
        Schema::create('scholar_profiles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->string('email')->unique()->nullable();
            $table->string('firstname',150);
            $table->string('lastname',150);
            $table->string('middlename',100)->nullable();
            $table->string('suffix',10)->nullable();
            $table->string('gender',8)->nullable();
            $table->string('mobile',15)->nullable();
            $table->date('birthday')->nullable();
            $table->bigInteger('scholar_id')->unsigned()->nullable();
            $table->foreign('scholar_id')->references('id')->on('scholars')->onDelete('cascade');
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
        Schema::dropIfExists('scholar_profiles');
    }
};
