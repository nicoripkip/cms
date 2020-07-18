<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mails_types', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description')->nullable();
        });

        Schema::create('mails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('type_id');
            $table->foreign('type_id')->references('id')->on('mails_types');
            $table->unsignedBigInteger('forms_id');
            $table->foreign('forms_id')->references('id')->on('forms');
        });

        Schema::create('mails_data', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('subject')->nullable();
            $table->string('to_email');
            $table->string('to_name');
            $table->longText('body');
            $table->binary('attachment')->nullable();
            $table->string('from_name');
            $table->string('from_email');
            $table->unsignedBigInteger('mails_id');
            $table->foreign('mails_id')->references('id')->on('mails');
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
        Schema::dropIfExists('mails');
        Schema::dropIfExists('mails_types');
        Schema::dropIfExists('mails_data');
    }
}
