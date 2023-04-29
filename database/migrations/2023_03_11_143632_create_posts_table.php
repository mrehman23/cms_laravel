<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->foreignId('category_id')->constrained('categories')->onDelete('restrict');
            $table->string('lan');
            $table->string('short_description',1000);
            $table->string('image')->nullable();
            $table->integer('weight');
            $table->integer('status')->default('1');
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        DB::statement("ALTER TABLE ".DB::getTablePrefix()."posts ADD description LONGBLOB NULL AFTER short_description");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
