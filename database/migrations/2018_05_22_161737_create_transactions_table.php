<?php

use App\Transaction;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('invoice_id')->index();
            $table->tinyInteger('status')->default(Transaction::STATUS_PENDING);
            $table->string('transaction_number');
            $table->string('transaction_time');
            $table->float('amount');
            $table->string('short_code');
            $table->string('bill_reference');
            $table->string('mobile_number');
            $table->string('payer_first_name')->nullable();
            $table->string('payer_middle_name')->nullable();
            $table->string('payer_last_name')->nullable();
            $table->timestamps();

            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
