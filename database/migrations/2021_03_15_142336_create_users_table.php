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
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('surname');
                $table->string('email')->unique();
                $table->string('password');
                $table->enum('createRole', ['Y', 'N'])->default('N');
                $table->enum('updateRole', ['Y', 'N'])->default('N');
                $table->enum('deleteRole', ['Y', 'N'])->default('N');
                $table->enum('addUser', ['Y', 'N'])->default('N');
                $table->enum('updateUser', ['Y', 'N'])->default('N');
                $table->enum('deleteUser', ['Y', 'N'])->default('N');
                $table->enum('addCountry', ['Y', 'N'])->default('N');
                $table->enum('updateCountry', ['Y', 'N'])->default('N');
                $table->enum('deleteCountry', ['Y', 'N'])->default('N');
                $table->enum('addCompany', ['Y', 'N'])->default('N');
                $table->enum('updateCompany', ['Y', 'N'])->default('N');
                $table->enum('deleteCompany', ['Y', 'N'])->default('N');
                $table->enum('addDept', ['Y', 'N'])->default('N');
                $table->enum('updateDept', ['Y', 'N'])->default('N');
                $table->enum('deleteDept', ['Y', 'N'])->default('N');
                $table->enum('addTeam', ['Y', 'N'])->default('N');
                $table->enum('updateTeam', ['Y', 'N'])->default('N');
                $table->enum('deleteTeam', ['Y', 'N'])->default('N');
                $table->enum('addEmployeeType', ['Y', 'N'])->default('N');
                $table->enum('updateEmployeeType', ['Y', 'N'])->default('N');
                $table->enum('deleteEmployeeType', ['Y', 'N'])->default('N');
                $table->enum('addLeaveType', ['Y', 'N'])->default('N');
                $table->enum('updateLeaveType', ['Y', 'N'])->default('N');
                $table->enum('deleteLeaveType', ['Y', 'N'])->default('N');
                $table->enum('addEmployee', ['Y', 'N'])->default('N');
                $table->enum('updateEmployee', ['Y', 'N'])->default('N');
                $table->enum('deleteEmployee', ['Y', 'N'])->default('N');
                $table->enum('attReg', ['Y', 'N'])->default('N');
                $table->enum('leaveCapture', ['Y', 'N'])->default('N');
                $table->enum('leaveApprove', ['Y', 'N'])->default('N');
                $table->enum('settings', ['Y', 'N'])->default('N');
                $table->enum('reportView', ['Y', 'N'])->default('N');
                $table->unsignedBigInteger('role_id');
                $table->rememberToken();
                $table->timestamps();
            });
            Schema::table('users', function ($table) {
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
        Schema::dropIfExists('users');
    }
}
