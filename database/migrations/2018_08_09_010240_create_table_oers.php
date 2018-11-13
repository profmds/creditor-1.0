<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('oers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('uri')->unique();
            $table->string('title');
            $table->string('type')->nullable();
            $table->string('key_words')->nullable();
            $table->string('abstract')->nullable();
            $table->unsignedInteger('author');
            $table->timestamps();
            $table->foreign('author')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->engine = 'InnoDB';
            $table->charset = 'utf8';
            $table->collation = 'utf8_unicode_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('oers');
    }
}
