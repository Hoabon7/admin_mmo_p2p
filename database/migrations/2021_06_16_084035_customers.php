<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Customers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('mmo-admin')->create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique()->index();
            $table->integer('status')->default(0);
            $table->text('avatar')->nullable();
            $table->string('phone')->nullable()->unique()->index();
            $table->string('address')->nullable();
            $table->integer('role')->default(1)->index();
            $table->bigInteger('insurance_money')->nullable();
            $table->string('image_bank')->nullable();
            $table->string('image_idCard')->nullable();
            $table->text('reason')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('request_businessman')->nullable();
            $table->text('firebase_token')->nullable();
            $table->rememberToken();
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
        Schema::connection('mmo-admin')->dropIfExists('customers');
    }
}
