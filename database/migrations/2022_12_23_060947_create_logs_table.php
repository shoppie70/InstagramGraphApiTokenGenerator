<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->string('app_id')->nullable();
            $table->string('app_secret')->nullable();
            $table->string('management_id')->nullable();
            $table->string('access_token_1')->nullable();
            $table->string('access_token_2')->nullable();
            $table->string('access_token_3')->nullable();
            $table->string('facebook_page_name')->nullable();
            $table->string('business_account')->nullable();
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
        Schema::dropIfExists('logs');
    }
};
