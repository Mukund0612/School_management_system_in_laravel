<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBranchIdToStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            
            // 1. Create new column
            // You probably want to make the new column nullable
            $table->integer('branch_id')->unsigned()->nullable()->after('email');
            $table->integer('course_id')->unsigned()->nullable()->after('branch_id');
            $table->string('profile_image')->nullable()->after('course_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            //
        });
    }
}
