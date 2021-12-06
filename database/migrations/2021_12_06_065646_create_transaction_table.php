<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->string('id_transaction',20)->unique();
            $table->foreignId('uid')->constrained('users');
            $table->bigInteger('quantity')->nullable();
            $table->bigInteger('total')->nullable();
            $table->string('method_payment',100)->nullable();
            $table->enum('status',['berhasil','gagal','pending'])->nullable();
            $table->timestamps();
            $table->date('canceled_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaction');
    }
}
