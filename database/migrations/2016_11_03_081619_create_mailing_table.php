<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailing', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email_theme');
            $table->text('email_text');
            $table->timestamp('scheduled_date')->nullable();
            $table->timestamp('sending_date')->nullable();
            $table->enum('status', ['sent', 'scheduled', 'draft']);
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
        Schema::drop('mailing');
    }
}
