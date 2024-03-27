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
        Schema::create('transactions', function (Blueprint $table) {
            $table->string('id', 10)->primary();
            $table->string('name', 20);
            $table->integer('amount');
            $table->date('date');
            $table->string('note', 10)->nullable();
            $table->string('cashflow_id', 10);
            $table->foreign('cashflow_id')->references('id')->on('cashflows')->onDelete('cascade')->onUpdate('cascade');
            $table->string('category_id', 10);
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->string('user_id', 10);
            $table->foreign('user_id')->references('user_id')->on('userwallets')->onDelete('cascade')->onUpdate('cascade');
            $table->string('wallet_id', 10);
            $table->foreign('wallet_id')->references('wallet_id')->on('userwallets')->onDelete('cascade')->onUpdate('cascade');
        });

        \DB::statement('ALTER TABLE transactions MODIFY amount INT(10)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
