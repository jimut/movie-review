<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserIdToMovies extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movies', function ($table) {
          $table->integer('user_id')->unsigned()->index();
          $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');

          $table->string('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('movies', function ($table) {
        $table->dropForeign('movies_user_id_foreign');
        $table->dropColumn('image');
      });
    }
}
