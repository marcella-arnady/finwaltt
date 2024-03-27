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
        Schema::create('goals', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->string('name', 20);
            $table->integer('amount');
            $table->integer('saved');
            $table->date('startPeriod');
            $table->date('endPeriod');
            $table->string('user_id', 10);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        \DB::statement('ALTER TABLE goals MODIFY amount INT(10)');
        \DB::statement('ALTER TABLE goals MODIFY saved INT(10)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('goals');
    }
};
