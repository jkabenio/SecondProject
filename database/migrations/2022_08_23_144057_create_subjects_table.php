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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id');
            $table->string('code');
            $table->string('subj_code');
            $table->string('subj_name');
            $table->integer('unit');
            $table->string('year_level');
            $table->string('semester');
            $table->timestamps();
        // 'belong_to',
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subjects');
    }
};
