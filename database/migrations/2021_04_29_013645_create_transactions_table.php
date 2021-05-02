<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'transactions',
            function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('payer_id');
                $table->foreign('payer_id')->references('id')
                    ->on('users');
                $table->unsignedBigInteger('payee_id');
                $table->foreign('payee_id')->references('id')
                    ->on('users');
                $table->float('value')->default(0);
                $table->enum('status',
                             [
                                 'pending',
                                 'authorized',
                                 'cancelled',
                                 'received',
                                 'finished'
                             ]
                )->default('pending');
                $table->timestamps();
            }
        );
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
}
