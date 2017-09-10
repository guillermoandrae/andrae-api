<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('posts')) {
            return;
        }

        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('external_id');
            $table->enum('source', ['Twitter', 'Instagram', 'Pinterest', 'Spotify', 'GitHub']);
            $table->index('source');
            $table->string('author');
            $table->string('original_author');
            $table->text('body');
            $table->string('html_url');
            $table->string('thumbnail_url');
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
        //
    }
}
