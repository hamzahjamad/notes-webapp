<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('content');
            $table->timestamps();

            $table->integer('note_id')->unsigned();
            $table->foreign('note_id')
                  ->references('id')->on('notes')
                  ->onDelete('cascade');
        });

        Schema::table('notes', function (Blueprint $table) {
            $table->dropColumn('content');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');

        Schema::table('notes', function (Blueprint $table) {
            $table->longText('content')->nullable();
        });
    }
}
