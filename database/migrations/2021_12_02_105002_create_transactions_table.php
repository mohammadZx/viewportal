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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('option_var_id')->nullable();
            $table->unsignedBigInteger('option_type_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('option_var_id')->references('id')->on('options')->onDelete('cascade');
            $table->foreign('option_type_id')->references('id')->on('options')->onDelete('cascade');
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
