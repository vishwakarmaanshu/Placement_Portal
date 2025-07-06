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
        Schema::table('course_enrollments', function (Blueprint $table) {
            $table->renameColumn('user_id', 'first_name');
        });
    }

    public function down()
    {
        Schema::table('course_enrollments', function (Blueprint $table) {
            $table->renameColumn('first_name', 'user_id');
        });
    }};
