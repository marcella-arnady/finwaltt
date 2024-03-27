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
        Schema::create('userwallets', function (Blueprint $table) {
            $table->string('user_id', 10);
            $table->string('wallet_id', 10);
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('wallet_id')->references('id')->on('wallets')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('amount');
            //composite keys
            $table->primary(['user_id', 'wallet_id']);
        });

        \DB::statement('ALTER TABLE userwallets MODIFY amount INT(10)');
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userwallets');
    }
};
