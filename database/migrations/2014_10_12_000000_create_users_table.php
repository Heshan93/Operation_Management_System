<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fname')->nullable(false);
            $table->string('lname')->nullable(false);
            $table->string('email')->unique()->nullable(false);
            $table->string('password')->nullable(false);
            $table->string('nic')->nullable(false);
            $table->string('phone')->nullable(false);
            $table->string('job_roll')->nullable(false);
            $table->text('address')->nullable(false);
            $table->string('district')->nullable(false);
            $table->string('division')->nullable(false);
            $table->boolean('is_admin')->default(false)->nullable(false);
            $table->boolean('is_view_user')->default(false)->nullable(false);
            $table->boolean('is_edit_user')->default(false)->nullable(false);
            $table->boolean('is_view_citizen')->default(false)->nullable(false);
            $table->boolean('is_edit_citizen')->default(false)->nullable(false);
            $table->boolean('is_manage_appointment')->default(false)->nullable(false);
            $table->boolean('is_view_reports')->default(false)->nullable(false);
            $table->string('profile_file_name')->default('img.jpg');
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
        Schema::dropIfExists('users');
    }
}
