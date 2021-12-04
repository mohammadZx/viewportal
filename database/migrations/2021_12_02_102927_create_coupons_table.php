<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->text('content')->nullable();
            $table->bigInteger('discount');
            $table->string('discount_type')->default('percent');
            $table->date('expire_at')->nullable();
            $table->bigInteger('coupon_use')->default(0);
            $table->bigInteger('user_coupon_use')->default(0);
            $table->text('role')->default('{}');
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
        Schema::dropIfExists('coupons');
    }
}
