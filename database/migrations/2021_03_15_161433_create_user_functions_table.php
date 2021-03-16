<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFunctionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('user_functions')) {
            Schema::create('user_functions', function (Blueprint $table) {
                $table->id();
                $table->string('description');
                $table->unsignedBigInteger('role_id');
                $table->timestamps();
            });
            Schema::table('user_functions', function ($table) {
                $table->foreign('role_id')->references('id')->on('roles');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_functions');
    }
}
