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
        Schema::table('users', function (Blueprint $table) {
            $table->string('student_org_treasurer')->default("IN-PROGRESS");
            $table->string('student_org_description')->nullable();

            $table->string('librarian')->default("IN-PROGRESS");
            $table->string('librarian_description')->nullable();

            $table->string('dean_of_student_affair')->default("IN-PROGRESS");
            $table->string('dean_of_student_affair_description')->nullable();

            $table->string('dean_principal')->default("IN-PROGRESS");
            $table->string('dean_principal_description')->nullable();

            $table->string('guidance_councilor')->default("IN-PROGRESS");
            $table->string('guidance_councilor_description')->nullable();

            $table->string('registrar')->default("IN-PROGRESS");
            $table->string('registrar_description')->nullable();

            $table->string('accounting_assessment')->default("IN-PROGRESS");
            $table->string('accounting_assessment_description')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
