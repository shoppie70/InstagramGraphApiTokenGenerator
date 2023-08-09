<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->LongText('app_id')->nullable();
            $table->LongText('app_secret')->nullable();
            $table->LongText('management_id')->nullable();
            $table->LongText('access_token_1')->nullable();
            $table->LongText('access_token_2')->nullable();
            $table->LongText('access_token_3')->nullable();
            $table->LongText('facebook_page_name')->nullable();
            $table->LongText('business_account')->nullable();
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
