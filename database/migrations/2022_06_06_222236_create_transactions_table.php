<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
			$table->string('payor_acc', 30);
			$table->string('payee_acc', 30);
            $table->foreign('payor_acc')->references('id')->on('bank_accounts')->onDelete('cascade');
			$table->foreign('payee_acc')->references('id')->on('bank_accounts')->onDelete('cascade');
            $table->decimal('amount');
            $table->string('description');
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
        Schema::dropIfExists('transactions');
    }
};
