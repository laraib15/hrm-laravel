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
    {if(!Schema::hasTable('attendances')){
        Schema::create('attendances', function (Blueprint $table) {
            $table->id('attendance_id');
            $table->unsignedBigInteger('employee_id');
            $table->foreign('employee_id')->references('employee_id')->on('employees')->onDelete('cascade')->onUpdate('cascade');
            $table->date('attendance_date');
            $table->time('check_in')->nullable();
            $table->time('check_out')->nullable();
            $table->String('buttonState')->default('start work');

            $table->enum('attendance_by',['Employee','Administrator']);
            $table->enum('status',['Present','Absent','On Leave'])->nullable();
            $table->unsignedBigInteger('leave_id')->nullable();
            $table->foreign('leave_id')->references('leave_id')->on('leaves')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
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
        Schema::dropIfExists('attendences');
    }
};
