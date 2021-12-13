<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('option_id');
            $table->foreign('option_id')->references('id')->on('options')->onDelete('cascade');
            $table->string('name');
            $table->text('content')->nullable();
            $table->integer('order_no')->nullable()->default(1);
            $table->bigInteger('price')->nullable()->default(0);
            $table->bigInteger('site_commission')->nullable()->default(100);
            $table->string('commission_type')->nullable()->default('percent');
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
        Schema::dropIfExists('option_types');
    }
}
