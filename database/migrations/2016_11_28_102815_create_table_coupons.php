<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCoupons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');

            $table->string('title', 255);
            $table->string('seo_title', 255)->nullable();
            $table->string('slug', 200)->unique();
            $table->text('desc')->nullable();
            $table->text('keywords')->nullable();

            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->integer('views')->unsigned()->default(0);
            $table->boolean('status')->default(true);


            $table->timestamps();
        });

        Schema::create('coupon_tag', function(Blueprint $table)
        {
            $table->integer('coupon_id')->unsigned()->index();
            $table->foreign('coupon_id')->references('id')->on('coupons')->onDelete('cascade');
            $table->integer('tag_id')->unsigned()->index();
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
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
        Schema::dropIfExists('coupon_tag');
    }
}
