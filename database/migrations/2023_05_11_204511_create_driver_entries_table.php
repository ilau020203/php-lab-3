<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('driving_entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('entry_name');
            $table->string('student_name');
            $table->integer('price');
            $table->integer('status');
            $table->date('entry_start');
            $table->date('entry_end');
            $table->unsignedBigInteger('driver_id');
            $table->foreign('driver_id')
            ->references('id')->on('drivers')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('driver_entries');
    }
};
