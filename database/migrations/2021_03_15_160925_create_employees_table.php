<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('employees')) {
            Schema::create('employees', function (Blueprint $table) {
                $table->id();
                $table->string('employee_no');
                $table->string('surname');
                $table->string('name');
                $table->date('dob');
                $table->string('idType');
                $table->string('idNo');
                $table->string('gender');
                $table->string('contact_no');
                $table->date('start_date');
                $table->string('occupation');
                $table->string('email')->unique();
                $table->unsignedBigInteger('employeeType_id');
                $table->unsignedBigInteger('dept_id');
                $table->unsignedBigInteger('team_id');
                $table->unsignedBigInteger('company_id');
                $table->unsignedBigInteger('country_id');
                $table->timestamps();
            });
            Schema::table('employees', function ($table) {
                $table->foreign('employeeType_id')->references('id')->on('employeeTypes');
                $table->foreign('dept_id')->references('id')->on('departments');
                $table->foreign('team_id')->references('id')->on('teams');
                $table->foreign('company_id')->references('id')->on('companies');
                $table->foreign('country_id')->references('id')->on('countries');
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
        Schema::dropIfExists('employees');
    }
}
