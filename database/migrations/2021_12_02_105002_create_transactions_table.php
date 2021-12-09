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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('user_id');
            $table->bigInteger('option_var_id')->nullable();
            $table->bigInteger('option_type_id')->nullable();
            $table->bigInteger('price')->nullable();
            $table->string('coupon')->nullable();
            $table->boolean('status')->default(0);
            $table->string('authority_code')->nullable();
            $table->string('gate_way')->default('zarinpal');
            $table->text('comment')->nullable();
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
}
