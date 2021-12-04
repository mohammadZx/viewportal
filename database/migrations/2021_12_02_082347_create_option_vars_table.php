<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOptionVarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('option_vars', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('option_id');
            $table->string('name');
            $table->text('content')->nullable();
            $table->bigInteger('price')->default(0);
            $table->bigInteger('site_commission')->nullable()->default(10);
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
        Schema::dropIfExists('option_vars');
    }
}
