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
        Schema::create('employees', function (Blueprint $table) {
            $table->id('employee_id');
            $table->string('firstName');
        $table->string('lastName');
        $table->string('email');
        $table->string('gender');
        $table->string('phoneNumber');
        $table->string('address')->nullable();
        $table->unsignedBigInteger('department_id');
        $table->foreign('department_id')->references('department_id')->on('departments')->onDelete('cascade')->onUpdate('cascade');
        $table->unsignedBigInteger('designation_id');
        $table->foreign('designation_id')->references('designation_id')->on('designations')->onDelete('cascade')->onUpdate('cascade');
        $table->date('join_date');
            $table->float('salary')->nullable();
            $table->boolean('is_active')->default('1');
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
        Schema::dropIfExists('employees');
    }
};
