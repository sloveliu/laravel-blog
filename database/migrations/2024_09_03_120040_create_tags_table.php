<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('post_tag', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->unsignedInteger('post_id');
            $table->unsignedInteger('tag_id');
            $table->timestamps();

            // 當 posts 的資料被刪除時，post_tag 的資料也一併刪除
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            // 當 tags 的資料被刪除時，post_tag 的資料也一併刪除
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
        Schema::table('post_tag', function(Blueprint $table){
            // $table->dropForeign(['post_id', 'tag_id']); // 這樣寫是複合式外鍵，不能這樣寫
            $table->dropForeign(['post_id']);
            $table->dropForeign(['tag_id']);
        });
        Schema::dropIfExists('post_tag');
        Schema::dropIfExists('tags');
    }
}
