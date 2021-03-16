<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeaveCalculationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('leaveCalculation')) {
            Schema::create('leaveCalculation', function (Blueprint $table) {
                $table->id();
                $table->integer('work_daysPerWeek');
                $table->decimal('leaveDays_accumulated', 4, 2);
                $table->decimal('leaveDays_taken', 4, 2);
                $table->unsignedBigInteger('leaveType_id');
                $table->unsignedBigInteger('employee_id');
                $table->timestamps();
            });
            Schema::table('leaveCalculation', function ($table) {
                $table->foreign('leaveType_id')->references('id')->on('leaveTypes');
                $table->foreign('employee_id')->references('id')->on('employees');
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
        Schema::dropIfExists('leaveCalculation');
    }
}
